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

		$this->RegisterVariableString("BufferIN", "BufferIN", "", 1);
        $this->RegisterVariableString("CommandOut", "CommandOut", "", 2);
        IPS_SetHidden($this->GetIDForIdent('CommandOut'), true);
        IPS_SetHidden($this->GetIDForIdent('BufferIN'), true);
	//IP Prüfen
		$ip = $this->ReadPropertyString('Host');
	if (!filter_var($ip, FILTER_VALIDATE_IP) === false)
		{
		$Open = $this->ReadPropertyBoolean('Open');
		if (!$ParentOpen)
			$this->SetStatus(104);

		if ($this->ReadPropertyString('Host') == '')
					{
						if ($ParentOpen)
							$this->SetStatus(202);
						$ParentOpen = false;
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
	//$this->RegisterTimer('Update', $this->ReadPropertyString('UpdateInterval'), 'DAVRIO_GetStatus($id)');
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
		
	protected function GetStatus ()
	{
		// Empfangene Daten vom Denon AVR Receiver
		//Daten abholen
		$DenonStatus = new DENON_StatusHTML;
		$ipdenon = $this->ReadPropertyString("IPAddress");
		$DenonStatus->ipdenon = $ipdenon;
		//Zone auslesen
		$Zone = 0;
		$data = $DenonStatus->getStates ($Zone);
		//Valuewert für Variable übergeben
		/*
		$data = array(
		'PW' => array('VarType' => 0, 'Value' => false, 'Name' => 'Power'),
		'ZM' => array('VarType' => 0, 'Value' => false, 'Name' => 'MainZonePower')
		);
		*/
		$JSONString = json_encode($data);
		$this->SendJSON($JSONString);
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
		
		IPS_Sleep(600);   
		$this->GetStatus ();
	}
	
	
	

}

?>