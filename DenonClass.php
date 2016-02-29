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

class IPSProfiles extends stdClass
{

// Start Register variables and Actions
        // with the following order:
    public $positions = array ( 
                             ('Coordinator')     => 10,
                             ('GroupMembers')    => 11,
                             ('MemberOfGroup')   => 12,
                             ('GroupVolume')     => 13,
                             ('Details')         => 20,
                             ('CoverURL')        => 21,
                             ('ContentStream')   => 22,
                             ('Artist')          => 23,
                             ('Title')           => 24,
                             ('Album')           => 25,
                             ('TrackDuration')   => 26,
                             ('Position')        => 27,
                             ('nowPlaying')      => 29,
                             ('Radio')           => 40,
                             ('Playlist')        => 41,
                             ('Status')          => 49,
                             ('Volume')          => 50,
                             ('Mute')            => 51,
                             ('Loudness')        => 52,
                             ('Bass')            => 53,
                             ('Treble')          => 54,
                             ('Balance')         => 58,
                             ('Sleeptimer')      => 60,
                             ('PlayMode')        => 61,
                             ('Crossfade')       => 62,
                             ('_updateStatus')   => 98,
                             ('_updateGrouping') => 99
                           );
}

class DENON_Zone extends stdClass
{

    const None = 0;
    const ZoneMain = 1;
    const Zone2 = 2;
    const Zone3 = 3;
    const Zone4 = 4;

    public $thisZone;
	    static $ZoneCMDs = array(
        DENON_Zone::ZoneMain => array(
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
        ),
        DENON_Zone::Zone4 => array(
            DENON_API_Commands::PW4,
            DENON_API_Commands::MT4
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
	const QUICK1 = "QUICK1"; // Quick Select 1 Mode Select
	const QUICK2 = "QUICK2"; // Quick Select 2 Mode Select
	const QUICK3 = "QUICK3"; // Quick Select 3 Mode Select
	const QUICK4 = "QUICK4"; // Quick Select 4 Mode Select
	const QUICK5 = "QUICK5"; // Quick Select 5 Mode Select
	const QUICK1MEMORY = "QUICK1 MEMORY"; // Quick Select 1 Mode Memory
	const QUICK2MEMORY = "QUICK2 MEMORY"; // Quick Select 2 Mode Memory
	const QUICK3MEMORY = "QUICK3 MEMORY"; // Quick Select 3 Mode Memory
	const QUICK4MEMORY = "QUICK4 MEMORY"; // Quick Select 4 Mode Memory
	const QUICK5MEMORY = "QUICK5 MEMORY"; // Quick Select 5 Mode Memory
	const QUICK = "QUICK ?"; // QUICK ? Return MSQUICK Status
	
	//VS
	const MONIAUTO = "MONIAUTO"; // Set HDMI Monitor Auto
	const MONI1 = "MONI1"; // Set HDMI Monitor Out 1
	const MONI2 = "MONI2"; // Set HDMI Monitor Out 2
	const MONI = "MONI ?"; // MONI ? Return VSMONI Status
	
	const ASPNRM = "ASPNRM"; // Set Normal Mode
	const ASPFUL = "ASPFUL"; // Set Full Mode
	const ASP = "ASP ?"; // ASP ? Return VSASP Status
	
	const SC48P = "SC48P"; // Set Resolution to 480p/576p
	const SC10I = "SC10I"; // Set Resolution to 1080i
	const SC72P = "SC72P"; // Set Resolution to 720p
	const SC10P = "SC10P"; // Set Resolution to 1080p
	const SC10P24 = "SC10P24"; // Set Resolution to 1080p:24Hz
	const SCAUTO = "SCAUTO"; // Set Resolution to Auto
	const SC = "SC ?"; // SC ? Return VSSC Status
	
	const SCH48P = "SCH48P"; // Set Resolution to 480p/576p HDMI
	const SCH10I = "SCH10I"; // Set Resolution to 1080i HDMI
	const SCH72P = "SCH72P"; // Set Resolution to 720p HDMI
	const SCH10P = "SCH10P"; // Set Resolution to 1080p HDMI
	const SCH10P24 = "SCH10P24"; // Set Resolution to 1080p:24Hz HDMI
	const SCHAUTO = "SCHAUTO"; // Set Resolution to Auto HDMI
	const SCH = "SCH ?"; // SCH ? Return VSSCH Status(HDMI)
	
	const AUDIOAMP = "AUDIO AMP"; // Set HDMI Audio Output to AMP
	const AUDIOTV = "AUDIO TV"; // Set HDMI Audio Output to TV
	const AUDIO = "AUDIO ?"; // AUDIO ? Return VSAUDIO Status
	
	const VPMAUTO = "VPMAUTO"; // Set Video Processing Mode to Auto
	const VPGAME = "VPMGAME"; // Set Video Processing Mode to Game
	const VPMOVI = "VPMOVI"; // Set Video Processing Mode to Movie
	const VPM = "VPM ?"; // VPM ? Return VSVPM Status
	
	const VSTON = "VST ON"; // Set Vertical Stretch On
	const VSTOFF = "VST OFF"; // Set Vertical Stretch Off 
	const VST = "VST ?"; // VST ? Return VSVST Status
	
	//PS Parameter
	const TONECTRLON = "TONE CTRL ON"; // Tone Control On
	const TONECTRLOFF = "TONE CTRL OFF"; // Tone Control Off
	const TONECTRL = "TONE CTRL ?"; // TONE CTRL ? Return PSTONE CONTROL Status
	
	const SBMTRXON = "SB:MTRX ON"; // Surround Back SP Mode Matrix
	const SBPL2XCINEMA = "SB:PL2X CINEMA"; // Surround Back SP Mode	PL2X Cinema
	const SBPL2XMUSIC = "SB:PL2X MUSIC"; // Surround Back SP Mode	PL2X Music
	const SBON = "SB:ON"; // Surround Back SP Mode on
	const SBOFF = "SB:OFF"; // Surround Back SP Mode off
	
	const CINEMAEQON = "CINEMA EQ.ON"; // Cinema EQ on
	const CINEMAEQOFF = "CINEMA EQ.OFF"; // Cinema EQ off
	const CINEMAEQ = "CINEMA EQ. ?"; // Return PSCINEMA EQ.Status
	
	const MODEMUSIC = "MODE:MUSIC"; // Mode Music CINEMA / MUSIC / GAME / PL mode change
	const MODECINEMA = "MODE:CINEMA"; // This parameter can change DOLBY PL2,PL2x,NEO:6 mode.
	const MODEGAME = "MODE:GAME"; // SB=ON：PL2x mode / SB=OFF：PL2 mode GAME can change DOLBY PL2 & PL2x mode PSMODE:PRO LOGIC
	const MODEPROLOGIC = "MODE:PRO LOGIC"; // PL can change ONLY DOLBY PL2 mode
	const MODE = "MODE: ?"; // Return PSMODE: Status
	
	const DOLVOLON = "DOLVOL ON"; // Dolby Volume direct change on
	const DOLVOLOFF = "DOLVOL OFF"; // Dolby Volume direct change off
	const DOLVOL = "DOLVOL ?"; // Return PSDOLVOL Status
	
	const VOLLEVLOW = "VOLLEV LOW"; // Dolby Volume Leveler direct change Low
	const VOLLEVMID = "VOLLEV MID"; // Dolby Volume Leveler direct change Middle
	const VOLLEVHI = "VOLLEV HI"; // Dolby Volume Leveler direct change High
	const VOLLEV = "VOLLEV ?"; // Return PSVOLLEV Status
	
	const VOLMODHLF = "VOLMOD HLF"; // Dolby Volume Modeler direct change half
	const VOLMODFUL = "VOLMOD FUL"; // Dolby Volume Modeler direct change full
	const VOLMODOFF = "VOLMOD OFF"; // Dolby Volume Modeler direct change off
	const VOLMOD = "VOLMOD"; // Return PSVOLMOD Status

	const FHON = "FH:ON"; // FRONT HEIGHT ON
	const FHOFF = "FH:OFF"; // FRONT HEIGHT OFF
	const FH = "FH: ?"; // Return PSFH: Status
	
	const PHGLOW = "PHG LOW"; // PL2z HEIGHT GAIN direct change low
	const PHGMID = "PHG MID"; // PL2z HEIGHT GAIN direct change middle
	const PHGHI = "PHG HI"; // PL2z HEIGHT GAIN direct change high
	const PHG = "PHG ?"; // Return PSPHG Status
	
	const SPFH = "SP:FH"; // Speaker Output set FH
	const SPFW = "SP:FW"; // Speaker Output set FW
	const SPHW = "SP:HW"; // Speaker Output set HW
	const SPOFF = "SP:OFF"; // Speaker Output set off
	const SP = "SP: ?"; // Return PSSP: Status

	const MULTEQAUDYSSEY = "MULTEQ:AUDYSSEY"; // MultEQ XT 32 mode direct change MULTEQ:AUDYSSEY
	const MULTEQBYPLR = "MULTEQ:BYP.LR"; // MultEQ XT 32 mode direct change MULTEQ:BYP.LR
	const MULTEQFLAT = "MULTEQ:FLAT"; // MultEQ XT 32 mode direct change MULTEQ:FLAT
	const MULTEQMANUAL = "MULTEQ:MANUAL"; // MultEQ XT 32 mode direct change MULTEQ:MANUAL
	const MULTEQOFF = "MULTEQ:OFF"; // MultEQ XT 32 mode direct change MULTEQ:OFF
	const MULTEQ = "MULTEQ: ?"; // Return PSMULTEQ: Status
	
	const DYNEQON = "DYNEQ ON"; // Dynamic EQ = ON
	const DYNEQOFF = "DYNEQ OFF"; // Dynamic EQ = OFF
	const DYNEQ = "DYNEQ ?"; // Return PSDYNEQ Status
	
	const REFLEV0 = "REFLEV 0"; // Reference Level Offset=0dB
	const REFLEV5 = "REFLEV 5"; // Reference Level Offset=5dB
	const REFLEV10 = "REFLEV 10"; // Reference Level Offset=10dB
	const REFLEV15 = "REFLEV 15"; // Reference Level Offset=15dB
	const REFLEV = "REFLEV ?"; // Return PSREFLEV Status
	
	const DYNVOLNGT = "DYNVOL NGT"; // Dynamic Volume = Midnight
	const DYNVOLEVE = "DYNVOL EVE"; // Dynamic Volume = Evening
	const DYNVOLDAY = "DYNVOL DAY"; // Dynamic Volume = Day
	const DYNVOL = "DYNVOL ?"; // Return PSDYNVOL Status
	
	const DSXONHW = "DSX ONHW"; // Audyssey DSX ON(Height/Wide)
	const DSXONH = "DSX ONH"; // Audyssey DSX ON(Height)
	const DSXONW = "DSX ONW"; // Audyssey DSX ON(Wide)
	const DSXOFF = "DSX OFF"; // Audyssey DSX OFF
	const DSX = "DSX ?"; // Return PSDSX Status
	
	const STWUP = "STW UP"; // STAGE WIDTH UP
	const STWDOWN = "STW DOWN"; // STAGE WIDTH DOWN
	const STW = "STW "; // STAGE WIDTH ** ---AVR-4311 can be operated from -10 to +10
	
	const STHUP = "STH UP"; // STAGE HEIGHT UP
	const STHDOWN = "STH DOWN"; // STAGE HEIGHT DOWN
	const STH = "STH "; // STAGE HEIGHT ** ---AVR-4311 can be operated from -10 to +10
	
	const BASUP = "BAS UP"; // BASS UP
	const BASDOWN = "BAS DOWN"; // BASS DOWN
	const BAS = "BAS "; // BASS ** ---AVR-4311 can be operated from -6 to +6
	
	const TREUP = "TRE UP"; // TREBLE UP
	const TREDOWN = "TRE DOWN"; // TREBLE DOWN
	const TRE = "TRE "; // TREBLE ** ---AVR-4311 can be operated from -6 to +6
	
	const DRCAUTO = "DRC AUTO"; // DRC direct change
	const DRCLOW = "DRC LOW"; // DRC Low
	const DRCMID = "DRC MID"; // DRC Middle
	const DRCHI = "DRC HI"; // DRC High
	const DRCOFF = "DRCOFF"; // DRC off
	const DRC = "DRC ?"; // Return PSDRC Status
	
	const DCOOFF = "DCO OFF"; // D.COMP direct change
	const DCOLOW = "DCO LOW"; // D.COMP Low
	const DCOMID = "DCO MID"; // D.COMP Middle
	const DCOHIGH = "DCO HIGH"; // D.COMP High
	const DCO = "DCO ?"; // Return PSDCO Status
	
	const LFEDOWN = "LFE DOWN"; // LFE DOWN
	const LFEUP = "LFE UP"; // LFE UP
	const LFE = "LFE "; // LFE ** ---AVR-4311 can be operated from 0 to -10
	
	const EFFON = "EFF ON"; // EFFECT ON direct change
	const EFFOFF = "EFF OFF"; // EFFECT OFF direct change
	
	const EFFUP = "EFF UP"; // EFFECT ON direct change
	const EFFDOWN = "EFF DOWN"; // EFFECT OFF direct change
	const EFF = "EFF "; // EFFECT ** ---AVR-4311 can be operated from 1 to 15
	
	const DELUP = "DEL UP"; // DELAY UP
	const DELDOWN = "DEL DOWN"; // DELAY DOWN
	const DEL = "DEL "; // DELAY ** ---AVR-4311 can be operated from 0 to 300
	
	const AFDON = "AFD ON"; // AFDM ON
	const AFDOFF = "AFD OFF"; // AFDM OFF
	const AFD = "AFD "; // Return PSAFD Status
	
	const PANON = "PAN ON"; // PANORAMA ON
	const PANOFF = "PAN OFF"; // PANORAMA OFF
	const PAN = "PAN ?"; // Return PSPAN Status
	
	const DIMUP = "DIM UP"; // DIMENSION UP
	const DIMDOWN = "DIM DOWN"; // DIMENSION DOWN
	const DIM = "DIM "; // ---AVR-4311 can be operated from 0 to 6
	
	const CENUP = "CEN UP"; // CENTER WIDTH UP
	const CENDOWN = "CEN DOWN"; // CENTER WIDTH DOWN
	const CEN = "CEN "; // ---AVR-4311 can be operated from 0 to 7
	
	const CEIUP = "CEI UP"; // CENTER IMAGE UP
	const CEIDOWN = "CEI DOWN"; // CENTER IMAGE DOWN
	const CEI = "CEI "; // ---AVR-4311 can be operated from 0 to 7
	
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
	/*
    static $CMDMapping = array(
        DENON_API_Commands::TUN => array(
            DENON_Zone::ZoneMain => DENON_API_Commands::TUN,            
            DENON_Zone::Zone2 => DENON_API_Commands::TUZ,
            DENON_Zone::Zone3 => DENON_API_Commands::TU3,
            DENON_Zone::Zone4 => DENON_API_Commands::TU4
        ),
        DENON_API_Commands::RAS => array(
            DENON_Zone::ZoneMain => DENON_API_Commands::RAS,            
            DENON_Zone::Zone2 => DENON_API_Commands::RAZ
        )
    );
	*/
	
	// Nur für alle CMDs, welche keine SubCommands sind.
    static $VarMapping = array
	(
        DENON_API_Commands::PW
        => array(
            self::VarType => IPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSwitch,
            self::IsVariable => true,
            self::VarName => 'Power',
            self::RequestValue => true,
            self::ValueMapping => null
        ),
		DENON_API_Commands::MV
        => array(
            self::VarType => IPSVarType::vtBoolean,
            self::EnableAction => true,
            self::Profile => IPSProfiles::ptSwitch,
            self::IsVariable => true,
            self::VarName => 'Mute',
            self::RequestValue => true,
            self::ValueMapping => null
        )
	);	
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
        if (array_key_exists($Cmd, ISCP_API_Commands::$VarMapping))
        {
            $result = new stdClass;
            $result->IsVariable = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::IsVariable];
            $result->VarType = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::VarType];
            $result->VarName = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::VarName];
            $result->Profile = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::Profile];
            $result->EnableAction = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::EnableAction];
            $result->RequestValue = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::RequestValue];

            $result->ValueMapping = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::ValueMapping];

            if (array_key_exists(ISCP_API_Commands::ValuePrefix, ISCP_API_Commands::$VarMapping[$Cmd]))
                $result->ValuePrefix = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::ValuePrefix];

            return $result;
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
        $this->Mapping = ISCP_API_Data_Mapping::GetMapping($this->APICommand);
    }

    public function GetSubCommand()
    {
//        IPS_LogMessage('GetSubCommand', print_r(ISCP_API_Command_Mapping::GetMapping($this->APICommand), 1));
        $this->APISubCommand = (object) ISCP_API_Command_Mapping::GetMapping($this->APICommand);
    }

}





?>