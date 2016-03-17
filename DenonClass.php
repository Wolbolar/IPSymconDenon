<?

//  API Datentypen
class DENONIPSVarType extends stdClass
{

    const vtNone = -1;
    const vtBoolean = 0;
    const vtInteger = 1;
    const vtFloat = 2;
    const vtString = 3;
    const vtDualInteger = 10;

}

class DENONIPSProfiles extends stdClass
{
	//Name übergeben
	// function  IM Array auf übereinstimmnung überprüfen match ausgeben
	// function create profile mit übergabewert aus array aufruf der neuen klasse var zu setzten der var mit übergabe des profilnames ( am besten in einer klasse zusammenführen)
	
	//public $description;
	public $Type;
	public $Zone;
	const DENON = "DENON";
	
	//Profiltype
	const ptSwitch = '~Switch';
    public $ptPower;
	public $ptMainZonePower;
	public $ptMainMute;
	public $ptCinemaEQ;
	public $ptPanorama;
	public $ptFrontHeight;
	public $ptToneCTRL;
	public $ptDynamicEQ;
	public $ptMasterVolume;
	public $ptInputSource;
	public $ptAudioDelay;
	public $ptLFELevel;
	public $ptQuickSelect;
	public $ptSleep;
	public $ptDigitalInputMode;
	public $ptSurroundMode;
	public $ptSurroundPlayMode;
	public $ptMultiEQMode;
	public $ptAudioRestorer;
	public $ptBassLevel;
	public $ptTrebleLevel;
	public $ptDimension;
	public $ptDynamicVolume;
	public $ptRoomSize;
	public $ptDynamicCompressor;
	public $ptCenterWidth;
	public $ptDynamicRange;
	public $ptVideoSelect;
	public $ptSurroundBackMode;
	public $ptPreset;
	public $ptInputMode;
	public $ptZone2Power;
	public $ptZone2Mute;
	public $ptZone2HPF;
	public $ptZone2Volume;
	public $ptZone2InputSource;
	public $ptZone2ChannelSetting;
	public $ptZone2ChannelVolumeFL;
	public $ptZone2ChannelVolumeFR;
	public $ptZone2QuickSelect;
	public $ptSleepZ2;
	public $ptZone3Power;
	public $ptZone3Mute;
	public $ptZone3HPF;
	public $ptZone3Volume;
	public $ptZone3InputSource;
	public $ptZone3ChannelSetting;
	public $ptZone3ChannelVolumeFL;
	public $ptZone3ChannelVolumeFR;
	public $ptZone3QuickSelect;
	public $ptSleepZ3;
	public $ptChannelVolumeFL;
	public $ptChannelVolumeFR;
	public $ptChannelVolumeC;
	public $ptChannelVolumeSW;
	public $ptChannelVolumeSW2;
	public $ptChannelVolumeSL;
	public $ptChannelVolumeSR;
	public $ptChannelVolumeSBL;
	public $ptChannelVolumeSBR;
	public $ptChannelVolumeSB;
	public $ptChannelVolumeFHL;
	public $ptChannelVolumeFHR;
	public $ptChannelVolumeFWL;
	public $ptChannelVolumeFWR;
	public $ptNavigation;
	public $ptContrast;
	public $ptBrightness;
	public $ptChromalevel;
	public $ptHue;
	public $ptEnhancer;
	public $ptSubwoofer;
	public $ptSubwooferATT;
	public $ptDNRDirectChange;
	public $ptEffect;
	public $ptAFDM;
	public $ptEffectLevel;
	public $ptCenterImage;
	public $ptStageWidth;
	public $ptStageHeight;
	public $ptAudysseyDSX;
	public $ptReferenceLevel;
	public $ptDRCDirectChange;
	public $ptSpeakerOutputFront;
	public $ptDCOMPDirectChange;
	public $ptHDMIMonitor;
	public $ptASP;
	public $ptResolution;
	public $ptResolutionHDMI;
	public $ptHDMIAudioOutput;
	public $ptVideoProcessingMode;
	public $ptDolbyVolumeLeveler;
	public $ptDolbyVolumeModeler;
	public $ptPLIIZHeightGain;
	public $ptVerticalStretch;
	public $ptDolbyVolume;
	
	
	
	public function SetupVarDenonBool($profile)
	{
		//Ident, Name, Profile, Position 
		$profilesMainZone = array (
		$this->ptPower => array(DENON_API_Commands::PW, "Power", "~Switch", 1),
		$this->ptMainZonePower => array(DENON_API_Commands::ZM, "MainZonePower", "~Switch", 2),
		$this->ptMainMute => array(DENON_API_Commands::MU, "MainMute", "~Switch", 3),
		$this->ptCinemaEQ => array(DENON_API_Commands::PSCINEMAEQ, "CinemaEQ", "~Switch", 4),
		$this->ptDynamicEQ => array(DENON_API_Commands::PSDYNEQ, "DynamicEQ", "~Switch", 8),
		$this->ptFrontHeight => array(DENON_API_Commands::PSFH, "FrontHeight", "~Switch", 6),
		$this->ptPanorama => array(DENON_API_Commands::PSPAN, "Panorama", "~Switch", 5),
		$this->ptToneCTRL => array(DENON_API_Commands::PSTONE, "ToneCTRL", "~Switch", 7),
		$this->ptVerticalStretch => array(DENON_API_Commands::VSVST, "VerticalStretch", "~Switch", 9),
		$this->ptDolbyVolume => array(DENON_API_Commands::PSDOLVOL, "DolbyVolume", "~Switch", 10),
		$this->ptEffect => array(DENON_API_Commands::PSEFF, "Effect", "~Switch", 11),
		$this->ptAFDM => array(DENON_API_Commands::PSAFD, "AFDM", "~Switch", 12),
		$this->ptSubwoofer => array(DENON_API_Commands::PSSWR, "Subwoofer", "~Switch", 13),
		$this->ptSubwooferATT => array(DENON_API_Commands::PSATT, "SubwooferATT", "~Switch", 14 )
		);
		
		$profilesZone2 = array (
		$this->ptZone2Power => array(DENON_API_Commands::Z2, "Zone 2 Power", "~Switch", 1),
		$this->ptZone2Mute => array(DENON_API_Commands::Z2MU, "Zone 2 Mute", "~Switch", 1),
		$this->ptZone2HPF => array(DENON_API_Commands::Z2HPF, "Zone 2 HPF", "~Switch", 1)
		);
		
		$profilesZone3 = array (
		$this->ptZone2Power => array(DENON_API_Commands::Z3, "Zone 3 Power", "~Switch", 1),
		$this->ptZone2Mute => array(DENON_API_Commands::Z3MU, "Zone 3 Mute", "~Switch", 1),
		$this->ptZone2HPF => array(DENON_API_Commands::Z3HPF, "Zone 3 HPF", "~Switch", 1)
		);
		
		if($this->Zone == 0)
		{
			$profilebool = $this->sendprofilebool($profilesMainZone);
			return $profilebool;
		}
		elseif ($this->Zone == 1)
		{
			$profilebool = $this->sendprofilebool($profilesZone2);
			return $profilebool;
		}
		elseif ($this->Zone == 2)
		{
			$profilebool = $this->sendprofilebool($profilesZone3);
			return $profilebool;
		}
		
	}
	
	private function sendprofilebool($profiles)
	{
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
			   $profilebool = array(
			   "Name" => $profilvar[1],
			   "Ident" => $profilvar[0],
			   "ProfilName" => $profilvar[2],
			   "Position" => $profilvar[3]
			   );
			   
			   return $profilebool;
			}

		}	
	}
	
	protected function SetupVarDenonInteger($profile)
	{
		//Sichtbare variablen profil suchen
		$profilesMainZone = array(
        $this->ptSleep => array(DENON_API_Commands::SLP, "Sleep", "Intensity",  "", "", 0, 120, 10, 0),
		$this->ptDimension => array(DENON_API_Commands::PSDIM, "Dimension", "Intensity",  "", "", 0, 6, 1, 0)
		);
		
		$profilesZone2 = array(
        $this->ptSleepZ2 => array(DENON_API_Commands::Z2SLP, "Sleep", "Intensity",  "", "", 0, 120, 10, 0)
		);
		
		$profilesZone3 = array(
        $this->ptSleepZ3 => array(DENON_API_Commands::Z3SLP, "Sleep", "Intensity",  "", "", 0, 120, 10, 0)
		);
		
		if($this->Zone == 0)
		{
			$profileinteger = $this->sendprofileinteger($profilesMainZone);
			return $profileinteger;
		}
		elseif ($this->Zone == 1)
		{
			$profileinteger = $this->sendprofileinteger($profilesZone2);
			return $profileinteger;
		}
		elseif ($this->Zone == 2)
		{
			$profileinteger = $this->sendprofileinteger($profilesZone3);
			return $profileinteger;
		}
		
	}
	
	private function sendprofileinteger($profiles)
	{
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
				$pos = $this->getpos($profile);
				$profileinteger = array(
				"ProfilName" => $ptName,
				"Name" => $profilvar[1],
				"Ident" => $profilvar[0],
				"Icon" => $profilvar[2],
				"Prefix" => $profilvar[3],
				"Suffix" => $profilvar[4],
				"MinValue" => $profilvar[5],
				"MaxValue" => $profilvar[6],
				"Stepsize" => $profilvar[7],
				"Digits" => $profilvar[8],
				"Position" => $pos
				);
			   
			   return $profileinteger;
			}

		}	
	}
	
	protected function SetupVarDenonIntegerAss($profile)
	{
		//Sichtbare variablen profil suchen
		//Associations
		//Associations Value, Association, Icon, Color

		$ProfilAssociationsMainZone = array
		(
			$this->ptNavigation => array(
				"Ident" => DENON_API_Commands::MN,
				"Name" => "Navigation",
				"Profilesettings" => Array("Move", "", "", 0, 5, 0, 0),
				"Associations" => array(
				Array(0, "Left",  "", -1),
				Array(1, "Down",  "", -1),
				Array(2, "Up",  "", -1),
				Array(3, "Right",  "", -1),
				Array(4, "Enter",  "", -1),
				Array(5, "Return",  "", -1)
				)		
			),
			$this->ptInputSource => array(
				"Ident" => DENON_API_Commands::SI,
				"Name" => "Input Source",
				"Profilesettings" => Array("Database", "", "", 0, 19, 0, 0),
				"Associations" => array(
				Array(0, "Phono",  "", -1),
				Array(1, "CD",  "", -1),
				Array(2, "Tuner",  "", -1),
				Array(3, "DVD",  "", -1),
				Array(4, "BD",  "", -1),
				Array(5, "TV",  "", -1),
				Array(6, "SAT/CBL",  "", -1),
				Array(7, "DVR",  "", -1),
				Array(8, "GAME",  "", -1),
				Array(9, "V.AUX",  "", -1),
				Array(10, "DOCK",  "", -1),
				Array(11, "IPOD",  "", -1),
				Array(12, "NET/USB",  "", -1),
				Array(13, "NAPSTER",  "", -1),
				Array(14, "LASTFM",  "", -1),
				Array(15, "FLICKR",  "", -1),
				Array(16, "FAVORITES",  "", -1),
				Array(17, "IRADIO",  "", -1),
				Array(18, "SERVER",  "", -1),
				Array(19, "USB/IPOD",  "", -1)
				)
			),
			$this->ptQuickSelect => array(
				"Ident" => DENON_API_Commands::MSQUICK,
				"Name" => "Quick Select",
				"Profilesettings" => Array("Intensity", "", "", 0, 5, 1, 0),
				"Associations" => array(
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
				)
			),
			$this->ptDigitalInputMode => array(
				"Ident" => DENON_API_Commands::DC,
				"Name" => "Input Mode",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 1, 0),
				"Associations" => Array(
				Array(0, "AUTO",  "", -1),
				Array(1, "PCM",  "", -1),
				Array(2, "DTS",  "", -1)
				)
			),
			$this->ptSurroundMode => array(
				"Ident" => DENON_API_Commands::MS,
				"Name" => "Surround Mode",
				"Profilesettings" => Array("Intensity", "", "", 0, 15, 0, 0),
				"Associations" => Array(
				Array(0, "DIRECT",  "", -1),
				Array(1, "PURE DIRECT",  "", -1),
				Array(2, "STEREO",  "", -1),
				Array(3, "STANDARD",  "", -1),
				Array(4, "DOLBY DIGITAL",  "", -1),
				Array(5, "DTS SURROUND",  "", -1),
				Array(6, "MCH STEREO",  "", -1),
				Array(7, "WIDESCREEN",  "", -1),
				Array(8, "SUPERSTADIUM",  "", -1),
				Array(9, "ROCK ARENA",  "", -1),
				Array(10, "JAZZ CLUB",  "", -1),
				Array(11, "CLASSICCONCERT",  "", -1),
				Array(12, "MONO MOVIE",  "", -1),
				Array(13, "MATRIX",  "", -1),
				Array(14, "VIDEO GAME",  "", -1),
				Array(15, "VIRTUAL",  "", -1)
				)
			),
			$this->ptSurroundPlayMode => array(
				"Ident" => DENON_API_Commands::PSMODE,
				"Name" => "SurroundPlayMode",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 1, 0),
				"Associations" => Array(
				Array(0, "CINEMA",  "", -1),
				Array(1, "MUSIC",  "", -1),
				Array(2, "GAME",  "", -1),
				Array(3, "PRO LOGIC",  "", -1)
				)
			),
			$this->ptMultiEQMode => array(
				"Ident" => DENON_API_Commands::PSMULTEQ,
				"Name" => "Multi EQ Mode",
				"Profilesettings" => Array("Intensity", "", "", 0, 4, 1, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "AUDYSSEY",  "", -1),
				Array(2, "BYP.LR",  "", -1),
				Array(3, "FLAT",  "", -1),
				Array(4, "MANUAL",  "", -1)
				)
			),
			$this->ptAudioRestorer => array(
				"Ident" => DENON_API_Commands::PSRSTR,
				"Name" => "Audio Restorer",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 1, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "Restorer 64",  "", -1),
				Array(2, "Restorer 96",  "", -1),
				Array(3, "Restorer HQ",  "", -1)
				)
			),
			$this->ptDynamicVolume => array(
				"Ident" => DENON_API_Commands::PSDYNVOL,
				"Name" => "Dynamic Volume",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 1, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "Midnight",  "", -1),
				Array(2, "Evening",  "", -1),
				Array(3, "Day",  "", -1)
				)
			),
			$this->ptRoomSize => array(
				"Ident" => DENON_API_Commands::PSRSZ,
				"Name" => "Room Size",
				"Profilesettings" => Array("Intensity", "", "", 0, 4, 1, 0),
				"Associations" => Array(
				Array(0, "Small",  "", -1),
				Array(1, "Small/Medium",  "", -1),
				Array(2, "Medium",  "", -1),
				Array(3, "Medium/Large",  "", -1),
				Array(4, "Large",  "", -1)
				)
			),
			$this->ptDynamicCompressor => array(
				"Ident" => DENON_API_Commands::DCO,
				"Name" => "Dynamic Compressor",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 1, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "LOW",  "", -1),
				Array(2, "MID",  "", -1),
				Array(3, "HIGH",  "", -1)
				)
			),
			$this->ptDynamicRange => array(
				"Ident" => DENON_API_Commands::DRC,
				"Name" => "Dynamic Range",
				"Profilesettings" => Array("Intensity", "", "", 0, 4, 1, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "AUTO",  "", -1),
				Array(2, "LOW",  "", -1),
				Array(3, "MID",  "", -1),
				Array(4, "HI",  "", -1)
				)
			),
			$this->ptVideoSelect => array(
				"Ident" => DENON_API_Commands::SV,
				"Name" => "Video Select",
				"Profilesettings" => Array("Intensity", "", "", 0, 8, 1, 0),
				"Associations" => Array(
				Array(0, "DVD",  "", -1),
				Array(1, "BD",  "", -1),
				Array(2, "TV",  "", -1),
				Array(3, "SAT/CBL",  "", -1),
				Array(4, "DVR",  "", -1),
				Array(5, "GAME",  "", -1),
				Array(6, "V.AUX",  "", -1),
				Array(7, "DOCK",  "", -1),
				Array(8, "SOURCE",  "", -1)
				)
			),
			$this->ptSurroundBackMode => array(
				"Ident" => DENON_API_Commands::PSSB,
				"Name" => "Surround Back Mode",
				"Profilesettings" => Array("Intensity", "", "", 0, 4, 1, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "ON",  "", -1),
				Array(2, "MTRX ON",  "", -1),
				Array(3, "PL2X CINEMA",  "", -1),
				Array(4, "PL2X MUSIC",  "", -1)
				)
			),
			$this->ptHDMIMonitor => array(
				"Ident" => DENON_API_Commands::VSMONI,
				"Name" => "HDMI Monitor",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 1, 0),
				"Associations" => Array(
				Array(0, "Auto",  "", -1),
				Array(1, "Monitor 1",  "", -1),
				Array(2, "Monitor 2",  "", -1)
				)
			),
			$this->ptSpeakerOutputFront => array(
				"Ident" => DENON_API_Commands::PSSP,
				"Name" => "Speaker Output Front",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 1, 0),
				"Associations" => Array(
				Array(0, "Front Height",  "", -1),
				Array(1, "Front Weight",  "", -1),
				Array(2, "HW",  "", -1),
				Array(3, "Off",  "", -1)
				)
			),
			$this->ptReferenceLevel => array(
				"Ident" => DENON_API_Commands::PSREFLEV,
				"Name" => "Reference Level",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 1, 0),
				"Associations" => Array(
				Array(0, "Offset 0",  "", -1),
				Array(1, "Offset 5",  "", -1),
				Array(2, "Offset 10",  "", -1),
				Array(3, "Offset 15",  "", -1)
				)
			),
			$this->ptPLIIZHeightGain => array(
				"Ident" => DENON_API_Commands::PSPHG,
				"Name" => "PLIIZ Height Gain",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 1, 0),
				"Associations" => Array(
				Array(0, "Low",  "", -1),
				Array(1, "Mid",  "", -1),
				Array(2, "High",  "", -1)
				)
			),
			$this->ptDolbyVolumeModeler => array(
				"Ident" => DENON_API_Commands::PSVOLMOD,
				"Name" => "Dolby Volume Modeler",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 1, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Half",  "", -1),
				Array(2, "Full",  "", -1)
				)
			),
			$this->ptDolbyVolumeLeveler => array(
				"Ident" => DENON_API_Commands::PSVOLLEV,
				"Name" => "Dolby Volume Leveler",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 1, 0),
				"Associations" => Array(
				Array(0, "Low",  "", -1),
				Array(1, "Middle",  "", -1),
				Array(2, "High",  "", -1)
				)
			),
			$this->ptVideoProcessingMode => array(
				"Ident" => DENON_API_Commands::VSVPM,
				"Name" => "Video Processing Mode",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 1, 0),
				"Associations" => Array(
				Array(0, "Auto",  "", -1),
				Array(1, "Game",  "", -1),
				Array(2, "Movie",  "", -1)
				)
			),
			$this->ptHDMIAudioOutput => array(
				"Ident" => DENON_API_Commands::VSAUDIO,
				"Name" => "HDMI Audio Output",
				"Profilesettings" => Array("Intensity", "", "", 0, 1, 1, 0),
				"Associations" => Array(
				Array(0, "TV",  "", -1),
				Array(1, "AMP",  "", -1)
				)
			),
			$this->ptResolutionHDMI => array(
				"Ident" => DENON_API_Commands::VSSCH,
				"Name" => "Resolution HDMI",
				"Profilesettings" => Array("Intensity", "", "", 0, 5, 1, 0),
				"Associations" => Array(
				Array(0, "480p/576p",  "", -1),
				Array(1, "1080i",  "", -1),
				Array(2, "720p",  "", -1),
				Array(3, "1080p",  "", -1),
				Array(4, "1080p 24Hz",  "", -1),
				Array(5, "Auto", "", -1)
				)
			),
			$this->ptResolution => array(
				"Ident" => DENON_API_Commands::VSSC,
				"Name" => "Resolution",
				"Profilesettings" => Array("Intensity", "", "", 0, 5, 1, 0),
				"Associations" => Array(
				Array(0, "480p/576p",  "", -1),
				Array(1, "1080i",  "", -1),
				Array(2, "720p",  "", -1),
				Array(3, "1080p",  "", -1),
				Array(4, "1080p 24Hz",  "", -1),
				Array(5, "Auto", "", -1)
				)
			),
			$this->ptASP => array(
				"Ident" => DENON_API_Commands::VSASP,
				"Name" => "ASP",
				"Profilesettings" => Array("Intensity", "", "", 0, 1, 1, 0),
				"Associations" => Array(
				Array(0, "Normal",  "", -1),
				Array(1, "Full",  "", -1)
				)
			),
			$this->ptDNRDirectChange => array(
				"Ident" => DENON_API_Commands::PVDNR,
				"Name" => "DNR Direct Change",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 1, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "Low",  "", -1),
				Array(2, "Middle",  "", -1),
				Array(3, "High",  "", -1)
				)
			),
			$this->ptInputMode => array(
				"Ident" => DENON_API_Commands::SD,
				"Name" => "Input Mode",
				"Profilesettings" => Array("Database", "", "", 0, 4, 1, 0),
				"Associations" => Array(
				Array(0, "AUTO",  "", -1),
				Array(1, "HDMI",  "", -1),
				Array(2, "DIGITAL",  "", -1),
				Array(3, "ANALOG",  "", -1),
				Array(4, "Ext.IN",  "", -1),				
				)
			)
		);
		
		$ProfilAssociationsZone2 = array
		(
			$this->ptZone2InputSource => array(
				"Ident" => DENON_API_Commands::Z2,
				"Name" => "Zone 2 Input Source",
				"Profilesettings" => Array("Database", "", "", 0, 19, 1, 0),
				"Associations" => Array(
				Array(0, "Phono",  "", -1),
				Array(1, "CD",  "", -1),
				Array(2, "Tuner",  "", -1),
				Array(3, "DVD",  "", -1),
				Array(4, "BD",  "", -1),
				Array(5, "TV",  "", -1),
				Array(6, "SAT/CBL",  "", -1),
				Array(7, "DVR",  "", -1),
				Array(8, "GAME",  "", -1),
				Array(9, "V.AUX",  "", -1),
				Array(10, "DOCK",  "", -1),
				Array(11, "IPOD",  "", -1),
				Array(12, "NET/USB",  "", -1),
				Array(13, "NAPSTER",  "", -1),
				Array(14, "LASTFM",  "", -1),
				Array(15, "FLICKR",  "", -1),
				Array(16, "FAVORITES",  "", -1),
				Array(17, "IRADIO",  "", -1),
				Array(18, "SERVER",  "", -1),
				Array(19, "USB/IPOD",  "", -1)
				)
			),
			$this->ptZone2ChannelSetting => array(
				"Ident" => DENON_API_Commands::Z2CS,
				"Name" => "",
				"Profilesettings" => Array("Database", "", "", 0, 1, 1, 0),
				"Associations" => Array(
				Array(0, "Stereo",  "", -1),
				Array(1, "Mono",  "", -1)
				)
			),
			$this->ptZone2QuickSelect => array(
				"Ident" => DENON_API_Commands::Z2QUICK,
				"Name" => "Zone 2 Quick Selektion",
				"Profilesettings" => Array("Database", "", "", 0, 5, 1, 0),
				"Associations" => Array(
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
				)
			)
		);
		
		
		$ProfilAssociationsZone3 = array
		(
			$this->ptZone3InputSource => array(
				"Ident" => DENON_API_Commands::Z3,
				"Name" => "Input Source",
				"Profilesettings" => Array("Database", "", "", 0, 19, 1, 0),
				"Associations" => Array(
				Array(0, "Phono",  "", -1),
				Array(1, "CD",  "", -1),
				Array(2, "Tuner",  "", -1),
				Array(3, "DVD",  "", -1),
				Array(4, "BD",  "", -1),
				Array(5, "TV",  "", -1),
				Array(6, "SAT/CBL",  "", -1),
				Array(7, "DVR",  "", -1),
				Array(8, "GAME",  "", -1),
				Array(9, "V.AUX",  "", -1),
				Array(10, "DOCK",  "", -1),
				Array(11, "IPOD",  "", -1),
				Array(12, "NET/USB",  "", -1),
				Array(13, "NAPSTER",  "", -1),
				Array(14, "LASTFM",  "", -1),
				Array(15, "FLICKR",  "", -1),
				Array(16, "FAVORITES",  "", -1),
				Array(17, "IRADIO",  "", -1),
				Array(18, "SERVER",  "", -1),
				Array(19, "USB/IPOD",  "", -1)
				)
			),
			$this->ptZone3ChannelSetting => array(
				"Ident" => DENON_API_Commands::Z3CS,
				"Name" => "Channel Setting",
				"Profilesettings" => Array("Database", "", "", 0, 1, 1, 0),
				"Associations" => Array(
				Array(0, "Stereo",  "", -1),
				Array(1, "Mono",  "", -1)
				)
			),
			$this->ptZone3QuickSelect => array(
				"Ident" => DENON_API_Commands::Z3QUICK,
				"Name" => "Quick Select",
				"Profilesettings" => Array("Database", "", "", 0, 5, 1, 0),
				"Associations" => Array(
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
				)
			)
		);
		
		if($this->Zone == 0)
		{
			$profileintegerass = $this->sendprofileintegerass($ProfilAssociationsMainZone);
			return $profileintegerass;
		}
		elseif ($this->Zone == 1)
		{
			$profileintegerass = $this->sendprofileintegerass($ProfilAssociationsZone2);
			return $profileintegerass;
		}
		elseif ($this->Zone == 2)
		{
			$profileintegerass = $this->sendprofileintegerass($ProfilAssociationsZone3);
			return $profileintegerass;
		}
		
		
	}
	
	private function sendprofileintegerass($ProfilAssociationsZone)
	{
		foreach($ProfilAssociationsZone as $ptName => $profilvar)
			{
				if($ptName == $profile)
				{
					$pos = $this->getpos($profile);
				    $profilesettings = $profilvar["Profilesettings"];
					$Ident = $profilvar["Ident"];
					$Name = $profilvar["Name"];
					$profileintegerass = array(
					"ProfilName" => $ptName,
					"Ident" => $Ident,
					"Name" => $Name,
					"Icon" => $profilesettings[0],
					"Prefix" => $profilesettings[1],
					"Suffix" => $profilesettings[2],
					"MinValue" => $profilesettings[3],
					"MaxValue" => $profilesettings[4],
					"Stepsize" => $profilesettings[5],
					"Digits" => $profilesettings[6],
					"Associations" => $profilvar["Associations"],
					"Position" => $pos
				   );
				   
				   return $profileintegerass;
				}

			}	
	}
	
	
	protected function SetupVarDenonFloat($profile)
	{
		//Sichtbare variablen profil suchen
		$profilesMainzone = array(
		$this->ptMasterVolume => array(DENON_API_Commands::MV, "MasterVolume", "Intensity", "", " %", -80.0, 18.0, 0.5, 0),
		$this->ptChannelVolumeFL => array(DENON_API_Commands::CVFL, "ChannelVolumeFL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFR => array(DENON_API_Commands::CVFR, "ChannelVolumeFR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeC => array(DENON_API_Commands::CVC, "ChannelVolumeC", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSW => array(DENON_API_Commands::CVSW, "ChannelVolumeSW", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSW2 => array(DENON_API_Commands::CVSW2, "ChannelVolumeSW2", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSL => array(DENON_API_Commands::CVSL, "ChannelVolumeSL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSR => array(DENON_API_Commands::CVSR, "ChannelVolumeSR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSBL => array(DENON_API_Commands::CVSBL, "ChannelVolumeSBL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSBR => array(DENON_API_Commands::CVSBR, "ChannelVolumeSBR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSB => array(DENON_API_Commands::CVSB, "ChannelVolumeSB", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFHL => array(DENON_API_Commands::CVFHL, "ChannelVolumeFHL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFHR => array(DENON_API_Commands::CVFHR, "ChannelVolumeFHR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFWL => array(DENON_API_Commands::CVFWL, "ChannelVolumeFWL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFWR => array(DENON_API_Commands::CVFWR, "ChannelVolumeFWR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptAudioDelay => array(DENON_API_Commands::PSDEL, "AudioDelay", "Intensity", "", " ms", 0, 200, 0, 0),
		$this->ptLFELevel => array(DENON_API_Commands::PSLFE, "LFELevel", "Intensity", "", " dB", -10.0, 0.0, 0.5, 1),
		$this->ptBassLevel => array(DENON_API_Commands::PSBAS, "BassLevel", "Intensity", "", " dB", -6, 6, 1.0, 0),
		$this->ptTrebleLevel => array(DENON_API_Commands::PSTRE, "TrebleLevel", "Intensity", "", " dB", -6, 6, 1.0, 0),
		$this->ptCenterWidth => array(DENON_API_Commands::PSDCO, "CenterWidth", "Intensity",  "", "", 0, 7, 1, 0),
		$this->ptEffectLevel => array(DENON_API_Commands::PSEFF, "EffectLevel", "Intensity", "", "", 0, 15, 1, 0),
		$this->ptCenterImage => array(DENON_API_Commands::PSCEN, "CenterImage", "Intensity", "", "", 0.0, 1.0, 0.1, 0),
		$this->ptContrast => array(DENON_API_Commands::PVCN, "Contrast", "Intensity", "", "", -6, 6, 1, 0),
		$this->ptBrightness => array(DENON_API_Commands::PVBR, "Brightness", "Intensity", "", "", 0, 12, 1, 0),
		$this->ptChromalevel => array(DENON_API_Commands::PVCM, "Chromalevel", "Intensity", "", "", -6, 6, 1, 0),
		$this->ptHue => array(DENON_API_Commands::PVHUE, "Hue", "Intensity", "", "", -6, 6, 1, 0),
		$this->ptEnhancer => array(DENON_API_Commands::PVENH, "Enhancer", "Intensity", "", "", 0, 12, 1, 0),
		$this->ptStageHeight => array(DENON_API_Commands::PSSTH, "StageHeight", "Intensity", "", "", -10, 10, 1, 0),
		$this->ptStageWidth => array(DENON_API_Commands::PSSTW, "StageWidth", "Intensity", "", "", -10, 10, 1, 0)
		);
				
		$profilesZone2 = array(
		$this->ptZone2Volume => array(DENON_API_Commands::Z2, "Zone 3 Volume", "Intensity", "", " %", -80.0, 18.0, 0.5, 0),
		$this->ptZone2ChannelVolumeFL => array(DENON_API_Commands::Z2CVFL, "Zone2ChannelVolumeFL", "Intensity", "", " %", -10.0, 10.0, 0.5, 0),
		$this->ptZone2ChannelVolumeFR => array(DENON_API_Commands::Z2CVFR, "Zone2ChannelVolumeFR", "Intensity", "", " %", -10.0, 10.0, 0.5, 0)
		);
		
		$profilesZone3 = array(
		$this->ptZone3Volume => array(DENON_API_Commands::Z3, "Zone 3 Volume", "Intensity", "", " %", -80.0, 18.0, 0.5, 0),
		$this->ptZone3ChannelVolumeFL => array(DENON_API_Commands::Z3CVFL, "Zone 3 Channel Volume FL", "Intensity", "", " %", -10.0, 10.0, 0.5, 0),
		$this->ptZone3ChannelVolumeFR => array(DENON_API_Commands::Z3CVFR, "Zone 3 Channel Volume FR", "Intensity", "", " %", -10.0, 10.0, 0.5, 0)
		);
		
		if ($this->Zone == 0)
		{
			$profilefloat = $this->sendprofilefloat($profilesMainzone);
			return $profilefloat;
		}
		elseif ($this->Zone == 1)
		{
			$profilefloat = $this->sendprofilefloat($profilesZone2);
			return $profilefloat;
		}
		elseif ($this->Zone == 2)
		{
			$profilefloat = $this->sendprofilefloat($profilesZone3);
			return $profilefloat;
		}
	}

	
	private function sendprofilefloat($profilesZone)
	{
		foreach($profilesZone as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
				$pos = $this->getpos($profile);
				$Ident = $profilvar[0];
				$Name = $profilvar[1];
				$profilefloat = array(
				"ProfilName" => $ptName,
				"Name" => $Name,
				"Ident" => $Ident,
				"Icon" => $profilvar[2],
				"Prefix" => $profilvar[3],
				"Suffix" => $profilvar[4],
				"MinValue" => $profilvar[5],
				"MaxValue" => $profilvar[6],
				"Stepsize" => $profilvar[7],
				"Digits" => $profilvar[8],
				"Position" => $pos
			   
			   
			   );
			   
			   return $profilefloat;
			}

		}	
	}
	
	private function getpos($profile)
	{
		$positions = array 
						( 
                            $this->ptPower => 10,
							$this->ptMainZonePower => 11,
							$this->ptMainMute => 12,
							$this->ptMasterVolume => 13,
							$this->ptInputSource => 14,
							$this->ptSurroundMode => 15,
							$this->ptNavigation => 16,
							$this->ptDynamicVolume => 17,
							$this->ptCinemaEQ => 18,
							$this->ptPanorama => 19,
							$this->ptChannelVolumeFL => 20,
							$this->ptChannelVolumeFR => 21,
							$this->ptChannelVolumeC => 22,
							$this->ptChannelVolumeSW => 23,
							$this->ptChannelVolumeSW2 => 24,
							$this->ptChannelVolumeSL => 25,
							$this->ptChannelVolumeSR => 26,
							$this->ptChannelVolumeSBL => 27,
							$this->ptChannelVolumeSBR => 28,
							$this->ptChannelVolumeFHL => 29,
							$this->ptChannelVolumeFHR => 30,
							$this->ptChannelVolumeFWL => 31,
							$this->ptChannelVolumeFWR => 32,
							$this->ptFrontHeight => 33,
							$this->ptToneCTRL => 34,
							$this->ptDynamicEQ => 35,
							$this->ptAudioDelay => 36,
							$this->ptLFELevel => 37,
							$this->ptQuickSelect => 38,
							$this->ptSleep => 39,
							$this->ptDigitalInputMode => 40,
							$this->ptSurroundPlayMode => 41,
							$this->ptMultiEQMode => 42,
							$this->ptAudioRestorer => 43,
							$this->ptBassLevel => 44,
							$this->ptTrebleLevel => 45,
							$this->ptDimension => 46,
							$this->ptRoomSize => 47,
							$this->ptDynamicCompressor => 48,
							$this->ptCenterWidth => 49,
							$this->ptDynamicRange => 50,
							$this->ptVideoSelect => 51,
							$this->ptSurroundBackMode => 52,
							$this->ptPreset => 53,
							$this->ptInputMode => 54,
							$this->ptZone2Power => 55,
							$this->ptZone2Mute => 56,
							$this->ptZone2Volume => 57,
							$this->ptZone2InputSource => 58,
							$this->ptZone2ChannelSetting => 59,
							$this->ptZone2ChannelVolumeFL => 60,
							$this->ptZone2ChannelVolumeFR => 61,
							$this->ptZone2QuickSelect => 62,
							$this->ptZone3Power => 63,
							$this->ptZone3Mute => 64,
							$this->ptZone3Volume => 65,
							$this->ptZone3InputSource => 66,
							$this->ptZone3ChannelSetting => 67,
							$this->ptZone3ChannelVolumeFL => 68,
							$this->ptZone3ChannelVolumeFR => 69,
							$this->ptZone3QuickSelect => 70,
							$this->ptNavigation => 71,
							$this->ptContrast => 72,
							$this->ptBrightness => 73,
							$this->ptChromalevel => 74,
							$this->ptHue => 75,
							$this->ptEnhancer => 76,
							$this->ptSubwoofer => 77,
							$this->ptSubwooferATT => 78,
							$this->ptDNRDirectChange => 79,
							$this->ptEffect => 80,
							$this->ptAFDM => 81,
							$this->ptEffectLevel => 82,
							$this->ptCenterImage => 84,
							$this->ptStageWidth => 85,
							$this->ptStageHeight => 86,
							$this->ptAudysseyDSX => 87,
							$this->ptReferenceLevel => 88,
							$this->ptDRCDirectChange => 89,
							$this->ptSpeakerOutputFront => 90,
							$this->ptDCOMPDirectChange => 91,
							$this->ptHDMIMonitor => 92,
							$this->ptASP => 93,
							$this->ptResolution => 94,
							$this->ptResolutionHDMI => 95,
							$this->ptHDMIAudioOutput => 96,
							$this->ptVideoProcessingMode => 97,
							$this->ptDolbyVolumeLeveler => 98,
							$this->ptDolbyVolumeModeler => 99,
							$this->ptPLIIZHeightGain => 100,
							$this->ptVerticalStretch => 101,
							$this->ptDolbyVolume => 102
							
							
						);
		foreach($positions as $ptName => $position)
		{
			if($ptName == $profile)
			{
			   return $position;
			}

		}				
	}
}

class DENON_StatusHTML extends stdClass
{
	//Status
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
			$MainZone["FriendlyName"]["Name"] = "FriendlyName";
			$MainZone["FriendlyName"]["Value"] = (string)$FriendlyName[0]->value;
			$MainZone["FriendlyName"]["Profile"] = $this->ptFriendlyname;
		}

		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{
			$MainZone["Power"]["Name"] = "Power";
			$MainZone["Power"]["Value"] = (string)$AVRPower[0]->value;
			$MainZone["Power"]["Profile"] = $this->ptPower;
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$MainZone["MainZonePower"]["Name"] = "MainZonePower";
			$MainZone["MainZonePower"]["Value"] = (string)$ZonePower[0]->value;
			$MainZone["MainZonePower"]["Profile"] = $this->ptMainZonePower;
		}

		//RenameZone
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$MainZone["MainZoneName"]["Name"] = "MainZoneName";
			$MainZone["MainZoneName"]["Value"] = (string)$RenameZone[0]->value;
			$MainZone["MainZoneName"]["Profile"] = 3; //Vartype String
		}



		//TopMenuLink
		$TopMenuLink = $xml->xpath('.//TopMenuLink');
		if ($TopMenuLink)
		{
			$MainZone["TopMenuLink"]["Name"] = "TopMenuLink";
			$MainZone["TopMenuLink"]["Value"] = (string)$TopMenuLink[0]->value;
			$MainZone["TopMenuLink"]["Profile"] = 3; //Vartype String
		}


		//ModelId
		$ModelId = $xml->xpath('.//ModelId');
		if ($ModelId)
		{
			$MainZone["ModelId"]["Name"] = "ModelId";
			$MainZone["ModelId"]["Value"] = (string)$ModelId[0]->value;
			$MainZone["ModelId"]["Profile"] = 3; //Vartype String
		}


		//SalesArea
		$SalesArea = $xml->xpath('.//SalesArea');
		if ($SalesArea)
		{
			$MainZone["SalesArea"]["Name"] = "SalesArea";
			$MainZone["SalesArea"]["Value"] = (string)$SalesArea[0]->value;
			$MainZone["SalesArea"]["Profile"] = 3; //Vartype String
		}


		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
		{
			$MainZone["InputFuncSelect"]["Name"] = "InputFuncSelect";
			$MainZone["InputFuncSelect"]["Value"] = (string)$InputFuncSelect[0]->value;
			$MainZone["InputFuncSelect"]["Profile"] = 3; //Vartype String
		}


		//NetFuncSelect
		$NetFuncSelect = $xml->xpath('.//NetFuncSelect');
		if ($NetFuncSelect)
		{
			$MainZone["NetFuncSelect"]["Name"] = "NetFuncSelect";
			$MainZone["NetFuncSelect"]["Value"] = (string)$NetFuncSelect[0]->value;
			$MainZone["NetFuncSelect"]["Profile"] = 3; //Vartype String
		}


		//InputFuncSelectMain
		$InputFuncSelectMain = $xml->xpath('.//InputFuncSelectMain');
		if ($InputFuncSelectMain)
		{
		   $MainZone["InputFuncSelectMain"]["Name"] = "InputFuncSelectMain";
			$MainZone["InputFuncSelectMain"]["Value"] = (string)$InputFuncSelectMain[0]->value;
			$MainZone["InputFuncSelectMain"]["Profile"] = 3; //Vartype String
		}

		//selectSurround
		$selectSurround = $xml->xpath('.//selectSurround');
		if ($selectSurround)
		{
			$MainZone["selectSurround"]["Name"] = "selectSurround";
			$MainZone["selectSurround"]["Value"] = (string)$selectSurround[0]->value;
			$MainZone["selectSurround"]["Profile"] = 3; //Vartype String
		}

		//VolumeDisplay
		$VolumeDisplay = $xml->xpath('.//VolumeDisplay');
		if ($VolumeDisplay)
		{
			$MainZone["VolumeDisplay"]["Name"] = "VolumeDisplay";
			$MainZone["VolumeDisplay"]["Value"] = (string)$VolumeDisplay[0]->value;
			$MainZone["VolumeDisplay"]["Profile"] = 3; //Vartype String
		}



		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$MainZone["MasterVolume"]["Name"] = "MasterVolume";
			$MainZone["MasterVolume"]["Value"] = (string)$MasterVolume[0]->value;
			$MainZone["MasterVolume"]["Profile"] = 2; //Vartype Float
		}


		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MainZone["Mute"]["Name"] = "Mute";
			$MainZone["Mute"]["Value"] = (string)$Mute[0]->value;
			$MainZone["Mute"]["Profile"] = 0; //Vartype Bool
		}


		//RemoteMaintenance
		$RemoteMaintenance = $xml->xpath('.//RemoteMaintenance');
		if ($RemoteMaintenance)
		{
			$MainZone["RemoteMaintenance"]["Name"] = "RemoteMaintenance";
			$MainZone["RemoteMaintenance"]["Value"] = (string)$RemoteMaintenance[0]->value;
			$MainZone["RemoteMaintenance"]["Profile"] = 3; //Vartype String
		}


		//GameSourceDisplay
		$GameSourceDisplay = $xml->xpath('.//GameSourceDisplay');
		if ($GameSourceDisplay)
		{
			$MainZone["GameSourceDisplay"]["Name"] = "GameSourceDisplay";
			$MainZone["GameSourceDisplay"]["Value"] = (string)$GameSourceDisplay[0]->value;
			$MainZone["GameSourceDisplay"]["Profile"] = 3; //Vartype String
		}


		//LastfmDisplay
		$LastfmDisplay = $xml->xpath('.//LastfmDisplay');
		if ($LastfmDisplay)
		{
			$MainZone["LastfmDisplay"]["Name"] = "LastfmDisplay";
			$MainZone["LastfmDisplay"]["Value"] = (string)$LastfmDisplay[0]->value;
			$MainZone["LastfmDisplay"]["Profile"] = 3; //Vartype String
		}


		//SubwooferDisplay
		$SubwooferDisplay = $xml->xpath('.//SubwooferDisplay');
		if ($SubwooferDisplay)
		{
			$MainZone["SubwooferDisplay"]["Name"] = "SubwooferDisplay";
			$MainZone["SubwooferDisplay"]["Value"] = (string)$SubwooferDisplay[0]->value;
			$MainZone["SubwooferDisplay"]["Profile"] = 3; //Vartype String
		}


		//Zone2VolDisp
		$Zone2VolDisp = $xml->xpath('.//Zone2VolDisp');
		if ($Zone2VolDisp )
		{
			$MainZone["Zone2VolDisp"]["Name"] = "Zone2VolDisp";
			$MainZone["Zone2VolDisp"]["Value"] = (string)$Zone2VolDisp[0]->value;
			$MainZone["Zone2VolDisp"]["Profile"] = 3; //Vartype String
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
			$MainZoneStatus["RestorerMode"]["Name"] = "RestorerMode";
			$MainZoneStatus["RestorerMode"]["Value"] = (string)$RestorerMode[0]->value;
			$MainZoneStatus["RestorerMode"]["Profile"] = 3; //Vartype String
		}


		//SurrMode
		$SurrMode = $xml->xpath('.//SurrMode');
		if ($SurrMode )
		{
			$MainZoneStatus["SurrMode"]["Name"] = "SurrMode";
			$MainZoneStatus["SurrMode"]["Value"] = (string)$SurrMode[0]->value;
			$MainZoneStatus["SurrMode"]["Profile"] = 3; //Vartype String
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
			$MainZoneStatus["Inputs"]["Name"] = "Inputs";
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
			$MainZoneStatus["Inputs"]["Value"] = $Inputs;
			$MainZoneStatus["Inputs"]["MaxValue"] = $countUse; //Number
			
		}

		return $MainZoneStatus;
	}
	
	protected function NetAudioStatusXml($xml)
	{
		$NetAudioStatus = array();

		//Modell
		$szLine = $xml->xpath('.//szLine');
		$NetAudioStatus["Modell"]["Name"] = "Modell";
		$NetAudioStatus["Modell"]["Value"] = (string)$szLine[0]->value;
		$NetAudioStatus["Modell"]["Vartype"] = 3; //Vartype String
		

		return $NetAudioStatus;
	}
	
	protected function Deviceinfo($xml)
	{
		$Deviceinfo = array();

		//ModelName
		$ModelName = $xml->xpath('.//ModelName');
		//var_dump($ModelName);
		$Deviceinfo["ModelName"]["Name"] = "ModelName";
		$Deviceinfo["ModelName"]["Value"] = (string)$ModelName[0];
		$Deviceinfo["ModelName"]["Vartype"] = 3; //Vartype String

		return $Deviceinfo;
	}
}

class DENON_Zone extends stdClass
{

    const Mainzone = 0;
    const Zone2 = 1;
    const Zone3 = 2;
    
    public $thisZone;
	static $ZoneCMDs = array(
        DENON_Zone::Mainzone => array(
            DENON_API_Commands::PW,
			DENON_API_Commands::MV,
			DENON_API_Commands::CVFL,
			DENON_API_Commands::CVFR,
			DENON_API_Commands::CVC,
			DENON_API_Commands::CVSW,
			DENON_API_Commands::CVSW2,
			DENON_API_Commands::CVSL,
			DENON_API_Commands::CVSR,
			DENON_API_Commands::CVSBL,
			DENON_API_Commands::CVSBR,
			DENON_API_Commands::CVSB,
			DENON_API_Commands::CVFHL,
			DENON_API_Commands::CVFHR,
			DENON_API_Commands::CVFWL,
			DENON_API_Commands::CVFWR,
			DENON_API_Commands::MU,
			DENON_API_Commands::SI,
			DENON_API_Commands::ZM,
			DENON_API_Commands::SD,
			DENON_API_Commands::DC,
			DENON_API_Commands::SV,
			DENON_API_Commands::SLP,
			DENON_API_Commands::MS,
			DENON_API_Commands::MSQUICK,
			DENON_API_Commands::MSQUICKMEMORY,			
			DENON_API_Commands::PSATT,
			DENON_API_Commands::VSASP,
			DENON_API_Commands::VSSC,
			DENON_API_Commands::VSSCH,
			DENON_API_Commands::VSAUDIO,
			DENON_API_Commands::VSMONI,
			DENON_API_Commands::VSVPM,
			DENON_API_Commands::VSVST,
			DENON_API_Commands::PSTONE,
			DENON_API_Commands::PSSB,
			DENON_API_Commands::PSCINEMAEQ,
			DENON_API_Commands::PSMODE,
			DENON_API_Commands::PSDOLVOL,
			DENON_API_Commands::PSVOLLEV,
			DENON_API_Commands::PSVOLMOD,
			DENON_API_Commands::PSFH,
			DENON_API_Commands::PSPHG,
			DENON_API_Commands::PSSP,
			DENON_API_Commands::PSMULTEQ,
			DENON_API_Commands::PSDYNEQ,
			DENON_API_Commands::PSREFLEV,
			DENON_API_Commands::PSDYNVOL,
			DENON_API_Commands::PSDSX,
			DENON_API_Commands::PSSTW,
			DENON_API_Commands::PSSTH,
			DENON_API_Commands::PSBAS,
			DENON_API_Commands::PSTRE,
			DENON_API_Commands::PSDRC,
			DENON_API_Commands::PSDCO,
			DENON_API_Commands::PSLFE,
			DENON_API_Commands::PSEFF,
			DENON_API_Commands::PSDEL,
			DENON_API_Commands::PSAFD,
			DENON_API_Commands::PSPAN,
			DENON_API_Commands::PSDIM,
			DENON_API_Commands::PSCEN,
			DENON_API_Commands::PSCEI,
			DENON_API_Commands::PSRSTR,
			DENON_API_Commands::PSRSZ,
			DENON_API_Commands::PSSWR,
			DENON_API_Commands::PSATT,			
            DENON_API_Commands::PVCN,
            DENON_API_Commands::PVBR,
            DENON_API_Commands::PVCM,
            DENON_API_Commands::PVHUE,
            DENON_API_Commands::PVDNR,
            DENON_API_Commands::PVENH,
			DENON_API_Commands::MN

        ),
        DENON_Zone::Zone2 => array(
            DENON_API_Commands::Z2,
            DENON_API_Commands::Z2MU,
			DENON_API_Commands::Z2CS,
			DENON_API_Commands::Z2CVFL,
			DENON_API_Commands::Z2CVFR,
			DENON_API_Commands::Z2HPF,
			DENON_API_Commands::Z2PSBAS,
			DENON_API_Commands::Z2PSTRE,
			DENON_API_Commands::Z2SLP
        ),
        DENON_Zone::Zone3 => array(
            DENON_API_Commands::Z3,
			DENON_API_Commands::Z3MU,
			DENON_API_Commands::Z3CS,
			DENON_API_Commands::Z3CVFL,
			DENON_API_Commands::Z3CVFR,
			DENON_API_Commands::Z3HPF,
			DENON_API_Commands::Z3PSBAS,
			DENON_API_Commands::Z3PSTRE,
            DENON_API_Commands::Z3SLP
        )
		
    );
	
	public function CmdAvaiable(DenonAVRCP_API_Data $API_Data)
    {
        return (in_array($API_Data->APICommand, self::$ZoneCMDs[$this->thisZone]));
    }
	
	public function SubCmdAvaiable(DenonAVRCP_API_Data $API_Data)
    {

	//  IPS_LogMessage('APISubCommand', print_r($API_Data->APISubCommand, 1));
	//  IPS_LogMessage('ZoneCMDs', print_r(self::$ZoneCMDs[$this->thisZone], 1));
        if ($API_Data->APISubCommand <> null)
            if (property_exists($API_Data->APISubCommand, $this->thisZone))
                return (in_array($API_Data->APISubCommand->{$this->thisZone}, self::$ZoneCMDs[$this->thisZone]));
        return false;
    }
	
}

class DENON_API_Commands extends stdClass
{

//MAIN Zone
    const PW = "PW"; // Power
    const MV = "MV"; // Master Volume
	//const CV = "CV"; // Channel Volume
	//CV
	const CVFL = "CVFL"; // Channel Volume Front Left
	const CVFR = "CVFR"; // Channel Volume Front Right
	const CVC = "CVC"; // Channel Volume Center
	const CVSW = "CVSW"; // Channel Volume Subwoofer
	const CVSW2 = "CVSW2 "; // Channel Volume Subwoofer2
	const CVSL = "CVSL"; // Channel Volume Surround Left
	const CVSR = "CVSR"; // Channel Volume Surround Right
	const CVSBL = "CVSBL"; // Channel Volume Surround Back Left
	const CVSBR = "CVSBR"; // Channel Volume Surround Back Right
	const CVSB = "CVSB"; // Channel Volume Surround Back
	const CVFHL = "FHL"; // Channel Volume Front Height Left
	const CVFHR = "FHR"; // Channel Volume Front Height Right
	const CVFWL = "FWL"; // Channel Volume Front Wide Left
	const CVFWR = "FWR"; // Channel Volume Front Wide Right
	const MU = "MU"; // Volume Mute
	const SI = "SI"; // Select
	const ZM = "ZM"; // Main Zone
	const SD = "SD"; // Select Auto/HDMI/Digital/Analog
	const DC = "DC"; // Select Auto/PCM/DTS
	const SV = "SV"; // Video Select
	const SLP = "SLP"; // Main Zone Sleep Timer
	const MS = "MS"; // Select Surround Mode
	const MSQUICK = "QUICK"; // Quick Select Mode Select
	const MSQUICKMEMORY = "QUICK"; // Quick Select Mode Memory
	const MN = "MN"; //Navigation
	
	//VS
	const VSASP = "VSASP"; // ASP
	const VSSC = "VSSC"; // Set Resolution
	const VSSCH = "VSSCH"; // Set Resolution HDMI
	const VSAUDIO = "VSAUDIO"; // Set HDMI Audio Output
	const VSMONI = "VSMONI"; // Set HDMI Monitor
	const VSVPM = "VSVPM"; // Set Video Processing Mode
	const VSVST = "VSVST"; // Set Vertical Stretch
	//PS
	const PSATT = "PSATT"; // SW ATT
	const PSTONE = "PSTONE"; // Tone Control
	const PSSB = "PSSB"; // Surround Back SP Mode
	const PSCINEMAEQ = "CINEMA EQ"; // Cinema EQ
	const PSMODE = "PSMODE:"; // Mode Music
	const PSDOLVOL = "PSDOLVOL"; // Dolby Volume direct change
	const PSVOLLEV = "PSVOLLEV"; // Dolby Volume Leveler direct change
	const PSVOLMOD = "PSVOLMOD"; // Dolby Volume Modeler direct change
	const PSFH = "PSFH:"; // FRONT HEIGHT
	const PSPHG = "PSPHG"; // PL2z HEIGHT GAIN direct change
	const PSSP = "PSSP:"; // Speaker Output set
	const PSMULTEQ = "PSMULTEQ:"; // MultEQ XT 32 mode direct change
	const PSDYNEQ = "PSDYNEQ"; // Dynamic EQ
	const PSREFLEV = "PSREFLEV"; // Reference Level Offset
	const PSDYNVOL = "PSDYNVOL"; // Dynamic Volume
	const PSDSX = "PSDSX"; // Audyssey DSX ON
	const PSSTW = "PSSTW"; // STAGE WIDTH
	const PSSTH = "PSSTH"; // STAGE HEIGHT
	const PSBAS = "PSBAS"; // BASS
	const PSTRE = "PSTRE"; // TREBLE
	const PSDRC = "PSDRC"; // DRC direct change
	const PSDCO = "PSDCO"; // D.COMP direct change	
	const PSLFE = "PSLFE"; // LFE
	const PSEFF = "PSEFF"; // EFFECT direct change	
	const PSDEL = "PSDEL"; // DELAY	
	const PSAFD = "PSAFD"; // AFDM	
	const PSPAN = "PSPAN"; // PANORAMA	
	const PSDIM = "PSDIM"; // DIMENSION	
	const PSCEN = "PSCEN"; // CENTER WIDTH	
	const PSCEI = "PSCEI"; // CENTER IMAGE
	const PSRSTR = "PSRSTR"; //Audio Restorer
	const PSRSZ = "PSRSZ"; //Room Size
	const PSSWR = "PSSWR"; //Subwoofer
	
	//PV
	const PVCN = "PVCN"; // Contrast
	const PVBR = "PVBR"; // Brightness
	const PVCM = "PVCM"; // Chroma
	const PVHUE = "PVHUE"; // Hue
	const PVDNR = "PVDNR"; // DNR direct change
	const PVENH = "PVENH"; // Enhancer
	
	const SR = " ?"; //Status Request
	
	//Zone 2
	const Z2 = "Z2"; // Zone 2
	const Z2MU = "Z2MU"; // Zone 2 Mute
	const Z2CS = "Z2CS"; // Zone 2 Channel Setting
	const Z2CVFL = "Z2CVFL"; // Zone 2 Channel Volume FL
	const Z2CVFR = "Z2CVFR"; // Zone 2 Channel Volume FR
	const Z2HPF = "Z2HPF"; // Zone 2 HPF
	const Z2PSBAS = "Z2PSBAS"; // Zone 2 Parameter Bass
	const Z2PSTRE = "Z2PSTRE"; // Zone 2 Parameter Treble
	const Z2SLP = "Z2SLP"; // Zone 2 Sleep Timer
	const Z2QUICK = "Z2QUICK"; // Zone 2 Quick
	
	//Zone 3
	const Z3 = "Z3"; // Zone 3
	const Z3MU = "Z3MU"; // Zone 3 Mute
	const Z3CS = "Z3CS"; // Zone 3 Channel Setting
	const Z3CVFL = "Z3CVFL"; // Zone 3 Channel Volume FL
	const Z3CVFR = "Z3CVFR"; // Zone 3 Channel Volume FR
	const Z3HPF = "Z3HPF"; // Zone 3 HPF
	const Z3PSBAS = "Z3PSBAS"; // Zone 3 Parameter Bass
	const Z3PSTRE = "Z3PSTRE"; // Zone 3 Parameter Treble
	const Z3SLP = "Z3SLP"; // Zone 3 Sleep Timer
	const Z3QUICK = "Z3QUICK"; // Zone 3 Quick
	
	const TF = "TF"; // Tuner Frequency
	const TP = "TP"; // Tuner Preset
	const TM = "TM"; // Tuner Mode
	const NS = "NS"; // Network Audio
	const TR = "TR"; // Trigger
	const SY = "SY"; // Remote Lock
	const UG = "UG"; // Upgrade ID Display
	const NSA = "NSA"; // Network Audio Extended
	const NSE = "NSE"; // Network Audio Onscreen Display Information
	
	//SUB Commands
	
	//PW
	const ON = "ON"; // Power On
	const STANDBY = "STANDBY"; // Power Standbye
	
	//MV
	const UP = "UP"; // Master Volume Up
	const DOWN = "DOWN"; // Master Volume Down
	
	
	//SI
	const PHONO = "PHONO"; // Select Input Source Phono
	const CD = "CD"; // Select Input Source CD
	const TUNER = "TUNER"; // Select Input Source Tuner
	const DVD = "DVD"; // Select Input Source DVD
	const BD = "BD"; // Select Input Source BD
	const TV = "TV"; // Select Input Source TV
	const SAT = "SAT/CBL"; // Select Input Source Sat/CBL
	const DVR = "DVR"; // Select Input Source DVR
	const GAME = "GAME"; // Select Input Source Game
	const VAUX = "V.AUX"; // Select Input Source V.AUX
	const DOCK = "DOCK"; // Select Input Source Dock
	const IPOD = "IPOD"; // Select Input Source iPOD
	const NETUSB = "NET/USB"; // Select Input Source NET/USB
	const LASTFM = "LASTFM"; // Select Input Source LastFM
	const FLICKR = "FLICKR"; // Select Input Source Flickr
	const FAVORITES = "FAVORITES"; // Select Input Source Favorites
	const IRADIO = "IRADIO"; // Select Input Source Internet Radio
	const SERVER = "SERVER"; // Select Input Source Server
	
	//ZM Mainzone
	const OFF = "OFF"; // Power Off
	
	//SD
	const AUTO = "AUTO"; // Auto Mode
	const HDMI = "HDMI"; // HDMI Mode
	const DIGITAL = "DIGITAL"; // Digital Mode
	const ANALOG = "ANALOG"; // Analog Mode
	const EXTIN = "EXT.IN"; // Ext.In Mode
	const NO = "NO"; // no Input
	
	//DC Digital Input
	const PCM = "PCM"; // PCM Mode
	const DTS = "DTS"; // DTS Mode
	
	//MS Surround Mode
	const DIRECT = "DIRECT"; // Direct Mode
	const PUREDIRECT = "PURE DIRECT"; // Pure Direct Mode
	const STEREO = "STEREO"; // Stereo Mode
	const STANDARD = "STANDARD"; // Standard Mode
	const DOLBYDIGITAL = "DOLBY DIGITAL"; // Dolby Digital Mode
	const DTSSUROUND = "DTS SUROUND"; // DTS Suround Mode
	const MCHSTEREO = "MCH STEREO"; // Multi Channel Stereo Mode
	const WIDESCREEN = "WIDE SCREEN"; // Wide Screen Mode
	const SUPERSTADIUM = "SUPER STADIUM"; // Super Stadium Mode
	const ROCKARENA = "ROCK ARENA"; // Rock Arena Mode
	const JAZZCLUB = "JAZZ CLUB"; // Jazz Club Mode
	const CLASSICCONCERT = "CLASSIC CONCERT"; // Classic Concert Mode
	const MONOMOVIE = "MONO MOVIE"; // Mono Movie Mode
	const MATRIX = "MATRIX"; // Matrix Mode
	const VIDEOGAME = "VIDEO GAME"; // Video Game Mode
	const VIRTUAL = "VIRTUAL"; // Virtual Mode
	//Quick Select Mode
	const QUICK1 = "1"; // Quick Select 1 Mode Select
	const QUICK2 = "2"; // Quick Select 2 Mode Select
	const QUICK3 = "3"; // Quick Select 3 Mode Select
	const QUICK4 = "4"; // Quick Select 4 Mode Select
	const QUICK5 = "5"; // Quick Select 5 Mode Select
	
	//MSQUICKMEMORY
	const QUICK1MEMORY = "1 MEMORY"; // Quick Select 1 Mode Memory
	const QUICK2MEMORY = "2 MEMORY"; // Quick Select 2 Mode Memory
	const QUICK3MEMORY = "3 MEMORY"; // Quick Select 3 Mode Memory
	const QUICK4MEMORY = "4 MEMORY"; // Quick Select 4 Mode Memory
	const QUICK5MEMORY = "5 MEMORY"; // Quick Select 5 Mode Memory
	const QUICK = "QUICK ?"; // QUICK ? Return MSQUICK Status
	
	//VS
	//VSMONI Set HDMI Monitor
	const MONI1 = "1"; // 1
	const MONI2 = "2"; // 2
	
	
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
	const SCAUTO = "AUTO"; // Set Resolution to Auto
	const SC = " ?"; // SC ? Return VSSC Status
	
	//VSSCH Set Resolution HDMI
	const SCH48P = "48P"; // Set Resolution to 480p/576p HDMI
	const SCH10I = "10I"; // Set Resolution to 1080i HDMI
	const SCH72P = "72P"; // Set Resolution to 720p HDMI
	const SCH10P = "10P"; // Set Resolution to 1080p HDMI
	const SCH10P24 = "10P24"; // Set Resolution to 1080p:24Hz HDMI
	const SCHAUTO = "AUTO"; // Set Resolution to Auto HDMI
	const SCH = " ?"; // SCH ? Return VSSCH Status(HDMI)
	
	//VSAUDIO Set HDMI Audio Output
	const AUDIOAMP = " AMP"; // Set HDMI Audio Output to AMP
	const AUDIOTV = " TV"; // Set HDMI Audio Output to TV
	const AUDIO = " ?"; // AUDIO ? Return VSAUDIO Status
	
	//VSVPM Set Video Processing Mode
	const VPMAUTO = "AUTO"; // Set Video Processing Mode to Auto
	const VPGAME = "GAME"; // Set Video Processing Mode to Game
	const VPMOVI = "OVI"; // Set Video Processing Mode to Movie
	const VPM = " ?"; // VPM ? Return VSVPM Status
	
	//VSVST Set Vertical Stretch
	const VSTON = " ON"; // Set Vertical Stretch On
	const VSTOFF = " OFF"; // Set Vertical Stretch Off 
	const VST = " ?"; // VST ? Return VSVST Status
	
	//PS Parameter
	//PSTONE Tone Control
	const TONECTRLON = " CTRL ON"; // Tone Control On
	const TONECTRLOFF = " CTRL OFF"; // Tone Control Off
	const TONECTRL = " CTRL ?"; // TONE CTRL ? Return PSTONE CONTROL Status
	
	//PSSB Surround Back SP Mode
	const SBMTRXON = ":MTRX ON"; // Surround Back SP Mode Matrix
	const SBPL2XCINEMA = ":PL2X CINEMA"; // Surround Back SP Mode	PL2X Cinema
	const SBPL2XMUSIC = ":PL2X MUSIC"; // Surround Back SP Mode	PL2X Music
	const SBON = ":ON"; // Surround Back SP Mode on
	const SBOFF = ":OFF"; // Surround Back SP Mode off
	
	//PSCINEMAEQ Cinema EQ
	const CINEMAEQON = ".ON"; // Cinema EQ on
	const CINEMAEQOFF = ".OFF"; // Cinema EQ off
	const CINEMAEQ = ". ?"; // Return PSCINEMA EQ.Status
	
	//PSMODE Mode Music
	const MODEMUSIC = "MUSIC"; // Mode Music CINEMA / MUSIC / GAME / PL mode change
	const MODECINEMA = "CINEMA"; // This parameter can change DOLBY PL2,PL2x,NEO:6 mode.
	const MODEGAME = "GAME"; // SB=ON：PL2x mode / SB=OFF：PL2 mode GAME can change DOLBY PL2 & PL2x mode PSMODE:PRO LOGIC
	const MODEPROLOGIC = "PRO LOGIC"; // PL can change ONLY DOLBY PL2 mode
	const MODE = " ?"; // Return PSMODE: Status
	
	//PSDOLVOL Dolby Volume direct change
	const DOLVOLON = " ON"; // Dolby Volume direct change on
	const DOLVOLOFF = " OFF"; // Dolby Volume direct change off
	const DOLVOL = " ?"; // Return PSDOLVOL Status
	
	//PSVOLLEV Dolby Volume Leveler direct change
	const VOLLEVLOW = " LOW"; // Dolby Volume Leveler direct change Low
	const VOLLEVMID = " MID"; // Dolby Volume Leveler direct change Middle
	const VOLLEVHI = " HI"; // Dolby Volume Leveler direct change High
	const VOLLEV = " ?"; // Return PSVOLLEV Status
	
	// PSVOLMOD Dolby Volume Modeler direct change
	const VOLMODHLF = " HLF"; // Dolby Volume Modeler direct change half
	const VOLMODFUL = " FUL"; // Dolby Volume Modeler direct change full
	const VOLMODOFF = " OFF"; // Dolby Volume Modeler direct change off
	const VOLMOD = " ?"; // Return PSVOLMOD Status

	//PSFH Front Height
	const FHON = "ON"; // FRONT HEIGHT ON
	const FHOFF = "OFF"; // FRONT HEIGHT OFF
	const FH = " ?"; // Return PSFH: Status
	
	//PSPHG PL2z Height Gain direct change
	const PHGLOW = " LOW"; // PL2z HEIGHT GAIN direct change low
	const PHGMID = " MID"; // PL2z HEIGHT GAIN direct change middle
	const PHGHI = " HI"; // PL2z HEIGHT GAIN direct change high
	const PHG = " ?"; // Return PSPHG Status
	
	//PSSP Speaker Output set
	const SPFH = "FH"; // Speaker Output set FH
	const SPFW = "FW"; // Speaker Output set FW
	const SPHW = "HW"; // Speaker Output set HW
	const SPOFF = "OFF"; // Speaker Output set off
	const SP = " ?"; // Return PSSP: Status

	// MulEQ XT 32 mode direct change
	const MULTEQAUDYSSEY = "AUDYSSEY"; // MultEQ XT 32 mode direct change MULTEQ:AUDYSSEY
	const MULTEQBYPLR = "BYP.LR"; // MultEQ XT 32 mode direct change MULTEQ:BYP.LR
	const MULTEQFLAT = "FLAT"; // MultEQ XT 32 mode direct change MULTEQ:FLAT
	const MULTEQMANUAL = "MANUAL"; // MultEQ XT 32 mode direct change MULTEQ:MANUAL
	const MULTEQOFF = "OFF"; // MultEQ XT 32 mode direct change MULTEQ:OFF
	const MULTEQ = " ?"; // Return PSMULTEQ: Status
	
	//PSDYNEQ Dynamic EQ
	const DYNEQON = " ON"; // Dynamic EQ = ON
	const DYNEQOFF = " OFF"; // Dynamic EQ = OFF
	const DYNEQ = " ?"; // Return PSDYNEQ Status
	
	//PSREFLEV Reference Level Offset
	const REFLEV0 = " 0"; // Reference Level Offset=0dB
	const REFLEV5 = " 5"; // Reference Level Offset=5dB
	const REFLEV10 = " 10"; // Reference Level Offset=10dB
	const REFLEV15 = " 15"; // Reference Level Offset=15dB
	const REFLEV = " ?"; // Return PSREFLEV Status
	
	//PSDYNVOL Dynamic Volume
	const DYNVOLNGT = " NGT"; // Dynamic Volume = Midnight
	const DYNVOLEVE = " EVE"; // Dynamic Volume = Evening
	const DYNVOLDAY = " DAY"; // Dynamic Volume = Day
	const DYNVOL = " ?"; // Return PSDYNVOL Status
	
	//PSDSX Audyssey DSX ON
	const DSXONHW = " ONHW"; // Audyssey DSX ON(Height/Wide)
	const DSXONH = " ONH"; // Audyssey DSX ON(Height)
	const DSXONW = " ONW"; // Audyssey DSX ON(Wide)
	const DSXOFF = " OFF"; // Audyssey DSX OFF
	const DSX = " ?"; // Return PSDSX Status
	
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
	const DRCOFF = "OFF"; // DRC off
	const DRC = " ?"; // Return PSDRC Status
	

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
	const EFFON = " ON"; // EFFECT ON direct change
	const EFFOFF = " OFF"; // EFFECT OFF direct change
	
	const EFFUP = " UP"; // EFFECT UP direct change
	const EFFDOWN = " DOWN"; // EFFECT DOWN direct change
	const EFF = " "; // EFFECT ** ---AVR-4311 can be operated from 1 to 15


	//PSDEL Delay
	const DELUP = " UP"; // DELAY UP
	const DELDOWN = " DOWN"; // DELAY DOWN
	const DEL = " "; // DELAY ** ---AVR-4311 can be operated from 0 to 300

	//PSAFD AFDM
	const AFDON = " ON"; // AFDM ON
	const AFDOFF = " OFF"; // AFDM OFF
	const AFD = " "; // Return PSAFD Status


	//PSPAN Panorama
	const PANON = "PAN ON"; // PANORAMA ON
	const PANOFF = "PAN OFF"; // PANORAMA OFF
	const PAN = "PAN ?"; // Return PSPAN Status


	//PSDIM Dimension
	const DIMUP = " UP"; // DIMENSION UP
	const DIMDOWN = " DOWN"; // DIMENSION DOWN
	const DIM = " "; // ---AVR-4311 can be operated from 0 to 6


	//PSCEN Center Width
	const CENUP = "CEN UP"; // CENTER WIDTH UP
	const CENDOWN = "CEN DOWN"; // CENTER WIDTH DOWN
	const CEN = "CEN "; // ---AVR-4311 can be operated from 0 to 7

	//PSCEI Center Image
	const CEIUP = "CEI UP"; // CENTER IMAGE UP
	const CEIDOWN = "CEI DOWN"; // CENTER IMAGE DOWN
	const CEI = "CEI "; // ---AVR-4311 can be operated from 0 to 7
	
	
	//PSRSZ Room Size
	const RSZS = " S";
	const RSZMS = " MS";
	const RSZM = " M";
	const RSZML = " ML";
	const RSZL = " L";
	
	
	//SW ATT
	const ATTON = "ATT ON"; // SW ATT ON
	const ATTOFF = "ATT OFF"; // SW ATT OFF
	const ATT = "ATT ?"; // Return PSATT Status
	
	const IsVariable = 0;
    const VarType = 1;
    const VarName = 2;
    const Profile = 3;
    const EnableAction = 4;
    const RequestValue = 5;
    const ValueMapping = 6;
    const ValuePrefix = 7;
	
	// Mapping von CMDs der Main auf identische CMDs der Zonen
	
    static $CMDMapping = array(
        DENON_API_Commands::PW => array(
            DENON_Zone::Mainzone => DENON_API_Commands::ZM,            
            DENON_Zone::Zone2 => DENON_API_Commands::Z2,
            DENON_Zone::Zone3 => DENON_API_Commands::Z3
        )
    );
	
	public $VarMapping = array
	(
        //Power
		DENON_API_Commands::PW
        => array(
            "VarType" => DENONIPSVarType::vtBoolean,
            "EnableAction" => true,
            "Profile" => $DENONIPSProfiles->ptPower,
            "IsVariable" => true,
            "VarName" => 'Power',
            "RequestValue" => true,
            "ValueMapping" => array("QS 1" => 1, "QS 2" => 2, "QS 3" => 3, "QS 4" => 4, "QS 5" => 5)
        ),
		//MainZonePower
		DENON_API_Commands::MV
        => array(
            "VarType" => DENONIPSVarType::vtBoolean,
            "EnableAction" => true,
            "Profile" => $DENONIPSProfiles->ptMasterVolume,
            "IsVariable" => true,
            "VarName" => 'MasterVolume',
            "RequestValue" => true,
            "ValueMapping" => array("QS 1" => 1, "QS 2" => 2, "QS 3" => 3, "QS 4" => 4, "QS 5" => 5)
        ),
		//MainMute
		DENON_API_Commands::MU
        => array(
            "VarType" => DENONIPSVarType::vtBoolean,
            "EnableAction" => true,
            "Profile" => $DENONIPSProfiles->ptMainMute,
            "IsVariable" => true,
            "VarName" => 'MainMute',
            "RequestValue" => true,
            "ValueMapping" => array("QS 1" => 1, "QS 2" => 2, "QS 3" => 3, "QS 4" => 4, "QS 5" => 5)
        )
	);
	
	// Nur für alle CMDs, welche keine SubCommands sind.
    /*
	static $VarMapping = array
	(
        //Power
		DENON_API_Commands::PW
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptPower,
            self::IsVariable => true,
            self::VarName => 'Power',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//MainZonePower
		DENON_API_Commands::MV
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptMasterVolume,
            self::IsVariable => true,
            self::VarName => 'MasterVolume',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//MainMute
		DENON_API_Commands::MU
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptMainMute,
            self::IsVariable => true,
            self::VarName => 'MainMute',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//CinemaEQ
		DENON_API_Commands::PSCINEMAEQ
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptCinemaEQ,
            self::IsVariable => true,
            self::VarName => 'CinemaEQ',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//Panorama
		DENON_API_Commands::PSPAN
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptPanorama,
            self::IsVariable => true,
            self::VarName => 'Panorama',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//FrontHeight
		DENON_API_Commands::PSFH
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptFrontHeight,
            self::IsVariable => true,
            self::VarName => 'FrontHeight',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ToneCTRL
		DENON_API_Commands::PSTONE
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptToneCTRL,
            self::IsVariable => true,
            self::VarName => 'ToneCTRL',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//DynamicEQ
		DENON_API_Commands::PSDYNEQ
        => array(
            self::VarType => DENONIPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptDynamicEQ,
            self::IsVariable => true,
            self::VarName => 'DynamicEQ',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//AudioDelay
		DENON_API_Commands::PSDEL
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptAudioDelay,
            self::IsVariable => true,
            self::VarName => 'AudioDelay',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		// QuickSelect
		DENON_API_Commands::MSQUICK 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptQuickSelect,
            self::IsVariable => true,
            self::VarName => 'QuickSelect',
            self::RequestValue => true,
            self::ValueMapping => array("QS 1" => 1, "QS 2" => 2, "QS 3" => 3, "QS 4" => 4, "QS 5" => 5)
        ),
		//Sleep
		DENON_API_Commands::SLP
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSleep,
            self::IsVariable => true,
            self::VarName => 'Sleep',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		// DigitalInputMode
		DENON_API_Commands::DC 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'DigitalInputMode',
            self::RequestValue => true,
            self::ValueMapping => array("AUTO" => 0, "PCM" => 1, "DTS" => 2)
        ),
		// InputSource
		DENON_API_Commands::SI 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'Input Source',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)
        ),
		// Navigation
		DENON_API_Commands::NS 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptNavigation,
            self::IsVariable => true,
            self::VarName => 'Navigation',
            self::RequestValue => true,
            self::ValueMapping => array("Cursor Up" => 90, "Cursor Down" => 91, "Cursor Left" => 92, "Cursor Right" => 93)
		// SurroundMode
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSurround,
            self::IsVariable => true,
            self::VarName => 'SurroundMode',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// SurroundPlayMode
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSurroundPlayMode,
            self::IsVariable => true,
            self::VarName => 'SurroundPlayMode',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// MultiEQMode
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'SMultiEQMode',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// AudioRestorer
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'AudioRestorer',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// Dimension
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'Dimension',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// DynamicVolume
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'DynamicVolume',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// RoomSize
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'RoomSize',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// DynamicCompressor
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'DynamicCompressor',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// DynamicCompressor
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'DynamicCompressor',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// DynamicRange
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'DynamicRange',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// VideoSelect
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'VideoSelect',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
        // SurroundBackMode
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'SurroundBackMode',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		// Present
		DENON_API_Commands::SPL 
        => array(
            self::VarType => IPSVarType::vtInteger,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSpeakerLayout,
            self::IsVariable => true,
            self::VarName => 'Present',
            self::RequestValue => true,
            self::ValueMapping => array("SB" => 1, "FH" => 2, "FW" => 3, "HW" => 4)//, 1 => "SB", 2 => "FH", 3 => "FW", 4 => "HW")
        ),
		//MasterVolume
		DENON_API_Commands::MV
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'MasterVolume',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//LFELevel
		DENON_API_Commands::MVL
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'LFELevel',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//BassLevel
		DENON_API_Commands::PSBAS
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'BassLevel',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//TrebleLevel
		DENON_API_Commands::PSTRE
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'TrebleLevel',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeFL
		DENON_API_Commands::CVFL
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeFL',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeFR
		DENON_API_Commands::CVFR
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeFR',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeC
		DENON_API_Commands::CVC
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeC',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeSW
		DENON_API_Commands::CVSW
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeSW',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeSW2
		DENON_API_Commands::CVSW2
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeSW2',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeSL
		DENON_API_Commands::CVSL
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeSL',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeSR
		DENON_API_Commands::CVSR
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeSR',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeSBL
		DENON_API_Commands::CVSBL
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeSBL',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeSBR
		DENON_API_Commands::CVSBR
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeSBR',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeFHL
		DENON_API_Commands::CVFHL
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeFHL',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeFHR
		DENON_API_Commands::CVFHR
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeFHR',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeFWL
		DENON_API_Commands::CVFWL
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeFWL',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		//ChannelVolumeFWR
		DENON_API_Commands::CVFWR
        => array(
            self::VarType => IPSVarType::vtFloat,
            self::EnableAction => true,
            self::Profile => $DENONIPSProfiles->ptVolume,
            self::IsVariable => true,
            self::VarName => 'ChannelVolumeFWR',
            self::RequestValue => true,
            self::ValueMapping => null
        )
	//Zone2
	//Zone3
	);	
	*/
}	

class DENON_HTTP_GET
{
	public $FriendlyName;
	public $AVRPower;
	public $ZonePower;
	public $RenameZone;
	public $ModelId;
	public $MasterVolume;
	public $Mute;
}

class DENON_API_Command_Mapping extends stdClass
{

    static public function GetMapping($Cmd) //__construct($Cmd)
    {
        if (array_key_exists($Cmd, DENON_API_Commands::$CMDMapping))
        {
//            IPS_LogMessage('GetMapping', print_r(ISCP_API_Commands::$CMDMapping[$Cmd], 1));
            return DENON_API_Commands::$CMDMapping[$Cmd];
            /*
              $this->VarType = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::VarType];
              $this->EnableAction = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::EnableAction];
              $this->Profile = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::Profile];
             */
        }
        else
            return null;
    }

}

class DENON_API_Data_Mapping extends stdClass
{

//    public $VarType;
//    public $EnableAction;
//    public $Profile;

    static public function GetMapping($Cmd) //__construct($Cmd)
    {
        if (array_key_exists($Cmd, DENON_API_Commands::$VarMapping))
        {
            $result = new stdClass;
            $result->IsVariable = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::IsVariable];
            $result->VarType = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::VarType];
            $result->VarName = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::VarName];
            $result->Profile = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::Profile];
            $result->EnableAction = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::EnableAction];
            $result->RequestValue = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::RequestValue];

            $result->ValueMapping = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::ValueMapping];

            if (array_key_exists(DENON_API_Commands::ValuePrefix, DENON_API_Commands::$VarMapping[$Cmd]))
                $result->ValuePrefix = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::ValuePrefix];

            return $result;
            /*
              $this->VarType = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::VarType];
              $this->EnableAction = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::EnableAction];
              $this->Profile = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::Profile];
             */
        }
        else
            return null;
    }

}


class DenonAVRCP_API_Data extends stdClass
{

    public $APICommand;
    public $Data;
    public $Mapping = null;
    public $APISubCommand = null;

    public function GetDataFromJSONObject($Data)
    {
        $this->APICommand = $Data->APICommand;
        $this->Data = utf8_decode($Data->Data);
        if (property_exists($Data, 'APISubCommand'))
            $this->APISubCommand = $Data->APISubCommand;
    }

    public function ToJSONString($GUID)
    {
        $SendData = new stdClass;
        $SendData->DataID = $GUID;
        $SendData->APICommand = $this->APICommand;
        $SendData->Data = utf8_encode($this->Data);
//        if (is_array($this->APISubCommand))
//        if ($this->APISubCommand <> null)        
        $SendData->APISubCommand = $this->APISubCommand;
        return json_encode($SendData);
    }
	
	public function GetSubCommand($Cmd, $Value) 
    {
		$VarMapping = array
				(
					//Power
					DENON_API_Commands::PW
					=> array(
						"VarType" => "vtBoolean",
						"ValueMapping" => array("ON" => true, "STANDBY" => false)
					),
					//MainZonePower
					DENON_API_Commands::ZM
					=> array(
						"VarType" => "vtBoolean",
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//MainMute
					DENON_API_Commands::MU
					=> array(
						"VarType" => "vtBoolean",
						"ValueMapping" => array("ON" => true, "OFF" => false)
					)
				);

		if (array_key_exists($Cmd, $VarMapping))
        {
			foreach($VarMapping as $Command => $ValMap)
			{
				if($Command == $Cmd)
				{
				    $ValueMapping = $ValMap["ValueMapping"];
				    foreach($ValueMapping as $SubCommand => $SubCommandValue)
				    {
						if($SubCommandValue == $Value)
							{
								return $SubCommand;
							}
					}
				}
			}
        }
        else
            return null;
    }
	
    public function GetMapping()
    {
        $this->Mapping = DENON_API_Data_Mapping::GetMapping($this->APICommand);
    }

    public function GetSubCommandold()
    {
//        IPS_LogMessage('GetSubCommand', print_r(ISCP_API_Command_Mapping::GetMapping($this->APICommand), 1));
        $this->APISubCommand = (object) DENON_API_Command_Mapping::GetMapping($this->APICommand);
    }

}





?>