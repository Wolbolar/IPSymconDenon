<?php

declare(strict_types=1);

/* -----------------------------------------------------------------------------
 *                       Denon
   ---------------------------------------------------------------------------*/

class DenonAVR extends AVR
{
    public static $Manufacturer = DENONIPSProfiles::ManufacturerDenon;
    public static $InputSettings = [
        DENON_API_Commands::SI,
        DENON_API_Commands::MSQUICK,
        DENON_API_Commands::SD,
        DENON_API_Commands::DC,
        DENON_API_Commands::SV,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
}

/* ---------------------
 * Denon AVR-380x Serie
   --------------------*/
class Denon_AVR_3808A extends DenonAVR
{
    // see AVR-3808CISerialProtocol_Ver520a.pdf
    public static $Name = 'AVR-3808A';
    public static $internalID = 3;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSWIDESCREEN,
        DENON_API_Commands::MS7CHSTEREO,
        DENON_API_Commands::MSSUPERSTADIUM,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSCLASSICCONCERT,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SCAUTO,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSSB,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
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
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR, DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
    ];
}

/* ---------------------
 * Denon AVR-331x Serie
   --------------------*/
class Denon_AVR_3310 extends DenonAVR
{
    // see AVR3310CI_AVR990_AVC3310_PROTOCOL_V640.pdf
    public static $Name = 'AVR-3310';
    public static $internalID = 32;
    public static $httpMainZone = DENON_HTTP_Interface::MainForm_old;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MS7CHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCHAUTO,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR, DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $PSSP_SubCommands = [
        DENON_API_Commands::SPFH, DENON_API_Commands::SPFW, DENON_API_Commands::SPSB, DENON_API_Commands::SPOFF,
    ];
}

class Denon_AVR_3311 extends Denon_AVR_3310
{
    // see AVR3311CI_AVR3311_991_PROTOCOL_V710.pdf
    public static $Name = 'AVR-3311';
    public static $internalID = 33;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::DVR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::VAUX,
        DENON_API_Commands::DOCK,
        DENON_API_Commands::SOURCE,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::NS,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSSB,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
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
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
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
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];
    public static $PSDYNVOL_SubCommands = [
        DENON_API_Commands::DYNVOLOFF,
        DENON_API_Commands::DYNVOLDAY,
        DENON_API_Commands::DYNVOLEVE,
        DENON_API_Commands::DYNVOLNGT,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];
}

class Denon_AVR_3312 extends Denon_AVR_3311
{
    // see AVR-3312E2_DEU_CD-ROM_v00.pdf
    public static $Name = 'AVR-3312';
    public static $internalID = 1;
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::DVR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::GAME2,
        DENON_API_Commands::VAUX,
        DENON_API_Commands::DOCK,
        DENON_API_Commands::SOURCE,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
}

class Denon_AVR_3313 extends Denon_AVR_3312
{
    //see AVR3313CI_PROTOCOL_V01.pdf
    public static $Name = 'AVR-3313';
    public static $internalID = 2;
    public static $httpMainZone = DENON_HTTP_Interface::MainForm;
}

/* ---------------------
 * Denon AVR-431x Serie
   --------------------*/
class Denon_AVR_4310 extends DenonAVR
{
    // see AVR4311CI_AVR4311_PROTOCOL_V7 2 0.pdf (bold differences to 4311)
    public static $Name = 'AVR-4310';
    public static $internalID = 5;
    public static $httpMainZone = DENON_HTTP_Interface::MainForm_old;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::VCR,
        DENON_API_Commands::DVR,
        DENON_API_Commands::VAUX,
        DENON_API_Commands::SOURCE,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSWIDESCREEN,
        DENON_API_Commands::MS7CHSTEREO,
        DENON_API_Commands::MSSUPERSTADIUM,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSCLASSICCONCERT,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSSB,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSFH,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
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
        DENON_API_Commands::PSATT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
    public static $PSDYNVOL_SubCommands = [
        DENON_API_Commands::DYNVOLOFF,
        DENON_API_Commands::DYNVOLON,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR, DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];

    public static $VS_Commands = [
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVST,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCHAUTO,
    ];

    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::NS,
    ];

    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK, //only Denon
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];

}

class Denon_AVR_4311 extends Denon_AVR_4310
{
    //see AVR4311CI_AVR4311_PROTOCOL_V7 2 0.pdf
    public static $Name = 'AVR-4311';
    public static $internalID = 6;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::DVR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::VAUX,
        DENON_API_Commands::DOCK,
        DENON_API_Commands::SOURCE,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSWIDESCREEN,
        DENON_API_Commands::MSSUPERSTADIUM,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSCLASSICCONCERT,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSSB,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDOLVOL,
        DENON_API_Commands::PSVOLMOD,
        DENON_API_Commands::PSFH,
        DENON_API_Commands::PSDOLVOL,
        DENON_API_Commands::PSVOLLEV,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
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
        DENON_API_Commands::PSATT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
    public static $PSDYNVOL_SubCommands = [
        DENON_API_Commands::DYNVOLOFF,
        DENON_API_Commands::DYNVOLDAY,
        DENON_API_Commands::DYNVOLEVE,
        DENON_API_Commands::DYNVOLNGT,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
        DENON_API_Commands::VSVST,
    ];
}

/* ---------------------
 * Denon AVR-X2x00 Serie
   --------------------*/
class Denon_AVR_X2000 extends DenonAVR
{
    // see AVRX2000_E400_PROTOCOL(1010)_V04.pdf
    public static $Name = 'AVR-X2000';
    public static $internalID = 10;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Denon_AVR_X2100W extends Denon_AVR_X2000
{
    // see IP_Protocol_AVR-Xx100.pdf
    public static $Name = 'AVR-X2100W';
    public static $internalID = 11;
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1, DENON_API_Commands::AUX2,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
    ];

}

class Denon_AVR_X2200W extends Denon_AVR_X2100W
{
    // see Steuerungsprotokoll_IP_RS232C_AVR-X1200W_AVR-X2200W_AVR-X3200W_AVR-X4200W.pdf
    public static $Name = 'AVR-X2200W';
    public static $internalID = 12;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVZRL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];
}

class Denon_AVR_X2300W extends Denon_AVR_X2200W
{
    // see AVR-S720W_S920W_X1300W_X2300W_X3300W_X4300H_X6300H_PROTOCOL_V03.xlsx
    public static $Name = 'AVR-X2300W';
    public static $internalID = 29;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVZRL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];

}

class Denon_AVR_X2400H extends Denon_AVR_X2300W
{
    // see AVR-X3400H_X2400H_X1400H_S930H_S730H_PROTOCOL_V01.xlsx
    public static $Name = 'AVR-X2400H';
    public static $internalID = 34;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DIM,
    ];
    public static $SI_SubCommands = [
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::BT,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];

}

class Denon_AVR_X2500H extends Denon_AVR_X2400H
{
    // see AVR-X3500H_X2500H_X1500H_S940H_S740H_S640H_PROTOCOL_V01.xlsx
    public static $Name = 'AVR-X2500H';
    public static $internalID = 43;
    public static $SI_SubCommands = [
        DENON_API_Commands::PHONO,
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::BT,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSCLV,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
}

/* ---------------------
 * Denon AVR-X1x00W Serie
   --------------------*/
class Denon_AVR_X1100W extends DenonAVR
{
    // see IP_Protocol_AVR-Xx100.pdf
    public static $Name = 'AVR-X1100W';
    public static $internalID = 8;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVZRL,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $SI_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::NET,
        DENON_API_Commands::BT,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSAUDIO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER,
        DENON_API_Commands::Z2INPUT,
        DENON_API_Commands::Z2VOL,
        DENON_API_Commands::Z2MU,
        DENON_API_Commands::Z2QUICK,
        DENON_API_Commands::Z2STBY,
        DENON_API_Commands::Z2SLP,
        'Model', DENON_API_Commands::PW, 'Zone2Name',
    ];
}

class Denon_AVR_X1200W extends Denon_AVR_X1100W
{
    // see Steuerungsprotokoll_IP_RS232C_AVR-X1200W_AVR-X2200W_AVR-X3200W_AVR-X4200W.pdf
    public static $Name = 'AVR-X1200W';
    public static $internalID = 9;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVZRL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];

}

class Denon_AVR_X1300W extends Denon_AVR_X1200W
{
    // see AVR-S720W_S920W_X1300W_X2300W_X3300W_X4300H_X6300H_PROTOCOL_V03.xlsx
    public static $Name = 'AVR-X1300W';
    public static $internalID = 31;
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
}

class Denon_AVR_X1400H extends Denon_AVR_X1300W
{
    // see AVR-X3400H_X2400H_X1400H_S930H_S730H_PROTOCOL_V01.xlsx
    public static $Name = 'AVR-X1400H';
    public static $internalID = 37;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DIM,
    ];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVZRL,
    ];
}

class Denon_AVR_X1500H extends Denon_AVR_X1400H
{
    // see AVR-X3500H_X2500H_X1500H_S940H_S740H_S640H_PROTOCOL_V01.xlsx
    public static $Name = 'AVR-X1500H';
    public static $internalID = 42;
    public static $SI_SubCommands = [
        DENON_API_Commands::PHONO,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::NET,
        DENON_API_Commands::BT,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSCLV,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];

}

/* ---------------------
 * Denon AVR-X3x00 Serie
   --------------------*/
class Denon_AVR_X3000 extends DenonAVR
{
    // see AVRX3000_PROTOCOL(1030)_V01.pdf
    public static $Name = 'AVR-X3000';
    public static $internalID = 13;

    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::NS,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW, DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Denon_AVR_X3400H extends Denon_AVR_X3000
{
    // see AVR-X3400H_X2400H_X1400H_S930H_S730H_PROTOCOL_V01.xlsx
    public static $Name = 'AVR-X3400H';
    public static $internalID = 36;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DIM,
    ];
    public static $SI_SubCommands = [
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::BT,
    ];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVZRL
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SC4KF, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCH4KF, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS, DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
        DENON_API_Commands::Z2HDA,
    ];
}

class Denon_AVR_X3500H extends Denon_AVR_X3400H
{
    // see AVR-X3500H_X2500H_X1500H_S940H_S740H_S640H_PROTOCOL_V01.xlsx
    public static $Name = 'AVR-X3500H';
    public static $internalID = 44;
    public static $SI_SubCommands = [
        DENON_API_Commands::PHONO,
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::BT,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCLV,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
 }

/* ---------------------
 * Denon AVR-X4x00(W) Serie
   --------------------*/
class Denon_AVR_X4000 extends DenonAVR
{
    // see AVRX4000_PROTOCOL(1030)_V01.pdf
    public static $Name = 'AVR-X4000';
    public static $internalID = 16;

    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS, DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Denon_AVR_X4100W extends Denon_AVR_X4000
{
    // see IP_Protocol_AVR-Xx100.pdf
    public static $Name = 'AVR-X4100W';
    public static $internalID = 17;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVTRL, DENON_API_Commands::CVTRR,
        DENON_API_Commands::CVRHL, DENON_API_Commands::CVRHR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVBDL, DENON_API_Commands::CVBDR,
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR,
        DENON_API_Commands::CVZRL,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSSWL, DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSAUROPR,
        DENON_API_Commands::PSAUROST,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SC4KF, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCH4KF, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS, DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2HDA,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
    ];
}

class Denon_AVR_X4200W extends Denon_AVR_X4100W
{
    // see Steuerungsprotokoll_IP_RS232C_AVR-X1200W_AVR-X2200W_AVR-X3200W_AVR-X4200W.pdf
    public static $Name = 'AVR-X4200W';
    public static $internalID = 18;
    //static $CV_Commands = [];
}

class Denon_AVR_X4300H extends Denon_AVR_X4200W
{
    // see AVR-S720W_S920W_X1300W_X2300W_X3300W_X4300H_X6300H_PROTOCOL_V03.xlsx
    public static $Name = 'AVR-X4300H';
    public static $internalID = 27;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $SI_SubCommands = [
        DENON_API_Commands::PHONO,
        DENON_API_Commands::CD,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::BT,
    ];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVTRL, DENON_API_Commands::CVTRR,
        DENON_API_Commands::CVRHL, DENON_API_Commands::CVRHR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVBDL, DENON_API_Commands::CVBDR,
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR,
        DENON_API_Commands::CVTS,
        DENON_API_Commands::CVZRL,
    ];

}

class Denon_AVR_X4400H extends Denon_AVR_X4300H
{
    // see Denon_8500H.xlsx
    public static $Name = 'AVR-X4400H';
    public static $internalID = 38;
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSSWL, DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSAUROPR,
        DENON_API_Commands::PSAUROST,
    ];
}

/* ---------------------
 * Denon AVR-X5x00 Serie
   --------------------*/
class Denon_AVR_X5200W extends DenonAVR
{
    // see IP_Protocol_AVR-Xx100.pdf
    public static $Name = 'AVR-X5200W';
    public static $internalID = 19;

    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVTRL, DENON_API_Commands::CVTRR,
        DENON_API_Commands::CVRHL, DENON_API_Commands::CVRHR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVBDL, DENON_API_Commands::CVBDR,
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR, DENON_API_Commands::CVTS,
        DENON_API_Commands::CVZRL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::NS,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSSWL, DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSDEH,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSAUROPR,
        DENON_API_Commands::PSAUROST,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SC4KF, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCH4KF, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS, DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
    ];
}

/* ---------------------
 * Denon AVR-X6x00 Serie
   --------------------*/
class Denon_AVR_X6200W extends DenonAVR
{
    // see AVR-S720W_S920W_X1300W_X2300W_X3300W_X4300H_X6300H_PROTOCOL_V03.xlsx (red marked at X6300H)
    public static $Name = 'AVR-X6200W';
    public static $internalID = 20;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVTRL, DENON_API_Commands::CVTRR,
        DENON_API_Commands::CVRHL, DENON_API_Commands::CVRHR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVBDL, DENON_API_Commands::CVBDR,
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR, DENON_API_Commands::CVTS,
        DENON_API_Commands::CVZRL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DIM,
        DENON_API_Commands::DISPLAY,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSSWL, DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSDEH,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSAUROPR,
        DENON_API_Commands::PSAUROST,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SC4KF, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCH4KF, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS, DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
    ];
}

class Denon_AVR_X6300H extends Denon_AVR_X6200W
{
    // see AVR-S720W_S920W_X1300W_X2300W_X3300W_X4300H_X6300H_PROTOCOL_V03.xlsx
    public static $Name = 'AVR-X6300H';
    public static $internalID = 35;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DIM,
    ];
    public static $SI_SubCommands = [
        DENON_API_Commands::PHONO,
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::BT,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::PW,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS, DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2HDA,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
    ];
}

class Denon_AVR_X6400H extends Denon_AVR_X6300H
{
    // see Denon_8500H.xlsx
    public static $Name = 'AVR-X6400H';
    public static $internalID = 26;

    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSSWL, DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSDEH,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSAUROPR,
        DENON_API_Commands::PSAUROST,
    ];
}

/* ---------------------
 * Denon AVR-X7x00 Serie
   --------------------*/
class Denon_AVR_X7200W extends DenonAVR
{
    // see IP_Protocol_AVR-Xx100.pdf
    public static $Name = 'AVR-X7200W';
    public static $internalID = 21;

    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVTRL, DENON_API_Commands::CVTRR,
        DENON_API_Commands::CVRHL, DENON_API_Commands::CVRHR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVBDL, DENON_API_Commands::CVBDR,
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR, DENON_API_Commands::CVTS,
        DENON_API_Commands::CVZRL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::CD,
        DENON_API_Commands::ON,
        DENON_API_Commands::OFF,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::NS,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSWIDESCREEN,
        DENON_API_Commands::MSSUPERSTADIUM,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSCLASSICCONCERT,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW, DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSDEH,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSEFF,
        DENON_API_Commands::PSDEL,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];

    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
        DENON_API_Commands::VSVST,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SC4K, DENON_API_Commands::SC4KF, DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCH4K, DENON_API_Commands::SCH4KF, DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS, DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
    ];

}

class Denon_AVR_X7200WA extends Denon_AVR_X7200W
{
    // see IP_Protocol_AVR-Xx100.pdf
    public static $Name = 'AVR-X7200WA';
    public static $internalID = 22;

    //static $CV_Commands = [];
}

/* ---------------------
 * Denon AVC-X8x00 Serie
   --------------------*/
class Denon_AVC_X8500H extends Denon_AVR_X7200WA
{
    public static $Name           = 'AVC-X8500H';

    public static $internalID     = 39;

    public static $httpMainZone   = DENON_HTTP_Interface::NoHTTPInterface;

    public static $InfoFunctions  = [];

    public static $SI_SubCommands = [
        DENON_API_Commands::PHONO,
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::BT,
        ];

    public static $CV_Commands    = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR,
        DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR,
        DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVTFL, DENON_API_Commands::CVTFR,
        DENON_API_Commands::CVTML, DENON_API_Commands::CVTMR,
        DENON_API_Commands::CVTRL, DENON_API_Commands::CVTRR,
        DENON_API_Commands::CVRHL, DENON_API_Commands::CVRHR,
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVBDL, DENON_API_Commands::CVBDR,
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR,
        DENON_API_Commands::CVTS,
        DENON_API_Commands::CVCH,
        DENON_API_Commands::CVZRL,
        ];

    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSROCKARENA,
        DENON_API_Commands::MSJAZZCLUB,
        DENON_API_Commands::MSMONOMOVIE,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIDEOGAME,
        DENON_API_Commands::MSVIRTUAL,
        ];
}
    /* ---------------------
     * Denon CEOL Serie
       --------------------*/
class Denon_DRA_N5 extends DenonAVR
{
    // see DRAN5_RCDN8_PROTOCOL_V.1.0.0.pdf
    public static $Name = 'DRA-N5';

    public static $internalID = 40;

    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;

    public static $InfoFunctions = [];

    public static $InputSettings = [
        DENON_API_Commands::SI,
    ];

    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::MU,
        DENON_API_Commands::SLP,
    ];

    public static $CV_Commands = [
        DENON_API_Commands::MV,
        ];

    public static $PS_Commands = [
        DENON_API_Commands::PSBAS,
        DENON_API_Commands::PSTRE,
    ];

    public static $SI_SubCommands = [
        DENON_API_Commands::IRADIO,
        DENON_API_Commands::SERVER,
        DENON_API_Commands::IPOD,
        DENON_API_Commands::USB,
        DENON_API_Commands::AUXB,
        DENON_API_Commands::AUXD,
    ];

    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::NS,
    ];

    public static $SurroundMode = [];

    public static $VS_Commands = [];

}

class Denon_RCD_N8 extends Denon_DRA_N5
{
    // see DRAN5_RCDN8_PROTOCOL_V.1.0.0.pdf
    public static $Name = 'RCD-N8';

    public static $internalID = 41;

    public static $SI_SubCommands = [
        DENON_API_Commands::IRADIO,
        DENON_API_Commands::SERVER,
        DENON_API_Commands::IPOD,
        DENON_API_Commands::CD,
        DENON_API_Commands::FM,
        DENON_API_Commands::DAB,
    ];

}
