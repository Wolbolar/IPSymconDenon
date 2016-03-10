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
	public $ptCWidth;
	public $ptDynamicRange;
	public $ptVideoSelect;
	public $ptSurroundBackMode;
	public $ptPreset;
	public $ptInputMode;
	public $ptZone2Power;
	public $ptZone2Mute;
	public $ptZone2Volume;
	public $ptZone2InputSource;
	public $ptZone2ChannelSetting;
	public $ptZone2ChannelVolumeFL;
	public $ptZone2ChannelVolumeFR;
	public $ptZone2QuickSelect;
	public $ptZone3Power;
	public $ptZone3Mute;
	public $ptZone3Volume;
	public $ptZone3InputSource;
	public $ptZone3ChannelSetting;
	public $ptZone3ChannelVolumeFL;
	public $ptZone3ChannelVolumeFR;
	public $ptZone3QuickSelect;
	public $ptChannelVolumeFL;
	public $ptChannelVolumeFR;
	public $ptChannelVolumeC;
	public $ptChannelVolumeSW;
	public $ptChannelVolumeSW2;
	public $ptChannelVolumeSL;
	public $ptChannelVolumeSR;
	public $ptChannelVolumeSBL;
	public $ptChannelVolumeSBR;
	public $ptChannelVolumeFHL;
	public $ptChannelVolumeFHR;
	public $ptChannelVolumeFWL;
	public $ptChannelVolumeFWR;
	public $ptNavigation;

	public function SetupVarDenonBool($profile)
	{
		//Ident, Name, Profile, Position 
		$profiles = array (
		$this->ptPower => array(DENON_API_Commands::PW."/Power", "Power", "~Switch", 1),
		$this->ptMainZonePower => array(DENON_API_Commands::ZM."/MainZonePower", "MainZonePower", "~Switch", 2),
		$this->ptMainMute => array(DENON_API_Commands::MU."/MainMute", "MainMute", "~Switch", 3),
		$this->ptCinemaEQ => array(DENON_API_Commands::PSCINEMAEQ."/CinemaEQ", "CinemaEQ", "~Switch", 4),
		$this->ptDynamicEQ => array(DENON_API_Commands::PSDYNEQ."/DynamicEQ", "DynamicEQ", "~Switch", 8),
		$this->ptFrontHeight => array(DENON_API_Commands::PSFH."/FrontHeight", "FrontHeight", "~Switch", 6),
		$this->ptPanorama => array(DENON_API_Commands::PSPAN."/Panorama", "Panorama", "~Switch", 5),
		$this->ptToneCTRL => array(DENON_API_Commands::PSTONE."/ToneCTRL", "ToneCTRL", "~Switch", 7)
		);
		
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
			   return $profilvar;
			}

		}	
	}
	
	public function SetupVarDenonInteger($profile)
	{
		//Sichtbare variablen profil suchen
		$profiles = array(
        $this->ptSleep => array(DENON_API_Commands::SLP."/Sleep", "Intensity",  "", "", 0, 120, 10, 0),
		$this->ptDimension => array(DENON_API_Commands::PSDIM."/Dimension", "Intensity",  "", "", 0, 6, 1, 0),
		$this->ptCWidth => array(DENON_API_Commands::PSDCO."/CWidth", "Intensity",  "", "", 0, 7, 1, 0),
		);
		
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
			   $pos = $this->getpos($profile);
			   $profileinteger = array(
			   "ProfilName" => $ptName,
			   "Profile" => $profilvar,
			   "Position" => $pos
			   );
			   
			   return $profileinteger;
			}

		}	
	}
	
	public function SetupVarDenonIntegerAss($profile)
	{
		//Sichtbare variablen profil suchen
		//Associations
		$ProfilAssociationsMainZone = array
		(
			$this->ptNavigation => array(
				Array("Move", "", "", 0, 5, 0, 0),
				Array(0, "Left",  "", -1),
				Array(1, "Down",  "", -1),
				Array(2, "Up",  "", -1),
				Array(3, "Right",  "", -1),
				Array(4, "Enter",  "", -1),
				Array(5, "Return",  "", -1)		
			),
			$this->ptInputSource => array(
				Array("Database", "", "", 0, 19, 1, 0),
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
			),
			$this->ptQuickSelect => array(
				Array("Intensity", "", "", 0, 5, 1, 0),
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
			),
			$this->ptDigitalInputMode => array(
				Array("Intensity", "", "", 0, 2, 1, 0),
				Array(0, "AUTO",  "", -1),
				Array(1, "PCM",  "", -1),
				Array(2, "DTS",  "", -1)
			),
			$this->ptSurroundMode => array(
				Array("Intensity", "", "", 0, 14, 1, 0),
				Array(0, "DIRECT",  "", -1),
				Array(1, "PURE DIRECT",  "", -1),
				Array(2, "STEREO",  "", -1),
				Array(3, "STANDARD",  "", -1),
				Array(4, "DOLBY DIGITAL",  "", -1),
				Array(5, "DTS SURROUND",  "", -1),
				Array(6, "DOLBY PL2X C",  "", -1),
				Array(7, "MCH STEREO",  "", -1),
				Array(8, "ROCK ARENA",  "", -1),
				Array(9, "JAZZ CLUB",  "", -1),
				Array(10, "MONO MOVIE",  "", -1),
				Array(11, "MATRIX",  "", -1),
				Array(12, "VIDEO GAME",  "", -1),
				Array(13, "VIRTUAL",  "", -1),
				Array(14, "MULTI CH IN 7.1",  "", -1)
			),
			$this->ptSurroundPlayMode => array(
				Array("Intensity", "", "", 0, 2, 1, 0),
				Array(0, "CINEMA",  "", -1),
				Array(1, "MUSIC",  "", -1),
				Array(2, "GAME",  "", -1)
			),
			$this->ptMultiEQMode => array(
				Array("Intensity", "", "", 0, 4, 1, 0),
				Array(0, "OFF",  "", -1),
				Array(1, "AUDYSSEY",  "", -1),
				Array(2, "BYP.LR",  "", -1),
				Array(3, "FLAT",  "", -1),
				Array(4, "MANUAL",  "", -1)
			),
			$this->ptAudioRestorer => array(
				Array("Intensity", "", "", 0, 3, 1, 0),
				Array(0, "OFF",  "", -1),
				Array(1, "Restorer 64",  "", -1),
				Array(2, "Restorer 96",  "", -1),
				Array(3, "Restorer HQ",  "", -1)
			),
			$this->ptDynamicVolume => array(
				Array("Intensity", "", "", 0, 3, 1, 0),
				Array(0, "OFF",  "", -1),
				Array(1, "Midnight",  "", -1),
				Array(2, "Evening",  "", -1),
				Array(3, "Day",  "", -1)
			),
			$this->ptRoomSize => array(
				Array("Intensity", "", "", 0, 5, 1, 0),
				Array(0, "Neutral",  "", -1),
				Array(1, "Small",  "", -1),
				Array(2, "Small/Medium",  "", -1),
				Array(3, "Medium",  "", -1),
				Array(4, "Medium/Large",  "", -1),
				Array(5, "Large",  "", -1)
			),
			$this->ptDynamicCompressor => array(
				Array("Intensity", "", "", 0, 3, 1, 0),
				Array(0, "OFF",  "", -1),
				Array(1, "LOW",  "", -1),
				Array(2, "MID",  "", -1),
				Array(3, "HIGH",  "", -1)
			),
			$this->ptDynamicRange => array(
				Array("Intensity", "", "", 0, 4, 1, 0),
				Array(0, "OFF",  "", -1),
				Array(1, "AUTO",  "", -1),
				Array(2, "LOW",  "", -1),
				Array(3, "MID",  "", -1),
				Array(4, "HI",  "", -1)
			),
			$this->ptVideoSelect => array(
				Array("Intensity", "", "", 0, 8, 1, 0),
				Array(0, "DVD",  "", -1),
				Array(1, "BD",  "", -1),
				Array(2, "TV",  "", -1),
				Array(3, "SAT/CBL",  "", -1),
				Array(4, "DVR",  "", -1),
				Array(5, "GAME",  "", -1),
				Array(6, "V.AUX",  "", -1),
				Array(7, "DOCK",  "", -1),
				Array(8, "SOURCE",  "", -1)
			),
			$this->ptSurroundBackMode => array(
				Array("Intensity", "", "", 0, 7, 1, 0),
				Array(0, "OFF",  "", -1),
				Array(1, "ON",  "", -1),
				Array(2, "MTRX ON",  "", -1),
				Array(3, "PL2X CINEMA",  "", -1),
				Array(4, "PL2X MUSIC",  "", -1),
				Array(5, "ESDSCRT",  "", -1),
				Array(6, "PESMTRX",  "", -1),
				Array(7, "DSCRT ON",  "", -1)
			),
			$this->ptInputMode => array(
				Array("Database", "", "", 0, 3, 1, 0),
				Array(0, "AUTO",  "", -1),
				Array(1, "HDMI",  "", -1),
				Array(2, "DIGITAL",  "", -1),
				Array(3, "ANALOG",  "", -1)
			)
		);
		
		$ProfilAssociationsZone2 = array
		(
			$this->ptZone2InputSource => array(
				Array("Database", "", "", 0, 19, 1, 0),
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
			),
			$this->ptZone2ChannelSetting => array(
				Array("Database", "", "", 0, 1, 1, 0),
				Array(0, "Stereo",  "", -1),
				Array(1, "Mono",  "", -1)
			),
			$this->ptZone2QuickSelect => array(
				Array("Database", "", "", 0, 5, 1, 0),
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
			)
		);
		
		
		$ProfilAssociationsZone3 = array
		(
			$this->ptZone3InputSource => array(
				Array("Database", "", "", 0, 19, 1, 0),
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
			),
			$this->ptZone3ChannelSetting => array(
				Array("Database", "", "", 0, 1, 1, 0),
				Array(0, "Stereo",  "", -1),
				Array(1, "Mono",  "", -1)
			),
			$this->ptZone3QuickSelect => array(
				Array("Database", "", "", 0, 5, 1, 0),
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
			)
		);
		
		if($this->Zone == 0)
		{
			foreach($ProfilAssociationsMainZone as $ptName => $profilvar)
			{
				if($ptName == $profile)
				{
				   return $profilvar;
				}

			}	
		}
		elseif($this->Zone == 1)
		{
			foreach($ProfilAssociationsZone2 as $ptName => $profilvar)
			{
				if($ptName == $profile)
				{
				   return $profilvar;
				}

			}	
		}
		if($this->Zone == 2)
		{
			foreach($ProfilAssociationsZone3 as $ptName => $profilvar)
			{
				if($ptName == $profile)
				{
				   return $profilvar;
				}

			}	
		}
		
		
	}
	
	public function SetupVarDenonFloat($profile)
	{
		//Sichtbare variablen profil suchen
		$profiles = array(
		$this->ptMasterVolume => array(DENON_API_Commands::MV."/MasterVolume", "Intensity", "", " %", -80.0, 18.0, 0.5, 0),
		$this->ptChannelVolumeFL => array(DENON_API_Commands::CVFL."/ChannelVolumeFL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFR => array(DENON_API_Commands::CVFR."/ChannelVolumeFR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeC => array(DENON_API_Commands::CVC."/ChannelVolumeC", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSW => array(DENON_API_Commands::CVSW."/ChannelVolumeSW", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSW2 => array(DENON_API_Commands::CVSW2."/ChannelVolumeSW2", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSL => array(DENON_API_Commands::CVSL."/ChannelVolumeSL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSR => array(DENON_API_Commands::CVSR."/ChannelVolumeSR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSBL => array(DENON_API_Commands::CVSBL."/ChannelVolumeSBL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeSBR => array(DENON_API_Commands::CVSBR."/ChannelVolumeSBR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFHL => array(DENON_API_Commands::CVFHL."/ChannelVolumeFHL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFHR => array(DENON_API_Commands::CVFHR."/ChannelVolumeFHR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFWL => array(DENON_API_Commands::CVFWL."/ChannelVolumeFWL", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptChannelVolumeFWR => array(DENON_API_Commands::CVFWR."/ChannelVolumeFWR", "Intensity", "", " dB", -12, 12, 1.0, 0),
		$this->ptAudioDelay => array(DENON_API_Commands::PSDEL."/AudioDelay", "Intensity", "", " ms", 0, 200, 0, 0),
		$this->ptLFELevel(DENON_API_Commands::PSLFE."/LFELevel", "Intensity", "", " dB", -10.0, 0.0, 0.5, 1),
		$this->ptBassLevel => array(DENON_API_Commands::PSBAS."/BassLevel", "Intensity", "", " dB", -6, 6, 1.0, 0),
		$this->ptTrebleLevel => array(DENON_API_Commands::PSTRE."/TrebleLevel", "Intensity", "", " dB", -6, 6, 1.0, 0)
		);
		
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
			   $pos = $this->getpos($profile);
			   $profilefloat = array(
			   "ProfilName" => $ptName,
			   "Profile" => $profilvar,
			   "Position" => $pos
			   );
			   
			   return $profilefloat;
			}

		}	
	}

	// Anlegen der Unterschiedlichen Profiltypen
	/* Profile anlegen
	* Erstellen von Variablenprofile mit Namenspräfix "DENON."	
	* RegisterProfileIntegerDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Nachkommastellen);
	* RegisterProfileIntegerDenonAss($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Nachkommastellen, $Associations);
	* $Associations Value, Association, Icon, Color
	* RegisterProfileFloatDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Nachkommastellen);
	* RegisterProfilFloatDenonAss($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Nachkommastellen, $Associations)
	* RegisterProfileStringDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Nachkommastellen);
	*/
	
	
	//RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize) bisher wird nur Name Min max stepsize verwendet
	/*
	foreach (IPSProfiles::$ProfilInteger as $Profile => $Size)
        {
            $this->RegisterProfileInteger($Profile, "", "", "", $Size[0], $Size[1], $Size[2]);
        }
					$MasterVolumeId = $this->RegisterVariableFloat("MasterVolume", "MasterVolume", $Name, 10);
			

	*/

	
	
	
	
	//RegisterProfileIntegerEx($Name, $Icon, $Prefix, $Suffix, $Associations) bisher wird nur Name und Associations ausgelesen
	/*
	foreach (IPSProfiles::$ProfilAssociations as $Profile => $Association)
        {
            $this->RegisterProfileIntegerEx($Profile, "", "", "", $Association);
        }
	*/
	
	
	
	function getpos($profile)
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
							$this->ptCWidth => 49,
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
			DENON_API_Commands::CV,
			DENON_API_Commands::MU,
			DENON_API_Commands::SI,
			DENON_API_Commands::ZM,
			DENON_API_Commands::SD,
			DENON_API_Commands::DC,
			DENON_API_Commands::SV,
			DENON_API_Commands::SLP,
			DENON_API_Commands::MS,
			DENON_API_Commands::VS,
			DENON_API_Commands::PS,
            DENON_API_Commands::PV
        ),
        DENON_Zone::Zone2 => array(
            DENON_API_Commands::Z2,
            DENON_API_Commands::Z2MU,
			DENON_API_Commands::Z2CS,
			DENON_API_Commands::Z2CV,
			DENON_API_Commands::Z2HPF,
			DENON_API_Commands::Z2PS,
			DENON_API_Commands::Z2SLP
        ),
        DENON_Zone::Zone3 => array(
            DENON_API_Commands::Z3,
			DENON_API_Commands::Z3MU,
			DENON_API_Commands::Z3CS,
			DENON_API_Commands::Z3CV,
			DENON_API_Commands::Z3HPF,
			DENON_API_Commands::Z3PS,
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
	const CV = "CV"; // Channel Volume
	const MU = "MU"; // Volume Mute
	const SI = "SI"; // Select
	const ZM = "ZM"; // Main Zone
	const SD = "SD"; // Select Auto/HDMI/Digital/Analog
	const DC = "DC"; // Select Auto/PCM/DTS
	const SV = "SV"; // Video Select
	const SLP = "SLP"; // Main Zone Sleep Timer
	const MS = "MS"; // Select Surround Mode
	const VS = "VS"; // Select Video Mode
	const PS = "PS"; // Parameter Setting
	const PV = "PV"; // Parameter Video
	
	const SR = " ?"; //Status Request
	
	//Zone 2
	const Z2 = "Z2"; // Zone 2
	const Z2MU = "Z2MU"; // Zone 2 Mute
	const Z2CS = "Z2CS"; // Zone 2 Channel Setting
	const Z2CV = "Z2CV"; // Zone 2 Channel Volume
	const Z2HPF = "Z2HPF"; // Zone 2 HPF
	const Z2PS = "Z2PS"; // Zone 2 Parameter
	const Z2SLP = "Z2SLP"; // Zone 2 Sleep Timer
	
	//Zone 3
	const Z3 = "Z3"; // Zone 3
	const Z3MU = "Z3MU"; // Zone 3 Mute
	const Z3CS = "Z3CS"; // Zone 3 Channel Setting
	const Z3CV = "Z3CV"; // Zone 3 Channel Volume
	const Z3HPF = "Z3HPF"; // Zone 3 HPF
	const Z3PS = "Z3PS"; // Zone 3 Parameter
	const Z3SLP = "Z3SLP"; // Zone 3 Sleep Timer
	
	const TF = "TF"; // Tuner Frequency
	const TP = "TP"; // Tuner Preset
	const TM = "TM"; // Tuner Mode
	const NS = "NS"; // Network Audio
	const MN = "MN"; // Navigation
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
	
	//CV
	const CVFL = "CVFL "; // Channel Volume Front Left
	const CVFR = "CVFR "; // Channel Volume Front Right
	const CVC = "CVC "; // Channel Volume Center
	const CVSW = "CVSW "; // Channel Volume Subwoofer
	const CVSW2 = "CVSW2 "; // Channel Volume Subwoofer2
	const CVSL = "CVSL "; // Channel Volume Surround Left
	const CVSR = "CVSR "; // Channel Volume Surround Right
	const CVSBL = "CVSBL "; // Channel Volume Surround Back Left
	const CVSBR = "CVSBR "; // Channel Volume Surround Back Right
	const CVSB = "CVSB "; // Channel Volume Surround Back
	const CVFHL = "FHL "; // Channel Volume Front Height Left
	const CVFHR = "FHR "; // Channel Volume Front Height Right
	const CVFWL = "FWL "; // Channel Volume Front Wide Left
	const CVFWR = "FWR "; // Channel Volume Front Wide Right
	/*
	const FL_UP = "FL UP"; // Channel Volume Front Left Up
	const FL_DOWN = "FL DOWN"; // Channel Volume Front Left Down
	const FL = "FL "; // Channel Volume Front Left Set to 50 FL 50
	const FR_UP = "FR UP"; // Channel Volume Front Right Up
	const FR_DOWN = "FR DOWN"; // Channel Volume Front Right Down
	const FR = "FR "; // Channel Volume Front Right Set to 50 FR 50
	const C_UP = "C UP"; // Channel Volume Center Up
	const C_DOWN = "C DOWN"; // Channel Volume Center Down
	const C = "C "; // Channel Volume Center Set to 50 C 50
	const SW_UP = "SW UP"; // Channel Volume Subwoofer Up
	const SW_DOWN = "SW DOWN"; // Channel Volume Subwoofer Down
	const SW = "SW "; // Channel Volume Subwoofer Set to 50 SW 50
	const SW2_UP = "SW2 UP"; // Channel Volume Subwoofer 2 Up
	const SW2_DOWN = "SW2 DOWN"; // Channel Volume Subwoofer 2 Down
	const SW2 = "SW2 "; // Channel Volume Subwoofer 2 Set to 50 SW2 50
	const SL_UP = "SL UP"; // Channel Volume Surround Left Up
	const SL_DOWN = "SL DOWN"; // Channel Volume Surround Left Down
	const SL = "SL "; // Channel Volume Surround Left Set to 50 SL 50
	const SR_UP = "SR UP"; // Channel Volume Surround Right Up
	const SR_DOWN = "SR DOWN"; // Channel Volume Surround Right Down
	const SR = "SR "; // Channel Volume Surround Right Set to 50 SR 50
	const SBL_UP = "SBL UP"; // Channel Volume Surround Back Left Up
	const SBL_DOWN = "SBL DOWN"; // Channel Volume Surround Back Left Down
	const SBL = "SBL "; // Channel Volume Surround Back Left Set to 50 SBL 50
	const SBR_UP = "SBR UP"; // Channel Volume Surround Back Right Up
	const SBR_DOWN = "SBR DOWN"; // Channel Volume Surround Back Right Down
	const SBR = "SBR "; // Channel Volume Surround Back Right Set to 50 SBR 50
	const SB_UP = "SB UP"; // Channel Volume Surround Back Up
	const SB_DOWN = "SB DOWN"; // Channel Volume Surround Back Down
	const SB = "SB "; // Channel Volume Surround Back Set to 50 SB 50
	const FHL_UP = "FHL UP"; // Channel Volume Front Height Left Up
	const FHL_DOWN = "FHL DOWN"; // Channel Volume Front Height Left Down
	const FHL = "FHL "; // Channel Volume Front Height Left Set to 50 FHL 50
	const FHR_UP = "FHR UP"; // Channel Volume Front Height Right Up
	const FHR_DOWN = "FHR DOWN"; // Channel Volume Front Height Right Down
	const FHR = "FHR "; // Channel Volume Front Height Right Set to 50 FHL 50
	const FWL_UP = "FWL UP"; // Channel Volume Front Wide Left Up
	const FWL_DOWN = "FWL DOWN"; // Channel Volume Front Wide Left Down
	const FWL = "FWL "; // Channel Volume Front Wide Left Set to 50 FHL 50
	const FWR_UP = "FWR UP"; // Channel Volume Front Wide Right Up
	const FWR_DOWN = "FWL DOWN"; // Channel Volume Front Wide Right Down
	const FWR = "FWR "; // Channel Volume Front Wide Right Set to 50 FHL 50
	*/
	
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
	const MSQUICK = "QUICK"; // Quick Select Mode Select
	const QUICK1 = "1"; // Quick Select 1 Mode Select
	const QUICK2 = "2"; // Quick Select 2 Mode Select
	const QUICK3 = "3"; // Quick Select 3 Mode Select
	const QUICK4 = "4"; // Quick Select 4 Mode Select
	const QUICK5 = "5"; // Quick Select 5 Mode Select
	const MSQUICKMEMORY = "QUICK"; // Quick Select Mode Memory
	const QUICK1MEMORY = "1 MEMORY"; // Quick Select 1 Mode Memory
	const QUICK2MEMORY = "2 MEMORY"; // Quick Select 2 Mode Memory
	const QUICK3MEMORY = "3 MEMORY"; // Quick Select 3 Mode Memory
	const QUICK4MEMORY = "4 MEMORY"; // Quick Select 4 Mode Memory
	const QUICK5MEMORY = "5 MEMORY"; // Quick Select 5 Mode Memory
	const QUICK = "QUICK ?"; // QUICK ? Return MSQUICK Status
	
	//VS
	const PSMONI = "PSMONI"; // Set HDMI Monitor
	const MONI1 = "1"; // 1
	const MONI2 = "2"; // 2
	/*
	const MONIAUTO = "MONIAUTO"; // Set HDMI Monitor Auto
	const MONI1 = "MONI1"; // Set HDMI Monitor Out 1
	const MONI2 = "MONI2"; // Set HDMI Monitor Out 2
	const MONI = "MONI ?"; // MONI ? Return VSMONI Status
	*/
	
	const PSASP = "PSASP"; // 
	const ASPNRM = "NRM"; // Set Normal Mode
	const ASPFUL = "FUL"; // Set Full Mode
	const ASP = " ?"; // ASP ? Return VSASP Status
	
	const PSSC = "PSSC"; // Set Resolution
	const SC48P = "48P"; // Set Resolution to 480p/576p
	const SC10I = "10I"; // Set Resolution to 1080i
	const SC72P = "72P"; // Set Resolution to 720p
	const SC10P = "10P"; // Set Resolution to 1080p
	const SC10P24 = "10P24"; // Set Resolution to 1080p:24Hz
	const SCAUTO = "AUTO"; // Set Resolution to Auto
	const SC = " ?"; // SC ? Return VSSC Status
	
	const PSSCH = "PSSCH"; // Set Resolution HDMI
	const SCH48P = "48P"; // Set Resolution to 480p/576p HDMI
	const SCH10I = "10I"; // Set Resolution to 1080i HDMI
	const SCH72P = "72P"; // Set Resolution to 720p HDMI
	const SCH10P = "10P"; // Set Resolution to 1080p HDMI
	const SCH10P24 = "10P24"; // Set Resolution to 1080p:24Hz HDMI
	const SCHAUTO = "AUTO"; // Set Resolution to Auto HDMI
	const SCH = " ?"; // SCH ? Return VSSCH Status(HDMI)
	
	const PSAUDIO = "AUDIO"; // Set HDMI Audio Output
	const AUDIOAMP = " AMP"; // Set HDMI Audio Output to AMP
	const AUDIOTV = " TV"; // Set HDMI Audio Output to TV
	const AUDIO = " ?"; // AUDIO ? Return VSAUDIO Status
	
	const PSVPM = "PSVPM"; // Set Video Processing Mode
	const VPMAUTO = "AUTO"; // Set Video Processing Mode to Auto
	const VPGAME = "GAME"; // Set Video Processing Mode to Game
	const VPMOVI = "OVI"; // Set Video Processing Mode to Movie
	const VPM = " ?"; // VPM ? Return VSVPM Status
	
	const PSVST = "PSVST"; // Set Vertical Stretch
	const VSTON = " ON"; // Set Vertical Stretch On
	const VSTOFF = " OFF"; // Set Vertical Stretch Off 
	const VST = " ?"; // VST ? Return VSVST Status
	
	//PS Parameter
	const PSTONE = "PSTONE"; // Tone Control
	const TONECTRLON = " CTRL ON"; // Tone Control On
	const TONECTRLOFF = " CTRL OFF"; // Tone Control Off
	const TONECTRL = " CTRL ?"; // TONE CTRL ? Return PSTONE CONTROL Status
	
	const PSSB = "PSSB"; // Surround Back SP Mode
	const SBMTRXON = ":MTRX ON"; // Surround Back SP Mode Matrix
	const SBPL2XCINEMA = ":PL2X CINEMA"; // Surround Back SP Mode	PL2X Cinema
	const SBPL2XMUSIC = ":PL2X MUSIC"; // Surround Back SP Mode	PL2X Music
	const SBON = ":ON"; // Surround Back SP Mode on
	const SBOFF = ":OFF"; // Surround Back SP Mode off
	
	const PSCINEMAEQ = "CINEMA EQ"; // Cinema EQ
	const CINEMAEQON = ".ON"; // Cinema EQ on
	const CINEMAEQOFF = ".OFF"; // Cinema EQ off
	const CINEMAEQ = ". ?"; // Return PSCINEMA EQ.Status
	
	const PSMODE = "PSMODE:"; // Mode Music
	const MODEMUSIC = "MUSIC"; // Mode Music CINEMA / MUSIC / GAME / PL mode change
	const MODECINEMA = "CINEMA"; // This parameter can change DOLBY PL2,PL2x,NEO:6 mode.
	const MODEGAME = "GAME"; // SB=ON：PL2x mode / SB=OFF：PL2 mode GAME can change DOLBY PL2 & PL2x mode PSMODE:PRO LOGIC
	const MODEPROLOGIC = "PRO LOGIC"; // PL can change ONLY DOLBY PL2 mode
	const MODE = " ?"; // Return PSMODE: Status
	
	const PSDOLVOL = "PSDOLVOL"; // Dolby Volume direct change
	const DOLVOLON = " ON"; // Dolby Volume direct change on
	const DOLVOLOFF = " OFF"; // Dolby Volume direct change off
	const DOLVOL = " ?"; // Return PSDOLVOL Status
	
	const PSVOLLEV = "PSVOLLEV"; // Dolby Volume Leveler direct change
	const VOLLEVLOW = " LOW"; // Dolby Volume Leveler direct change Low
	const VOLLEVMID = " MID"; // Dolby Volume Leveler direct change Middle
	const VOLLEVHI = " HI"; // Dolby Volume Leveler direct change High
	const VOLLEV = " ?"; // Return PSVOLLEV Status
	
	const PSVOLMOD = "PSVOLMOD"; // Dolby Volume Modeler direct change
	const VOLMODHLF = " HLF"; // Dolby Volume Modeler direct change half
	const VOLMODFUL = " FUL"; // Dolby Volume Modeler direct change full
	const VOLMODOFF = " OFF"; // Dolby Volume Modeler direct change off
	const VOLMOD = " ?"; // Return PSVOLMOD Status

	const PSFH = "PSFH:"; // FRONT HEIGHT
	const FHON = "ON"; // FRONT HEIGHT ON
	const FHOFF = "OFF"; // FRONT HEIGHT OFF
	const FH = " ?"; // Return PSFH: Status
	
	const PSPHG = "PSPHG"; // PL2z HEIGHT GAIN direct change
	const PHGLOW = " LOW"; // PL2z HEIGHT GAIN direct change low
	const PHGMID = " MID"; // PL2z HEIGHT GAIN direct change middle
	const PHGHI = " HI"; // PL2z HEIGHT GAIN direct change high
	const PHG = " ?"; // Return PSPHG Status
	
	const PSSP = "PSSP:"; // Speaker Output set
	const SPFH = "FH"; // Speaker Output set FH
	const SPFW = "FW"; // Speaker Output set FW
	const SPHW = "HW"; // Speaker Output set HW
	const SPOFF = "OFF"; // Speaker Output set off
	const SP = " ?"; // Return PSSP: Status

	const PSMULTEQ = "PSMULTEQ:"; // MultEQ XT 32 mode direct change
	const MULTEQAUDYSSEY = "AUDYSSEY"; // MultEQ XT 32 mode direct change MULTEQ:AUDYSSEY
	const MULTEQBYPLR = "BYP.LR"; // MultEQ XT 32 mode direct change MULTEQ:BYP.LR
	const MULTEQFLAT = "FLAT"; // MultEQ XT 32 mode direct change MULTEQ:FLAT
	const MULTEQMANUAL = "MANUAL"; // MultEQ XT 32 mode direct change MULTEQ:MANUAL
	const MULTEQOFF = "OFF"; // MultEQ XT 32 mode direct change MULTEQ:OFF
	const MULTEQ = " ?"; // Return PSMULTEQ: Status
	
	const PSDYNEQ = "PSDYNEQ"; // Dynamic EQ
	const DYNEQON = " ON"; // Dynamic EQ = ON
	const DYNEQOFF = " OFF"; // Dynamic EQ = OFF
	const DYNEQ = " ?"; // Return PSDYNEQ Status
	
	const PSREFLEV = "PSREFLEV"; // Reference Level Offset
	const REFLEV0 = " 0"; // Reference Level Offset=0dB
	const REFLEV5 = " 5"; // Reference Level Offset=5dB
	const REFLEV10 = " 10"; // Reference Level Offset=10dB
	const REFLEV15 = " 15"; // Reference Level Offset=15dB
	const REFLEV = " ?"; // Return PSREFLEV Status
	
	const PSDYNVOL = "PSDYNVOL"; // Dynamic Volume
	const DYNVOLNGT = " NGT"; // Dynamic Volume = Midnight
	const DYNVOLEVE = " EVE"; // Dynamic Volume = Evening
	const DYNVOLDAY = " DAY"; // Dynamic Volume = Day
	const DYNVOL = " ?"; // Return PSDYNVOL Status
	
	const PSDSX = "PSDSX"; // Audyssey DSX ON
	const DSXONHW = " ONHW"; // Audyssey DSX ON(Height/Wide)
	const DSXONH = " ONH"; // Audyssey DSX ON(Height)
	const DSXONW = " ONW"; // Audyssey DSX ON(Wide)
	const DSXOFF = " OFF"; // Audyssey DSX OFF
	const DSX = " ?"; // Return PSDSX Status
	
	const PSSTW = "PSSTW"; // STAGE WIDTH
	const STWUP = " UP"; // STAGE WIDTH UP
	const STWDOWN = " DOWN"; // STAGE WIDTH DOWN
	const STW = " "; // STAGE WIDTH ** ---AVR-4311 can be operated from -10 to +10
	
	const PSSTH = "PSSTH"; // STAGE HEIGHT
	const STHUP = " UP"; // STAGE HEIGHT UP
	const STHDOWN = " DOWN"; // STAGE HEIGHT DOWN
	const STH = " "; // STAGE HEIGHT ** ---AVR-4311 can be operated from -10 to +10
	
	const PSBAS = "PSBAS"; // BASS
	const BASUP = " UP"; // BASS UP
	const BASDOWN = " DOWN"; // BASS DOWN
	const BAS = " "; // BASS ** ---AVR-4311 can be operated from -6 to +6
	
	const PSTRE = "PSTRE"; // TREBLE
	const TREUP = " UP"; // TREBLE UP
	const TREDOWN = " DOWN"; // TREBLE DOWN
	const TRE = " "; // TREBLE ** ---AVR-4311 can be operated from -6 to +6
	
	const PSDRC = "PSDRC"; // DRC direct change
	const DRCAUTO = " AUTO"; // DRC direct change
	const DRCLOW = " LOW"; // DRC Low
	const DRCMID = " MID"; // DRC Middle
	const DRCHI = " HI"; // DRC High
	const DRCOFF = "OFF"; // DRC off
	const DRC = " ?"; // Return PSDRC Status
	
	const PSDCO = "PSDCO"; // D.COMP direct change
	const DCOOFF = " OFF"; // D.COMP direct change
	const DCOLOW = " LOW"; // D.COMP Low
	const DCOMID = " MID"; // D.COMP Middle
	const DCOHIGH = " HIGH"; // D.COMP High
	const DCO = " ?"; // Return PSDCO Status
	
	const PSLFE = "PSLFE"; // LFE
	const LFEDOWN = " DOWN"; // LFE DOWN
	const LFEUP = " UP"; // LFE UP
	const LFE = " "; // LFE ** ---AVR-4311 can be operated from 0 to -10
	
	const PSEFF = "PSEFF"; // EFFECT direct change
	const EFFON = " ON"; // EFFECT ON direct change
	const EFFOFF = " OFF"; // EFFECT OFF direct change
	
	const EFFUP = " UP"; // EFFECT UP direct change
	const EFFDOWN = " DOWN"; // EFFECT DOWN direct change
	const EFF = " "; // EFFECT ** ---AVR-4311 can be operated from 1 to 15
	
	const PSDEL = "PSDEL"; // DELAY
	const DELUP = " UP"; // DELAY UP
	const DELDOWN = " DOWN"; // DELAY DOWN
	const DEL = " "; // DELAY ** ---AVR-4311 can be operated from 0 to 300
	
	const PSAFD = "PSAFD"; // AFDM
	const AFDON = " ON"; // AFDM ON
	const AFDOFF = " OFF"; // AFDM OFF
	const AFD = " "; // Return PSAFD Status
	
	const PSPAN = "PSPAN"; // PANORAMA
	const PANON = "PAN ON"; // PANORAMA ON
	const PANOFF = "PAN OFF"; // PANORAMA OFF
	const PAN = "PAN ?"; // Return PSPAN Status
	
	const PSDIM = "PSDIM"; // DIMENSION
	const DIMUP = " UP"; // DIMENSION UP
	const DIMDOWN = " DOWN"; // DIMENSION DOWN
	const DIM = " "; // ---AVR-4311 can be operated from 0 to 6
	
	const PSCEN = "PSCEN"; // CENTER WIDTH
	const CENUP = "CEN UP"; // CENTER WIDTH UP
	const CENDOWN = "CEN DOWN"; // CENTER WIDTH DOWN
	const CEN = "CEN "; // ---AVR-4311 can be operated from 0 to 7
	
	const PSCEI = "PSCEI"; // CENTER IMAGE
	const CEIUP = "CEI UP"; // CENTER IMAGE UP
	const CEIDOWN = "CEI DOWN"; // CENTER IMAGE DOWN
	const CEI = "CEI "; // ---AVR-4311 can be operated from 0 to 7
	
	const PSATT = "PSATT"; // SW ATT
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
	//Ident schreiben für Command und Befehlsnamen  Werte sind Subcommands
	/*
	$ident = "MV_MasterVolume";
	$part = explode("_", $ident);
	$command = $part[0];
	$name = $part[1];
	*/
	
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

    public function GetMapping()
    {
        $this->Mapping = DENON_API_Data_Mapping::GetMapping($this->APICommand);
    }

    public function GetSubCommand()
    {
//        IPS_LogMessage('GetSubCommand', print_r(ISCP_API_Command_Mapping::GetMapping($this->APICommand), 1));
        $this->APISubCommand = (object) DENON_API_Command_Mapping::GetMapping($this->APICommand);
    }

}





?>