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
		
        $this->RegisterPropertyString("Host", "");
             
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
		$this->SetStatus(102);			
		
		}
	else
			{
			$this->SetStatus(204); //IP Adresse ist ungültig 
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
			//
		}
		catch (Exception $ex)
		{
			echo $ex->getMessage();
			echo ' in '.$ex->getFile().' line: '.$ex->getLine().'.';
		}
	 
		// Absenden an Denon AVR
		//$resultat = $this->SendDataToParent(json_encode(Array("DataID" => "{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}", "Buffer" => $data->Buffer))); //TX GUI
		SetValue($this->GetIDForIdent("BufferIN"), $data->Buffer);
		
		$command = $data->Buffer;
		$this->SendCommand ($command);
		
		// Weiterverarbeiten und durchreichen
		//return $resultat;
	 
	}
	
	protected function GetStatus ()
	{
		// Empfangene Daten vom Denon AVR Receiver
		
		
		$JSONString = '{"PW":true,"SI":6}';
		IPS_LogMessage("Status Denon AVR Receiver", utf8_decode($JSONString)); //utf8_decode muss string sein
		$data = json_decode($JSONString);
		
	 
		
	 
		// Weiterleitung zu allen Gerät-/Device-Instanzen
		$this->SendDataToChildren(json_encode(Array("DataID" => "{E73CE1D0-6670-4607-ACA1-30469558D2F7}", "Buffer" => $data))); //Denon I/O HTTP RX GUI
	}
	
	protected function SendCommand ($command)
	{
		$ip = $this->ReadPropertyString("Host");
		//Ins URL Format bringen
		$command = urlencode ($command);
		echo $command;
		//$response = file_get_contents("http://".$ip."/goform/formiPhoneAppDirect.xml?".$command);
		IPS_LogMessage("Status Denon AVR Receiver", $command." gesendet."); 
		//print_r($response);
		
		$this->GetStatus ();
	}
	
	
	

}

?>