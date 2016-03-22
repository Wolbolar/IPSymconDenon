<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonAVRHTTP extends IPSModule
{

   
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // 1. Verfügbarer DenonSplitter wird verbunden oder neu erzeugt, wenn nicht vorhanden.
        $this->ConnectParent("{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}");
		
		$this->RegisterPropertyInteger("Type", 0);
		$this->RegisterPropertyInteger("Zone", 6);
		
    }


    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();
		
		$this->ValidateConfiguration();
		
	}
		
	/**
    * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
    * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
    *
    */
	private function ValidateConfiguration()
	{
		//Zone prüfen
		$Zone = $this->ReadPropertyInteger('Zone');
		
		if ($Zone == 0) //Mainzone
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			$Type = $this->GetAVRType();
			//Type und Zone
			$DenonAVRVar->Type = $Type;
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptChannelVolumeFL = "DENON.".$DenonAVRVar->Type.".ChannelVolumeFL";
			$DenonAVRVar->ptChannelVolumeFR = "DENON.".$DenonAVRVar->Type.".ChannelVolumeFR";
			$DenonAVRVar->ptChannelVolumeC = "DENON.".$DenonAVRVar->Type.".ChannelVolumeC";
			$DenonAVRVar->ptChannelVolumeSW = "DENON.".$DenonAVRVar->Type.".ChannelVolumeSW";
			$DenonAVRVar->ptChannelVolumeSW2 = "DENON.".$DenonAVRVar->Type.".ChannelVolumeSW2";
			$DenonAVRVar->ptChannelVolumeSL = "DENON.".$DenonAVRVar->Type.".ChannelVolumeSL";
			$DenonAVRVar->ptChannelVolumeSR = "DENON.".$DenonAVRVar->Type.".ChannelVolumeSR";
			$DenonAVRVar->ptChannelVolumeSBL = "DENON.".$DenonAVRVar->Type.".ChannelVolumeSBL";
			$DenonAVRVar->ptChannelVolumeSBR = "DENON.".$DenonAVRVar->Type.".ChannelVolumeSBR";
			$DenonAVRVar->ptChannelVolumeSB = "DENON.".$DenonAVRVar->Type.".ChannelVolumeSB";
			$DenonAVRVar->ptChannelVolumeFHL = "DENON.".$DenonAVRVar->Type.".ChannelVolumeFHL";
			$DenonAVRVar->ptChannelVolumeFHR = "DENON.".$DenonAVRVar->Type.".ChannelVolumeFHR";
			$DenonAVRVar->ptChannelVolumeFWL = "DENON.".$DenonAVRVar->Type.".ChannelVolumeFWL";
			$DenonAVRVar->ptChannelVolumeFWR = "DENON.".$DenonAVRVar->Type.".ChannelVolumeFWR";
			$DenonAVRVar->ptPower = 'DENON.'.$DenonAVRVar->Type.'.Power';
			$DenonAVRVar->ptMainZonePower = 'DENON.'.$DenonAVRVar->Type.'.MainZonePower';
			$DenonAVRVar->ptMainMute = 'DENON.'.$DenonAVRVar->Type.'.MainMute';
			$DenonAVRVar->ptCinemaEQ = 'DENON.'.$DenonAVRVar->Type.'.CinemaEQ';
			$DenonAVRVar->ptPanorama = 'DENON.'.$DenonAVRVar->Type.'.Panorama';
			$DenonAVRVar->ptFrontHeight = 'DENON.'.$DenonAVRVar->Type.'.FrontHeight';
			$DenonAVRVar->ptToneCTRL = 'DENON.'.$DenonAVRVar->Type.'.ToneCTRL';
			$DenonAVRVar->ptDynamicEQ = 'DENON.'.$DenonAVRVar->Type.'.DynamicEQ';
			$DenonAVRVar->ptMasterVolume = 'DENON.'.$DenonAVRVar->Type.'.MasterVolume';
			$DenonAVRVar->ptInputSource = 'DENON.'.$DenonAVRVar->Type.'.Inputsource';
			$DenonAVRVar->ptAudioDelay = 'DENON.'.$DenonAVRVar->Type.'.AudioDelay';
			$DenonAVRVar->ptLFELevel = 'DENON.'.$DenonAVRVar->Type.'.LFELevel';
			$DenonAVRVar->ptQuickSelect = 'DENON.'.$DenonAVRVar->Type.'.QuickSelect';
			$DenonAVRVar->ptSleep = 'DENON.'.$DenonAVRVar->Type.'.Sleep';
			$DenonAVRVar->ptDigitalInputMode = 'DENON.'.$DenonAVRVar->Type.'.DigitalInputMode';
			$DenonAVRVar->ptSurroundMode = 'DENON.'.$DenonAVRVar->Type.'.SurroundMode';
			$DenonAVRVar->ptSurroundPlayMode = 'DENON.'.$DenonAVRVar->Type.'.SurroundPlayMode';
			$DenonAVRVar->ptMultiEQMode = 'DENON.'.$DenonAVRVar->Type.'.MultiEQMode';
			$DenonAVRVar->ptAudioRestorer = 'DENON.'.$DenonAVRVar->Type.'.AudioRestorer';
			$DenonAVRVar->ptBassLevel = 'DENON.'.$DenonAVRVar->Type.'.BassLevel';
			$DenonAVRVar->ptTrebleLevel = 'DENON.'.$DenonAVRVar->Type.'.TrebleLevel';
			$DenonAVRVar->ptDimension = 'DENON.'.$DenonAVRVar->Type.'.Dimension';
			$DenonAVRVar->ptDynamicVolume = 'DENON.'.$DenonAVRVar->Type.'.DynamicVolume';
			$DenonAVRVar->ptRoomSize = 'DENON.'.$DenonAVRVar->Type.'.RoomSize';
			$DenonAVRVar->ptDynamicCompressor = 'DENON.'.$DenonAVRVar->Type.'.DynamicCompressor';
			$DenonAVRVar->ptCenterWidth = 'DENON.'.$DenonAVRVar->Type.'.CenterWidth';
			$DenonAVRVar->ptDynamicRange = 'DENON.'.$DenonAVRVar->Type.'.DynamicRange';
			$DenonAVRVar->ptVideoSelect = 'DENON.'.$DenonAVRVar->Type.'.VideoSelect';
			$DenonAVRVar->ptSurroundBackMode = 'DENON.'.$DenonAVRVar->Type.'.SurroundBackMode';
			$DenonAVRVar->ptPreset = 'DENON.'.$DenonAVRVar->Type.'.Preset';
			$DenonAVRVar->ptInputMode = 'DENON.'.$DenonAVRVar->Type.'.InputMode';
			$DenonAVRVar->ptNavigation = "DENON.".$DenonAVRVar->Type.".Navigation";
			$DenonAVRVar->ptContrast = "DENON.".$DenonAVRVar->Type.".Contrast";
			$DenonAVRVar->ptBrightness = "DENON.".$DenonAVRVar->Type.".Brightness";
			$DenonAVRVar->ptChromalevel = "DENON.".$DenonAVRVar->Type.".Chromalevel";
			$DenonAVRVar->ptHue = "DENON.".$DenonAVRVar->Type.".Hue";
			$DenonAVRVar->ptEnhancer = "DENON.".$DenonAVRVar->Type.".Enhancer";
			$DenonAVRVar->ptSubwoofer = "DENON.".$DenonAVRVar->Type.".Subwoofer";
			$DenonAVRVar->ptSubwooferATT = "DENON.".$DenonAVRVar->Type.".SubwooferATT";
			$DenonAVRVar->ptDNRDirectChange = "DENON.".$DenonAVRVar->Type.".DNRDirectChange";
			$DenonAVRVar->ptEffect = "DENON.".$DenonAVRVar->Type.".Effect";
			$DenonAVRVar->ptAFDM = "DENON.".$DenonAVRVar->Type.".AFDM";
			$DenonAVRVar->ptEffectLevel = "DENON.".$DenonAVRVar->Type.".EffectLevel";
			$DenonAVRVar->ptCenterImage = "DENON.".$DenonAVRVar->Type.".CenterImage";
			$DenonAVRVar->ptStageWidth = "DENON.".$DenonAVRVar->Type.".StageWidth";
			$DenonAVRVar->ptStageHeight = "DENON.".$DenonAVRVar->Type.".StageHeight";
			$DenonAVRVar->ptAudysseyDSX = "DENON.".$DenonAVRVar->Type.".AudysseyDSX";
			$DenonAVRVar->ptReferenceLevel = "DENON.".$DenonAVRVar->Type.".ReferenceLevel";
			$DenonAVRVar->ptDRCDirectChange = "DENON.".$DenonAVRVar->Type.".DRCDirectChange";
			$DenonAVRVar->ptSpeakerOutputFront = "DENON.".$DenonAVRVar->Type.".SpeakerOutputFront";
			$DenonAVRVar->ptDCOMPDirectChange = "DENON.".$DenonAVRVar->Type.".DCOMPDirectChange";
			$DenonAVRVar->ptHDMIMonitor = "DENON.".$DenonAVRVar->Type.".HDMIMonitor";
			$DenonAVRVar->ptASP = "DENON.".$DenonAVRVar->Type.".ASP";
			$DenonAVRVar->ptResolution = "DENON.".$DenonAVRVar->Type.".Resolution";
			$DenonAVRVar->ptResolutionHDMI = "DENON.".$DenonAVRVar->Type.".ResolutionHDMI";
			$DenonAVRVar->ptHDMIAudioOutput = "DENON.".$DenonAVRVar->Type.".HDMIAudioOutput";
			$DenonAVRVar->ptVideoProcessingMode = "DENON.".$DenonAVRVar->Type.".VideoProcessingMode";
			$DenonAVRVar->ptDolbyVolumeLeveler = "DENON.".$DenonAVRVar->Type.".DolbyVolumeLeveler";
			$DenonAVRVar->ptDolbyVolumeModeler = "DENON.".$DenonAVRVar->Type.".DolbyVolumeModeler";
			$DenonAVRVar->ptPLIIZHeightGain = "DENON.".$DenonAVRVar->Type.".PLIIZHeightGain";
			$DenonAVRVar->ptVerticalStretch = "DENON.".$DenonAVRVar->Type.".VerticalStretch";
			$DenonAVRVar->ptDolbyVolume = "DENON.".$DenonAVRVar->Type.".DolbyVolume";
			
			//Variablen						
	
			//Boolean
			$vBoolean = array
				(
				$DenonAVRVar->ptPower => true,
				$DenonAVRVar->ptMainZonePower => true,
				$DenonAVRVar->ptMainMute => true
				/*
				$DenonAVRVar->ptCinemaEQ => $this->ReadPropertyBoolean('CinemaEQ'),
				$DenonAVRVar->ptDynamicEQ => $this->ReadPropertyBoolean('DynamicEQ'),
				$DenonAVRVar->ptFrontHeight => $this->ReadPropertyBoolean('FrontHeight'),
				$DenonAVRVar->ptPanorama => $this->ReadPropertyBoolean('Panorama'),
				$DenonAVRVar->ptToneCTRL => $this->ReadPropertyBoolean('ToneCTRL'),
				$DenonAVRVar->ptVerticalStretch => $this->ReadPropertyBoolean('VerticalStretch'),
				$DenonAVRVar->ptDolbyVolume => $this->ReadPropertyBoolean('DolbyVolume'),
				$DenonAVRVar->ptEffect => $this->ReadPropertyBoolean('Effect'),
				$DenonAVRVar->ptAFDM => $this->ReadPropertyBoolean('AFDM'),
				$DenonAVRVar->ptSubwoofer => $this->ReadPropertyBoolean('Subwoofer'),
				$DenonAVRVar->ptSubwooferATT => $this->ReadPropertyBoolean('SubwooferATT')
				*/	
				);
				
			//Integer
			$vInteger = array
				(
				$DenonAVRVar->ptSleep => true
				//$DenonAVRVar->ptSleep => $this->ReadPropertyBoolean('Sleep'),
				//$DenonAVRVar->ptDimension => $this->ReadPropertyBoolean('Dimension')
				);
			
			//Integer mit Association
			$vIntegerAss = array
				(
				 $DenonAVRVar->ptInputSource => true
				 /*
				 $DenonAVRVar->ptNavigation => $this->ReadPropertyBoolean('Navigation'),
				 $DenonAVRVar->ptQuickSelect => $this->ReadPropertyBoolean('QuickSelect'),
				 $DenonAVRVar->ptDigitalInputMode => $this->ReadPropertyBoolean('DigitalInputMode'),
				 $DenonAVRVar->ptSurroundMode => $this->ReadPropertyBoolean('SurroundMode'),
				 $DenonAVRVar->ptSurroundPlayMode => $this->ReadPropertyBoolean('SurroundPlayMode'),
				 $DenonAVRVar->ptMultiEQMode => $this->ReadPropertyBoolean('MultiEQMode'),
				 $DenonAVRVar->ptAudioRestorer => $this->ReadPropertyBoolean('AudioRestorer'),
				 $DenonAVRVar->ptDynamicVolume => $this->ReadPropertyBoolean('DynamicVolume'),
				 $DenonAVRVar->ptRoomSize => $this->ReadPropertyBoolean('RoomSize'),
				 $DenonAVRVar->ptDynamicCompressor => $this->ReadPropertyBoolean('DynamicCompressor'),
				 $DenonAVRVar->ptDynamicRange => $this->ReadPropertyBoolean('DynamicRange'),
				 $DenonAVRVar->ptVideoSelect => $this->ReadPropertyBoolean('VideoSelect'),
				 $DenonAVRVar->ptSurroundBackMode => $this->ReadPropertyBoolean('SurroundBackMode'),
				 $DenonAVRVar->ptInputMode => $this->ReadPropertyBoolean('Inputmode')
				 */
				);
				
			//Float
			$vFloat = array
				(
				//Lautsprecher
				$DenonAVRVar->ptMasterVolume => true
				/*
				$DenonAVRVar->ptChannelVolumeFL => $this->ReadPropertyBoolean('FL'),
				$DenonAVRVar->ptChannelVolumeFR => $this->ReadPropertyBoolean('FR'),
				$DenonAVRVar->ptChannelVolumeC => $this->ReadPropertyBoolean('C'),
				$DenonAVRVar->ptChannelVolumeSW => $this->ReadPropertyBoolean('SW'),
				$DenonAVRVar->ptChannelVolumeSW2 => $this->ReadPropertyBoolean('SW2'),
				$DenonAVRVar->ptChannelVolumeSL => $this->ReadPropertyBoolean('SL'),
				$DenonAVRVar->ptChannelVolumeSR => $this->ReadPropertyBoolean('SR'),
				$DenonAVRVar->ptChannelVolumeSBL => $this->ReadPropertyBoolean('SBL'),
				$DenonAVRVar->ptChannelVolumeSBR => $this->ReadPropertyBoolean('SBR'),
				$DenonAVRVar->ptChannelVolumeSB => $this->ReadPropertyBoolean('SB'),
				$DenonAVRVar->ptChannelVolumeFHL => $this->ReadPropertyBoolean('FHL'),
				$DenonAVRVar->ptChannelVolumeFHR => $this->ReadPropertyBoolean('FHR'),
				$DenonAVRVar->ptChannelVolumeFWL => $this->ReadPropertyBoolean('FWL'),
				$DenonAVRVar->ptChannelVolumeFWR => $this->ReadPropertyBoolean('FWR'),
				$DenonAVRVar->ptAudioDelay => $this->ReadPropertyBoolean('AudioDelay'),
				$DenonAVRVar->ptLFELevel => $this->ReadPropertyBoolean('LFELevel'),
				$DenonAVRVar->ptBassLevel => $this->ReadPropertyBoolean('BassLevel'),
				$DenonAVRVar->ptTrebleLevel => $this->ReadPropertyBoolean('TrebleLevel'),
				$DenonAVRVar->ptCenterWidth => $this->ReadPropertyBoolean('CenterWidth'),
				$DenonAVRVar->ptEffectLevel => $this->ReadPropertyBoolean('EffectLevel'),
				$DenonAVRVar->ptCenterImage => $this->ReadPropertyBoolean('CenterImage'),
				$DenonAVRVar->ptContrast => $this->ReadPropertyBoolean('Contrast'),
				$DenonAVRVar->ptBrightness => $this->ReadPropertyBoolean('Brightness'),
				$DenonAVRVar->ptChromalevel => $this->ReadPropertyBoolean('Chromalevel'),
				$DenonAVRVar->ptHue => $this->ReadPropertyBoolean('Hue'),
				$DenonAVRVar->ptEnhancer => $this->ReadPropertyBoolean('Enhancer'),
				$DenonAVRVar->ptStageHeight => $this->ReadPropertyBoolean('StageHeight'),
				$DenonAVRVar->ptStageWidth => $this->ReadPropertyBoolean('StageWidth')
				*/
				);
				
			$this->SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat);		
		}
		elseif ($Zone == 1) //Zone 2
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			$Type = $this->GetAVRType();
			//Type und Zone
			$DenonAVRVar->Type = $Type;
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptZone2Power = 'DENON.'.$DenonAVRVar->Type.'.Zone2Power';
			$DenonAVRVar->ptZone2Mute = 'DENON.'.$DenonAVRVar->Type.'.Zone2Mute';
			$DenonAVRVar->ptZone2Volume = 'DENON.'.$DenonAVRVar->Type.'.Zone2Volume';
			$DenonAVRVar->ptZone2InputSource = 'DENON.'.$DenonAVRVar->Type.'.Zone2InputSource';
			$DenonAVRVar->ptZone2ChannelSetting = 'DENON.'.$DenonAVRVar->Type.'.Zone2ChannelSetting';
			$DenonAVRVar->ptZone2ChannelVolumeFL = 'DENON.'.$DenonAVRVar->Type.'.Zone2ChannelVolumeFL';
			$DenonAVRVar->ptZone2ChannelVolumeFR = 'DENON.'.$DenonAVRVar->Type.'.Zone2ChannelVolumeFR';
			$DenonAVRVar->ptZone2QuickSelect = 'DENON.'.$DenonAVRVar->Type.'.Zone2QuickSelect';
			
			//Variablen						
	
			//Boolean
			$vBoolean = array
				(
				$DenonAVRVar->ptZone2Power => true,
				$DenonAVRVar->ptZone2Mute => true,
				$DenonAVRVar->ptZone2HPF => true
				);
				
			//Integer
			$vInteger = array
				(
				$DenonAVRVar->ptSleepZ2 => true
				);
			
			//Integer mit Association
			$vIntegerAss = array
				(
				 $DenonAVRVar->ptZone2InputSource => true,
				 $DenonAVRVar->ptZone2ChannelSetting => true,
				 $DenonAVRVar->ptZone2QuickSelect => true
				);
				
			//Float
			$vFloat = array
				(
				//Lautsprecher
				$DenonAVRVar->ptZone2Volume => true,
				$DenonAVRVar->ptZone2ChannelVolumeFL => true,
				$DenonAVRVar->ptZone2ChannelVolumeFR => true
				);
			
			$this->SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat);
		}
		elseif ($Zone == 2) // Zone 3
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			$Type = $this->GetAVRType();
			//Type und Zone
			$DenonAVRVar->Type = $Type;
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptZone3Power = 'DENON.'.$DenonAVRVar->Type.'.Zone3Power';
			$DenonAVRVar->ptZone3Mute = 'DENON.'.$DenonAVRVar->Type.'.Zone3Mute';
			$DenonAVRVar->ptZone3Volume = 'DENON.'.$DenonAVRVar->Type.'.Zone3Volume';
			$DenonAVRVar->ptZone3InputSource = 'DENON.'.$DenonAVRVar->Type.'.Zone3InputSource';
			$DenonAVRVar->ptZone3ChannelSetting = 'DENON.'.$DenonAVRVar->Type.'.Zone3ChannelSetting';
			$DenonAVRVar->ptZone3ChannelVolumeFL = 'DENON.'.$DenonAVRVar->Type.'.Zone3ChannelVolumeFL';
			$DenonAVRVar->ptZone3ChannelVolumeFR = 'DENON.'.$DenonAVRVar->Type.'.Zone3ChannelVolumeFR';
			$DenonAVRVar->ptZone3QuickSelect = 'DENON.'.$DenonAVRVar->Type.'.Zone3QuickSelect';
			
			//Variablen						
	
			//Boolean
			$vBoolean = array
				(
				$DenonAVRVar->ptZone3Power => true,
				$DenonAVRVar->ptZone3Mute => true,
				$DenonAVRVar->ptZone3HPF => true
				);
				
			//Integer
			$vInteger = array
				(
				$DenonAVRVar->ptSleepZ3 => true
				);
			
			//Integer mit Association
			$vIntegerAss = array
				(
				 $DenonAVRVar->ptZone3InputSource => true,
				 $DenonAVRVar->ptZone3ChannelSetting => true,
				 $DenonAVRVar->ptZone3QuickSelect => true
				);
				
			//Float
			$vFloat = array
				(
				//Lautsprecher
				$DenonAVRVar->ptZone3Volume => true,
				$DenonAVRVar->ptZone3ChannelVolumeFL => true,
				$DenonAVRVar->ptZone3ChannelVolumeFR => true
				);
			
			$this->SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat);
		}
		
		
		
		
		//TestEmpfangspuffer
		$responseid = @IPS_GetVariableIDByName("Response", $this->InstanceID);
				if ($responseid === false)
					{
						//Response
						$responseid = $this->RegisterVariableString("Response", "Response", "~String", 1);
						//IPS_SetHidden($responseid, true);
						$this->EnableAction("Response");
					
					}
				else
					{
						//Variable Response existiert bereits
						
					}
					
				//auf aktive Parent prüfen
				
			//Status aktiv
			$this->SetStatus(102);
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
	
	private function GetZone()
    {
        $this->DenonZone = new DENON_Zone();
        $this->DenonZone->thisZone = $this->ReadPropertyInteger("Zone");
        return true;
    }
	
	private function GetAVRType()
	{
		$TypeInt = $this->ReadPropertyInteger('Type');
		
		$Types = array(
				0 => "AVR-4311",
				1 => "AVR-X4000",
				2 => "AVR-S700",
				3 => "AVR-S900",
				4 => "AVR-X1100",
				5 => "AVR-X2100",
				6 => "AVR-X3100",
				7 => "AVR-X4100",
				8 => "AVR-X5200",
				9 => "AVR-X7200");
		
		foreach($Types as $TypeID => $Type)
		{
			if($TypeID == $TypeInt)
			{
			   return $Type;
			}

		}		
	}
	
	private function SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat)
	{
		// Add/Remove according to feature activation
        // create link list for deletion of links if target is deleted
        $links = Array();
        foreach( IPS_GetLinkList() as $key=>$LinkID ){
            $links[] =  Array( ('LinkID') => $LinkID, ('TargetID') =>  IPS_GetLink($LinkID)['TargetID'] );
        }
		
		//Sichtbare Variablen anlegen
		foreach ($vBoolean as $ptBool => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonBool($ptBool);
				//Ident, Name, Profile, Position 
				$id = $this->RegisterVariableBoolean($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
			}	
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				 $profile = $DenonAVRVar->SetupVarDenonBool($ptBool);
				 $this->removeVariableAction($profile["Ident"], $links, $ptBool); 
			}
		}
		
		foreach ($vInteger as $ptInteger => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonInteger($ptInteger);
				$this->RegisterProfileIntegerDenon($profile["ProfilName"], $profile["Icon"], $profile["Prefix"], $profile["Suffix"], $profile["MinValue"], $profile["MaxValue"], $profile["Stepsize"], $profile["Digits"]);
				IPS_LogMessage('Variablenprofil angelegt:', $profile["ProfilName"]);	
				$id = $this->RegisterVariableInteger($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
			}	
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				$profile = $DenonAVRVar->SetupVarDenonInteger($ptInteger);
				$this->removeVariableAction($profile["Ident"], $links, $ptInteger); 
			}
		}
		
		foreach ($vIntegerAss as $ptIntegerAss => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonIntegerAss($ptIntegerAss);
				$this->RegisterProfileIntegerDenonAss($profile["ProfilName"], $profile["Icon"], $profile["Prefix"], $profile["Suffix"], $profile["MinValue"], $profile["MaxValue"], $profile["Stepsize"], $profile["Digits"], $profile["Associations"]);
				IPS_LogMessage('Variablenprofil angelegt:', $profile["ProfilName"]);
				$id = $this->RegisterVariableInteger($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
				
			}	
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				$profile = $DenonAVRVar->SetupVarDenonIntegerAss($ptIntegerAss);
				$this->removeVariableAction($profile["Ident"], $links, $ptIntegerAss); 
			}
		}
		
		foreach ($vFloat as $ptFloat => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonFloat($ptFloat);
				$this->RegisterProfileFloatDenon($profile["ProfilName"], $profile["Icon"], $profile["Prefix"], $profile["Suffix"], $profile["MinValue"], $profile["MaxValue"], $profile["Stepsize"], $profile["Digits"]);
				IPS_LogMessage('Variablenprofil angelegt:', $profile["ProfilName"]);
				$id = $this->RegisterVariableFloat($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
			}
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				$profile = $DenonAVRVar->SetupVarDenonFloat($ptFloat);
				$this->removeVariableAction($profile["Ident"], $links, $ptFloat); 
			}
		}
		
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
			IPS_LogMessage('Variable gelöscht:', $Name.', [ObjektID: '.$vid.']');
			//delete Profile
			if (IPS_VariableProfileExists ($Profile))
			{
				IPS_DeleteVariableProfile($Profile);
				IPS_LogMessage('Variablenprofil gelöscht:', $Profile);
			}
			
        }
    }
	
	
	public function getStates ($Zone, $Info)
	{
		if ($Zone == 0) //Main
		{
			if ($Info == "MainZoneXml")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXml.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$MainZoneXml = $this->MainZoneXml($xml);
					return $MainZoneXml;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht geöffnet werden.");
					}
						
			}
			elseif ($Info == "MainZoneXmlStatus")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXmlStatus.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$MainZoneXmlStatus = $this->MainZoneXmlStatus($xml);
					return $MainZoneXmlStatus;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht geöffnet werden.");
					}
						
			}
			elseif ($Info == "NetAudioStatusXml")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_NetAudioStatusXml.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$NetAudioStatusXml = $this->NetAudioStatusXml($xml);
					return $NetAudioStatusXml;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht geöffnet werden.");
					}
						
			}
			elseif ($Info == "Deviceinfo")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_Deviceinfo.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$Deviceinfo = $this->Deviceinfo($xml);
					return $Deviceinfo;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht geöffnet werden.");
					}
						
			}
		}
		elseif ($Zone == 1) // Zone 2
		{
			$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE2"));
		}
		elseif ($Zone == 2) // Zone 3
		{
			$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE3"));
		}
	}
	
	protected function MainZoneXml($xml)
	{
	$MainZoneXml = array();
	
		//FriendlyName
		$FriendlyName = $xml->xpath('.//FriendlyName');
		if ($FriendlyName)
		{
			$MainZone[3]["Name"] = "FriendlyName";
			$MainZone[3]["Value"] = (string)$FriendlyName[0]->value;
			$MainZone[3]["Vartype"] = 3; //Vartype String
			$MainZone[3]["MinValue"] = ""; //MinValue
			$MainZone[3]["MaxValue"] = ""; //Number
			$MainZone[3]["Icon"] = "Power"; //Icon
			$MainZone[3]["Prefix"] = ""; //Prefix
			$MainZone[3]["Suffix"] = ""; //Suffix
			$MainZone[3]["StepSize"] = ""; //Stepsize
			$MainZone[3]["Digits"] = ""; //Digits
		}

		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{
			$MainZone[0]["Name"] = "Power";
			$MainZone[0]["Value"] = (string)$AVRPower[0]->value;
			$MainZone[0]["Vartype"] = 0; //Vartype Bool
			$MainZone[0]["MinValue"] = ""; //MinValue
			$MainZone[0]["MaxValue"] = ""; //MaxValue
			$MainZone[0]["Icon"] = "Power"; //Icon
			$MainZone[0]["Prefix"] = ""; //Prefix
			$MainZone[0]["Suffix"] = ""; //Suffix
			$MainZone[0]["StepSize"] = ""; //Stepsize
			$MainZone[0]["Digits"] = ""; //Digits
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$MainZone[1]["Name"] = "MainZonePower";
			$MainZone[1]["Value"] = (string)$ZonePower[0]->value;
			$MainZone[1]["Vartype"] = 0; //Vartype Bool
			$MainZone[1]["MinValue"] = ""; //MinValue
			$MainZone[1]["MaxValue"] = ""; //Number
			$MainZone[1]["Icon"] = "Power"; //Icon
			$MainZone[1]["Prefix"] = ""; //Prefix
			$MainZone[1]["Suffix"] = ""; //Suffix
			$MainZone[1]["StepSize"] = ""; //Stepsize
			$MainZone[1]["Digits"] = ""; //Digits
		}

		//RenameZone
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$MainZone[3]["Name"] = "MainZone";
			$MainZone[3]["Value"] = (string)$RenameZone[0]->value;
			$MainZone[3]["Vartype"] = 3; //Vartype String
			$MainZone[3]["MinValue"] = ""; //MinValue
			$MainZone[3]["MaxValue"] = ""; //Number
			$MainZone[3]["Icon"] = "Power"; //Icon
			$MainZone[3]["Prefix"] = ""; //Prefix
			$MainZone[3]["Suffix"] = ""; //Suffix
			$MainZone[3]["StepSize"] = ""; //Stepsize
			$MainZone[3]["Digits"] = ""; //Digits
		}



		//TopMenuLink
		$TopMenuLink = $xml->xpath('.//TopMenuLink');
		if ($TopMenuLink)
		{
			$MainZone[4]["Name"] = "TopMenuLink";
			$MainZone[4]["Value"] = (string)$TopMenuLink[0]->value;
			$MainZone[4]["Vartype"] = 3; //Vartype String
			$MainZone[4]["MinValue"] = ""; //MinValue
			$MainZone[4]["MaxValue"] = ""; //Number
			$MainZone[4]["Icon"] = "Power"; //Icon
			$MainZone[4]["Prefix"] = ""; //Prefix
			$MainZone[4]["Suffix"] = ""; //Suffix
			$MainZone[4]["StepSize"] = ""; //Stepsize
			$MainZone[4]["Digits"] = ""; //Digits
		}


		//ModelId
		$ModelId = $xml->xpath('.//ModelId');
		if ($ModelId)
		{
			$MainZone[5]["Name"] = "ModelId";
			$MainZone[5]["Value"] = (string)$ModelId[0]->value;
			$MainZone[5]["Vartype"] = 3; //Vartype String
			$MainZone[5]["MinValue"] = ""; //MinValue
			$MainZone[5]["MaxValue"] = ""; //Number
			$MainZone[5]["Icon"] = "Power"; //Icon
			$MainZone[5]["Prefix"] = ""; //Prefix
			$MainZone[5]["Suffix"] = ""; //Suffix
			$MainZone[5]["StepSize"] = ""; //Stepsize
			$MainZone[5]["Digits"] = ""; //Digits
		}


		//SalesArea
		$SalesArea = $xml->xpath('.//SalesArea');
		if ($SalesArea)
		{
			$MainZone[6]["Name"] = "SalesArea";
			$MainZone[6]["Value"] = (string)$SalesArea[0]->value;
			$MainZone[6]["Vartype"] = 3; //Vartype String
			$MainZone[6]["MinValue"] = ""; //MinValue
			$MainZone[6]["MaxValue"] = ""; //Number
			$MainZone[6]["Icon"] = "Power"; //Icon
			$MainZone[6]["Prefix"] = ""; //Prefix
			$MainZone[6]["Suffix"] = ""; //Suffix
			$MainZone[6]["StepSize"] = ""; //Stepsize
			$MainZone[6]["Digits"] = ""; //Digits
		}


		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
		{
			$MainZone[7]["Name"] = "InputFuncSelect";
			$MainZone[7]["Value"] = (string)$InputFuncSelect[0]->value;
			$MainZone[7]["Vartype"] = 3; //Vartype String
			$MainZone[7]["MinValue"] = ""; //MinValue
			$MainZone[7]["MaxValue"] = ""; //Number
			$MainZone[7]["Icon"] = "Power"; //Icon
			$MainZone[7]["Prefix"] = ""; //Prefix
			$MainZone[7]["Suffix"] = ""; //Suffix
			$MainZone[7]["StepSize"] = ""; //Stepsize
			$MainZone[7]["Digits"] = ""; //Digits
		}


		//NetFuncSelect
		$NetFuncSelect = $xml->xpath('.//NetFuncSelect');
		if ($NetFuncSelect)
		{
			$MainZone[8]["Name"] = "NetFuncSelect";
			$MainZone[8]["Value"] = (string)$NetFuncSelect[0]->value;
			$MainZone[8]["Vartype"] = 3; //Vartype String
			$MainZone[8]["MinValue"] = ""; //MinValue
			$MainZone[8]["MaxValue"] = ""; //Number
			$MainZone[8]["Icon"] = "Power"; //Icon
			$MainZone[8]["Prefix"] = ""; //Prefix
			$MainZone[8]["Suffix"] = ""; //Suffix
			$MainZone[8]["StepSize"] = ""; //Stepsize
			$MainZone[8]["Digits"] = ""; //Digits
		}


		//InputFuncSelectMain
		$InputFuncSelectMain = $xml->xpath('.//InputFuncSelectMain');
		if ($InputFuncSelectMain)
		{
		   $MainZone[9]["Name"] = "InputFuncSelectMain";
			$MainZone[9]["Value"] = (string)$InputFuncSelectMain[0]->value;
			$MainZone[9]["Vartype"] = 3; //Vartype String
			$MainZone[9]["MinValue"] = ""; //MinValue
			$MainZone[9]["MaxValue"] = ""; //Number
			$MainZone[9]["Icon"] = "Power"; //Icon
			$MainZone[9]["Prefix"] = ""; //Prefix
			$MainZone[9]["Suffix"] = ""; //Suffix
			$MainZone[9]["StepSize"] = ""; //Stepsize
			$MainZone[9]["Digits"] = ""; //Digits
		}

		//selectSurround
		$selectSurround = $xml->xpath('.//selectSurround');
		if ($selectSurround)
		{
			$MainZone[10]["Name"] = "selectSurround";
			$MainZone[10]["Value"] = (string)$selectSurround[0]->value;
			$MainZone[10]["Vartype"] = 3; //Vartype String
			$MainZone[10]["MinValue"] = ""; //MinValue
			$MainZone[10]["MaxValue"] = ""; //Number
			$MainZone[10]["Icon"] = "Power"; //Icon
			$MainZone[10]["Prefix"] = ""; //Prefix
			$MainZone[10]["Suffix"] = ""; //Suffix
			$MainZone[10]["StepSize"] = ""; //Stepsize
			$MainZone[10]["Digits"] = ""; //Digits
		}

		//VolumeDisplay
		$VolumeDisplay = $xml->xpath('.//VolumeDisplay');
		if ($VolumeDisplay)
		{
			$MainZone[10]["Name"] = "VolumeDisplay";
			$MainZone[10]["Value"] = (string)$VolumeDisplay[0]->value;
			$MainZone[10]["Vartype"] = 3; //Vartype String
			$MainZone[10]["MinValue"] = ""; //MinValue
			$MainZone[10]["MaxValue"] = ""; //Number
			$MainZone[10]["Icon"] = "Power"; //Icon
			$MainZone[10]["Prefix"] = ""; //Prefix
			$MainZone[10]["Suffix"] = ""; //Suffix
			$MainZone[10]["StepSize"] = ""; //Stepsize
			$MainZone[10]["Digits"] = ""; //Digits
		}



		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$MainZone[11]["Name"] = "MasterVolume";
			$MainZone[11]["Value"] = (string)$MasterVolume[0]->value;
			$MainZone[11]["Vartype"] = 2; //Vartype Float
			$MainZone[11]["MinValue"] = -80.0; //MinValue
			$MainZone[11]["MaxValue"] = 18.0; //Number
			$MainZone[11]["Icon"] = "Power"; //Icon
			$MainZone[11]["Prefix"] = ""; //Prefix
			$MainZone[11]["Suffix"] = "%"; //Suffix
			$MainZone[11]["StepSize"] = 0.5; //Stepsize
			$MainZone[11]["Digits"] = 0; //Digits
		}


		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MainZone[12]["Name"] = "Mute";
			$MainZone[12]["Value"] = (string)$Mute[0]->value;
			$MainZone[12]["Vartype"] = 0; //Vartype Bool
			$MainZone[12]["MinValue"] = ""; //MinValue
			$MainZone[12]["MaxValue"] = ""; //Number
			$MainZone[12]["Icon"] = "Power"; //Icon
			$MainZone[12]["Prefix"] = ""; //Prefix
			$MainZone[12]["Suffix"] = ""; //Suffix
			$MainZone[12]["StepSize"] = ""; //Stepsize
			$MainZone[12]["Digits"] = ""; //Digits
		}


		//RemoteMaintenance
		$RemoteMaintenance = $xml->xpath('.//RemoteMaintenance');
		if ($RemoteMaintenance)
		{
			$MainZone[13]["Name"] = "RemoteMaintenance";
			$MainZone[13]["Value"] = (string)$RemoteMaintenance[0]->value;
			$MainZone[13]["Vartype"] = 3; //Vartype String
			$MainZone[13]["MinValue"] = ""; //MinValue
			$MainZone[13]["MaxValue"] = ""; //Number
			$MainZone[13]["Icon"] = "Power"; //Icon
			$MainZone[13]["Prefix"] = ""; //Prefix
			$MainZone[13]["Suffix"] = ""; //Suffix
			$MainZone[13]["StepSize"] = ""; //Stepsize
			$MainZone[13]["Digits"] = ""; //Digits
		}


		//GameSourceDisplay
		$GameSourceDisplay = $xml->xpath('.//GameSourceDisplay');
		if ($GameSourceDisplay)
		{
			$MainZone[14]["Name"] = "GameSourceDisplay";
			$MainZone[14]["Value"] = (string)$GameSourceDisplay[0]->value;
			$MainZone[14]["Vartype"] = 3; //Vartype String
			$MainZone[14]["MinValue"] = ""; //MinValue
			$MainZone[14]["MaxValue"] = ""; //Number
			$MainZone[14]["Icon"] = "Power"; //Icon
			$MainZone[14]["Prefix"] = ""; //Prefix
			$MainZone[14]["Suffix"] = ""; //Suffix
			$MainZone[14]["StepSize"] = ""; //Stepsize
			$MainZone[14]["Digits"] = ""; //Digits
		}


		//LastfmDisplay
		$LastfmDisplay = $xml->xpath('.//LastfmDisplay');
		if ($LastfmDisplay)
		{
			$MainZone[15]["Name"] = "LastfmDisplay";
			$MainZone[15]["Value"] = (string)$LastfmDisplay[0]->value;
			$MainZone[15]["Vartype"] = 3; //Vartype String
			$MainZone[15]["MinValue"] = ""; //MinValue
			$MainZone[15]["MaxValue"] = ""; //Number
			$MainZone[15]["Icon"] = "Power"; //Icon
			$MainZone[15]["Prefix"] = ""; //Prefix
			$MainZone[15]["Suffix"] = ""; //Suffix
			$MainZone[15]["StepSize"] = ""; //Stepsize
			$MainZone[15]["Digits"] = ""; //Digits
		}


		//SubwooferDisplay
		$SubwooferDisplay = $xml->xpath('.//SubwooferDisplay');
		if ($SubwooferDisplay)
		{
			$MainZone[16]["Name"] = "SubwooferDisplay";
			$MainZone[16]["Value"] = (string)$SubwooferDisplay[0]->value;
			$MainZone[16]["Vartype"] = 3; //Vartype String
			$MainZone[16]["MinValue"] = ""; //MinValue
			$MainZone[16]["MaxValue"] = ""; //Number
			$MainZone[16]["Icon"] = "Power"; //Icon
			$MainZone[16]["Prefix"] = ""; //Prefix
			$MainZone[16]["Suffix"] = ""; //Suffix
			$MainZone[16]["StepSize"] = ""; //Stepsize
			$MainZone[16]["Digits"] = ""; //Digits
		}


		//Zone2VolDisp
		$Zone2VolDisp = $xml->xpath('.//Zone2VolDisp');
		if ($Zone2VolDisp )
		{
			$MainZone[17]["Name"] = "Zone2VolDisp";
			$MainZone[17]["Value"] = (string)$Zone2VolDisp[0]->value;
			$MainZone[17]["Vartype"] = 3; //Vartype String
			$MainZone[17]["MinValue"] = ""; //MinValue
			$MainZone[17]["MaxValue"] = ""; //Number
			$MainZone[17]["Icon"] = "Power"; //Icon
			$MainZone[17]["Prefix"] = ""; //Prefix
			$MainZone[17]["Suffix"] = ""; //Suffix
			$MainZone[17]["StepSize"] = ""; //Stepsize
			$MainZone[17]["Digits"] = ""; //Digits
		}

	
	return $MainZoneXml;
	}
	
	protected function MainZoneXmlStatus($xml)
	{
		$MainZoneStatus = array();

		//RestorerMode
		$RestorerMode = $xml->xpath('.//RestorerMode');
		if ($RestorerMode)
		{
			$MainZoneStatus[0]["Name"] = "RestorerMode";
			$MainZoneStatus[0]["Value"] = (string)$RestorerMode[0]->value;
			$MainZoneStatus[0]["Vartype"] = 3; //Vartype String
			$MainZoneStatus[0]["MinValue"] = ""; //MinValue
			$MainZoneStatus[0]["MaxValue"] = ""; //Number
			$MainZoneStatus[0]["Icon"] = "Power"; //Icon
			$MainZoneStatus[0]["Prefix"] = ""; //Prefix
			$MainZoneStatus[0]["Suffix"] = ""; //Suffix
			$MainZoneStatus[0]["StepSize"] = ""; //Stepsize
			$MainZoneStatus[0]["Digits"] = ""; //Digits
		}


		//SurrMode
		$SurrMode = $xml->xpath('.//SurrMode');
		if ($SurrMode )
		{
			$MainZoneStatus[1]["Name"] = "SurrMode";
			$MainZoneStatus[1]["Value"] = (string)$SurrMode[0]->value;
			$MainZoneStatus[1]["Vartype"] = 3; //Vartype String
			$MainZoneStatus[1]["MinValue"] = ""; //MinValue
			$MainZoneStatus[1]["MaxValue"] = ""; //Number
			$MainZoneStatus[1]["Icon"] = "Power"; //Icon
			$MainZoneStatus[1]["Prefix"] = ""; //Prefix
			$MainZoneStatus[1]["Suffix"] = ""; //Suffix
			$MainZoneStatus[1]["StepSize"] = ""; //Stepsize
			$MainZoneStatus[1]["Digits"] = ""; //Digits
		}

		//Inputs
		$InputFuncList = $xml->xpath('.//InputFuncList');
		if ($InputFuncList)
		{
			$countinput = count($InputFuncList[0]->value);
			$RenameSource = $xml->xpath('.//RenameSource');
			$SourceDelete = $xml->xpath('.//SourceDelete');
			$SourceDeleteUse = $xml->xpath('.//SourceDelete/value[. ="USE"]');
			$countUse = count($SourceDeleteUse);
			$MainZoneStatus[2]["Name"] = "Inputs";
			$Inputs = array();

			for ($i = 0; $i <= $countinput-1; $i++)
				{
					if ((string)$SourceDelete[0]->value[$i] == "USE")
					{
						if ((string)$RenameSource[0]->value[$i] != "")
							{
							$Inputs[$i] = (string)$RenameSource[0]->value[$i];
							}
						else
							{
							$Inputs[$i] = (string)$InputFuncList[0]->value[$i];
						   }
					}
			   }
			$MainZoneStatus[2]["Value"] = $Inputs;
			$MainZoneStatus[2]["Vartype"] = 1; //Vartype Integer
			$MainZoneStatus[2]["MinValue"] = 0; //MinValue
			$MainZoneStatus[2]["MaxValue"] = $countUse; //Number
			$MainZoneStatus[2]["Icon"] = "Power"; //Icon
			$MainZoneStatus[2]["Prefix"] = ""; //Prefix
			$MainZoneStatus[2]["Suffix"] = ""; //Suffix
			$MainZoneStatus[2]["StepSize"] = 1; //Stepsize
			$MainZoneStatus[2]["Digits"] = 0; //Digits
		}

		return $MainZoneStatus;
	}
	
	protected function NetAudioStatusXml($xml)
	{
		$NetAudioStatus = array();

		//Modell
		$szLine = $xml->xpath('.//szLine');
		$NetAudioStatus[0]["Name"] = "Modell";
		$NetAudioStatus[0]["Value"] = (string)$szLine[0]->value;
		$NetAudioStatus[0]["Vartype"] = 3; //Vartype String
		$NetAudioStatus[0]["MinValue"] = ""; //MinValue
		$NetAudioStatus[0]["MaxValue"] = ""; //Number
		$NetAudioStatus[0]["Icon"] = "Power"; //Icon
		$NetAudioStatus[0]["Prefix"] = ""; //Prefix
		$NetAudioStatus[0]["Suffix"] = ""; //Suffix
		$NetAudioStatus[0]["StepSize"] = ""; //Stepsize
		$NetAudioStatus[0]["Digits"] = ""; //Digits

		return $NetAudioStatus;
	}
	
	protected function Deviceinfo($xml)
	{
		$Deviceinfo = array();

		//ModelName
		$ModelName = $xml->xpath('.//ModelName');
		//var_dump($ModelName);
		$Deviceinfo[0]["Name"] = "ModelName";
		$Deviceinfo[0]["Value"] = (string)$ModelName[0];
		$Deviceinfo[0]["Vartype"] = 3; //Vartype String
		$Deviceinfo[0]["MinValue"] = ""; //MinValue
		$Deviceinfo[0]["MaxValue"] = ""; //Number
		$Deviceinfo[0]["Icon"] = "Power"; //Icon
		$Deviceinfo[0]["Prefix"] = ""; //Prefix
		$Deviceinfo[0]["Suffix"] = ""; //Suffix
		$Deviceinfo[0]["StepSize"] = ""; //Stepsize
		$Deviceinfo[0]["Digits"] = ""; //Digits

		return $Deviceinfo;
	}
	
	
	public function RequestAction($Ident, $Value)
    {
        /*
		try
        {
            $this->GetZone();
        } catch (Exception $ex)
        {
//            trigger_error($ex->getMessage(), $ex->getCode());
            echo $ex->getMessage();
            return false;
        }
		*/
		//Command aus Ident
		$Command = $Ident; 
		
		$APIData = new DenonAVRCP_API_Data();
		$APIData->APICommand = $Command;
        $APIData->Data = $Value;
        //Prüfen ob Command vorhanden
		/*
		if (!$this->DenonZone->CmdAvaiable($APIData))
        {
//            trigger_error("Illegal Command in this Zone.", E_USER_WARNING);
            echo "Illegal Command in this Zone";
            return false;
        }
		*/
        // Subcommand holen
        $APIData->APISubCommand = $APIData->GetSubCommand($APIData->APICommand, $APIData->Data);
        IPS_LogMessage('Denon Subcommand', $APIData->APISubCommand);
        // Daten senden        Rückgabe ist egal, Variable wird automatisch durch Datenempfang nachgeführt
        try
        {
            $payload = $APIData->APICommand.$APIData->APISubCommand;
			//Befehl für URL Codieren
			$payload = urlencode ($payload);
			$this->SendCommand($payload);
			//$this->SendAPIData($APIData);
        } catch (Exception $ex)
        {
//            trigger_error($ex->getMessage(), $ex->getCode());
            echo $ex->getMessage();
            return false;
//            return;
        }

        /*        if ($ret === false)
          {
          echo "Error on Send.";
          return;
          } */
		
		//Type und Zone
		/*
		$Type = $this->ReadPropertyInteger('Type');
		$Zone = $this->ReadPropertyInteger('Zone');
				
		
		if($Zone === 0) //Mainzone
			{
			switch($Ident)
				{
				case "Power":
					$this->Power($Value);
				break;

				case "DigitalInputMode":
					$this->DigitalInputMode($Value);
				break;

				case "InputSource":
					$this->InputSource($Value);
				break;

				case "InputMode":
					$this->InputMode($Value);
				break;

				case "RoomSize":
					$this->RoomSize($Value);
				break;

				case "MainMute":
					$this->MainMute($Value);
				break;

				case "ToneCTRL":
					$this->ToneCTRL($Value);
				break;

				case "ToneDefeat":
					$this->ToneDefeat($Value);
				break;

				case "QuickSelect":
					$this->Quickselect($Value);
				break;

				case "VideoSelect":
					$this->VideoSelect($Value);
				break;

				case "Panorama":
					$this->Panorama($Value);
				break;

				case "FrontHeight":
					$this->FrontHeight($Value);
				break;

				case "BassLevel":
					$this->BassLevel($Value);
				break;

				case "LFELevel":
					$this->LFELevel($Value);
				break;

				case "TrebleLevel":
					$this->TrebleLevel($Value);
				break;

				case "DynamicEQ":
					$this->DynamicEQ($Value);
				break;

				case "DynamicCompressor":
					$this->DynamicCompressor($Value);
				break;

				case "DynamicVolume":
					$this->DynamicVolume($Value);
				break;

				case "DynamicRange":
					$this->DynamicCompressor($Value);
				break;

				case "AudioDelay":
					$this->AudioDelay($Value);
				break;

				case "AudioRestorer":
					$this->AudioRestorer($Value);
				break;

				case "MasterVolume":
					$this->MasterVolumeFix($Value);
				break;

				case "CWidth":
					$this->CWidth($Value);
				break;

				case "Dimension":
					$this->Dimension($Value);
				break;

				case "SurroundMode":
					$this->SurroundMode($Value);
				break;

				case "SurroundPlayMode":
					$this->SurroundPlayMode($Value);
				break;

				case "SurroundBackMode":
					$this->SurroundBackMode($Value);
				break;

				case "Sleep":
					$this->Sleep($Value);
				break;

				case "CinemaEQ":
					$this->CinemaEQ($Value);
				break;

				case "MainZonePower":
					$this->MainZonePower($Value);
				break;

				case "MultiEQMode":
					$this->MultiEQMode($Value);
				break;

				case "Preset":
					$this->Preset($Value);
				break;

				case "ChannelVolumeFL":
					$this->ChannelVolumeFL($Value);
				break;

				case "ChannelVolumeFR":
					$this->ChannelVolumeFR($Value);
				break;

				case "ChannelVolumeC":
					$this->ChannelVolumeC($Value);
				break;

				case "ChannelVolumeSW":
					$this->ChannelVolumeSW($Value);
				break;

				case "ChannelVolumeSL":
					$this->ChannelVolumeSL($Value);
				break;

				case "ChannelVolumeSR":
					$this->ChannelVolumeSR($Value);
				break;

				case "ChannelVolumeSBL":
					$this->ChannelVolumeSBL($Value);
				break;

				case "ChannelVolumeSBR":
					$this->ChannelVolumeSBR($Value);
				break;

				case "ChannelVolumeSB":
					$this->ChannelVolumeSB($Value);
				break;

				case "ChannelVolumeFHL":
					$this->ChannelVolumeFHL($Value);
				break;

				case "ChannelVolumeFHR":
					$this->ChannelVolumeFHR($Value);
				break;

				case "ChannelVolumeFWL":
					$this->ChannelVolumeFWL($Value);
				break;

				case "ChannelVolumeFWR":
					$this->ChannelVolumeFWR($Value);
				break;
				
				#################### Cursorsteuerung #####################################
			
				case "CursorUp":
					$this->CursorUp();
				break;

				case "CursorDown":
					$this->CursorDown();
				break;

				case "CursorLeft":
					$this->CursorLeft();
				break;

				case "CursorRight":
					$this->CursorRight();
				break;

				case "Enter":
					$this->Enter();
				break;

				case "Return":
					$this->CursorReturn();
				break;
					
				default:
					throw new Exception("Invalid ident");
				}
			}
		elseif($Zone === 1) //Zone 2
			{
			switch($Ident)
				{
				case "Zone2Power":
					$this->Zone2Power($Value);
				break;

				case "Zone2Volume":
					$this->Zone2VolumeFix($Value);
				break;

				case "Zone2Mute":
					$this->Zone2Mute($Value);
				break;

				case "Zone2InputSource":
					$this->Zone2InputSource($Value);
				break;

				case "Zone2ChannelSetting":
					$this->Zone2ChannelSetting($Value);
				break;

				case "Zone2ChannelVolumeFL":
					$this->Zone2ChannelVolumeFL($Value);
				break;

				case "Zone2ChannelVolumeFR":
					$this->Zone2ChannelVolumeFL($Value);
				break;
				
				#################### Cursorsteuerung #####################################
			
				case "CursorUp":
					$this->CursorUp();
				break;

				case "CursorDown":
					$this->CursorDown();
				break;

				case "CursorLeft":
					$this->CursorLeft();
				break;

				case "CursorRight":
					$this->CursorRight();
				break;

				case "Enter":
					$this->Enter();
				break;

				case "Return":
					$this->CursorReturn();
				break;
				
				default:
					throw new Exception("Invalid ident");
				}
			}
		elseif($Zone === 2) //Zone 3
			{
			switch($Ident)
				{
				case "Zone3Power":
					$this->Zone3Power($Value);
				break;

				case "Zone3Volume":
					$this->Zone3VolumeFix($Value);
				break;

				case "Zone3Mute":
					$this->Zone3Mute($Value);
				break;

				case "Zone3InputSource":
					$this->Zone3InputSource($Value);
				break;

				case "Zone3ChannelSetting":
					$this->Zone3ChannelSetting($Value);
				break;

				case "Zone3ChannelVolumeFL":
					$this->Zone3ChannelVolumeFL($Value);
				break;

				case "Zone3ChannelVolumeFR":
					$this->Zone3ChannelVolumeFL($Value);
				break;
				
				#################### Cursorsteuerung #####################################
			
				case "CursorUp":
					$this->CursorUp();
				break;

				case "CursorDown":
					$this->CursorDown();
				break;

				case "CursorLeft":
					$this->CursorLeft();
				break;

				case "CursorRight":
					$this->CursorRight();
				break;

				case "Enter":
					$this->Enter();
				break;

				case "Return":
					$this->CursorReturn();
				break;
				
				default:
					throw new Exception("Invalid ident");
				}
			}	
		*/
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
	
	
	protected function RegisterProfileIntegerDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits)
	{
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 1);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 1)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
		IPS_SetVariableProfileDigits($Name, $Digits); //  Nachkommastellen
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	protected function RegisterProfileIntegerDenonAss($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Digits, $Associations)
	{
        if ( sizeof($Associations) === 0 ){
            $MinValue = 0;
            $MaxValue = 0;
        } else {
            $MinValue = $Associations[0][0];
            $MaxValue = $Associations[sizeof($Associations)-1][0];
        }
        
        $this->RegisterProfileIntegerDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Digits);
        
        foreach($Associations as $Association) {
            IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
        }
        
    }
	
	protected function RegisterProfileStringDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize)
	{
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 3);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 3)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	protected function RegisterProfileFloatDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize)
	{
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 2);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 2)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	
	
	
	//Funktionsscript von Raketenschnecke
	
	//--------- DENON AVR 3311 Anbindung V0.95 18.06.11 15:08.53 by Raketenschnecke ---------

	############################ Info ##############################################
	/*
	Inital-Autor: philipp, Quelle: http://www.ip-symcon.de/forum/f53/denon-avr-3808-integration-7007/

	Funktionen:
		*Funktionssammlung aller implementierten DENON-Status und Befehle
	*/

	//$id clientsocket id
	// senden an Parent und weiterleitung an socket

	######################### Main Functions #######################################
	/*
	public function Power($Value) // STANDBY oder ON
	{
		if ($Value == false)
			{
				$Value = "STANDBY";
			}
		else
			{
				$Value = "ON";
			}
		
	 CSCK_SendText($id, "PW".$Value.chr(13));
	}
	*/
	
	public function PowerHTTP($Value) // STANDBY oder ON
	{
		if ($Value == false)
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutSystem_OnStandby%2FSTANDBY&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('Power'), $Value);
			}
		else
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutSystem_OnStandby%2FON&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('Power'), $Value);
			}
		
	}
	
	public function MainZonePowerHTTP($Value) // ON oder OFF
	{
		if ($Value == false)
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutZone_OnOff%2FOFF&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainZonePower'), $Value);
			}
		else
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutZone_OnOff%2FON&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainZonePower'), $Value);
			}
		
	}
	
	public function MasterVolume($Value) // "UP" or "DOWN"
	{
	 CSCK_SendText($id, "MV".$Value.chr(13));
	}
	
	public function MasterVolumeFix($Value) // Volume direct -80(db) bis 18(db)
	{
	 $Value= intval($Value) +80;
	 CSCK_SendText($id, "MV".$Value.chr(13));
	}
	
	public function MasterVolumeFixHTTP($Value) // Volume direct -80(db) bis 18(db)
	{
		file_get_contents("http://".$this->GetIPDenon()."MainZone/index.put.asp?cmd0=PutMasterVolumeSet%2F".$Value);
	}

	public function BassLevel($Value)
	{
		$Value = (intval($Value) +50);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSBAS ".$Value.chr(13));
	}

	public function LFELevel($Value)
	{
		$Value = (intval($Value) +10);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSLFE ".$Value.chr(13));
	}

	public function TrebleLevel($Value)
	{
		$Value = (intval($Value) +50);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSTRE ".$Value.chr(13));
	}

	public function ChannelVolume($Value) // setzen Korrekturlevel pro LS-Kanal
	{
	 CSCK_SendText($id, "CV".$Value.chr(13));
	}

	public function MainMute($Value) // "ON" or "OFF"
	{
	 CSCK_SendText($id, "MU".$Value.chr(13));
	}
	
	public function MainMuteHTTP($Value) // "ON" or "OFF"
	{
		if ($Value == false)
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutVolumeMute%2Foff&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainMute'), $Value);
			}
		else
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutVolumeMute%2Fon&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainMute'), $Value);
			}
	}

	public function Input($Value) // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	{
	 CSCK_SendText($id, "SI".$Value.chr(13));
	}

	public function MainZonePower($Value) // MainZone "ON" or "OFF"
	{
	  CSCK_SendText($id, "ZM".$Value.chr(13));
	}

	public function RecSelect($Value) //
	{
	 CSCK_SendText($id, "SR".$Value.chr(13)); // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	}

	public function SelectDecodeMode($Value) // AUTO; HDMI; DIGITAL; ANALOG
	{
	  CSCK_SendText($id, "SD".$Value.chr(13));
	}

	public function DecodeMode($Value) // Auto, PCM, DTS
	{
	 CSCK_SendText($id, "DC".$Value.chr(13));
	}

	public function VideoSelect($Value) // Video Select DVD/BD/TV/SAT_CBL/DVR/GAME/V.AUX/DOCK/SOURCE
	{
	 CSCK_SendText($id, "SV".$Value.chr(13));
	}

	public function SLEEP($Value) //
	{
		if ($Value == 0)
		{
			CSCK_SendText($id, "SLPOFF".chr(13));
		}
		ELSE
		{
		$Value = str_pad($Value, 3 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "SLP".$Value.chr(13));
		}
	}

	public function ModeSelect($Value) //
	{
	 CSCK_SendText($id, "MS".$Value.chr(13));
	}

	public function VideoSet($Value) //
	{
	 CSCK_SendText($id, "VS".$Value.chr(13));
	}

	public function ParaSettings($Value) // S
	{
	 CSCK_SendText($id, "PS".$Value.chr(13));
	}

	public function ParaVideo($Value) //
	{
	 CSCK_SendText($id, "PV".$Value.chr(13));
	}

	public function QuickSelect($Value) // 1-5
	{
	  CSCK_SendText($id, "MSQUICK".$Value.chr(13));
	}

	public function Preset($Value) //
	{
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "NSB".$Value.chr(13));
	}

	public function NSE_Request($id) // fragt NSE-Werte ab
	{
	  CSCK_SendText($id, "NSE".chr(13));
	}

	public function DynEQ($Value) // Dynamic Equilizer ON/OFF
	{
	  CSCK_SendText($id, "PSDYNEQ ".$Value.chr(13));
	}

	public function CinEQ($Value) // Cinema Equilizer ON/OFF
	{
	  CSCK_SendText($id, "PSCINEMA EQ.".$Value.chr(13));
	}
	public function MultiEQMode($Value) // MultiEquilizer AUDYSSEE/BYP.LR/FLAT/MANUELL/OFF
	{
	  CSCK_SendText($id, "PSMULTEQ:".$Value.chr(13));
	}

	public function DynVol($Value) // Dynamic Volume NGT(EVE/DAY
	{
	  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
	}

	public function AudioDelay($Value) // Audio Delay 0-200 ms
	{
		$Value = str_pad($Value, 3 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSDELAY ".$Value.chr(13));
	}

	public function Dimension($Value) // Audio Delay 0-200 ms
	{
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSDIM ".$Value.chr(13));
	}

	public function InputSource($Value) // Input Source
	{
	  CSCK_SendText($id, "SI".$Value.chr(13));
	}

	public function DynamicCompressor($Value) // Dynamic Compressor OFF/LOW/MID/HIGH
	{
	  CSCK_SendText($id, "PSDCO ".$Value.chr(13));
	}

	public function ToneDefeat($Value) // Tone Defeat (AVR3809) ON/OFF
	{
	  CSCK_SendText($id, "PSTONE DEFEAT ".$Value.chr(13));
	}

	public function ToneCTRL($Value) // Tone Control (AVR 3311) ON/OFF
	{
	  CSCK_SendText($id, "PSTONE CTRL ".$Value.chr(13));
	}

	public function AudioRestorer($Value) // Audio Restorer OFF/MODE1/MODE2/MODE3
	{
		switch ($Value)
		{
		   case 0:
			  $Value = "OFF";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

			case 1:
			  $Value = "MODE1";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

			case 2:
			  $Value = "MODE2";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

			case 3:
			  $Value = "MODE2";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

		}
	}

	public function DigitalInputMode($Value) // Digital Input Mode AUTO/PCM/DTS
	{
	  CSCK_SendText($id, "DC".$Value.chr(13));
	}

	public function InputMode($Value) // Input Mode AUTO/HDMI/DIGITALANALOG/ARC/NO
	{
	  CSCK_SendText($id, "SD".$Value.chr(13));
	}
	
	public function InputModeHTTP($Value) // Input Mode HTTP
	{
		switch ($Value)
		{
		   case 0:
			  //BD
			  file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutVolumeMute%2Foff&cmd1=aspMainZone_WebUpdateStatus%2F");
			break;

			case 1:
			  
			break;

			case 2:
			  
			break;

			case 3:
			  
			break;

		}
	}

	public function DynamicRange($Value) // DynamicRange
	{
	  CSCK_SendText($id, "PSDRC ".$Value.chr(13));
	}

	public function DynamicEQ($Value)
	{
	  CSCK_SendText($id, "PSDYNEQ ".$Value.chr(13));
	}

	public function DynamicVolume($Value)
	{
		switch ($Value)
			{
			   case 0:
				  $Value = "OFF";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

				case 1:
				  $Value = "NGT";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

				case 2:
				  $Value = "EVE";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

				case 3:
				  $Value = "DAY";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

			}
	}

	public function RoomSize($Value)
	{
		switch ($Value)
			{
			   case 0:
				  $Value = "N";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 1:
				  $Value = "S";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 2:
				  $Value = "MS";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 3:
				  $Value = "M";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 4:
				  $Value = "MS";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 5:
				  $Value = "L";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

			}
	}

	public function SurroundBackMode($Value)
	{
	  CSCK_SendText($id, "PSSB:".$Value.chr(13));
	}

	public function CWidth($Value)
	{
	  CSCK_SendText($id, "PSCEN ".$Value.chr(13));
	}

	public function SurroundMode($Value)
	{
	  CSCK_SendText($id, "MS".$Value.chr(13));
	}

	public function SurroundPlayMode($Value)
	{
	  CSCK_SendText($id, "PSMODE:".$Value.chr(13));
	}

	public function CinemaEQ($Value)
	{
	  CSCK_SendText($id, "PSCINEMA EQ.".$Value.chr(13));
	}

	public function Panorama($Value)
	{
	  CSCK_SendText($id, "PSPAN ".$Value.chr(13));
	}

	public function FrontHeight($Value)
	{
	  CSCK_SendText($id, "PSFH:".$Value.chr(13));
	}

	public function NSE_DisplayRequest()
	{
	  CSCK_SendText($id, "NSE".chr(13));
	}

	public function NSA_DisplayRequest()
	{
	  CSCK_SendText($id, "NSA".chr(13));
	}

	public function PresetRequest()
	{
	  CSCK_SendText($id, "NSH".chr(13));
	}

	public function ChannelVolumeFL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFL ".$Value.chr(13));
	}

	public function ChannelVolumeFR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFR ".$Value.chr(13));
	}

	public function ChannelVolumeC($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVC ".$Value.chr(13));
	}

	public function ChannelVolumeSW($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSW ".$Value.chr(13));
	}

	public function ChannelVolumeSL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSL ".$Value.chr(13));
	}

	public function ChannelVolumeSR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSR ".$Value.chr(13));
	}

	public function ChannelVolumeSBL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSBL ".$Value.chr(13));
	}

	public function ChannelVolumeSBR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSBR ".$Value.chr(13));
	}

	public function ChannelVolumeSB($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSB ".$Value.chr(13));
	}

	public function ChannelVolumeFHL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFHL ".$Value.chr(13));
	}

	public function ChannelVolumeFHR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFHR ".$Value.chr(13));
	}

	public function ChannelVolumeFWL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFWL ".$Value.chr(13));
	}

	public function ChannelVolumeFWR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFWR ".$Value.chr(13));
	}

	######################## Cursor Steuerung ######################################

	public function CursorUp()
	{
	  CSCK_SendText($id, "MNCUP".chr(13));
	}

	public function CursorDown()
	{
	  CSCK_SendText($id, "MNCDN".chr(13));
	}

	public function CursorLeft()
	{
	  CSCK_SendText($id, "MNCLT".chr(13));
	}

	public function CursorRight()
	{
	  CSCK_SendText($id, "MNCRT".chr(13));
	}

	public function Enter()
	{
	  CSCK_SendText($id, "MNENT".chr(13));
	}

	public function CursorReturn()
	{
	  CSCK_SendText($id, "MNRTN".chr(13));
	}


	######################## Zone 2 functions ######################################

	public function Z2_Volume($Value) // "UP" or "DOWN"
	{
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2VolumeFix($Value) // 18(db) bis -80(db)
	{
		$Value= intval($Value) +80;
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2Power($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2Mute($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z2MU".$Value.chr(13));
	}

	public function Zone2InputSource($Value) // PHONO ; DVD ; HDP ; "TV/CBL" ; SAT ; "NET/USB" ; DVR ; TUNER
	{
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2ChannelSetting($Value) // Zone 2 Channel Setting: STEREO/MONO
	{
		if ($Value == false)
					{
						$Value = "ST";
					}
					else
					{
						$Value = "MONO";
					}
		
		CSCK_SendText($id, "Z2CS".$Value.chr(13));
	}

	public function Zone2QuickSelect($Value) // Zone 2 Quickselect 1-5
	{
		$Value = $Value +1;
		CSCK_SendText($id, "Z2QUICK".$Value.chr(13));
	}

	public function Zone2ChannelVolumeFL($id)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z2CVFL ".$Value.chr(13));
	}

	public function Zone2ChannelVolumeFR($id)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z2CVFR ".$Value.chr(13));
	}

	########################## Zone 3 Functions ####################################

	public function Zone3Volume($Value) // "UP" or "DOWN"
	{
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3VolumeFix($Value) // 18(db) bis -80(db)
	{
		$Value= intval($Value) +80;
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3Power($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3Mute($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z3MU".$Value.chr(13));
	}

	public function Zone3InputSource($Value) // PHONO ; DVD ; HDP ; "TV/CBL" ; SAT ; "NET/USB" ; DVR
	{
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3ChannelSetting($Value) // Zone 3 Channel Setting: STEREO/MONO
	{
		if ($Value == false)
			{
				$Value = "ST";
			}
		else
			{
				$Value = "MONO";
			}
		
		CSCK_SendText($id, "Z3CS".$Value.chr(13));
	}

	public function Zone3QuickSelect($Value) // Zone 3 Quickselect 1-5
	{
	   $Value = $Value +1;
		CSCK_SendText($id, "Z3QUICK".$Value.chr(13));
	}

	public function Zone3ChannelVolumeFL($Value)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z3CVFL ".$Value.chr(13));
	}

	public function Zone3ChannelVolumeFR($Value)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z3CVFR ".$Value.chr(13));
	}

	/*
	################## Datapoints

    public function ReceiveData($JSONString)
    {
        $Data = json_decode($JSONString);
//IPS_LogMessage('ReceiveData',print_r($Data,true));
        if ($Data->DataID <> '{43E4B48E-2345-4A9A-B506-3E8E7A964757}')
            return false;
        try
        {
            $this->GetZone();
        } catch (Exception $ex)
        {
            unset($ex);
            return false;
        }


        $APIData = new ISCP_API_Data();
        $APIData->GetDataFromJSONObject($Data);
//        IPS_LogMessage('ReceiveAPIData1', print_r($APIData, true));

        if ($this->OnkyoZone->CmdAvaiable($APIData) === false)
        {
//            IPS_LogMessage('CmdAvaiable', 'false');

            if ($this->OnkyoZone->SubCmdAvaiable($APIData) === false)
            {
//                IPS_LogMessage('SubCmdAvaiable', 'false');
                return false;
            } else
            {
                $APIData->GetMapping();
                $APIData->APICommand = $APIData->APISubCommand->{$this->OnkyoZone->thisZone};
                IPS_LogMessage('APISubCommand', $APIData->APICommand);
            }
        } else
            $APIData->GetMapping();

//        IPS_LogMessage('ReceiveAPIData2', print_r($APIData, true));


        $this->ReceiveAPIData($APIData);
    }
	
	
	*/
	 		
	public function Send($payload)
		{
			$this->SendDataToParent(json_encode(Array("DataID" => "{DB1DDFAD-0DE9-47CF-B8E8-FB7E7425BF90}", "Buffer" => $payload))); //Denon AVR HTTP Interface GUI
		}
	
	public function SendCommand($payload)
		{
			$this->SendDataToParent(json_encode(Array("DataID" => "{DB1DDFAD-0DE9-47CF-B8E8-FB7E7425BF90}", "Buffer" => $payload))); //Denon AVR HTTP Interface GUI
		}
	
	// Daten vom Splitter Instanz
	public function ReceiveData($JSONString)
	{
	 
		// Empfangene Daten vom Splitter
		$data = json_decode($JSONString);
		//print_r($data->Buffer);
		//IPS_LogMessage("ReceiveData Denon HTTP", utf8_decode($data->Buffer));
		 
		// Hier werden die Daten verarbeitet und in Variablen geschrieben
		//SetValue($this->GetIDForIdent("Response"), $data->Buffer);
		//$this->UpdateVariable($data->Buffer);
	 		
	}
	
	// Wertet Response aus und setzt Variable
	private function UpdateVariable($data)
    {
        //PWSTANDBY
		/*
		$APIData = new DenonAVRCP_API_Data();
		$APIData->Data = $data;
		$SetCommandValue = $APIData->GetCommandResponse($APIData->Data);
        $Command = $SetCommandValue["Command"];
		$VarType = $SetCommandValue["VarType"];
		$Subcommand = $SetCommandValue["Subcommand"];
		$Subcommandvalue = $SetCommandValue["Subcommandvalue"];
		IPS_LogMessage("Update Denon", "Command(".$Command."), Typ: ".$VarType );
		*/
		//$Ident = str_replace(" ", "_", $Command); //Ident Leerzeichen von Command mit _ ersetzten
		//IPS_LogMessage("Update Denon", "ObjektID(".$Ident."));

		/*
        switch ($VarType)
        {
            case 0: //Boolean
                SetValueBoolean($this->GetIDForIdent($Ident), $Subcommandvalue);
                break;
            case 1: //Integer
                SetValueInteger($this->GetIDForIdent($Ident), $Subcommandvalue);
                break;
			case 2: //Float
                SetValueFloat($this->GetIDForIdent($Ident), $Subcommandvalue);
                break;     
            case 3: //String
                SetValueString($this->GetIDForIdent($Ident), $Subcommandvalue);
                break;
        }
		*/
    }
		
	################## DATAPOINTS PARENT
/*
    public function ReceiveData($JSONString)
    {
        $data = json_decode($JSONString);
        //IPS_LogMessage('ReceiveDataFrom???:'.$this->InstanceID,  print_r($data,1));
        $this->CheckParents();
        if ($this->Mode === false){
    trigger_error("Wrong IO-Parent",E_USER_WARNING);
//            echo "Wrong IO-Parent";
            return false;
        }
        $bufferID = $this->GetIDForIdent("BufferIN");
        // Empfangs Lock setzen
        if (!$this->lock("ReceiveLock"))
        {
            trigger_error("ReceiveBuffer is locked",E_USER_NOTICE);
            return false;

//            throw new Exception("ReceiveBuffer is locked",E_USER_NOTICE);
        }
        // Datenstream zusammenfügen
        $head = GetValueString($bufferID);
        SetValueString($bufferID, '');
        // Stream in einzelne Pakete schneiden
        $stream = $head . utf8_decode($data->Buffer);
        if ($this->Mode == ISCPSplitter::LAN)
        {
            $minTail = 24;

            $start = strpos($stream, 'ISCP');
            if ($start === false)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame without ISCP');
                $stream = '';
            }
            elseif ($start > 0)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame start not with ISCP');
                $stream = substr($stream, $start);
            }
            //Paket suchen
            if (strlen($stream) < $minTail)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame to short');
                SetValueString($bufferID, $stream);
                $this->unlock("ReceiveLock");
                return;
            }
            $header_len = ord($stream[6]) * 256 + ord($stream[7]);
            $frame_len = ord($stream[10]) * 256 + ord($stream[11]);
//             IPS_LogMessage('ISCP Gateway', 'LANFrame info ' . $header_len. '+'. $frame_len . ' Bytes.');            
            if (strlen($stream) < $header_len + $frame_len)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame must have ' . $header_len . '+' . $frame_len . ' Bytes. ' . strlen($stream) . ' Bytes given.');
                SetValueString($bufferID, $stream);
                $this->unlock("ReceiveLock");
                return;
            }
            $header = substr($stream, 0, $header_len);
            $frame = substr($stream, $header_len, $frame_len);
            //EOT wegschneiden von reschts, aber nur wenn es einer der letzten drei zeichen ist
            $end = strrpos($frame, chr(0x1A));
            if ($end >= $frame_len - 3)
                $frame = substr($frame, 0, $end);
            //EOT wegschneiden von reschts, aber nur wenn es einer der letzten drei zeichen ist
            $end = strrpos($frame, chr(0x0D));
            if ($end >= $frame_len - 3)
                $frame = substr($frame, 0, $end);
            //EOT wegschneiden von reschts, aber nur wenn es einer der letzten drei zeichen ist
            $end = strrpos($frame, chr(0x0A));
            if ($end >= $frame_len - 3)
                $frame = substr($frame, 0, $end);
//                IPS_LogMessage('ISCP Gateway', 'LAN $header:' . $header);
//                IPS_LogMessage('ISCP Gateway', 'LAN $frame:' . $frame);
// 49 53 43 50  // ISCP
// 00 00 00 10  // HEADERLEN
// 00 00 00 0B  // DATALEN
// 01 00 00 00  // Version
// 21 31 4E 4C  // !1NL
// 53 43 2D 50  // SC-P
// 1A 0D 0A     // EOT CR LF
            $tail = substr($stream, $header_len + $frame_len);
            if ($this->eISCPVersion <> ord($header[12]))
            {
                $frame = false;
                trigger_error("Wrong eISCP Version",E_USER_NOTICE);
            }
        }
        else
        {
            $minTail = 6;
            $start = strpos($stream, '!');
            if ($start === false)
            {
                IPS_LogMessage('ISCP Gateway', 'eISCP Frame without !');
                $stream = '';
            }
            elseif ($start > 0)
            {
                IPS_LogMessage('ISCP Gateway', 'eISCP Frame do not start with !');
                $stream = substr($stream, $start);
            }
            //Paket suchen
            $end = strpos($stream, chr(0x1A));
            if (($end === false) or ( strlen($stream) < $minTail)) // Kein EOT oder zu klein
            {
                IPS_LogMessage('ISCP Gateway', 'eISCP Frame to short');
                SetValueString($bufferID, $stream);
                $this->unlock("ReceiveLock");
                return;
            }
            $frame = substr($stream, $start, $end - $start);
            // Ende wieder in den Buffer werfen
            $tail = ltrim(substr($stream, $end));
        }
        if ($tail === false)
            $tail = '';
        SetValueString($bufferID, $tail);
        $this->unlock("ReceiveLock");
        if ($frame !== false)
            $this->DecodeData($frame);
        // Ende war länger als 6 / 23 ? Dann nochmal Packet suchen.
        if (strlen($tail) >= $minTail)
            $this->ReceiveData(json_encode(array('Buffer' => '')));
        return true;
    }
	*/
	
	

}

?>