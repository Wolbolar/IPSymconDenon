<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonAVRTelnet extends AVRModule
{

    static $NEO_Parameter = ['PW' => ['DAVRT_Power', 'Power'],
                             'ZM' => ['DAVRT_MainZonePower', 'MainZonePower'],
                             'MU' => ['DAVRT_MainMute', 'Mute'],
                             'Z2POWER' => ['DAVRT_Zone2Power', 'Zone2Power'],
                             'Z3POWER' => ['DAVRT_Zone3Power', 'Zone3Power'],
                             'Z2MU' => ['DAVRT_Zone2Mute', 'Zone 2 Mute'],
                             'Z3MU' => ['DAVRT_Zone3Mute', 'Zone 3 Mute'],
                             'PSDOLVOL' => ['DAVRT_DolbyVolume', 'Dolby Volume'],
                             'PSCINEMA_EQ' => ['DAVRT_CinemaEQ', 'CinemaEQ'],
                             'PSPAN' => ['DAVRT_Panorama', 'Panorama'],
                             'PSDYNEQ' => ['DAVRT_DynamicEQ', 'DynamicEQ'],
                             'PSSWR' => ['DAVRT_Subwoofer', 'Subwoofer'],
                             'PSATT' => ['DAVRT_SubwooferATT', 'SubwooferATT'],
                             'PSFH' => ['DAVRT_FrontHeight', 'FrontHeight'],
                             'PSTONE_CTRL' => ['DAVRT_ToneCTRL', 'ToneCTRL'],
                             'PSAFD' => ['DAVRT_AutoFlagDetectMode', 'Auto Flag Detect Mode'],
                             'PSEFF_O' => ['DAVRT_Effect', 'Effect'],
                             'VSVST' => ['DAVRT_VerticalStretch', 'Vertical Stretch'],
                             'MNMEN' => ['DAVRT_GUIMenu', 'GUI Menu'],
                             'MNSRC' => ['DAVRT_GUISourceSelectMenu', 'GUI Source Select Menu'],
                            ];

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // 1. Verfügbarer DenonSplitter wird verbunden oder neu erzeugt, wenn nicht vorhanden.
        $this->ConnectParent("{9AE3087F-DC25-4ADB-AB46-AD7455E71032}");
		
		$this->RegisterProperties();

        //we will wait until the kernel is ready
        $this->RegisterMessage(0,10100); //IPS_BASE + IPS_KERNELMESSAGE
    }

    public function MessageSink($TimeStamp, $SenderID, $Message, $Data) {
        if ($this->debug){
            IPS_LogMessage(get_class() . '::' . __FUNCTION__,'SenderID: ' . $SenderID . ', Message: ' . $Message . ', Data:'. json_encode($Data));
        }
        switch ($Message){
            case 10100: //IPS_BASE + IPS_KERNELMESSAGE
                if ($Data[0] == 10103){ //KR_READY
                    $this->ApplyChanges();
                }
        }
    }

    private function arrayToObject ($array){
        $object=new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)){
                $object->$key=$this->arrayToObject($value);
            }
            else{
                $object->$key=$value;
            }
        }
        return $object;
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        if (IPS_GetKernelRunlevel() != 10103){ //Kernel ready
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Kernel is not ready ('.IPS_GetKernelRunlevel().')');
            return;
        }

        if ($this->SetInstanceStatus() == true){
            $this->ValidateConfiguration();

            // über http werden zusätliche Daten geholt (MainZoneName, Model)
            $data = $this->GetStateHTTP();
            //das Array muss für die weitere Verrabeitung in ein Object umgewandelt werden
            $data = $this->arrayToObject($data);
            $this->UpdateVariable($data);
        }

    }


	private function ValidateConfiguration(){

        $Zone = $this->ReadPropertyInteger('Zone');
        $manufacturername = $this->GetManufacturerName();
        $AVRType = $this->GetAVRType($manufacturername);
        $DenonAVRVar = new DENONIPSProfiles($AVRType);
        //Input ablegen, damit sie später dem Splitter zur Verfügung stehen
        DAVRST_SaveInputVarmapping($this->GetParent(), json_encode($this->GetInputsAVR($DenonAVRVar)));

        $AVRCaps = AVRs::getCapabilities($AVRType);

        $profiles = $DenonAVRVar->GetAllProfilesSortedByPos();
        $idents = [];

        if ($Zone == 0){//Mainzone

            $idents[DENONIPSProfiles::ptMainZoneName] = $this->ReadPropertyBoolean('ZoneName');
            $idents[DENONIPSProfiles::ptModel] = $this->ReadPropertyBoolean('Model');

            // ReadProperty for all Variables of the following areas

            $CommandAreas = [
                'PowerFunctions',
                'InputSettings',
                'SurroundMode',
                'CV_Commands',
                'PS_Commands',
                'VS_Commands',
                'PV_Commands',
                'SystemControl_Commands',
            ];

            foreach ($CommandAreas as $commandArea){
                if ($this->testAllProperties){
                    $commandArea_max = $commandArea.'_max';
                    $Caps = AVR::$$commandArea_max;
                } else {
                    $Caps = $AVRCaps[$commandArea];
                }
                foreach ($profiles as $key=>$profile){
                    if (in_array($profile['Ident'], $Caps)){
                        $idents[$key] = $this->ReadPropertyBoolean($profile['PropertyName']);
                    }
                }
            }

        } else { //Zone 2 oder 3

            // ReadProperty of CommandArea 'Zone_Commands'
            foreach ($profiles as $key=>$profile){
                if (in_array($profile['Ident'], $AVRCaps['Zone_Commands'])){
                    // if it is a zone specific Command
                    if (in_array(substr($profile['Ident'], 0, 2), ['Z2', 'Z3'])
                        || in_array(substr($profile['Ident'], 0, 5), ['Zone2', 'Zone3'])){

                        //select only the idents of the current zone
                        if ((substr($profile['Ident'], 0, 2) == 'Z'.($Zone + 1))
                            || (substr($profile['Ident'], 0, 5) == 'Zone'.($Zone + 1))){
                            $idents[$key] = $this->ReadPropertyBoolean($profile['PropertyName']);
                        }

                    } else {
                        $idents[$key] = $this->ReadPropertyBoolean($profile['PropertyName']);
                    }
                }
            }

		}

        $this->RegisterVariables($DenonAVRVar, $idents, $AVRType, $manufacturername);

        // NEO Skripte anlegen
        if ($this->ReadPropertyBoolean('NEOToggle')){
            $this->CreateNEOScripts(static::$NEO_Parameter);
        }

		// Alexa Links anlegen
        if ($this->ReadPropertyBoolean('Alexa')){
            $this->CreateAlexaLinks($manufacturername, $AVRType, $Zone);
        } else {
            $this->DeleteAlexaLinks($manufacturername, $AVRType, $Zone);
        }
	}


    /**
     * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
     * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
     *
     */

    public function GetStates()
	{
		$AVRVarIDs = IPS_GetChildrenIDs ($this->InstanceID);

		if (count($AVRVarIDs) == 0){
		    //nothing to do
		    return;
        }
		
		//Array Ident erzeugen
		$AVRCommands = [];
		
		foreach ($AVRVarIDs as $ObjektID)
		{
            $ObjektIDInfo = IPS_GetObject($ObjektID);
            //Hidden nicht abfragen
            if (!$ObjektIDInfo["ObjectIsHidden"]){
                $Ident = $ObjektIDInfo["ObjectIdent"];
                //spezielle Elemente ebenfalls nicht abfragen
                if (!in_array($Ident, ["MN", "MNMEN", "MNSRC", "MainZoneName", "Model", "SurroundDisplay"])){
                    $AVRCommands[] = $Ident;
                }
            }
		}

        //collect all commands
        $Commands = [];
        foreach ((new DENONIPSProfiles())->GetAllProfiles() as $profile){
            if (in_array($profile['Ident'], $AVRCommands)){
                if (isset($profile['IndividualStatusRequest'])){
                    $Commands[] = $profile['IndividualStatusRequest'];
                } else {
                    $Commands[] = $profile['Ident'].' ?';
                }
            }
        }

        //eliminate duplicates and call each command
        foreach (array_unique($Commands) as $Command){
            $this->SendCommand($Command);
            IPS_Sleep(200); //Doku: responses should be sent within 200ms of receiving the command
        }

        // über http werden zusätliche Daten geholt (MainZoneName, Model)
        $data = $this->GetStateHTTP();
        //das Array muss für die weitere Verrabeitung in ein Object umgewandelt werden
        $data = $this->arrayToObject($data);
        $this->UpdateVariable($data);

    }

	public function RequestAction($Ident, $Value)
    {

        //Input übergeben
        $InputMapping = DAVRST_GetInputVarMapping($this->GetParent());
        IPS_LogMessage(get_class().'::'.__FUNCTION__, 'InputMapping: '.json_encode($InputMapping));

        //Command aus Ident
        $APICommand = $this->GetAPICommandFromIdent($Ident);

        // Subcommand holen
        $AVRType = $this->GetAVRType($this->GetManufacturerName());
        $APISubCommand = (new DENONIPSProfiles($AVRType, $InputMapping))->GetSubCommandOfValue($Ident, $Value);
		IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Ident: '.$Ident.', Value: '.$Value.', SubCommand: '.$APISubCommand);

		if($this->debug){
			IPS_LogMessage('Denon Telnet AVR', "Denon Subcommand: ".$APISubCommand);
		}
        
		
		
        // Daten senden
        try
        {
			$this->SendCommand($APICommand.$APISubCommand);
					
			//bei Commands ohne automatischen Response wird noch ein Request abgesetzt (<command>+?), damit die Variablen nachgeführt werden
            //todo: gibt es Variablen, die nachgeführt werden müssen, da sie sonst nicht aktualisiert werden?
			if ($APICommand == "PSVOLLEV"){         // Dolby Volume Leveler
			    $this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSVOLMOD"){   // Dolby Volume Modeler
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSDCO"){      // Dynamic Compressor
			    $this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSDRC"){      // Dynamic Range Compression
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSPAN"){      //Panorama
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSDYNEQ"){    //Dynamic EQ
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSAFD"){      //
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "VSAUDIO"){
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSRSZ"){      // Room Size
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "VSSC"){       //Resolution
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "VSSCH"){      //Resolution HDMI
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "PSSWR"){      //Subwoofer
				$this->SendRequest($APICommand, true);
			} elseif ($APICommand == "Z2"){         //Z2
				$this->SendRequest($APICommand, false);
			} elseif ($APICommand == "Z3"){         //Z3
				$this->SendRequest($APICommand, false);
            } elseif ($APICommand == "MU"){         //MU
                $this->SendRequest($APICommand, false);
            } elseif ($APICommand == "PSFRONT"){    //Front Speaker
                $this->SendRequest($APICommand, false);
            } elseif ($APICommand == "PSSP"){    //Effect Speaker Selection
                $this->SendRequest($APICommand.':', true);
            } elseif ($APICommand == "PSFH"){    //Effect Speaker Selection
                $this->SendRequest($APICommand.':', true);
            } elseif ($APICommand == "PSDIM"){    //Effect Speaker Selection
                $this->SendRequest($APICommand, true);
            }

        } 
		catch (Exception $ex)
        {
            trigger_error($ex->getMessage(). ', Code: '. $ex->getCode());
            echo $ex->getMessage();
            return false;
        }

		return true;
    }


    private function SendRequest($APICommand, $Space)
	{
		IPS_Sleep(30);
		if ($Space){
			$APISubCommand = chr(32).'?';
		} else {
			$APISubCommand = '?';
		}
		$this->SendCommand($APICommand.$APISubCommand);
	}

	//Data Transfer
	public function SendCommand(string $payload)
		{
			$sendcommand = $payload.chr(13);
			$this->SendDebug("Send Command Telnet:",print_r($sendcommand,true),0);
			$this->SendDataToParent(json_encode(Array("DataID" => "{01A68655-DDAF-4F79-9F35-65878A86F344}", "Buffer" => $sendcommand))); //Denon AVR Telnet Interface GUI
		}
	


	//Get Status HTTP 
	public function GetStateHTTP(){
        $AVRType = $this->GetAVRType($this->GetManufacturerName());

		$DenonGet = new DENON_StatusHTML;
		$InputMapping = DAVRST_GetInputVarMapping($this->GetParent());
        return $DenonGet->getStates ($this->GetIPParent(), $InputMapping, $AVRType);
	}

	######################### Denon Commands #######################################
	//Power
	public function Power(bool $Value){ // false (Standby) oder true (On)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PW, $Value);
		$this->SendCommand(DENON_API_Commands::PW.$SubCommand);
	}
	
	//Mainzone Power
	public function MainZonePower(bool $Value){ // MainZone true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::ZM, $Value);
		$this->SendCommand(DENON_API_Commands::ZM.$SubCommand);
	}
	
	//Mainzone Standby Setting
	public function MainzoneAutoStandbySetting(int $Value){ // 0 (Off) / 15 / 30 / 60 (Minuten)
		switch ($Value){
		    case 0:
				$subcommand = DENON_API_Commands::STBYOFF;
                break;
		    case 15:
				$subcommand = DENON_API_Commands::STBY15M;
                break;
		    case 30:
				$subcommand = DENON_API_Commands::STBY30M;
                break;
            case 60:
				$subcommand = DENON_API_Commands::STBY60M;
                break;
            default:
                trigger_error(__FUNCTION__.': unsupported Value: '.$Value);
                return false;
			}

		$this->SendCommand(DENON_API_Commands::STBY.$subcommand);
		return true;
	}
	
	//Mainzone Standby Setting
	public function MainzoneEcoModeSetting(string $Value){ // On / Auto / Off
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::ECO, $Value);
		$this->SendCommand(DENON_API_Commands::ECO.$SubCommand);
	}
		
	//Master Volume
	public function MasterVolume(string $command){ // "UP" or "DOWN"
		$payload = DENON_API_Commands::MV.$command;
		$this->SendCommand($payload);
	}
	
	public function MasterVolumeStep(string $command, float $step) // "UP" or "DOWN" , Step Schrittweite der Lautstärke Änderung Minimum 0.5
	{
		if($step < 1 || $step > 40)
		{
			$message = "Schrittweite muss zwischen 1 und 40 liegen";
			echo $message;
			$this->SendDebug("Fehlerhafter Eingabewert:",$message,0);
			return; 
		}
		$valmax = 18;
		$valmin = -80;
		$currentvol = GetValueFloat($this->GetIDForIdent("MV"));
        $Value = $currentvol;
		if($command == "UP" && ($currentvol < ($valmax-$step))){
			 $Value = $currentvol + $step;
		}
		if($command == "DOWN" && ($currentvol > ($valmin+$step))){
			 $Value = $currentvol - $step;
		}

		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MV, $Value);
		$this->SendCommand(DENON_API_Commands::MV.$SubCommand);
	}
	
	public function MasterVolumeFix(float $Value){ // float -80 bis 18 Schrittweite 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MV, $Value);
		$this->SendCommand(DENON_API_Commands::MV.$SubCommand);
	}
	
	//Main Mute
	public function MainMute(bool $Value){ // false (Off) oder true (On)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MU, $Value);
		$this->SendCommand(DENON_API_Commands::MU.$SubCommand);
	}

    //Input
    public function Input(string $command){
        $this->SendCommand(DENON_API_Commands::SI.$command);
    }

    //Surround Mode
    public function SurroundMode(string $command){
        $this->SendCommand(DENON_API_Commands::MS.$command);
    }

    //All Zone Stereo
	public function AllZoneStereo(bool $Value) // false (Off) oder true (On)
	{
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MNZST, $Value);
		$this->SendCommand(DENON_API_Commands::MNZST.$SubCommand);
	}

	//Get Display NSADisplay
	public function NSADisplay(){
		$this->SendCommand(DENON_API_Commands::NSA);
	}
	
	public function NSEDisplay(){
		$this->SendCommand(DENON_API_Commands::NSE);
	}
	
	//Dynamic Volume
	public function DynamicVolume(string $Value){ // Dynamic Volume  Midnight / Evening / Day
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSDYNVOL, $Value);
		$this->SendCommand(DENON_API_Commands::PSDYNVOL.$SubCommand);
	}
	
	//Dolby Volume
	public function DolbyVolume(bool $Value){ // Dolby Volume true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSDOLVOL, $Value);
		$this->SendCommand(DENON_API_Commands::PSDOLVOL.$SubCommand);
	}
	
	//Dolby Volume Modeler
	public function DolbyVolumeModeler(string $Value){ // Dolby Volume Modeler Off / Half / Full
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSVOLMOD, $Value);
		$this->SendCommand(DENON_API_Commands::PSVOLMOD.$SubCommand);
	}
	
	//Dolby Volume Leveler
	public function DolbyVolumeLeveler(string $Value){ // Dolby Volume Leveler Low / Middle / High
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSVOLLEV, $Value);
		$this->SendCommand(DENON_API_Commands::PSVOLLEV.$SubCommand);
	}
	
	//Dynamic Compressor
	public function DynamicCompressor(string $Value){ // Dynamic Compressor Off / Low / Middle / High
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSDCO, $Value);
		$this->SendCommand(DENON_API_Commands::PSDCO.$SubCommand);
	}
	
	//Dynamic Range Compression
	public function DynamicRangeCompression(string $Value){ // Dynamic Range Compression Off / Auto / Low / Middle / High
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSDRC, $Value);
		$this->SendCommand(DENON_API_Commands::PSDRC.$SubCommand);
	}
	
	//Audyssey DSX
	public function AudysseyDSX(string $Value){ // Audyssey DSX Off / Wide (Audyssey DSX ON(Wide)) / Height (Audyssey DSX ON(Height)) / Height/Wide (Audyssey DSX ON(Height/Wide))
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSDSX, $Value);
		$this->SendCommand(DENON_API_Commands::PSDSX.$SubCommand);
	}
		
	//CinemaEQ
	public function CinemaEQ(bool $Value){ // CinemaEQ true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CINEMAEQCOMMAND, $Value);
		$this->SendCommand(DENON_API_Commands::CINEMAEQCOMMAND.$SubCommand);
	}
	
	//Panorama
	public function Panorama(bool $Value){ // Panorama true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSPAN, $Value);
        $this->SendCommand(DENON_API_Commands::PSPAN.$SubCommand);
	}
	
	//Dynamic EQ
	public function DynamicEQ(bool $Value){ // Dynamic EQ true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSDYNEQ, $Value);
        $this->SendCommand(DENON_API_Commands::PSDYNEQ.$SubCommand);
	}
	
	//Channel Volume
	public function ChannelVolumeFL(float $Value){ // Range -12 to 12, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFL, $Value);
        $this->SendCommand(DENON_API_Commands::CVFL.$SubCommand);
	}

	public function ChannelVolumeFR(float $Value){ // Range -12 to 12, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFL, $Value);
		$this->SendCommand(DENON_API_Commands::CVFR.$SubCommand);
	}

	public function ChannelVolumeC(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVC, $Value);
		$this->SendCommand(DENON_API_Commands::CVC.$SubCommand);
	}

	public function ChannelVolumeSW(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSW, $Value);
		$this->SendCommand(DENON_API_Commands::CVSW.$SubCommand);
	}
	
	public function ChannelVolumeSW2(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSW2, $Value);
		$this->SendCommand(DENON_API_Commands::CVSW2.$SubCommand);
	}

	public function ChannelVolumeSL(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSL, $Value);
		$this->SendCommand(DENON_API_Commands::CVSL.$SubCommand);
	}

	public function ChannelVolumeSR(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSR, $Value);
		$this->SendCommand(DENON_API_Commands::CVSR.$SubCommand);
	}

	public function ChannelVolumeSBL(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSBL, $Value);
		$this->SendCommand(DENON_API_Commands::CVSBL.$SubCommand);
	}

	public function ChannelVolumeSBR(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSBR, $Value);
		$this->SendCommand(DENON_API_Commands::CVSBR.$SubCommand);
	}

	public function ChannelVolumeSB(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSB, $Value);
		$this->SendCommand(DENON_API_Commands::CVSB.$SubCommand);
	}

	public function ChannelVolumeFHL(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFHL, $Value);
		$this->SendCommand(DENON_API_Commands::CVFHL.$SubCommand);
	}

	public function ChannelVolumeFHR(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFHR, $Value);
		$this->SendCommand(DENON_API_Commands::CVFHR.$SubCommand);
	}

	public function ChannelVolumeFWL(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFWL, $Value);
		$this->SendCommand(DENON_API_Commands::CVFWL.$SubCommand);
	}

	public function ChannelVolumeFWR(float $Value){ // Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFWR, $Value);
		$this->SendCommand(DENON_API_Commands::CVFWR.$SubCommand);
	}
	
	public function ChannelVolumeSHL(float $Value){ //Surround Height Left Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSHL, $Value);
		$this->SendCommand(DENON_API_Commands::CVSHL.$SubCommand);
	}
	
	public function ChannelVolumeSHR(float $Value){ //Surround Height Right Range -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSHR, $Value);
		$this->SendCommand(DENON_API_Commands::CVSHR.$SubCommand);
	}

    public function ChannelVolumeTS(float $Value){ //Top Surround Range -12 to 12, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVTS, $Value);
        $this->SendCommand(DENON_API_Commands::CVTS.$SubCommand);
    }

    public function ChannelVolumeZRL(){ //Reset all channel volume status
        $this->SendCommand(DENON_API_Commands::CVZRL);
    }

    public function ChannelVolumeTFL(float $Value){ //Top Front Left -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVTFL, $Value);
		$this->SendCommand(DENON_API_Commands::CVTFL.$SubCommand);
	}
	
	public function ChannelVolumeTFR(float $Value){ //Top Front Right -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVTFR, $Value);
		$this->SendCommand(DENON_API_Commands::CVTFR.$SubCommand);
	}
	
	public function ChannelVolumeTML(float $Value){ //Top Middle Left -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVTML, $Value);
		$this->SendCommand(DENON_API_Commands::CVTML.$SubCommand);
	}
	
	public function ChannelVolumeTMR(float $Value){ //Top Middle Right -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVTMR, $Value);
		$this->SendCommand(DENON_API_Commands::CVTMR.$SubCommand);
	}
	
	public function ChannelVolumeTRL(float $Value){ //Top Rear Left -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVTRL, $Value);
		$this->SendCommand(DENON_API_Commands::CVTRL.$SubCommand);
	}
	
	public function ChannelVolumeTRR(float $Value){ //Top Rear Right -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVTRR, $Value);
		$this->SendCommand(DENON_API_Commands::CVTRR.$SubCommand);
	}
	
	public function ChannelVolumeRHL(float $Value){ // Rear Height Left -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVRHL, $Value);
		$this->SendCommand(DENON_API_Commands::CVRHL.$SubCommand);
	}
	
	public function ChannelVolumeRHR(float $Value){ // Rear Height Right -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVRHR, $Value);
		$this->SendCommand(DENON_API_Commands::CVRHR.$SubCommand);
	}
	
	public function ChannelVolumeFDL(float $Value){ // Front Dolby Left -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFDL, $Value);
		$this->SendCommand(DENON_API_Commands::CVFDL.$SubCommand);
	}
	
	public function ChannelVolumeFDR(float $Value){ // Front Dolby Right -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVFDR, $Value);
		$this->SendCommand(DENON_API_Commands::CVFL.$SubCommand);
	}
	
	public function ChannelVolumeSDL(float $Value){ // Surround Dolby Left -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSDL, $Value);
		$this->SendCommand(DENON_API_Commands::CVFDR.$SubCommand);
	}
	
	public function ChannelVolumeSDR(float $Value){ // Surround Dolby Right -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVSDR, $Value);
		$this->SendCommand(DENON_API_Commands::CVSDR.$SubCommand);
	}
	
	public function ChannelVolumeBDL(float $Value){ // Back Dolby Left -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVBDL, $Value);
		$this->SendCommand(DENON_API_Commands::CVBDL.$SubCommand);
	}
	
	public function ChannelVolumeBDR(float $Value){ // Back Dolby Right -12 to 12, Step 0.5
		$SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::CVBDR, $Value);
		$this->SendCommand(DENON_API_Commands::CVBDR.$SubCommand);
	}
		
	//RecSelect
	public function RecSelect(string $command){ // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
		$this->SendCommand(DENON_API_Commands::SR.$command);
	}

	
	//Video Select
	public function VideoSelect(string $command) // Video Select DVD , BD , TV , SAT/CBL , DVR ,GAME , AUX , DOCK , SOURCE, MPLAY
	{
		$manufacturername = $this->GetManufacturerName();
		$AVRType = $this->GetAVRType($manufacturername);
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W" || $AVRType == "AVR-2200W" || $AVRType == "AVR-1200W")
			{
				if ($command == "AUX")
				{
					$command = "AUX1";
				}
			}
		else
		{
			if($command == "AUX")
			{
				$command = "V.AUX";
			}
		}
		$payload = DENON_API_Commands::SV.$command;
		$this->SendCommand($payload);
	}
	
	//Subwoofer
	public function Subwoofer(bool $Value){ // Subwoofer true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSSWR, $Value);
		$this->SendCommand(DENON_API_Commands::PSSWR.$SubCommand);
	}
	
	//Subwoofer ATT
	public function SubwooferATT(bool $Value){ // Subwoofer ATT true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSATT, $Value);
        $this->SendCommand(DENON_API_Commands::PSATT.$SubCommand);
	}
	
	//Front Height
	public function FrontHeight(bool $Value){ // Front Height true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSFH, $Value);
        $this->SendCommand(DENON_API_Commands::PSFH.$SubCommand);
	}
	
	//Tone CTRL
	public function ToneCTRL(bool $Value){ // Tone CTRL true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::TONECTRL, $Value);
        $this->SendCommand(DENON_API_Commands::TONECTRL.$SubCommand);
	}
	
	//Audio Delay
	public function AudioDelay(int $Value){ // can be operated from 0 to 300
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSDELAY, $Value);
        $this->SendCommand(DENON_API_Commands::PSDELAY.$SubCommand);
	}
	
	//Speaker Output Front 
	public function SpeakerOutputFront(string $Value){ // Speaker Output Front Off / Wide / Height / Height/Wide
	    $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSSP, $Value);
        $this->SendCommand(DENON_API_Commands::PSSP.$SubCommand);
	}
	
	//Auto Flag Detect Mode
	public function AutoFlagDetectMode(bool $Value){ // Auto Flag Detect Mode true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSAFD, $Value);
        $this->SendCommand(DENON_API_Commands::PSAFD.$SubCommand);
	}
	
	//ASP
	public function ASP(string $Value){ // ASP Normal / Full
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::VSASP, $Value);
        $this->SendCommand(DENON_API_Commands::VSASP.$SubCommand);
	}
	
	//Audio Restorer
	public function AudioRestorer(string $Value){ // Audio Restorer Off / 64 / 96 / HQ
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSRSTR, $Value);
        $this->SendCommand(DENON_API_Commands::PSRSTR.$SubCommand);
	}
	
	//Center Image
	public function CenterImage(float $Value){ //Center Image can be operated from 0.0 to 1.0 Step 0.1
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSCEI, $Value);
        $this->SendCommand(DENON_API_Commands::PSCEI.$SubCommand);
	}
	
	//Center Width
	public function CenterWidth(float $Value){ //Center Width can be operated from 0 to 7 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSCEN, $Value);
        $this->SendCommand(DENON_API_Commands::PSCEN.$SubCommand);
	}
	
	//Input Mode
	public function SelectDecodeMode(string $Value){ // AUTO; HDMI; DIGITAL; ANALOG
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::SD, $Value);
        $this->SendCommand(DENON_API_Commands::SD.$SubCommand);
	}
	
	//Digital Input Mode
	public function DigitalInputMode(string $Value){ // Digital Input Mode Auto / PCM / DTS
	    $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::DC, $Value);
        $this->SendCommand(DENON_API_Commands::DC.$SubCommand);
	}
	
	
	//Dimension
	public function Dimension(int $Value){ //Dimension can be operated from 0 to 6
	    $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSDIM, $Value);
        $this->SendCommand(DENON_API_Commands::PSDIM.$SubCommand);
	}
	
	//Effect Level
	public function EffectLevel(float $Value){ //Effect Level  can be operated from 1 to 15 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSEFF, $Value);
        $this->SendCommand(DENON_API_Commands::PSEFF.$SubCommand);
	}
	
	//HDMI Audio Output
	public function HDMIAudioOutput(string $Value){ // HDMI Audio Output TV / AMP
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::VSAUDIO, $Value);
        $this->SendCommand(DENON_API_Commands::VSAUDIO.$SubCommand);
	}
	
	//Multi EQ Mode
	public function MultiEQMode(string $Value){ // Multi EQ Mode Audyssey / BYP.LR / Flat / Manual / Off
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSMULTEQ, $Value);
        $this->SendCommand(DENON_API_Commands::PSMULTEQ.$SubCommand);
	}
	
	//PLIIZHeightGain
	public function PLIIZHeightGain(string $Value){ // PLIIZHeightGain Low / Middle / High
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSPHG, $Value);
        $this->SendCommand(DENON_API_Commands::PSPHG.$SubCommand);
	}
	
	//Reference Level
	public function ReferenceLevel(int $Value){ // Reference Level 0 / 5 / 10 / 15
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSREFLEV, $Value);
        $this->SendCommand(DENON_API_Commands::PSREFLEV.$SubCommand);
	}
	
	//Room Size
	public function RoomSize(string $Value){ // Room Size Small / Small/Medium / Medium / Medium/Large / Large
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSRSZ, $Value);
        $this->SendCommand(DENON_API_Commands::PSRSZ.$SubCommand);
	}
	
	//Stage Width
	public function StageWidth(float $Value){ //Stage Width can be operated from -10 to +10 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSSTW, $Value);
        $this->SendCommand(DENON_API_Commands::PSSTW.$SubCommand);
	}
	
	//Stage Height
	public function StageHeight(float $Value){ //Stage Width can be operated from -10 to +10 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSSTH, $Value);
        $this->SendCommand(DENON_API_Commands::PSSTH.$SubCommand);
	}
	
	//Surround Back Mode
	public function SurroundBackMode(string $Value){ // Surround Back Mode Off / On / Matrix / Cinema / Music
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSSB, $Value);
        $this->SendCommand(DENON_API_Commands::PSSB.$SubCommand);
	}
		
	//Surround Play Mode
	public function SurroundPlayMode(string $Value){ // Surround Play Mode Music / Cinema / Game / Pro Logic
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PSMODE, $Value);
        $this->SendCommand(DENON_API_Commands::PSMODE.$SubCommand);
	}
	
	//Vertical Stretch
	public function VerticalStretch(bool $Value){ // VerticalStretch true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::VSVST, $Value);
        $this->SendCommand(DENON_API_Commands::VSVST.$SubCommand);
	}
	
	//Contrast
	public function Contrast(float $Value){ // Contrast can be operated from -6 to 6 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PVCN, $Value);
        $this->SendCommand(DENON_API_Commands::PVCN.$SubCommand);
	}
	
	//Brightness
	public function Brightness(float $Value){ //Brightness can be operated from 0 to 12 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PVBR, $Value);
        $this->SendCommand(DENON_API_Commands::PVBR.$SubCommand);
	}
	
	//Chroma Level
	public function ChromaLevel(float $Value){ //Chroma Level can be operated from -6 to 6 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PVCM, $Value);
        $this->SendCommand(DENON_API_Commands::PVCM.$SubCommand);
	}
	
	//Digital Noise Reduction
	public function DigitalNoiseReduction(string $Value){ // Digital Noise Reduction Off / Low / Middle / High
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::PVDNR, $Value);
        $this->SendCommand(DENON_API_Commands::PVDNR.$SubCommand);
	}
	
	//Enhancer
	public function Enhancer(float $Value){ //Enhancer can be operated from 0 to 12 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PVENH, $Value);
        $this->SendCommand(DENON_API_Commands::PVENH.$SubCommand);
	}
	
	//HDMI Monitor
	public function HDMIMonitor(string $Value){ // HDMI Monitor Auto / Monitor 1 / Monitor 2
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::VSMONI, $Value);
        $this->SendCommand(DENON_API_Commands::VSMONI.$SubCommand);
	}

	//Hue
	public function Hue(float $Value){ //Enhancer can be operated from -6 to 6 Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PVHUE, $Value);
        $this->SendCommand(DENON_API_Commands::PVHUE.$SubCommand);
	}
	
	//Resolution
	public function Resolution(string $Value){ // Resolution 480p/576p / 1080i / 720p / 1080p / 1080p:24Hz / Auto / 4K / 4K(60/50)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::VSSC, $Value);
        $this->SendCommand(DENON_API_Commands::VSSC.$SubCommand);
	}
		
	//Resolution HDMI
	public function ResolutionHDMI(string $Value){ //Resolution HDMI 480p/576p / 1080i / 720p / 1080p / 1080p:24Hz / Auto / 4K / 4K(60/50)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::VSSCH, $Value);
        $this->SendCommand(DENON_API_Commands::VSSCH.$SubCommand);
	}
	
	//Video Processing Mode
	public function VideoProcessingMode(string $Value){ // Video Processing Mode Auto / Game / Movie
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::VSVPM, $Value);
        $this->SendCommand(DENON_API_Commands::VSVPM.$SubCommand);
	}
	
	//GUI Menu
	public function GUIMenu(bool $Value) // GUI Menu true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::MNMENOFF;
			}
		else
			{
				$subcommand = DENON_API_Commands::MNMENON;
			}
		$payload = DENON_API_Commands::MNMEN.$subcommand;
		$this->SendCommand($payload);
	}
	
	//GUI Source Select Menu 
	public function GUISourceSelectMenu(bool $Value){ // GUI Source Select Menu true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MNSRC, $Value);
        $this->SendCommand(DENON_API_Commands::MNSRC.$SubCommand);
	}
	
	//PS
	public function ParameterSettings(string $subcommand){ // PS
		$this->SendCommand(DENON_API_Commands::PS.$subcommand);
	}
	
	//Noch ergänzen
	
	//Preset Analog Tuner
	public function SelectTunerPresetAnalog(string $Value) // A1 - G8 00-55,00=A1,01=A2,B1=08,G8=55 , Up, Down
	{
		if ($Value == "Up")
			{
				$subcommand = DENON_API_Commands::TPANUP;
			}
		elseif ($Value == "Down")
			{
				$subcommand = DENON_API_Commands::TPANDOWN;
			}
		else
			{
				$FunctionType = "Range00to55";
				$subcommand = $this->GetCommandValueSend($Value, $FunctionType);
			}	
		
		$payload = DENON_API_Commands::TPAN.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Preset Network Audio
	public function SelectPresetNetworkAudio(bool $Value){
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MNSRC, $Value);
        $this->SendCommand(DENON_API_Commands::MNSRC.$SubCommand);
	}
	
	######################## Cursor Steuerung ######################################

	public function CursorUp(){
		$this->SendCommand(DENON_API_Commands::MN.DENON_API_Commands::MNCUP);
	}

	public function CursorDown(){
		$this->SendCommand(DENON_API_Commands::MN.DENON_API_Commands::MNCDN);
	}

	public function CursorLeft(){
		$this->SendCommand(DENON_API_Commands::MN.DENON_API_Commands::MNCLT);
	}

	public function CursorRight(){
		$this->SendCommand(DENON_API_Commands::MN.DENON_API_Commands::MNCRT);
	}

	public function Enter(){
		$this->SendCommand(DENON_API_Commands::MN.DENON_API_Commands::MNENT);
	}

	public function CursorReturn(){
		$this->SendCommand(DENON_API_Commands::MN.DENON_API_Commands::MNRTN);
	}
	
	//Levels
	
	//Bass Level	
	public function BassLevel(float $Value){ // can be operated from -6 to +6, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSBAS, $Value);
        $this->SendCommand(DENON_API_Commands::PSBAS.$SubCommand);
	}

    //Treble Level
    public function TrebleLevel(float $Value){ // can be operated from -6 to +6, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSTRE, $Value);
        $this->SendCommand(DENON_API_Commands::PSTRE.$SubCommand);
    }

	//LFE Level
	public function LFELevel(float $Value){ // can be operated from 0 to -10, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PSLFE, $Value);
        $this->SendCommand(DENON_API_Commands::PSLFE.$SubCommand);
	}

	//Sleep
	public function SLEEP(int $Value){ // 0 ist aus bis 120 Step 10
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::SLP, $Value);
        $this->SendCommand(DENON_API_Commands::SLP.$SubCommand);
	}
	
	//Network Audio Navigation
	public function NACursorUp(){
		$this->SendCommand(DENON_API_Commands::NAUP);
	}

	public function NACursorDown(){
		$this->SendCommand(DENON_API_Commands::NADOWN);
	}

	public function NACursorLeft(){
		$this->SendCommand(DENON_API_Commands::NALEFT);
	}
	
	public function NACursorRight(){
		$this->SendCommand(DENON_API_Commands::NARIGHT);
	}
	
	public function NAEnter(){
		$this->SendCommand(DENON_API_Commands::NAENTER);
	}
	
	public function NAPlay(){
		$this->SendCommand(DENON_API_Commands::NAPLAY);
	}
	
	public function NAPause(){
		$this->SendCommand(DENON_API_Commands::NAPAUSE);
	}
	
	public function NAStop(){
		$this->SendCommand(DENON_API_Commands::NASTOP);
	}
	
	public function NASkipPlus(){
		$this->SendCommand(DENON_API_Commands::NASKIPPLUS);
	}
	
	public function NASkipMinus(){
		$this->SendCommand(DENON_API_Commands::NASKIPMINUS);
	}
	
	public function NARepeatOne(){
		$this->SendCommand(DENON_API_Commands::NAREPEATONE);
	}
	
	public function NARepeatAll(){
		$this->SendCommand(DENON_API_Commands::NAREPEATALL);
	}
	
	public function NARepeatOff(){
		$this->SendCommand(DENON_API_Commands::NAREPEATOFF);
	}
	
	public function NARandomOn(){
		$this->SendCommand(DENON_API_Commands::NARANDOMON);
	}
	
	public function NARandomOff(){
		$this->SendCommand(DENON_API_Commands::NARANDOMOFF);
	}
	
	public function NAPageNext(){
		$this->SendCommand(DENON_API_Commands::NAPAGENEXT);
	}
	
	public function NAPagePrevious(){
		$this->SendCommand(DENON_API_Commands::NAPAGEPREV);
	}
	######################## Zone 2 functions ######################################

	public function Z2_Volume(string $command){ // "UP" or "DOWN"
		$this->SendCommand(DENON_API_Commands::Z2.$command);
	}

	public function Zone2VolumeFix(float $Value){ // 18(db) bis -80(db), Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2VOL, $Value);
        $this->SendCommand(DENON_API_Commands::Z2.$SubCommand);
	}

	//Zone2 Power 
	public function Zone2Power(bool $Value){ // Zone2 Power  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2POWER, $Value);
        $this->SendCommand(DENON_API_Commands::Z2.$SubCommand);
	}
	
	//Zone2 Mute 
	public function Zone2Mute(bool $Value){ // Zone2 Mute  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2MU, $Value);
        $this->SendCommand(DENON_API_Commands::Z2MU.$SubCommand);
	}
	
	public function Zone2InputSource(string $subcommand){ // PHONO ; DVD ; HDP ; "TV/CBL" ; SAT ; "NET/USB" ; DVR ; TUNER
		$this->SendCommand(DENON_API_Commands::Z2.$subcommand);
	}

	//Channel Volume Front Left
	public function Zone2ChannelVolumeFL(float $Value){ // -12 to 12, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2CVFL, $Value);
        $this->SendCommand(DENON_API_Commands::Z2CVFL.$SubCommand);
	}
	
	//Channel Volume Front Right
	public function Zone2ChannelVolumeFR(float $Value){ // -12 to 12, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2CVFR, $Value);
        $this->SendCommand(DENON_API_Commands::Z2CVFR.$SubCommand);
	}
	
	public function Zone2ChannelSetting(string $Value){ // Zone 2 Channel Setting: Stereo/Mono
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::Z2CS, $Value);
        $this->SendCommand(DENON_API_Commands::Z2CS.$SubCommand);
	}

	public function Zone2QuickSelect(string $command){ // Zone 2 Quickselect 1-5
		$this->SendCommand(DENON_API_Commands::Z2QUICK.$command);
	}

	

	########################## Zone 3 Functions ####################################


    public function Z3_Volume(string $command){ // "UP" or "DOWN"
        $this->SendCommand(DENON_API_Commands::Z3.$command);
    }

    public function Zone3VolumeFix(float $Value){ // 18(db) bis -80(db), Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3VOL, $Value);
        $this->SendCommand(DENON_API_Commands::Z3.$SubCommand);
    }

    //Zone3 Power
    public function Zone3Power(bool $Value){ // Zone3 Power  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3POWER, $Value);
        $this->SendCommand(DENON_API_Commands::Z3.$SubCommand);
    }

    //Zone3 Mute
    public function Zone3Mute(bool $Value){ // Zone3 Mute  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3MU, $Value);
        $this->SendCommand(DENON_API_Commands::Z3MU.$SubCommand);
    }

    public function Zone3InputSource(string $subcommand){ // PHONO ; DVD ; HDP ; "TV/CBL" ; SAT ; "NET/USB" ; DVR ; TUNER
        $this->SendCommand(DENON_API_Commands::Z3.$subcommand);
    }

    //Channel Volume Front Left
    public function Zone3ChannelVolumeFL(float $Value){ // -12 to 12, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3CVFL, $Value);
        $this->SendCommand(DENON_API_Commands::Z3CVFL.$SubCommand);
    }

    //Channel Volume Front Right
    public function Zone3ChannelVolumeFR(float $Value){ // -12 to 12, Step 0.5
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3CVFR, $Value);
        $this->SendCommand(DENON_API_Commands::Z3CVFR.$SubCommand);
    }

    public function Zone3ChannelSetting(string $Value){ // Zone 3 Channel Setting: Stereo/Mono
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValueName(DENON_API_Commands::Z3CS, $Value);
        $this->SendCommand(DENON_API_Commands::Z3CS.$SubCommand);
    }

    public function Zone3QuickSelect(string $command){ // Zone 3 Quickselect 1-5
        $this->SendCommand(DENON_API_Commands::Z3QUICK.$command);
    }
	


	// Get Value for Sending 
	private function GetCommandValueSend($Value, $FunctionType)
	{
		//Range **:00-55,00=A1,01=A2,B1=08,G8=55
        $ValueMapping=[];
        $denoncommand='';

        if($FunctionType == "Range00to55")
		{
			$ValueMapping = array("00" => 1, "01" => 1, "02" => 2, "03" => 3, "04" => 4, "05" => 5, "06" => 6, "07" => 7, "08" => 8, "09" => 9, "10" => 10,
													"11" => 11, "12" => 12, "13" => 13, "14" => 14, "15" => 15, "16" => 16, "17" => 17, "18" => 18, "19" => 19, "20" => 20, "21" => 21, "22" => 22,
													"23" => 23, "24" => 24, "25" => 25, "26" => 26, "27" => 27, "28" => 28, "29" => 29, "30" => 30, "31" => 31, "32" => 32, "33" => 33, "34" => 34,
													"35" => 35, "36" => 36, "37" => 37, "38" => 38, "39" => 39, "40" => 40, "41" => 41, "42" => 42, "43" => 43, "44" => 44, "45" => 45, "46" => 46,
													"47" => 47, "48" => 48, "49" => 49, "50" => 50, "51" => 51, "52" => 52, "53" => 53, "54" => 54, "55" => 55);
		}

		foreach ($ValueMapping as $command => $UserValue)
			{
				if ($UserValue == $Value)
				{
					$denoncommand = $command;
				}
			}
		return $denoncommand;
	}


    ################## Configuration Form ##############################################

    public function GetConfigurationForm()
    {
        $manufacturername = $this->GetManufacturerName();
        $AVRType = $this->GetAVRType($manufacturername);
        $zone = $this->ReadPropertyInteger('Zone');
        $formhead = $this->FormHead();
        $formselectionAVR = $this->FormSelectionAVR($manufacturername);
        $formselectionzone = $this->FormSelectionZone();
        $formselectionneo = $this->FormSelectionNEO();
        $formselectionalexa = $this->FormSelectionAlexa();
        $formactions = $this->FormActions();
        $formelementsend = '{ "type": "Label", "label": "__________________________________________________________________________________________________" }';
        $formstatus = $this->FormStatus();

        if ($this->debug){
            IPS_LogMessage(__FUNCTION__, 'Manufacturername: '.$manufacturername.', AVRType: '.$AVRType.', Zone: '.$zone);
        }

        if($manufacturername == "none") // Auswahl Hersteller
        {
            $ret = '{ '.$formhead.$formelementsend.'],'.$formstatus.' }';
        }
        elseif($AVRType === false ) // Auswahl Modell
        {
            $ret = '{ '.$formhead.$formselectionAVR.$formelementsend.'],'.$formstatus.' }';
        }
        elseif($zone == 6)
        {
            $ret = '{ '.$formhead.$formselectionAVR.$formselectionzone.$formelementsend.'],'.$formstatus.' }';
        }
        else
        {
            if($zone == 0)
            {
                $formmainzone = $this->FormMainzone($AVRType);
                $ret = '{ '.$formhead.$formselectionAVR.$formselectionzone.$formelementsend.','.$formmainzone.$formselectionneo.$formselectionalexa.$formelementsend.'],'.$formactions.$formstatus.' }';
            }
            else
            {
                $formzone = $this->FormZone($zone, $AVRType);
                $ret = '{ '.$formhead.$formselectionAVR.$formselectionzone.$formelementsend.','.$formzone.$formselectionneo.$formselectionalexa.$formelementsend.'],'.$formactions.$formstatus.' }';
            }
        }

        if ($this->debug){
            file_put_contents(IPS_GetLogDir()."form_telnet_gen.json", $ret);
        }
        return $ret;
    }

    private function FormHead(){
        return '"elements":
        [
            { "type": "Label", "label": "AV Receiver Control Telnet" },
            { "type": "Label", "label": "Telnet control is working with a only a single client connection (IP-Symcon), more remote commands available compared to HTTP." },
            { "type": "Label", "label": "Please select a manufacturer and push the \"apply\" button"},
            { "type": "Select", "name": "manufacturer", "caption": "manufacturer",
                    "options": [
                                { "value": 0, "label": "Please Select" },
                                { "value": 1, "label": "Denon" },
                                { "value": 2, "label": "Marantz" }
                                ]
            },
';
    }

    private function FormMainzone($AVRType){

        $AVRCaps = AVRs::getCapabilities($AVRType);
        if ($this->debug){
            IPS_LogMessage(__FUNCTION__, 'AVR Caps ('.$AVRType.'): '.json_encode($AVRCaps));
        }

        $profiles =  (new DENONIPSProfiles($AVRType))->GetAllProfilesSortedByPos();

        $form = '{ "type": "Label", "label": "main zone:" },';

        //todo
        //				{ "type": "CheckBox", "name": "Navigation", "caption": "show navigation remote" },

        $CommandAreas = [
            //Label => Caps CommandArea
            'Info Display' => 'InfoFunctions',      //Info
            'Power Settings' => 'PowerFunctions',   //Power Funktionen (PW, ZM, SLP, ...)
            'Input Settings' => 'InputSettings',    //Input Settings
            'Surround Mode' => 'SurroundMode',      //Surround Mode
            'Channel Volumes' => 'CV_Commands',     //Control Volume (CV)
            'Sound Processing' => 'PS_Commands',    //Process Sound (PS)
            'Video Settings' => 'VS_Commands',      //Video Settings (VS)
            'Video Processing' => 'PV_Commands',    //Processing Video (PV)
            'System Control' => 'SystemControl_Commands', //System Control (MN, ...)
        ];


        foreach ($CommandAreas as $label => $commandArea){
            $form .= '
                        { "type": "Label", "label": "'.$label.':" },';

            foreach ($profiles as $profile){
                if ($this->testAllProperties){
                    $commandArea_max = $commandArea.'_max';
                    $Caps = AVR::$$commandArea_max;
                } else {
                    $Caps = $AVRCaps[$commandArea];
                }
                $form .= $this->getTypeItem('CheckBox', $profile['Ident'], $profile['PropertyName'], $profile['Name'], $Caps);
            }

        }

        $form .='{ "type": "Label", "label": "more inputs:" },
            { "type": "CheckBox", "name": "FAVORITES", "caption": "favorites" },
            { "type": "CheckBox", "name": "IRADIO", "caption": "internet radio" },
            { "type": "CheckBox", "name": "SERVER", "caption": "Server" },
            { "type": "CheckBox", "name": "NAPSTER", "caption": "Napster" },
            { "type": "CheckBox", "name": "LASTFM", "caption": "LastFM" },
            { "type": "CheckBox", "name": "FLICKR", "caption": "Flickr" },
            ';

        return $form;
    }

    private function FormZone($Zone, $AVRType)
    {
        $AVRCaps = AVRs::getCapabilities($AVRType);
        IPS_LogMessage(__FUNCTION__, 'AVR Caps ('.$AVRType.'): '.json_encode($AVRCaps));

        $Zone = $Zone +1;
        $profiles =  (new DENONIPSProfiles($AVRType))->GetAllProfilesSortedByPos();

        $form = '{ "type": "Label", "label": "Zone '.$Zone.':" },';


        $CommandAreas = [
            //Label => Caps CommandArea
            'Zone Settings' => 'Zone_Commands',      //Zone commands
        ];


        foreach ($CommandAreas as $label => $commandArea){
            $form .= '
                        { "type": "Label", "label": "' . $label . ':" },';

            foreach ($profiles as $profile){
                // if it is a zone specific Command
                if (in_array(substr($profile['Ident'], 0, 2), ['Z2', 'Z3'])
                    || in_array(substr($profile['Ident'], 0, 5), ['Zone2', 'Zone3'])){

                    //select only the idents of the current zone
                    if ((substr($profile['Ident'], 0, 2) == 'Z'.($Zone))
                        || (substr($profile['Ident'], 0, 5) == 'Zone'.($Zone))){
                        $form .= $this->getTypeItem('CheckBox', $profile['Ident'],
                            $profile['PropertyName'], $profile['Name'],
                            $AVRCaps['Zone_Commands']);
                    }

                } else {
                    $form .= $this->getTypeItem('CheckBox', $profile['Ident'],
                        $profile['PropertyName'], $profile['Name'],
                        $AVRCaps['Zone_Commands']);
                }

            }
        }

        $form .='{ "type": "Label", "label": "more inputs:" },
            { "type": "CheckBox", "name": "FAVORITES", "caption": "favorites" },
            { "type": "CheckBox", "name": "IRADIO", "caption": "internet radio" },
            { "type": "CheckBox", "name": "SERVER", "caption": "Server" },
            { "type": "CheckBox", "name": "NAPSTER", "caption": "Napster" },
            { "type": "CheckBox", "name": "LASTFM", "caption": "LastFM" },
            { "type": "CheckBox", "name": "FLICKR", "caption": "Flickr" },
            ';

        return $form;
    }

    private function FormActions(){
        return '"actions":
        [
            {
                "type": "Button",
                "label": "Power On",
                "onClick": "DAVRT_Power($id, true);"
            },
            {
                "type": "Button",
                "label": "Power Off",
                "onClick": "DAVRT_Power($id, false);"
            },
            {
                "type": "Button",
                "label": "Status Initialisieren",
                "onClick": "DAVRT_GetStates($id);"
            }
        ],';
    }

}

?>