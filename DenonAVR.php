<?php

/* -----------------------------------------------------------------------------
 *                       Denon
   ---------------------------------------------------------------------------*/


class DenonAVR extends AVR{
    static $Manufacturer = DENONIPSProfiles::ManufacturerDenon;
    static $InputSettings = [
        DENON_API_Commands::SI,
        DENON_API_Commands::MSQUICK
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
    ];
}


/* ---------------------
 * Denon AVR-380x Serie
   --------------------*/
class Denon_AVR_3808A extends DenonAVR {
    // see AVR-3808CISerialProtocol_Ver520a.pdf
    static $Name = 'AVR-3808A';
    static $internalID = 3;
    static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    static $MS_SubCommands = [
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
    static $VS_Commands = [
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SCAUTO
    ];
    static $PS_Commands = [
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
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR, DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
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
class Denon_AVR_3310 extends DenonAVR{
    // see AVR3310CI_AVR990_AVC3310_PROTOCOL_V640.pdf
    static $Name = 'AVR-3310';
    static $internalID = 32;
    static $httpMainZone = DENON_HTTP_Interface::MainForm_old;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    static $MS_SubCommands = [
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
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P, DENON_API_Commands::SC10I, DENON_API_Commands::SC72P, DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24, DENON_API_Commands::SCAUTO
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P, DENON_API_Commands::SCH10I, DENON_API_Commands::SCH72P, DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24, DENON_API_Commands::SCHAUTO
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR, DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $PSSP_SubCommands = [
        DENON_API_Commands::SPFH, DENON_API_Commands::SPFW, DENON_API_Commands::SPSB, DENON_API_Commands::SPOFF
    ];
}

class Denon_AVR_3311 extends Denon_AVR_3310{
    // see AVR3311CI_AVR3311_991_PROTOCOL_V710.pdf
    static $Name = 'AVR-3311';
    static $internalID = 33;
    static $InfoFunctions = ['MainZoneName', 'Model'];
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
    ];
    static $MS_SubCommands = [
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
    static $PS_Commands = [
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
    static $PSDYNVOL_SubCommands = [
        DENON_API_Commands::DYNVOLOFF,
        DENON_API_Commands::DYNVOLDAY,
        DENON_API_Commands::DYNVOLEVE,
        DENON_API_Commands::DYNVOLNGT,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];

}

class Denon_AVR_3312 extends Denon_AVR_3311{
    // see AVR-3312E2_DEU_CD-ROM_v00.pdf
    static $Name = 'AVR-3312';
    static $internalID = 1;
    static $MS_SubCommands = [
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

class Denon_AVR_3313 extends Denon_AVR_3312{
    //see AVR3313CI_PROTOCOL_V01.pdf
    static $Name = 'AVR-3313';
    static $internalID = 2;
    static $httpMainZone = DENON_HTTP_Interface::MainForm;
}

/* ---------------------
 * Denon AVR-431x Serie
   --------------------*/
class Denon_AVR_4310 extends DenonAVR{
    // see AVR4311CI_AVR4311_PROTOCOL_V7 2 0.pdf (bold differences to 4311)
    static $Name = 'AVR-4310';
    static $internalID = 5;
    static $httpMainZone = DENON_HTTP_Interface::MainForm_old;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MS7CHSTEREO,
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
    static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSSB,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSFH,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
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
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR, DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];

    static $VS_Commands = [
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVST,
    ];

}

class Denon_AVR_4311 extends Denon_AVR_4310{
    //see AVR4311CI_AVR4311_PROTOCOL_V7 2 0.pdf
    static $Name = 'AVR-4311';
    static $internalID = 6;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSW2,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    static $MS_SubCommands = [
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
    static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSSB,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
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
    static $PSDYNVOL_SubCommands = [
        DENON_API_Commands::DYNVOLOFF,
        DENON_API_Commands::DYNVOLDAY,
        DENON_API_Commands::DYNVOLEVE,
        DENON_API_Commands::DYNVOLNGT,
    ];
    static $VS_Commands = [
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
class Denon_AVR_X2000 extends DenonAVR{
    // see AVRX2000_E400_PROTOCOL(1010)_V04.pdf
    static $Name = 'AVR-X2000';
    static $internalID = 34;
    static $InfoFunctions = ['MainZoneName', 'Model'];
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
    ];
    static $MS_SubCommands = [
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
    static $PS_Commands = [
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
    static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN,
        DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR,
        DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];
    static $Zone_Commands = [
        'Model', DENON_API_Commands::PW,
        'Zone2Name', 'Zone3Name',
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2QUICK, DENON_API_Commands::Z3QUICK,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}


/* ---------------------
 * Denon AVR-X1x00W Serie
   --------------------*/
class Denon_AVR_X1100W extends DenonAVR{
    // see IP_Protocol_AVR-Xx100.pdf
    static $Name = 'AVR-X1100W';
    static $internalID = 8;
//    static $httpMainZone = DENON_HTTP_Interface::MainForm_old; //only test
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVZRL,
    ];
    static $InputSettings = [DENON_API_Commands::SI,
        DENON_API_Commands::MSQUICK,
        DENON_API_Commands::SD,
        DENON_API_Commands::DC,
        DENON_API_Commands::SV
    ];
    static $PowerFunctions = [DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP
    ];
    static $MS_SubCommands = [
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
    static $PS_Commands = [
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
    static $VS_Commands = [
        DENON_API_Commands::VSAUDIO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER,
        DENON_API_Commands::Z2INPUT,
        DENON_API_Commands::Z2VOL,
        DENON_API_Commands::Z2MU,
        DENON_API_Commands::Z2QUICK,
        DENON_API_Commands::Z2STBY,
        DENON_API_Commands::Z2SLP,
        'Model', 'Zone2Name',
    ];

}

class Denon_AVR_X1200W extends Denon_AVR_X1100W {
    // see Steuerungsprotokoll_IP_RS232C_AVR-X1200W_AVR-X2200W_AVR-X3200W_AVR-X4200W.pdf
    static $Name = 'AVR-X1200W';
    static $internalID = 9;
    static $CV_Commands = [
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
    static $MS_SubCommands = [
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
    static $PS_Commands = [
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

class Denon_AVR_X1300W extends Denon_AVR_X1200W {
    // see AVR-S720W_S920W_X1300W_X2300W_X3300W_X4300H_X6300H_PROTOCOL_V03.xlsx
    static $Name = 'AVR-X1300W';
    static $internalID = 31;
    static $MS_SubCommands = [
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


/* ---------------------
 * Denon AVR-X4x00W Serie
   --------------------*/
class Denon_AVR_X4100W extends DenonAVR{
    // see IP_Protocol_AVR-Xx100.pdf
    static $Name = 'AVR-X4100W';
    static $internalID = 17;
    static $CV_Commands = [
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
    static $MS_SubCommands = [
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
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];

}

class Denon_AVR_X4200W extends Denon_AVR_X4100W{
    // see Steuerungsprotokoll_IP_RS232C_AVR-X1200W_AVR-X2200W_AVR-X3200W_AVR-X4200W.pdf
    static $Name = 'AVR-X4200W';
    static $internalID = 18;
    //static $CV_Commands = [];
}


/* ---------------------
 * Denon AVR-X5x00 Serie
   --------------------*/
class Denon_AVR_X5200W extends DenonAVR{
    // see IP_Protocol_AVR-Xx100.pdf
    static $Name = 'AVR-X5200W';
    static $internalID = 19;
    static $CV_Commands = [
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
    static $MS_SubCommands = [
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
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];

}


/* ---------------------
 * Denon AVR-X6x00 Serie
   --------------------*/
class Denon_AVR_X6200W extends DenonAVR{
    // see AVR-S720W_S920W_X1300W_X2300W_X3300W_X4300H_X6300H_PROTOCOL_V03.xlsx (red marked at X6300H)
    static $Name = 'AVR-X6200W';
    static $internalID = 20;
    static $CV_Commands = [
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
    static $MS_SubCommands = [
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
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
    ];

}


/* ---------------------
 * Denon AVR-X7x00 Serie
   --------------------*/
class Denon_AVR_X7200W extends DenonAVR{
    // see IP_Protocol_AVR-Xx100.pdf
    static $Name = 'AVR-X7200W';
    static $internalID = 21;
    static $CV_Commands = [
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
    static $MS_SubCommands = [
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
    static $PS_Commands = [
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSFH,
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
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSRSZ,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSRSTR,
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO,
        DENON_API_Commands::VSVPM,
        DENON_API_Commands::VSVST,
    ];

}

class Denon_AVR_X7200WA extends Denon_AVR_X7200W{
    // see IP_Protocol_AVR-Xx100.pdf
    static $Name = 'AVR-X7200WA';
    static $internalID = 22;

    //static $CV_Commands = [];
}


