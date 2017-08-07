<?
require_once(__DIR__ . "/AVRModels.php");  // diverse Klassen

class AVRModule extends IPSModule
{
    protected $debug = true;
    protected $testAllProperties = false;


    const STATUS_INST_IS_ACTIVE = 102; //Instanz aktiv
    const STATUS_INST_IS_INACTIVE = 104;
    const STATUS_INST_IP_IS_INVALID = 204; //IP Adresse ist ungültig
    const STATUS_INST_NO_MANUFACTURER_SELECTED = 210;
    const STATUS_INST_NO_NEO_CATEGORY_SELECTED = 211;
    const STATUS_INST_NO_ZONE_SELECTED = 212;
    const STATUS_INST_NO_DENON_AVR_TYPE_SELECTED = 213;
    const STATUS_INST_NO_MARANTZ_AVR_TYPE_SELECTED = 214;

    protected function SetInstanceStatus (){
        if (IPS_GetKernelRunlevel() != 10103){ //Kernel ready
            return FALSE;
        }
        //Zone prüfen
        $Zone = $this->ReadPropertyInteger('Zone');
        $manufacturer = $this->ReadPropertyInteger('manufacturer');


        if ($manufacturer == 0){
            // Error Manufacturer auswählen
            $Status = self::STATUS_INST_NO_MANUFACTURER_SELECTED;
        } elseif ($manufacturer == 1 && $this->ReadPropertyInteger('AVRTypeDenon') == 50 ){
            // Error Denon AVR Type auswählen
            $Status = self::STATUS_INST_NO_DENON_AVR_TYPE_SELECTED;
        } elseif ($manufacturer == 2 && $this->ReadPropertyInteger('AVRTypeMarantz') == 50 ){
            // Error Marantz AVR Type auswählen
            $Status = self::STATUS_INST_NO_MARANTZ_AVR_TYPE_SELECTED;
        } elseif ($Zone == 6){
            // Error Zone auswählen
            $Status = self::STATUS_INST_NO_ZONE_SELECTED;
        } elseif  (!$this->isNeoCategoryValid()){
            // Error keine gültige Category ausgewählt
            $Status = self::STATUS_INST_NO_NEO_CATEGORY_SELECTED;
        } elseif ($this->GetIPParent() === false){
            // Status keine gültige IP
            $Status = self::STATUS_INST_IP_IS_INVALID;
        } else {
            $Status = self::STATUS_INST_IS_ACTIVE;
        }

        $this->SetStatus($Status);

        return ($Status == self::STATUS_INST_IS_ACTIVE);
    }

    private function isNeoCategoryValid(){
        if ($this->ReadPropertyBoolean('NEOToggle')){
            $CatId = $this->ReadPropertyInteger('NEOToggleCategoryID');
            if (!IPS_ObjectExists($CatId) || (!IPS_GetObject($CatId)['ObjectType'] == 0 /*Category*/)){
                return false;
            }
        }
        return true;
    }

    // Daten vom Splitter Instanz
    public function ReceiveData($JSONString)
    {

        // Empfangene Daten vom Splitter
        $data = json_decode($JSONString);
        $this->SendDebug("Received Data:",json_encode($data->Buffer->Data),0);
        $this->UpdateVariable($data->Buffer);

    }

    // Wertet Response aus und setzt Variable
    protected function UpdateVariable($data)
    {
        if ($this->debug){
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'data: '.json_encode($data));
        }
        $ResponseType = $data->ResponseType;

        $this->SendDebug("Response Type:",$ResponseType,0);
        $Zone = $this->ReadPropertyInteger('Zone');

        switch ($ResponseType){
            case "HTTP":
                if ($Zone == 0){
                    $datavalues = $data->Data->Mainzone;
                } elseif ($Zone == 1){
                    $datavalues = $data->Data->Zone2;
                } elseif ($Zone == 2){
                    $datavalues = $data->Data->Zone3;
                }
                break;
            case "TELNET":
                $datavalues = $data->Data;
                $this->SendDebug("Data Telnet:",json_encode($datavalues),0);

                if($Zone == 0){
                    //SurroundDisplay
                    if ($this->ReadPropertyBoolean('SurroundDisplay')){
                        $SurroundDisplay = $data->SurroundDisplay;
                        if($SurroundDisplay !== "")
                        {
                            $this->SendDebug("Surround Display:",$SurroundDisplay,0);
                            SetValueString($this->GetIDForIdent("SurroundDisplay"), $SurroundDisplay);
                        }
                    }
                    // NSADisplay
                    if ($this->ReadPropertyBoolean('Display'))
                    {
                        $NSADisplay = $data->NSADisplay;
                        $NSADisplayLog = json_encode($NSADisplay);
                        $this->SendDebug("Display:",$NSADisplayLog,0);
                        if ($this->debug){
                            IPS_LogMessage("Denon Telnet AVR", "Display: ".$NSADisplayLog);
                        }

                        $idDisplay = $this->GetIDForIdent("Display");
                        $DisplayHTML = GetValue($idDisplay);
                        $doc = new DOMDocument();
                        $doc->loadHTML($DisplayHTML);
                        foreach ($NSADisplay as $row => $content){
                            $doc->getElementById('NSARow'.$row)->nodeValue = $content;
                        }
                        SetValueString($idDisplay, $doc->saveHTML());
                    }
                }
                break;
            default:
                trigger_error(get_class().'::'.__FUNCTION__.': Unknown response type: '.$ResponseType);
                return false;
        }

        if (!isset($datavalues)){
            IPS_LogMessage(__FUNCTION__, json_encode(debug_backtrace()));
            return false;
        }

        foreach($datavalues as $Ident => $Values)
        {
            $Ident = str_replace(" ", "_", $Ident); //Ident Leerzeichen von Command mit _ ersetzten
            $VarID = @$this->GetIDForIdent($Ident);
            if ($VarID > 0){
                $VarType = $Values->VarType;
                $Subcommand = $Values->Subcommand;
                $Subcommandvalue = $Values->Value;
                switch ($VarType){
                    case 0: //Boolean
                        SetValueBoolean($VarID, $Subcommandvalue);
                        $this->SendDebug("Update ".$ResponseType." ObjektID(boolean):",IPS_GetName($VarID)."(".$VarID.") mit Command: ".$Subcommand.'('.(int)$Subcommandvalue.')',0);
                        if ($this->debug){
                            IPS_LogMessage(get_class().'::'.__FUNCTION__, "Update ObjektID(".$VarID."): ".$Subcommand.'('.(int)$Subcommandvalue.')');
                        }
                        break;
                    case 1: //Integer
                        SetValueInteger($VarID, $Subcommandvalue);
                        $this->SendDebug("Update ".$ResponseType." ObjektID(integer):",IPS_GetName($VarID)."(".$VarID.") mit Command: ".$Subcommand.'('.$Subcommandvalue.')',0);
                        if ($this->debug)
                        {
                            IPS_LogMessage(get_class().'::'.__FUNCTION__, "Update ObjektID(".$VarID."): ".$Subcommand.'('.$Subcommandvalue.')');
                        }
                        break;
                    case 2: //Float
                        SetValueFloat($this->GetIDForIdent($Ident), $Subcommandvalue);
                        $this->SendDebug("Update ".$ResponseType." ObjektID(float):",IPS_GetName($VarID)."(".$VarID.") mit Command: ".$Subcommand.'('.$Subcommandvalue.')',0);
                        if ($this->debug)
                        {
                            IPS_LogMessage(get_class().'::'.__FUNCTION__, "Update ObjektID(".$VarID."): ".$Subcommand.'('.$Subcommandvalue.')');
                        }
                        break;
                    case 3: //String
                        SetValueString($this->GetIDForIdent($Ident), $Subcommandvalue);
                        $this->SendDebug("Update ".$ResponseType." ObjektID(string):",IPS_GetName($VarID)."(".$VarID.") mit Command: ".$Subcommand.'('.$Subcommandvalue.')',0);
                        if ($this->debug)
                        {
                            IPS_LogMessage(get_class().'::'.__FUNCTION__, "Update ObjektID(".$VarID."): ".$Subcommand.'('.$Subcommandvalue.')');
                        }
                        break;
                    default:
                        trigger_error(get_class().'::'.__FUNCTION__.': invalid VarType: '.$VarType);
                }
                //$this->SetHiddenStatus();
            } else {
                // nichts zu tun. Variable ist nicht vorhanden
                if ($this->debug){
                    IPS_LogMessage(get_class().'::'. __FUNCTION__, $this->InstanceID.': Info: Keine Variable mit dem Ident "'.$Ident.'" gefunden.');
                }
            }
        }
        return true;
    }

    private function SetHiddenStatus(){

        $SurroundModusResponse = GetValueString($this->GetIDForIdent(DENON_API_Commands::SURROUNDDISPLAY));

        /* aus Performancegründen deaktiviert
            $this->GetLinked_SetHidden(ID_DENON_SURROUNDBACKMODE); //deaktiv, da kein SurroundBack LS vorhanden ist
            $this->GetLinked_SetHidden(ID_DENON_PLIIZHEIGHT); // deaktiv, da keine Höhen LS vorhanden
            $this->GetLinked_SetHidden(ID_DENON_AFDM); // deaktiv, da keine SurroundBack LS vorhanden
            $this->GetLinked_SetHidden(ID_DENON_AUDIODELAY); // deaktiv, da nur im VideoModus benötigt
            $this->GetLinked_SetHidden(ID_DENON_INPUTMODE); // deaktiv, da der Modus auf Auto belassen werden sollte
            $this->GetLinked_SetHidden(ID_DENON_FRONTSPEAKER); // deaktiv, da keine Frontspeaker B vorhanden
            $this->GetLinked_SetHidden(ID_DENON_AUDYSSEYDSX); // deaktiv, da weder Front Height noch Wide LS vorhanden
            $this->GetLinked_SetHidden(ID_DENON_DRC); // deaktiv, da nur für Dolby TrueHD Signalen gültig
            $this->GetLinked_SetHidden(ID_DENON_DRC); // deaktiv, da nur für Dolby TrueHD Signalen gültig
            $this->GetLinked_SetHidden(ID_DENON_LFELevel); // deaktiv, da nur für DTS Quellen bei Musik auf -10 geschaltet werden sollte (sehr speziell)
        */

        $isRoomSimulated = in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSMCHSTEREO],
                                                            DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSROCKARENA],
                                                            DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSJAZZCLUB],
                                                            DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSMONOMOVIE],
                                                            DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSVIDEOGAME],
                                                            DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSMATRIX],
                                                            DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSVIRTUAL]
                                                            ]);

        // Dolby + PLIIz im Musikmodus?
        $isDolbyPLIIMusicActive = in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2M],
                                                                    DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2XM]
                                                                    ]);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSPAN), !$isDolbyPLIIMusicActive); //Panorama
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSDIM), !$isDolbyPLIIMusicActive); //Dimension
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSCEN), !$isDolbyPLIIMusicActive); //Center Width

        // DTS NEO6 im Musikmodus?
        $isDTSNeo6MusicActive = in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$DTSSurroundModes[DENON_API_Commands::DTSNEO6M]]);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSCEI), !$isDTSNeo6MusicActive);

        // CinemaEQ möglich?
        $isCinemaEQPossible = in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2C],
                                                                DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2XC],
                                                                DenonAVRCP_API_Data::$DTSSurroundModes[DENON_API_Commands::DTSNEO6C]
        ]);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSCINEMAEQ), !$isCinemaEQPossible);

        // ToneCtrl bzw. Bass/Treble möglich?
        $isToneCtrlPossible = !in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSDIRECT],
                                                                 DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSPUREDIRECT]
                                                                ])
            && !GetValueBoolean($this->GetIDForIdent(DENON_API_Commands::PSDYNEQ)); //Dynamic EQ
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSTONECTRL), !$isToneCtrlPossible);

        $isBassTreblePossible = $isToneCtrlPossible && GetValueBoolean($this->GetIDForIdent(DENON_API_Commands::PSTONECTRL));
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSBAS), !$isBassTreblePossible); //Bass Level
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSTRE), !$isBassTreblePossible); //Treble Level

        // Audyssey möglich?
        $isAudysseyPossible = !in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSDIRECT],
                                                                 DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSPUREDIRECT]
                                                                ]);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSMULTEQ), !$isAudysseyPossible);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSDYNEQ), !$isAudysseyPossible);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSDYNVOL), !$isAudysseyPossible);

        // AudysseyDSX möglich?
        //	$isAudysseyDSXPossible = !in_array($SurroundModusResponse, ['DIRECT', 'PURE DIRECT', 'STEREO', 'DOLBY PL2Z H', 'MCH STEREO'])
        //								&& !$isRoomSimulated;
        //	$this->GetLinked_SetHidden(ID_DENON_AUDYSSEYDSX, !$isAudysseyDSXPossible);

        // Restorer und DRC möglich?
        $isRestorerAndDRCPossible = in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSSTEREO],
                                                                        DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2ZH],
                                                                        DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2C],
                                                                        DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2M],
                                                                        DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2G],
                                                                        DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2XC],
                                                                        DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2XM],
                                                                        DenonAVRCP_API_Data::$DolbySurroundModes[DENON_API_Commands::DOLBYPL2XG],
                                                                        ])
            || $isRoomSimulated;
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSRSTR), !$isRestorerAndDRCPossible);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSDRC), !$isRestorerAndDRCPossible);

        // Subwoofer möglich?
        $isSubwooferPossible = in_array($SurroundModusResponse, [DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSDIRECT],
                                                                    DenonAVRCP_API_Data::$SurroundModes[DENON_API_Commands::MSPUREDIRECT]
                                                                ]);
        $this->GetLinked_SetHidden($this->GetIDForIdent(DENON_API_Commands::PSSWR), !$isSubwooferPossible);

        if ($this->debug){
            IPS_LogMessage(basename(__FILE__, '.ips.php').'.'.__FUNCTION__,'isDolbyPLIIMusicActive: '.(int) $isDolbyPLIIMusicActive
                .', isDTSNeo6MusicActive: '.(int) $isDTSNeo6MusicActive
                .', isCinemaEQPossible: '.(int) $isCinemaEQPossible
                .', isToneCtrlPossible: '.(int) $isToneCtrlPossible
                .', isAudysseyPossible: '.(int) $isAudysseyPossible
                .', isRoomSimulated: '.(int) $isRoomSimulated
                .', isSubwooferPossible: '.(int) $isSubwooferPossible
            );
        }

    }

    //*************************************************************************************************************
    // Links zu einer Variablen werden gesucht und versteckt/aufgedeckt
    private function GetLinked_SetHidden($VariablenID, $Value=True){
        $Result = false;

        foreach(IPS_GetLinkList() as $LinkID){
            $TargetID = IPS_GetLink($LinkID)['TargetID'];
            If ($TargetID == $VariablenID){
                IPS_SetHidden($TargetID, $Value);
                $Result = true;
            }
        }
        return $Result;
    }

    protected function RegisterProperties(){

        $this->RegisterPropertyInteger("manufacturer", 0);
        $this->RegisterPropertyInteger("AVRTypeDenon", 50);
        $this->RegisterPropertyInteger("AVRTypeMarantz", 50);
        $this->RegisterPropertyInteger("Zone", 6);

        // all Checkboxes for the selection of the variables have to be registered
        $DenonAVRVar = new DENONIPSProfiles();

        $profiles = $DenonAVRVar->GetAllProfiles();
        foreach ($profiles as $profile){
            if ($this->debug){
                IPS_LogMessage(get_class().'::'.__FUNCTION__,'Property registered: '.$profile['PropertyName']);
            }
            $this->RegisterPropertyBoolean($profile['PropertyName'], false);
        }

        //Zusätzliche Inputs
        $this->RegisterPropertyBoolean("FAVORITES", false);
        $this->RegisterPropertyBoolean("IRADIO", false);
        $this->RegisterPropertyBoolean("SERVER", false);
        $this->RegisterPropertyBoolean("NAPSTER", false);
        $this->RegisterPropertyBoolean("LASTFM", false);
        $this->RegisterPropertyBoolean("FLICKR", false);

        //Alexa
        $this->RegisterPropertyBoolean("Alexa", false);
        $this->RegisterPropertyString("AlexaPower", "Verstärker Power");
        $this->RegisterPropertyString("AlexaPowerZone", "Verstärker Power");

        //Neo
        $this->RegisterPropertyBoolean("NEOToggle", false);
        $this->RegisterPropertyInteger("NEOToggleCategoryID", 0);


    }


    protected function RegisterVariables(DENONIPSProfiles $DenonAVRVar, $idents, $AVRType, $manufacturername)
    {

        if ($this->debug){
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'variables: '.json_encode($idents));
        }

        if (!in_array($manufacturername, [DENONIPSProfiles::ManufacturerDenon, DENONIPSProfiles::ManufacturerMarantz])){
            trigger_error('ManufacturerName not set');
            return false;
        }

        // Add/Remove according to feature activation
        // create link list for deletion of links if target is deleted
        $links = Array();
        foreach( IPS_GetLinkList() as $key=>$LinkID ){
            $links[] =  Array( ('LinkID') => $LinkID, ('TargetID') =>  IPS_GetLink($LinkID)['TargetID'] );
        }


        //Sichtbare Variablen anlegen
        foreach ($idents as $ident => $visible){

            $statusvariable = $DenonAVRVar->SetupVariable($ident);

            //Auswahl Prüfen
            if ($visible){
                switch ($statusvariable['Type']){
                    case DENONIPSVarType::vtString:
                        if ($statusvariable["ProfilName"] == "~HTMLBox"){
                            $profilname = "~HTMLBox";
                        } else {
                            $profilname = $manufacturername.'.'.$AVRType.'.'.$statusvariable["ProfilName"];
                            $this->CreateProfileString($profilname, $statusvariable["Icon"]);
                            $this->SendDebug("Variablenprofil angelegt: ",$profilname,0);
                            if($this->debug){
                                IPS_LogMessage('Denon Telnet AVR','Variablenprofil angelegt: '.$profilname);
                            }
                        }

                        $id = $this->RegisterVariableString ($statusvariable["Ident"], $statusvariable["Name"], $profilname, $statusvariable["Position"]);

                        //todo: prüfen, was hier wofür zusätzlich gemacht wird
                        if ($ident == DENONIPSProfiles::ptDisplay){
                            $DisplayHTML = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd"><html><body><div id="NSARow0"></div><div id="NSARow1"></div><div id="NSARow2"></div><div id="NSARow3"></div><div id="NSARow4"></div><div id="NSARow5"></div><div id="NSARow6"></div><div id="NSARow7"></div><div id="NSARow8"></div></body></html>';
                            SetValueString($this->GetIDForIdent(DENONIPSProfiles::ptDisplay), $DisplayHTML);
                        }
                        break;

                    case DENONIPSVarType::vtBoolean:
                        $id = $this->RegisterVariableBoolean($statusvariable["Ident"], $statusvariable["Name"], '~Switch', $statusvariable["Position"]);
                        $this->EnableAction($statusvariable["Ident"]);
                        break;

                    case DENONIPSVarType::vtInteger:
                        $profilname = $manufacturername.'.'.$AVRType.'.'.$statusvariable["ProfilName"];
                        $this->CreateProfileIntegerAss(
                            $profilname, $statusvariable["Icon"],
                            $statusvariable["Prefix"], $statusvariable["Suffix"],
                            $statusvariable["Stepsize"], $statusvariable["Digits"],
                            $statusvariable["Associations"]
                        );
                        $this->SendDebug("Variablenprofil angelegt: ",$profilname,0);
                        if($this->debug)
                        {
                            IPS_LogMessage('Denon Telnet AVR','Variablenprofil angelegt: '.$profilname);
                        }

                        $id = $this->RegisterVariableInteger($statusvariable["Ident"], $statusvariable["Name"], $profilname, $statusvariable["Position"]);
                        $this->EnableAction($statusvariable["Ident"]);
                        break;

                    case DENONIPSVarType::vtFloat:
                        $profilname = $manufacturername.'.'.$AVRType.'.'.$statusvariable["ProfilName"];
                        $this->CreateProfileFloat($profilname, $statusvariable["Icon"], $statusvariable["Prefix"], $statusvariable["Suffix"], $statusvariable["MinValue"], $statusvariable["MaxValue"], $statusvariable["Stepsize"], $statusvariable["Digits"]);
                        $this->SendDebug("Variablenprofil angelegt: ",$profilname,0);
                        if($this->debug)
                        {
                            IPS_LogMessage('Denon Telnet AVR','Variablenprofil angelegt: '.$profilname);
                        }
                        $id = $this->RegisterVariableFloat($statusvariable["Ident"], $statusvariable["Name"], $profilname, $statusvariable["Position"]);
                        $this->EnableAction($statusvariable["Ident"]);
                        break;

                    default:
                        trigger_error(get_class().'::'.__FUNCTION__.': invalid Type: '.$statusvariable['Type']);
                        return false;

                }

                $this->SendDebug("Variable angelegt: ",$statusvariable["Name"].' [ObjektID: '.$id.']',0);
                if($this->debug){
                    IPS_LogMessage('Denon Telnet AVR','Variable angelegt: '. $statusvariable["Name"].' [ObjektID: '.$id.']');
                }
            }
            // wenn nicht sichtbar löschen
            else {
                $this->removeVariableAction($statusvariable["Ident"], $links, $ident);
            }
        }

        return true;

    }

    protected function CreateNEOScripts($NEO_Parameter){
        // alle Instancevariablen vom Typ boolean suchen
        $ObjectIds = IPS_GetChildrenIDs($this->InstanceID);
        foreach ($ObjectIds as $ObjectId){
            // wenn es sich um eine Variable handelt und die vom Typ Boolean ist
            $obj = IPS_GetObject($ObjectId);
            if (($obj['ObjectType'] == 2 /*Variable*/) && IPS_GetVariable($ObjectId)['VariableType'] == DENONIPSVarType::vtBoolean){
                $Ident = $obj['ObjectIdent'];
                 if (array_key_exists($Ident, $NEO_Parameter)){
                    $this->WriteNEOScript($ObjectId, $NEO_Parameter[$Ident][0], $NEO_Parameter[$Ident][1]);
                }

            }
        }
    }

    protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);//array
        return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;//ConnectionID
    }

    private function CreateProfileInteger($ProfileName, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits)
    {

        if(!IPS_VariableProfileExists($ProfileName)) {
            IPS_CreateVariableProfile($ProfileName, 1);
        } else {
            $profile = IPS_GetVariableProfile($ProfileName);
            if($profile['ProfileType'] != 1)
                throw new Exception("Variable profile type does not match for profile ".$ProfileName);
        }

        IPS_SetVariableProfileIcon($ProfileName, $Icon);
        IPS_SetVariableProfileText($ProfileName, $Prefix, $Suffix);
        IPS_SetVariableProfileDigits($ProfileName, $Digits); //  Nachkommastellen
        IPS_SetVariableProfileValues($ProfileName, $MinValue, $MaxValue, $StepSize);

    }

    private function CreateProfileIntegerAss($ProfileName, $Icon, $Prefix, $Suffix, $StepSize, $Digits, $Associations)
    {
        if ($this->debug){
            IPS_LogMessage(__FUNCTION__, 'Associations: '.json_encode($Associations));
        }
        if ( count($Associations) == 0 ){
            trigger_error(__FUNCTION__.': Associations of profil "'.$ProfileName.'" is empty');
            IPS_LogMessage(__FUNCTION__, json_encode(debug_backtrace()));
            return;
        }

        $MinValue = $Associations[0][0];
        $MaxValue = $Associations[count($Associations)-1][0];

        $this->CreateProfileInteger($ProfileName, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits);

        //zunächst werden alte Assoziationen gelöscht
        //bool IPS_SetVariableProfileAssociation ( string $ProfilName, float $Wert, string $Name, string $Icon, integer $Farbe )
        foreach (IPS_GetVariableProfile($ProfileName)['Associations'] as $Association){
            IPS_SetVariableProfileAssociation($ProfileName, $Association['Value'], '', '', -1);
        }

        //dann werden die aktuellen eingetragen
        foreach($Associations as $Association) {
            IPS_SetVariableProfileAssociation($ProfileName, $Association[0], $Association[1], '', -1);
        }

    }

    private function CreateProfileString($ProfileName, $Icon)
    {

        if(!IPS_VariableProfileExists($ProfileName)) {
            IPS_CreateVariableProfile($ProfileName, DENONIPSVarType::vtString);
        } else {
            $profile = IPS_GetVariableProfile($ProfileName);
            if($profile['ProfileType'] != DENONIPSVarType::vtString)
                throw new Exception('Variable profile type does not match for already existing profile "'.$ProfileName.'". The existing profile has to be deleted manually.'.PHP_EOL);
        }

        IPS_SetVariableProfileIcon($ProfileName, $Icon);
    }

    private function CreateProfileFloat($ProfileName, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits)
    {

        if(!IPS_VariableProfileExists($ProfileName)) {
            IPS_CreateVariableProfile($ProfileName, DENONIPSVarType::vtFloat);
        } else {
            $profile = IPS_GetVariableProfile($ProfileName);
            if($profile['ProfileType'] != DENONIPSVarType::vtFloat)
                throw new Exception('Variable profile type does not match for already existing profile "'.$ProfileName.'". The existing profile has to be deleted manually.'.PHP_EOL);
        }

        IPS_SetVariableProfileIcon($ProfileName, $Icon);
        IPS_SetVariableProfileText($ProfileName, $Prefix, $Suffix);
        IPS_SetVariableProfileDigits($ProfileName, $Digits); //  Nachkommastellen
        IPS_SetVariableProfileValues($ProfileName, $MinValue, $MaxValue, $StepSize);

    }

    protected function GetAPICommandFromIdent($Ident){
        if($Ident == DENON_API_Commands::Z2POWER || $Ident == DENON_API_Commands::Z2INPUT|| $Ident == DENON_API_Commands::Z2VOL){
            $APICommand = DENON_API_Commands::Z2;
        } elseif($Ident == DENON_API_Commands::Z3POWER || $Ident == DENON_API_Commands::Z3INPUT|| $Ident == DENON_API_Commands::Z3VOL){
            $APICommand = DENON_API_Commands::Z3;
        } elseif($Ident == "PVPICT"){
            $APICommand = "PV";
        } else {
            $APICommand = str_replace("_", " ", $Ident); //Ident _ von Ident mit Leerzeichen ersetzten
        }
        return $APICommand;
    }

    protected function GetManufacturerName()
    {
        $manufacturer = $this->ReadPropertyInteger('manufacturer');
        switch ($manufacturer) {
            case 0:
                $manufacturername = DENONIPSProfiles::ManufacturerNone;
                break;
            case 1:
                $manufacturername = DENONIPSProfiles::ManufacturerDenon;
                break;
            case 2: {
                $manufacturername = DENONIPSProfiles::ManufacturerMarantz;
                break;
            }
            default:
                trigger_error('Unnown manufacturer: ' . $manufacturer);
                $manufacturername = false;
        }
        return $manufacturername;
    }

    protected function GetAVRType($manufacturername)
    {

        switch ($manufacturername){
            case DENONIPSProfiles::ManufacturerDenon:
                $TypeInt = $this->ReadPropertyInteger('AVRTypeDenon');
                break;
            case DENONIPSProfiles::ManufacturerMarantz:
                $TypeInt = $this->ReadPropertyInteger('AVRTypeMarantz');
                break;
            default:
                return false;
        }

        if ($TypeInt == 50){ //none
            return false;
        }

        foreach (AVRs::getAllAVRs() as $AVRType => $Caps){
            if ($Caps['internalID'] == $TypeInt){
                return $Caps['Name'];
            }
        }

        return false;
    }

    protected function removeVariableAction($Ident, $links, $Profile)
    {
        $vid = @$this->GetIDForIdent($Ident);
        if ($vid !== false)
        {
            $Name = IPS_GetName ($vid);
            // delete links to Variable
            foreach( $links as $key=>$value ){
                if ( $value['TargetID'] === $vid )
                    IPS_DeleteLink($value['LinkID']);
            }
            $this->DisableAction($Ident);
            $this->UnregisterVariable($Ident);
            $this->SendDebug("Variable gelöscht:",$Name.', [ObjektID: '.$vid.']',0);
            if($this->debug){
                IPS_LogMessage(get_class().'::'.__FUNCTION__,'Variable gelöscht: '.$Name.', [ObjektID: '.$vid.']');
            }
            //delete Profile
            if (IPS_VariableProfileExists ($Profile))
            {
                IPS_DeleteVariableProfile($Profile);
                $this->SendDebug("Variablenprofilprofil gelöscht:",$Profile,0);
                if ($this->debug){
                    IPS_LogMessage(get_class().'::'.__FUNCTION__,'Variablenprofil gelöscht:'.$Profile);
                }

            }

        }
    }

    protected function GetInputsAVR(DENONIPSProfiles $DenonAVRVar)
    {
        $Zone = $this->ReadPropertyInteger("Zone");

        $DenonAVRVar->SetInputSources(
            $this->GetIPParent(),
            $Zone,
            $this->ReadPropertyBoolean('FAVORITES'),
            $this->ReadPropertyBoolean('IRADIO'),
            $this->ReadPropertyBoolean('SERVER'),
            $this->ReadPropertyBoolean('NAPSTER'),
            $this->ReadPropertyBoolean('LASTFM'),
            $this->ReadPropertyBoolean('FLICKR')
        );
        return $DenonAVRVar->GetInputVarMapping($Zone);
    }

    //IP des AVR aus der Spitter Instanz
    protected function GetIPParent(){
        $IP = IPS_GetProperty($this->GetParent(), 'Host');
        if (!filter_var($IP, FILTER_VALIDATE_IP) === false){
            return $IP;
        } else {
            return false;
        }

    }

    protected function FormSelectionZone(){
        return '                { "type": "Label", "label": "Please select an AVR zone and push the \"apply\" button"},
            { "type": "Select", "name": "Zone", "caption": "AVR Zone",
                    "options": [
                                { "value": 0, "label": "Main Zone" },
                                { "value": 1, "label": "Zone 2" },
                                { "value": 2, "label": "Zone 3" },
                                { "value": 6, "label": "select zone" }
                               ]
            },';
    }

    protected function FormSelectionAVR($manufacturer)
    {
        $form =
            '
            { "type": "Label", "label": "Please select an AVR type and push the \"apply\" button"},
            { "type": "Select", "name": "AVRType'.$manufacturer.'", "caption": "Type AVR '.$manufacturer.'",
                    "options": [
                                { "value": 50, "label": "select AVR Type" },
';

        foreach (AVRs::getAllAVRs() as $AVRName => $Caps){
            if ($Caps['Manufacturer'] == $manufacturer){
                $form .=
                    '                                    { "value": '.$Caps['internalID'].', "label": "'.$AVRName.'" },'.PHP_EOL;
            }
        }

        // JSON standard does not allow trailing comma
        $form = substr($form, 0, -(strlen(PHP_EOL)+1)).PHP_EOL;

        $form .=
            '                                   ]
            },'.PHP_EOL;

        return $form;
    }

    protected function FormSelectionNEO()
    {
        return  '{ "type": "Label", "label": "create helper scripts for toggling with NEO (Mediola):" },
            { "type": "CheckBox", "name": "NEOToggle", "caption": "create separate NEO toggle scripts" },
            { "type": "Label", "label": "category for creating NEO scripts:" },
            { "type": "SelectCategory", "name": "NEOToggleCategoryID", "caption": "script category" },';
    }

    protected function FormSelectionAlexa(){

        if ($this->GetAlexaSmartHomeSkill() > 0){
            return '{ "type": "Label", "label": "__________________________________________________________________________________________________" },
            { "type": "Label", "label": "Amazon Echo / Dot" },
            { "type": "Label", "label": "Alexa Smart Home Skill is available in IP-Symcon" },
            { "type": "Label", "label": "Would you like to create links in the SmartHomeSkill instance for voice control?" },
            { "type": "CheckBox", "name": "Alexa", "caption": "Create links for Amazon Echo / Dot" },
            { "type": "Label", "label": "Alexa name for Power" },
            { "type": "ValidationTextBox", "name": "AlexaPower", "caption": "Alexa Power" },
            { "type": "Label", "label": "Alexa name for Power Zone" },
            { "type": "ValidationTextBox", "name": "AlexaPowerZone", "caption": "Alexa Power Zone" },';
        } else {
            return '';
        }
    }

    protected function FormStatus(){
        return '"status":
        [
            {
                "code": 101,
                "icon": "inactive",
                "caption": "creating instance."
            },
            {
                "code": 102,
                "icon": "active",
                "caption": "configuration is valid."
            },
            {
                "code": 104,
                "icon": "inactive",
                "caption": "AVR ist inaktiv."
            },
            {
                "code": 204,
                "icon": "error",
                "caption": "IP address is not valid."
            },
            {
                "code": 210,
                "icon": "error",
                "caption": "select a manufacturer."
            },
            {
                "code": 211,
                "icon": "error",
                "caption": "select category for import."
            },
            {
                "code": 212,
                "icon": "error",
                "caption": "please select an AVR Zone."
            },
            {
                "code": 213,
                "icon": "error",
                "caption": "please select a Denon AVR type."
            },
            {
                "code": 214,
                "icon": "error",
                "caption": "please select a Marantz AVR type."
            }
        ]';
    }

    protected function getTypeItem($type, $command, $propertyname, $caption, $CapsItems = null){
        if ($propertyname==''){
            trigger_error(get_class().'::'.__FUNCTION__.': '.$command.': PropertyName nicht gesetzt.');
            return false;
        }

        // is the command supported?
         if (is_null($CapsItems) || in_array($command, $CapsItems)){
            return 	'{ "type": "'.$type.'", "name": "'.$propertyname.'", "caption": "'.$caption.' ('.$command.')" },'.PHP_EOL;
        } else {
            return '';
        }
    }

    private function GetAlexaSmartHomeSkill()
    {
        $InstanzenListe = IPS_GetInstanceListByModuleID("{3F0154A4-AC42-464A-9E9A-6818D775EFC4}"); // IQL4SmartHome

        if (count($InstanzenListe) > 0){
            return $InstanzenListe[0];
        } else {
            return false;
        }
    }

    protected function CreateAlexaLinks($manufacturername, $AVRType, $Zone)
    {
        $AlexaLinkNamePower = $this->ReadPropertyString("AlexaPower");
        $AlexaLinkNameZonePower = $this->ReadPropertyString("AlexaPowerZone");
        $IQL4SmartHomeID = $this->GetAlexaSmartHomeSkill();

        //Prüfen ob Kategorie schon existiert, sonst anlegen
        $AlexaCategoryID = @IPS_GetObjectIDByIdent("AlexaAVR", $IQL4SmartHomeID);
        if ($AlexaCategoryID === false){
            $AlexaCategoryID = IPS_CreateCategory();
            IPS_SetName($AlexaCategoryID, "AV Receiver");
            IPS_SetIdent($AlexaCategoryID, "AlexaAVR");
            IPS_SetInfo($AlexaCategoryID, "AV Receiver über Alexa an/ausschalten");
            IPS_SetParent($AlexaCategoryID, $IQL4SmartHomeID);
        }

        //Prüfen ob Link schon vorhanden
        $identPower = $manufacturername."_".str_replace("-", "_", $AVRType)."_Power";
        $LinkIDPower = @IPS_GetObjectIDByIdent($identPower, $AlexaCategoryID);
        if ($LinkIDPower === false){
            // Anlegen eines neuen Links für Power
            $LinkIDPower = IPS_CreateLink();             // Link anlegen
            IPS_SetIdent($LinkIDPower, $identPower); //ident
            IPS_SetLinkTargetID($LinkIDPower, ($this->GetIDForIdent("PW")));    // Link verknüpfen
            IPS_SetInfo($LinkIDPower, $manufacturername." ".$AVRType." Power");
            IPS_SetParent($LinkIDPower, $AlexaCategoryID); // Link einsortieren
        }

        IPS_SetName($LinkIDPower, $AlexaLinkNamePower); // Link benennen

        switch ($Zone){
            case 0: //Mainzone
                $identMainzonePower = $manufacturername."_".$identPower."_MainzonePower";
                $LinkID = @IPS_GetObjectIDByIdent($identMainzonePower, $AlexaCategoryID);
                if ($LinkID === false){
                    // Anlegen eines neuen Links für Power
                    $LinkID = IPS_CreateLink();             // Link anlegen
                    IPS_SetIdent($LinkID, $identMainzonePower); //ident
                    IPS_SetLinkTargetID($LinkID, ($this->GetIDForIdent("ZM")));    // Link verknüpfen
                    IPS_SetInfo($LinkID, $manufacturername." ".$AVRType." Mainzone Power");
                    IPS_SetParent($LinkID, $AlexaCategoryID); // Link einsortieren
                }
                IPS_SetName($LinkID, $AlexaLinkNameZonePower." Mainzone"); // Link benennen
                break;

            case 1: //Zone 2
                $identZone2Power = $manufacturername."_".$identPower."_Zone2Power";
                $LinkID = @IPS_GetObjectIDByIdent($identZone2Power, $AlexaCategoryID);
                if ($LinkID === false){
                    // Anlegen eines neuen Links für Zone2Power
                    IPS_SetIdent($LinkID, $identZone2Power); //ident
                    IPS_SetLinkTargetID($LinkID, ($this->GetIDForIdent("ZM")));    // Link verknüpfen
                    IPS_SetInfo($LinkID, $manufacturername." ".$AVRType." Zone 2 Power");
                    IPS_SetParent($LinkID, $AlexaCategoryID); // Link einsortieren
                }
                IPS_SetName($LinkID, $AlexaLinkNameZonePower." Zone 2"); // Link benennen
                break;

            case 2:// Zone 3
                $identZone3Power = $manufacturername."_".$identPower."_Zone3Power";
                $LinkID = @IPS_GetObjectIDByIdent($identZone3Power, $AlexaCategoryID);
                if ($LinkID === false){
                    // Anlegen eines neuen Links für Zone2Power
                    IPS_SetIdent($LinkID, $identZone3Power); //ident
                    IPS_SetLinkTargetID($LinkID, ($this->GetIDForIdent("Z3POWER")));    // Link verknüpfen
                    IPS_SetInfo($LinkID, $manufacturername." ".$AVRType." Zone 3 Power");
                    IPS_SetParent($LinkID, $AlexaCategoryID); // Link einsortieren
                }
                IPS_SetName($LinkID, $AlexaLinkNameZonePower." Zone 3"); // Link benennen
                break;

            default:
                trigger_error(__FUNCTION__.': unknown zone: '.$Zone);
                return false;
        }

        return true;
    }

    protected function DeleteAlexaLinks($manufacturername, $AVRType, $Zone){

        $IQL4SmartHomeID = $this->GetAlexaSmartHomeSkill();
        $AlexaCategoryID = @IPS_GetObjectIDByIdent("AlexaAVR", $IQL4SmartHomeID);
        $AVRTypeident = str_replace("-", "_", $AVRType);
        $LinkIDPower = @IPS_GetObjectIDByIdent($manufacturername."_".$AVRTypeident."_Power", $AlexaCategoryID);

        $LinkID = 0;
        if ($Zone == 0)//Mainzone
        {
            $LinkID = @IPS_GetObjectIDByIdent($manufacturername."_".$AVRTypeident."_MainzonePower", $AlexaCategoryID);
        }
        elseif ($Zone == 1) //Zone 2
        {
            $LinkID = @IPS_GetObjectIDByIdent($manufacturername."_".$AVRTypeident."_Zone2Power", $AlexaCategoryID);
        }
        elseif ($Zone == 2) // Zone 3
        {
            $LinkID = @IPS_GetObjectIDByIdent($manufacturername."_".$AVRTypeident."_Zone3Power", $AlexaCategoryID);
        }

        if($LinkID > 0)
        {
            IPS_DeleteLink($LinkID);
        }

        if($LinkIDPower > 0)
        {
            IPS_DeleteLink($LinkIDPower);
        }


        if($AlexaCategoryID > 0)
        {
            if (empty(IPS_GetChildrenIDs($AlexaCategoryID))){
                IPS_DeleteCategory($AlexaCategoryID);
            }
        }
    }

    private function WriteNEOScript($ObjectID, $FunctionName, $LogLabel)
    {
        $InstanzID   = IPS_GetParent($ObjectID);
        $InstanzName = IPS_GetName($InstanzID);
        $Name        = IPS_GetName($ObjectID);
        $KatID       = $this->ReadPropertyInteger('NEOToggleCategoryID');
        $ScriptName  = $InstanzName . " " . $Name . "_toggle";
        $SkriptID    = @IPS_GetScriptIDByName($ScriptName, $KatID);

        if ($SkriptID === FALSE)
        {
            $Content
                = '
<?
$status = GetValueBoolean(' . $ObjectID . '); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	' . $FunctionName . '(' . $InstanzID . ', true);
	IPS_LogMessage( "Denon Telnet AVR" , "' . $LogLabel . ' einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
	' . $FunctionName . '(' . $InstanzID . ', false);
	IPS_LogMessage( "Denon Telnet AVR" , "' . $LogLabel . ' ausschalten" );
	}

?>';

            // write Script
            $ScriptID = IPS_CreateScript(0);
            IPS_SetName($ScriptID, $ScriptName);
            IPS_SetParent($ScriptID, $KatID);
            IPS_SetScriptContent($ScriptID, $Content);

            return $ScriptID;

        }
        return false;
    }
}

class DENONIPSVarType extends stdClass
{
    //  API Datentypen
    const vtNone = -1;
    const vtBoolean = 0;
    const vtInteger = 1;
    const vtFloat = 2;
    const vtString = 3;
}

class DENONIPSProfiles extends stdClass
{
    private $debug = true;

    private $AVRType;
    private $profiles;

	const ManufacturerDenon = "Denon";
	const ManufacturerMarantz = "Marantz";
	const ManufacturerNone = "none";

	//Profiltype
    const ptPower ='Power';
    const ptMasterVolume = 'MasterVolume';

    const ptChannelVolumeFL = 'ChannelVolumeFL';
    const ptChannelVolumeFR = 'ChannelVolumeFR';
    const ptChannelVolumeC = 'ChannelVolumeC';
    const ptChannelVolumeSW = 'ChannelVolumeSW';
    const ptChannelVolumeSW2 = 'ChannelVolumeSW2';
    const ptChannelVolumeSL = 'ChannelVolumeSL';
    const ptChannelVolumeSR = 'ChannelVolumeSR';
    const ptChannelVolumeSBL = 'ChannelVolumeSBL';
    const ptChannelVolumeSBR = 'ChannelVolumeSBR';
    const ptChannelVolumeSB = 'ChannelVolumeSB';
    const ptChannelVolumeFHL = 'ChannelVolumeFHL';
    const ptChannelVolumeFHR = 'ChannelVolumeFHR';
    const ptChannelVolumeFWL = 'ChannelVolumeFWL';
    const ptChannelVolumeFWR = 'ChannelVolumeFWR';
    const ptMainMute = 'MainMute';
    const ptInputSource = 'Inputsource';
	const ptMainZonePower = 'MainZonePower';
    const ptInputMode = 'InputMode';
    const ptDigitalInputMode = 'DigitalInputMode';
    const ptVideoSelect = 'VideoSelect';
    const ptSleep = 'Sleep';
    const ptSurroundMode = 'SurroundMode';
    const ptQuickSelect = 'QuickSelect';
    const ptSmartSelect = 'SmartSelect';
    const ptHDMIMonitor = 'HDMIMonitor';
    const ptASP = 'ASP';
    const ptResolution = 'Resolution';
    const ptResolutionHDMI = 'ResolutionHDMI';
    const ptHDMIAudioOutput = 'HDMIAudioOutput';
    const ptVideoProcessingMode = 'VideoProcessingMode';
    const ptToneCTRL = 'ToneCTRL';
    const ptSurroundBackMode = 'SurroundBackMode';
    const ptSurroundPlayMode = 'SurroundPlayMode';
    const ptFrontHeight = 'FrontHeight';
    const ptPLIIZHeightGain = 'PLIIZHeightGain';
    const ptSpeakerOutput = 'SpeakerOutputFront';
    const ptMultiEQMode = 'MultiEQMode';
    const ptDynamicEQ = 'DynamicEQ';
    const ptAudysseyLFC = 'AudysseyLFC';
    const ptAudysseyContainmentAmount = 'AudysseyContainmantAmount';
    const ptReferenceLevel = 'ReferenceLevel';
    const ptDynamicVolume = 'DynamicVolume';
    const ptAudysseyDSX = 'AudysseyDSX';
    const ptStageWidth = 'StageWidth';
    const ptStageHeight = 'StageHeight';
    const ptBassLevel = 'BassLevel';
    const ptTrebleLevel = 'TrebleLevel';
    const ptLoudnessManagement = 'LoudnessManagement';
    const ptDynamicRangeCompression = 'DynamicRangeCompression';
    const ptMDAX = 'MDAX';
    const ptDynamicCompressor = 'DynamicCompressor';
    const ptLFELevel = 'LFELevel';
    const ptLFE71Level = 'LFE71Level';
    const ptEffectLevel = 'EffectLevel';
    const ptDelay = 'Delay';
    const ptAFDM = 'AFDM';
    const ptPanorama = 'Panorama';
    const ptDimension = 'Dimension';
    const ptDialogControl = 'DialogControl';
    const ptCenterWidth = 'CenterWidth';
    const ptCenterImage = 'CenterImage';
    const ptCenterGain = 'CenterGain';
    const ptSubwoofer = 'Subwoofer';
    const ptRoomSize = 'RoomSize';
    const ptAudioDelay = 'AudioDelay';
    const ptAudioRestorer = 'AudioRestorer';
    const ptFrontSpeaker = 'FrontSpeaker';
    const ptContrast = 'Contrast';
    const ptBrightness = 'Brightness';
    const ptSaturation = 'Saturation';
    const ptChromalevel = 'Chromalevel';
    const ptHue = 'Hue';
    const ptDigitalNoiseReduction = 'DNRDirectChange';
    const ptPictureMode = 'PictureMode';
    const ptEnhancer = 'Enhancer';

    const ptZone2Power = 'Zone2Power';
    const ptZone2InputSource = 'Zone2InputSource';
    const ptZone2Volume = 'Zone2Volume';
    const ptZone2Mute = 'Zone2Mute';
    const ptZone2ChannelSetting = 'Zone2ChannelSetting';
    const ptZone2ChannelVolumeFL = 'Zone2ChannelVolumeFL';
    const ptZone2ChannelVolumeFR = 'Zone2ChannelVolumeFR';
    const ptZone2HPF = 'Zone2HPF';
    const ptZone2Bass = 'Zone2Bass';
    const ptZone2Treble = 'Zone2Treble';
    const ptZone2QuickSelect = 'Zone2QuickSelect';
    const ptZone2SmartSelect = 'Zone2SmartSelect';
    const ptZone2Sleep = 'Zone2Sleep';

    const ptZone3InputSource = 'Zone3InputSource';
    const ptZone3Volume = 'Zone3Volume';
    const ptZone3Mute = 'Zone3Mute';
    const ptZone3ChannelSetting = 'Zone3ChannelSetting';
    const ptZone3ChannelVolumeFL = 'Zone3ChannelVolumeFL';
    const ptZone3ChannelVolumeFR = 'Zone3ChannelVolumeFR';
    const ptZone3HPF = 'Zone3HPF';
    const ptZone3Bass = 'Zone3Bass';
    const ptZone3Treble = 'Zone3Treble';
    const ptZone3QuickSelect = 'Zone3QuickSelect';
    const ptZone3SmartSelect = 'Zone3SmartSelect';
    const ptZone3Sleep = 'Zone3Sleep';

    const ptCinemaEQ = 'CinemaEQ';
    const ptHTEQ = 'HTEQ';
    const ptDynamicRange = 'DynamicRange';
	const ptPreset = 'Preset';
	const ptZone2Name = 'Zone2Name';
	const ptZone3Power = 'Zone3Power';
    const ptZone3Name = 'Zone3Name';
    const ptNavigation = 'Navigation';
	const ptSubwooferATT = 'SubwooferATT';
	//const ptDCOMPDirectChange = 'DCOMPDirectChange';
	const ptDolbyVolumeLeveler = 'DolbyVolumeLeveler';
	const ptDolbyVolumeModeler = 'DolbyVolumeModeler';
	const ptVerticalStretch = 'VerticalStretch';
	const ptDolbyVolume = 'DolbyVolume';
	const ptFriendlyName = 'FriendlyName';
	const ptMainZoneName = 'MainZoneName';
	const ptTopMenuLink = 'TopMenuLink';
	const ptModel = 'Model';
	const ptGUISourceSelect = 'GUIMenuSourceSelect';
	const ptGUIMenu = 'GUIMenu';
	const ptSurroundDisplay = 'SurroundDisplay';
	const ptDisplay = 'Display';
	const ptGraphicEQ = 'GraphicEQ';
	const ptDimmer = 'Dimmer';
	const ptDialogLevelAdjust = 'DialogLevelAdjust';
	const ptMAINZONEAutoStandbySetting = 'MAINZONEAutoStandbySetting';
	const ptMAINZONEECOModeSetting = 'MAINZONEECOModeSetting';
	const ptCenterSpread = 'Centerspread';
    const ptNeural = 'Neural';
    const ptAllZoneStereo = 'AllZoneStereo';
    const ptBassSync = 'BassSync';
    const ptSubwooferLevel = 'SubwooferLevel';
    const ptSubwoofer2Level = 'Subwoofer2Level';
    const ptDialogEnhancer = 'DialogEnhancer';
    const ptAuroMatic3DPreset = 'AuroMatic3DPreset';
	const ptAuroMatic3DStrength = 'AuroMatic3DStrength';
	const ptTopFrontLch = 'TopFrontLch';
	const ptTopFrontRch = 'TopFrontRch';
	const ptTopMiddleLch = 'TopMiddleLch';
	const ptTopMiddleRch = 'TopMiddleRch';
	const ptTopRearLch = 'TopRearLch';
	const ptTopRearRch = 'TopRearRch';
	const ptRearHeightLch = 'RearHeightLch';
	const ptRearHeightRch = 'RearHeightRch';
	const ptFrontDolbyLch = 'FrontDolbyLch';
	const ptFrontDolbyRch = 'FrontDolbyRch';
	const ptSurroundDolbyLch = 'SurroundDolbyLch';
	const ptSurroundDolbyRch = 'SurroundDolbyRch';
	const ptBackDolbyLch = 'BackDolbyLch';
	const ptBackDolbyRch = 'BackDolbyRch';
    const ptSurroundHeightLch = 'SurroundHeightLch';
    const ptSurroundHeightRch = 'SurroundHeightRch';
    const ptTopSurround = 'TopSurround';
    const ptChannelVolumeReset = 'ChannelVolumeReset';
    const ptZone2HDMIAudio = 'Zone2HDMIAudio';
	const ptZone2AutoStandbySetting = 'Zone2AutoStandbySetting';
	const ptZone3AutoStandbySetting = 'Zone3AutoStandbySetting';

    static $order = [
        //Info Display
        DENONIPSProfiles::ptMainZoneName,
        DENONIPSProfiles::ptModel,

        //Power Settings
        DENONIPSProfiles::ptPower,
        DENONIPSProfiles::ptMainZonePower,
        DENONIPSProfiles::ptMainMute,
        DENONIPSProfiles::ptSleep,
        DENONIPSProfiles::ptMAINZONEAutoStandbySetting,
        DENONIPSProfiles::ptMAINZONEECOModeSetting,

        //Input Settings
        DENONIPSProfiles::ptInputSource,
        DENONIPSProfiles::ptQuickSelect,
        DENONIPSProfiles::ptSmartSelect,
        DENONIPSProfiles::ptDigitalInputMode,
        DENONIPSProfiles::ptInputMode,
        DENONIPSProfiles::ptVideoSelect,

        //Surround Mode
        DENONIPSProfiles::ptSurroundMode,
        DENONIPSProfiles::ptSurroundDisplay,
        DENONIPSProfiles::ptNavigation,
        DENONIPSProfiles::ptDolbyVolume,
        DENONIPSProfiles::ptDolbyVolumeLeveler,
        DENONIPSProfiles::ptDolbyVolumeModeler,
        DENONIPSProfiles::ptDisplay,

        //Channel Volumes
        DENONIPSProfiles::ptMasterVolume,
        DENONIPSProfiles::ptChannelVolumeFL,
        DENONIPSProfiles::ptChannelVolumeFR,
        DENONIPSProfiles::ptChannelVolumeC,
        DENONIPSProfiles::ptChannelVolumeSW,
        DENONIPSProfiles::ptChannelVolumeSW2,
        DENONIPSProfiles::ptChannelVolumeSL,
        DENONIPSProfiles::ptChannelVolumeSR,
        DENONIPSProfiles::ptChannelVolumeSBL,
        DENONIPSProfiles::ptChannelVolumeSBR,
        DENONIPSProfiles::ptChannelVolumeSB,
        DENONIPSProfiles::ptChannelVolumeFHL,
        DENONIPSProfiles::ptChannelVolumeFHR,
        DENONIPSProfiles::ptChannelVolumeFWL,
        DENONIPSProfiles::ptChannelVolumeFWR,
        DENONIPSProfiles::ptTopFrontLch,
        DENONIPSProfiles::ptTopFrontRch,
        DENONIPSProfiles::ptTopMiddleLch,
        DENONIPSProfiles::ptTopMiddleRch,
        DENONIPSProfiles::ptTopRearLch,
        DENONIPSProfiles::ptTopRearRch,
        DENONIPSProfiles::ptRearHeightLch,
        DENONIPSProfiles::ptRearHeightRch,
        DENONIPSProfiles::ptFrontDolbyLch,
        DENONIPSProfiles::ptFrontDolbyRch,
        DENONIPSProfiles::ptSurroundDolbyLch,
        DENONIPSProfiles::ptSurroundDolbyRch,
        DENONIPSProfiles::ptBackDolbyLch,
        DENONIPSProfiles::ptBackDolbyRch,
        DENONIPSProfiles::ptSurroundHeightLch,
        DENONIPSProfiles::ptSurroundHeightRch,
        DENONIPSProfiles::ptTopSurround,
        DENONIPSProfiles::ptChannelVolumeReset,

        //Sound Processing (Audio Setting)
        DENONIPSProfiles::ptFrontSpeaker,
        DENONIPSProfiles::ptSpeakerOutput,
        DENONIPSProfiles::ptSpeakerOutput,
        DENONIPSProfiles::ptFrontHeight,
        DENONIPSProfiles::ptSubwoofer,
        DENONIPSProfiles::ptToneCTRL,
        DENONIPSProfiles::ptBassLevel,
        DENONIPSProfiles::ptTrebleLevel,
        DENONIPSProfiles::ptLoudnessManagement,
        DENONIPSProfiles::ptBassSync,
        DENONIPSProfiles::ptDialogEnhancer,
        DENONIPSProfiles::ptSubwooferLevel,
        DENONIPSProfiles::ptSubwoofer2Level,
        DENONIPSProfiles::ptDialogLevelAdjust,
        DENONIPSProfiles::ptDialogLevelAdjust,
        DENONIPSProfiles::ptLFELevel,
        DENONIPSProfiles::ptLFE71Level,
        DENONIPSProfiles::ptPanorama,
        DENONIPSProfiles::ptDimension,
        DENONIPSProfiles::ptCenterWidth,
        DENONIPSProfiles::ptCenterSpread,
        DENONIPSProfiles::ptCenterImage,
        DENONIPSProfiles::ptCenterGain,
        DENONIPSProfiles::ptDialogControl,
        DENONIPSProfiles::ptNeural,
        DENONIPSProfiles::ptSurroundPlayMode,
        DENONIPSProfiles::ptPLIIZHeightGain,
        DENONIPSProfiles::ptAudysseyDSX,
        DENONIPSProfiles::ptStageWidth,
        DENONIPSProfiles::ptStageHeight,
        DENONIPSProfiles::ptCinemaEQ,
        DENONIPSProfiles::ptHTEQ,
        DENONIPSProfiles::ptMultiEQMode,
        DENONIPSProfiles::ptDynamicEQ,
        DENONIPSProfiles::ptReferenceLevel,
        DENONIPSProfiles::ptDynamicVolume,
        DENONIPSProfiles::ptAudysseyLFC,
        DENONIPSProfiles::ptAudysseyContainmentAmount,
        DENONIPSProfiles::ptGraphicEQ,
        DENONIPSProfiles::ptDynamicRangeCompression,
        DENONIPSProfiles::ptDynamicCompressor,
        DENONIPSProfiles::ptMDAX,
        DENONIPSProfiles::ptAudioDelay,
        DENONIPSProfiles::ptAuroMatic3DPreset,
        DENONIPSProfiles::ptAuroMatic3DStrength,
        DENONIPSProfiles::ptEffectLevel, // only Denon
        DENONIPSProfiles::ptAFDM, // only Denon
        DENONIPSProfiles::ptRoomSize, // only Denon
        DENONIPSProfiles::ptSurroundBackMode, //only Denon
        DENONIPSProfiles::ptDelay, //only Denon
        DENONIPSProfiles::ptSubwooferATT, //only Denon
        DENONIPSProfiles::ptAudioRestorer, // only Denon


        //DENONIPSProfiles::ptPreset,

            //Video
        DENONIPSProfiles::ptPictureMode,
        DENONIPSProfiles::ptContrast,
        DENONIPSProfiles::ptBrightness,
        DENONIPSProfiles::ptSaturation,
        DENONIPSProfiles::ptChromalevel,
        DENONIPSProfiles::ptHue,
        DENONIPSProfiles::ptDigitalNoiseReduction,
        DENONIPSProfiles::ptEnhancer,
        DENONIPSProfiles::ptHDMIMonitor,
        DENONIPSProfiles::ptResolution,
        DENONIPSProfiles::ptResolutionHDMI,
        DENONIPSProfiles::ptVideoProcessingMode,
        DENONIPSProfiles::ptHDMIAudioOutput,
        DENONIPSProfiles::ptASP,
        DENONIPSProfiles::ptVerticalStretch,

        //GUI
        DENONIPSProfiles::ptGUIMenu,
        DENONIPSProfiles::ptGUISourceSelect,
        DENONIPSProfiles::ptAllZoneStereo,
        DENONIPSProfiles::ptDimmer,

        //Zone 2
        DENONIPSProfiles::ptZone2Name,
        DENONIPSProfiles::ptZone2Power,
        DENONIPSProfiles::ptZone2Mute,
        DENONIPSProfiles::ptZone2Volume,
        DENONIPSProfiles::ptZone2InputSource,
        DENONIPSProfiles::ptZone2ChannelSetting,
        DENONIPSProfiles::ptZone2ChannelVolumeFL,
        DENONIPSProfiles::ptZone2ChannelVolumeFR,
        DENONIPSProfiles::ptZone2Bass,
        DENONIPSProfiles::ptZone2Treble,
        DENONIPSProfiles::ptZone2QuickSelect,
        DENONIPSProfiles::ptZone2HPF,
        DENONIPSProfiles::ptZone2HDMIAudio,
        DENONIPSProfiles::ptZone2Sleep,
        DENONIPSProfiles::ptZone2AutoStandbySetting,
        //Zone 3
        DENONIPSProfiles::ptZone3Name,
        DENONIPSProfiles::ptZone3Power,
        DENONIPSProfiles::ptZone3Mute,
        DENONIPSProfiles::ptZone3Volume,
        DENONIPSProfiles::ptZone3InputSource,
        DENONIPSProfiles::ptZone3ChannelSetting,
        DENONIPSProfiles::ptZone3ChannelVolumeFL,
        DENONIPSProfiles::ptZone3ChannelVolumeFR,
        DENONIPSProfiles::ptZone3Bass,
        DENONIPSProfiles::ptZone3Treble,
        DENONIPSProfiles::ptZone3QuickSelect,
        DENONIPSProfiles::ptZone3HPF,
        DENONIPSProfiles::ptZone3Sleep,
        DENONIPSProfiles::ptZone3AutoStandbySetting
        ];




    public function __construct($AVRType = null, $InputMapping = null) {

        IPS_LogMessage(get_class().'::'.__FUNCTION__, 'AVRType: '.(is_null($AVRType)?'null':$AVRType)
            .', InputMapping: '.(is_null($InputMapping)?'null':json_encode($InputMapping)));

        $assRange00to98_add05step = $this->GetAssociationOfAsciiTodB( '00', '98', '80', 1, true, false);
        $assRange00to98 = $this->GetAssociationOfAsciiTodB('00', '98', '80', 1, false, false);
        $assRange38to62 = $this->GetAssociationOfAsciiTodB('38', '62', '50');
        $assRange38to62_add05step = $this->GetAssociationOfAsciiTodB( '38', '62', '50', 1, true);
        $assRange00to10_stepwide_01 = $this->GetAssociationOfAsciiTodB( '00', '10', '00', 0.1, false, true, false, 0.1);
        $assRange000to200 = $this->GetAssociationOfAsciiTodB( '000', '200', '000');
        $assRange000to300 = $this->GetAssociationOfAsciiTodB( '000', '300', '000');
        $assRange00to10_invert = $this->GetAssociationOfAsciiTodB( '00', '10', '00', 1, false, true, true);
        $assRange00to15_invert = $this->GetAssociationOfAsciiTodB( '00', '15', '00', 1, false, true, true);
        $assRange44to56 = $this->GetAssociationOfAsciiTodB( '44', '56', '50');
        $assRange40to60 = $this->GetAssociationOfAsciiTodB( '40', '60', '50');
        $assRange00to06 = $this->GetAssociationOfAsciiTodB( '00', '06', '00');
        $assRange00to07 = $this->GetAssociationOfAsciiTodB( '00', '07', '00');
        $assRange00to12 = $this->GetAssociationOfAsciiTodB( '00', '12', '00');
        $assRange00to15 = $this->GetAssociationOfAsciiTodB( '00', '15', '00');
        $assRange00to16 = $this->GetAssociationOfAsciiTodB( '00', '16', '00');
        $assRange000to120_ptSleep = $this->GetAssociationOfAsciiTodB( '000', '120', '000', 10, false, false);
        $assRange000to120_ptSleep[0] = ['OFF', 0];


        //ID -> VariablenIdent, VariablenName
        // hier werden alle Variablen und ihre Profile vordefiniert
        // eine Definition hat den Aufbau
        // Key: ID =>
        // - Type: Variablentyp (boolean, integer, float oder string)
        // - Ident: Variablenident
        // - Name: Variablenname
        // - PropertyName (im Formular)
        // - Profilesettings: Icon, Praefix, Suffix, Minimum, Maximum, Schrittweite, Nachkommastellen
        // - Associations: die Assoziatonen sind vom Variablentyp abhängig
        //          boolean:    <true/false, Subcommando>
        //          integer:    <Value, Label, Subcommand>
        //          float:
        //          string:     -
        //- IndividualStatusRequest: wenn abweichend von '<ident> ?', also z.B. ohne Blank
        // Boolean Variablen

        $this->profiles = [
            DENONIPSProfiles::ptPower => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PW, "Name" => "Power",
                                          "PropertyName" => "Power",
                                          "Associations" => [
                                            [false, DENON_API_Commands::PWSTANDBY],
                                            [true, DENON_API_Commands::PWON],
                                          ],
                                          "IndividualStatusRequest" => 'PW?'
            ],
            DENONIPSProfiles::ptMainZonePower => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::ZM, "Name" => "MainZone Power",
                                          "PropertyName" => "MainZonePower",
                                          "Associations" => [
                                                      [false, DENON_API_Commands::ZMOFF],
                                                      [true, DENON_API_Commands::ZMON]],
                                          "IndividualStatusRequest" => 'ZM?'
                                            ],
            DENONIPSProfiles::ptCinemaEQ => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSCINEMAEQ, "Name" => "Cinema EQ",
                                             "PropertyName" => "CinemaEQ",
                                             "Associations" => [
                                                 [false, DENON_API_Commands::CINEMAEQOFF],
                                                 [true, DENON_API_Commands::CINEMAEQON],
                                             ],
                                             "IndividualStatusRequest" => 'PSCINEMA EQ. ?'
                                            ],
            DENONIPSProfiles::ptHTEQ => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSHTEQ, "Name" => "HT-EQ",
                                             "PropertyName" => "HTEQ",
                                             "Associations" => [
                                                 [false, DENON_API_Commands::HTEQOFF],
                                                 [true, DENON_API_Commands::HTEQON],
                                             ]],
            DENONIPSProfiles::ptDynamicEQ => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSDYNEQ, "Name" => "Dynamic EQ",
                                              "PropertyName" => "DynamicEQ",
                                              "Associations" => [
                                                  [false, DENON_API_Commands::DYNEQOFF],
                                                  [true, DENON_API_Commands::DYNEQON],
                                              ]],
            DENONIPSProfiles::ptAudysseyLFC => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSLFC, "Name" => "Audyssey LFC",
                                              "PropertyName" => "AudysseyLFC",
                                              "Associations" => [
                                                  [false, DENON_API_Commands::LFCOFF],
                                                  [true, DENON_API_Commands::LFCON],
                                              ]],
            DENONIPSProfiles::ptFrontHeight => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSFH, "Name" => "Front Height",
                                          "PropertyName" => "FrontHeight",
                                          "Associations" => [
                                                    [false, DENON_API_Commands::PSFHOFF],
                                                    [true, DENON_API_Commands::PSFHON],
                                                ],
                                          "IndividualStatusRequest" => 'PSFH: ?',
                                            ],
            DENONIPSProfiles::ptMainMute => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::MU, "Name" => "Main Mute",
                                          "PropertyName" => "MainMute",
                                          "Associations" => [
                                            [false, DENON_API_Commands::MUOFF],
                                            [true, DENON_API_Commands::MUON],
                                            ],
                                          "IndividualStatusRequest" => 'MU?',
                                            ],
            DENONIPSProfiles::ptPanorama => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSPAN, "Name" => "Panorama",
                                          "PropertyName" => "Panorama",
                                          "Associations" => [
                                                 [false, DENON_API_Commands::PANOFF],
                                                 [true, DENON_API_Commands::PANON],
                                             ]],
            DENONIPSProfiles::ptToneCTRL => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSTONECTRL, "Name" => "Tone CTRL",
                                          "PropertyName" => "ToneCTRL",
                                          "Associations" => [
                                                 [false, DENON_API_Commands::PSTONECTRLOFF],
                                                 [true, DENON_API_Commands::PSTONECTRLON],
                                             ],
                                             "IndividualStatusRequest" => 'PSTONE CTRL: ?',
                                            ],
            DENONIPSProfiles::ptVerticalStretch => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::VSVST, "Name" => "Vertical Stretch",
                                          "PropertyName" => "VerticalStretch",
                                          "Associations" => [
                                                        [false, DENON_API_Commands::VSTOFF],
                                                        [true, DENON_API_Commands::VSTON],
                                                    ]],
            DENONIPSProfiles::ptDolbyVolume => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSDOLVOL, "Name" => "Dolby Volume",
                                          "PropertyName" => "DolbyVolume",
                                          "Associations" => [
                                                    [false, DENON_API_Commands::DOLVOLOFF],
                                                    [true, DENON_API_Commands::DOLVOLON],
                                                ]],
            DENONIPSProfiles::ptAFDM => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSAFD, "Name" => "Auto Flag Detect Mode",
                                          "PropertyName" => "AFDM",
                                          "Associations" => [
                                                [false, DENON_API_Commands::AFDOFF],
                                                [true, DENON_API_Commands::AFDON],
                                            ]],
            DENONIPSProfiles::ptSubwoofer => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSSWR, "Name" => "Subwoofer",
                                          "PropertyName" => "Subwoofer",
                                          "Associations" => [
                                                  [false, DENON_API_Commands::PSSWROFF],
                                                  [true, DENON_API_Commands::PSSWRON],
                                              ]],
            DENONIPSProfiles::ptSubwooferATT => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSATT, "Name" => "Subwoofer ATT",
                                          "PropertyName" => "SubwooferATT",
                                          "Associations" => [
                                                     [false, DENON_API_Commands::PSSWROFF],
                                                     [true, DENON_API_Commands::PSSWRON],
                                                 ]],
            DENONIPSProfiles::ptLoudnessManagement => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSLOM, "Name" => "Loudness Management",
                                          "PropertyName" => "LoudnessManagement",
                                          "Associations" => [
                                                     [false, DENON_API_Commands::PSLOMOFF],
                                                     [true, DENON_API_Commands::PSLOMON],
                                                 ]],
            DENONIPSProfiles::ptGUIMenu => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::MNMEN, "Name" => "GUI Menu",
                                          "PropertyName" => "GUIMenu",
                                          "Associations" => [
                                                [false, DENON_API_Commands::MNMENOFF],
                                                [true, DENON_API_Commands::MNMENON],
                                            ]],
            DENONIPSProfiles::ptGUISourceSelect => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::MNSRC, "Name" => "GUI Source Select Menu",
                                          "PropertyName" => "GUIMenuSource",
                                          "Associations" => [
                                                        [false, DENON_API_Commands::MNSRCOFF],
                                                        [true, DENON_API_Commands::MNSRCON],
                                                    ]],
            DENONIPSProfiles::ptGraphicEQ => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSGRAPHICEQ, "Name" => "Graphic EQ",
                                              "PropertyName" => "GraphicEQ",
                                              "Associations" => [
                                                  [false, DENON_API_Commands::PSGRAPHICEQOFF],
                                                  [true, DENON_API_Commands::PSGRAPHICEQON],
                ]],
            DENONIPSProfiles::ptCenterSpread    => ["Type"         => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSCES, "Name" => "Center Spread",
                                                    "PropertyName" => "CenterSpread",
                                                    "Associations" => [
                                                        [false, DENON_API_Commands::PSCESOFF],
                                                        [true, DENON_API_Commands::PSCESON],
                                                    ]],
            DENONIPSProfiles::ptNeural   => ["Type"         => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::PSNEURAL, "Name" => "Neural:X",
                                             "PropertyName" => "Neural",
                                             "Associations" => [
                                                 [false, DENON_API_Commands::PSNEURALOFF],
                                                 [true, DENON_API_Commands::PSNEURALON],
                                             ]],
            DENONIPSProfiles::ptAllZoneStereo   => ["Type"         => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::MNZST, "Name" => "All Zone Stereo",
                                             "PropertyName" => "AllZoneStereo",
                                             "Associations" => [
                                                 [false, DENON_API_Commands::MNZSTOFF],
                                                 [true, DENON_API_Commands::MNZSTON],
                                             ]],
            DENONIPSProfiles::ptZone2Power      => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::Z2POWER, "Name" => "Zone 2 Power",
                                          "PropertyName" => "Z2Power",
                                          "Associations" => [
                                                   [false, DENON_API_Commands::Z2OFF],
                                                   [true, DENON_API_Commands::Z2ON],
                                               ],
                                          "IndividualStatusRequest" => 'Z2?'
                                                    ],
            DENONIPSProfiles::ptZone2Mute => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::Z2MU, "Name" => "Zone 2 Mute",
                                          "PropertyName" => "Z2Mute",
                                          "Associations" => [
                                                    [false, DENON_API_Commands::Z2OFF],
                                                    [true, DENON_API_Commands::Z2ON],
                                                ]],
            DENONIPSProfiles::ptZone2HPF => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::Z2HPF, "Name" => "Zone 2 HPF",
                                             "PropertyName" => "Z2HPF",
                                             "Associations" => [
                                                 [false, DENON_API_Commands::Z2OFF],
                                                 [true, DENON_API_Commands::Z2ON],
                                             ]],
            DENONIPSProfiles::ptZone3Power => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::Z3POWER, "Name" => "Zone 3 Power",
                                          "PropertyName" => "Z3Power",
                                          "Associations" => [
                                                   [false, DENON_API_Commands::Z3OFF],
                                                   [true, DENON_API_Commands::Z3ON],
                                                         ],
                                          "IndividualStatusRequest" => 'Z3?'
                                            ],
            DENONIPSProfiles::ptZone3Mute => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::Z3MU, "Name" => "Zone 3 Mute",
                                          "PropertyName" => "Z3Mute",
                                          "Associations" => [
                                                  [false, DENON_API_Commands::Z3OFF],
                                                  [true, DENON_API_Commands::Z3ON],
                                              ]],

            DENONIPSProfiles::ptZone3HPF => ["Type" => DENONIPSVarType::vtBoolean, "Ident" => DENON_API_Commands::Z3HPF, "Name" => "Zone 3 HPF",
                                          "PropertyName" => "Z3HPF",
                                          "Associations" => [
                                                 [false, DENON_API_Commands::Z3OFF],
                                                 [true, DENON_API_Commands::Z3ON],
                                             ]],


    //Ident, Variablename, Profilesettings
    //Associations: Value, Label, Association
            DENONIPSProfiles::ptInputSource => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::SI, "Name" => "Input Source",
                "PropertyName" => "InputSource",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => DENON_API_Commands::$SI_DefaultAssociations, //are adapted by function SetInputSources()
                "IndividualStatusRequest" => 'SI?'
            ],
            DENONIPSProfiles::ptZone2InputSource => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z2INPUT, "Name" => "Zone 2 Input Source",
                "PropertyName" => "Z2InputSource",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => DENON_API_Commands::$SI_DefaultAssociations, //are adapted by function SetInputSources()
                "IndividualStatusRequest" => 'Z2?'
            ],
            DENONIPSProfiles::ptZone3InputSource => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z3INPUT, "Name" => "Zone 3 Input Source",
                 "PropertyName" => "Z3InputSource",
                 "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                 "Associations" => DENON_API_Commands::$SI_DefaultAssociations, //are adapted by function SetInputSources()
                 "IndividualStatusRequest" => 'Z3?'
            ],
            DENONIPSProfiles::ptChannelVolumeReset => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::CVZRL, "Name" => "Channel Volume Reset",
                                                     "PropertyName" => "ChannelVolumeReset",
                                                     "Profilesettings" => ["Script", "", "", 0, 0, 0, 0],
                                                     "Associations" => [
                                                           [1, "Reset", ''],
                                                     ],
                                                     "IndividualStatusRequest" => 'CV?'
            ],
            DENONIPSProfiles::ptNavigation => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::MN, "Name" => "Navigation",
                "PropertyName" => "Navigation",
                "Profilesettings" => ["Move", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Left", DENON_API_Commands::MNCLT],
                    [1, "Down", DENON_API_Commands::MNCDN],
                    [2, "Up", DENON_API_Commands::MNCUP],
                    [3, "Right", DENON_API_Commands::MNCRT],
                    [4, "Enter", DENON_API_Commands::MNENT],
                    [5, "Return", DENON_API_Commands::MNRTN]
                ]
            ],
            DENONIPSProfiles::ptQuickSelect => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::MSQUICK, "Name" => "Quick Select",
                                                "PropertyName" => "QuickSelect",
                                                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                                                "Associations" => [
                                                    [1, "Quick Select 1", DENON_API_Commands::MSQUICK1],
                                                    [2, "Quick Select 2", DENON_API_Commands::MSQUICK2],
                                                    [3, "Quick Select 3", DENON_API_Commands::MSQUICK3],
                                                    [4, "Quick Select 4", DENON_API_Commands::MSQUICK4],
                                                    [5, "Quick Select 5", DENON_API_Commands::MSQUICK5]
                                                ]
            ],
            DENONIPSProfiles::ptSmartSelect => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::MSSMART, "Name" => "Smart Select",
                                                "PropertyName" => "SmartSelect",
                                                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                                                "Associations" => [
                                                    [1, "Smart Select 1", DENON_API_Commands::MSSMART1],
                                                    [2, "Smart Select 2", DENON_API_Commands::MSSMART2],
                                                    [3, "Smart Select 3", DENON_API_Commands::MSSMART3],
                                                    [4, "Smart Select 4", DENON_API_Commands::MSSMART4],
                                                    [5, "Smart Select 5", DENON_API_Commands::MSSMART5]
                                                ]
            ],
            DENONIPSProfiles::ptDigitalInputMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::DC, "Name" => "Audio Decode Mode",
                "PropertyName" => "DigitalInputMode",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Auto", DENON_API_Commands::DCAUTO],
                    [1, "PCM", DENON_API_Commands::DCPCM],
                    [2, "DTS", DENON_API_Commands::DCDTS]
                ]
            ],
            DENONIPSProfiles::ptAudysseyDSX => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSDSX, "Name" => "Audyssey DSX",
                "PropertyName" => "AudysseyDSX",
                "Profilesettings" => ["Speaker", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::PSDSXOFF],
                    [1, "Audyssey DSX On(Wide)", DENON_API_Commands::PSDSXONW],
                    [2, "Audyssey DSX On(Height)", DENON_API_Commands::PSDSXONH],
                    [3, "Audyssey DSX On(Wide/Height)", DENON_API_Commands::PSDSXONHW]
                ]
            ],

            DENONIPSProfiles::ptSurroundMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::MS, "Name" => "Surround Mode",
                "PropertyName" => "SurroundMode",
                "Profilesettings" => ["Melody", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, 'Movie', DENON_API_Commands::MSMOVIE],
                    [1, 'Music', DENON_API_Commands::MSMUSIC],
                    [2, 'Game', DENON_API_Commands::MSGAME],
                    [3, 'Direct', DENON_API_Commands::MSDIRECT],
                    [4, 'Pure Direct', DENON_API_Commands::MSPUREDIRECT],
                    [5, 'Stereo', DENON_API_Commands::MSSTEREO],
                    [6, 'Standard', DENON_API_Commands::MSSTANDARD],
                    [7, 'Dolby Digital', DENON_API_Commands::MSDOLBYDIGITAL],
                    [8, 'DTS Surround', DENON_API_Commands::MSDTSSURROUND],
                    [9, 'Auro 3D', DENON_API_Commands::MSAURO3D],
                    [10, 'Auro 2D', DENON_API_Commands::MSAURO2DSURR],
                    [11, '7 Channel Stereo', DENON_API_Commands::MS7CHSTEREO],
                    [12, 'Multichannel Stereo', DENON_API_Commands::MSMCHSTEREO],
                    [13, 'Wide Screen', DENON_API_Commands::MSWIDESCREEN],
                    [14, 'Super Stadium', DENON_API_Commands::MSSUPERSTADIUM],
                    [15, 'Rock Arena', DENON_API_Commands::MSROCKARENA],
                    [16, 'Jazz Club', DENON_API_Commands::MSJAZZCLUB],
                    [17, 'Classic Concert', DENON_API_Commands::MSCLASSICCONCERT],
                    [18, 'Mono Movie', DENON_API_Commands::MSMONOMOVIE],
                    [19, 'Matrix', DENON_API_Commands::MSMATRIX],
                    [20, 'Video Game', DENON_API_Commands::MSVIDEOGAME],
                    [21, 'Virtual', DENON_API_Commands::MSVIRTUAL],
                ],
                "IndividualStatusRequest" => 'MS?'
                ],
            DENONIPSProfiles::ptSurroundPlayMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSMODE, "Name" => "Surround Play Mode",
                "PropertyName" => "SurroundPlayMode",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Cinema", DENON_API_Commands::MODECINEMA],
                    [1, "Music", DENON_API_Commands::MODEMUSIC],
                    [2, "Game", DENON_API_Commands::MODEGAME],
                    [3, "Pro Logic", DENON_API_Commands::MODEPROLOGIC]
                ],
                "IndividualStatusRequest" => 'PSMODE: ?'
            ],
            DENONIPSProfiles::ptMultiEQMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSMULTEQ, "Name" => "Multi EQ Mode",
                "PropertyName" => "MultiEQMode",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::MULTEQOFF],
                    [1, "Audyssey", DENON_API_Commands::MULTEQAUDYSSEY],
                    [2, "BYP.LR", DENON_API_Commands::MULTEQBYPLR],
                    [3, "Flat", DENON_API_Commands::MULTEQFLAT],
                    [4, "Manual", DENON_API_Commands::MULTEQMANUAL]
                ],
                "IndividualStatusRequest" => 'PSMULTEQ: ?'
            ],
            DENONIPSProfiles::ptAudioRestorer => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSRSTR, "Name" => "Audio Restorer",
                "PropertyName" => "AudioRestorer",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::PSRSTROFF],
                    [1, "Restorer 64", DENON_API_Commands::PSRSTRMODE1],
                    [2, "Restorer 96", DENON_API_Commands::PSRSTRMODE2],
                    [3, "Restorer HQ", DENON_API_Commands::PSRSTRMODE3]
                ]
            ],
            DENONIPSProfiles::ptFrontSpeaker => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSFRONT, "Name" => "Front Speaker",
                "PropertyName" => "FrontSpeaker",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Speaker A", DENON_API_Commands::PSFRONTSPA],
                    [1, "Speaker B", DENON_API_Commands::PSFRONTSPB],
                    [2, "Speaker A+B", DENON_API_Commands::PSFRONTSPAB],
                ],
                "IndividualStatusRequest" => 'PSFRONT?'
            ],
            DENONIPSProfiles::ptRoomSize => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSRSZ, "Name" => "Room Size",
                "PropertyName" => "RoomSize",
                "Profilesettings" => ["Sofa", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Normal", DENON_API_Commands::RSZN],
                    [1, "Small", DENON_API_Commands::RSZS],
                    [2, "Small/Medium", DENON_API_Commands::RSZMS],
                    [3, "Medium", DENON_API_Commands::RSZM],
                    [4, "Medium/Large", DENON_API_Commands::RSZML],
                    [5, "Large", DENON_API_Commands::RSZL]
                ]
            ],
            DENONIPSProfiles::ptDynamicCompressor       => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSDCO, "Name" => "Dynamic Compressor",
                "PropertyName" => "DynamicCompressor",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::DCOOFF],
                    [1, "Low", DENON_API_Commands::DCOLOW],
                    [2, "Middle", DENON_API_Commands::DCOMID],
                    [3, "High", DENON_API_Commands::DCOHIGH]
                ]
            ],
            DENONIPSProfiles::ptDynamicRangeCompression => ["Type"            => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSDRC, "Name" => "Dynamic Range Compression",
              "PropertyName"    => "DynamicRange",
              "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
              "Associations"    => [
                  [0, "Off", DENON_API_Commands::DRCOFF],
                  [1, "Auto", DENON_API_Commands::DRCAUTO],
                  [2, "Low", DENON_API_Commands::DRCLOW],
                  [3, "Middle", DENON_API_Commands::DRCMID],
                  [4, "High", DENON_API_Commands::DRCHI]
              ]
            ],
            DENONIPSProfiles::ptMDAX => ["Type"            => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSMDAX, "Name" => "M-DAX",
              "PropertyName"    => "MDAX",
              "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
              "Associations"    => [
                  [0, "Off", DENON_API_Commands::MDAXOFF],
                  [1, "Low", DENON_API_Commands::MDAXLOW],
                  [2, "Middle", DENON_API_Commands::MDAXMID],
                  [3, "High", DENON_API_Commands::MDAXHI]
              ]
            ],
            DENONIPSProfiles::ptVideoSelect => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::SV, "Name" => "Video Select",
                "PropertyName" => "VideoSelect",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "DVD", DENON_API_Commands::DVD],
                    [1, "BD", DENON_API_Commands::BD],
                    [2, "TV", DENON_API_Commands::TV],
                    [3, "Sat/CBL", DENON_API_Commands::SAT_CBL],
                    [4, "Sat", DENON_API_Commands::SAT],
                    [5, "MediaPlayer", DENON_API_Commands::MPLAY],
                    [6, "VCR", DENON_API_Commands::VCR],
                    [7, "DVR", DENON_API_Commands::DVR],
                    [8, "Game", DENON_API_Commands::GAME],
                    [9, "Game2", DENON_API_Commands::GAME2],
                    [10, "V.AUX", DENON_API_Commands::VAUX],
                    [11, "AUX1", DENON_API_Commands::AUX1],
                    [12, "AUX2", DENON_API_Commands::AUX2],
                    [13, "CD", DENON_API_Commands::CD],
                    [14, "Source",DENON_API_Commands::SOURCE],
                    [15, "On",DENON_API_Commands::ON],
                    [16, "Off",DENON_API_Commands::OFF],
                ]
            ],
            DENONIPSProfiles::ptSurroundBackMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSSB, "Name" => "Surround Back Mode",
                "PropertyName" => "SurroundBackMode",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::SBOFF],
                    [1, "On", DENON_API_Commands::SBON],
                    [2, "Matrix On", DENON_API_Commands::SBMTRXON],
                    [3, "PL2X Cinema", DENON_API_Commands::SBPL2XCINEMA],
                    [4, "PL2X Music", DENON_API_Commands::SBPL2XMUSIC]
                ],
                "IndividualStatusRequest" => 'PSSB: ?'
            ],
            DENONIPSProfiles::ptHDMIMonitor   => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::VSMONI, "Name" => "HDMI Monitor",
                "PropertyName" => "HDMIMonitor",
                "Profilesettings" => ["TV", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Auto", DENON_API_Commands::VSMONIAUTO],
                    [1, "Monitor 1", DENON_API_Commands::VSMONI1],
                    [2, "Monitor 2", DENON_API_Commands::VSMONI2]
                ]
            ],
            DENONIPSProfiles::ptSpeakerOutput => ["Type"            => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSSP, "Name" => "Effekt Speaker",
                  "PropertyName"    => "SpeakerOutputFront",
                  "Profilesettings" => ["Speaker", "", "", 0, 0, 0, 0],
                  "Associations"    => [
                             [0, "Off", DENON_API_Commands::SPOFF],
                             [1, "Front Height", DENON_API_Commands::SPFH],
                             [2, "Front Wide", DENON_API_Commands::SPFW],
                             [3, "Surround Back", DENON_API_Commands::SPSB],
                             [4, "Fr.Height & Fr.Wide", DENON_API_Commands::SPHW],
                             [5, "Surr.Back & Fr.Height", DENON_API_Commands::SPBH],
                             [6, "Surr.Back & Fr.Wide", DENON_API_Commands::SPBW],
                             [7, "Floor", DENON_API_Commands::SPFL],
                             [8, "Height & Floor", DENON_API_Commands::SPHF],
                             [9, "Front", DENON_API_Commands::SPFR],
                         ],
                   "IndividualStatusRequest" => 'PSSP: ?'
            ],
            DENONIPSProfiles::ptReferenceLevel   => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSREFLEV, "Name" => "Reference Level",
                "PropertyName" => "ReferenceLevel",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Offset 0", DENON_API_Commands::REFLEV0],
                    [5, "Offset 5", DENON_API_Commands::REFLEV5],
                    [10, "Offset 10", DENON_API_Commands::REFLEV10],
                    [15, "Offset 15", DENON_API_Commands::REFLEV15]
                ]
            ],
            DENONIPSProfiles::ptPLIIZHeightGain => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSPHG, "Name" => "PLIIZ Height Gain",
                "PropertyName" => "PLIIZHeightGain",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Low", DENON_API_Commands::PHGLOW],
                    [1, "Middle", DENON_API_Commands::PHGMID],
                    [2, "High", DENON_API_Commands::PHGHI]
                ]
            ],
            DENONIPSProfiles::ptDolbyVolumeModeler => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSVOLMOD, "Name" => "Dolby Volume Modeler",
                "PropertyName" => "DolbyVolumeModeler",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::VOLMODOFF],
                    [1, "Half", DENON_API_Commands::VOLMODHLF],
                    [2, "Full", DENON_API_Commands::VOLMODFUL]
                ]
            ],
            DENONIPSProfiles::ptDolbyVolumeLeveler => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSVOLLEV, "Name" => "Dolby Volume Leveler",
                "PropertyName" => "DolbyVolumeLeveler",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Low", DENON_API_Commands::VOLLEVLOW],
                    [1, "Middle", DENON_API_Commands::VOLLEVMID],
                    [2, "High", DENON_API_Commands::VOLLEVHI]
                ]
            ],
            DENONIPSProfiles::ptVideoProcessingMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::VSVPM, "Name" => "Video Processing Mode",
                "PropertyName" => "VideoProcessingMode",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Auto", DENON_API_Commands::VPMAUTO],
                    [1, "Game", DENON_API_Commands::VPGAME],
                    [2, "Movie", DENON_API_Commands::VPMOVI]
                ]
            ],
            DENONIPSProfiles::ptHDMIAudioOutput => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::VSAUDIO, "Name" => "HDMI Audio Output",
                "PropertyName" => "HDMIAudioOutput",
                "Profilesettings" => ["TV", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "TV", DENON_API_Commands::AUDIOTV],
                    [1, "AMP", DENON_API_Commands::AUDIOAMP]
                ]
            ],
            DENONIPSProfiles::ptASP => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::VSASP, "Name" => "ASP",
                "PropertyName" => "ASP",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Normal", DENON_API_Commands::ASPNRM],
                    [1, "Full", DENON_API_Commands::ASPFUL]
                ]
            ],
            DENONIPSProfiles::ptPictureMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PVPICT, "Name" => "Picture Mode",
                                                          "PropertyName" => "PictureMode",
                                                          "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                                                          "Associations" => [
                                                              [0, "Off", DENON_API_Commands::PVPICTOFF],
                                                              [1, "Standard", DENON_API_Commands::PVPICTSTD],
                                                              [2, "Movie", DENON_API_Commands::PVPICTMOV],
                                                              [3, "Vivid", DENON_API_Commands::PVPICTVVD],
                                                              [4, "Stream", DENON_API_Commands::PVPICTSTM],
                                                              [5, "Custom", DENON_API_Commands::PVPICTCTM],
                                                              [6, "ISF Day", DENON_API_Commands::PVPICTDAY],
                                                              [7, "ISF Night", DENON_API_Commands::PVPICTNGT],
                                                          ],
                                                          "IndividualStatusRequest" => 'PV?'

            ],
            DENONIPSProfiles::ptDigitalNoiseReduction => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PVDNR, "Name" => "Digital Noise Reduction",
                                                          "PropertyName" => "DNRDirectChange",
                                                          "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                                                          "Associations" => [
                                                              [0, "Off", DENON_API_Commands::PVDNROFF],
                                                              [1, "Low", DENON_API_Commands::PVDNRLOW],
                                                              [2, "Middle", DENON_API_Commands::PVDNRMID],
                                                              [3, "High", DENON_API_Commands::PVDNRHI]
                                                          ]
            ],
            DENONIPSProfiles::ptInputMode => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::SD, "Name" => "Audio Input Mode",
                "PropertyName" => "InputMode",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "AUTO", DENON_API_Commands::SDAUTO],
                    [1, "HDMI", DENON_API_Commands::SDHDMI],
                    [2, "DIGITAL", DENON_API_Commands::SDDIGITAL],
                    [3, "ANALOG", DENON_API_Commands::SDANALOG],
                    [4, "Ext.IN", DENON_API_Commands::SDEXTIN],
                    [5, "7.1 IN", DENON_API_Commands::SD71IN],
                    [6, "No", DENON_API_Commands::SDNO],
                ]
            ],
            DENONIPSProfiles::ptDialogEnhancer => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSDEH, "Name" => "Dialog Enhancer",
                  "PropertyName" => "DialogEnhancer",
                  "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                  "Associations" => [
                      [0, "Off", DENON_API_Commands::PSDEHOFF],
                      [1, "Low", DENON_API_Commands::PSDEHLOW],
                      [2, "Medium", DENON_API_Commands::PSDEHMED],
                      [3, "High", DENON_API_Commands::PSDEHHIGH]
                  ],
            ],
            DENONIPSProfiles::ptAuroMatic3DPreset => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSAUROPR, "Name" => "Auro-Matic 3D Preset",
                  "PropertyName" => "AuroMatic3DPreset",
                  "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                  "Associations" => [
                      [0, "Small", DENON_API_Commands::PSAUROPRSMA],
                      [1, "Medium", DENON_API_Commands::PSAUROPRMED],
                      [2, "Large", DENON_API_Commands::PSAUROPRLAR],
                      [3, "SPE", DENON_API_Commands::PSAUROPRSPE]
                  ],
            ],
            DENONIPSProfiles::ptMAINZONEAutoStandbySetting => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::STBY, "Name" => "Mainzone Auto Standby",
                "PropertyName" => "MAINZONEAutoStandbySetting",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::STBYOFF],
                    [1, "15 Min", DENON_API_Commands::STBY15M],
                    [2, "30 Min", DENON_API_Commands::STBY30M],
                    [3, "60 Min", DENON_API_Commands::STBY60M]
                ]
            ],
            DENONIPSProfiles::ptMAINZONEECOModeSetting => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::ECO, "Name" => "Mainzone ECO Mode",
                "PropertyName" => "MAINZONEECOModeSetting",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::ECOOFF],
                    [1, "Auto", DENON_API_Commands::ECOAUTO],
                    [2, "On", DENON_API_Commands::ECOON]
                ]
            ],
            DENONIPSProfiles::ptDimmer            => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::DIM, "Name" => "Dimmer",
                "PropertyName" => "Dimmer",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::DIMOFF],
                    [1, "Dark", DENON_API_Commands::DIMDAR],
                    [2, "Dim", DENON_API_Commands::DIMDIM],
                    [3, "Bright", DENON_API_Commands::DIMBRI]
                ]
            ],
            DENONIPSProfiles::ptDynamicVolume => ["Type"            => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSDYNVOL, "Name" => "Dynamic Volume",
                  "PropertyName"    => "DynamicVolume",
                  "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                  "Associations"    => [
                      [0, "Off", DENON_API_Commands::DYNVOLOFF],
                      [1, "Light", DENON_API_Commands::DYNVOLLIT],
                      [2, "Medium", DENON_API_Commands::DYNVOLMED],
                      [3, "Heavy", DENON_API_Commands::DYNVOLHEV],
                      [4, "Day", DENON_API_Commands::DYNVOLDAY],    // only older AVRs
                      [5, "Evening", DENON_API_Commands::DYNVOLEVE],// only older AVRs
                      [6, "Midnight", DENON_API_Commands::DYNVOLNGT],// only older AVRs
                  ]
            ],
            DENONIPSProfiles::ptResolutionHDMI => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::VSSCH, "Name" => "Resolution HDMI",
                "PropertyName" => "ResolutionHDMI",
                "Profilesettings" => ["TV", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "480p/576p", DENON_API_Commands::SCH48P],
                    [1, "1080i", DENON_API_Commands::SCH10I],
                    [2, "720p", DENON_API_Commands::SCH72P],
                    [3, "1080p", DENON_API_Commands::SCH10P],
                    [4, "1080p 24Hz", DENON_API_Commands::SCH10P24],
                    [5, "4K", DENON_API_Commands::SCH4K],
                    [6, "4K(60/50)", DENON_API_Commands::SCH4KF],
                    [7, "Auto", DENON_API_Commands::SCHAUTO]
                ]
            ],
            DENONIPSProfiles::ptResolution => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::VSSC, "Name" => "Resolution",
                                               "PropertyName" => "Resolution",
                                               "Profilesettings" => ["TV", "", "", 0, 0, 0, 0],
                                               "Associations" => [
                                                   [0, "480p/576p", DENON_API_Commands::SC48P],
                                                   [1, "1080i", DENON_API_Commands::SC10I],
                                                   [2, "720p", DENON_API_Commands::SC72P],
                                                   [3, "1080p", DENON_API_Commands::SC10P],
                                                   [4, "1080p 24Hz", DENON_API_Commands::SC10P24],
                                                   [5, "4K", DENON_API_Commands::SC4K],
                                                   [6, "4K(60/50)", DENON_API_Commands::SC4KF],
                                                   [7, "Auto", DENON_API_Commands::SCAUTO]
                                               ]
            ],
            DENONIPSProfiles::ptDimension => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::PSDIM, "Name" => "Dimension",
                                              "PropertyName" => "Dimension",
                                              "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                                              "Associations" => [
                                                  [0, "0", " 00"],
                                                  [1, "1", " 01"],
                                                  [2, "2", " 02"],
                                                  [3, "3", " 03"],
                                                  [4, "4", " 04"],
                                                  [5, "5", " 05"],
                                                  [6, "6", " 06"],
                                              ]
            ],
            DENONIPSProfiles::ptSleep => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::SLP, "Name" => "Sleep",
                                              "PropertyName" => "Sleep",
                                              "Profilesettings" => ["Clock", "", "", 0, 0, 0, 0],
                                              "Associations" => [
                                                  [0, "Off", "OFF"],
                                                  [1, "10 min", "010"],
                                                  [2, "20 min", "020"],
                                                  [3, "30 min", "030"],
                                                  [4, "40 min", "040"],
                                                  [5, "50 min", "050"],
                                                  [6, "60 min", "060"],
                                                  [7, "70 min", "070"],
                                                  [8, "80 min", "080"],
                                                  [9, "90 min", "090"],
                                                  [10, "100 min", "100"],
                                                  [11, "110 min", "110"],
                                                  [12, "120 min", "120"],
                                              ],
                                              "IndividualStatusRequest" => 'SLP?'
            ],
            DENONIPSProfiles::ptZone2ChannelSetting => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z2CS, "Name" => "Zone 2 Channel Setting",
                "PropertyName" => "Z2Channel",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Stereo",DENON_API_Commands::Z2CSST],
                    [1, "Mono", DENON_API_Commands::Z2CSMONO]
                ]
            ],
            DENONIPSProfiles::ptZone3ChannelSetting => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z3CS, "Name" => "Zone 3 Channel Setting",
                "PropertyName" => "Z3Channel",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Stereo",DENON_API_Commands::Z3CSST],
                    [1, "Mono", DENON_API_Commands::Z3CSMONO]
                ]
            ],
            DENONIPSProfiles::ptZone2QuickSelect => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z2QUICK, "Name" => "Zone 2 Quick Select",
                "PropertyName" => "Z2Quick",
                "Profilesettings" => ["Database", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [1, "QS 1", DENON_API_Commands::MSQUICK1],
                    [2, "QS 2", DENON_API_Commands::MSQUICK2],
                    [3, "QS 3", DENON_API_Commands::MSQUICK3],
                    [4, "QS 4", DENON_API_Commands::MSQUICK4],
                    [5, "QS 5", DENON_API_Commands::MSQUICK5]
                ]
            ],
            DENONIPSProfiles::ptZone3QuickSelect => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z3QUICK, "Name" => "Zone 3 Quick Select",
                 "PropertyName" => "Z3Quick",
                 "Profilesettings" => ["DataMainbase", "", "", 0, 0, 0, 0],
                 "Associations" => [
                     [1, "QS 1", DENON_API_Commands::MSQUICK1],
                     [2, "QS 2", DENON_API_Commands::MSQUICK2],
                     [3, "QS 3", DENON_API_Commands::MSQUICK3],
                     [4, "QS 4", DENON_API_Commands::MSQUICK4],
                     [5, "QS 5", DENON_API_Commands::MSQUICK5]
                 ]
            ],
            DENONIPSProfiles::ptZone2AutoStandbySetting => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z2STBY, "Name" => "Zone 2 Auto Standby",
                "PropertyName" => "ZONE2AutoStandbySetting",
                "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                "Associations" => [
                    [0, "Off", DENON_API_Commands::Z2STBYOFF],
                    [1, "2 h", DENON_API_Commands::Z2STBY2H],
                    [2, "4 h", DENON_API_Commands::Z2STBY4H],
                    [3, "8 h", DENON_API_Commands::Z2STBY8H]
                ]
            ],
            DENONIPSProfiles::ptZone3AutoStandbySetting => ["Type"            => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z3STBY, "Name" => "Zone 3 Auto Standby",
                                                            "PropertyName"    => "ZONE3AutoStandbySetting",
                                                            "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                                                            "Associations"    => [
                    [0, "Off", DENON_API_Commands::Z3STBYOFF],
                    [1, "2 h", DENON_API_Commands::Z3STBY2H],
                    [2, "4 h", DENON_API_Commands::Z3STBY4H],
                    [3, "8 h", DENON_API_Commands::Z3STBY8H]
                ]
            ],
            DENONIPSProfiles::ptZone2HDMIAudio => ["Type" => DENONIPSVarType::vtInteger, "Ident" => DENON_API_Commands::Z2HDA, "Name" => "Zone 2 HDMI Audio",
                                                            "PropertyName" => "Zone2HDMIAudio",
                                                            "Profilesettings" => ["Intensity", "", "", 0, 0, 0, 0],
                                                            "Associations" => [
                                                                [0, "Pass-Through", DENON_API_Commands::Z2HDATHR],
                                                                [1, "PCM", DENON_API_Commands::Z2HDAPCM],
                                                            ]
            ],


            //Type Float
 //           DENONIPSProfiles::ptDimension => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSDIM, "Name" => "Dimension",
 //                                             "PropertyName" => "Dimension", "Profilesettings" => ["Intensity", "", " dB", 0, 6, 1, 0], "Associations" => $assRange00to06],
            DENONIPSProfiles::ptDialogControl => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSDIC, "Name" => "DialogControl",
                                              "PropertyName" => "DialogControl", "Profilesettings" => ["Intensity", "", " dB", 0, 6, 1, 0], "Associations" => $assRange00to06],
            DENONIPSProfiles::ptMasterVolume => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::MV, "Name" => "Master Volume",
                                                 "PropertyName" => "MasterVolume", "Profilesettings" => ["Intensity", "", " dB", -80.0, 18.0, 0.5, 1], "Associations" => $assRange00to98_add05step,
                                                "IndividualStatusRequest" => 'MV?'],
            DENONIPSProfiles::ptChannelVolumeFL => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFL, "Name" => "Channel Volume Front Left",
                                                    "PropertyName" => "FL", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeFR => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFR, "Name" => "Channel Volume Front Right",
                                                    "PropertyName" => "FR", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeC => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVC, "Name" => "Channel Volume Center",
                                                   "PropertyName" => "C", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeSW => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSW, "Name" => "Channel Volume Subwoofer",
                                                    "PropertyName" => "SW", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeSW2 => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSW2, "Name" => "Channel Volume Subwoofer 2",
                                                     "PropertyName" => "SW2", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeSL => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSL, "Name" => "Channel Volume Surround Left",
                                                    "PropertyName" => "SL", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeSR => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSR, "Name" => "Channel Volume Surround Right",
                                                    "PropertyName" => "SR", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeSBL => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSBL, "Name" => "Channel Volume Surround Back Left",
                                                     "PropertyName" => "SBL", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeSBR => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSBR, "Name" => "Channel Volume Surround Back Right",
                                                     "PropertyName" => "SBR", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeSB => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSB, "Name" => "Channel Volume Surround Back",
                                                    "PropertyName" => "SB", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeFHL => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFHL, "Name" => "Channel Volume Front Height Left",
                                                     "PropertyName" => "FHL", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeFHR => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFHR, "Name" => "Channel Volume Front Height Right",
                                                     "PropertyName" => "FHR", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeFWL => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFWL, "Name" => "Channel Volume Front Wide Left",
                                                     "PropertyName" => "FWL", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptChannelVolumeFWR => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFWR, "Name" => "Channel Volume Front Wide Right",
                                                     "PropertyName" => "FWR", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptSurroundHeightLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSHL, "Name" => "Surround Height Left",
                                                      "PropertyName" => "SurroundHeightLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptSurroundHeightRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSHR, "Name" => "Surround Height Right",
                                                      "PropertyName" => "SurroundHeightRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopSurround => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTS, "Name" => "Top Surround",
                                                "PropertyName" => "", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopFrontLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTFL, "Name" => "Channel Volume Top Front Left",
                                                "PropertyName" => "TopFrontLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopFrontRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTFR, "Name" => "Channel Volume Top Front Right",
                                                "PropertyName" => "TopFrontRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopMiddleLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTML, "Name" => "Channel Volume Top Middle Left",
                                                 "PropertyName" => "TopMiddleLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopMiddleRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTMR, "Name" => "Channel Volume Top Middle Right",
                                                 "PropertyName" => "TopMiddleRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopRearLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTRL, "Name" => "Channel Volume Top Rear Left",
                                               "PropertyName" => "TopRearLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopRearRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTRR, "Name" => "Channel Volume Top Rear Right",
                                               "PropertyName" => "TopRearRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptRearHeightLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVRHL, "Name" => "Channel Volume Rear Height Left",
                                                  "PropertyName" => "RearHeightLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptRearHeightRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVRHR, "Name" => "Channel Volume Rear Height Right",
                                                  "PropertyName" => "RearHeightRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptFrontDolbyLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFDL, "Name" => "Channel Volume Front Dolby Left",
                                                  "PropertyName" => "FrontDolbyLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptFrontDolbyRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVFDR, "Name" => "Channel Volume Front Dolby Right",
                                                  "PropertyName" => "FrontDolbyRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptSurroundDolbyLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSDL, "Name" => "Channel Volume Surround Dolby Left",
                                                     "PropertyName" => "SurroundDolbyLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptSurroundDolbyRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSDR, "Name" => "Channel Volume Surround Dolby Right",
                                                     "PropertyName" => "SurroundDolbyRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptBackDolbyLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVBDL, "Name" => "Channel Volume Back Dolby Left",
                                                 "PropertyName" => "BackDolbyLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptBackDolbyRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVBDR, "Name" => "Channel Volume Back Dolby Right",
                                                 "PropertyName" => "BackDolbyRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptSurroundHeightLch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSHL, "Name" => "Channel Volume Surround Height Left",
                                                      "PropertyName" => "SurroundHeightLch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptSurroundHeightRch => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVSHR, "Name" => "Channel Volume Surround Height Right",
                                                      "PropertyName" => "SurroundHeightRch", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            DENONIPSProfiles::ptTopSurround => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::CVTS, "Name" => "Channel Volume Top Surround",
                                                "PropertyName" => "TopSurround", "Profilesettings" => ["Intensity",  "", " dB", -12, 12, 0.5, 1], "Associations" => $assRange38to62_add05step,
                                                    "IndividualStatusRequest" => 'CV?'],
            //--- Attention: the order of the next two items may not be changed, because PSDEL is a substring of PSDELAY
            DENONIPSProfiles::ptAudioDelay => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSDELAY, "Name" => "Audio Delay",
                                               "PropertyName" => "AudioDelay", "Profilesettings" => ["Intensity", "", " ms", 0, 200, 1, 0], "Associations" => $assRange000to200],
            DENONIPSProfiles::ptDelay => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSDEL, "Name" => "Delay",
                                          "PropertyName" => "Delay", "Profilesettings" => ["Intensity", "", " ms", 0, 300, 1, 0], "Associations" => $assRange000to300],
            //---
            DENONIPSProfiles::ptLFELevel => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSLFE, "Name" => "LFE Level",
                                             "PropertyName" => "LFELevel", "Profilesettings" => ["Intensity", "", " dB", -10.0, 0.0, 1, 0], "Associations" => $assRange00to10_invert],
            DENONIPSProfiles::ptLFE71Level => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSLFL, "Name" => "LFE 7.1 Level",
                                             "PropertyName" => "LFE71Level", "Profilesettings" => ["Intensity", "", " dB", -15.0, 0.0, 1, 0], "Associations" => $assRange00to15_invert],
            DENONIPSProfiles::ptBassLevel => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSBAS, "Name" => "Bass Level",
                                              "PropertyName" => "BassLevel", "Profilesettings" => ["Intensity", "", " dB", -6, 6, 1, 0], "Associations" => $assRange44to56],
            DENONIPSProfiles::ptTrebleLevel => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSTRE, "Name" => "Treble Level",
                                                "PropertyName" => "TrebleLevel", "Profilesettings" => ["Intensity", "", " dB", -6, 6, 1, 0], "Associations" => $assRange44to56],
            DENONIPSProfiles::ptCenterWidth => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSCEN, "Name" => "Center Width",
                                                "PropertyName" => "CenterWidth", "Profilesettings" => ["Intensity",  "", " dB", 0, 7, 1, 0], "Associations" => $assRange00to07],
            DENONIPSProfiles::ptEffectLevel => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSEFF, "Name" => "Effect Level",
                                                "PropertyName" => "EffectLevel", "Profilesettings" => ["Intensity", "", " dB", 0, 15, 1, 0], "Associations" => $assRange00to15],
            DENONIPSProfiles::ptCenterImage => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSCEI, "Name" => "Center Image",
                                                "PropertyName" => "CenterImage", "Profilesettings" => ["Intensity", "", " dB", 0.0, 1.0, 0.1, 1], "Associations" => $assRange00to10_stepwide_01],
            DENONIPSProfiles::ptCenterGain => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSCEG, "Name" => "Center Gain",
                                                "PropertyName" => "CenterGain", "Profilesettings" => ["Intensity", "", " dB", 0.0, 1.0, 0.1, 1], "Associations" => $assRange00to10_stepwide_01],
            DENONIPSProfiles::ptContrast => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PVCN, "Name" => "Contrast",
                                             "PropertyName" => "Contrast", "Profilesettings" => ["Intensity", "", " dB", -6, 6, 1, 0], "Associations" => $assRange44to56],
            DENONIPSProfiles::ptBrightness => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PVBR, "Name" => "Brightness",
                                               "PropertyName" => "Brightness", "Profilesettings" => ["Intensity", "", " dB", 0, 12, 1, 0], "Associations" => $assRange00to12],
            DENONIPSProfiles::ptSaturation => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PVST, "Name" => "Saturation",
                                               "PropertyName" => "Saturation", "Profilesettings" => ["Intensity", "", " dB", -6, 6, 1, 0], "Associations" => $assRange44to56],
            DENONIPSProfiles::ptChromalevel => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PVCM, "Name" => "Chroma Level",
                                                "PropertyName" => "Chromalevel", "Profilesettings" => ["Intensity", "", " dB", -6, 6, 1, 0], "Associations" => $assRange44to56],
            DENONIPSProfiles::ptHue => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PVHUE, "Name" => "Hue",
                                        "PropertyName" => "Hue", "Profilesettings" => ["Intensity", "", " dB", -6, 6, 1, 0], "Associations" => $assRange44to56],
            DENONIPSProfiles::ptEnhancer => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PVENH, "Name" => "Enhancer",
                                             "PropertyName" => "Enhancer", "Profilesettings" => ["Intensity", "", " dB", 0, 12, 1, 0], "Associations" => $assRange00to12],
            DENONIPSProfiles::ptStageHeight => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSSTH, "Name" => "Stage Height",
                                                "PropertyName" => "StageHeight", "Profilesettings" => ["Intensity", "", " dB", -10, 10, 1, 0], "Associations" => $assRange40to60],
            DENONIPSProfiles::ptStageWidth => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSSTW, "Name" => "Stage Width",
                                               "PropertyName" => "StageWidth", "Profilesettings" => ["Intensity", "", " dB", -10, 10, 1, 0], "Associations" => $assRange40to60],
            DENONIPSProfiles::ptAudysseyContainmentAmount => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSCNTAMT, "Name" => "Audyssey Containment Amount",
                                              "PropertyName" => "AudysseyContainmentAmount", "Profilesettings" => ["Intensity",  "", " dB", 0, 7, 1, 0], "Associations" => $assRange00to07],
            DENONIPSProfiles::ptBassSync => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSBSC, "Name" => "BassSync",
                                             "PropertyName" => "BassSync", "Profilesettings" => ["Intensity", "", " dB", 0, 16, 1, 0], "Associations" => $assRange00to16],
            DENONIPSProfiles::ptSubwooferLevel => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSSWL, "Name" => "Subwoofer Level",
                                                   "PropertyName" => "SubwooferLevel", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 1, 0], "Associations" => $assRange38to62],
            DENONIPSProfiles::ptSubwoofer2Level => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSSWL2, "Name" => "Subwoofer 2 Level",
                                                   "PropertyName" => "Subwoofer2Level", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 1, 0], "Associations" => $assRange38to62],
            DENONIPSProfiles::ptDialogLevelAdjust => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSDIL, "Name" => "Dialog Level Adjust",
                                             "PropertyName" => "DialogLevelAdjust", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 1, 0], "Associations" => $assRange38to62],
             DENONIPSProfiles::ptAuroMatic3DStrength => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::PSAUROST, "Name" => "Auromatic 3D Strength",
                                                        "PropertyName" => "AuroMatic3DStrength", "Profilesettings" => ["Intensity", "", " dB", 0, 16, 1, 0], "Associations" => $assRange00to16],
            DENONIPSProfiles::ptZone2Volume => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z2VOL, "Name" => "Zone 2 Volume",
                                                "PropertyName" => "Z2Volume", "Profilesettings" => ["Intensity", "", " dB", -80, 18, 1, 0], "Associations" => $assRange00to98,
                                                "IndividualStatusRequest" => 'Z2?'],
            DENONIPSProfiles::ptZone3Volume => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z3VOL, "Name" => "Zone 3 Volume",
                                                "PropertyName" => "Z3Volume", "Profilesettings" => ["Intensity", "", " dB", -80, 18, 1, 0], "Associations" => $assRange00to98,
                                                "IndividualStatusRequest" => 'Z3?'],
            DENONIPSProfiles::ptZone2Sleep => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z2SLP, "Name" => "Zone 2 Sleep",
                                               "PropertyName" => "Z2Sleep", "Profilesettings" => ["Clock", "", " Min", 0, 120, 10, 0], "Associations" => $assRange000to120_ptSleep],
            DENONIPSProfiles::ptZone3Sleep => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z3SLP, "Name" => "Zone 3 Sleep",
                                               "PropertyName" => "Z3Sleep", "Profilesettings" => ["Clock", "", " Min", 0, 120, 10, 0], "Associations" => $assRange000to120_ptSleep],
            DENONIPSProfiles::ptZone2ChannelVolumeFL => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z2CVFL, "Name" => "Zone 2 Channel Volume Front Left",
                                                         "PropertyName" => "Z2CVFL", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 1, 0], "Associations" => $assRange38to62],
            DENONIPSProfiles::ptZone2ChannelVolumeFR => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z2CVFR, "Name" => "Zone 2 Channel Volume Front Right",
                                                         "PropertyName" => "Z2CVFR", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 1, 0], "Associations" => $assRange38to62],
            DENONIPSProfiles::ptZone3ChannelVolumeFL => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z3CVFL, "Name" => "Zone 3 Channel Volume Front Left",
                                                         "PropertyName" => "Z3CVFL", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 1, 0], "Associations" => $assRange38to62],
            DENONIPSProfiles::ptZone3ChannelVolumeFR => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z3CVFR, "Name" => "Zone 3 Channel Volume Front Right",
                                                         "PropertyName" => "Z3CVFR", "Profilesettings" => ["Intensity", "", " dB", -12, 12, 1, 0], "Associations" => $assRange38to62],
            DENONIPSProfiles::ptZone2Bass => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z2PSBAS, "Name" => "Zone 2 Bass",
                                              "PropertyName" => "Z2Bass", "Profilesettings" => ["Intensity", "", " dB", -10, 10, 1, 0], "Associations" => $assRange40to60],
            DENONIPSProfiles::ptZone3Bass => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z3PSBAS, "Name" => "Zone 3 Bass",
                                              "PropertyName" => "Z3Bass", "Profilesettings" => ["Intensity", "", " dB", -10, 10, 1, 0], "Associations" => $assRange40to60],
            DENONIPSProfiles::ptZone2Treble => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z2PSTRE, "Name" => "Zone 2 Treble",
                                                "PropertyName" => "Z2Treble", "Profilesettings" => ["Intensity", "", " dB", -10, 10, 1, 0], "Associations" => $assRange40to60],
            DENONIPSProfiles::ptZone3Treble => ["Type" => DENONIPSVarType::vtFloat, "Ident" => DENON_API_Commands::Z3PSTRE, "Name" => "Zone 3 Treble",
                                                "PropertyName" => "Z3Treble", "Profilesettings" => ["Intensity", "", " dB", -10, 10, 1, 0], "Associations" => $assRange40to60],

            //Type String
//            DENONIPSProfiles::ptFriendlyName => ["Type" => DENONIPSVarType::vtString, "Ident" => "FriendlyName", "Name" => "Name Denon AVR", "PropertyName" => "FriendlyName", "Profilesettings" => ["Information"]],
            DENONIPSProfiles::ptMainZoneName => ["Type" => DENONIPSVarType::vtString, "Ident" => "MainZoneName", "Name" => "MainZone Name", "PropertyName" => "ZoneName", "Profilesettings" => ["Information"]],
//            DENONIPSProfiles::ptTopMenuLink => ["Type" => DENONIPSVarType::vtString, "Ident" => "TopMenuLink", "Name" => "Top Menu Link", "PropertyName" => "TopMenuLink", "Profilesettings" => ["Information"]],
            DENONIPSProfiles::ptModel => ["Type" => DENONIPSVarType::vtString, "Ident" => "Model", "Name" => "Model", "PropertyName" => "Model", "Profilesettings" => ["Information"]],
            DENONIPSProfiles::ptSurroundDisplay => ["Type" => DENONIPSVarType::vtString, "Ident" => DENON_API_Commands::SURROUNDDISPLAY, "Name" => "Surround Mode Display",
                                                    "PropertyName" => "SurroundDisplay", "Profilesettings" => ["Information"]],
            DENONIPSProfiles::ptDisplay => ["Type" => DENONIPSVarType::vtString, "Ident" => DENON_API_Commands::DISPLAY, "Name" => "OSD Info", "ProfilName" => "~HTMLBox", "PropertyName" => "Display", "Profilesettings" => ["TV"],
                                            "IndividualStatusRequest" => 'NSA'],
            DENONIPSProfiles::ptZone2Name => ["Type" => DENONIPSVarType::vtString, "Ident" => "Zone2Name", "Name" => "Zone 2 Name", "PropertyName" => "Zone2Name", "Profilesettings" => ["Information"]],
            DENONIPSProfiles::ptZone3Name => ["Type" => DENONIPSVarType::vtString, "Ident" => "Zone3Name", "Name" => "Zone 3 Name", "PropertyName" => "Zone3Name", "Profilesettings" => ["Information"]],
        ];


        if ($AVRType != null){
            $this->AVRType = $AVRType;

            // some profiles have to be adapted to the capabilities of the AVR
            $caps = AVRs::getCapabilities($AVRType);
            $this->updateProfileAccordingToCaps(DENONIPSProfiles::ptSurroundMode, $caps);
            $this->updateProfileAccordingToCaps(DENONIPSProfiles::ptResolution, $caps);
            $this->updateProfileAccordingToCaps(DENONIPSProfiles::ptResolutionHDMI, $caps);
            $this->updateProfileAccordingToCaps(DENONIPSProfiles::ptSpeakerOutput, $caps);
            $this->updateProfileAccordingToCaps(DENONIPSProfiles::ptDynamicVolume, $caps);
            $this->updateProfileAccordingToCaps(DENONIPSProfiles::ptVideoSelect, $caps);
        }

        if ($InputMapping != null){
            $associations = [];
            foreach ($InputMapping as $key=> $value){
                $associations[]=[$value, '', $key];
            }
            $associations[] = [count($associations), 'Source', 'SOURCE'];
            $this->profiles[DENONIPSProfiles::ptInputSource]["Associations"] = $associations;
            $this->profiles[DENONIPSProfiles::ptZone2InputSource]["Associations"] = $associations;
            $this->profiles[DENONIPSProfiles::ptZone3InputSource]["Associations"] = $associations;
            if ($this->debug){
                IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Association: '.json_encode($associations));
            }
        }

    }

    private function updateProfileAccordingToCaps($profilename, $caps){
        $ident = $this->profiles[$profilename]['Ident'];
        $associations = $this->profiles[$profilename]['Associations'];
        if (!key_exists($ident.'_SubCommands', $caps)){
            trigger_error(__FUNCTION__.': unknown capability "'.$ident.'_SubCommands'.'"');
        }
        $subcommands = $caps[$ident.'_SubCommands'];
        for ($i=(count($associations)-1); $i>=0; $i--){
            if (!in_array($associations[$i][2], $subcommands)){
                unset($associations[$i]);
            }
        }
        $this->profiles[$profilename]['Associations'] = array_values($associations);
    }

    public function SetInputSources($DenonIP, $Zone, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR)
	{

        $caps = AVRs::getCapabilities($this->AVRType);
        if($caps['httpMainZone'] != DENON_HTTP_Interface::NoHTTPInterface){
            if (!filter_var($DenonIP, FILTER_VALIDATE_IP)){
                trigger_error(__FUNCTION__.': Die IP Adresse "'.$DenonIP.'" ist ungültig!');
                return;
            }
            $this->SetAssociationsOfInputSourcesAccordingToHTTPInfo(
                $DenonIP, $caps['httpMainZone'], $Zone, $FAVORITES,
                $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR
            );
 		}
	}

	private function SetAssociationsOfInputSourcesAccordingToHTTPInfo($IP, $MainForm, $Zone, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR)
	{

        $filename = "http://".$IP.$MainForm."?_=&ZoneName=ZONE".($Zone+1);
        if ($this->debug){
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'filename: '.$filename);
        }

        $content = @file_get_contents($filename);
        if ($content === false){
            trigger_error("Datei " . $filename . " konnte nicht geöffnet werden.");
            return false;
        }


	    $xmlZone = new SimpleXMLElement($content);
        if ($xmlZone->count() == 0) {
            trigger_error("xmlzone has no children. "
                .'(filename correct?: "'.$filename.'", content: '
                .json_encode($xmlZone));
            return false;
        }

		//Inputs
		$InputFuncList = $xmlZone->xpath('.//InputFuncList');
		if (count($InputFuncList) == 0)
        {
            trigger_error("InputFuncList has no children: "
                .'(filename correct?: "'.$filename.'", content: '
                .json_encode($xmlZone));
            return false;
        }

        $RenameSource = $xmlZone->xpath('.//RenameSource');
        if (count($RenameSource) == 0) {
            trigger_error("RenameSource has no children: "
                .'(filename correct?: "'.$filename.'", content: '
                .json_encode($xmlZone));
            return false;
        }

        $SourceDelete = $xmlZone->xpath('.//SourceDelete');
        if (count($SourceDelete) == 0) {
            trigger_error("SourceDelete has no children: "
                .'(filename correct?: "'.$filename.'", content: '
                .json_encode($xmlZone));
            return false;
        }


        $Inputs = [];
        $MinValue = [];
        $UsedInput_i = -1;
        $countinput = count($InputFuncList[0]->value);

        for ($i = 0; $i <= $countinput-1; $i++){
            if ((string)$SourceDelete[0]->value[$i] == "USE")
            {
                $UsedInput_i++;
                $MinValue[$UsedInput_i] = $UsedInput_i;
                if ($MainForm == DENON_HTTP_Interface::MainForm_old){
                    $RenameInput = (string)$RenameSource[0]->value[$i];
                } else {
                    $RenameInput = (string)$RenameSource[0]->value[$i]->value;
                }

                if ($RenameInput != ""){
                    $Inputs[$UsedInput_i] = array( "Source" => (string)$InputFuncList[0]->value[$i], "RenameSource" => $RenameInput);
                } else {
                    $Inputs[$UsedInput_i] = array( "Source" => (string)$InputFuncList[0]->value[$i], "RenameSource" => (string)$InputFuncList[0]->value[$i]);
                }
            }
        }


        //Assoziationen aufbauen
        $Associations = array();

        foreach ($Inputs as $Value => $Input)
        {
            $SourceInput = str_replace(" ", "", $Input["Source"]);
            $RenameSourceInput = str_replace(" ", "", $Input["RenameSource"]);

            $Associations[] = array($Value, $RenameSourceInput, $SourceInput);
        }

        //zusätzliche Auswahl 'SOURCE' bei Zonen
        $i = count($Associations)-1;
        if ($Zone > 0){
            $Associations[] = array(++$i, "SOURCE", DENON_API_Commands::SOURCE);
        }

        //zusätzliche Inputs bei Auswahl
        if ($FAVORITES){
            $Associations[] = array(++$i, "Favoriten", DENON_API_Commands::FAVORITES);
        }
        if ($IRADIO){
            $Associations[] = array(++$i, "Internet Radio", DENON_API_Commands::IRADIO);
        }
        if ($SERVER){
            $Associations[] = array(++$i, "Server", DENON_API_Commands::SERVER);
        }
        if($NAPSTER){
            $Associations[] = array(++$i, "Napster", DENON_API_Commands::NAPSTER);
        }
        if($LASTFM){
            $Associations[] = array(++$i, "LastFM", DENON_API_Commands::LASTFM);
        }
        if($FLICKR){
            $Associations[] = array(++$i, "Flickr", DENON_API_Commands::FLICKR);
        }

        if ($this->debug){
            IPS_LogMessage(__FUNCTION__, 'InputSources-Associations: '.json_encode($Associations));
        }

        switch ($Zone){
            case 0:
                $this->profiles[DENONIPSProfiles::ptInputSource]["Associations"] = $Associations;
                break;

            case 1:
                $this->profiles[DENONIPSProfiles::ptZone2InputSource]["Associations"] = $Associations;
                break;

            case 2:
                $this->profiles[DENONIPSProfiles::ptZone3InputSource]["Associations"] = $Associations;
                break;

            default:
                trigger_error('unknown zone: '.$Zone);
                return false;
        };

	    return true;
	}

	public function GetInputVarMapping($Zone){

	    if ($Zone == 0){
			$associations = $this->profiles[DENONIPSProfiles::ptInputSource]["Associations"];
		} elseif ($Zone == 1){
            $associations = $this->profiles[DENONIPSProfiles::ptZone2InputSource]["Associations"];
		} elseif ($Zone == 2){
            $associations = $this->profiles[DENONIPSProfiles::ptZone2InputSource]["Associations"];
		} else {
		    trigger_error('unknown zone: '.$Zone);
		    return false;
        }

        $InputSourcesMapping = [];
        foreach ($associations as $association){
            $InputSourcesMapping[] = array ("Source" => $association[2], "RenameSource" => $association[1]);
        }

        return array("AVRType" => $this->AVRType, "Inputs" => $InputSourcesMapping, "Writeprotected" => false );
	}


	public function SetupVariable($ident)
	{
        IPS_LogMessage(get_class().'::'.__FUNCTION__, 'ident: '.$ident);

        if (!key_exists($ident, $this->profiles)){
            trigger_error('unknown ident: ' . $ident);
            return FALSE;
        }

        $profile = $this->profiles[$ident];
        if (!isset($profile['Type'])){
            trigger_error(__FUNCTION__.': Type not set in profile "'.$ident.'"');
            return false;
        }

        switch ($profile['Type']){
            case DENONIPSVarType::vtBoolean:
                $ret = ["Name" => $profile["Name"],
                    "Ident" => $profile["Ident"],
                    "Type" => $profile['Type'],
                    "PropertyName" => $profile['PropertyName'],
                    "ProfilName" => '~Switch',
                    "Position" => $this->getpos($ident)
                    ];
                break;

            case DENONIPSVarType::vtInteger:
            case DENONIPSVarType::vtFloat:
                $profilesettings = $profile["Profilesettings"];

                $ret = [
                    "Name" => $profile["Name"],
                    "Ident" => $profile["Ident"],
                    "Type" => $profile['Type'],
                    "PropertyName" => $profile['PropertyName'],
                    "ProfilName" => $ident,
                    "Icon" => $profilesettings[0],
                    "Prefix" => $profilesettings[1],
                    "Suffix" => $profilesettings[2],
                    "MinValue" => $profilesettings[3],
                    "MaxValue" => $profilesettings[4],
                    "Stepsize" => $profilesettings[5],
                    "Digits" => $profilesettings[6],
                    "Associations" => $profile["Associations"],
                    "Position" =>  $this->getpos($ident)
                ];
                break;

            case DENONIPSVarType::vtString:
                if (isset($profile['ProfilName'])){
                    $profilename = $profile['ProfilName'];
                } else {
                    $profilename = $ident;
                }
                $ret = [
                    "Name" => $profile["Name"],
                    "Ident" => $profile["Ident"],
                    "Type" => $profile['Type'],
                    "PropertyName" => $profile['PropertyName'],
                    "ProfilName" => $profilename,
                    "Position" => $this->getpos($ident),
                    "Icon" => $profile["Profilesettings"][0]
                ];
                break;

            default:
                trigger_error('unknown profile type: '.$profile['Type']);
                return false;

        }

        return $ret;

 	}


	public function GetVarMapping(){
        $ret = [];

        foreach ($this->profiles as $profile){
            if (isset($profile['Associations'])){
                $ValueMapping = [];
                foreach ($profile['Associations'] as $association){
                    switch ($profile['Type']){
                        case DENONIPSVarType::vtBoolean:
                            $ValueMapping[$association[1]] = $association[0];
                            break;
                        case DENONIPSVarType::vtInteger:
                            $ValueMapping[$association[2]] = $association[0];
                            break;
                        case DENONIPSVarType::vtFloat:
                            $ValueMapping[$association[0]] = $association[1];
                            break;
                        default:
                            trigger_error(__FUNCTION__.': unexpected type: '.$profile['Type']);
                    }
                }
                $ret[$profile['Ident']] = ['VarType' => $profile['Type'], 'ValueMapping' => $ValueMapping];
            }
        }

        return $ret;
    }

    public function GetAllProfiles(){
        return $this->profiles;
    }


    public function GetAllProfilesSortedByPos(){
        $ret = [];
        if ($this->debug){
            $this->checkProfiles();
        }
	    foreach (static::$order as $profileID){
            $ret[$profileID] = $this->profiles[$profileID];
        }

        return $ret;
    }


    private function checkProfiles(){
        //check if all profiles have a position in $order
        $profile_without_pos = [];
        if (count(static::$order) != count($this->profiles)){
            foreach($this->profiles as $profileID => $profile){
                if (!in_array($profileID, static::$order)){
                    $profile_without_pos[] = $profileID;
                }
            }
            if (count($profile_without_pos) > 0){
                IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Order: '.json_encode(static::$order));
                trigger_error(get_class().'::'.__FUNCTION__.': Profiles without positions: '.json_encode($profile_without_pos));
                return false;
            }
        }

        //check if all elements in order have a profile definition
        $order_without_definition = [];
        if (count(static::$order) != count($this->profiles)){
            foreach(static::$order as $order_item){
                if (!key_exists($order_item, $this->profiles)){
                    $order_without_definition[] = $order_item;
                }
            }
            if (count($order_without_definition) > 0){
                IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Profiles: '.json_encode($this->profiles));
                IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Keys: '.json_encode(array_keys($this->profiles)));
                trigger_error(get_class().'::'.__FUNCTION__.': Order Element without definition: '.json_encode($order_without_definition));
                return false;}
        }

        //check if all profiles are used in MAX Capabilities
        $all_capabilities = array_merge(
            AVR::$InfoFunctions_max
            ,AVR::$PowerFunctions_max
            , AVR::$CV_Commands_max
            , AVR::$InputSettings_max
            , AVR::$PS_Commands_max
            , AVR::$PV_Commands_max
            , AVR::$SurroundMode_max
            , AVR::$VS_Commands_max
            , AVR::$SystemControl_Commands_max
            , AVR::$Zone_Commands_max
        );

        //check if all profiles are at least used in Capabilities_max
        $profile_not_used_in_caps = [];
        foreach ($this->profiles as $profileID => $profile){
            if (!in_array($profile['Ident'], $all_capabilities)){
                $profile_not_used_in_caps[$profileID] = $profile['Ident'];
            }
        }

        if (count($profile_not_used_in_caps) > 0){
            trigger_error(get_class().'::'.__FUNCTION__.': Profiles not used in Capabilities(MAX):'.json_encode($profile_not_used_in_caps).PHP_EOL.'Capabilities: '.json_encode($all_capabilities));
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Profiles not used in Capabilities(MAX):'.json_encode($profile_not_used_in_caps).PHP_EOL.'Capabilities: '.json_encode($all_capabilities));
            return false;
        }

        return true;
    }

    public function GetSubCommandOfValue($Ident, $Value){
        $ret = null;
        foreach ($this->profiles as $profile){
            if (($profile['Ident'] == $Ident) && isset($profile['Associations'])){
                IPS_LogMessage(__FUNCTION__, 'Profile "'.$Ident.'" found: '.json_encode($profile));
                foreach ($profile['Associations'] as $item){
                    switch ($profile['Type']){
                        case DENONIPSVarType::vtBoolean:
                            if ($item[0] == $Value){
                                $ret = $item[1];
                            }
                            break;
                        case DENONIPSVarType::vtInteger:
                            if ($item[0] == $Value){
                                $ret = $item[2];
                            }
                            break;
                        case DENONIPSVarType::vtFloat:
                            if (round($item[1],1) == round($Value, 1)){ //Float Werte mit Nachkommastellen müssen zum Vergleich gerundet werden!
                                $ret = $item[0];
                            }
                            break;
                        default:
                            trigger_error(__FUNCTION__.': unknown type: '.$profile['Type']);
                    }
                    if (!is_null($ret)){
                        break;
                    }
                }
            }
            if (!is_null($ret)){
                break;
            }
        }

        if (is_null($ret)){
            trigger_error('no subcommand found. Ident: '.$Ident.', Value: '.$Value);
            return false;
        } else {
            return (string) $ret;
        }
    }

    public function GetSubCommandOfValueName($Ident, $ValueName){
        $ret = null;
        foreach ($this->profiles as $profile){
            if (($profile['Ident'] == $Ident) && isset($profile['Associations'])){
                foreach ($profile['Associations'] as $item){
                    switch ($profile['Type']){
                        case DENONIPSVarType::vtInteger:
                            if (strtoupper($item[1]) == strtoupper($ValueName)){
                                $ret = $item[2];
                            }
                            break;
                        default:
                            trigger_error(__FUNCTION__.': unknown type: '.$profile['Type']);
                    }
                    if (!is_null($ret)){
                        break;
                    }
                }
            }
            if (!is_null($ret)){
                break;
            }
        }

        if (is_null($ret)){
            trigger_error('no subcommand found. Ident: '.$Ident.', Value: '.$ValueName);
            return false;
        } else {
            return (string) $ret;
        }
    }

    private function getpos($profilename){

        $pos = array_search($profilename, static::$order);
		if ($pos === false){
            trigger_error('unknown profile: '.$profilename);
            return false;
        } else{
            return ($pos+1) * 10; //starting with 10, step size 10
        }

	}


    private function GetAssociationOfAsciiTodB($ascii_from, $ascii_to, $ascii_of_0, $db_stepsize = 1, $add_05step = false, $leading_blank = true, $invertValue = false, $scalefactor_to_db = 1){

        if (($db_stepsize <= 0) || ($scalefactor_to_db <= 0)){
            trigger_error('StepSize and ScaleFactor must be greater than 0');
            return false;
        }

        $db = 0 - (int)$ascii_of_0 + (int)$ascii_from;
        $db_to = ((int)$ascii_to - (int)$ascii_of_0)*$scalefactor_to_db;

        $value_mapping = [];
        $i = 0;

        if (!$invertValue){
            $faktor = 1;
        } else {
            $faktor = -1;
        }

        if ($leading_blank){
            $prefix = ' ';
        } else {
            $prefix = '';
        }

        while ($db <= $db_to){

            $ascii = (int) $ascii_of_0 + $db/$scalefactor_to_db;
            $pad_length = strlen($ascii_to);
            $ascii = str_pad($ascii, $pad_length, '0', STR_PAD_LEFT);

            $value_mapping[] = [$prefix.$ascii, $db*($faktor)];

            if ($add_05step && ($db < $db_to)) {
                $value_mapping[] = [$prefix.$ascii.'5', ($db+0.5)*$faktor];
            }

            $db = $db + $db_stepsize;
            $i++;
        }
        return $value_mapping;

    }
}

class DENON_StatusHTML extends stdClass {
    private $debug = true;

	//Status
	public function getStates ($ip, $InputMapping, $AVRType)
	{
	    //Main
		$DataMain = array();
        $VarMappings = (new DENONIPSProfiles($AVRType, $InputMapping))->GetVarMapping();


        try {
			$xmlMainZone = @new SimpleXMLElement(file_get_contents("http://".$ip."/goform/formMainZone_MainZoneXml.xml"));
			if ($xmlMainZone)
				{
				$DataMain = $this->MainZoneXml($xmlMainZone, $DataMain, $VarMappings);
				}
			else
				{
				exit("Datei ".$xmlMainZone." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			} 

		try { 
			$xmlMainZoneStatus = @new SimpleXMLElement(file_get_contents("http://".$ip."/goform/formMainZone_MainZoneXmlStatus.xml"));
			if ($xmlMainZoneStatus)
				{
				$DataMain = $this->MainZoneXmlStatus($xmlMainZoneStatus, $DataMain, $VarMappings);
				}
			else
				{
				exit("Datei ".$xmlMainZoneStatus." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			} 	

		try { 
			$xmlNetAudioStatus = @new SimpleXMLElement(file_get_contents("http://".$ip."/goform/formMainZone_NetAudioStatusXml.xml"));
			if ($xmlNetAudioStatus)
				{
				$DataMain = $this->NetAudioStatusXml($xmlNetAudioStatus, $DataMain);
				}
			else
				{
				exit("Datei ".$xmlNetAudioStatus." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			} 	
		
		
		try { 
			$xmlDeviceinfo = @new SimpleXMLElement(file_get_contents("http://".$ip."/goform/formMainZone_Deviceinfo.xml"));
			if ($xmlDeviceinfo)
				{
				$DataMain = $this->Deviceinfo($xmlDeviceinfo, $DataMain);
				}
			else
				{
				exit("Datei ".$xmlDeviceinfo." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}	

		 // Zone 2
		
		$DataZ2 = array();
		try { 
			  $xml = @new SimpleXMLElement(file_get_contents("http://".$ip."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE2"));
			  if ($xml)
				{
				$DataZ2 = $this->StateZone2($xml, $DataZ2, $InputMapping);
				}
			else
				{
				exit("Datei ".$xml." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}
	
		// Zone 3
		
		$DataZ3 = array();
		try { 
			$xml = @new SimpleXMLElement(file_get_contents("http://".$ip."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE3"));
			if ($xml)
				{
				$DataZ3 = $this->StateZone3($xml, $DataZ3, $InputMapping);
				}
			else
				{
				exit("Datei ".$xml." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}
		
		
		//Model
		try { 
			$xmlDeviceSearch = @new SimpleXMLElement(file_get_contents("http://".$ip."/goform/formiPhoneAppDeviceSearch.xml"));
			if ($xmlDeviceSearch)
				{
				$DataMain = $this->DeviceSearch($xmlDeviceSearch, $DataMain);
				$DataZ2 = $this->DeviceSearch($xmlDeviceSearch, $DataZ2);
				$DataZ3 = $this->DeviceSearch($xmlDeviceSearch, $DataZ3);
				}
			else
				{
				exit("Datei ".$xmlDeviceSearch." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}		

		$datasend =  array(
			        'ResponseType' => 'HTTP',
			        'Data' => array(
                        'Mainzone' => $DataMain,
                        'Zone2' => $DataZ2,
                        'Zone3' => $DataZ3
    					)
	        		);


		if ($this->debug){
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'DataSend: '.json_encode($datasend));
        }

		return $datasend;
	}
	
	private function MainZoneXml(SimpleXMLElement $xml, $data,$VarMappings)	{
		
		//FriendlyName
		/*
		$FriendlyName = $xml->xpath('.//FriendlyName');
		if ($FriendlyName)
		{
			$data['FriendlyName'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$FriendlyName[0]->value, 'Subcommand' => 'Denon AVR Name');
		}
		*/

		//Power
        $Element = $xml->xpath('.//Power');
		if ($Element){
            $VarMapping = $VarMappings[DENON_API_Commands::PW];
            $SubCommand = strtoupper((string)$Element[0]->value);
            $data[DENON_API_Commands::PW] =  array('VarType' => $VarMapping['VarType'], 'Value' => $VarMapping['ValueMapping'][$SubCommand], 'Subcommand' => $SubCommand);
		}


		//Zone Power
        $Element = $xml->xpath('.//ZonePower');
		if ($Element){
            $VarMapping = $VarMappings[DENON_API_Commands::ZM];
            $SubCommand = strtoupper((string)$Element[0]->value);
            $data[DENON_API_Commands::ZM] =  array('VarType' => $VarMapping['VarType'], 'Value' => $VarMapping['ValueMapping'][$SubCommand], 'Subcommand' => $SubCommand);
		}

		//RenameZone
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$data['MainZoneName'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$RenameZone[0]->value, 'Subcommand' => 'MainZone Name');	
		}

		//TopMenuLink
		/*
		$TopMenuLink = $xml->xpath('.//TopMenuLink');
		if ($TopMenuLink)
		{
			$data['TopMenuLink'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$TopMenuLink[0]->value, 'Subcommand' => 'TopMenu Link');
		}
		*/

		//ModelId
		/*
		$ModelId = $xml->xpath('.//ModelId');
		if ($ModelId)
		{
			$data['ModelId'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$ModelId[0]->value, 'Subcommand' => 'ModelId');
		}
		*/

		//SalesArea
		/*
		$SalesArea = $xml->xpath('.//SalesArea');
		if ($SalesArea)
		{
			$data['SalesArea'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$SalesArea[0]->value, 'Subcommand' => 'SalesArea');
		}
		*/

		//InputFuncSelect
        $Element = $xml->xpath('.//InputFuncSelect');
        if ($Element){
            $VarMapping = $VarMappings[DENON_API_Commands::SI];
            $SubCommand = strtoupper((string)$Element[0]->value);
            if (key_exists($SubCommand, DENON_API_Commands::$SIMapping)){
                $SubCommand = DENON_API_Commands::$SIMapping[$SubCommand];
            }

            $data[DENON_API_Commands::SI] =  array('VarType' => $VarMapping['VarType'], 'Value' => $VarMapping['ValueMapping'][$SubCommand], 'Subcommand' => $SubCommand);
        }

		//NetFuncSelect
		/*
		$NetFuncSelect = $xml->xpath('.//NetFuncSelect');
		if ($NetFuncSelect)
		{
			$data['NetFuncSelect'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$NetFuncSelect[0]->value, 'Subcommand' => 'NetFuncSelect');
		}
		*/

		//InputFuncSelectMain
		/*
		$InputFuncSelectMain = $xml->xpath('.//InputFuncSelectMain');
		if ($InputFuncSelectMain)
		{
			$data['SI'] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => (string)$InputFuncSelectMain[0]->value, 'Subcommand' => 'Input Source');
		}
		*/
		
		//selectSurround
		/*
		$selectSurround = $xml->xpath('.//selectSurround');
		if ($selectSurround)
		{
			$data['MS'] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => (string)$selectSurround[0]->value, 'Subcommand' => 'Surround Mode');
		}
		*/
		
		//VolumeDisplay z.B. relative
		/*
		$VolumeDisplay = $xml->xpath('.//VolumeDisplay');
		if ($VolumeDisplay)
		{
			$data['VolumeDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$VolumeDisplay[0]->value, 'Subcommand' => 'VolumeDisplay');
		}
		*/

		//MasterVolume
        $Element = $xml->xpath('.//MasterVolume');
        if ($Element){
            $VarMapping = $VarMappings[DENON_API_Commands::MV];
            $Value = (float)$Element[0]->value;
            $SubCommand = array_search($Value, $VarMapping['ValueMapping']);
            $data[DENON_API_Commands::MV] =  array('VarType' => $VarMapping['VarType'], 'Value' => $Value, 'Subcommand' => $SubCommand);
        }


		//Mute
        $Element = $xml->xpath('.//Mute');
        if ($Element){
            $VarMapping = $VarMappings[DENON_API_Commands::MU];
            $SubCommand = strtoupper((string)$Element[0]->value);
            $data[DENON_API_Commands::MU] =  array('VarType' => $VarMapping['VarType'], 'Value' => $VarMapping['ValueMapping'][$SubCommand], 'Subcommand' => $SubCommand);
        }

		//RemoteMaintenance
		/*
		$RemoteMaintenance = $xml->xpath('.//RemoteMaintenance');
		if ($RemoteMaintenance)
		{
			$RemoteMaintenanceMapping = array("ON" => true, "OFF" => false);
			foreach ($RemoteMaintenanceMapping as $Command => $RemoteMaintenanceValue)
			{
			if ($Command == (string)$RemoteMaintenance[0]->value)
				{
				$data['RemoteMaintenance'] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $RemoteMaintenanceValue, 'Subcommand' => 'RemoteMaintenance');
				}
			}	
		}
		*/

		//GameSourceDisplay
		/*
		$GameSourceDisplay = $xml->xpath('.//GameSourceDisplay');
		if ($GameSourceDisplay)
		{
			$data['GameSourceDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$GameSourceDisplay[0]->value, 'Subcommand' => 'GameSourceDisplay');
		}
		*/

		//LastfmDisplay
		/*
		$LastfmDisplay = $xml->xpath('.//LastfmDisplay');
		if ($LastfmDisplay)
		{
			$data['LastfmDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$LastfmDisplay[0]->value, 'Subcommand' => 'LastfmDisplay');
		}
		*/

		//SubwooferDisplay
		/*
		$SubwooferDisplay = $xml->xpath('.//SubwooferDisplay');
		if ($SubwooferDisplay)
		{
			$data['SubwooferDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$SubwooferDisplay[0]->value, 'Subcommand' => 'SubwooferDisplay');
		}
		*/


		//Zone2VolDisp
		/*
		$Zone2VolDisp = $xml->xpath('.//Zone2VolDisp');
		if ($Zone2VolDisp )
		{
			$data['Zone2VolDisp'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$Zone2VolDisp[0]->value, 'Subcommand' => 'Zone2VolDisp');
		}
		*/
		
	
	return $data;
	}
	
	private function MainZoneXmlStatus(SimpleXMLElement $xml, $data, $VarMappings)
	{
		//RestorerMode
		/*
		$RestorerMode = $xml->xpath('.//RestorerMode');
		if ($RestorerMode)
		{
			$data[DENON_API_Commands::PSRSTR] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => (string)$RestorerMode[0]->value, 'Subcommand' => 'Audio Restorer');
		}
		*/
		
		//InputFuncSelect
		/*
		if ($AVRType == "AVR-4311")
		{
			$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
			if ($InputFuncSelect)
			{
				foreach ($InputMapping as $Command => $InputSourceValue)
				{
				if ($Command == (string)$InputFuncSelect[0]->value)
					{
					$data[DENON_API_Commands::SI] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $InputSourceValue, 'Subcommand' => $Command);
					}
				}	
				
			}
		}
		*/

		//SurrMode
        /*
        $Element = $xml->xpath('.//SurrMode');
        if ($Element){
            $VarMapping = $VarMappings[DENON_API_Commands::MS];
            $SubCommand = rtrim(strtoupper((string)$Element[0]->value));
            $data[DENON_API_Commands::MS] =  array('VarType' => $VarMapping['VarType'], 'Value' => $VarMapping['ValueMapping'][$SubCommand], 'Subcommand' => $SubCommand);
        }
        */
		return $data;
	}
	
	private function NetAudioStatusXml(SimpleXMLElement $xml, $data)
	{
		//Model
        $Element = $xml->xpath('.//szLine');
		if ($Element){
			$data['ModelDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$Element[0]->value, 'Subcommand' => 'ModelDisplay');
		}

		return $data;
	}
	
	private function Deviceinfo(SimpleXMLElement $xml, $data)
	{
		//ModelName
		$ModelName = $xml->xpath('.//ModelName');
		if ($ModelName){
			$data['ModelName'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$ModelName[0], 'Subcommand' => 'ModelName');
        }
		
		return $data;
	}
	
	private function DeviceSearch(SimpleXMLElement $xml, $data)
	{
		//Model
		$Model = $xml->xpath('.//Model');
		if ($Model)
			{
				$ModelValue = str_replace(" ", "", (string)$Model[0]->value);
				$data['Model'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => $ModelValue, 'Subcommand' => 'Model');
			}
		

		return $data;
	}
	
	private function StateZone2(SimpleXMLElement $xml, $data, $InputMapping)
	{
		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{	
			$AVRPowerMapping = array("ON" => true, "STANDBY" => false);
			foreach ($AVRPowerMapping as $Command => $AVRPowerValue)
			{
			if ($Command == (string)$AVRPower[0]->value)
				{
				$data[DENON_API_Commands::PW] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $AVRPowerValue, 'Subcommand' => $Command);	
				}
			}	
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$ZonePowerMapping = array("ON" => true, "OFF" => false);
			foreach ($ZonePowerMapping as $Command => $ZonePowerValue)
			{
			if ($Command == (string)$ZonePower[0]->value)
				{
				$data[DENON_API_Commands::Z2POWER] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $ZonePowerValue, 'Subcommand' => $Command);
				}
			}	
		}

		//Zone Name
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$data['Zone2Name'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$RenameZone[0]->value, 'Subcommand' => 'Zone2 Name');	
		}
		
		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
		{
			foreach ($InputMapping as $Command => $InputSourceValue)
			{
			if ($Command == (string)$InputFuncSelect[0]->value)
				{
				$data[DENON_API_Commands::Z2INPUT] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $InputSourceValue, 'Subcommand' => $Command);
				}
			}	
			
		}
		
		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$data[DENON_API_Commands::Z2VOL] =  array('VarType' => DENONIPSVarType::vtFloat, 'Value' => (float)$MasterVolume[0]->value, 'Subcommand' => (float)$MasterVolume[0]->value);
		}
		

		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MuteMapping = array("on" => true, "off" => false);
			foreach ($MuteMapping as $Command => $MuteValue)
			{
			if ($Command == (string)$Mute[0]->value)
				{
				$data[DENON_API_Commands::Z2MU] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $MuteValue, 'Subcommand' => $Command);
				}
			}	
		}

	return $data;
	}
	
	private function StateZone3(SimpleXMLElement $xml, $data, $InputMapping)
	{
		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{	
			$AVRPowerMapping = array("ON" => true, "STANDBY" => false);
			foreach ($AVRPowerMapping as $Command => $AVRPowerValue)
			{
			if ($Command == (string)$AVRPower[0]->value)
				{
				$data[DENON_API_Commands::PW] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $AVRPowerValue, 'Subcommand' => $Command);	
				}
			}	
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$ZonePowerMapping = array("ON" => true, "OFF" => false);
			foreach ($ZonePowerMapping as $Command => $ZonePowerValue)
			{
			if ($Command == (string)$ZonePower[0]->value)
				{
				$data[DENON_API_Commands::Z3POWER] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $ZonePowerValue, 'Subcommand' => $Command);
				}
			}	
		}

		//Zone Name
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$data['Zone3Name'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$RenameZone[0]->value, 'Subcommand' => 'Zone3 Name');	
		}
		
		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
		{
			foreach ($InputMapping as $Command => $InputSourceValue)
			{
			if ($Command == (string)$InputFuncSelect[0]->value)
				{
				$data[DENON_API_Commands::Z3INPUT] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $InputSourceValue, 'Subcommand' => $Command);
				}
			}	
			
		}
		
		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$data[DENON_API_Commands::Z3VOL] =  array('VarType' => DENONIPSVarType::vtFloat, 'Value' => (float)$MasterVolume[0]->value, 'Subcommand' => (float)$MasterVolume[0]->value);
		}
		

		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MuteMapping = array("on" => true, "off" => false);
			foreach ($MuteMapping as $Command => $MuteValue)
			{
			if ($Command == (string)$Mute[0]->value)
				{
				$data[DENON_API_Commands::Z3MU] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $MuteValue, 'Subcommand' => $Command);
				}
			}	
		}

	return $data;
	}
	
}

class DENON_HTTP_Interface extends stdClass {

    const NoHTTPInterface = '';
    const MainForm_old = '/goform/formMainZone_MainZoneXml.xml';
    const MainForm = '/goform/formMainZone_MainZoneXmlStatus.xml';
}

class DENON_API_Commands extends stdClass
{

//MAIN Zone
    const PW = "PW"; // Power
    const MV = "MV"; // Master Volume
	//CV
	const CVFL = "CVFL"; // Channel Volume Front Left
	const CVFR = "CVFR"; // Channel Volume Front Right
	const CVC = "CVC"; // Channel Volume Center
	const CVSW = "CVSW"; // Channel Volume Subwoofer
	const CVSW2 = "CVSW2"; // Channel Volume Subwoofer2
	const CVSL = "CVSL"; // Channel Volume Surround Left
	const CVSR = "CVSR"; // Channel Volume Surround Right
	const CVSBL = "CVSBL"; // Channel Volume Surround Back Left
	const CVSBR = "CVSBR"; // Channel Volume Surround Back Right
	const CVSB = "CVSB"; // Channel Volume Surround Back
	const CVFHL = "CVFHL"; // Channel Volume Front Height Left
	const CVFHR = "CVFHR"; // Channel Volume Front Height Right
	const CVFWL = "CVFWL"; // Channel Volume Front Wide Left
	const CVFWR = "CVFWR"; // Channel Volume Front Wide Right
	const MU = "MU"; // Volume Mute
	const SI = "SI"; // Select Input
	const ZM = "ZM"; // Main Zone
	const SD = "SD"; // Select Auto/HDMI/Digital/Analog
	const DC = "DC"; // Digital Input Mode Select Auto/PCM/DTS
	const SV = "SV"; // Video Select
	const SLP = "SLP"; // Main Zone Sleep Timer
	const MS = "MS"; // Select Surround Mode
	const MN = "MN"; // System
    const MSQUICK = "MSQUICK"; // Quick Select Mode Select (Denon)
	const MSQUICKMEMORY = "MEMORY"; // Quick Select Mode Memory
    const MSSMART = "MSSMART"; // Smart Select Mode Select (Marantz)

	//MU
	const MUON = "ON"; // Volume Mute ON
	const MUOFF = "OFF"; // Volume Mute Off
	
	//VS
	const VS = "VS"; // Video Setting
	const VSASP = "VSASP"; // ASP
	const VSSC = "VSSC"; // Set Resolution

	const VSSCH = "VSSCH"; // Set Resolution HDMI
	const VSAUDIO = "VSAUDIO"; // Set HDMI Audio Output
	const VSMONI = "VSMONI"; // Set HDMI Monitor
	const VSVPM = "VSVPM"; // Set Video Processing Mode
	const VSVST = "VSVST"; // Set Vertical Stretch
	//PS
	const PS = "PS"; // Parameter Setting
	const PSATT = "PSATT"; // SW ATT
	const PSTONECTRL = "PSTONE_CTRL"; // Tone Control !!da Ident nur Buchstaben und Zahlen enthalten darf, wurde das Blank ersetzt
	const PSSB = "PSSB"; // Surround Back SP Mode
    const PSCINEMAEQ = "PSCINEMA_EQ"; // Cinema EQ
    const PSHTEQ = "PSHT_EQ"; // Cinema EQ
	const PSMODE = "PSMODE"; // Mode Music
	const PSDOLVOL = "PSDOLVOL"; // Dolby Volume direct change
	const PSVOLLEV = "PSVOLLEV"; // Dolby Volume Leveler direct change
	const PSVOLMOD = "PSVOLMOD"; // Dolby Volume Modeler direct change
	const PSFH = "PSFH"; // FRONT HEIGHT
	const PSPHG = "PSPHG"; // PL2z HEIGHT GAIN direct change
    const PSSP = "PSSP"; // Speaker Output set
    const PSREFLEV = "PSREFLEV"; // Dynamic EQ Reference Level
	const PSMULTEQ = "PSMULTEQ"; // MultEQ XT 32 mode direct change
    const PSDYNEQ = "PSDYNEQ"; // Dynamic EQ
    const PSLFC = "PSLFC"; // Audyssey LFC
    const PSDYNVOL = "PSDYNVOL"; // Dynamic Volume
	const PSDSX = "PSDSX"; // Audyssey DSX Change
    const PSSTW = "PSSTW"; // STAGE WIDTH
    const PSCNTAMT = "PSCNTAMT"; // Audyssey Containment Amount
    const PSGEQ = "PSGEQ"; // Graphic EQ
    const PSHEQ = "PSGEQ"; // Headphone EQ
	const PSSTH = "PSSTH"; // STAGE HEIGHT
	const PSBAS = "PSBAS"; // BASS
    const PSTRE = "PSTRE"; // TREBLE
    const PSLOM = "PSLOM"; // Loudness Management
    const PSDRC = "PSDRC"; // DRC direct change
    const PSMDAX = "PSMDAX"; // M-DAX
	const PSDCO = "PSDCO"; // D.COMP direct change
    const PSLFE = "PSLFE"; // LFE
    const PSLFL = "PSLFL"; // LFF
	const PSEFF = "PSEFF"; // EFFECT direct change	Level
    const PSDELAY = "PSDELAY"; // Audio DELAY
    const PSDEL = "PSDEL"; // DELAY
	const PSAFD = "PSAFD"; // Auto Flag Detect Mode
	const PSPAN = "PSPAN"; // PANORAMA	
    const PSDIM = "PSDIM"; // DIMENSION
	const PSCEN = "PSCEN"; // CENTER WIDTH
    const PSCEI = "PSCEI"; // CENTER IMAGE
    const PSCEG = "PSCEG"; // CENTER GAIN
    const PSDIC = "PSDIC"; // DIALOG CONTROL
    const PSRSTR = "PSRSTR"; //Audio Restorer
    const PSFRONT = "PSFRONT"; //Front Speaker
	const PSRSZ = "PSRSZ"; //Room Size
	const PSSWR = "PSSWR"; //Subwoofer
	
	//PV
    const PV = "PV"; // Picture Mode
    const PVPICT = "PVPICT"; //Picture Mode beim Senden
    const PVPICTOFF = "OFF"; // Picture Mode Off
    const PVPICTSTD = "STD"; // Picture Mode Standard
    const PVPICTMOV = "MOVIE"; // Picture Mode Movie
    const PVPICTVVD = "VVD"; // Picture Mode Vivid
    const PVPICTSTM = "STM"; // Picture Mode Stream
    const PVPICTCTM = "CTM"; // Picture Mode Custom
    const PVPICTDAY = "DAY"; // Picture Mode ISF Day
    const PVPICTNGT = "NGT"; // Picture Mode ISF Night

    const PVCN = "PVCN"; // Contrast
    const PVBR = "PVBR"; // Brightness
    const PVST = "PVST"; // Saturation
	const PVCM = "PVCM"; // Chroma
	const PVHUE = "PVHUE"; // Hue
	const PVENH = "PVENH"; // Enhancer
	
	const PVDNR = "PVDNR"; // Digital Noise Reduction direct change
	const PVDNROFF = " OFF"; // Digital Noise Reduction Off
	const PVDNRLOW = " LOW"; // Digital Noise Reduction Low
	const PVDNRMID = " MID"; // Digital Noise Reduction Middle
	const PVDNRHI = " HI"; // Digital Noise Reduction High
	
	const SR = " ?"; //Status Request
	
	//Zone 2
	const Z2 = "Z2"; // Zone 2
	const Z2ON = "ON"; // Zone 2 On
	const Z2OFF = "OFF"; // Zone 2 Off
	const Z2POWER = "Z2POWER"; // Zone 2 Power Z2 beim Senden
	const Z2INPUT = "Z2INPUT"; // Zone 2 Input Z2 beim Senden
	const Z2VOL = "Z2VOL"; // Zone 2 Volume Z2 beim Senden
	const Z2MU = "Z2MU"; // Zone 2 Mute
	const Z2CS = "Z2CS"; // Zone 2 Channel Setting
	const Z2CSST = "ST"; // Zone 2 Channel Setting Stereo
	const Z2CSMONO = "MONO"; // Zone 2 Channel Setting Mono
	const Z2CVFL = "Z2CVFL"; // Zone 2 Channel Volume FL
	const Z2CVFR = "Z2CVFR"; // Zone 2 Channel Volume FR
	const Z2HPF = "Z2HPF"; // Zone 2 HPF
	const Z2HDA = "Z2HDA"; // (nur) Zone 2 HDA
	const Z2HDATHR = " THR"; // (nur) Zone 2 HDA
	const Z2HDAPCM = " PCM"; // (nur) Zone 2 HDA
	const Z2PSBAS = "Z2PSBAS"; // Zone 2 Parameter Bass
	const Z2PSTRE = "Z2PSTRE"; // Zone 2 Parameter Treble
	const Z2SLP = "Z2SLP"; // Zone 2 Sleep Timer
    const Z2QUICK = "Z2QUICK"; // Zone 2 Quick
    const Z2SMART = "Z2SMART"; // Zone 2 Smart

	//Zone 3
	const Z3 = "Z3"; // Zone 3
	const Z3ON = "ON"; // Zone 3 On
	const Z3OFF = "OFF"; // Zone 3 Off
	const Z3POWER = "Z3POWER"; // Zone 3 Power Z3 beim Senden
	const Z3INPUT = "Z3INPUT"; // Zone 3 Input Z3 beim Senden
	const Z3VOL = "Z3VOL"; // Zone 3 Volume Z3 beim Senden
	const Z3MU = "Z3MU"; // Zone 3 Mute
	const Z3CS = "Z3CS"; // Zone 3 Channel Setting
	const Z3CSST = "ST"; // Zone 3 Channel Setting Stereo
	const Z3CSMONO = "MONO"; // Zone 3 Channel Setting Mono
	const Z3CVFL = "Z3CVFL"; // Zone 3 Channel Volume FL
	const Z3CVFR = "Z3CVFR"; // Zone 3 Channel Volume FR
	const Z3HPF = "Z3HPF"; // Zone 3 HPF
	const Z3PSBAS = "Z3PSBAS"; // Zone 3 Parameter Bass
	const Z3PSTRE = "Z3PSTRE"; // Zone 3 Parameter Treble
	const Z3SLP = "Z3SLP"; // Zone 3 Sleep Timer
    const Z3QUICK = "Z3QUICK"; // Zone 3 Quick
    const Z3SMART = "Z3SMART"; // Zone 3 Smart

	const TF = "TF"; // Tuner Frequency
	const TP = "TP"; // Tuner Preset
	const TM = "TM"; // Tuner Mode
	const NS = "NS"; // Network Audio
	const TR = "TR"; // Trigger
	const SY = "SY"; // Remote Lock
	const UG = "UG"; // Upgrade ID Display
	
	//Analog Tuner
	const TPANUP = "UP"; //TUNER PRESET CH UP
	const TPANDOWN = "DOWN"; //TUNER PRESET CH DOWN
	const TPAN = "TPAN"; //TUNER PRESET 
	const TPANMEM = "TPANMEM"; //TUNER PRESET Memory
	
	//Network Audio
	const NSB = "NSB"; //Direct Preset CH Play 00-55,00=A1,01=A2,B1=08,G8=55
	
	// Display Network Audio Navigation
	const NAUP = "NS90"; // Network Audio Cursor Up Control
	const NADOWN = "NS91"; // Network Audio Cursor Down Control
	const NALEFT = "NS92"; // Network Audio Cursor Left Control
	const NARIGHT = "NS93"; // Network Audio Cursor Right Control
	const NAENTER = "NS94"; // Network Audio Cursor Enter Control
	const NAPLAY = "NS9A"; // Network Audio Play
	const NAPAUSE = "NS9B"; // Network Audio Pause
	const NASTOP = "NS9C"; // Network Audio Stop
	const NASKIPPLUS = "NS9D"; // Network Audio Skip +
	const NASKIPMINUS = "NS9E"; // Network Audio Skip -
	const NAREPEATONE = "NS9H"; // Network Audio Repeat One
	const NAREPEATALL = "NS9I"; // Network Audio Repeat All
	const NAREPEATOFF = "NS9J"; // Network Audio Repeat Off
	const NARANDOMON = "NS9K"; // Network Audio Random On
	const NARANDOMOFF = "NS9M"; // Network Audio Random Off
	const NATOGGLE = "NS9W"; // Network Audio Toggle Switch
	const NAPAGENEXT = "NS9X"; // Network Audio Page Next
	const NAPAGEPREV = "NS9Y"; // Network Audio Page Previous
	
	
	//Display 
	const DISPLAY = "Display"; // Display zur Anzeige
	const NSA = "NSA"; // Network Audio Extended
	const NSA0 = "NSA0"; // Network Audio Extended Line 0
	const NSA1 = "NSA1"; // Network Audio Extended Line 1
	const NSA2 = "NSA2"; // Network Audio Extended Line 2
	const NSA3 = "NSA3"; // Network Audio Extended Line 3
	const NSA4 = "NSA4"; // Network Audio Extended Line 4
	const NSA5 = "NSA5"; // Network Audio Extended Line 5
	const NSA6 = "NSA6"; // Network Audio Extended Line 6
	const NSA7 = "NSA7"; // Network Audio Extended Line 7
	const NSA8 = "NSA8"; // Network Audio Extended Line 8
	
	const NSE = "NSE"; // Network Audio Onscreen Display Information
	const NSE0 = "NSE0"; // Network Audio Onscreen Display Information Line 0
	const NSE1 = "NSE1"; // Network Audio Onscreen Display Information Line 1
	const NSE2 = "NSE2"; // Network Audio Onscreen Display Information Line 2
	const NSE3 = "NSE3"; // Network Audio Onscreen Display Information Line 3
	const NSE4 = "NSE4"; // Network Audio Onscreen Display Information Line 4
	const NSE5 = "NSE5"; // Network Audio Onscreen Display Information Line 5
	const NSE6 = "NSE6"; // Network Audio Onscreen Display Information Line 6
	const NSE7 = "NSE7"; // Network Audio Onscreen Display Information Line 7
	const NSE8 = "NSE8"; // Network Audio Onscreen Display Information Line 8
	const NSE9 = "NSE9"; // Network Audio Onscreen Display Information Line 9
	
	//SUB Commands
	
	//PW
	const PWON = "ON"; // Power On
	const PWSTANDBY = "STANDBY"; // Power Standbye
	
	//MV
	const MVUP = "UP"; // Master Volume Up
	const MVDOWN = "DOWN"; // Master Volume Down
	
	
	//SI + SV
	const PHONO = "PHONO"; // Select Input Source Phono
	const CD = "CD"; // Select Input Source CD
	const TUNER = "TUNER"; // Select Input Source Tuner
	const DVD = "DVD"; // Select Input Source DVD
	const BD = "BD"; // Select Input Source BD
	const BT = "BT"; // Select Input Source Blutooth
	const MPLAY = "MPLAY"; // Select Input Source Mediaplayer
	const TV = "TV"; // Select Input Source TV
    const SAT_CBL = "SAT/CBL"; // Select Input Source Sat/CBL
    const SAT = "SAT"; // Select Input Source Sat
    const VCR = "VCR"; // Select Input Source VCR
	const DVR = "DVR"; // Select Input Source DVR
    const GAME = "GAME"; // Select Input Source Game
    const GAME2 = "GAME2"; // Select Input Source Game
	const AUX1 = "AUX1"; // Select Input Source AUX1
	const AUX2 = "AUX1"; // Select Input Source AUX1
	const VAUX = "V.AUX"; // Select Input Source V.AUX
	const DOCK = "DOCK"; // Select Input Source Dock
	const IPOD = "IPOD"; // Select Input Source iPOD
    const NETUSB = "NET/USB"; // Select Input Source NET/USB
    const NET = "NET"; // Select Input Source NET
	const LASTFM = "LASTFM"; // Select Input Source LastFM
	const FLICKR = "FLICKR"; // Select Input Source Flickr
	const FAVORITES = "FAVORITES"; // Select Input Source Favorites
	const IRADIO = "IRADIO"; // Select Input Source Internet Radio
    const SERVER = "SERVER"; // Select Input Source Server
    const NAPSTER = "NAPSTER"; // Select Input Source Napster
    const USB_IPOD = "USB/IPOD"; // Select Input USB/IPOD
    const SOURCE = "SOURCE"; // Select Input Source of Main Zone
    const ON = "ON"; // Select Input Source On
    const OFF = "ON"; // Select Input Source Off

    static public $SIMapping = ['CBL/SAT' => DENON_API_Commands::SAT_CBL,
                                 'MediaPlayer' => DENON_API_Commands::MPLAY,
                                 'Media Player' => DENON_API_Commands::MPLAY,
                                 'iPod/USB' => DENON_API_Commands::USB_IPOD,
                                 'TVAUDIO' => DENON_API_Commands::TV,
                                 'Bluetooth' => DENON_API_Commands::BT,
                                 'Blu-ray' => DENON_API_Commands::BD,
                                 'Online Music' => DENON_API_Commands::NET];

    static public $SI_InputSettings = [
                                DENON_API_Commands::PHONO,
                                DENON_API_Commands::CD,
                                DENON_API_Commands::TUNER,
                                DENON_API_Commands::DVR,
                                DENON_API_Commands::BD,
                                DENON_API_Commands::BT,
                                DENON_API_Commands::MPLAY,
                                DENON_API_Commands::TV,
                                DENON_API_Commands::SAT_CBL,
                                DENON_API_Commands::SAT,
                                DENON_API_Commands::VCR,
                                DENON_API_Commands::DVR,
                                DENON_API_Commands::GAME,
                                DENON_API_Commands::GAME2,
                                DENON_API_Commands::AUX1,
                                DENON_API_Commands::NETUSB,
                                DENON_API_Commands::VAUX,
                                DENON_API_Commands::DOCK,
                                DENON_API_Commands::IPOD,
                                DENON_API_Commands::NETUSB,
                                DENON_API_Commands::NET,
                                DENON_API_Commands::LASTFM,
                                DENON_API_Commands::FLICKR,
                                DENON_API_Commands::FAVORITES,
                                DENON_API_Commands::IRADIO,
                                DENON_API_Commands::SERVER,
                                DENON_API_Commands::NAPSTER,
                                DENON_API_Commands::USB_IPOD,
                                DENON_API_Commands::SOURCE,
                                ];

    static public $SI_DefaultAssociations =  [
                                [0, "Phono", DENON_API_Commands::PHONO],
                                [1, "CD", DENON_API_Commands::CD],
                                [2, "Tuner", DENON_API_Commands::TUNER],
                                [3, "DVD", DENON_API_Commands::DVD],
                                [4, "BD", DENON_API_Commands::BD],
                                [5, "TV", DENON_API_Commands::TV],
                                [6, "Sat/CBL", DENON_API_Commands::SAT_CBL],
                                [7, "Sat", DENON_API_Commands::SAT],
                                [8, "VCR", DENON_API_Commands::VCR],
                                [9, "DVR", DENON_API_Commands::DVR],
                                [10, "Game",DENON_API_Commands::GAME],
                                [11, "Game2",DENON_API_Commands::GAME2],
                                [12, "V.Aux", DENON_API_Commands::VAUX],
                                [13, "Aux1", DENON_API_Commands::AUX1],
                                [14, "Aux2", DENON_API_Commands::AUX2],
                                [15, "Dock", DENON_API_Commands::DOCK],
                                [16, "IPod", DENON_API_Commands::IPOD],
                                [17, "Net/USB", DENON_API_Commands::NETUSB],
                                [18, "Napster", DENON_API_Commands::NAPSTER],
                                [19, "LastFM", DENON_API_Commands::LASTFM],
                                [20, "Flickr", DENON_API_Commands::FLICKR],
                                [21, "Favorites", DENON_API_Commands::FAVORITES],
                                [22, "IRadio", DENON_API_Commands::IRADIO],
                                [23, "Server", DENON_API_Commands::SERVER],
                                ];

    //ZM Mainzone
	const ZMOFF = "OFF"; // Power Off
	const ZMON = "ON"; // Power On
	
	//SD
	const SDAUTO = "AUTO"; // Auto Mode
	const SDHDMI = "HDMI"; // HDMI Mode
	const SDDIGITAL = "DIGITAL"; // Digital Mode
	const SDANALOG = "ANALOG"; // Analog Mode
    const SDEXTIN = "EXT.IN"; // Ext.In Mode
    const SD71IN = "7.1IN"; // 7.1 In Mode
	const SDNO = "NO"; // no Input
	
	//DC Digital Input
	const DCAUTO = "AUTO"; // Auto Mode
	const DCPCM = "PCM"; // PCM Mode
	const DCDTS = "DTS"; // DTS Mode
	
	//MS Surround Mode
	const MSDIRECT = "DIRECT"; // Direct Mode
	const MSPUREDIRECT = "PURE DIRECT"; // Pure Direct Mode
	const MSSTEREO = "STEREO"; // Stereo Mode
	const MSSTANDARD = "STANDARD"; // Standard Mode
	const MSDOLBYDIGITAL = "DOLBY DIGITAL"; // Dolby Digital Mode
	const MSDTSSURROUND = "DTS SURROUND"; // DTS Suround Mode
    const MSMCHSTEREO = "MCH STEREO"; // Multi Channel Stereo Mode
    const MS7CHSTEREO = "7CH STEREO"; // 7 Channel Stereo Mode
	const MSWIDESCREEN = "WIDE SCREEN"; // Wide Screen Mode
	const MSSUPERSTADIUM = "SUPER STADIUM"; // Super Stadium Mode
	const MSROCKARENA = "ROCK ARENA"; // Rock Arena Mode
	const MSJAZZCLUB = "JAZZ CLUB"; // Jazz Club Mode
	const MSCLASSICCONCERT = "CLASSIC CONCERT"; // Classic Concert Mode
	const MSMONOMOVIE = "MONO MOVIE"; // Mono Movie Mode
	const MSMATRIX = "MATRIX"; // Matrix Mode
	const MSVIDEOGAME = "VIDEO GAME"; // Video Game Mode
	const MSVIRTUAL = "VIRTUAL"; // Virtual Mode
	const MSMOVIE = "MOVIE"; // Movie
	const MSMUSIC = "MUSIC"; // Music
	const MSGAME = "GAME"; // Game
	const MSAUTO = "AUTO"; // Auto
	const MSNEURAL = "NEURAL"; // Neural
    const MSAURO3D = "MSAURO3D"; //Auro 3D
    const MSAURO2DSURR = "MSAURO2DSURR";//Auro 2D

    const MSLEFT = "LEFT"; // Change to previous Surround Mode
	const MSRIGHT = "RIGHT"; // Change to next Surround Mode
	//Quick Select Mode
	const MSQUICK1 = "1"; // Quick Select 1 Mode Select
	const MSQUICK2 = "2"; // Quick Select 2 Mode Select
	const MSQUICK3 = "3"; // Quick Select 3 Mode Select
	const MSQUICK4 = "4"; // Quick Select 4 Mode Select
	const MSQUICK5 = "5"; // Quick Select 5 Mode Select
	
	//MSQUICKMEMORY
	const MSQUICK1MEMORY = "1 MEMORY"; // Quick Select 1 Mode Memory
	const MSQUICK2MEMORY = "2 MEMORY"; // Quick Select 2 Mode Memory
	const MSQUICK3MEMORY = "3 MEMORY"; // Quick Select 3 Mode Memory
	const MSQUICK4MEMORY = "4 MEMORY"; // Quick Select 4 Mode Memory
	const MSQUICK5MEMORY = "5 MEMORY"; // Quick Select 5 Mode Memory
	const MSQUICKSTATE = "QUICK ?"; // QUICK ? Return MSQUICK Status

    //Smart Select Mode
    const MSSMART1 = "1"; // Smart Select 1 Mode Select
    const MSSMART2 = "2"; // Smart Select 2 Mode Select
    const MSSMART3 = "3"; // Smart Select 3 Mode Select
    const MSSMART4 = "4"; // Smart Select 4 Mode Select
    const MSSMART5 = "5"; // Smart Select 5 Mode Select

    //VS
	//VSMONI Set HDMI Monitor
	const VSMONIAUTO = "AUTO"; // 1
	const VSMONI1 = "1"; // 1
	const VSMONI2 = "2"; // 2
	
	
	//VSASP
	const ASPNRM = "NRM"; // Set Normal Mode
	const ASPFUL = "FUL"; // Set Full Mode
	const ASP = " ?"; // ASP ? Return VSASP Status
	
	//VSSC Set Resolution
	const SC48P = "48P"; // Set Resolution to 480p/576p
	const SC10I = "10I"; // Set Resolution to 1080i
	const SC72P = "72P"; // Set Resolution to 720p
	const SC10P = "10P"; // Set Resolution to 1080p
	const SC10P24 = "10P24"; // Set Resolution to 1080p:24Hz
	const SC4K = "4K"; // Set Resolution to 4K
	const SC4KF = "4KF"; // Set Resolution to 4K (60/50)
	const SCAUTO = "AUTO"; // Set Resolution to Auto
	const SC = " ?"; // SC ? Return VSSC Status
	
	//VSSCH Set Resolution HDMI
	const SCH48P = "48P"; // Set Resolution to 480p/576p HDMI
	const SCH10I = "10I"; // Set Resolution to 1080i HDMI
	const SCH72P = "72P"; // Set Resolution to 720p HDMI
	const SCH10P = "10P"; // Set Resolution to 1080p HDMI
	const SCH10P24 = "10P24"; // Set Resolution to 1080p:24Hz HDMI
	const SCH4K = "4K"; // Set Resolution to 4K
	const SCH4KF = "4KF"; // Set Resolution to 4K (60/50)
	const SCHAUTO = "AUTO"; // Set Resolution to Auto HDMI
	const SCH = " ?"; // SCH ? Return VSSCH Status(HDMI)
	
	//VSAUDIO Set HDMI Audio Output
	const AUDIOAMP = " AMP"; // Set HDMI Audio Output to AMP
	const AUDIOTV = " TV"; // Set HDMI Audio Output to TV
	const AUDIO = " ?"; // AUDIO ? Return VSAUDIO Status
	
	//VSVPM Set Video Processing Mode
	const VPMAUTO = "AUTO"; // Set Video Processing Mode to Auto
	const VPGAME = "GAME"; // Set Video Processing Mode to Game
	const VPMOVI = "MOVI"; // Set Video Processing Mode to Movie
	const VPM = " ?"; // VPM ? Return VSVPM Status
	
	//VSVST Set Vertical Stretch
	const VSTON = " ON"; // Set Vertical Stretch On
	const VSTOFF = " OFF"; // Set Vertical Stretch Off 
	const VST = " ?"; // VST ? Return VSVST Status
	
	//PS Parameter
	//PSTONE Tone Control
	const TONECTRL = "PSTONE CTRL"; // Tone Control On
	const PSTONECTRLON = " ON"; // Tone Control On
	const PSTONECTRLOFF = " OFF"; // Tone Control Off
	const PSTONECTRLSTATE = " ?"; // TONE CTRL ? Return PSTONE CONTROL Status
	
	//PSSB Surround Back SP Mode
	const SBMTRXON = ":MTRX ON"; // Surround Back SP Mode Matrix
	const SBPL2XCINEMA = ":PL2X CINEMA"; // Surround Back SP Mode	PL2X Cinema
	const SBPL2XMUSIC = ":PL2X MUSIC"; // Surround Back SP Mode	PL2X Music
	const SBON = ":ON"; // Surround Back SP Mode on
	const SBOFF = ":OFF"; // Surround Back SP Mode off

    //PSCINEMAEQ Cinema EQ
    const CINEMAEQCOMMAND = "PSCINEMA EQ"; // Cinema EQ
    const CINEMAEQON = ".ON"; // Cinema EQ on
    const CINEMAEQOFF = ".OFF"; // Cinema EQ off
    const CINEMAEQ = ". ?"; // Return PSCINEMA EQ.Status

    //PSHTEQ HT EQ
    const HTEQCOMMAND = "PSHTEQ"; // HT EQ
    const HTEQON = " ON"; // HT EQ on
    const HTEQOFF = " OFF"; // HT EQ off
    const HTEQ = " ?"; // Return HT EQ.Status


    //PSMODE Mode Music
	const MODEMUSIC = ":MUSIC"; // Mode Music CINEMA / MUSIC / GAME / PL mode change
	const MODECINEMA = ":CINEMA"; // This parameter can change DOLBY PL2,PL2x,NEO:6 mode.
	const MODEGAME = ":GAME"; // SB=ON：PL2x mode / SB=OFF：PL2 mode GAME can change DOLBY PL2 & PL2x mode PSMODE:PRO LOGIC
	const MODEPROLOGIC = ":PRO LOGIC"; // PL can change ONLY DOLBY PL2 mode
	const MODESTATE = ": ?"; // Return PSMODE: Status
	
	//PSDOLVOL Dolby Volume direct change
	const DOLVOLON = " ON"; // Dolby Volume direct change on
	const DOLVOLOFF = " OFF"; // Dolby Volume direct change off
	const DOLVOL = ": ?"; // Return PSDOLVOL Status
	
	//PSVOLLEV Dolby Volume Leveler direct change
	const VOLLEVLOW = " LOW"; // Dolby Volume Leveler direct change Low
	const VOLLEVMID = " MID"; // Dolby Volume Leveler direct change Middle
	const VOLLEVHI = " HI"; // Dolby Volume Leveler direct change High
	const VOLLEV = ": ?"; // Return PSVOLLEV Status
	
	// PSVOLMOD Dolby Volume Modeler direct change
	const VOLMODHLF = " HLF"; // Dolby Volume Modeler direct change half
	const VOLMODFUL = " FUL"; // Dolby Volume Modeler direct change full
	const VOLMODOFF = " OFF"; // Dolby Volume Modeler direct change off
	const VOLMOD = ": ?"; // Return PSVOLMOD Status

	//PSFH Front Height
	const PSFHON = ":ON"; // FRONT HEIGHT ON
	const PSFHOFF = ":OFF"; // FRONT HEIGHT OFF
	const PSFHSTATE = ": ?"; // Return PSFH: Status
	
	//PSPHG PL2z Height Gain direct change
	const PHGLOW = " LOW"; // PL2z HEIGHT GAIN direct change low
	const PHGMID = " MID"; // PL2z HEIGHT GAIN direct change middle
	const PHGHI = " HI"; // PL2z HEIGHT GAIN direct change high
	const PHGSTATE = " ?"; // Return PSPHG Status
	
	//PSSP Speaker Output set
	const SPFH = ":FH"; // Speaker Output set FH
    const SPFW = ":FW"; // Speaker Output set FW
    const SPSB = ":SB"; // Speaker Output set SB
    const SPHW = ":HW"; // Speaker Output set HW
    const SPBH = ":BH"; // Speaker Output set BH
    const SPBW = ":BW"; // Speaker Output set BW
    const SPFL = ":FL"; // Speaker Output set FL
    const SPHF = ":HF"; // Speaker Output set HF
    const SPFR = ":FR"; // Speaker Output set FR
    const SPOFF = ":OFF"; // Speaker Output set off
	const SPSTATE = " ?"; // Return PSSP: Status

	// MulEQ XT 32 mode direct change
	const MULTEQAUDYSSEY = ":AUDYSSEY"; // MultEQ XT 32 mode direct change MULTEQ:AUDYSSEY
	const MULTEQBYPLR = ":BYP.LR"; // MultEQ XT 32 mode direct change MULTEQ:BYP.LR
	const MULTEQFLAT = ":FLAT"; // MultEQ XT 32 mode direct change MULTEQ:FLAT
	const MULTEQMANUAL = ":MANUAL"; // MultEQ XT 32 mode direct change MULTEQ:MANUAL
	const MULTEQOFF = ":OFF"; // MultEQ XT 32 mode direct change MULTEQ:OFF
	const MULTEQ = ": ?"; // Return PSMULTEQ: Status

    //PSDYNEQ Dynamic EQ
    const DYNEQON = " ON"; // Dynamic EQ = ON
    const DYNEQOFF = " OFF"; // Dynamic EQ = OFF
    const DYNEQ = " ?"; // Return PSDYNEQ Status

    //PSLFC Audyssey LFC
    const LFCON = " ON"; // Audyssey LFC = ON
    const LFCOFF = " OFF"; // Audyssey LFC = OFF
    const LFC = " ?"; // Return Audyssey LFC Status

    //PSGEQ Graphic EQ
    const GEQON = " ON"; // Graphic EQ = ON
    const GEQOFF = " OFF"; // Graphic EQ = OFF
    const GEQ = " ?"; // Return Graphic EQ Status


    //PSREFLEV Reference Level Offset
	const REFLEV0 = " 0"; // Reference Level Offset=0dB
	const REFLEV5 = " 5"; // Reference Level Offset=5dB
	const REFLEV10 = " 10"; // Reference Level Offset=10dB
	const REFLEV15 = " 15"; // Reference Level Offset=15dB
	const REFLEV = " ?"; // Return PSREFLEV Status
	
	//PSDYNVOL (old version)
	const DYNVOLNGT = " NGT"; // Dynamic Volume = Midnight
	const DYNVOLEVE = " EVE"; // Dynamic Volume = Evening
	const DYNVOLDAY = " DAY"; // Dynamic Volume = Day
	const DYNVOL = " ?"; // Return PSDYNVOL Status
	//PSDYNVOL
	const DYNVOLHEV = " HEV"; // Dynamic Volume = Heavy
	const DYNVOLMED = " MED"; // Dynamic Volume = Medium
	const DYNVOLLIT = " LIT"; // Dynamic Volume = Light
	const DYNVOLOFF = " OFF"; // Dynamic Volume = Off

	
	//PSDSX Audyssey DSX ON
	const PSDSXONHW = " ONHW"; // Audyssey DSX ON(Height/Wide)
	const PSDSXONH = " ONH"; // Audyssey DSX ON(Height)
	const PSDSXONW = " ONW"; // Audyssey DSX ON(Wide)
	const PSDSXOFF = " OFF"; // Audyssey DSX OFF
	const PSDSXSTATUS = " ?"; // Return PSDSX Status
	
	//PSSTW Stage Width
	const STWUP = " UP"; // STAGE WIDTH UP
	const STWDOWN = " DOWN"; // STAGE WIDTH DOWN
	const STW = " "; // STAGE WIDTH ** ---AVR-4311 can be operated from -10 to +10
	
	//PSSTH Stage Height
	const STHUP = " UP"; // STAGE HEIGHT UP
	const STHDOWN = " DOWN"; // STAGE HEIGHT DOWN
	const STH = " "; // STAGE HEIGHT ** ---AVR-4311 can be operated from -10 to +10
	
	//PSBAS Bass
	const BASUP = " UP"; // BASS UP
	const BASDOWN = " DOWN"; // BASS DOWN
	const BAS = " "; // BASS ** ---AVR-4311 can be operated from -6 to +6
	
	//PSTRE Treble
	const TREUP = " UP"; // TREBLE UP
	const TREDOWN = " DOWN"; // TREBLE DOWN
	const TRE = " "; // TREBLE ** ---AVR-4311 can be operated from -6 to +6

    //PSDRC DRC direct change
    const DRCAUTO = " AUTO"; // DRC direct change
    const DRCLOW = " LOW"; // DRC Low
    const DRCMID = " MID"; // DRC Middle
    const DRCHI = " HI"; // DRC High
    const DRCOFF = " OFF"; // DRC off
    const DRC = " ?"; // Return PSDRC Status

    //PSMDAX MDAX direct change
    const MDAXLOW = " LOW"; // DRC Low
    const MDAXMID = " MID"; // DRC Middle
    const MDAXHI = " HI"; // DRC High
    const MDAXOFF = " OFF"; // DRC off
    const MDAX = " ?"; // Return PSDRC Status



    //PSDCO D.Comp direct change
	const DCOOFF = " OFF"; // D.COMP direct change
	const DCOLOW = " LOW"; // D.COMP Low
	const DCOMID = " MID"; // D.COMP Middle
	const DCOHIGH = " HIGH"; // D.COMP High
	const DCO = " ?"; // Return PSDCO Status

	//PSLFE LFE	
	const LFEDOWN = " DOWN"; // LFE DOWN
	const LFEUP = " UP"; // LFE UP
	const LFE = " "; // LFE ** ---AVR-4311 can be operated from 0 to -10


	//PSEFF Effect direct change
	const PSEFFON = " ON"; // EFFECT ON direct change
	const PSEFFOFF = " OFF"; // EFFECT OFF direct change
	
	const PSEFFUP = " UP"; // EFFECT UP direct change
	const PSEFFDOWN = " DOWN"; // EFFECT DOWN direct change
	const PSEFFSTATUS = " ?"; // EFFECT ** ---AVR-4311 can be operated from 1 to 15


	//PSDELAY Delay
	const PSDELAYUP = " UP"; // DELAY UP
	const PSDELAYDOWN = " DOWN"; // DELAY DOWN
	const PSDELAYVAL = " "; // DELAY ** ---AVR-4311 can be operated from 0 to 300

	//PSAFD Auto Flag Detection Mode
	const AFDON = " ON"; // AFDM ON
	const AFDOFF = " OFF"; // AFDM OFF
	const AFD = " "; // Return PSAFD Status


	//PSPAN Panorama
	const PANON = " ON"; // PANORAMA ON
	const PANOFF = " OFF"; // PANORAMA OFF
	const PAN = " ?"; // Return PSPAN Status


	//PSDIM Dimension
	const PSDIMUP = " UP"; // DIMENSION UP
	const PSDIMDOWN = " DOWN"; // DIMENSION DOWN
	const PSDIMSET = " "; // ---AVR-4311 can be operated from 0 to 6


	//PSCEN Center Width
	const CENUP = "CEN UP"; // CENTER WIDTH UP
	const CENDOWN = "CEN DOWN"; // CENTER WIDTH DOWN
	const CEN = "CEN "; // ---AVR-4311 can be operated from 0 to 7

	//PSCEI Center Image
	const CEIUP = "CEI UP"; // CENTER IMAGE UP
	const CEIDOWN = "CEI DOWN"; // CENTER IMAGE DOWN
	const CEI = "CEI "; // ---AVR-4311 can be operated from 0 to 7
	
	
	//PSRSZ Room Size
    const RSZN = " N";
    const RSZS = " S";
	const RSZMS = " MS";
	const RSZM = " M";
	const RSZML = " ML";
	const RSZL = " L";
	
	
	//PSSW ATT
	const ATTON = "ATT ON"; // SW ATT ON
	const ATTOFF = "ATT OFF"; // SW ATT OFF
	const ATT = "ATT ?"; // Return PSATT Status

    //PSSWR
    const PSSWRON = " ON"; // SW ATT ON
    const PSSWROFF = " OFF"; // SW ATT OFF
    const SWR = " ?"; // Return PSATT Status

    //PSLOM
    const PSLOMON = " ON"; // SW ATT ON
    const PSLOMOFF = " OFF"; // SW ATT OFF
    const LOM = " ?"; // Return PSATT Status

    //Audio Restorer
	const PSRSTROFF = " OFF"; //Audio Restorer Off
	const PSRSTRMODE1 = " MODE1"; //Audio Restorer 64
	const PSRSTRMODE2 = " MODE2"; //Audio Restorer 96
	const PSRSTRMODE3 = " MODE3"; //Audio Restorer HQ
	
    //Front Speaker
    const PSFRONTSPA = " SPA"; //Speaker A
    const PSFRONTSPB = " SPB"; //Speaker B
    const PSFRONTSPAB = " SPA+B"; //Speaker A+B

	//Cursor
	const MNCUP = "CUP"; // Cursor Up
	const MNCDN = "CDN"; // Cursor Down
	const MNCRT = "CRT"; // Cursor Right
	const MNCLT = "CLT"; // Cursor Left
	const MNENT = "ENT"; // Cursor Enter
	const MNRTN = "RTN"; // Cursor Return
	
	//GUI Menu
	const MNMEN = "MNMEN"; // GUI Menu
	const MNMENON = " ON"; // GUI Menu On
	const MNMENOFF = " OFF"; // GUI Menu Off
	
	//GUI Source Select Menu
	const MNSRC = "MNSRC"; // GUI Menu
	const MNSRCON = " ON"; // GUI Menu On
	const MNSRCOFF = " OFF"; // GUI Menu Off
	
	// Surround Modes Response	


	// Surround Modes Varmapping
	
	//Dolby Digital
	const DOLBYPROLOGIC = "DOLBY PRO LOGIC"; // DOLBY PRO LOGIC
	const DOLBYPL2C = "DOLBY PL2 C"; // DOLBY PL2 C
	const DOLBYPL2M = "DOLBY PL2 M"; // DOLBY PL2 M
	const DOLBYPL2G = "DOLBY PL2 G"; // DOLBY PL2 G
	const DOLBYPL2XC = "DOLBY PL2X C"; // DOLBY PL2X C
	const DOLBYPL2XM = "DOLBY PL2X M"; // DOLBY PL2X M
	const DOLBYPL2XG = "DOLBY PL2X G"; // DOLBY PL2X G
	const DOLBYPL2ZH = "DOLBY PL2Z H"; // DOLBY PL2Z H
	const DOLBYPL2XH = "DOLBY PL2X H"; // DOLBY PL2X H
	const DOLBYDEX = "DOLBY D EX"; // DOLBY D EX
	const DOLBYDPL2XC = "DOLBY D+PL2X C"; // DOLBY D+PL2X C
	const DOLBYDPL2XM = "DOLBY D+PL2X M"; // DOLBY D+PL2X M
	const DOLBYDPL2XH = "DOLBY D+PL2X H"; // DOLBY D+PL2X H
	const PLDSX = "PL DSX"; // PL DSX
	const PL2CDSX = "PL2 C DSX"; // PL2 C DSX
	const PL2MDSX = "PL2 M DSX"; // PL2 M DSX
	const PL2GDSX = "PL2 G DSX"; // PL2 G DSX
	const PL2XCDSX = "PL2X C DSX"; // PL2X C DSX
	const PL2XMDSX = "PL2X M DSX"; // PL2X M DSX
	const PL2XGDSX = "PL2X G DSX"; // PL2X G DSX
	const DOLBYDPLUSPL2XC = "DOLBY D+ +PL2X C"; // DOLBY D+ +PL2X C
	const DOLBYDPLUSPL2XM = "DOLBY D+ +PL2X M"; // DOLBY D+ +PL2X M
	const DOLBYDPLUSPL2XH = "DOLBY D+ +PL2X H"; // DOLBY D+ +PL2X H
	const DOLBYHDPL2XC = "DOLBY HD+PL2X C"; // DOLBY HD+PL2X C
	const DOLBYHDPL2XM = "DOLBY HD+PL2X M"; // DOLBY HD+PL2X M
	const DOLBYHDPL2XH = "DOLBY HD+PL2X H"; // DOLBY HD+PL2X H
	const MULTICNIN = "MULTI CH IN"; // MULTI CH IN
	const MCHINPL2XC = "M CH IN+PL2X C"; // M CH IN+PL2X C
	const MCHINPL2XM = "M CH IN+PL2X M"; // M CH IN+PL2X M
	const MCHINPL2XH = "M CH IN+PL2X H"; // M CH IN+PL2X H
    const MCHINNEURALX = "M CH IN+NEURAL:X"; // M CH IN+NEURAL:X

    const DOLBYDPLUS = "DOLBY D+"; // DOLBY D+
	const DOLBYDPLUSEX = "DOLBY D+ +EX"; // DOLBY D+ +EX
	const DOLBYTRUEHD = "DOLBY TRUEHD"; // DOLBY TRUEHD
	const DOLBYHD = "DOLBY HD"; // DOLBY HD
	const DOLBYHDEX = "DOLBY HD+EX"; // DOLBY HD+EX
	const DOLBYPL2H = "DOLBY PL2 H"; // MSDOLBY PL2 H
	
	const DOLBYSURROUND = "DOLBY SURROUND"; // MSDOLBY SURROUND
	const DOLBYATMOS = "DOLBY ATMOS"; // MSDOLBY ATMOS
	const DOLBYDIGITAL= "DOLBY DIGITAL"; // MSDOLBY DIGITAL
	const DOLBYDDS = "DOLBY D+DS"; // MSDOLBY D+DS
	const MPEG2AAC = "MPEG2 AAC"; // MSMPEG2 AAC
	const AACDOLBYEX = "AAC+DOLBY EX"; // MSAAC+DOLBY EX
	const AACPL2XC = "AAC+PL2X C"; // MSAAC+PL2X C
	const AACPL2XM = "AAC+PL2X M"; // MSAAC+PL2X M
	const AACPL2XH = "AAC+PL2X H"; // MSAAC+PL2X H
	const AACDS = "AAC+DS"; // MSAAC+DS
	const AACNEOXC = "AAC+NEO:X C"; // MSAAC+NEO:X C
	const AACNEOXM = "AAC+NEO:X M"; // MSAAC+NEO:X M
	const AACNEOXG = "AAC+NEO:X G"; // MSAAC+NEO:X G
	
	//DTS Surround
	const DTSNEO6C = "DTS NEO:6 C"; // DTS NEO:6 C
	const DTSNEO6M = "DTS NEO:6 M"; // DTS NEO:6 M
	const DTSNEOXC = "DTS NEO:X C"; // DTS NEO:X C
	const DTSNEOXM = "DTS NEO:X M"; // DTS NEO:X M
    const DTSNEOXG = "DTS NEO:X G"; // DTS NEO:X G
    const NEURALX = "NEURAL:X"; // NEURAL:X
	const DTSESDSCRT61 = "DTS ES DSCRT6.1"; // DTS ES DSCRT6.1
	const DTSESMTRX61 = "DTS ES MTRX6.1"; // DTS ES MTRX6.1
	const DTSPL2XC = "DTS+PL2X C"; // DTS+PL2X C
	const DTSPL2XM = "DTS+PL2X M"; // DTS+PL2X M	
	const DTSPL2ZH = "DTS+PL2Z H"; // DTS+PL2Z H
	const DTSPLUSNEO6 = "DTS+NEO:6"; // DTS+NEO:6
	const DTSPLUSNEOXC = "DTS+NEO:X C"; // DTS PLUS NEO:X C
	const DTSPLUSNEOXM = "DTS+NEO:X M"; // DTS PLUS NEO:X M
	const DTSPLUSNEOXG = "DTS+NEO:X G"; // DTS PLUS NEO:X G	
    const DTSPLUSNEURALX = "DTS+NEURAL:X"; // DTS+NEURAL:X
	const DTS9624 = "DTS96/24"; // DTS96/24
	const DTS96ESMTRX = "DTS96 ES MTRX"; // DTS96 ES MTRX
	const DTSHDPL2XC = "DTS HD+PL2X C"; // DTS HD+PL2X C
	const DTSHDPL2XM = "DTS HD+PL2X M"; // DTS HD+PL2X M
	const DTSHDPL2XH = "DTS HD+PL2X H"; // DTS HD+PL2X H
	const NEO6CDSX = "NEO:6 C DSX"; // NEO:6 C DSX
	const NEO6MDSX = "NEO:6 M DSX"; // NEO:6 M DSX
	const DTSHD = "DTS HD"; // DTS HD 
	const DTSHDMSTR = "DTS HD MSTR"; // DTS HD MSTR
	const DTSHDNEO6 = "DTS HD+NEO:6"; // DTS HD+NEO:6
	const DTSES8CHDSCRT = "DTS ES 8CH DSCRT"; // DTS ES 8CH DSCRT
	const DTSEXPRESS = "DTS EXPRESS"; // DTS EXPRESS
	const DTSDS = "DTS+DS"; // MSDTS+DS
	const DOLBYDNEOXC = "DOLBY D+NEO:X C"; // MSDOLBY D+NEO:X C
	const DOLBYDNEOXM = "DOLBY D+NEO:X M"; // MSDOLBY D+NEO:X M
    const DOLBYDNEOXG = "DOLBY D+NEO:X G"; // MSDOLBY D+NEO:X G
    const DOLBYDNEURALX= "DOLBY D+NEURAL:X"; // MSDOLBY D+NEURAL:X
	const MCHINDS = "M CH IN+DS"; // MSM CH IN+DS
	const MCHINNEOXC = "M CH IN+NEO:X C"; // MSM CH IN+NEO:X C
	const MCHINNEOXM = "M CH IN+NEO:X M"; // MSM CH IN+NEO:X M
	const MCHINNEOXG = "M CH IN+NEO:X G"; // MSM CH IN+NEO:G C
    const DOLBYDPLUSDS = "DOLBY D+ +DS"; // MSDOLBY D+ +DS
    const DOLBYDPLUSNEOXC = "DOLBY D+ +NEO:X C"; // MSDOLBY D+ +NEO:X C
	const DOLBYDPLUSNEOXM = "DOLBY D+ +NEO:X M"; // MSDOLBY D+ +NEO:X M
    const DOLBYDPLUSNEOXG = "DOLBY D+ +NEO:X G"; // MSDOLBY D+ +NEO:X G
    const DOLBYDPLUSNEURALX = "DOLBY D+ +NEURAL:X"; // MSDOLBY D+ +NEURAL:X
	const DOLBYHDDS = "DOLBY HD+DS"; // MSDOLBY HD+DS
	const DOLBYHDNEOXC = "DOLBY HD+NEO:X C"; // MSDOLBY HD+NEO:X C
	const DOLBYHDNEOXM = "DOLBY HD+NEO:X M"; // MSDOLBY HD+NEO:X M
	const DOLBYHDNEOXG = "DOLBY HD+NEO:X G"; // MSDOLBY HD+NEO:X G
	const DTSHDDS = "DTS HD+DS"; // MSDTS HD+DS
	const DTSHDNEOXC = "DTS HD+NEO:X C"; // MSDTS HD+NEO:X C
	const DTSHDNEOXM = "DTS HD+NEO:X M"; // MSDTS HD+NEO:X M
	const DTSHDNEOXG = "DTS HD+NEO:X G"; // MSDTS HD+NEO:X G

    const DSDDIRECT = "DSD DIRECT"; // DSD DIRECT
    const DSDPUREDIRECT = "DSD PURE DIRECT"; // DSD PURE DIRECT

	const MCHINDOLBYEX = "M CH IN+DOLBY EX"; // M CH IN+DOLBY EX
	const MULTICHIN71 = "MULTI CH IN 7.1"; // MULTI CH IN 7.1

	const AUDYSSEYDSX = "AUDYSSEY DSX"; // AUDYSSEY DSX
	
	
	const SURROUNDDISPLAY = "SurroundDisplay"; // Nur DisplayIdent
	
	// All Zone Stereo
    const MNZST = "MNZST";
    const MNZSTON = " ON";
	const MNZSTOFF = " OFF";
	
	const PSGRAPHICEQ = "PSGEQ"; // Graphic EQ
	const PSGRAPHICEQON = " ON"; // Graphic EQ On
	const PSGRAPHICEQOFF = " OFF"; // Graphic EQ Off

    const PSSWL = "PSSWL"; // Subwoofer Level
    const PSSWL2 = "PSSWL2"; // Subwoofer2 Level
    const PSSWLON = " ON"; // Subwoofer Level On
    const PSSWLOFF = " OFF"; // Subwoofer Level Off

    const PSDIL = "PSDIL"; // Dialog Level Adjust
    const PSDILON = " ON"; // Dialog Level Adjust On
    const PSDILOFF = " OFF"; // Dialog Level Adjust Off


    const STBY = "STBY"; // Mainzone Auto Standby
	const STBY15M = "15M"; // Mainzone Auto Standby 15 Minuten
	const STBY30M = "30M"; // Mainzone Auto Standby 30 Minuten
	const STBY60M = "60M"; // Mainzone Auto Standby 60 Minuten
	const STBYOFF = "OFF"; // Mainzone Auto Standby Off
	const Z2STBY = "Z2STBY"; // Zone 2 Auto Standby
	const Z2STBY2H = "2H"; // Zone 2 Auto Standby 2h
	const Z2STBY4H = "4H"; // Zone 2 Auto Standby 4h
	const Z2STBY8H = "8H"; // Zone 2 Auto Standby 8h
	const Z2STBYOFF = "OFF"; // Zone 2 Auto Standby Off
	const Z3STBY = "Z3STBY"; // Zone 3 Auto Standby
	const Z3STBY2H = "2H"; // Zone 3 Auto Standby 2H
	const Z3STBY4H = "4H"; // Zone 3 Auto Standby 4h
	const Z3STBY8H = "8H"; // Zone 3 Auto Standby 8h
	const Z3STBYOFF = "OFF"; // Zone 3 Auto Standby Off
	const ECO = "ECO"; // ECO Mode
	const ECOON = "ON"; // ECO Mode On
	const ECOAUTO = "AUTO"; // ECO Mode Auto
	const ECOOFF = "OFF"; // ECO Mode Off
	const DIM = "DIM"; // Dimmer
	const DIMBRI = " BRI"; // Bright
	const DIMDIM = " DIM"; // DIM
	const DIMDAR = " DAR"; // Dark
	const DIMOFF = " OFF"; // Dimmer off

    const PSCES = "PSCES"; // Center Spread
    const PSCESON = " ON"; // Center Spread On
    const PSCESOFF = " OFF"; // Center Spread Off

    const PSNEURAL= "PSNEURAL"; // Center Spread
    const PSNEURALON = " ON"; // Center Spread On
    const PSNEURALOFF= " OFF"; // Center Spread Off

    const PSBSC = "PSBSC"; // Bass Sync

    const PSDEH = "PSDEH"; // Dialog Enhancer
    const PSDEHOFF = " OFF"; // Dialog Enhancer Off
    const PSDEHMED = " MED"; // Dialog Enhancer Medium
    const PSDEHLOW = " LOW"; // Dialog Enhancer Low
    const PSDEHHIGH = " HIGH"; // Dialog Enhancer High

    const PSAUROST = "PSAUROST"; // Auro Matic 3D Strength
	const PSAUROSTUP = " UP"; // Auro Matic 3D Strength Up
	const PSAUROSTDOWN = " DOWN"; // Auro Matic 3D Strength Down
	
	const PSAUROPR = "PSAUROPR"; // Auro Matic 3D Present
	const PSAUROPRSMA = " SMA"; // Auro Matic 3D Present Small
	const PSAUROPRMED = " MED"; // Auro Matic 3D Present Medium
	const PSAUROPRLAR = " LAR"; // Auro Matic 3D Present Large
	const PSAUROPRSPE = " SPE"; // Auro Matic 3D Present SPE
	
	const CVSHL = "CVSHL"; // Surround Height Left
	const CVSHR = "CVSHR"; // Surround Height Right
    const CVTS = "CVTS"; // Top Surround
    const CVZRL = "CVZRL"; // Reset Channel Volume Status

	const CVTFL = "CVTFL"; // Top Front Left
	const CVTFR = "CVTFR"; // Top Front Right
	const CVTML = "CVTML"; // Top Middle Left
	const CVTMR = "CVTMR"; // Top Middle Right
	const CVTRL = "CVTRL"; // Top Rear Left
	const CVTRR = "CVTRR"; // Top Rear Right
	const CVRHL = "CVRHL"; // Rear Height Left
	const CVRHR = "CVRHR"; // Rear Height Right
	const CVFDL = "CVFDL"; // Front Dolby Left
	const CVFDR = "CVFDR"; // Front Dolby Right
	const CVSDL = "CVSDL"; // Surround Dolby Left
	const CVSDR = "CVSDR"; // Surround Dolby Right
	const CVBDL = "CVBDL"; // Back Dolby Left
	const CVBDR = "CVBDR"; // Back Dolby Right
	
}

class DenonAVRCP_API_Data extends stdClass
{

    private $AVRType;
    private $Data;

    //Surround Display
    public static $SurroundModes = [
        //show display => response display
        DENON_API_Commands::MSDIRECT => "Direct",
        DENON_API_Commands::MSPUREDIRECT => "Pure Direct",
        DENON_API_Commands::MSSTEREO => "Stereo",
        DENON_API_Commands::MSDOLBYDIGITAL => "Dolby Digital",
        DENON_API_Commands::MSDTSSURROUND    => "DTS Surround",
        DENON_API_Commands::MSAURO3D => "Auro 3D",
        DENON_API_Commands::MSAURO2DSURR => "Auro 2D Surround",
        DENON_API_Commands::MSMCHSTEREO => "Multi Channel Stereo",
        DENON_API_Commands::MS7CHSTEREO => "7 Channel Stereo",
        DENON_API_Commands::MSWIDESCREEN => "Wide Screen",
        DENON_API_Commands::MSROCKARENA => "Rock Arena",
        DENON_API_Commands::MSSUPERSTADIUM => "Super Stadion",
        DENON_API_Commands::MSJAZZCLUB => "Jazz Club",
        DENON_API_Commands::MSCLASSICCONCERT => "Klassikkonzert",
        DENON_API_Commands::MSMONOMOVIE => "Mono Movie",
        DENON_API_Commands::MSMATRIX => "Matrix",
        DENON_API_Commands::MSVIDEOGAME => "Video Game",
        DENON_API_Commands::MSVIRTUAL => "Virtual",
    ];

    public static $DolbySurroundModes = [
        //show display => response display
        DENON_API_Commands::DOLBYPROLOGIC => "Dolby Pro Logic",
        DENON_API_Commands::DOLBYPL2C => "Dolby Pro Logic II Cinema",
        DENON_API_Commands::DOLBYPL2M => "Dolby Pro Logic II Music",
        DENON_API_Commands::DOLBYPL2H => "Dolby Pro Logic II Height",
        DENON_API_Commands::DOLBYPL2G => "Dolby Pro Logic II Game",
        DENON_API_Commands::DOLBYPL2XC => "Dolby Pro Logic IIx Cinema",
        DENON_API_Commands::DOLBYPL2XM => "Dolby Pro Logic IIx Music",
        DENON_API_Commands::DOLBYPL2XH => "Dolby Pro Logic IIx Height",
        DENON_API_Commands::DOLBYPL2XG => "Dolby Pro Logic IIx Game",
        DENON_API_Commands::DOLBYPL2ZH => "Dolby Pro Logic IIz Height",
        DENON_API_Commands::DOLBYSURROUND   => "Dolby Surround",
        DENON_API_Commands::DOLBYATMOS      => "Dolby Atmos",
        DENON_API_Commands::DOLBYDEX        => "Dolby Digital Ex",
        DENON_API_Commands::DOLBYDDS        => "Dolby Digital + DS",
        DENON_API_Commands::DOLBYDNEOXC     => "Dolby Digital + NEO:X Cinema",
        DENON_API_Commands::DOLBYDNEOXM     => "Dolby Digital + NEO:X Music",
        DENON_API_Commands::DOLBYDNEOXG     => "Dolby Digital + NEO:X Game",
        DENON_API_Commands::DOLBYDNEURALX   => "Dolby Digital + Neural:X",
        DENON_API_Commands::DOLBYDPLUSDS    => "Dolby Digital Plus + Dolby Surround",
        DENON_API_Commands::DOLBYDPLUSNEOXC => "Dolby Digital Plus + NEO:X Cinema",
        DENON_API_Commands::DOLBYDPLUSNEOXM => "Dolby Digital Plus + NEO:X Music",
        DENON_API_Commands::DOLBYDPLUSNEOXG => "Dolby Digital Plus + NEO:X Game",
        DENON_API_Commands::DOLBYDPLUSNEURALX => "Dolby Digital Plus + Neural:X",
        DENON_API_Commands::DOLBYDPLUS => "Dolby Digital Plus",
        DENON_API_Commands::DOLBYDPLUSPL2XC => "Dolby Digital Plus + Dolby Pro Logic IIx Cinema",
        DENON_API_Commands::DOLBYDPLUSPL2XM => "Dolby Digital Plus + Dolby Pro Logic IIx Music",
        DENON_API_Commands::DOLBYDPLUSPL2XH => "Dolby Digital Plus + Dolby Pro Logic IIx Height",
        DENON_API_Commands::DOLBYTRUEHD => "Dolby True HD",
        DENON_API_Commands::DOLBYHD => "Dolby HD",
        DENON_API_Commands::DOLBYHDEX => "Dolby HD + Ex",
        DENON_API_Commands::DOLBYHDPL2XC => "Dolby HD + Dolby Pro Logic IIx Cinema",
        DENON_API_Commands::DOLBYHDPL2XM => "Dolby HD + Dolby Pro Logic IIx Music",
        DENON_API_Commands::DOLBYHDPL2XH => "Dolby HD + Dolby Pro Logic IIx Height",
        DENON_API_Commands::DOLBYHDDS => "Dolby True HD + Dolby Surround",
        DENON_API_Commands::DOLBYHDNEOXC => "Dolby True HD + NEO:X Cinema",
        DENON_API_Commands::DOLBYHDNEOXM => "Dolby True HD + NEO:X Music",
        DENON_API_Commands::DOLBYHDNEOXG => "Dolby True HD + NEO:X Game",
    ];

    public static $DTSSurroundModes = [
        //show display => response display
        DENON_API_Commands::DTSESDSCRT61   => "DTS ES Discrete 6.1",
        DENON_API_Commands::DTSESMTRX61  => "DTS ES Matrix 6.1",
        DENON_API_Commands::DTSPL2XC     => "DTS + Dolby Pro Logic IIx Cinema"  ,
        DENON_API_Commands::DTSPL2XM     => "DTS + Dolby Pro Logic IIx Music",
        DENON_API_Commands::DTSPL2ZH     => "DTS + Dolby Pro Logic IIx Height",
        DENON_API_Commands::DTSDS        => "DTS + Dolby Surround",
        DENON_API_Commands::DTS9624      => "DTS 96/24",
        DENON_API_Commands::DTS96ESMTRX  => "DTS 96/24 ES Matrix",
        DENON_API_Commands::DTSPLUSNEO6    => "DTS + NEO:6",
        DENON_API_Commands::DTSPLUSNEOXC   => "DTS + NEO:X Cinema",
        DENON_API_Commands::DTSPLUSNEOXM   => "DTS + NEO:X Music",
        DENON_API_Commands::DTSPLUSNEOXG   => "DTS + NEO:X Game",
        DENON_API_Commands::DTSNEOXC       => "DTS + NEO:X Cinema",
        DENON_API_Commands::DTSNEOXM       => "DTS + NEO:X Music",
        DENON_API_Commands::DTSNEOXG       => "DTS + NEO:X Game",
        DENON_API_Commands::DTSPLUSNEURALX => "DTS + Neural:X",
        DENON_API_Commands::NEURALX        => "Neural:X",
        DENON_API_Commands::MULTICNIN      => "Multi Channel In",
        DENON_API_Commands::MULTICHIN71    => "Multi Channel In 7.1",
        DENON_API_Commands::MCHINDOLBYEX   => "Multi Channel In + Dolby Ex",
        DENON_API_Commands::MCHINPL2XC     => "Multi Channel In + Dolby Pro Logic IIx Cinema",
        DENON_API_Commands::MCHINPL2XM     => "Multi Channel In + Dolby Pro Logic IIx Music",
        DENON_API_Commands::MCHINPL2XH => "Multi Channel In + Dolby Pro Logic IIx Height",
        DENON_API_Commands::MCHINDS => "Multi Channel In + Dolby Surround",
        DENON_API_Commands::MCHINNEOXC => "Multi Channel In + NEO:X Cinema",
        DENON_API_Commands::MCHINNEOXM => "Multi Channel In + NEO:X Music",
        DENON_API_Commands::MCHINNEOXG => "Multi Channel In + NEO:X Game",
        DENON_API_Commands::DTSHD => "DTS HD",
        DENON_API_Commands::DTSHDMSTR => "DTS HD Master",
        DENON_API_Commands::DTSHDNEO6 => "DTS HD + NEO:6",
        DENON_API_Commands::DTSHDPL2XC => "DTS HD + Dolby Pro Logic IIx Cinema",
        DENON_API_Commands::DTSHDPL2XM => "DTS HD + Dolby Pro Logic IIx Music",
        DENON_API_Commands::DTSHDPL2XH => "DTS HD + Dolby Pro Logic IIx Height",
        DENON_API_Commands::DTSES8CHDSCRT => "DTS Express 8 Channel Discrect",
        DENON_API_Commands::DTSHDDS => "DTS HD + Dolby Surround",
        DENON_API_Commands::DTSEXPRESS => "DTS Express",
        DENON_API_Commands::DTSES8CHDSCRT => "DTS ES 8 CH Discrete",
        DENON_API_Commands::MPEG2AAC => "MPEG2 AAC",
        DENON_API_Commands::AACDOLBYEX => "AAC + Dolby EX",
        DENON_API_Commands::AACPL2XC => "AAC + PL2X Cinema",
        DENON_API_Commands::AACPL2XM => "AAC + PL2X Music",
        DENON_API_Commands::AACPL2XH => "AAC + PL2X Height",
        DENON_API_Commands::AACDS => "AAC + Dolby Surround",
        DENON_API_Commands::AACNEOXC => "AAC + NEO:X Cinema",
        DENON_API_Commands::AACNEOXM => "AAC + NEO:X Music",
        DENON_API_Commands::AACNEOXG => "AAC + NEO:X Game",
        DENON_API_Commands::PLDSX => "Dolby Pro Logic DSX",
        DENON_API_Commands::PL2CDSX => "Dolby Pro Logic II Cinema DSX",
        DENON_API_Commands::PL2MDSX => "Dolby Pro Logic II Music DSX",
        DENON_API_Commands::PL2GDSX => "Dolby Pro Logic II Game DSX",
        DENON_API_Commands::PL2XCDSX => "Dolby Pro Logic IIx Cinema DSX",
        DENON_API_Commands::PL2XMDSX => "Dolby Pro Logic IIx Music DSX",
        DENON_API_Commands::PL2XGDSX => "Dolby Pro Logic IIx Game DSX",
        DENON_API_Commands::AUDYSSEYDSX => "Audyssey DSX",
        DENON_API_Commands::NEO6CDSX => "NEO:6 Cinema DSX",
        DENON_API_Commands::NEO6MDSX => "NEO:6 Music DSX",
        DENON_API_Commands::DTSNEO6C => "DTS NEO:6 Cinema",
        DENON_API_Commands::DTSNEO6M => "DTS NEO:6 Music",
        DENON_API_Commands::DSDDIRECT => "DSD Direct",
        DENON_API_Commands::DSDPUREDIRECT => "DSD Pure Direct",
    ];

    public function __construct($AVRType, $Data) {
        if (is_null($AVRType)){
            trigger_error(get_class().'::'.__FUNCTION__.': AVRType ist nicht gesetzt!');
        }

        $this->AVRType = $AVRType;
        $this->Data = $Data;
    }

    private function getshowsurrounddisplay($response){

        $showsurrounddisplay = "";
        if (array_key_exists($response, static::$SurroundModes)){
            $showsurrounddisplay = static::$SurroundModes[$response];
        } elseif (array_key_exists($response, static::$DolbySurroundModes)){
            $showsurrounddisplay = static::$DolbySurroundModes[$response];
        } elseif (array_key_exists($response, static::$DTSSurroundModes)){
            $showsurrounddisplay = static::$DTSSurroundModes[$response];
        } else {
            trigger_error(get_class().'::'.__FUNCTION__.': unknown surround mode response: '.$response);
        }
        return $showsurrounddisplay;
    }

    private function getNSADisplay($data){
        $NSADisplay = [];

        foreach($data as $key => $response) {
            if (stripos($response, "NSA") !== false){ //Display auslesen
                $NSARow = substr($response, 3, 1);
                $response = str_replace("NSA".$NSARow, "", $response);
                $response = str_replace("<LF>", "", $response);
                $response = str_replace("<STX>", "", $response);
                $response = str_replace("<NUL>", "", $response);
                $response = trim($response);
                $NSADisplay[$NSARow] = $response;
            }
        }
        return $NSADisplay;
    }

    public function GetCommandResponse ($InputMapping)
	{	
		$debug = true;

        //Debug Log
        if ($debug){
            IPS_LogMessage('Denon Class::'.__FUNCTION__,'data: '.json_encode($this->Data));
		}

		// Response an besondere Idents anpassen
		$specialcommands = [DENON_API_Commands::CINEMAEQCOMMAND.".OFF" => "PSCINEMA_EQ.OFF",
							DENON_API_Commands::CINEMAEQCOMMAND.".ON" => "PSCINEMA_EQ.ON",
							DENON_API_Commands::TONECTRL." OFF" => "PSTONE_CTRL OFF",
							DENON_API_Commands::TONECTRL." ON" => "PSTONE_CTRL ON",
							DENON_API_Commands::PSEFF." ON" => "PSEFF_ON",
                            DENON_API_Commands::PSEFF." OFF" => "PSEFF_OFF",
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTOFF => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTOFF,
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTSTD => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTSTD,
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTMOV => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTMOV,
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTVVD => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTVVD,
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTSTM => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTSTM,
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTCTM => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTCTM,
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTDAY => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTDAY,
                            DENON_API_Commands::PV.DENON_API_Commands::PVPICTNGT => DENON_API_Commands::PVPICT.DENON_API_Commands::PVPICTNGT,
        ];

        // add special commands for zone responses
        for ($Zone = 2; $Zone <= 3; $Zone++){
            $specialcommands['Z'.$Zone.'ON'] = 'Z'.$Zone.'POWERON';
            $specialcommands['Z'.$Zone.'OFF'] = 'Z'.$Zone.'POWEROFF';

            // add spezialcommands for input settings
            foreach (DENON_API_Commands::$SI_InputSettings as $InputSetting){
                $specialcommands['Z'.$Zone.$InputSetting] = 'Z'.$Zone.'INPUT'.$InputSetting;
            }

            // add special commands for volume response Z2** and Z3**
            for ($Vol = 0; $Vol <= 99; $Vol++){
                $formattedVolume = str_pad($Vol, 2, '0', STR_PAD_LEFT);
                $specialcommands['Z'.$Zone.$formattedVolume] = 'Z'.$Zone.'VOL'.$formattedVolume;
            }
        }

        foreach ($this->Data as $key => $response){
            if (array_key_exists($response, $specialcommands)){
                if ($debug){
                    IPS_LogMessage(get_class().'::'.__FUNCTION__,$this->Data[$key].' replaced by '.$specialcommands[$response]);
                }
                $this->Data[$key] = $specialcommands[$response];
            }
        }



		$datavalues = [];
        $SurroundDisplay = '';

		//Response einzeln auswerten
        $VarMapping = (new DENONIPSProfiles($this->AVRType, $InputMapping))->GetVarMapping();

        if ($VarMapping === false){
            trigger_error(get_class().'::'.__FUNCTION__.': VarMapping failed');
        }


        foreach ($this->Data as $response){

            $response_found = false;
            foreach ($VarMapping as $Command => $item){ //Zuordnung suchen
                if (stripos($response, $Command) === 0){// Subcommand ermitteln
                    $ResponseSubCommand = substr($response, strlen($Command));
                    IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Command found: '.$Command.', SubCommand: '.$ResponseSubCommand);

                    switch ($Command){

                        case DENON_API_Commands::MS:
                            $SurroundDisplay = $this->getshowsurrounddisplay($ResponseSubCommand);

                            if (array_key_exists($ResponseSubCommand, static::$DolbySurroundModes)){
                                $datavalues[DENON_API_Commands::MS] = ['VarType'    => $item["VarType"],
                                                         'Value'      => $item["ValueMapping"][DENON_API_Commands::MSDOLBYDIGITAL],
                                                         'Subcommand' => DENON_API_Commands::MSDOLBYDIGITAL
                                ];
                            } elseif (array_key_exists($ResponseSubCommand, static::$DTSSurroundModes)){
                                $datavalues[DENON_API_Commands::MS] = ['VarType'    => $item["VarType"],
                                                                       'Value'      => $item["ValueMapping"][DENON_API_Commands::MSDTSSURROUND],
                                                                       'Subcommand' => DENON_API_Commands::MSDTSSURROUND
                                ];
                            } elseif (array_key_exists($ResponseSubCommand, static::$SurroundModes)){
                                $datavalues[DENON_API_Commands::MS] = ['VarType'    => $item["VarType"],
                                                                       'Value'      => $item["ValueMapping"][$ResponseSubCommand],
                                                                       'Subcommand' => $ResponseSubCommand
                                ];
                            }
                            break;

                        default:
                            if (!isset($item["ValueMapping"])){
                                IPS_LogMessage(get_class().'::'.__FUNCTION__, 'ValueMapping not set - Item: '.json_encode($item));
                                return false;
                            }
                            if (array_key_exists($ResponseSubCommand, $item["ValueMapping"])){
                                $datavalues[$Command] = ['VarType'    => $item["VarType"],
                                                         'Value'      => $item["ValueMapping"][$ResponseSubCommand],
                                                         'Subcommand' => $ResponseSubCommand
                                ];
                            } else {
                                IPS_LogMessage(get_class() . '::' . __FUNCTION__,'Warning: No value found for SubCommand "'.$ResponseSubCommand.'"');
                            }
                            break;
                    }

                    $response_found              = true;
                    break;
                }
            }
            if (!$response_found){
                IPS_LogMessage(get_class() . '::' . __FUNCTION__,'Warning: No mapping found for response "'.$response.'"');
            }

        }

        $datasend = array(
			'ResponseType' => 'TELNET',
			'Data' => $datavalues,
			'SurroundDisplay' => $SurroundDisplay,
			'NSADisplay' => $this->getNSADisplay($this->Data)
			);

		//Debug Log
		if ($debug){
			IPS_LogMessage(get_class().'::'.__FUNCTION__,'datasend:'.json_encode($datasend));
		}

		return $datasend;
	}
	

}
?>