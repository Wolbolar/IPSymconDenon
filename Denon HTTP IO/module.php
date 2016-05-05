<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonAVRIOHTTP extends IPSModule
{

    public function Create()
    {
	//Never delete this line!
        parent::Create();
		
		//These lines are parsed on Symcon Startup or Instance creation
        //You cannot use variables here. Just static values.
		
		$this->RegisterPropertyBoolean("Open", false);
        $this->RegisterPropertyString("Host", "");
		$this->RegisterPropertyInteger("UpdateInterval", 30);
		
             
    }

    public function ApplyChanges()
    {
	//Never delete this line!
        parent::ApplyChanges();
        $change = false;

		//$this->RegisterVariableString("BufferIN", "BufferIN", "", 1);
        $this->RegisterVariableString("CommandOut", "CommandOut", "", 2);
        IPS_SetHidden($this->GetIDForIdent('CommandOut'), true);
        //IPS_SetHidden($this->GetIDForIdent('BufferIN'), true);
		$this->RegisterVariableString("InputMapping", "Input Mapping", "", 4);
        IPS_SetHidden($this->GetIDForIdent('InputMapping'), true);
		$this->RegisterVariableString("AVRType", "AVRType", "", 5);
        IPS_SetHidden($this->GetIDForIdent('AVRType'), true);
	//IP Prüfen
		$ip = $this->ReadPropertyString('Host');
	if (!filter_var($ip, FILTER_VALIDATE_IP) === false)
		{
		$Open = $this->ReadPropertyBoolean('Open');
		if (!$Open)
			$this->SetStatus(104);

		if ($this->ReadPropertyString('Host') == '')
					{
						if ($Open)
							$this->SetStatus(202);
					}
		if ($Open)
			{
				$this->SetStatus(102);	
			}
		
		}
	else
			{
			$this->SetStatus(204); //IP Adresse ist ungültig 
			}
	$this->RegisterTimer('Update', $this->ReadPropertyString('UpdateInterval'), 'DAVRIO_GetStatus($id)');
	}	

	protected function RegisterTimer($ident, $interval, $script)
	{
		$id = @IPS_GetObjectIDByIdent($ident, $this->InstanceID);

		if ($id && IPS_GetEvent($id)['EventType'] <> 1)
		{
		  IPS_DeleteEvent($id);
		  $id = 0;
		}

		if (!$id)
		{
		  $id = IPS_CreateEvent(1);
		  IPS_SetParent($id, $this->InstanceID);
		  IPS_SetIdent($id, $ident);
		}

		IPS_SetName($id, $ident);
		IPS_SetHidden($id, true);
		IPS_SetEventScript($id, "\$id = \$_IPS['TARGET'];\n$script;");

		if (!IPS_EventExists($id)) throw new Exception("Ident with name $ident is used for wrong object type");

		if (!($interval > 0))
		{
		  IPS_SetEventCyclic($id, 0, 0, 0, 0, 1, 1);
		  IPS_SetEventActive($id, false);
		}
		else
		{
		  IPS_SetEventCyclic($id, 0, 0, 0, 0, 1, $interval);
		  IPS_SetEventActive($id, true);
		}
	}

	public function GetInputArrayStatus()
	{
		$InputsMapping = GetValue($this->GetIDForIdent("InputMapping"));
		$InputsMapping = json_decode($InputsMapping);
		//Varmapping generieren
		$AVRType = $InputsMapping->AVRType;
		$writeprotected = $InputsMapping->writeprotected;
		$Inputs = $InputsMapping->Inputs;
		$Varmapping = array();
		foreach ($Inputs as $Key => $Input)
			{
			$Command = $Input->Source;
			$Varmapping[$Command] = $Key;
			}
		$InputArray	= array("AVRType" => $AVRType, "Writeprotected" => $writeprotected, "Inputs" => $Inputs);
		return $InputArray;
	}		
################## Datapoints
 
	
		
			
	################## DATAPOINT RECEIVE FROM CHILD
	

	public function ForwardData($JSONString)
	{
	 
		// Empfangene Daten von der Splitter Instanz
		$data = json_decode($JSONString);
		
	 
		// Hier würde man den Buffer im Normalfall verarbeiten
		// z.B. CRC prüfen, in Einzelteile zerlegen
		try
		{
			// Absenden an Denon AVR
		
			SetValue($this->GetIDForIdent("CommandOut"), $data->Buffer);
			IPS_LogMessage("ForwardData Denon HTTP Splitter", utf8_decode($data->Buffer));
			
			$command = $data->Buffer;
			$this->SendCommand ($command);
		}
		catch (Exception $ex)
		{
			echo $ex->getMessage();
			echo ' in '.$ex->getFile().' line: '.$ex->getLine().'.';
		}
	 
	 
	}
		
	public function GetStatus ()
	{
		// Empfangene Daten vom Denon AVR Receiver
		
		//Semaphore setzen
        if ($this->lock("HTTPGetState"))
        {
        // Daten senden
	        try
	        {
	            //Daten abholen
				$DenonStatus = new DENON_StatusHTML;
				$ipdenon = $this->ReadPropertyString("Host");
				$DenonStatus->ipdenon = $ipdenon;
				$AVRType = $this->GetAVRType();
				$InputMapping = $this->GetInputVarMapping();
				$data = $DenonStatus->getStates ($InputMapping, $AVRType);
				$this->SendJSON($data);
	        }
	        catch (Exception $exc)
	        {
	            // Senden fehlgeschlagen
	            $this->unlock("HTTPGetState");
	            throw new Exception($exc);
	        }
        $this->unlock("HTTPGetState");
        }
        else
        {
			echo "Can not send to parent \n";
			$this->unlock("HTTPGetState");
			//throw new Exception("Can not send to parent",E_USER_NOTICE);
		}
		return $data;
	}
	
	protected function SendJSON ($data)
	{
		// Weiterleitung zu allen Gerät-/Device-Instanzen
		$this->SendDataToChildren(json_encode(Array("DataID" => "{E73CE1D0-6670-4607-ACA1-30469558D2F7}", "Buffer" => $data))); //Denon I/O HTTP RX GUI
	}
	
	protected function SendCommand ($command)
	{
		$ip = $this->ReadPropertyString("Host");
		//Ins URL Format bringen
		//$command = urlencode ($command);
		
		//Semaphore setzen
        if ($this->lock("HTTPCommandSend"))
        {
        // Daten senden
	        try
	        {
	            //Command für URL Codieren
				$payload = rawurlencode($command);
				$response = file_get_contents("http://".$ip."/goform/formiPhoneAppDirect.xml?".$payload);
	        }
	        catch (Exception $exc)
	        {
	            // Senden fehlgeschlagen
	            $this->unlock("HTTPCommandSend");
	            throw new Exception($exc);
	        }
        $this->unlock("HTTPCommandSend");
        }
        else
        {
			echo "Can not send to parent \n";
			$this->unlock("HTTPCommandSend");
			//throw new Exception("Can not send to parent",E_USER_NOTICE);
		  }
		IPS_LogMessage("Denon AVR Command:", $command." gesendet."); 
		
		IPS_Sleep(100);
		if ($this->lock("HTTPCommandSend"))
        {
        // Response abholen
	        try
	        {
	            $this->GetStatus ();
	        }
	        catch (Exception $exc)
	        {
	            $this->unlock("HTTPCommandSend");
	            throw new Exception($exc);
	        }
        $this->unlock("HTTPCommandSend");
        }
        else
        {
			echo "Can not get response \n";
			$this->unlock("HTTPCommandSend");
			//throw new Exception("Can not send to parent",E_USER_NOTICE);
		}	
		
	}
	
	// Input
	public function SaveInputVarmapping($MappingInputs, $AVRType)
		{
			if ($this->GetIDForIdent("InputMapping"))
			{
				$InputsMapping = GetValue($this->GetIDForIdent("InputMapping"));
				if ($InputsMapping !== "")
				{
					$InputsMapping = json_decode($InputsMapping);
					$AVRType = $InputsMapping->AVRType;
					$writeprotected = $InputsMapping->writeprotected;
					if(!$writeprotected)
					{
						SetValue($this->GetIDForIdent("InputMapping"), $MappingInputs);
					}
				}
				else
				{
					SetValue($this->GetIDForIdent("InputMapping"), $MappingInputs);
				}	
				
			}
					
			SetValue($this->GetIDForIdent("AVRType"), $AVRType); 		
		}

	public function GetInputVarMapping()
		{
			$InputsMapping = GetValue($this->GetIDForIdent("InputMapping"));
			$InputsMapping = json_decode($InputsMapping);
			//Varmapping generieren
			$AVRType = $InputsMapping->AVRType;
			$writeprotected = $InputsMapping->writeprotected;
			$Inputs = $InputsMapping->Inputs;
			$Varmapping = array();
			foreach ($Inputs as $Key => $Input)
				{
				$Command = $Input->Source;
				if ($Command == "CBL/SAT")
				{
					$Command = "SAT/CBL";
				}
				elseif ($Command == "MediaPlayer")
				{
					$Command = "MPLAY";
				}
				elseif ($Command == "iPod/USB")
				{
					$Command = "USB/IPOD";
				}
				elseif ($Command == "TVAUDIO")
				{
					$Command = "TV";
				}
				elseif ($Command == "Bluetooth")
				{
					$Command = "BT";
				}
				elseif ($Command == "Blu-ray")
				{
					$Command = "BD";
				}
				elseif ($Command == "Online Music")
				{
					$Command = "NET";
				}
				$Varmapping[$Command] = $Key;
				}
			return $Varmapping;
		}
	
	protected function GetAVRType()
		{
			$GetAVRType = GetValue($this->GetIDForIdent("AVRType"));
			return $GetAVRType;
		}	
	
	################## SEMAPHOREN Helper  - private

    private function lock($ident)
    {
        for ($i = 0; $i < 3000; $i++)
        {
            if (IPS_SemaphoreEnter("DENONAVRT_" . (string) $this->InstanceID . (string) $ident, 1))
            {
                return true;
            }
            else
            {
                IPS_Sleep(mt_rand(1, 5));
            }
        }
        return false;
    }

    private function unlock($ident)
    {
          IPS_SemaphoreLeave("DENONAVRT_" . (string) $this->InstanceID . (string) $ident);
    }
	

}

?>