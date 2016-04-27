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
		$this->RegisterPropertyBoolean("SurroundDisplay", false);
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
		$this->RegisterPropertyBoolean('InputMode', false);
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
		//$this->RegisterPropertyBoolean('DCOMPDirectChange', false);
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
		$this->RegisterPropertyBoolean("Model", false);
		$this->RegisterPropertyBoolean("GUIMenu", false);
		$this->RegisterPropertyBoolean("GUIMenuSource", false);
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
	public 	$VarMappingInputs;
	
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
			//$DenonAVRVar->ptDCOMPDirectChange = "DENON.".$DenonAVRVar->Type.".DCOMPDirectChange";
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
			$DenonAVRVar->ptGUIMenu = "DENON.".$DenonAVRVar->Type.".GUIMenu";
			$DenonAVRVar->ptGUISourceSelect = "DENON.".$DenonAVRVar->Type.".GUIMenuSourceSelect";
			$DenonAVRVar->ptSurroundDisplay = "DENON.".$DenonAVRVar->Type.".SurroundDisplay";
				
			
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
				$DenonAVRVar->ptModel => $this->ReadPropertyBoolean('Model'),
				$DenonAVRVar->ptSurroundDisplay => $this->ReadPropertyBoolean('SurroundDisplay')
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
				$DenonAVRVar->ptSubwooferATT => $this->ReadPropertyBoolean('SubwooferATT'),
				$DenonAVRVar->ptGUIMenu => $this->ReadPropertyBoolean('GUIMenu'),
				$DenonAVRVar->ptGUISourceSelect => $this->ReadPropertyBoolean('GUIMenuSource'),
				$DenonAVRVar->ptVerticalStretch => $this->ReadPropertyBoolean('VerticalStretch')	
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
				 $DenonAVRVar->ptSurroundMode => true,
				 $DenonAVRVar->ptNavigation => $this->ReadPropertyBoolean('Navigation'),
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
				 $DenonAVRVar->ptInputMode => $this->ReadPropertyBoolean('InputMode'),
				 $DenonAVRVar->ptHDMIMonitor => $this->ReadPropertyBoolean('HDMIMonitor'),
				 $DenonAVRVar->ptDNRDirectChange => $this->ReadPropertyBoolean('DNRDirectChange'),
				 $DenonAVRVar->ptAudysseyDSX => $this->ReadPropertyBoolean('AudysseyDSX'),
				 $DenonAVRVar->ptReferenceLevel => $this->ReadPropertyBoolean('ReferenceLevel'),
				 $DenonAVRVar->ptDRCDirectChange => $this->ReadPropertyBoolean('DRCDirectChange'),
				 $DenonAVRVar->ptSpeakerOutputFront => $this->ReadPropertyBoolean('SpeakerOutputFront'),
				 $DenonAVRVar->ptASP => $this->ReadPropertyBoolean('ASP'),
				 $DenonAVRVar->ptResolution => $this->ReadPropertyBoolean('Resolution'),
				 $DenonAVRVar->ptResolutionHDMI => $this->ReadPropertyBoolean('ResolutionHDMI'),
				 $DenonAVRVar->ptHDMIAudioOutput => $this->ReadPropertyBoolean('HDMIAudioOutput'),
				 $DenonAVRVar->ptVideoProcessingMode => $this->ReadPropertyBoolean('VideoProcessingMode'),
				 $DenonAVRVar->ptDolbyVolumeLeveler => $this->ReadPropertyBoolean('DolbyVolumeLeveler'),
				 $DenonAVRVar->ptDolbyVolumeModeler => $this->ReadPropertyBoolean('DolbyVolumeModeler'),
				 $DenonAVRVar->ptPLIIZHeightGain => $this->ReadPropertyBoolean('PLIIZHeightGain')		
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
						if($this->ReadPropertyBoolean('SurroundDisplay') == true)
						{
							$this->DisableAction("SurroundDisplay");
						}
						
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
		if ($this->ReadPropertyBoolean('Zone') !== 6)
			{
				if($this->ReadPropertyBoolean('Model'))
				{
					$this->DisableAction("Model");
				}
			}
			
			
			
			//auf aktive Parent prüfen
				
			//Status aktiv
			$this->SetStatus(102);
	}
	
	private function GetInputsAVR($DenonAVRVar)
	{
		$DenonAVRVar->DenonIP = $this->GetIPDenon();
		$this->InputSources = $DenonAVRVar->GetInputSources($this->ReadPropertyInteger('Zone'), $DenonAVRVar->Type);
		$this->VarMappingInputs = $DenonAVRVar->GetInputVarmapping($this->ReadPropertyInteger("Zone"));
		$Inputs = $this->VarMappingInputs;
		//Input ablegen
		$MappingInputs = json_encode($Inputs);
		DAVRST_SaveInputVarmapping($this->GetParent(), $MappingInputs, $DenonAVRVar->Type);
	}
	
	private function GetZone()
    {
        $this->DenonZone = new DENON_Zone();
        $this->DenonZone->thisZone = $this->ReadPropertyInteger("Zone");
        return true;
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
		DAVRST_SaveInputVarmapping($this->GetParent(), $MappingInputs, $DenonAVRUpdate->Type);
		return $this->InputSources;
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
				//Ident, Name, Profile, Position, Icon
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
		$states  = array ("Power" => "PW", "Volume" => "MV", "Mute" => "MU", "Channel Volume" => "CV",
		"Input" => "SI", "Main Zone Power" => "ZM", "Rec Select" => "SR", "Input Mode" => "SD",
		"Digital Input" => "DC", "Video Select" => "SV", "Sleep" => "SLP", "Surround Mode" => "MS",
		"Quick" => "MSQUICK ", "Monitor Status" => "VSMONI ", "ASP" => "VSASP ", "Video Resolution" => "VSSC ",
		"Video Resolution HDMI" => "VSSCH ", "HDMI Audio" => "VSAUDIO ", "Video Processing Mode" => "VSVPM ", "Vertical Stretch" => "VSVST ",
		"Tone Control" => "PSTONE CTRL ", "Surround Back" => "PSSB: ", "Cinema EQ" => "PSCINEMA EQ. ", "Mode" => "PSMODE: ",
		"Dolby Volume Direct Change" => "PSDOLVOL ", "Dolby Volume Leveler" => "PSVOLLEV ", "Dolby Volume Modeler" => "PSVOLMOD ", "Front Height" => "PSFH: ",
		"PLIIZ Height Gain" => "PSPHG ", "Speaker Output" => "PSSP: ", "Multi EQ XT" => "PSMULTEQ: ", "Dynamic EQ" => "PSDYNEQ ",
		"Reference Level" => "PSREFLEV ", "Dynamic Volume" => "PSDYNVOL ", "Audyssey DSX" => "PSDSX ", "Stage Width" => "PSSTW ",
		"Stage Height" => "PSSTH ", "Bass Level" => "PSBAS ", "Treble Level" => "PSTRE ", "DRC Direct Change" => "PSDRC ",
		"AFDM" => "PSAFD ", "Panorama" => "PSPAN ", "Dimension" => "PSDIM ", "Center Width" => "PSCEN ",
		"Center Image" => "PSCEI ", "Subwoofer ATT" => "PSATT ", "Subwoofer" => "PSSWR ", "Room Size" => "PSRSZ ",
		"Audio Delay" => "PSDELAY ", "Audio Restorer" => "PSRSTR ", "Contrast" => "PVCN ", "Brightness" => "PVBR ",
		"Chroma" => "PVCM ", "Hue" => "PVHUE ", "DNR Direct Change" => "PVDNR ", "Enhancer" => "PVENH ", "Effect" => "PSEFF ",
		"Zone 2" => "Z2", "Zone 2 Mute" => "Z2MU", "Zone 2 Channel Setting" => "Z2CS", "Zone 2 Channel Volume" => "Z2CV",
		"Zone 2 HPF" => "Z2HPF", "Zone 2 Bass" => "Z2PSBAS ", "Zone 2 Treble" => "Z2PSTRE ", "Zone 2 Quick" => "Z2QUICK ",
		"Zone 2 Sleep" => "Z2SLP",	"Zone 3" => "Z3", "Zone 3 Mute" => "Z3MU", "Zone 3 Channel Setting" => "Z3CS", "Zone 3 Channel Volume" => "Z3CV",
		"Zone 3 HPF" => "Z3HPF", "Zone 3 Bass" => "Z3PSBAS ", "Zone 3 Treble" => "Z3PSTRE ", "Zone 3 Quick" => "Z3QUICK "
		);
		
		foreach ($states as $name => $command)
		{
			IPS_LogMessage('Denon Update: ', $name);
			$command = $command.chr(63);
			$this->SendCommand($command);
			IPS_Sleep(100);  
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
		//Input übergeben
		$APIData->InputMapping = DAVRST_GetInputVarMapping($this->GetParent());
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
        $APIData->APISubCommand = $APIData->GetSubCommand($APIData->APIIdent, $APIData->Data, $APIData->InputMapping);
        IPS_LogMessage('Denon Subcommand', $APIData->APISubCommand);
        // Daten senden        Rückgabe ist egal, Variable wird automatisch durch Datenempfang nachgeführt
        try
        {
            //Command aus Ident
			$APIData->APICommand = str_replace("_", " ", $Ident); //Ident _ von Ident mit Lerrezeichen ersetzten
			if($Ident == "Z2POWER" || $Ident == "Z2INPUT" || $Ident == "Z2VOL")
			{
				$APIData->APICommand = "Z2";
			}		
			elseif($Ident == "Z3POWER" || $Ident == "Z3INPUT" || $Ident == "Z3VOL")
			{
				$APIData->APICommand = "Z3";
			}
			
			$payload = $APIData->APICommand.$APIData->APISubCommand;
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
		
    }
	
	
	
	protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);//array
		return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;//ConnectionID
    }
	
	//Data Transfer
	public function SendCommand($payload)
		{
			$sendcommand = $payload.chr(13);
			$this->SendDataToParent(json_encode(Array("DataID" => "{01A68655-DDAF-4F79-9F35-65878A86F344}", "Buffer" => $sendcommand))); //Denon AVR Telnet Interface GUI
		}
	
	// Daten vom Splitter Instanz
	public function ReceiveData($JSONString)
	{
	 
		// Empfangene Daten vom Splitter
		$data = json_decode($JSONString);
		//$datasplitter = json_encode($data->Buffer->Data);
		//SetValueString($this->GetIDForIdent("BufferIN"), $datasplitter);
		$message = json_encode($data->Buffer->Data);
		IPS_LogMessage("ReceiveData Denon Telnet", utf8_decode($message));
		$response = json_encode($data->Buffer);
		//SetValueString($this->GetIDForIdent("Response"), $response);
		$this->UpdateVariable($data->Buffer);
	 
	}	
	
	// Wertet Response aus und setzt Variable
	private function UpdateVariable($data)
    {
		$ResponseType = $data->ResponseType;
		$Zone = $this->ReadPropertyInteger('Zone');
		if($ResponseType == "HTTP")
		{
			$Zonedata = $data->Data;
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
		}
		elseif($ResponseType == "TELNET")
		{
			$datavalues = $data->Data;
			if ($this->ReadPropertyBoolean('SurroundDisplay'))
			{
				$SurroundDisplay = $data->SurroundDisplay;
				if($SurroundDisplay !== "")
				{
					SetValueString($this->GetIDForIdent("SurroundDisplay"), $SurroundDisplay);
				}
			}
		}
		
			foreach($datavalues as $Ident => $Values)
			{
				$Ident = str_replace(" ", "_", $Ident); //Ident Leerzeichen von Command mit _ ersetzten
				$Subcommand = $Values->Subcommand;
				$VarType = $Values->VarType;
				$Subcommandvalue = $Values->Value;
				$VarID = @$this->GetIDForIdent($Ident); 
				if ($VarID > 0) 
				{ 
					if ($ResponseType == "HTTP")
					{
						if ($Ident == "MainZoneName" || $Ident == "Zone2Name" || $Ident == "Zone3Name" || $Ident == "Model")
						{
							switch ($VarType)
							{
								case 0: //Boolean
									SetValueBoolean($this->GetIDForIdent($Ident), $Subcommandvalue);
									IPS_LogMessage("Update Denon HTTP", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
									break;
								case 1: //Integer
									SetValueInteger($this->GetIDForIdent($Ident), $Subcommandvalue);
									IPS_LogMessage("Update Denon HTTP", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
									break;
								case 2: //Float
									SetValueFloat($this->GetIDForIdent($Ident), $Subcommandvalue);
									IPS_LogMessage("Update Denon HTTP", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
									break;     
								case 3: //String
									SetValueString($this->GetIDForIdent($Ident), $Subcommandvalue);
									IPS_LogMessage("Update Denon HTTP", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
									break;
							}	
							
							//$this->SetVarResponse($Ident, $Subcommandvalue, $Subcommand, $VarType);
						}	
					}
					elseif ($ResponseType == "TELNET")
					{
						switch ($VarType)
						{
							case 0: //Boolean
								SetValueBoolean($this->GetIDForIdent($Ident), $Subcommandvalue);
								IPS_LogMessage("Update Denon Telnet", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
								break;
							case 1: //Integer
								SetValueInteger($this->GetIDForIdent($Ident), $Subcommandvalue);
								IPS_LogMessage("Update Denon Telnet", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
								break;
							case 2: //Float
								SetValueFloat($this->GetIDForIdent($Ident), $Subcommandvalue);
								IPS_LogMessage("Update Denon Telnet", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
								break;     
							case 3: //String
								SetValueString($this->GetIDForIdent($Ident), $Subcommandvalue);
								IPS_LogMessage("Update Denon Telnet", "ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
								break;
						}	
						
						//$this->SetVarResponse($Ident, $Subcommandvalue, $Subcommand, $VarType);
					}	
				}
				else
				{ 
				// nicht vorhanden 
				}  
			}
		
    }
	/*
	protected function SetVarResponse($Ident, $Subcommandvalue, $Subcommand, $VarType)
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
	*/
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
	
	
	######################### Denon Commands #######################################
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
		//$command = str_replace("_", " ", DENON_API_Commands::PW); //Bei Ident mit _ Leerzeichen einsetzten
		$payload = DENON_API_Commands::PW.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Mainzone Power
	public function MainZonePower(boolean $Value) // MainZone true (On) or false (Off) 
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
	
	//Master Volume
	public function MasterVolume(string $command) // "UP" or "DOWN" 
	{
		$payload = DENON_API_Commands::MV.$command;
		$this->SendCommand($payload);
	}
	
	public function MasterVolumeFix(integer $command) // 
	{
		//$Value= intval($Value) +80;
		$payload = DENON_API_Commands::MV.$command;
		$this->SendCommand($payload);
	}
	
	//Main Mute
	public function MainMute(boolean $Value) // Main Mute true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::MUOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::MUON;
			}
		
		$payload = DENON_API_Commands::MU.$subcommand;
		$this->SendCommand($payload);
	}
	
		
	//Input
	public function Input(string $command) // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	{
		$payload = DENON_API_Commands::SI.$command;
		$this->SendCommand($payload);
	}
	
	//Dynamic Volume
	public function DynamicVolume(string $Value) // Dynamic Volume Midnight / Evening / Day
	{
		if ($Value == "Midnight")
			{
				$subcommand = DENON_API_Commands::DYNVOLNGT;
			}
		elseif ($Value == "Evening")
			{
				$subcommand = DENON_API_Commands::DYNVOLEVE;
			}
		elseif ($Value == "Day")
			{
				$subcommand = DENON_API_Commands::DYNVOLDAY;
			}
			
		$payload = DENON_API_Commands::PSDYNVOL.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Dolby Volume
	public function DolbyVolume(boolean $Value) // Dolby Volume true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::DOLVOLOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::DOLVOLON;
			}
		
		$payload = DENON_API_Commands::PSDOLVOL.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Dolby Volume Modeler
	public function DolbyVolumeModeler(string $Value) // Dolby Volume Modeler Off / Half / Full
	{
		if ($Value == "Off")
			{
				$subcommand = DENON_API_Commands::VOLMODOFF;
			}
		elseif ($Value == "Half")
			{
				$subcommand = DENON_API_Commands::VOLMODHLF;
			}
		elseif ($Value == "Full")
			{
				$subcommand = DENON_API_Commands::VOLMODFUL;
			}
			
		$payload = DENON_API_Commands::PSVOLMOD.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Dolby Volume Leveler
	public function DolbyVolumeLeveler(string $Value) // Dolby Volume Leveler Low / Middle / High
	{
		if ($Value == "Low")
			{
				$subcommand = DENON_API_Commands::DYNVOLNGT;
			}
		elseif ($Value == "Middle")
			{
				$subcommand = DENON_API_Commands::DYNVOLEVE;
			}
		elseif ($Value == "High")
			{
				$subcommand = DENON_API_Commands::DYNVOLDAY;
			}
			
		$payload = DENON_API_Commands::PSVOLLEV.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Dynamic Compressor
	public function DynamicCompressor(string $Value) // Dynamic Compressor Off / Low / Middle / High
	{
		if ($Value == "Off")
			{
				$subcommand = DENON_API_Commands::DCOOFF;
			}
		elseif ($Value == "Low")
			{
				$subcommand = DENON_API_Commands::DCOLOW;
			}	
		elseif ($Value == "Middle")
			{
				$subcommand = DENON_API_Commands::DCOMID;
			}
		elseif ($Value == "High")
			{
				$subcommand = DENON_API_Commands::DCOHIGH;
			}
			
		$payload = DENON_API_Commands::PSDCO.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Dynamic Range Compression
	public function DynamicRangeCompression(string $Value) // Dynamic Range Compression Off / Auto / Low / Middle / High
	{
		if ($Value == "Off")
			{
				$subcommand = DENON_API_Commands::DRCOFF;
			}
		elseif ($Value == "Auto")
			{
				$subcommand = DENON_API_Commands::DRCAUTO;
			}		
		elseif ($Value == "Low")
			{
				$subcommand = DENON_API_Commands::DRCLOW;
			}	
		elseif ($Value == "Middle")
			{
				$subcommand = DENON_API_Commands::DRCMID;
			}
		elseif ($Value == "High")
			{
				$subcommand = DENON_API_Commands::DRCHI;
			}
			
		$payload = DENON_API_Commands::PSDRC.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Audyssey DSX
	public function AudysseyDSX(string $Value) // Audyssey DSX Off / Wide (Audyssey DSX ON(Wide)) / Height (Audyssey DSX ON(Height)) / Height/Wide (Audyssey DSX ON(Height/Wide))
	{
		if ($Value == "Off")
			{
				$subcommand = DENON_API_Commands::PSDSXOFF;
			}
		elseif ($Value == "Wide")
			{
				$subcommand = DENON_API_Commands::PSDSXONW;
			}	
		elseif ($Value == "Height")
			{
				$subcommand = DENON_API_Commands::PSDSXONH;
			}
		elseif ($Value == "Height/Wide")
			{
				$subcommand = DENON_API_Commands::PSDSXONHW;
			}
			
		$payload = DENON_API_Commands::PSDSX.$subcommand;
		$this->SendCommand($payload);
	}
		
	//CinemaEQ
	public function CinemaEQ(boolean $Value) // CinemaEQ true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::CINEMAEQOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::CINEMAEQON;
			}
		$payload = DENON_API_Commands::CINEMAEQCOMMAND.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Panorama
	public function Panorama(boolean $Value) // Panorama true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::PANOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::PANON;
			}
		$payload = DENON_API_Commands::PS.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Dynamic EQ
	public function DynamicEQ(boolean $Value) // Dynamic EQ true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::DYNEQOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::DYNEQON;
			}
		$payload = DENON_API_Commands::PSDYNEQ.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Channel Volume
	public function ChannelVolumeFL(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FL.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFR(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FR.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeC(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::C.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSW(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SW.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSL(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SL.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSR(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SR.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSBL(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SBL.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSBR(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SBR.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeSB(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::SB.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFHL(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FHL.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFHR(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FHR.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFWL(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FWL.$command;
		$this->SendCommand($payload);
	}

	public function ChannelVolumeFWR(integer $command)
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::FWR.$command;
		$this->SendCommand($payload);
	}
	
	//RecSelect
	public function RecSelect(string $command) // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	{
		$payload = DENON_API_Commands::SR.$command;
		$this->SendCommand($payload);
	}

	public function SelectDecodeMode(string $command) // AUTO; HDMI; DIGITAL; ANALOG
	{
		$payload = DENON_API_Commands::SD.$command;
		$this->SendCommand($payload);
	  
	}

	public function DecodeMode(string $command) // Auto, PCM, DTS
	{
		$payload = DENON_API_Commands::DC.$command;
		$this->SendCommand($payload);
	}
	
	//Video Select
	public function VideoSelect(string $command) // Video Select DVD/BD/TV/SAT_CBL/DVR/GAME/V.AUX/DOCK/SOURCE
	{
		$payload = DENON_API_Commands::VS.$command;
		$this->SendCommand($payload);
	}
	
	//Subwoofer
	public function Subwoofer(boolean $Value) // Subwoofer true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::PSSWROFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::PSSWRON;
			}
		$payload = DENON_API_Commands::PSSWR.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Subwoofer ATT
	public function SubwooferATT(boolean $Value) // Subwoofer ATT true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::ATTOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::ATTON;
			}
		$payload = DENON_API_Commands::PS.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Front Height
	public function FrontHeight(boolean $Value) // Front Height true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::PSFHOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::PSFHON;
			}
		$payload = DENON_API_Commands::PSFH.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Tone CTRL
	public function ToneCTRL(boolean $Value) // Tone CTRL true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::PSTONECTRLOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::PSTONECTRLON;
			}
		$payload = DENON_API_Commands::TONECTRL.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Audio Delay
	public function AudioDelay(integer $command) // can be operated from 0 to 300
	{
		$payload = DENON_API_Commands::CV.DENON_API_Commands::PSDELAY.$command;
		$this->SendCommand($payload);
	}
	
	//Speaker Output Front 
	public function SpeakerOutputFront(string $Value) // Speaker Output Front Off / Wide / Height / Height/Wide
	{
		if ($Value == "Off")
			{
				$subcommand = DENON_API_Commands::SPOFF;
			}
		elseif ($Value == "Wide")
			{
				$subcommand = DENON_API_Commands::SPFW;
			}	
		elseif ($Value == "Height")
			{
				$subcommand = DENON_API_Commands::SPHW;
			}
		elseif ($Value == "Height/Wide")
			{
				$subcommand = DENON_API_Commands::SPHW;
			}
			
		$payload = DENON_API_Commands::PSSP.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Auto Flag Detect Mode
	public function AutoFlagDetectMode(boolean $Value) // Auto Flag Detect Mode true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::AFDOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::AFDON;
			}
		$payload = DENON_API_Commands::PSAFD.$subcommand;
		$this->SendCommand($payload);
	}
	
	//ASP
	public function ASP(string $Value) // ASP Normal / Full
	{
		if ($Value == "Normal")
			{
				$subcommand = DENON_API_Commands::ASPNRM;
			}
		elseif ($Value == "Full")
			{
				$subcommand = DENON_API_Commands::ASPFUL;
			}	
					
		$payload = DENON_API_Commands::VSASP.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Audio Restorer
	public function AudioRestorer(string $Value) // Audio Restorer Off / 64 / 96 / HQ
	{
		if ($Value == "Off")
			{
				$subcommand = DENON_API_Commands::PSRSTROFF;
			}
		elseif ($Value == "64")
			{
				$subcommand = DENON_API_Commands::PSRSTRMODE1;
			}	
		elseif ($Value == "96")
			{
				$subcommand = DENON_API_Commands::PSRSTRMODE2;
			}
		elseif ($Value == "HQ")
			{
				$subcommand = DENON_API_Commands::PSRSTRMODE3;
			}
			
		$payload = DENON_API_Commands::PSRSTR.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Center Image
	
	//Center Width
	
	//Input Mode
	
	//Digital Input Mode
	public function DigitalInputMode(string $Value) // Digital Input Mode Auto / PCM / DTS
	{
		if ($Value == "Auto")
			{
				$subcommand = DENON_API_Commands::DCAUTO;
			}
		elseif ($Value == "PCM")
			{
				$subcommand = DENON_API_Commands::DCPCM;
			}	
		elseif ($Value == "DTS")
			{
				$subcommand = DENON_API_Commands::DCDTS;
			}
			
		$payload = DENON_API_Commands::DC.$subcommand;
		$this->SendCommand($payload);
	}
	
	
	//Dimension
	
	//Effect
	public function Effect(boolean $Value) // Effect true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::PSEFFOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::PSEFFON;
			}
		$payload = DENON_API_Commands::PSEFF.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Effect Level
	
	//HDMI Audio Output
	public function HDMIAudioOutput(string $Value) // HDMI Audio Output TV / AMP
	{
		if ($Value == "TV")
			{
				$subcommand = DENON_API_Commands::AUDIOTV;
			}
		elseif ($Value == "AMP")
			{
				$subcommand = DENON_API_Commands::AUDIOAMP;
			}	
			
		$payload = DENON_API_Commands::VSAUDIO.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Multi EQ Mode
	public function MultiEQMode(string $Value) // Multi EQ Mode Audyssey / BYP.LR / Flat / Manual / Off
	{
		if ($Value == "Audyssey")
			{
				$subcommand = DENON_API_Commands::MULTEQAUDYSSEY;
			}
		elseif ($Value == "BYP.LR")
			{
				$subcommand = DENON_API_Commands::MULTEQBYPLR;
			}	
		elseif ($Value == "Flat")
			{
				$subcommand = DENON_API_Commands::MULTEQFLAT;
			}
		elseif ($Value == "Manual")
			{
				$subcommand = DENON_API_Commands::MULTEQMANUAL;
			}
		elseif ($Value == "Off")
			{
				$subcommand = DENON_API_Commands::MULTEQOFF;
			}		
		
		$payload = DENON_API_Commands::PSMULTEQ.chr(32).$subcommand;
		$this->SendCommand($payload);
	}
	
	//PLIIZHeightGain
	public function PLIIZHeightGain(string $Value) // PLIIZHeightGain Low / Middle / High
	{
		if ($Value == "Low")
			{
				$subcommand = DENON_API_Commands::PHGLOW;
			}
		elseif ($Value == "Middle")
			{
				$subcommand = DENON_API_Commands::PHGMID;
			}	
		elseif ($Value == "High")
			{
				$subcommand = DENON_API_Commands::PHGHI;
			}	
		
		$payload = DENON_API_Commands::PSPHG.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Reference Level
	public function ReferenceLevel(integer $Value) // Reference Level 0 / 5 / 10 / 15
	{
		if ($Value == 0)
			{
				$subcommand = DENON_API_Commands::REFLEV0;
			}
		elseif ($Value == 5)
			{
				$subcommand = DENON_API_Commands::REFLEV5;
			}	
		elseif ($Value == 10)
			{
				$subcommand = DENON_API_Commands::REFLEV10;
			}
		elseif ($Value == 15)
			{
				$subcommand = DENON_API_Commands::REFLEV15;
			}		
		
		$payload = DENON_API_Commands::PSREFLEV.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Room Size
	public function RoomSize(string $Value) // Room Size Small / Small/Medium / Medium / Medium/Large / Large
	{
		if ($Value == "Small")
			{
				$subcommand = DENON_API_Commands::RSZS;
			}
		elseif ($Value == "Small/Medium")
			{
				$subcommand = DENON_API_Commands::RSZMS;
			}	
		elseif ($Value == "Medium")
			{
				$subcommand = DENON_API_Commands::RSZM;
			}
		elseif ($Value == "Medium/Large")
			{
				$subcommand = DENON_API_Commands::RSZML;
			}
		elseif ($Value == "Large")
			{
				$subcommand = DENON_API_Commands::RSZL;
			}		
		
		$payload = DENON_API_Commands::PSRSZ.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Stage Width
	
	//Stage Height
	
	//Surround Back Mode
	
	//Surround Play Mode
	public function SurroundPlayMode(string $Value) // Surround Play Mode Music / Cinema / Game / Pro Logic
	{
		if ($Value == "Music")
			{
				$subcommand = DENON_API_Commands::MODEMUSIC;
			}
		elseif ($Value == "Cinema")
			{
				$subcommand = DENON_API_Commands::MODECINEMA;
			}	
		elseif ($Value == "Game")
			{
				$subcommand = DENON_API_Commands::MODEGAME;
			}
		elseif ($Value == "Pro Logic")
			{
				$subcommand = DENON_API_Commands::MODEPROLOGIC;
			}
		
		$payload = DENON_API_Commands::PSMODE.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Vertical Stretch
	public function VerticalStretch(boolean $Value) // VerticalStretch true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::VSTOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::VSTON;
			}
		$payload = DENON_API_Commands::VSVST.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Contrast
	public function Contrast(string $subcommand) // Contrast
	{
		$payload = DENON_API_Commands::PS.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Brightness
	
	//Chroma Level
	
	//Digital Noise Reduction
	
	//Enhancer
	
	//HDMI Monitor
	public function HDMIMonitor(string $Value) // HDMI Monitor Auto / Monitor 1 / Monitor 2 
	{
		if ($Value == "Auto")
			{
				$subcommand = DENON_API_Commands::VSMONIAUTO;
			}
		elseif ($Value == "Monitor 1")
			{
				$subcommand = DENON_API_Commands::VSMONI1;
			}	
		elseif ($Value == "Monitor 2")
			{
				$subcommand = DENON_API_Commands::VSMONI2;
			}
		
		$payload = DENON_API_Commands::VSMONI.$subcommand;
		$this->SendCommand($payload);
	}
	
	
	//Hue
	
	//Resolution
	public function Resolution(string $Value) // Resolution 480p/576p / 1080i / 720p / 1080p / 1080p:24Hz / Auto
	{
		if ($Value == "480p/576p")
			{
				$subcommand = DENON_API_Commands::SC48P;
			}
		elseif ($Value == "1080i")
			{
				$subcommand = DENON_API_Commands::SC10I;
			}	
		elseif ($Value == "720p")
			{
				$subcommand = DENON_API_Commands::SC72P;
			}
		elseif ($Value == "1080p")
			{
				$subcommand = DENON_API_Commands::SC10P;
			}
		elseif ($Value == "1080p:24Hz")
			{
				$subcommand = DENON_API_Commands::SC10P24;
			}
		elseif ($Value == "Auto")
			{
				$subcommand = DENON_API_Commands::SCAUTO;
			}	
		
		$payload = DENON_API_Commands::VSSC.$subcommand;
		$this->SendCommand($payload);
	}
		
	//Resolution HDMI
	public function ResolutionHDMI(string $Value) //Resolution HDMI 480p/576p / 1080i / 720p / 1080p / 1080p:24Hz / Auto
	{
		if ($Value == "480p/576p")
			{
				$subcommand = DENON_API_Commands::SCH48P;
			}
		elseif ($Value == "1080i")
			{
				$subcommand = DENON_API_Commands::SCH10I;
			}	
		elseif ($Value == "720p")
			{
				$subcommand = DENON_API_Commands::SCH72P;
			}
		elseif ($Value == "1080p")
			{
				$subcommand = DENON_API_Commands::SCH10P;
			}
		elseif ($Value == "1080p:24Hz")
			{
				$subcommand = DENON_API_Commands::SCH10P24;
			}
		elseif ($Value == "Auto")
			{
				$subcommand = DENON_API_Commands::SCHAUTO;
			}		
		
		$payload = DENON_API_Commands::VSSCH.$subcommand;
		$this->SendCommand($payload);
	}
	
	//Video Processing Mode
	public function VideoProcessingMode(string $Value) // Video Processing Mode Auto / Monitor 1 / Monitor 2 
	{
		if ($Value == "Auto")
			{
				$subcommand = DENON_API_Commands::VSMONIAUTO;
			}
		elseif ($Value == "Monitor 1")
			{
				$subcommand = DENON_API_Commands::VSMONI1;
			}	
		elseif ($Value == "Monitor 2")
			{
				$subcommand = DENON_API_Commands::VSMONI2;
			}
		
		$payload = DENON_API_Commands::VSMONI.$subcommand;
		$this->SendCommand($payload);
	}
	
	//GUI Menu
	public function GUIMenu(boolean $Value) // GUI Menu true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::MNMENOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::MNMENON;
			}
		$payload = DENON_API_Commands::MNMEN.$subcommand;
		$this->SendCommand($payload);
	}
	
	//GUI Source Select Menu 
	public function GUISourceSelectMenu(boolean $Value) // GUI Source Select Menu true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::MNSRCOFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::MNSRCON;
			}
		$payload = DENON_API_Commands::MNSRC.$subcommand;
		$this->SendCommand($payload);
	}
	
	//PS
	public function ParameterSettings(string $subcommand) // PS
	{
		$payload = DENON_API_Commands::PS.$subcommand;
		$this->SendCommand($payload);
	}
	
		
	
	######################## Cursor Steuerung ######################################

	public function CursorUp()
	{
		$payload = DENON_API_Commands::MN.DENON_API_Commands::MNCUP;
		$this->SendCommand($payload);
	}

	public function CursorDown()
	{
		$payload = DENON_API_Commands::MN.DENON_API_Commands::MNCDN;
		$this->SendCommand($payload);
	}

	public function CursorLeft()
	{
		$payload = DENON_API_Commands::MN.DENON_API_Commands::MNCLT;
		$this->SendCommand($payload);
	}

	public function CursorRight()
	{
		$payload = DENON_API_Commands::MN.DENON_API_Commands::MNCRT;
		$this->SendCommand($payload);
	  CSCK_SendText($id, "MNCRT".chr(13));
	}

	public function Enter()
	{
		$payload = DENON_API_Commands::MN.DENON_API_Commands::MNENT;
		$this->SendCommand($payload);
	}

	public function CursorReturn()
	{
		$payload = DENON_API_Commands::MN.DENON_API_Commands::MNRTN;
		$this->SendCommand($payload);
	}
	
	//Levels
	public function BassLevel(integer $Value)
	{
		$payload = DENON_API_Commands::PS.DENON_API_Commands::PSBAS.$Value;
		$this->SendCommand($payload);
	}

	public function LFELevel(integer $Value)
	{
		$payload = DENON_API_Commands::PS.DENON_API_Commands::PSLFE.$Value;
		$this->SendCommand($payload);
	}

	public function TrebleLevel(integer $Value)
	{
		$payload = DENON_API_Commands::PS.DENON_API_Commands::PSTRE.$Value;
		$this->SendCommand($payload);
	}
	
	//Sleep
	public function SLEEP(integer $Value) // 0 ist aus bis 120
	{
		if ($Value == 0)
		{
			$payload = DENON_API_Commands::SLP."OFF";
		}
		ELSE
		{
		$payload = DENON_API_Commands::SLP.$Value;
		}
		$this->SendCommand($payload);
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

	//Zone2 Power 
	public function Zone2Power(boolean $Value) // Zone2 Power  true (On) or false (Off) 
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
	
	//Zone2 Mute 
	public function Zone2Mute(boolean $Value) // Zone2 Mute  true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::Z2OFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::Z2ON;
			}
		$payload = DENON_API_Commands::Z2MU.$subcommand;
		$this->SendCommand($payload);
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
	
	//Zone3 Power 
	public function Zone3Power(boolean $Value) // Zone3 Power  true (On) or false (Off) 
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
	
	//Zone3 Mute 
	public function Zone3Mute(boolean $Value) // Zone3 Mute  true (On) or false (Off) 
	{
		if ($Value == false)
			{
				$subcommand = DENON_API_Commands::Z3OFF;
			}
		elseif ($Value == true)
			{
				$subcommand = DENON_API_Commands::Z3ON;
			}
		$payload = DENON_API_Commands::Z3MU.$subcommand;
		$this->SendCommand($payload);
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
		CSCK_SendText($id, "Z3CVFR ".$Value);
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
	DAVRT_Power('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Power einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_Power('.$InstanzID.', false);
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
	DAVRT_MainZonePower('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "MainZonePower einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_MainZonePower('.$InstanzID.', false);
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
	DAVRT_MainMute('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Mute einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_MainMute('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Mute ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSDOLVOL")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_DolbyVolume('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Dolby Volume einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_DolbyVolume('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Dolby Volume ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSCINEMA_EQ")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_CinemaEQ('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "CinemaEQ einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_CinemaEQ('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "CinemaEQ ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSPAN")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_Panorama('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Panorama einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_Panorama('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Panorama ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSDYNEQ")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_DynamicEQ('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "DynamicEQ einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_DynamicEQ('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "DynamicEQ ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSSWR")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_Subwoofer('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Subwoofer einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_Subwoofer('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Subwoofer ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSATT")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_SubwooferATT('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "SubwooferATT einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_SubwooferATT('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "SubwooferATT ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSFH")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_FrontHeight('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "FrontHeight einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_FrontHeight('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "FrontHeight ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSTONE_CTRL")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_ToneCTRL('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "ToneCTRL einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_ToneCTRL('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "ToneCTRL ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSAFD")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_AutoFlagDetectMode('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Auto Flag Detect Mode einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_AutoFlagDetectMode('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Auto Flag Detect Mode ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "PSEFF_O")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_Effect('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Effect einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_Effect('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Effect ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "VSVST")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_VerticalStretch('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "Vertical Stretch einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_VerticalStretch('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "Vertical Stretch ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "MNMEN")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_GUIMenu('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "GUI Menu einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_GUIMenu('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "GUI Menu ausschalten" );
	}

?>';
			$ScriptID = $this->WriteNEOToggle($ScriptName, $KatID, $ObjektID, $InstanzID, $Content);
			return $ScriptID;
			}
		}
		
		if ($Ident == "MNSRC")
		{
			$SkriptID = @IPS_GetScriptIDByName($ScriptName, $KatID);
			if ($SkriptID === false)
			{
				$Content = '
<?
$status = GetValueBoolean('.$ObjektID.'); // Status des Geräts auslesen
if ($status == false)// Einschalten
	{
	DAVRT_GUISourceSelectMenu('.$InstanzID.', true);
	IPS_LogMessage( "Denon AVR:" , "GUI Source Select Menu einschalten" );
   }
elseif ($status == true)// Ausschalten
	{
   DAVRT_GUISourceSelectMenu('.$InstanzID.', false);
   IPS_LogMessage( "Denon AVR:" , "GUI Source Select Menu ausschalten" );
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