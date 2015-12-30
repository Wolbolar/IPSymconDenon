<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonAVR extends IPSModule
{

   
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // 1. Verfügbarer DenonSplitter wird verbunden oder neu erzeugt, wenn nicht vorhanden.
        $this->ConnectParent("{9AE3087F-DC25-4ADB-AB46-AD7455E71032}");
		
		
		$this->RegisterPropertyBoolean("Display", false);
		$this->RegisterPropertyBoolean("Control", false);
		$this->RegisterPropertyBoolean("Zone2", false);
		$this->RegisterPropertyBoolean("Zone3", false);
		
		
    }


    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();
		
		// ITFamilyCode und ITDeviceCode prüfen
        $Display = $this->ReadPropertyBoolean('Display');
		$Control = $this->ReadPropertyBoolean('Control');
		$Zone2 = $this->ReadPropertyBoolean('Zone2');
		$Zone3 = $this->ReadPropertyBoolean('Zone3');
		
		// Status aktiv
		$this->SetStatus(102);
		$this->SetupVar();
		$this->SetupProfiles();
		
	}
		
	/**
    * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
    * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
    *
	* PUBLIC
    */
	protected function SetupVar()
	{
		//Generelle-Variablen anlegen
		$stateId = $this->RegisterVariableBoolean("STATE", "Status", "~Switch", 1);
		$this->EnableAction("STATE");
					
		// Variablen bei Control anlegen
		/*
		$ITType = $this->ReadPropertyString('ITType');
		if ($ITType === "Dimmer")
			{
			$this->RegisterVariableInteger("Dimmer", "Dimmer", "IntertechnoDimmer.AIOIT", 2);
			$this->EnableAction("Dimmer");
			}
		*/	
	}
	
	protected function SetupProfiles()
	{
		// Profile anlegen
		/*
		$this->RegisterProfileIntegerEx("IntertechnoDimmer.AIOIT", "Intensity", "", "", Array
			(
				Array(0, "0 %",  "", -1),
				Array(1, "10 %",  "", -1),
				Array(2, "20 %",  "", -1),
				Array(3, "30 %",  "", -1),
				Array(4, "40 %",  "", -1),
				Array(5, "50 %",  "", -1),
				Array(6, "60 %",  "", -1),
				Array(7, "70 %",  "", -1),
				Array(8, "80 %",  "", -1),
				Array(9, "90 %",  "", -1),
				Array(10, "100 %", "", -1)
			));
			*/
	}
	
	
	public function RequestAction($Ident, $Value)
    {
        switch($Ident) {
            case "STATE":
                $this->PowerSetState($Value);
				$ITType = $this->ReadPropertyString('ITType');
				if ($Value === true && $ITType === "Dimmer")
					{
					SetValueInteger($this->GetIDForIdent('Dimmer'), 10);
					}
				elseif ($Value === false && $ITType === "Dimmer")
					{
					SetValueInteger($this->GetIDForIdent('Dimmer'), 0);
					}
				break;
			case "Dimmer":
                switch($Value) {
                    case 0: //0
						$state = false; 
                        SetValueBoolean($this->GetIDForIdent('STATE'), $state);
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
						$this->PowerOff();
                        break;
                    case 1: //10
                        $this->Set10();
                        SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
						break;
                    case 2: //20
                        $this->Set20();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
                    case 3: //30
                        $this->Set30();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
                    case 4: //40
                        $this->Set40();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
					case 5: //50
                        $this->Set50();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
					case 6: //60
                        $this->Set60();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
					case 7: //70
                        $this->Set70();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
					case 8: //80
                        $this->Set80();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
					case 9: //90
                        $this->Set90();
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
                        break;
					case 10: //100
                        $state = true; 
						SetValueBoolean($this->GetIDForIdent('STATE'), $state);
						SetValueInteger($this->GetIDForIdent('Dimmer'), $Value);
						$this->PowerOn();
                        break;		
                }
                break;	
            default:
                throw new Exception("Invalid ident");
        }
    }
	
	
	
	protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);//array
		return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;//ConnectionID
    }
	
		
	//IP Denon 
	protected function GetIPDenon(){
		$ParentID = $this->GetParent();
		$IPDenon = IPS_GetProperty($ParentID, 'Host');
		return $IPDenon;
	}
	
	protected function PowerSetState ($state){
	SetValueBoolean($this->GetIDForIdent('STATE'), $state);
	return $this->SetPowerState($state);	
	}
	
	protected function SetPowerState($state) {
		if ($state === true)
		{
		$action = "E";
		return $this->SendCommand($action, $this->GetIPGateway());
		}
		else
		{
		$action = "6";
		return $this->SendCommand($action, $this->GetIPGateway());
		}
	}
	
	   	
	//IT Befehl E schaltet an
	public function PowerOn() {
		SetValueBoolean($this->GetIDForIdent('STATE'), true);
		$action = "E";
		return $this->SendCommand($this->Calculate(), $action, $this->GetIPGateway());
		}
		
	//IT Befehl 6 schaltet aus
	public function PowerOff() {
		SetValueBoolean($this->GetIDForIdent('STATE'), false);
		$action = "6";
		return $this->SendCommand($this->Calculate(), $action, $this->GetIPGateway());
		}
		
	//Senden eines Befehls an Intertechno
	// Sendestring IT /command?XC_FNC=SendSC&type=IT&data=
	private $response = false;
	protected function SendCommand($IT_send, $action, $ip_aiogateway)
	{
		$gwcheck = file_get_contents("http://".$ip_aiogateway."/command?XC_FNC=SendSC&type=IT&data=".$IT_send.$action);
		if ($gwcheck == "{XC_SUC}")
			{
			$this->response = true;	
			}
		return $this->response;
	}
	
	//Dimmen Anschaltbefehl + 00, 10, 20 - F0
	// 00, 10, 20, 30, 40, 50, 60, 70, 80, 90, A0, B0, C0, D0, E0, F0 ? Welche Dimmstufe
	
	// ? - Auf 10% dimmen
	public function Set10() {
		$command = "E00";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }
	
	// ? - Auf 20% dimmen
	public function Set20() {
		$command = "E10";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }
		
	// ? - Auf 30% dimmen
	public function Set30() {
		$command = "E20";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }

	// ? - Auf 40% dimmen
	public function Set40() {
		$command = "E30";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }

	// ? - Auf 50% dimmen
	public function Set50() {
		$command = "E40";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }

	// ? - Auf 60% dimmen
	public function Set60() {
		$command = "E50";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }

	// ? - Auf 70% dimmen
	public function Set70() {
		$command = "E60";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }

	// ? - Auf 80% dimmen
	public function Set80() {
		$command = "E70";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }

	// ? - Auf 90% dimmen
	public function Set90() {
		$command = "E80";
        return $this->SendCommand($this->Calculate(), $command, $this->GetIPGateway());
        }	
	
	
	//Anmelden eines IT Geräts an das a.i.o. gateway:
	//http://{IP-Adresse-des-Gateways}/command?XC_FNC=LearnSC&type=IT
	public function Learn()
		{
		$ip_aiogateway = $this->GetIPGateway();
		$address = file_get_contents("http://".$ip_aiogateway."/command?XC_FNC=LearnSC&type=IT");
		//kurze Pause während das Gateway im Lernmodus ist
		IPS_Sleep(1000); //1000 ms
		if ($address == "{XC_ERR}Failed to learn code")//Bei Fehler
			{
			$this->response = false;
			$instance = IPS_GetInstance($this->InstanceID)["InstanceID"];
			$address = "Das Gateway konnte keine Adresse empfangen.";
			IPS_LogMessage( "IT Adresse:" , $address );
			echo "Die Adresse vom IT Gerät konnte nicht angelernt werden.";
			IPS_SetProperty($instance, "LearnITCode", false); //Haken entfernen.			
			}
		else
			{
				//Adresse auswerten {XC_SUC}
				//bei Erfolg {XC_SUC}{"CODE":"03"} 
				(string)$address = substr($address, 17, 2);
				IPS_LogMessage( "IT Adresse:" , $address );
				//echo "Adresse des IT Geräts: ".$address;
				// Anpassen der Daten
				$address = str_split($address);
				$ITDeviceCode = $address[1]+1; //Devicecode auf Original umrechen +1
				$ITFamilyCode = $address[0]; // Zahlencode in Buchstaben Familencode umwandeln
				$hexsend = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$itfc = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J");
				$ITFamilyCode = str_replace($hexsend, $itfc, $ITFamilyCode);
				$this->AddAddress($ITFamilyCode, $ITDeviceCode);
				$this->response = true;	
			}
		
		return $this->response;
		}
	
	//IT Adresse hinzufügen
	protected function AddAddress($ITFamilyCode, $ITDeviceCode)
	{
		$instance = IPS_GetInstance($this->InstanceID)["InstanceID"];
		IPS_SetProperty($instance, "ITFamilyCode", $ITFamilyCode); //ITFamilyCode setzten.
		IPS_SetProperty($instance, "ITDeviceCode", $ITDeviceCode); //ITDeviceCode setzten.
		IPS_SetProperty($instance, "LearnITCode", false); //Haken entfernen.
		IPS_ApplyChanges($instance); //Neue Konfiguration übernehmen
		IPS_LogMessage( "IT Adresse hinzugefügt:" , $address );
		// Status aktiv
		$this->SetStatus(102);
		$this->SetupVar();
		$this->SetupProfiles();	
	}

	
	/*
	public function Request($path) {
		$host = $this->ReadPropertyString('Host');
		if ($host == '') {
		  $this->SetStatus(104);
		  return false;
		}
		$client = curl_init();
		curl_setopt($client, CURLOPT_URL, "http://{$host}$path");
		curl_setopt($client, CURLOPT_POST, false);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_USERAGENT, "SymconAIO");
		curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($client, CURLOPT_TIMEOUT, 5);
		$result = curl_exec($client);
		$status = curl_getinfo($client, CURLINFO_HTTP_CODE);
		curl_close($client);
		if ($status == '0') {
		  $this->SetStatus(201);
		  return false;
		} elseif ($status != '200') {
		  $this->SetStatus(201);
		  return false;
		} else {
		  $this->SetStatus(102);
		  return simplexml_load_string($result);
		}
		}
		*/
	
	protected function RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize) {
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 1);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 1)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	protected function RegisterProfileIntegerEx($Name, $Icon, $Prefix, $Suffix, $Associations) {
        if ( sizeof($Associations) === 0 ){
            $MinValue = 0;
            $MaxValue = 0;
        } else {
            $MinValue = $Associations[0][0];
            $MaxValue = $Associations[sizeof($Associations)-1][0];
        }
        
        $this->RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, 0);
        
        foreach($Associations as $Association) {
            IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
        }
        
    }	
		

}

?>