<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonAVRHTTP extends AVRModule
{

    static $NEO_Parameter = ['PW' => ['DAVRH_Power', 'Power'],
                             'ZM' => ['DAVRH_MainZonePower', 'MainZonePower'],
                             'MU' => ['DAVRH_MainMute', 'Mute'],
                             'Z2POWER' => ['DAVRH_Zone2Power', 'Zone2Power'],
                             'Z3POWER' => ['DAVRH_Zone3Power', 'Zone3Power'],
                             'Z2MU' => ['DAVRH_Zone2Mute', 'Zone 2 Mute'],
                             'Z3MU' => ['DAVRH_Zone3Mute', 'Zone 3 Mute'],
                            ];


    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // 1. Verfügbarer DenonSplitter wird verbunden oder neu erzeugt, wenn nicht vorhanden.
        $this->ConnectParent("{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}");

        $this->RegisterProperties();
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

		$this->ValidateConfiguration();
	}

    private function ValidateConfiguration()
    {
        if (IPS_GetKernelRunlevel() != 10103){ //Kernel ready
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Kernel is not ready ('.IPS_GetKernelRunlevel().')');
            return;
        }

        if (!$this->SetInstanceStatus()){
            return;
        }

        //Zone prüfen
        $Zone = $this->ReadPropertyInteger('Zone');
        $manufacturername = $this->GetManufacturerName();
        $AVRType = $this->GetAVRType($manufacturername);

        $DenonAVRVar = new DENONIPSProfiles($AVRType);

        //Inputs ablegen, damit sie später dem Splitter zur Verfügung stehen
        DAVRSH_SaveInputVarmapping($this->GetParent(), json_encode($this->GetInputsAVR($DenonAVRVar)));

        $AVRCaps = AVRs::getCapabilities($AVRType);

        if ($this->GetIPParent() !== false){
            $this->SetStatus(self::STATUS_INST_IS_ACTIVE);
        }

        $profiles = $DenonAVRVar->GetAllProfilesSortedByPos();
        $idents = [];

        if ($Zone == 0){//Mainzone

            $idents[DENONIPSProfiles::ptMainZoneName] = $this->ReadPropertyBoolean('ZoneName');
            $idents[DENONIPSProfiles::ptModel] = $this->ReadPropertyBoolean('Model');
            $idents[DENONIPSProfiles::ptPower] = $this->ReadPropertyBoolean('Power');
            $idents[DENONIPSProfiles::ptMainZonePower] = $this->ReadPropertyBoolean('MainZonePower');
            $idents[DENONIPSProfiles::ptMainMute] = $this->ReadPropertyBoolean('MainMute');
            $idents[DENONIPSProfiles::ptSleep] = $this->ReadPropertyBoolean('Sleep');
            $idents[DENONIPSProfiles::ptSurroundMode] = $this->ReadPropertyBoolean('SurroundMode');
            $idents[DENONIPSProfiles::ptNavigation] = $this->ReadPropertyBoolean('Navigation');
            $idents[DENONIPSProfiles::ptInputSource] = $this->ReadPropertyBoolean('InputSource');
            $idents[DENONIPSProfiles::ptSurroundPlayMode] = $this->ReadPropertyBoolean('SurroundPlayMode');

            $Caps = $AVRCaps['CV_Commands'];

            foreach ($profiles as $key=>$profile){
                if (in_array($profile['Ident'], $Caps)){
                    $idents[$key] = $this->ReadPropertyBoolean($profile['PropertyName']);
                }
            }

        } else {//Zone 2 oder 3

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

        // Alexa Link anlegen
        if ($this->ReadPropertyBoolean('Alexa')){
            $this->CreateAlexaLinks($manufacturername, $AVRType, $Zone);
        } else {
            $this->DeleteAlexaLinks($manufacturername, $AVRType, $Zone);
        }
    }

    //Data Transfer
    private function SendCommand(string $payload)
    {
        $this->SendDebug("Send Command HTTP:",$payload,0);
        $this->SendDataToParent(json_encode(Array("DataID" => "{DB1DDFAD-0DE9-47CF-B8E8-FB7E7425BF90}", "Buffer" => $payload))); //Denon Splitter HTTP
    }

    /**
    * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
    * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
    *
    */

	public function RequestAction($Ident, $Value){

		//Input übergeben
        $InputMapping = DAVRSH_GetInputVarMapping($this->GetParent());
        IPS_LogMessage(get_class().'::'.__FUNCTION__, 'InputMapping: '.json_encode($InputMapping));

        //Command aus Ident
        $APICommand = $this->GetAPICommandFromIdent($Ident);

        // Subcommand holen
        $AVRType = $this->GetAVRType($this->GetManufacturerName());
        $APISubCommand = (new DENONIPSProfiles($AVRType, $InputMapping))->GetSubCommandOfValue($Ident, $Value);
        IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Ident: '.$Ident.', Value: '.$Value.', SubCommand: '.$APISubCommand);

        // Daten senden        Rückgabe ist egal, Variable wird automatisch durch Datenempfang nachgeführt
        try
        {
			$this->SendCommand($APICommand.$APISubCommand);
        } catch (Exception $ex)
        {
            trigger_error($ex->getMessage(), $ex->getCode());
            echo $ex->getMessage();
            return false;
        }

    }
	
	//Denon Commands
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
	
	//Zone 2 Power
    public function Zone2Power(bool $Value){ // Zone2 Power  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2POWER, $Value);
        $this->SendCommand(DENON_API_Commands::Z2.$SubCommand);
    }
	
	//Zone 3 Power
    public function Zone3Power(bool $Value){ // Zone3 Power  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3POWER, $Value);
        $this->SendCommand(DENON_API_Commands::Z3.$SubCommand);
    }
	
	//Master Volume Up/Down
	public function MasterVolume(string $Subcommand){ // "UP" or "DOWN"
		$payload = DENON_API_Commands::MV.$Subcommand;
		$this->SendCommand($payload);
	}
	
	//Main Mute
    public function MainMute(bool $Value){ // false (Off) oder true (On)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MU, $Value);
        $this->SendCommand(DENON_API_Commands::MU.$SubCommand);
    }
	
	//Zone2 Mute
    public function Zone2Mute(bool $Value){ // Zone2 Mute  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2MU, $Value);
        $this->SendCommand(DENON_API_Commands::Z2MU.$SubCommand);
    }
	
	//Zone3 Mute
    public function Zone3Mute(bool $Value){ // Zone3 Mute  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3MU, $Value);
        $this->SendCommand(DENON_API_Commands::Z3MU.$SubCommand);
    }
	
	//Send HTTP Command
	public function SendHTTPCommand(string $Command){ // Beliebiges Command
		$this->SendCommand($Command);
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
            file_put_contents(IPS_GetLogDir()."form_http_gen.json", $ret);
        }
        return $ret;
	}




    private function FormHead()
    {
        $form = '"elements":
           [
			{ "type": "Label", "label": "AV Receiver Control http" },
			{ "type": "Label", "label": "http control is working only with AVR types from 2011, not all commands available." },
			{ "type": "Label", "label": "Please select a manufacturer and push the \"apply\" button"},
			{ "type": "Select", "name": "manufacturer", "caption": "manufacturer",
					"options": [
								{ "value": 0, "label": "Please Select" },
								{ "value": 1, "label": "Denon" },
								{ "value": 2, "label": "Marantz" }
								]
			},';

        return $form;
    }

    private function FormMainzone($AVRType)
	{
        $AVRCaps = AVRs::getCapabilities($AVRType);
        if ($this->debug){
            IPS_LogMessage(__FUNCTION__, 'AVR Caps ('.$AVRType.'): '.json_encode($AVRCaps));
        }

        $profiles =  (new DENONIPSProfiles($AVRType))->GetAllProfilesSortedByPos();

        $form = '{ "type": "Label", "label": "main zone:" },';

        $form .= '
                    { "type": "Label", "label": "Main Zone Settings:" },';

        foreach ([
            DENONIPSProfiles::ptMainZoneName,
            DENONIPSProfiles::ptModel,
            DENONIPSProfiles::ptPower,
            DENONIPSProfiles::ptMainZonePower,
            DENONIPSProfiles::ptMainMute,
            DENONIPSProfiles::ptSurroundMode,
            DENONIPSProfiles::ptMasterVolume,
            DENONIPSProfiles::ptSleep,
                ] as $key){

            $profile = $profiles[$key];
            $form .= $this->getTypeItem('CheckBox', $profile['Ident'], $profile['PropertyName'], $profile['Name']);
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

        $form .= '
                    { "type": "Label", "label": "Zone Settings:" },';


        if ($Zone == 2){
            $ZoneCommands = [
                DENONIPSProfiles::ptModel,
                DENONIPSProfiles::ptPower,
                DENONIPSProfiles::ptZone2Name,
                DENONIPSProfiles::ptZone2Power,
                DENONIPSProfiles::ptZone2Mute,
                DENONIPSProfiles::ptZone2HPF,
                DENONIPSProfiles::ptZone2InputSource,
                DENONIPSProfiles::ptZone2ChannelSetting,
                DENONIPSProfiles::ptZone2QuickSelect,
                DENONIPSProfiles::ptZone2Volume,
                DENONIPSProfiles::ptZone2ChannelVolumeFL,
                DENONIPSProfiles::ptZone2ChannelVolumeFR,
                DENONIPSProfiles::ptZone2Sleep,
            ];
        } else {
            $ZoneCommands = [
                DENONIPSProfiles::ptModel,
                DENONIPSProfiles::ptPower,
                DENONIPSProfiles::ptZone3Name,
                DENONIPSProfiles::ptZone3Power,
                DENONIPSProfiles::ptZone3Mute,
                DENONIPSProfiles::ptZone3HPF,
                DENONIPSProfiles::ptZone3InputSource,
                DENONIPSProfiles::ptZone3ChannelSetting,
                DENONIPSProfiles::ptZone3QuickSelect,
                DENONIPSProfiles::ptZone3Volume,
                DENONIPSProfiles::ptZone3ChannelVolumeFL,
                DENONIPSProfiles::ptZone3ChannelVolumeFR,
                DENONIPSProfiles::ptZone3Sleep,
            ];
        }

        foreach ($ZoneCommands as $key){
            $profile = $profiles[$key];
            $form .= $this->getTypeItem('CheckBox', $profile['Ident'], $profile['PropertyName'], $profile['Name']);
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

	private function FormActions()
	{
		$form = '"actions":
           [
               {
                   "type": "Button",
                   "label": "Power On",
                   "onClick": "DAVRH_Power($id, true);"
               },
			{
                   "type": "Button",
                   "label": "Power Off",
                   "onClick": "DAVRH_Power($id, false);"
               }
           ],';
		return  $form;
	}	
		
}

?>