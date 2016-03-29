<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonAVRTelnet extends IPSModule
{

   
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // 1. Verfügbarer DenonSplitter wird verbunden oder neu erzeugt, wenn nicht vorhanden.
        $this->ConnectParent("{9AE3087F-DC25-4ADB-AB46-AD7455E71032}");
		
		$this->RegisterPropertyInteger("Type", 0);
		$this->RegisterPropertyInteger("Zone", 6);
		//$this->RegisterPropertyBoolean("Display", false);
		$this->RegisterPropertyBoolean("Navigation", false);
		$this->RegisterPropertyBoolean("ZoneName", false);
		$this->RegisterPropertyBoolean("FL", false);
		$this->RegisterPropertyBoolean("FR", false);
		$this->RegisterPropertyBoolean("C", false);
		$this->RegisterPropertyBoolean("SW", false);
		$this->RegisterPropertyBoolean("SW2", false);
		$this->RegisterPropertyBoolean("SL", false);
		$this->RegisterPropertyBoolean("SR", false);
		$this->RegisterPropertyBoolean("SBL", false);
		$this->RegisterPropertyBoolean("SBR", false);
		$this->RegisterPropertyBoolean("SB", false);
		$this->RegisterPropertyBoolean("FHL", false);
		$this->RegisterPropertyBoolean("FHR", false);
		$this->RegisterPropertyBoolean("FWL", false);
		$this->RegisterPropertyBoolean("FWR", false);
		$this->RegisterPropertyBoolean('CinemaEQ', false);
		$this->RegisterPropertyBoolean('Panorama', false);
		$this->RegisterPropertyBoolean('FrontHeight', false);
		$this->RegisterPropertyBoolean('ToneCTRL', false);
		$this->RegisterPropertyBoolean('DynamicEQ', false);
		$this->RegisterPropertyBoolean('AudioDelay', false);
		$this->RegisterPropertyBoolean('LFELevel', false);
		$this->RegisterPropertyBoolean('QuickSelect', false);
		$this->RegisterPropertyBoolean('Sleep', false);
		$this->RegisterPropertyBoolean('DigitalInputMode', false);
		$this->RegisterPropertyBoolean('SurroundMode', false);
		$this->RegisterPropertyBoolean('SurroundPlayMode', false);
		$this->RegisterPropertyBoolean('MultiEQMode', false);
		$this->RegisterPropertyBoolean('AudioRestorer', false);
		$this->RegisterPropertyBoolean('BassLevel', false);
		$this->RegisterPropertyBoolean('TrebleLevel', false);
		$this->RegisterPropertyBoolean('Dimension', false);
		$this->RegisterPropertyBoolean('DynamicVolume', false);
		$this->RegisterPropertyBoolean('RoomSize', false);
		$this->RegisterPropertyBoolean('DynamicCompressor', false);
		$this->RegisterPropertyBoolean('CenterWidth', false);
		$this->RegisterPropertyBoolean('DynamicRange', false);
		$this->RegisterPropertyBoolean('VideoSelect', false);
		$this->RegisterPropertyBoolean('SurroundBackMode', false);
		$this->RegisterPropertyBoolean('Inputmode', false);
		$this->RegisterPropertyBoolean('Contrast', false);
		$this->RegisterPropertyBoolean('Brightness', false);
		$this->RegisterPropertyBoolean('Chromalevel', false);
		$this->RegisterPropertyBoolean('Hue', false);
		$this->RegisterPropertyBoolean('Enhancer', false);
		$this->RegisterPropertyBoolean('Subwoofer', false);
		$this->RegisterPropertyBoolean('SubwooferATT', false);
		$this->RegisterPropertyBoolean('DNRDirectChange', false);
		$this->RegisterPropertyBoolean('Effect', false);
		$this->RegisterPropertyBoolean('AFDM', false);
		$this->RegisterPropertyBoolean('EffectLevel', false);
		$this->RegisterPropertyBoolean('CenterImage', false);
		$this->RegisterPropertyBoolean('StageWidth', false);
		$this->RegisterPropertyBoolean('StageHeight', false);
		$this->RegisterPropertyBoolean('AudysseyDSX', false);
		$this->RegisterPropertyBoolean('ReferenceLevel', false);
		$this->RegisterPropertyBoolean('DRCDirectChange', false);
		$this->RegisterPropertyBoolean('SpeakerOutputFront', false);
		$this->RegisterPropertyBoolean('DCOMPDirectChange', false);
		$this->RegisterPropertyBoolean('HDMIMonitor', false);
		$this->RegisterPropertyBoolean('ASP', false);
		$this->RegisterPropertyBoolean('Resolution', false);
		$this->RegisterPropertyBoolean('ResolutionHDMI', false);
		$this->RegisterPropertyBoolean('HDMIAudioOutput', false);
		$this->RegisterPropertyBoolean('VideoProcessingMode', false);
		$this->RegisterPropertyBoolean('DolbyVolumeLeveler', false);
		$this->RegisterPropertyBoolean('DolbyVolumeModeler', false);
		$this->RegisterPropertyBoolean('PLIIZHeightGain', false);
		$this->RegisterPropertyBoolean('VerticalStretch', false);
		$this->RegisterPropertyBoolean('DolbyVolume', false);
		

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

	public 	$InputSources;
	
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
			$DenonAVRVar->ptFriendlyName = "DENON.".$DenonAVRVar->Type.".FriendlyName";
			$DenonAVRVar->ptMainZoneName = "DENON.".$DenonAVRVar->Type.".MainZoneName";
			$DenonAVRVar->ptTopMenuLink = "DENON.".$DenonAVRVar->Type.".TopMenuLink";
			$DenonAVRVar->ptModel = "DENON.".$DenonAVRVar->Type.".Model";
			
			

	
			
			//Variablen
			if ($this->GetIPDenon() !== false && $Zone !== 6)
			{
				$DenonAVRVar->DenonIP = $this->GetIPDenon();
				$this->InputSources = $DenonAVRVar->GetInputSources($this->ReadPropertyInteger('Zone'));
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
				$DenonAVRVar->ptModel => true
				);
			
			//Boolean
			$vBoolean = array
				(
				$DenonAVRVar->ptPower => true,
				$DenonAVRVar->ptMainZonePower => true,
				$DenonAVRVar->ptMainMute => true,
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
				);
				
			//Integer
			$vInteger = array
				(
				$DenonAVRVar->ptSleep => $this->ReadPropertyBoolean('Sleep'),
				$DenonAVRVar->ptDimension => $this->ReadPropertyBoolean('Dimension')
				);
			
			//Integer mit Association
			$vIntegerAss = array
				(
				 //$DenonAVRVar->ptInputSource => true,
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
				);
				
			//Float
			$vFloat = array
				(
				//Lautsprecher
				$DenonAVRVar->ptMasterVolume => true,
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
			
			//Variablen
			if ($this->GetIPDenon() !== false && $Zone !== 6)
			{
				$DenonAVRVar->DenonIP = $this->GetIPDenon();
				$this->InputSources = $DenonAVRVar->GetInputSources($this->ReadPropertyInteger('Zone'));
			}
			else
			{
				$this->InputSources = false;
			}	
			
			//String
			$vString = array
				(
				$DenonAVRVar->ptFriendlyName => false,
				$DenonAVRVar->ptZone2Name => $this->ReadPropertyBoolean('ZoneName'),
				$DenonAVRVar->ptTopMenuLink => false,
				$DenonAVRVar->ptModel => true
				);
			
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
				$DenonAVRVar->ptZone2Sleep => true
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
			
			//Variablen
			if ($this->GetIPDenon() !== false && $Zone !== 6)
			{
				$DenonAVRVar->DenonIP = $this->GetIPDenon();
				$this->InputSources = $DenonAVRVar->GetInputSources($this->ReadPropertyInteger('Zone'));
			}
			else
			{
				$this->InputSources = false;
			}		
	
			//String
			$vString = array
				(
				$DenonAVRVar->ptFriendlyName => false,
				$DenonAVRVar->ptZone3Name => $this->ReadPropertyBoolean('ZoneName'),
				$DenonAVRVar->ptTopMenuLink => false,
				$DenonAVRVar->ptModel => true
				);
			
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
				$DenonAVRVar->ptZone3Sleep => true
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
			
			$this->SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat, $vString);
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
			$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRVar->ptInputSource);
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
	
	protected function SetupDisplay($Type)
	{	
		$this->RegisterVariableString("Display", "Display", "~HTMLBox", 32);
		$this->EnableAction("Display");
		// Status aktiv
		//$this->SetStatus(102);
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
		
	
	public function GetStates()
	{
		$states  = array ();
		foreach ($states as $command => $value)
		{
			$this->SendCommand($payload);
		}
		
		
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
		
		
		$APIData = new DenonAVRCP_API_Data();
		$APIData->APIIdent = $Ident;
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
        $APIData->APISubCommand = $APIData->GetSubCommand($APIData->APIIdent, $APIData->Data);
        IPS_LogMessage('Denon Subcommand', $APIData->APISubCommand);
        // Daten senden        Rückgabe ist egal, Variable wird automatisch durch Datenempfang nachgeführt
        try
        {
            //Command aus Ident
			$APIData->APICommand = str_replace("_", " ", $Ident);
			if($Ident == "Z2POWER" || $Ident == "Z2INPUT" || $Ident == "Z2VOL")
			{
				$APIData->APICommand = "Z2";
			}		
			elseif($Ident == "Z3POWER" || $Ident == "Z3INPUT" || $Ident == "Z3VOL")
			{
				$APIData->APICommand = "Z3";
			}
			
			$payload = $APIData->APICommand.$APIData->APISubCommand.chr(13);
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
	
	// Wertet Response aus und setzt Variable
	private function UpdateVariable($data)
    {
		$ResponseType = $data->ResponseType;
		//if($ResponseType == "HTTP")
		//{
			$datavalues = $data->Data;
			foreach($datavalues as $Ident => $Values)
			{
				$Ident = str_replace(" ", "_", $Ident); //Ident Leerzeichen von Command mit _ ersetzten
				$Subcommand = $Values->Subcommand;
				$VarType = $Values->VarType;
				$Subcommandvalue = $Values->Value;
				if($this->GetIDForIdent($Ident) !== false)
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
				
			}
		/*
		}
		elseif($ResponseType == "TELNET")
		{
			
		}
		*/
    }
	
	protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);//array
		return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;//ConnectionID
    }
	
	//Data Transfer
	public function SendCommand($payload)
		{
			$this->SendDataToParent(json_encode(Array("DataID" => "{01A68655-DDAF-4F79-9F35-65878A86F344}", "Buffer" => $payload))); //Denon AVR Telnet Interface GUI
		}
	
	// Daten vom Splitter Instanz
	public function ReceiveData($JSONString)
	{
	 
		// Empfangene Daten vom Splitter
		$data = json_decode($JSONString);
		IPS_LogMessage("ReceiveData Denon Telnet", utf8_decode($data->Buffer));
	 
		// Hier werden die Daten verarbeitet und in Variablen geschrieben
		//SetValue($this->GetIDForIdent("Response"), $data->Buffer);
		$this->UpdateVariable($data->Buffer);
	 
	}	

	
	//IP Denon 
	protected function GetIPDenon(){
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
	
	 protected function GetVariable($Ident, $VarType, $VarName, $Profile, $EnableAction)
    {
        $VarID = @$this->GetIDForIdent($Ident);
        if ($VarID > 0)
        {
            if (IPS_GetVariable($VarID)['VariableType'] <> $VarType)
            {
                IPS_DeleteVariable($VarID);
                $VarID = false;
            }
        }
        if ($VarID === false)
        {
            $this->MaintainVariable($Ident, $VarName, $VarType, $Profile, 0, true);
            if ($EnableAction)
                $this->MaintainAction($Ident, true);
            $VarID = $this->GetIDForIdent($Ident);
        }
        return $VarID;
    }
	
	//Get Status HTTP 
	public function GetStateHTTP()
	{
		$DenonGet = new DENON_StatusHTML;
		$DenonGet->ipdenon = $this->GetIPDenon();
		$state = $DenonGet->getStates (0);
		return $state;
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
        
		//boolean IPS_SetVariableProfileAssociation ( string $ProfilName, float $Wert, string $Name, string $Icon, integer $Farbe )
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

	
	private function SendAPIData(DenonAVRCP_API_Data $APIData)
    {
        $ret = $this->Send($APIData);
		/*
		$DualType = substr($APIData->APICommand, 3, 1);
        $APIData->APICommand = substr($APIData->APICommand, 0, 3);
        if ($APIData->Mapping === null)
            $APIData->GetMapping();

        IPS_LogMessage('SendAPIData', print_r($APIData, 1));

        // Variable konvertieren..        
        switch ($APIData->Mapping->VarType)
        {
            case IPSVarType::vtBoolean:
                $APIData->Data = ISCP_API_Commands::$BoolValueMapping[$APIData->Data];
                break;
            case IPSVarType::vtFloat:
//                echo "Float VarType not implemented.";

                throw new Exception("Float VarType not implemented.", E_USER_NOTICE);
                break;
            case IPSVarType::vtInteger:
                if ($APIData->Mapping->ValueMapping == null)
                    $APIData->Data = strtoupper(substr('0' . dechex($APIData->Data), -2));
                else
                {
                    $Mapping = array_flip($APIData->Mapping->ValueMapping);
                    if (array_key_exists($APIData->Data, $Mapping))
                        $APIData->Data = $Mapping[$APIData->Data];
                    else
                        $APIData->Data = strtoupper(substr('0' . dechex($APIData->Data), -2));
                }
                break;
            case IPSVarType::vtDualInteger:
                if ($DualType === false)
                {
                    throw new Exception("Error on get DualInteger.", E_USER_NOTICE);
//                    echo "Error on get DualInteger.";
//                    return false;
                }
                $Prefix = array_flip($APIData->Mapping->ValuePrefix)[$DualType];
                $Mapping = array_flip($APIData->Mapping->ValueMapping);
                if (array_key_exists($APIData->Data, $Mapping))
                    $APIData->Data = $Prefix . $Mapping[$APIData->Data];
                else
                    $APIData->Data = strtoupper($Prefix . substr('0' . dechex($APIData->Data), -2));
                break;
            default:
//                echo "Unknow VarType.";
//                return;
                throw new Exception("Unknow VarType.", E_USER_NOTICE);
                break;
        }
        try
        {
            $ret = $this->Send($APIData);
        } catch (Exception $exc)
        {
            throw $exc;
        }

        if ($ret->Data == "N/A")
        {
            throw new Exception("Command (temporally) not available.", E_USER_NOTICE);
//            return;
        }
        switch ($APIData->Mapping->VarType)
        {
            case IPSVarType::vtBoolean:
            case IPSVarType::vtInteger:
            case IPSVarType::vtFloat:
                if ($ret->Data <> $APIData->Data)
                {
                    IPS_LogMessage('RequestAction', print_r($APIData, 1));
                    IPS_LogMessage('RequestActionResult', print_r($ret, 1));
                    throw new Exception("Value not available.", E_USER_NOTICE);
//                    echo "Value not available.";
//                    return;
                }
                break;
            case IPSVarType::vtDualInteger:
                if (strpos($ret->Data, $APIData->Data) === false)
                {
                    IPS_LogMessage('RequestAction', print_r($APIData, 1));
                    IPS_LogMessage('RequestActionResult', print_r($ret, 1));
                    throw new Exception("Value not available.", E_USER_NOTICE);
//                    echo "Value not available.";
//                    return;
                }
                break;
        }

        return $ret;
		*/
    }

    //private function Send(DenonAVRCP_API_Data $APIData, $needResponse = true)
	private function Send(DenonAVRCP_API_Data $APIData)
    {
        //Validate
		/*
		if (!$this->DenonZone->CmdAvaiable($APIData))
            throw new Exception("Command not available at this Zone.", E_USER_NOTICE);
        if (!$this->HasActiveParent())
            throw new Exception("Instance has no active Parent.", E_USER_NOTICE);

        $ReplyAPIDataID = $this->GetIDForIdent('ReplyAPIData');
        if (!$this->lock('RequestSendData'))
            throw new Exception('RequestSendData is locked', E_USER_NOTICE);

        if ($needResponse)
        {
            if (!$this->lock('ReplyAPIData'))
            {
                $this->unlock('RequestSendData');
                throw new Exception('ReplyAPIData is locked', E_USER_NOTICE);
            }
            SetValueString($ReplyAPIDataID, '');
            $this->unlock('ReplyAPIData');
        }
		*/
        $ret = $this->SendDataToParent($APIData);
        /*
		if ($ret === false)
        {
//            IPS_LogMessage('exc',print_r($ret,1));
            $this->unlock('RequestSendData');
            throw new Exception('Instance has no active Parent Instance!', E_USER_NOTICE);
        }
//        IPS_LogMessage('noexc', print_r($ret, 1));
        if (!$needResponse)
        {
            $this->unlock('RequestSendData');
            return true;
        }
        $ReplayAPIData = $this->WaitForResponse($APIData->APICommand);

        //        IPS_LogMessage('ReplayATData:'.$this->InstanceID,print_r($ReplayATData,1));

        if ($ReplayAPIData === false)
        {
            //          Senddata('TX_Status','Timeout');
            $this->unlock('RequestSendData');
            throw new Exception('Send Data Timeout', E_USER_NOTICE);
        }
        //            Senddata('TX_Status','OK')
        $this->unlock('RequestSendData');
        return $ReplayAPIData;
		*/
    }
	
	
	//Denon Commands
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
		//$command = str_replace("_", " ", DENON_API_Commands::PW); //Bei Ident mit _ Leerzeichen einsetzten
		$payload = DENON_API_Commands::PW.$subcommand.chr(13);
		$this->SendCommand($payload);
	}
	
	//Mainzone Power
	public function MainZonePower(boolean $Value) // MainZone true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::OFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::ON;
			}
		
		$payload = DENON_API_Commands::ZM.$subcommand.chr(13);
		$this->SendCommand($payload);
	}
	
	//Master Volume
	public function MasterVolume(string $command) // "UP" or "DOWN" 
	{
		$payload = DENON_API_Commands::MV.$command.chr(13);
		$this->SendCommand($payload);
	}
	
	public function MasterVolumeFix(integer $command) // 
	{
		//$Value= intval($Value) +80;
		$payload = DENON_API_Commands::MV.$command.chr(13);
		$this->SendCommand($payload);
	}
	
	//Main Mute
	public function MainMute(string $command) // "ON" or "OFF"
	{
		$payload = DENON_API_Commands::MU.$command.chr(13);
		$this->SendCommand($payload);
	}
	
	public function Input(string $command) // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	{
		$payload = DENON_API_Commands::SI.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function RecSelect(string $command) // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	{
		$payload = DENON_API_Commands::SR.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function SelectDecodeMode(string $command) // AUTO; HDMI; DIGITAL; ANALOG
	{
		$payload = DENON_API_Commands::SD.$command.chr(13);
		$this->SendCommand($payload);
	  
	}

	public function DecodeMode(string $command) // Auto, PCM, DTS
	{
		$payload = DENON_API_Commands::DC.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function VideoSelect(string $command) // Video Select DVD/BD/TV/SAT_CBL/DVR/GAME/V.AUX/DOCK/SOURCE
	{
		$payload = DENON_API_Commands::VS.$command.chr(13);
		$this->SendCommand($payload);
	}
	
	public function ChannelVolumeFL(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FL.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFR(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FR.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeC(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::C.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSW(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SW.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSL(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SL.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSR(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SR.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSBL(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SBL.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSBR(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SBR.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSB(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SB.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFHL(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FHL.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFHR(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FHR.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFWL(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FWL.$command.chr(13);
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFWR(integer $command)
	{
		//$Value = (intval($Value) +50);
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FWR.$command.chr(13);
		$this->SendCommand($payload);
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
	
	

	public function BassLevel($Value)
	{
		$Value = (intval($Value) +50);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSBAS".$Value.chr(13));
	}

	public function LFELevel($Value)
	{
		$Value = (intval($Value) +10);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSLFE".$Value.chr(13));
	}

	public function TrebleLevel($Value)
	{
		$Value = (intval($Value) +50);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSTRE".$Value.chr(13));
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
	  CSCK_SendText($id, "PSCINEMA_EQ.".$Value.chr(13));
	}
	public function MultiEQMode($Value) // MultiEquilizer AUDYSSEE/BYP.LR/FLAT/MANUELL/OFF
	{
	  CSCK_SendText($id, "PSMULTEQ".$Value.chr(13));
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