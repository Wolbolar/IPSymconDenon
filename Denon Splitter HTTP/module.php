<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonSplitterHTTP extends IPSModule
{

    public function Create()
    {
	//Never delete this line!
        parent::Create();
		
		//These lines are parsed on Symcon Startup or Instance creation
        //You cannot use variables here. Just static values.
		// ClientSocket benötigt
        //$this->RequireParent("{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}", "DenonAVR HTTP"); //Clientsocket
		$this->RequireParent("{6CC8F890-06DF-4A0E-9C7F-484D04101C8D}", "DenonAVR HTTP"); //Denon HTTP Socket	

        $this->RegisterPropertyString("Host", "192.168.x.x");
		//$this->RegisterPropertyInteger("Port", 80);
        $this->RegisterPropertyBoolean("Open", false);
     
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
		$this->RegisterVariableString("InputMapping", "Input Mapping", "", 4);
        IPS_SetHidden($this->GetIDForIdent('InputMapping'), true);
		
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
				/*
				if (IPS_GetProperty($ParentID, 'Port') <> $this->ReadPropertyInteger('Port'))
				{
					IPS_SetProperty($ParentID, 'Port', $this->ReadPropertyInteger('Port'));
					$change = true;
				}
				*/
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
				//IO Denon HTTP Open
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
               and ( $this->HasActiveParent($ParentID)))
		{
            //Instanz aktiv
		}

    }

		/**
        * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
        * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
        *
        *
        */

// Input
public function SaveInputVarmapping($MappingInputs)
	{
		SetValue($this->GetIDForIdent("InputMapping"), $MappingInputs); 
	}

public function GetInputVarmapping()
	{
		$InputsMapping = GetValue($this->GetIDForIdent("InputMapping"));
		$InputsMapping = json_decode($InputsMapping);
		return $InputsMapping;
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

	
	// Data an Child weitergeben
	public function ReceiveData($JSONString)
	{
	 
		// Empfangene Daten vom Denon HTTP I/O
		$data = json_decode($JSONString);
		$dataio = json_encode($data->Buffer);
		SetValueString($this->GetIDForIdent("BufferIN"), $dataio);
		
		
		//IPS_LogMessage("ReceiveData Denon HTTP Splitter", utf8_decode($data->Buffer)); //utf8_decode geht nur bei string
	 
		// Hier werden die Daten verarbeitet
	 
		// Weiterleitung zu allen Gerät-/Device-Instanzen
		$this->SendDataToChildren(json_encode(Array("DataID" => "{D9209251-0036-48C2-AF96-9F5EDE761A52}", "Buffer" => $data->Buffer))); //Denon HTTP Splitter Interface GUI
	}
	
			
	################## DATAPOINT RECEIVE FROM CHILD
	

	public function ForwardData($JSONString)
	{
	 
		// Empfangene Daten von der Device Instanz
		$data = json_decode($JSONString);
		IPS_LogMessage("ForwardData Denon HTTP Splitter", utf8_decode($data->Buffer));
		$datasend = $data->Buffer;
		SetValueString($this->GetIDForIdent("CommandOut"), $datasend);
	 
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
	 
		// Weiterleiten zur I/O Instanz
		$resultat = $this->SendDataToParent(json_encode(Array("DataID" => "{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}", "Buffer" => $data->Buffer))); //TX GUI
	 
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