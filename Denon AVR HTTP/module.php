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
		$this->RegisterPropertyBoolean("Navigation", false);
		$this->RegisterPropertyBoolean("ZoneName", false);
		
		$this->RegisterPropertyBoolean("Model", false);
		$this->RegisterPropertyBoolean("Z2CVFL", false);
		$this->RegisterPropertyBoolean("Z2CVFR", false);
		$this->RegisterPropertyBoolean("Z2HPF", false);
		$this->RegisterPropertyBoolean("Z2Sleep", false);
		$this->RegisterPropertyBoolean("Z2Channel", false);
		$this->RegisterPropertyBoolean("Z2Quick", false);
		$this->RegisterPropertyBoolean("Z3CVFL", false);
		$this->RegisterPropertyBoolean("Z3CVFR", false);
		$this->RegisterPropertyBoolean("Z3HPF", false);
		$this->RegisterPropertyBoolean("Z3Sleep", false);
		$this->RegisterPropertyBoolean("Z3Channel", false);
		$this->RegisterPropertyBoolean("Z3Quick", false);
		$this->RegisterPropertyBoolean("NEOToggle", false);
		$this->RegisterPropertyInteger("NEOToggleCategoryID", 0);
    }


    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();
		//$this->RegisterVariableString("BufferIN", "BufferIN", "", 1);
        //IPS_SetHidden($this->GetIDForIdent('BufferIN'), true);
		$this->ValidateConfiguration();
		
	}
		
	/**
    * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
    * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
    *
    */
	public 	$InputSources;
	
	private function ValidateConfiguration()
	{
		//Zone prüfen
		$Zone = $this->ReadPropertyInteger('Zone');
		
		//Import Kategorie NEO
		$vNEOToggle = $this->ReadPropertyBoolean('NEOToggle');
		if ($vNEOToggle)
		{
			$NEOCategoryID = $this->ReadPropertyInteger('NEOToggleCategoryID');
			if ( $NEOCategoryID === 0)
				{
					// Status Error Kategorie zum Import auswählen
					$this->SetStatus(211);
				}
			elseif ( $NEOCategoryID !== 0)	
				{
					// AktivStatus Error Kategorie zum Import auswählen
					$this->SetStatus(102);
				}
		}
		
		if ($Zone == 0) //Mainzone
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			//Type und Zone
			$DenonAVRVar->Type = $this->GetAVRType();
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
			$DenonAVRVar->ptFriendlyName = "DENON.".$DenonAVRVar->Type.".FriendlyName";
			$DenonAVRVar->ptMainZoneName = "DENON.".$DenonAVRVar->Type.".MainZoneName";
			$DenonAVRVar->ptTopMenuLink = "DENON.".$DenonAVRVar->Type.".TopMenuLink";
			$DenonAVRVar->ptModel = "DENON.".$DenonAVRVar->Type.".Model";
			
			
			//Variablen
			if ($this->GetIPDenon() !== false && $Zone !== 6)
			{
				$this->GetInputsAVR($DenonAVRVar);
			}
			else
			{
				$this->InputSources = false;
			}	
			
			//String
			$vString = array
				(
				$DenonAVRVar->ptFriendlyName => false,
				$DenonAVRVar->ptMainZoneName => $this->ReadPropertyBoolean('ZoneName'),
				$DenonAVRVar->ptTopMenuLink => false,
				$DenonAVRVar->ptModel => $this->ReadPropertyBoolean('Model')
				);
			
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
				$DenonAVRVar->ptSleep => false
				//$DenonAVRVar->ptSleep => $this->ReadPropertyBoolean('Sleep'),
				//$DenonAVRVar->ptDimension => $this->ReadPropertyBoolean('Dimension')
				);
			
			//Integer mit Association
			$vIntegerAss = array
				(
				 $DenonAVRVar->ptSurroundMode => true,
				 $DenonAVRVar->ptNavigation => $this->ReadPropertyBoolean('Navigation')
				 //$DenonAVRVar->ptInputSource => true
				 /*
				 
				 $DenonAVRVar->ptQuickSelect => $this->ReadPropertyBoolean('QuickSelect'),
				 $DenonAVRVar->ptDigitalInputMode => $this->ReadPropertyBoolean('DigitalInputMode'),
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
				
			$this->SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat, $vString);		
		}
		elseif ($Zone == 1) //Zone 2
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			$Type = $this->GetAVRType();
			//Type und Zone
			$DenonAVRVar->Type = $Type;
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptPower = 'DENON.'.$DenonAVRVar->Type.'.Power';
			$DenonAVRVar->ptZone2Power = 'DENON.'.$DenonAVRVar->Type.'.Zone2Power';
			$DenonAVRVar->ptZone2Mute = 'DENON.'.$DenonAVRVar->Type.'.Zone2Mute';
			$DenonAVRVar->ptZone2Volume = 'DENON.'.$DenonAVRVar->Type.'.Zone2Volume';
			$DenonAVRVar->ptZone2InputSource = 'DENON.'.$DenonAVRVar->Type.'.Zone2InputSource';
			$DenonAVRVar->ptZone2ChannelSetting = 'DENON.'.$DenonAVRVar->Type.'.Zone2ChannelSetting';
			$DenonAVRVar->ptZone2ChannelVolumeFL = 'DENON.'.$DenonAVRVar->Type.'.Zone2ChannelVolumeFL';
			$DenonAVRVar->ptZone2ChannelVolumeFR = 'DENON.'.$DenonAVRVar->Type.'.Zone2ChannelVolumeFR';
			$DenonAVRVar->ptZone2QuickSelect = 'DENON.'.$DenonAVRVar->Type.'.Zone2QuickSelect';
			$DenonAVRVar->ptZone2Name = "DENON.".$DenonAVRVar->Type.".Zone2Name";
			$DenonAVRVar->ptZone2Sleep = 'DENON.'.$DenonAVRVar->Type.'.Zone2Sleep';
			$DenonAVRVar->ptTopMenuLink = "DENON.".$DenonAVRVar->Type.".TopMenuLink";
			$DenonAVRVar->ptModel = "DENON.".$DenonAVRVar->Type.".Model";
			$DenonAVRVar->ptNavigation = "DENON.".$DenonAVRVar->Type.".Navigation";
			
			//Variablen
			if ($this->GetIPDenon() !== false && $Zone !== 6)
			{
				$this->GetInputsAVR($DenonAVRVar); 
			}
			else
			{
				$this->InputSources = false;
			}	
			
			//String
			$vString = array
				(
				$DenonAVRVar->ptZone2Name => $this->ReadPropertyBoolean('ZoneName'),
				//$DenonAVRVar->ptTopMenuLink => false,
				$DenonAVRVar->ptModel => $this->ReadPropertyBoolean('Model')
				);
			
			//Boolean
			$vBoolean = array
				(
				$DenonAVRVar->ptPower => true,
				$DenonAVRVar->ptZone2Power => true,
				$DenonAVRVar->ptZone2Mute => true,
				$DenonAVRVar->ptZone2HPF => $this->ReadPropertyBoolean('Z2HPF')
				);
				
			//Integer
			$vInteger = array
				(
				$DenonAVRVar->ptZone2Sleep => $this->ReadPropertyBoolean('Z2Sleep')
				);
			
			//Integer mit Association
			$vIntegerAss = array
				(
				 $DenonAVRVar->ptNavigation => $this->ReadPropertyBoolean('Navigation'),
				 $DenonAVRVar->ptZone2InputSource => true,
				 $DenonAVRVar->ptZone2ChannelSetting => $this->ReadPropertyBoolean('Z2Channel'),
				 $DenonAVRVar->ptZone2QuickSelect => $this->ReadPropertyBoolean('Z2Quick')
				);
				
			//Float
			$vFloat = array
				(
				//Lautsprecher
				$DenonAVRVar->ptZone2Volume => true,
				$DenonAVRVar->ptZone2ChannelVolumeFL => $this->ReadPropertyBoolean('Z2CVFL'),
				$DenonAVRVar->ptZone2ChannelVolumeFR => $this->ReadPropertyBoolean('Z2CVFR')
				);
			
			$this->SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat, $vString);
		}
		elseif ($Zone == 2) // Zone 3
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			$Type = $this->GetAVRType();
			//Type und Zone
			$DenonAVRVar->Type = $Type;
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptPower = 'DENON.'.$DenonAVRVar->Type.'.Power';
			$DenonAVRVar->ptZone3Power = 'DENON.'.$DenonAVRVar->Type.'.Zone3Power';
			$DenonAVRVar->ptZone3Mute = 'DENON.'.$DenonAVRVar->Type.'.Zone3Mute';
			$DenonAVRVar->ptZone3Volume = 'DENON.'.$DenonAVRVar->Type.'.Zone3Volume';
			$DenonAVRVar->ptZone3InputSource = 'DENON.'.$DenonAVRVar->Type.'.Zone3InputSource';
			$DenonAVRVar->ptZone3ChannelSetting = 'DENON.'.$DenonAVRVar->Type.'.Zone3ChannelSetting';
			$DenonAVRVar->ptZone3ChannelVolumeFL = 'DENON.'.$DenonAVRVar->Type.'.Zone3ChannelVolumeFL';
			$DenonAVRVar->ptZone3ChannelVolumeFR = 'DENON.'.$DenonAVRVar->Type.'.Zone3ChannelVolumeFR';
			$DenonAVRVar->ptZone3QuickSelect = 'DENON.'.$DenonAVRVar->Type.'.Zone3QuickSelect';
			$DenonAVRVar->ptZone3Name = "DENON.".$DenonAVRVar->Type.".Zone3Name";
			$DenonAVRVar->ptZone3Sleep = 'DENON.'.$DenonAVRVar->Type.'.Zone3Sleep';
			$DenonAVRVar->ptTopMenuLink = "DENON.".$DenonAVRVar->Type.".TopMenuLink";
			$DenonAVRVar->ptModel = "DENON.".$DenonAVRVar->Type.".Model";
			$DenonAVRVar->ptNavigation = "DENON.".$DenonAVRVar->Type.".Navigation";
			
			//Variablen
			if ($this->GetIPDenon() !== false && $Zone !== 6)
			{
				$this->GetInputsAVR($DenonAVRVar);
			}
			else
			{
				$this->InputSources = false;
			}					
			
			//String
			$vString = array
				(
				$DenonAVRVar->ptZone3Name => $this->ReadPropertyBoolean('ZoneName'),
				//$DenonAVRVar->ptTopMenuLink => false,
				$DenonAVRVar->ptModel => $this->ReadPropertyBoolean('Model')
				);
			
			//Boolean
			$vBoolean = array
				(
				$DenonAVRVar->ptPower => true,
				$DenonAVRVar->ptZone3Power => true,
				$DenonAVRVar->ptZone3Mute => true,
				$DenonAVRVar->ptZone3HPF => $this->ReadPropertyBoolean('Z3HPF')
				);
				
			//Integer
			$vInteger = array
				(
				$DenonAVRVar->ptZone3Sleep => $this->ReadPropertyBoolean('Z3Sleep')
				);
			
			//Integer mit Association
			$vIntegerAss = array
				(
				 $DenonAVRVar->ptNavigation => $this->ReadPropertyBoolean('Navigation'),
				 $DenonAVRVar->ptZone3InputSource => true,
				 $DenonAVRVar->ptZone3ChannelSetting => $this->ReadPropertyBoolean('Z3Channel'),
				 $DenonAVRVar->ptZone3QuickSelect => $this->ReadPropertyBoolean('Z3Quick')
				);
				
			//Float
			$vFloat = array
				(
				//Lautsprecher
				$DenonAVRVar->ptZone3Volume => true,
				$DenonAVRVar->ptZone3ChannelVolumeFL => $this->ReadPropertyBoolean('Z3CVFL'),
				$DenonAVRVar->ptZone3ChannelVolumeFR => $this->ReadPropertyBoolean('Z3CVFR')
				);
			
			$this->SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat, $vString);
		}
		
		
		
		
		//TestEmpfangspuffer
		/*
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
		*/	

		// Deaktiviert die Standardaktion der Statusvariablen
		if($this->ReadPropertyBoolean('ZoneName'))
			{
				if($this->ReadPropertyBoolean('Zone') == 0)
					{
						$this->DisableAction("MainZoneName");
					}
			
				if($this->ReadPropertyBoolean('Zone') == 1)
					{
						$this->DisableAction("Zone2Name");
					}
				
				if($this->ReadPropertyBoolean('Zone') == 2)
					{
						$this->DisableAction("Zone3Name");
					}
				
			}
		if($this->ReadPropertyBoolean('Model'))
			{
				$this->DisableAction("Model");
			}	
		
		//auf aktive Parent prüfen
		$this->HasActiveParent();		
			
			
	}
	
	private function GetInputsAVR($DenonAVRVar)
	{
		$DenonAVRVar->DenonIP = $this->GetIPDenon();
		$this->InputSources = $DenonAVRVar->GetInputSources($this->ReadPropertyInteger('Zone'), $DenonAVRVar->Type);
		$this->VarMappingInputs = $DenonAVRVar->GetInputVarmapping($this->ReadPropertyInteger("Zone"));
		//Input ablegen
		$MappingInputs = json_encode($this->VarMappingInputs);
		DAVRSH_SaveInputVarmapping($this->GetParent(), $MappingInputs, $DenonAVRVar->Type);
	}
	
	public function GetInputSources()
	{
		$DenonAVRUpdate = new DENONIPSProfiles;
		$DenonAVRUpdate->Zone = $this->ReadPropertyInteger('Zone');
		$DenonAVRUpdate->DenonIP = $this->GetIPDenon();
		$DenonAVRUpdate->Type = $this->GetAVRType();
		$DenonAVRUpdate->ptInputSource = 'DENON.'.$DenonAVRUpdate->Type.'.Inputsource';
		$DenonAVRUpdate->ptZone2InputSource = 'DENON.'.$DenonAVRUpdate->Type.'.Zone2InputSource';
		$DenonAVRUpdate->ptZone3InputSource = 'DENON.'.$DenonAVRUpdate->Type.'.Zone3InputSource';
		$InputSources = $DenonAVRUpdate->GetInputSources($this->ReadPropertyInteger('Zone'), $DenonAVRUpdate->Type);
		return $InputSources;
	}
	
	public function UpdateInputProfile()
	{
		$DenonAVRUpdate = new DENONIPSProfiles;
		$DenonAVRUpdate->Zone = $this->ReadPropertyInteger('Zone');
		$DenonAVRUpdate->DenonIP = $this->GetIPDenon();
		$DenonAVRUpdate->Type = $this->GetAVRType();
		$DenonAVRUpdate->ptInputSource = 'DENON.'.$DenonAVRUpdate->Type.'.Inputsource';
		$DenonAVRUpdate->ptZone2InputSource = 'DENON.'.$DenonAVRUpdate->Type.'.Zone2InputSource';
		$DenonAVRUpdate->ptZone3InputSource = 'DENON.'.$DenonAVRUpdate->Type.'.Zone3InputSource';
		$this->InputSources = $DenonAVRUpdate->GetInputSources($this->ReadPropertyInteger('Zone'), $DenonAVRUpdate->Type);
		
		//Inputs anlegen
		if($this->InputSources !== false)
		{
			if($DenonAVRUpdate->Zone == 0)
			{
				$inputsourcesprofile = $DenonAVRUpdate->SetupVarDenonIntegerAss($DenonAVRUpdate->ptInputSource);
			}
			elseif($DenonAVRUpdate->Zone == 1)
			{
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRUpdate->ptZone2InputSource);
			}
			elseif($DenonAVRUpdate->Zone == 2)
			{
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRUpdate->ptZone3InputSource);
			}
			
			$this->WriteUpdateProfileInputs($inputsourcesprofile["ProfilName"], $inputsourcesprofile["Icon"], $inputsourcesprofile["Prefix"], $inputsourcesprofile["Suffix"], $inputsourcesprofile["MinValue"], $inputsourcesprofile["MaxValue"], $inputsourcesprofile["Stepsize"], $inputsourcesprofile["Digits"], $inputsourcesprofile["Associations"]);
			IPS_LogMessage('Variablenprofil Update:', $inputsourcesprofile["ProfilName"]);
			IPS_SetVariableCustomProfile($this->GetIDForIdent("SI"), $DenonAVRUpdate->ptInputSource);
		}
		
		//Input ablegen
		$this->VarMappingInputs = $DenonAVRUpdate->GetInputVarmapping($this->ReadPropertyInteger("Zone"));
		$MappingInputs = json_encode($this->VarMappingInputs);
		DAVRSH_SaveInputVarmapping($this->GetParent(), $MappingInputs, $DenonAVRUpdate->Type);
	}
	
	protected function HasActiveParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);
		if ($instance['ConnectionID'] > 0)
        {
            $parent = IPS_GetInstance($instance['ConnectionID']);
            if ($parent['InstanceStatus'] == 102)
            {
                $this->SetStatus(102);
                return true;
            }
        }
        //$this->SetStatus(202);
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
				9 => "AVR-X7200",
				10 => "Marantz-NR1605",
				11 => "AVR-3808",
				12 => "AVR-X3000",
				13 => "AVR-X2100W",
				14 => "AVR-3312",
				15 => "AVR-2313");
		
		foreach($Types as $TypeID => $Type)
		{
			if($TypeID == $TypeInt)
			{
			   return $Type;
			}

		}		
	}
	
	private function SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat, $vString)
	{
		// Add/Remove according to feature activation
        // create link list for deletion of links if target is deleted
        $links = Array();
        foreach( IPS_GetLinkList() as $key=>$LinkID ){
            $links[] =  Array( ('LinkID') => $LinkID, ('TargetID') =>  IPS_GetLink($LinkID)['TargetID'] );
        }
		
		//Inputs anlegen
		if($this->InputSources !== false)
		{
			if($DenonAVRVar->Zone == 0)
			{
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRVar->ptInputSource);
			}
			elseif($DenonAVRVar->Zone == 1)
			{
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRVar->ptZone2InputSource);
			}
			elseif($DenonAVRVar->Zone == 2)
			{
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRVar->ptZone3InputSource);
			}
			
			$this->RegisterProfileIntegerDenonAss($inputsourcesprofile["ProfilName"], $inputsourcesprofile["Icon"], $inputsourcesprofile["Prefix"], $inputsourcesprofile["Suffix"], $inputsourcesprofile["MinValue"], $inputsourcesprofile["MaxValue"], $inputsourcesprofile["Stepsize"], $inputsourcesprofile["Digits"], $inputsourcesprofile["Associations"]);
			IPS_LogMessage('Variablenprofil angelegt:', $inputsourcesprofile["ProfilName"]);
			$id = $this->RegisterVariableInteger($inputsourcesprofile["Ident"], $inputsourcesprofile["Name"], $inputsourcesprofile["ProfilName"], $inputsourcesprofile["Position"]);
			IPS_LogMessage('Variable angelegt:', $inputsourcesprofile["Name"].', [ObjektID: '.$id.']');
			$this->EnableAction($inputsourcesprofile["Ident"]);
		}
		
		
		//Sichtbare Variablen anlegen
		foreach ($vString as $ptString => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonString($ptString);
				//Ident, Name, Profile, Position
				$this->RegisterProfileStringDenon($profile["ProfilName"], $profile["Icon"]);		
				$id = $this->RegisterVariableString ($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
			}	
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				 $profile = $DenonAVRVar->SetupVarDenonString($ptString);
				 $this->removeVariableAction($profile["Ident"], $links, $ptString); 
			}
		}
		
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
				//NEO Toggle Skript anlegen
				if ($this->ReadPropertyBoolean('NEOToggle'))
				{
					$this->NEOToggle($id);
				}
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
	
	
	public function RequestAction($Ident, $Value)
    {
        //Type und Zone
		$Type = $this->ReadPropertyInteger('Type');
		$Zone = $this->ReadPropertyInteger('Zone');
		
		
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
				
		$APIDataHTTP = new DenonAVRCP_API_Data();
		$APIDataHTTP->APIIdent = $Ident;
        $APIDataHTTP->Data = $Value;
		$APIDataHTTP->AVRType = $this->GetAVRType();
		$APIDataHTTP->AVRZone = $this->ReadPropertyInteger('Zone');
		//Input übergeben
		$APIDataHTTP->InputMapping = DAVRSH_GetInputVarMapping($this->GetParent());
        //Prüfen ob Command vorhanden
		/*
		if (!$this->DenonZone->CmdAvaiable($APIDataHTTP))
        {
//            trigger_error("Illegal Command in this Zone.", E_USER_WARNING);
            echo "Illegal Command in this Zone";
            return false;
        }
		*/
		
        // Subcommand holen
        $APIDataHTTP->APISubCommand = $APIDataHTTP->GetSubCommand($APIDataHTTP->APIIdent, $APIDataHTTP->Data, $APIDataHTTP->InputMapping);
        IPS_LogMessage('Denon Subcommand', $APIDataHTTP->APISubCommand);
        // Daten senden        Rückgabe ist egal, Variable wird automatisch durch Datenempfang nachgeführt
        try
        {
            //Command aus Ident
			$APIDataHTTP->APICommand = str_replace("_", " ", $Ident); //Ident _ von Ident mit Leerzeichen ersetzten
			if($Ident == "Z2POWER" || $Ident == "Z2INPUT" || $Ident == "Z2VOL")
			{
				$APIDataHTTP->APICommand = "Z2";
			}		
			elseif($Ident == "Z3POWER" || $Ident == "Z3INPUT" || $Ident == "Z3VOL")
			{
				$APIDataHTTP->APICommand = "Z3";
			}
			$payload = $APIDataHTTP->APICommand.$APIDataHTTP->APISubCommand;		
			$this->SendCommand($payload);
			//$this->SendAPIData($APIDataHTTP);
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
		
    }
	
			
	protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);//array
		return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;//ConnectionID
    }
	
		
	//IP Denon 
	protected function GetIPDenon()
	{	
		if ($this->HasActiveParent())
		{
			$ParentID = $this->GetParent();	
			$IPDenon = IPS_GetProperty($ParentID, 'Host');
			if (!filter_var($IPDenon, FILTER_VALIDATE_IP) === false)
			{
				return $IPDenon;
			}
			else
			{
				return false;
			}
		}
		
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
	
	protected function WriteUpdateProfileInputs($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Digits, $Associations)
	{
		if ( sizeof($Associations) === 0 ){
            $MinValue = 0;
            $MaxValue = 0;
        } else {
            $MinValue = $Associations[0][0];
            $MaxValue = $Associations[sizeof($Associations)-1][0];
        }
        
		if(!IPS_VariableProfileExists($Name))
			{
            IPS_CreateVariableProfile($Name, 1);
			}
		elseif(IPS_VariableProfileExists($Name))
			{
				IPS_DeleteVariableProfile($Name);
				IPS_CreateVariableProfile($Name, 1);
			}
		else
			{
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 1)
            throw new Exception("Variable profile type does not match for profile ".$Name);
			}
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
		IPS_SetVariableProfileDigits($Name, $Digits); //  Nachkommastellen
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $Stepsize);
        
        foreach($Associations as $Association) {
            IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
        }
	}
	
	//protected function RegisterProfileStringDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize)
	protected function RegisterProfileStringDenon($Name, $Icon)
	{
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 3);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 3)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        //IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        //IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	protected function RegisterProfileFloatDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits)
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
		IPS_SetVariableProfileDigits($Name, $Digits); //  Nachkommastellen
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	//Data Transfer
	public function SendCommand($payload)
		{
			$this->SendDataToParent(json_encode(Array("DataID" => "{DB1DDFAD-0DE9-47CF-B8E8-FB7E7425BF90}", "Buffer" => $payload))); //Denon AVR HTTP Interface GUI
		}
	
	//Denon Commands
	//Power
	public function Power(boolean $Value) // false (Standby) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::PWSTANDBY;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::PWON;
			}
		$payload = DENON_API_Commands::PW.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Mainzone Power
	public function MainZonePower(boolean $Value) // false (Off) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::ZMOFF;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::ZMON;
			}
		$payload = DENON_API_Commands::ZM.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Zone 2 Power
	public function Zone2Power(boolean $Value) // false (Off) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::Z2OFF;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::Z2ON;
			}
		$payload = DENON_API_Commands::Z2.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Zone 3 Power
	public function Zone3Power(boolean $Value) // false (Off) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::Z3OFF;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::Z3ON;
			}
		$payload = DENON_API_Commands::Z3.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Master Volume Up/Down
	public function MasterVolume(string $Subcommand) // "UP" or "DOWN"
	{
		$payload = DENON_API_Commands::MV.$Subcommand;
		$this->SendCommand($payload);
	}
	
	//Main Mute
	public function MainMute(boolean $Value) // false (Off) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::MUOFF;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::MUON;
			}
		$payload = DENON_API_Commands::MU.$Subcommand;
		$this->SendCommand($payload);
	}
	
	//Zone2 Mute
	public function Zone2Mute(boolean $Value) // false (Off) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::Z2OFF;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::Z2ON;
			}
		$payload = DENON_API_Commands::Z2MU.$Subcommand;
		$this->SendCommand($payload);
	}
	
	//Zone3 Mute
	public function Zone3Mute(boolean $Value) // false (Off) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::Z3OFF;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::Z3ON;
			}
		$payload = DENON_API_Commands::Z3MU.$Subcommand;
		$this->SendCommand($payload);
	}
	
	//Send HTTP Command
	public function SendHTTPCommand(string $Command) // Beliebiges Command
	{
		$payload = $Command;
		$this->SendCommand($payload);
	}

	
 		
	
	
	// Daten vom Splitter Instanz
	public function ReceiveData($JSONString)
	{
	 
		// Empfangene Daten vom Splitter
		$data = json_decode($JSONString);
		//$datasplitter = json_encode($data->Buffer);
		//SetValueString($this->GetIDForIdent("BufferIN"), $datasplitter);		
		$this->UpdateVariable($data->Buffer);
	 		
	}
	
	// Wertet Response aus und setzt Variable
	private function UpdateVariable($data)
    {
		$ResponseType = $data->ResponseType;
		$Zonedata = $data->Data;
		$Zone = $this->ReadPropertyInteger('Zone');
		if($Zone == 0)
		{
			$datavalues = $Zonedata->Mainzone;
		}
		elseif($Zone == 1)
		{
			$datavalues = $Zonedata->Zone2;
		}
		elseif($Zone == 2)
		{
			$datavalues = $Zonedata->Zone3;
		}
	   //if($ResponseType == "HTTP")
	   //{
			
			foreach($datavalues as $Ident => $Values)
			{
				$Ident = str_replace(" ", "_", $Ident); //Ident Leerzeichen von Command mit _ ersetzten
				$Subcommand = $Values->Subcommand;
				$VarType = $Values->VarType;
				$Subcommandvalue = $Values->Value;
				$VarID = @$this->GetIDForIdent($Ident); 
				if ($VarID > 0) 
				{ 
					switch ($VarType)
					{
						case 0: //Boolean
							SetValueBoolean($this->GetIDForIdent($Ident), $Subcommandvalue);
							IPS_LogMessage("Update Denon", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							break;
						case 1: //Integer
							SetValueInteger($this->GetIDForIdent($Ident), $Subcommandvalue);
							IPS_LogMessage("Update Denon", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							break;
						case 2: //Float
							SetValueFloat($this->GetIDForIdent($Ident), $Subcommandvalue);
							IPS_LogMessage("Update Denon", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							break;     
						case 3: //String
							SetValueString($this->GetIDForIdent($Ident), $Subcommandvalue);
							IPS_LogMessage("Update Denon", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							break;
					}	
				}
				else
				{ 
				// nicht vorhanden 
				}  
			} 
		//}	
    }
	
	############################ NEO Toggle Workarround ##############################################
	
	public function NEOToggle($ObjektID)
	{
		$Ident = IPS_GetObject ($ObjektID)["ObjectIdent"];
		$InstanzID = IPS_GetParent($ObjektID);
		$ParentID = IPS_GetParent($InstanzID);
		$InstanzName = IPS_GetName($InstanzID);
		$Name = IPS_GetName($ObjektID);
		$KatID = $this->ReadPropertyInteger('NEOToggleCategoryID');
		$ScriptName = $InstanzName." ".$Name."_toggle";
		$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
		if ($Ident == "PW")
		{
			if ($SkriptID === false)
			{
            	$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRH_Power('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Power einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRH_Power('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Standby schalten" );
	}

?>';
				$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
				return $ScriptID;
			}
		}
		
		if ($Ident == "ZM")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRH_MainZonePower('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "MainZonePower einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRH_MainZonePower('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "MainZonePower ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "MU")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRH_MainMute('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Mute einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRH_MainMute('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Mute ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "Z2POWER")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRH_Zone2Power('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Zone2Power einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRH_Zone2Power('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Zone2Power ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "Z3POWER")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRH_Zone3Power('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Zone3Power einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRH_Zone3Power('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Zone3Power ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "Z2MU")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRH_Zone2Mute('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Zone 2 Mute einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRH_Zone2Mute('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Zone 2 Mute ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "Z3MU")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRH_Zone3Mute('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Zone 3 Mute einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRH_Zone3Mute('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Zone 3 Mute ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
	}
	
	protected function WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content)
	{
		$ScriptID = IPS_CreateScript(0);
		IPS_SetName($ScriptID, $ScriptName);
		IPS_SetParent($ScriptID, $KatID);
		IPS_SetScriptContent($ScriptID, $Content);
		return $ScriptID;
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