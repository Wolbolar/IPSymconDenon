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
	
	public function UpdateInputProfile()
	{
		$DenonAVRUpdate = new DENONIPSProfiles;
		$DenonAVRUpdate->Zone = $this->ReadPropertyInteger('Zone');
		$DenonAVRUpdate->DenonIP = $this->GetIPDenon();
		$DenonAVRUpdate->Type = $this->GetAVRType();
		$DenonAVRUpdate->ptInputSource = 'DENON.'.$DenonAVRUpdate->Type.'.Inputsource';
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
				13 => "AVR-2100W",
				14 => "AVR-3312");
		
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
		//Input übergeben
		$APIData->InputMapping = DAVRSH_GetInputVarMapping($this->GetParent());
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
        $APIDataHTTP->APISubCommand = $APIDataHTTP->GetSubCommand($APIDataHTTP->APIIdent, $APIDataHTTP->Data, $APIData->InputMapping);
        IPS_LogMessage('Denon Subcommand', $APIDataHTTP->APISubCommand);
        // Daten senden        Rückgabe ist egal, Variable wird automatisch durch Datenempfang nachgeführt
        try
        {
            //Command aus Ident
			$APIDataHTTP->APICommand = str_replace("_", " ", $Ident); //Ident _ von Ident mit Lerrezeichen ersetzten
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
				$subcommand = DENON_API_Commands::STANDBY;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::ON;
			}
		$payload = DENON_API_Commands::PW.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Mainzone Power
	public function MainZonePower(boolean $Value) // false (Off) oder true (On)
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::OFF;
				
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::ON;
			}
		$payload = DENON_API_Commands::ZM.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Master Volume Up/Down
	public function MasterVolume(string $Subcommand) // "UP" or "DOWN"
	{
		$payload = DENON_API_Commands::MV.$Subcommand;
		$this->SendCommand($payload);
	}
	
	//Main Mute
	public function MainMute(string $Subcommand) // "ON" or "OFF"
	{
		$payload = DENON_API_Commands::MU.$Subcommand;
		$this->SendCommand($payload);
	}
	
	

	############################ Info ##############################################
	
		
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

	public function Input($Value) // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	{
	 CSCK_SendText($id, "SI".$Value.chr(13));
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