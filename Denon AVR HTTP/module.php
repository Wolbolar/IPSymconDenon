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
		
		$this->RegisterPropertyInteger("AVRType", 50);
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
				
		//Zusätzliche Inputs
		$this->RegisterPropertyBoolean("FAVORITES", false);
		$this->RegisterPropertyBoolean("IRADIO", false);
		$this->RegisterPropertyBoolean("SERVER", false);
		$this->RegisterPropertyBoolean("NAPSTER", false);
		$this->RegisterPropertyBoolean("LASTFM", false);
		$this->RegisterPropertyBoolean("FLICKR", false);
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
	protected $debug = false;
	
	private function ValidateConfiguration()
	{
		//Zone prüfen
		$Zone = $this->ReadPropertyInteger('Zone');
		$AVRType = $this->ReadPropertyInteger('AVRType');
		
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
		}
		if ($Zone == 6)
		{
			// Error Zone auswählen
			$this->SetStatus(212);
		}
		if ($AVRType == 50)
		{
			// Error AVR Type auswählen
			$this->SetStatus(213);
		}
		
		if (($Zone == 0) && ($AVRType !== 50)) //Mainzone
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			//AVRType und Zone
			$DenonAVRVar->AVRType = $this->GetAVRType();
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptChannelVolumeFL = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeFL";
			$DenonAVRVar->ptChannelVolumeFR = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeFR";
			$DenonAVRVar->ptChannelVolumeC = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeC";
			$DenonAVRVar->ptChannelVolumeSW = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeSW";
			$DenonAVRVar->ptChannelVolumeSW2 = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeSW2";
			$DenonAVRVar->ptChannelVolumeSL = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeSL";
			$DenonAVRVar->ptChannelVolumeSR = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeSR";
			$DenonAVRVar->ptChannelVolumeSBL = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeSBL";
			$DenonAVRVar->ptChannelVolumeSBR = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeSBR";
			$DenonAVRVar->ptChannelVolumeSB = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeSB";
			$DenonAVRVar->ptChannelVolumeFHL = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeFHL";
			$DenonAVRVar->ptChannelVolumeFHR = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeFHR";
			$DenonAVRVar->ptChannelVolumeFWL = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeFWL";
			$DenonAVRVar->ptChannelVolumeFWR = "Denon.".$DenonAVRVar->AVRType.".ChannelVolumeFWR";
			$DenonAVRVar->ptPower = 'Denon.'.$DenonAVRVar->AVRType.'.Power';
			$DenonAVRVar->ptMainZonePower = 'Denon.'.$DenonAVRVar->AVRType.'.MainZonePower';
			$DenonAVRVar->ptMainMute = 'Denon.'.$DenonAVRVar->AVRType.'.MainMute';
			$DenonAVRVar->ptCinemaEQ = 'Denon.'.$DenonAVRVar->AVRType.'.CinemaEQ';
			$DenonAVRVar->ptPanorama = 'Denon.'.$DenonAVRVar->AVRType.'.Panorama';
			$DenonAVRVar->ptFrontHeight = 'Denon.'.$DenonAVRVar->AVRType.'.FrontHeight';
			$DenonAVRVar->ptToneCTRL = 'Denon.'.$DenonAVRVar->AVRType.'.ToneCTRL';
			$DenonAVRVar->ptDynamicEQ = 'Denon.'.$DenonAVRVar->AVRType.'.DynamicEQ';
			$DenonAVRVar->ptMasterVolume = 'Denon.'.$DenonAVRVar->AVRType.'.MasterVolume';
			$DenonAVRVar->ptInputSource = 'Denon.'.$DenonAVRVar->AVRType.'.Inputsource';
			$DenonAVRVar->ptAudioDelay = 'Denon.'.$DenonAVRVar->AVRType.'.AudioDelay';
			$DenonAVRVar->ptLFELevel = 'Denon.'.$DenonAVRVar->AVRType.'.LFELevel';
			$DenonAVRVar->ptQuickSelect = 'Denon.'.$DenonAVRVar->AVRType.'.QuickSelect';
			$DenonAVRVar->ptSleep = 'Denon.'.$DenonAVRVar->AVRType.'.Sleep';
			$DenonAVRVar->ptDigitalInputMode = 'Denon.'.$DenonAVRVar->AVRType.'.DigitalInputMode';
			$DenonAVRVar->ptSurroundMode = 'Denon.'.$DenonAVRVar->AVRType.'.SurroundMode';
			$DenonAVRVar->ptSurroundPlayMode = 'Denon.'.$DenonAVRVar->AVRType.'.SurroundPlayMode';
			$DenonAVRVar->ptMultiEQMode = 'Denon.'.$DenonAVRVar->AVRType.'.MultiEQMode';
			$DenonAVRVar->ptAudioRestorer = 'Denon.'.$DenonAVRVar->AVRType.'.AudioRestorer';
			$DenonAVRVar->ptBassLevel = 'Denon.'.$DenonAVRVar->AVRType.'.BassLevel';
			$DenonAVRVar->ptTrebleLevel = 'Denon.'.$DenonAVRVar->AVRType.'.TrebleLevel';
			$DenonAVRVar->ptDimension = 'Denon.'.$DenonAVRVar->AVRType.'.Dimension';
			$DenonAVRVar->ptDynamicVolume = 'Denon.'.$DenonAVRVar->AVRType.'.DynamicVolume';
			$DenonAVRVar->ptRoomSize = 'Denon.'.$DenonAVRVar->AVRType.'.RoomSize';
			$DenonAVRVar->ptDynamicCompressor = 'Denon.'.$DenonAVRVar->AVRType.'.DynamicCompressor';
			$DenonAVRVar->ptCenterWidth = 'Denon.'.$DenonAVRVar->AVRType.'.CenterWidth';
			$DenonAVRVar->ptDynamicRange = 'Denon.'.$DenonAVRVar->AVRType.'.DynamicRange';
			$DenonAVRVar->ptVideoSelect = 'Denon.'.$DenonAVRVar->AVRType.'.VideoSelect';
			$DenonAVRVar->ptSurroundBackMode = 'Denon.'.$DenonAVRVar->AVRType.'.SurroundBackMode';
			$DenonAVRVar->ptPreset = 'Denon.'.$DenonAVRVar->AVRType.'.Preset';
			$DenonAVRVar->ptInputMode = 'Denon.'.$DenonAVRVar->AVRType.'.InputMode';
			$DenonAVRVar->ptNavigation = "Denon.".$DenonAVRVar->AVRType.".Navigation";
			$DenonAVRVar->ptContrast = "Denon.".$DenonAVRVar->AVRType.".Contrast";
			$DenonAVRVar->ptBrightness = "Denon.".$DenonAVRVar->AVRType.".Brightness";
			$DenonAVRVar->ptChromalevel = "Denon.".$DenonAVRVar->AVRType.".Chromalevel";
			$DenonAVRVar->ptHue = "Denon.".$DenonAVRVar->AVRType.".Hue";
			$DenonAVRVar->ptEnhancer = "Denon.".$DenonAVRVar->AVRType.".Enhancer";
			$DenonAVRVar->ptSubwoofer = "Denon.".$DenonAVRVar->AVRType.".Subwoofer";
			$DenonAVRVar->ptSubwooferATT = "Denon.".$DenonAVRVar->AVRType.".SubwooferATT";
			$DenonAVRVar->ptDNRDirectChange = "Denon.".$DenonAVRVar->AVRType.".DNRDirectChange";
			$DenonAVRVar->ptEffect = "Denon.".$DenonAVRVar->AVRType.".Effect";
			$DenonAVRVar->ptAFDM = "Denon.".$DenonAVRVar->AVRType.".AFDM";
			$DenonAVRVar->ptEffectLevel = "Denon.".$DenonAVRVar->AVRType.".EffectLevel";
			$DenonAVRVar->ptCenterImage = "Denon.".$DenonAVRVar->AVRType.".CenterImage";
			$DenonAVRVar->ptStageWidth = "Denon.".$DenonAVRVar->AVRType.".StageWidth";
			$DenonAVRVar->ptStageHeight = "Denon.".$DenonAVRVar->AVRType.".StageHeight";
			$DenonAVRVar->ptAudysseyDSX = "Denon.".$DenonAVRVar->AVRType.".AudysseyDSX";
			$DenonAVRVar->ptReferenceLevel = "Denon.".$DenonAVRVar->AVRType.".ReferenceLevel";
			$DenonAVRVar->ptDRCDirectChange = "Denon.".$DenonAVRVar->AVRType.".DRCDirectChange";
			$DenonAVRVar->ptSpeakerOutputFront = "Denon.".$DenonAVRVar->AVRType.".SpeakerOutputFront";
			$DenonAVRVar->ptDCOMPDirectChange = "Denon.".$DenonAVRVar->AVRType.".DCOMPDirectChange";
			$DenonAVRVar->ptHDMIMonitor = "Denon.".$DenonAVRVar->AVRType.".HDMIMonitor";
			$DenonAVRVar->ptASP = "Denon.".$DenonAVRVar->AVRType.".ASP";
			$DenonAVRVar->ptResolution = "Denon.".$DenonAVRVar->AVRType.".Resolution";
			$DenonAVRVar->ptResolutionHDMI = "Denon.".$DenonAVRVar->AVRType.".ResolutionHDMI";
			$DenonAVRVar->ptHDMIAudioOutput = "Denon.".$DenonAVRVar->AVRType.".HDMIAudioOutput";
			$DenonAVRVar->ptVideoProcessingMode = "Denon.".$DenonAVRVar->AVRType.".VideoProcessingMode";
			$DenonAVRVar->ptDolbyVolumeLeveler = "Denon.".$DenonAVRVar->AVRType.".DolbyVolumeLeveler";
			$DenonAVRVar->ptDolbyVolumeModeler = "Denon.".$DenonAVRVar->AVRType.".DolbyVolumeModeler";
			$DenonAVRVar->ptPLIIZHeightGain = "Denon.".$DenonAVRVar->AVRType.".PLIIZHeightGain";
			$DenonAVRVar->ptVerticalStretch = "Denon.".$DenonAVRVar->AVRType.".VerticalStretch";
			$DenonAVRVar->ptDolbyVolume = "Denon.".$DenonAVRVar->AVRType.".DolbyVolume";
			$DenonAVRVar->ptFriendlyName = "Denon.".$DenonAVRVar->AVRType.".FriendlyName";
			$DenonAVRVar->ptMainZoneName = "Denon.".$DenonAVRVar->AVRType.".MainZoneName";
			$DenonAVRVar->ptTopMenuLink = "Denon.".$DenonAVRVar->AVRType.".TopMenuLink";
			$DenonAVRVar->ptModel = "Denon.".$DenonAVRVar->AVRType.".Model";
			
			
			//Variablen
			if (($this->GetIPDenon() !== false) && ($Zone !== 6) && ($AVRType !== 50))
			{
				$this->GetInputsAVR($DenonAVRVar);
				//$this->UpdateInputProfile();
				$this->SetStatus(102);
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
		elseif (($Zone == 1) && ($AVRType !== 50)) //Zone 2
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			$AVRType = $this->GetAVRType();
			//AVRType und Zone
			$DenonAVRVar->AVRType = $AVRType;
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptPower = 'Denon.'.$DenonAVRVar->AVRType.'.Power';
			$DenonAVRVar->ptZone2Power = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2Power';
			$DenonAVRVar->ptZone2Mute = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2Mute';
			$DenonAVRVar->ptZone2Volume = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2Volume';
			$DenonAVRVar->ptZone2InputSource = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2InputSource';
			$DenonAVRVar->ptZone2ChannelSetting = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2ChannelSetting';
			$DenonAVRVar->ptZone2ChannelVolumeFL = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2ChannelVolumeFL';
			$DenonAVRVar->ptZone2ChannelVolumeFR = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2ChannelVolumeFR';
			$DenonAVRVar->ptZone2QuickSelect = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2QuickSelect';
			$DenonAVRVar->ptZone2Name = "Denon.".$DenonAVRVar->AVRType.".Zone2Name";
			$DenonAVRVar->ptZone2Sleep = 'Denon.'.$DenonAVRVar->AVRType.'.Zone2Sleep';
			$DenonAVRVar->ptTopMenuLink = "Denon.".$DenonAVRVar->AVRType.".TopMenuLink";
			$DenonAVRVar->ptModel = "Denon.".$DenonAVRVar->AVRType.".Model";
			$DenonAVRVar->ptNavigation = "Denon.".$DenonAVRVar->AVRType.".Navigation";
			
			//Variablen
			if (($this->GetIPDenon() !== false) && ($Zone !== 6) && ($AVRType !== 50))
			{
				$this->GetInputsAVR($DenonAVRVar);
				//$this->UpdateInputProfile();
				$this->SetStatus(102);		
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
		elseif (($Zone == 2) && ($AVRType !== 50)) // Zone 3
		{
			//Profilnamen anlegen
			$DenonAVRVar = new DENONIPSProfiles;
			$AVRType = $this->GetAVRType();
			//AVRType und Zone
			$DenonAVRVar->AVRType = $AVRType;
			$DenonAVRVar->Zone = $this->ReadPropertyInteger('Zone');
			$DenonAVRVar->ptPower = 'Denon.'.$DenonAVRVar->AVRType.'.Power';
			$DenonAVRVar->ptZone3Power = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3Power';
			$DenonAVRVar->ptZone3Mute = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3Mute';
			$DenonAVRVar->ptZone3Volume = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3Volume';
			$DenonAVRVar->ptZone3InputSource = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3InputSource';
			$DenonAVRVar->ptZone3ChannelSetting = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3ChannelSetting';
			$DenonAVRVar->ptZone3ChannelVolumeFL = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3ChannelVolumeFL';
			$DenonAVRVar->ptZone3ChannelVolumeFR = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3ChannelVolumeFR';
			$DenonAVRVar->ptZone3QuickSelect = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3QuickSelect';
			$DenonAVRVar->ptZone3Name = "Denon.".$DenonAVRVar->AVRType.".Zone3Name";
			$DenonAVRVar->ptZone3Sleep = 'Denon.'.$DenonAVRVar->AVRType.'.Zone3Sleep';
			$DenonAVRVar->ptTopMenuLink = "Denon.".$DenonAVRVar->AVRType.".TopMenuLink";
			$DenonAVRVar->ptModel = "Denon.".$DenonAVRVar->AVRType.".Model";
			$DenonAVRVar->ptNavigation = "Denon.".$DenonAVRVar->AVRType.".Navigation";
			
			//Variablen
			if (($this->GetIPDenon() !== false) && ($Zone !== 6) && ($AVRType !== 50))
			{
				$this->GetInputsAVR($DenonAVRVar);
				//$this->UpdateInputProfile();
				$this->SetStatus(102);
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
		$FAVORITES = $this->ReadPropertyBoolean('FAVORITES');
		$IRADIO = $this->ReadPropertyBoolean('IRADIO');
		$SERVER = $this->ReadPropertyBoolean('SERVER');
		$NAPSTER = $this->ReadPropertyBoolean('NAPSTER');
		$LASTFM = $this->ReadPropertyBoolean('LASTFM');
		$FLICKR = $this->ReadPropertyBoolean('FLICKR');
		$this->InputSources = $DenonAVRVar->GetInputSources($this->ReadPropertyInteger('Zone'), $DenonAVRVar->AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
		$this->VarMappingInputs = $DenonAVRVar->GetInputVarmapping($this->ReadPropertyInteger("Zone"));
		//Input ablegen
		$MappingInputs = json_encode($this->VarMappingInputs);
		DAVRSH_SaveInputVarmapping($this->GetParent(), $MappingInputs);
	}
	
	public function GetInputSources()
	{
		$DenonAVRUpdate = new DENONIPSProfiles;
		$DenonAVRUpdate->Zone = $this->ReadPropertyInteger('Zone');
		$DenonAVRUpdate->DenonIP = $this->GetIPDenon();
		$DenonAVRUpdate->AVRType = $this->GetAVRType();
		$DenonAVRUpdate->ptInputSource = 'Denon.'.$DenonAVRUpdate->AVRType.'.Inputsource';
		$DenonAVRUpdate->ptZone2InputSource = 'Denon.'.$DenonAVRUpdate->AVRType.'.Zone2InputSource';
		$DenonAVRUpdate->ptZone3InputSource = 'Denon.'.$DenonAVRUpdate->AVRType.'.Zone3InputSource';
		$FAVORITES = $this->ReadPropertyBoolean('FAVORITES');
		$IRADIO = $this->ReadPropertyBoolean('IRADIO');
		$SERVER = $this->ReadPropertyBoolean('SERVER');
		$NAPSTER = $this->ReadPropertyBoolean('NAPSTER');
		$LASTFM = $this->ReadPropertyBoolean('LASTFM');
		$FLICKR = $this->ReadPropertyBoolean('FLICKR');
		$InputSources = $DenonAVRUpdate->GetInputSources($this->ReadPropertyInteger('Zone'), $DenonAVRUpdate->AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
		return $InputSources;
	}
	
	public function UpdateInputProfile()
	{
		$DenonAVRUpdate = new DENONIPSProfiles;
		$DenonAVRUpdate->Zone = $this->ReadPropertyInteger('Zone');
		$DenonAVRUpdate->DenonIP = $this->GetIPDenon();
		$DenonAVRUpdate->AVRType = $this->GetAVRType();
		$DenonAVRUpdate->ptInputSource = 'Denon.'.$DenonAVRUpdate->AVRType.'.Inputsource';
		$DenonAVRUpdate->ptZone2InputSource = 'Denon.'.$DenonAVRUpdate->AVRType.'.Zone2InputSource';
		$DenonAVRUpdate->ptZone3InputSource = 'Denon.'.$DenonAVRUpdate->AVRType.'.Zone3InputSource';
		$FAVORITES = $this->ReadPropertyBoolean('FAVORITES');
		$IRADIO = $this->ReadPropertyBoolean('IRADIO');
		$SERVER = $this->ReadPropertyBoolean('SERVER');
		$NAPSTER = $this->ReadPropertyBoolean('NAPSTER');
		$LASTFM = $this->ReadPropertyBoolean('LASTFM');
		$FLICKR = $this->ReadPropertyBoolean('FLICKR');
		$this->InputSources = $DenonAVRUpdate->GetInputSources($this->ReadPropertyInteger('Zone'), $DenonAVRUpdate->AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
		
		//Inputs anlegen
		if($this->InputSources !== false)
		{
			if($DenonAVRUpdate->Zone == 0)
			{
				$inputsourcesprofile = $DenonAVRUpdate->SetupVarDenonIntegerAss($DenonAVRUpdate->ptInputSource, $DenonAVRUpdate->AVRType);
			}
			elseif($DenonAVRUpdate->Zone == 1)
			{
				$inputsourcesprofile = $DenonAVRUpdate->SetupVarDenonIntegerAss($DenonAVRUpdate->ptZone2InputSource, $DenonAVRUpdate->AVRType);
			}
			elseif($DenonAVRUpdate->Zone == 2)
			{
				$inputsourcesprofile = $DenonAVRUpdate->SetupVarDenonIntegerAss($DenonAVRUpdate->ptZone3InputSource, $DenonAVRUpdate->AVRType);
			}
			
			$this->WriteUpdateProfileInputs($inputsourcesprofile["ProfilName"], $inputsourcesprofile["Icon"], $inputsourcesprofile["Prefix"], $inputsourcesprofile["Suffix"], $inputsourcesprofile["MinValue"], $inputsourcesprofile["MaxValue"], $inputsourcesprofile["Stepsize"], $inputsourcesprofile["Digits"], $inputsourcesprofile["Associations"]);
			IPS_LogMessage('Variablenprofil Update:', $inputsourcesprofile["ProfilName"]);
			IPS_SetVariableCustomProfile($this->GetIDForIdent("SI"), $DenonAVRUpdate->ptInputSource);
		}
		
		//Input ablegen
		$this->VarMappingInputs = $DenonAVRUpdate->GetInputVarmapping($this->ReadPropertyInteger("Zone"));
		$MappingInputs = json_encode($this->VarMappingInputs);
		DAVRSH_SaveInputVarmapping($this->GetParent(), $MappingInputs);
		$Inputs = array( "Inputprofile" => $this->InputSources, "Varmapping" => $MappingInputs);
		return $Inputs;
	}
	
	protected function HasActiveParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);
		if ($instance['ConnectionID'] > 0)
        {
            $parent = IPS_GetInstance($instance['ConnectionID']);
            if ($parent['InstanceStatus'] == 102)
            {
                //$this->SetStatus(102);
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
		$TypeInt = $this->ReadPropertyInteger('AVRType');
		
		$Types = array(
				0 => "AVR-3313",
				1 => "AVR-4310",
				2 => "AVR-4311",
				3 => "AVR-X1000",
				4 => "AVR-X1100W",
				5 => "AVR-X1200W",
				6 => "AVR-X2000",
				7 => "AVR-X2100W",
				8 => "AVR-X2200W",
				9 => "AVR-X3000",
				10 => "AVR-X3100W",
				11 => "AVR-X3200W",
				12 => "AVR-X4000",
				13 => "AVR-X4100W",
				14 => "AVR-X4200W",
				15 => "AVR-X5200W",
				16 => "AVR-X6200W",
				17 => "AVR-X7200W",
				18 => "AVR-X7200WA",
				19 => "Marantz NR1605",
				20 => "S-700W",
				21 => "S-900W",
				22 => "AVR-1912");
		
		foreach($Types as $TypeID => $AVRType)
		{
			if($TypeID == $TypeInt)
			{
			   return $AVRType;
			}

		}		
	}
	
	private function SetupVarDenon($DenonAVRVar, $vBoolean, $vInteger, $vIntegerAss, $vFloat, $vString)
	{
		$AVRType = $this->GetAVRType();
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
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRVar->ptInputSource, $AVRType);
			}
			elseif($DenonAVRVar->Zone == 1)
			{
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRVar->ptZone2InputSource, $AVRType);
			}
			elseif($DenonAVRVar->Zone == 2)
			{
				$inputsourcesprofile = $DenonAVRVar->SetupVarDenonIntegerAss($DenonAVRVar->ptZone3InputSource, $AVRType);
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
				$profile = $DenonAVRVar->SetupVarDenonString($ptString, $AVRType);
				//Ident, Name, Profile, Position
				$this->RegisterProfileStringDenon($profile["ProfilName"], $profile["Icon"]);		
				$id = $this->RegisterVariableString ($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
			}	
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				 $profile = $DenonAVRVar->SetupVarDenonString($ptString, $AVRType);
				 $this->removeVariableAction($profile["Ident"], $links, $ptString); 
			}
		}
		
		foreach ($vBoolean as $ptBool => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonBool($ptBool, $AVRType);
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
				 $profile = $DenonAVRVar->SetupVarDenonBool($ptBool, $AVRType);
				 $this->removeVariableAction($profile["Ident"], $links, $ptBool); 
			}
		}
		
		foreach ($vInteger as $ptInteger => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonInteger($ptInteger, $AVRType);
				$this->RegisterProfileIntegerDenon($profile["ProfilName"], $profile["Icon"], $profile["Prefix"], $profile["Suffix"], $profile["MinValue"], $profile["MaxValue"], $profile["Stepsize"], $profile["Digits"]);
				IPS_LogMessage('Variablenprofil angelegt:', $profile["ProfilName"]);	
				$id = $this->RegisterVariableInteger($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
			}	
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				$profile = $DenonAVRVar->SetupVarDenonInteger($ptInteger, $AVRType);
				$this->removeVariableAction($profile["Ident"], $links, $ptInteger); 
			}
		}
		
		foreach ($vIntegerAss as $ptIntegerAss => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonIntegerAss($ptIntegerAss, $AVRType);
				$this->RegisterProfileIntegerDenonAss($profile["ProfilName"], $profile["Icon"], $profile["Prefix"], $profile["Suffix"], $profile["MinValue"], $profile["MaxValue"], $profile["Stepsize"], $profile["Digits"], $profile["Associations"]);
				IPS_LogMessage('Variablenprofil angelegt:', $profile["ProfilName"]);
				$id = $this->RegisterVariableInteger($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
				
			}	
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				$profile = $DenonAVRVar->SetupVarDenonIntegerAss($ptIntegerAss, $AVRType);
				$this->removeVariableAction($profile["Ident"], $links, $ptIntegerAss); 
			}
		}
		
		foreach ($vFloat as $ptFloat => $visible)
		{
		//Auswahl Prüfen
		if ($visible === true)
			{
				$profile = $DenonAVRVar->SetupVarDenonFloat($ptFloat, $AVRType);
				$this->RegisterProfileFloatDenon($profile["ProfilName"], $profile["Icon"], $profile["Prefix"], $profile["Suffix"], $profile["MinValue"], $profile["MaxValue"], $profile["Stepsize"], $profile["Digits"]);
				IPS_LogMessage('Variablenprofil angelegt:', $profile["ProfilName"]);
				$id = $this->RegisterVariableFloat($profile["Ident"], $profile["Name"], $profile["ProfilName"], $profile["Position"]);
				IPS_LogMessage('Variable angelegt:', $profile["Name"].', [ObjektID: '.$id.']');
				$this->EnableAction($profile["Ident"]);
			}
		// wenn nicht sichtbar löschen
		elseif ($visible === false)
			{
				$profile = $DenonAVRVar->SetupVarDenonFloat($ptFloat, $AVRType);
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
        //AVRType und Zone
		$AVRType = $this->ReadPropertyInteger('AVRType');
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
							if($this->debug)
							{
								IPS_LogMessage("Denon HTTP", "Update ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							}
							break;
						case 1: //Integer
							SetValueInteger($this->GetIDForIdent($Ident), $Subcommandvalue);
							if($this->debug)
							{
								IPS_LogMessage("Denon HTTP", "Update ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							}
							break;
						case 2: //Float
							SetValueFloat($this->GetIDForIdent($Ident), $Subcommandvalue);
							if($this->debug)
							{
								IPS_LogMessage("Denon HTTP", "Update ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							}
							break;     
						case 3: //String
							SetValueString($this->GetIDForIdent($Ident), $Subcommandvalue);
							if($this->debug)
							{
								IPS_LogMessage("Denon HTTP", "Update ObjektID(".$this->GetIDForIdent($Ident)."): ".$Subcommand);
							}
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