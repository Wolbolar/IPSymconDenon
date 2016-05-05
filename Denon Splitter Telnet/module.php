<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonSplitterTelnet extends IPSModule
{

    public function Create()
    {
	//Never delete this line!
        parent::Create();
		
		//These lines are parsed on Symcon Startup or Instance creation
        //You cannot use variables here. Just static values.
		// ClientSocket benötigt
        $this->RequireParent("{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}", "DenonAVR Telnet"); //Clientsocket

        
		$this->RegisterPropertyString("Host", "192.168.x.x");
		$this->RegisterPropertyInteger("Port", 23);
        $this->RegisterPropertyBoolean("Open", false);
		$this->RegisterPropertyInteger("UpdateInterval", 30);
     
    }

    public function ApplyChanges()
    {
	//Never delete this line!
        parent::ApplyChanges();
        $change = false;

		$this->RegisterVariableString("BufferIN", "BufferIN", "", 1);
        $this->RegisterVariableString("CommandOut", "CommandOut", "", 2);
		$this->RegisterVariableString("IOIN", "IOIN", "", 3);
        IPS_SetHidden($this->GetIDForIdent('CommandOut'), true);
        IPS_SetHidden($this->GetIDForIdent('BufferIN'), true);
		IPS_SetHidden($this->GetIDForIdent('IOIN'), true);
		$this->RegisterVariableString("InputMapping", "Input Mapping", "", 4);
        IPS_SetHidden($this->GetIDForIdent('InputMapping'), true);
		$this->RegisterVariableString("AVRType", "AVRType", "", 5);
        IPS_SetHidden($this->GetIDForIdent('AVRType'), true);
	
		//IP Prüfen
		$ip = $this->ReadPropertyString('Host');
		if (!filter_var($ip, FILTER_VALIDATE_IP) === false)
			{
			
			// Zwangskonfiguration des ClientSocket
			$ParentID = $this->GetParent();
			if (!($ParentID === false))
				{
					if (IPS_GetProperty($ParentID, 'Host') <> $this->ReadPropertyString('Host'))
					{
						IPS_SetProperty($ParentID, 'Host', $this->ReadPropertyString('Host'));
						$change = true;
					}
					if (IPS_GetProperty($ParentID, 'Port') <> $this->ReadPropertyInteger('Port'))
					{
						IPS_SetProperty($ParentID, 'Port', $this->ReadPropertyInteger('Port'));
						$change = true;
					}
					$ParentOpen = $this->ReadPropertyBoolean('Open');
					
			// Keine Verbindung erzwingen wenn IP leer ist, sonst folgt später Exception.
					if (!$ParentOpen)
						$this->SetStatus(104);

					if ($this->ReadPropertyString('Host') == '')
					{
						if ($ParentOpen)
							$this->SetStatus(202);
						$ParentOpen = false;
					}
					if (IPS_GetProperty($ParentID, 'Open') <> $ParentOpen)
					{
						IPS_SetProperty($ParentID, 'Open', $ParentOpen);
						$change = true;
					}
					if ($change)
						@IPS_ApplyChanges($ParentID);
				}
			}	
		else
			{
			$this->SetStatus(204); //IP Adresse ist ungültig 
			}
			
		// Wenn I/O verbunden ist
        if (($this->ReadPropertyBoolean('Open'))
                and ( $this->HasActiveParent($this->GetParent())))
        {
            //Instanz aktiv
        }
		$this->RegisterTimer('Update', $this->ReadPropertyString('UpdateInterval'), 'DAVRST_GetStatusHTTP($id)');
    }

		/**
        * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
        * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
        *
        *
        */
    
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
################## DUMMYS / WOARKAROUNDS - protected

    protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);
        return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;
    }
	
	
    protected function HasActiveParent($ParentID)
    {
        if ($ParentID > 0)
        {
            $parent = IPS_GetInstance($ParentID);
            if ($parent['InstanceStatus'] == 102)
            {
                $this->SetStatus(102);
                return true;
            }
        }
        $this->SetStatus(203);
        return false;
    }
	
	public function GetStatusHTTP ()
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
								
				// Weiterleitung zu allen Gerät-/Device-Instanzen
				$this->SendDataToChildren(json_encode(Array("DataID" => "{7DC37CD4-44A1-4BA6-AC77-58369F5025BD}", "Buffer" => $data))); //Denon Telnet Splitter Interface GUI
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
	
    protected function RequireParent($ModuleID, $Name = '')
    {

        $instance = IPS_GetInstance($this->InstanceID);
        if ($instance['ConnectionID'] == 0)
        {

            $parentID = IPS_CreateInstance($ModuleID);
            $instance = IPS_GetInstance($parentID);
            if ($Name == '')
                IPS_SetName($parentID, $instance['ModuleInfo']['ModuleName']);
            else
                IPS_SetName($parentID, $Name);
            IPS_ConnectInstance($this->InstanceID, $parentID);
        }
    }

    private function SetValueBoolean($Ident, $value)
    {
        $id = $this->GetIDForIdent($Ident);
        if (GetValueBoolean($id) <> $value)
        {
            SetValueBoolean($id, $value);
            return true;
        }
        return false;
    }

    private function SetValueInteger($Ident, $value)
    {
        $id = $this->GetIDForIdent($Ident);
        if (GetValueInteger($id) <> $value)
        {
            SetValueInteger($id, $value);
            return true;
        }
        return false;
    }

    private function SetValueString($Ident, $value)
    {
        $id = $this->GetIDForIdent($Ident);
        if (GetValueString($id) <> $value)
        {
            SetValueString($id, $value);
            return true;
        }
        return false;
    }

    protected function SetStatus($InstanceStatus)
    {
        if ($InstanceStatus <> IPS_GetInstance($this->InstanceID)['InstanceStatus'])
            parent::SetStatus($InstanceStatus);
    }
	
	protected function GetAVRType()
		{
			$GetAVRType = GetValue($this->GetIDForIdent("AVRType"));
			return $GetAVRType;
		}
	
	// Display NSE, NSA, NSH noch ergänzen
	
	//Tuner ergänzen
	

################## Datapoints

	
	// Data an Child weitergeben
	public function ReceiveData($JSONString)
	{
	 
		// Empfangene Daten vom I/O
		$payload = json_decode($JSONString);
		$dataio = $payload->Buffer;
		SetValueString($this->GetIDForIdent("IOIN"), $dataio);
		$data = preg_split('/\r/', $dataio);
		array_pop($data);
		$APIData = new DenonAVRCP_API_Data();
		$APIData->Data = $data;
		$APIData->AVRProtocol = "Telnet";
		$InputMapping = $this->GetInputVarMapping();
		$SetCommand = $APIData->GetCommandResponse($APIData->Data, $InputMapping);
		$message = json_encode($SetCommand);
		SetValueString($this->GetIDForIdent("BufferIN"), $message);
			 
		// Weiterleitung zu allen Gerät-/Device-Instanzen
		$this->SendDataToChildren(json_encode(Array("DataID" => "{7DC37CD4-44A1-4BA6-AC77-58369F5025BD}", "Buffer" => $SetCommand))); //Denon Telnet Splitter Interface GUI
	}
	
	
	################## DATAPOINT RECEIVE FROM CHILD
		
	public function ForwardData($JSONString)
	{
	 
		// Empfangene Daten von der Device Instanz
		$data = json_decode($JSONString);
		$datasend = $data->Buffer;
		SetValueString($this->GetIDForIdent("CommandOut"), $datasend);
			 
		// Hier würde man den Buffer im Normalfall verarbeiten
		// z.B. CRC prüfen, in Einzelteile zerlegen
		try
		{
			// Weiterleiten zur I/O Instanz
			$resultat = $this->SendDataToParent(json_encode(Array("DataID" => "{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}", "Buffer" => $data->Buffer))); //TX GUID
			
			// Test Daten speichern
			//SetValue($this->GetIDForIdent("BufferIN"), $data->Buffer);
		}
		catch (Exception $ex)
		{
			echo $ex->getMessage();
			echo ' in '.$ex->getFile().' line: '.$ex->getLine().'.';
		}
	 
		
		
		// Weiterverarbeiten und durchreichen
		return $resultat;
	 
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