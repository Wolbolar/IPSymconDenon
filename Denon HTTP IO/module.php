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
		$this->RegisterPropertyInteger("UpdateInterval", 5);
		
             
    }

    public function ApplyChanges()
    {
	//Never delete this line!
        parent::ApplyChanges();
        $change = false;

		//$this->RegisterVariableString("BufferIN", "BufferIN", "", 1);
        //$this->RegisterVariableString("CommandOut", "CommandOut", "", 2);
        //IPS_SetHidden($this->GetIDForIdent('CommandOut'), true);
        //IPS_SetHidden($this->GetIDForIdent('BufferIN'), true);
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

	protected function RegisterTimer($ident, $interval, $script) {
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

################## Datapoints
 
	
		
			
	################## DATAPOINT RECEIVE FROM CHILD
	

	public function ForwardData($JSONString)
	{
	 
		// Empfangene Daten von der Splitter Instanz
		$data = json_decode($JSONString);
		IPS_LogMessage("ForwardData Denon HTTP Splitter", utf8_decode($data->Buffer));
	 
		// Hier würde man den Buffer im Normalfall verarbeiten
		// z.B. CRC prüfen, in Einzelteile zerlegen
		try
		{
			// Absenden an Denon AVR
		
			SetValue($this->GetIDForIdent("BufferIN"), $data->Buffer);
		
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
		//Daten abholen
		$DenonStatus = new DENON_StatusHTML;
		$ipdenon = $this->ReadPropertyString("Host");
		$DenonStatus->ipdenon = $ipdenon;
		//Zone auslesen
		$Zone = 0;
		$data = $DenonStatus->getStates ($Zone);
		//Valuewert für Variable übergeben
		$JSONString = json_encode($data);
		$this->SendJSON($JSONString);
		return $data;
	}
	
	protected function SendJSON ($JSONString)
	{
		$data = json_decode($JSONString);
		
		// Weiterleitung zu allen Gerät-/Device-Instanzen
		$this->SendDataToChildren(json_encode(Array("DataID" => "{E73CE1D0-6670-4607-ACA1-30469558D2F7}", "Buffer" => $data))); //Denon I/O HTTP RX GUI
	}
	
	protected function SendCommand ($command)
	{
		$ip = $this->ReadPropertyString("Host");
		//Ins URL Format bringen
		$command = urlencode ($command);
		$response = file_get_contents("http://".$ip."/goform/formiPhoneAppDirect.xml?".$command);
		IPS_LogMessage("Denon AVR Command:", $command." gesendet."); 
		
		IPS_Sleep(900);   
		$this->GetStatus ();
	}
	
	
	

}

?>