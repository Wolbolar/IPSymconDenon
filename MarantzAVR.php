<?php

/* -----------------------------------------------------------------------------
 *                       Marantz
 *
 * all models (except of SR5011, SR6011, SR7011, NR1607, AV7703) are documented
 * in 'Marantz 2015 NR_SR_AV IP-232 Protocol.xls'
   ---------------------------------------------------------------------------*/


class MarantzAVR extends AVR{
    static $Manufacturer = DENONIPSProfiles::ManufacturerMarantz;
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVZRL,
        ];
    static $PS_Commands = [
        DENON_API_Commands::PSDELAY,
        ];
}

/* ---------------------
 * Marantz NR150x Serie
   --------------------*/
class Marantz_NR1504 extends MarantzAVR{
    static $Name = 'Marantz-NR1504';
    static $internalID = 60;
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSAUDIO,
    ];

}

class Marantz_NR1506 extends Marantz_NR1504{
    static $Name = 'Marantz-NR1506';
    static $internalID = 61;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVZRL,
    ];
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::MSSMART, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
    static $PS_Commands = [
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    //static $VS_Commands = []

}

/* ---------------------
 * Marantz NR160x Serie
   --------------------*/
class Marantz_NR1602 extends MarantzAVR{
    static $Name = 'Marantz-NR1602';
    static $internalID = 62;
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
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];

}

class Marantz_NR1603 extends Marantz_NR1602{
    static $Name = 'Marantz-NR1603';
    static $internalID = 63;
    //static $CV_Commands = [];
    static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCHAUTO,
    ];

}

class Marantz_NR1604 extends Marantz_NR1603{
    static $Name = 'Marantz-NR1604';
    static $internalID = 64;
    static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];

}

class Marantz_NR1605 extends Marantz_NR1604{
    static $Name = 'Marantz-NR1605';
    static $internalID = 65;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVZRL,
    ];
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::MSSMART, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];

    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];
}

class Marantz_NR1606 extends Marantz_NR1605{
    static $Name = 'Marantz-NR1606';
    static $internalID = 66;
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
    static $PS_Commands = [
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
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
}

class Marantz_NR1607 extends Marantz_NR1606{
    static $Name = 'Marantz-NR1607';
    static $internalID = 90;
    // todo: documentation is not yet available !!//
}


/* ---------------------
 * Marantz SR500x Serie
   --------------------*/
class Marantz_SR5006 extends MarantzAVR{
    static $Name = 'Marantz-SR5006';
    static $internalID = 67;
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
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];

}

class Marantz_SR5007 extends Marantz_SR5006{
    static $Name = 'Marantz-SR5007';
    static $internalID = 68;
    //static $CV_Commands = [];
    static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];

}

class Marantz_SR5008 extends Marantz_SR5007{
    static $Name = 'Marantz-SR5008';
    static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];

}

class Marantz_SR5009 extends Marantz_SR5008{
    static $Name = 'Marantz-SR5009';
    static $internalID = 70;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVZRL,
    ];
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::MSSMART, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];

}

class Marantz_SR5010 extends Marantz_SR5009{
    static $Name = 'Marantz-SR5010';
    static $internalID = 71;
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
        DENON_API_Commands::CVFDL, DENON_API_Commands::CVFDR,
        DENON_API_Commands::CVSDL, DENON_API_Commands::CVSDR,
        DENON_API_Commands::CVZRL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];

}

class Marantz_SR5011 extends Marantz_SR5010{
    static $Name = 'Marantz-SR5011';
    static $internalID = 89;
    // todo: documentation is not yet available !!//
}


/* ---------------------
 * Marantz SR600x Serie
   --------------------*/
class Marantz_SR6005 extends MarantzAVR{
    static $Name = 'Marantz-SR6005';
    static $internalID = 71;
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
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSNEURAL,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSFH,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL_OLD,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
    ];

}

class Marantz_SR6006 extends Marantz_SR6005{
    static $Name = 'Marantz-SR6006';
    static $internalID = 73;
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
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];

}

class Marantz_SR6007 extends Marantz_SR6006{
    static $Name = 'Marantz-SR6007';
    static $internalID = 74;
    //static $CV_Commands = [];
    static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];

}

class Marantz_SR6008 extends Marantz_SR6007{
    static $Name = 'Marantz-SR6008';
    static $internalID = 75;
    //static $CV_Commands = [];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];

}

class Marantz_SR6009 extends Marantz_SR6008{
    static $Name = 'Marantz-SR6009';
    static $internalID = 76;
    static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVZRL,
    ];
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::MSSMART, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCH4KF,
        DENON_API_Commands::SCHAUTO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];

}

class Marantz_SR6010 extends Marantz_SR6009{
    static $Name = 'Marantz-SR6010';
    static $internalID = 77;
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
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
}

class Marantz_SR6011 extends Marantz_SR6010{
    static $Name = 'Marantz-SR6011';
    static $internalID = 91;
    // todo: documentation is not yet available !!//
}


/* ---------------------
 * Marantz SR700x Serie
   --------------------*/
class Marantz_SR7005 extends MarantzAVR{
    static $Name = 'Marantz-SR7005';
    static $internalID = 78;
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
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSNEURAL,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSFH,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL_OLD,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
    ];

}

class Marantz_SR7007 extends Marantz_SR7005{
    static $Name = 'Marantz-SR7007';
    static $internalID = 79;
    //static $CV_Commands = [];
    static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];

}

class Marantz_SR7008 extends Marantz_SR7007{
    static $Name = 'Marantz-SR7008';
    static $internalID = 80;
    //static $CV_Commands = [];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
}

class Marantz_SR7009 extends Marantz_SR7008{
    static $Name = 'Marantz-SR7009';
    static $internalID = 81;
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
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::MSSMART, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
    static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCH4KF,
        DENON_API_Commands::SCHAUTO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Marantz_SR7010 extends Marantz_SR7009{
    static $Name = 'Marantz-SR7010';
    static $internalID = 82;
    //static $CV_Commands = [];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
}

class Marantz_SR7011 extends Marantz_SR7010{
    static $Name = 'Marantz-SR7011';
    static $internalID = 92;
    // todo: documentation is not yet available !!//
}


/* ---------------------
 * Marantz AV7005 Serie
   --------------------*/
class Marantz_AV7005 extends MarantzAVR{
    static $Name = 'Marantz-AV7005';
    static $internalID = 84;
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
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSNEURAL,
        DENON_API_Commands::MSSTANDARD,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSMATRIX,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSFH,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL_OLD,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
    ];

}


/* ---------------------
 * Marantz AV770x Serie
   --------------------*/
class Marantz_AV7701 extends MarantzAVR {
    static $Name = 'Marantz-AV7701';
    static $internalID = 83;
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
    static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSPHG,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];

}

class Marantz_AV7702 extends Marantz_AV7701{
    static $Name = 'Marantz-AV7702';
    static $internalID = 85;
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
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCH4KF,
        DENON_API_Commands::SCHAUTO,
    ];
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::MSSMART, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];

}

class Marantz_AV7702mkII extends Marantz_AV7702{
    static $Name = 'Marantz-AV7702 mk II';
    static $internalID = 86;
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSDIL,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSDIC,
        DENON_API_Commands::PSNEURAL,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
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
    ];
}

class Marantz_AV7703 extends Marantz_AV7702mkII{
    static $Name = 'Marantz-AV7703';
    static $internalID = 93;
    // todo: documentation is not yet available !!//
}

/* ---------------------
 * Marantz AV880x Serie
   --------------------*/
class Marantz_AV8801 extends MarantzAVR{
    static $Name = 'Marantz-AV8801';
    static $internalID = 87;
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
    static $InputSettings = [DENON_API_Commands::SI, DENON_API_Commands::MSSMART, DENON_API_Commands::SD, DENON_API_Commands::DC, DENON_API_Commands::SV];
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSDEH,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH
    ];
    static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
        DENON_API_Commands::VSVST,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL,DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Marantz_AV8802 extends Marantz_AV8801{
    static $Name = 'Marantz-AV8802';
    static $internalID = 88;
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
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSAURO3D,
        DENON_API_Commands::MSAURO2DSURR,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSP,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSDEH,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSLFL,
        DENON_API_Commands::PSCES,
        DENON_API_Commands::PSCEG,
        DENON_API_Commands::PSMODE,
        DENON_API_Commands::PSDSX,
        DENON_API_Commands::PSSTW,
        DENON_API_Commands::PSSTH,
        DENON_API_Commands::PSCINEMAEQ,
        DENON_API_Commands::PSHTEQ,
        DENON_API_Commands::PSMULTEQ,
        DENON_API_Commands::PSDYNEQ,
        DENON_API_Commands::PSREFLEV,
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
    static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCH4KF,
        DENON_API_Commands::SCHAUTO,
    ];
}

