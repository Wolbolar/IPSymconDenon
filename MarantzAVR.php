<?php

/* -----------------------------------------------------------------------------
 *                       Marantz
 *
 * older models are documented
 * in 'Marantz 2015 NR_SR_AV IP-232 Protocol.xls'
 *
 * SR5011, SR6011, SR7011, NR1607, AV7703 are documented in
 * in 'Marantz_FY16_AV_SR_NR_PROTOCOL_V03.xls'

 * SR5012, SR6012, SR7012, NR1608, AV7704 are documented in
 * in 'Marantz_FY17_AV_SR_NR_PROTOCOL_V03.xls'

 * SR5013, SR6013, SR7013, NR1509, NR1609, AV7705 are documented in
 * in 'Marantz_FY18_AV_SR_NR_PROTOCOL_V04.xls'
   ---------------------------------------------------------------------------*/

class MarantzAVR extends AVR
{
    public static $Manufacturer = DENONIPSProfiles::ManufacturerMarantz;
    public static $InputSettings = [
        DENON_API_Commands::SI,
        DENON_API_Commands::MSSMART,
        DENON_API_Commands::SD,
        DENON_API_Commands::DC,
        DENON_API_Commands::SV
    ];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVZRL,
        ];
    public static $PS_Commands = [
        DENON_API_Commands::PSDELAY,
        ];
}

/* ---------------------
 * Marantz NR150x Serie
   --------------------*/
class Marantz_NR1504 extends MarantzAVR
{
    public static $Name = 'Marantz-NR1504';
    public static $internalID = 60;
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $SV_SubCommands = [
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
    public static $PS_Commands = [
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
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSAUDIO,
    ];
}

class Marantz_NR1506 extends Marantz_NR1504
{
    public static $Name = 'Marantz-NR1506';
    public static $internalID = 61;
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $PS_Commands = [
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
}

class Marantz_NR1508 extends Marantz_NR1506
{
    public static $Name = 'Marantz-NR1508';
    public static $internalID = 94;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DIM,
    ];
    public static $SI_SubCommands = [
        DENON_API_Commands::CD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::BT,
    ];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVZRL,
    ];
    public static $PS_Commands = [
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

class Marantz_NR1509 extends Marantz_NR1508
{
    public static $Name = 'Marantz-NR1509';
    public static $internalID = 100;
    public static $SI_SubCommands = [
        DENON_API_Commands::PHONO,
        DENON_API_Commands::CD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::NET,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::BT,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSCLV,
        DENON_API_Commands::PSLFE,
        DENON_API_Commands::PSPAN,
        DENON_API_Commands::PSDIM,
        DENON_API_Commands::PSCEN,
        DENON_API_Commands::PSCEI,
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

/* ---------------------
 * Marantz NR160x Serie
   --------------------*/
class Marantz_NR1602 extends MarantzAVR
{
    public static $Name = 'Marantz-NR1602';
    public static $internalID = 62;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT,
        DENON_API_Commands::GAME,
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $VS_Commands = [
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];
}

class Marantz_NR1603 extends Marantz_NR1602
{
    public static $Name = 'Marantz-NR1603';
    public static $internalID = 63;
    //static $CV_Commands = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::CD,
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCHAUTO,
    ];
}

class Marantz_NR1604 extends Marantz_NR1603
{
    public static $Name = 'Marantz-NR1604';
    public static $internalID = 64;
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
}

class Marantz_NR1605 extends Marantz_NR1604
{
    public static $Name = 'Marantz-NR1605';
    public static $internalID = 65;
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
    public static $PS_Commands = [
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

    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];
}

class Marantz_NR1606 extends Marantz_NR1605
{
    public static $Name = 'Marantz-NR1606';
    public static $internalID = 66;
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

class Marantz_NR1607 extends Marantz_NR1606
{
    public static $Name = 'Marantz-NR1607';
    public static $internalID = 90;
}

class Marantz_NR1608 extends Marantz_NR1607
{
    public static $Name = 'Marantz-NR1608';
    public static $internalID = 95;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];

    public static $SI_SubCommands = [
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::NET,
        DENON_API_Commands::BT,
    ];
}

class Marantz_NR1609 extends Marantz_NR1608
{
    public static $Name = 'Marantz-NR1609';
    public static $internalID = 101;

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
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::NET,
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

/* ---------------------
 * Marantz SR500x Serie
   --------------------*/
class Marantz_SR5006 extends MarantzAVR
{
    public static $Name = 'Marantz-SR5006';
    public static $internalID = 67;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT,
        DENON_API_Commands::VCR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $VS_Commands = [
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];
}

class Marantz_SR5007 extends Marantz_SR5006
{
    public static $Name = 'Marantz-SR5007';
    public static $internalID = 68;
    //static $CV_Commands = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
        DENON_API_Commands::MSVIRTUAL,
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
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
}

class Marantz_SR5008 extends Marantz_SR5007
{
    public static $Name = 'Marantz-SR5008';
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
}

class Marantz_SR5009 extends Marantz_SR5008
{
    public static $Name = 'Marantz-SR5009';
    public static $internalID = 70;
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
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
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2STBY, DENON_API_Commands::Z3STBY,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP, //not documented, but working
    ];
}

class Marantz_SR5010 extends Marantz_SR5009
{
    public static $Name = 'Marantz-SR5010';
    public static $internalID = 71;
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

class Marantz_SR5011 extends Marantz_SR5010
{
    public static $Name = 'Marantz-SR5011';
    public static $internalID = 89;
}

class Marantz_SR5012 extends Marantz_SR5011
{
    public static $Name = 'Marantz-SR5012';
    public static $internalID = 96;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
    public static $SI_SubCommands = [
        DENON_API_Commands::CD,
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::GAME,
        DENON_API_Commands::TUNER,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::NET,
        DENON_API_Commands::BT,
    ];

}

class Marantz_SR5013 extends Marantz_SR5012
{
    public static $Name = 'Marantz-SR5013';
    public static $internalID = 102;
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
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::NET,
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

/* ---------------------
 * Marantz SR600x Serie
   --------------------*/
class Marantz_SR6005 extends MarantzAVR
{
    public static $Name = 'Marantz-SR6005';
    public static $internalID = 71;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
    ];
    public static $MS_SubCommands = [
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
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::VCR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    public static $PSDYNVOL_SubCommands = [
        DENON_API_Commands::DYNVOLOFF,
        DENON_API_Commands::DYNVOLDAY,
        DENON_API_Commands::DYNVOLEVE,
        DENON_API_Commands::DYNVOLNGT,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
    ];
}

class Marantz_SR6006 extends Marantz_SR6005
{
    public static $Name = 'Marantz-SR6006';
    public static $internalID = 73;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSDIRECT,
        DENON_API_Commands::MSPUREDIRECT,
        DENON_API_Commands::MSSTEREO,
        DENON_API_Commands::MSAUTO,
        DENON_API_Commands::MSDOLBYDIGITAL,
        DENON_API_Commands::MSDTSSURROUND,
        DENON_API_Commands::MSMCHSTEREO,
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT,
        DENON_API_Commands::VCR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Marantz_SR6007 extends Marantz_SR6006
{
    public static $Name = 'Marantz-SR6007';
    public static $internalID = 74;
    //static $CV_Commands = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
        DENON_API_Commands::MSVIRTUAL,
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
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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

class Marantz_SR6008 extends Marantz_SR6007
{
    public static $Name = 'Marantz-SR6008';
    public static $internalID = 75;
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
    public static $PS_Commands = [
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
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
}

class Marantz_SR6009 extends Marantz_SR6008
{
    public static $Name = 'Marantz-SR6009';
    public static $internalID = 76;
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
    ];
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
        DENON_API_Commands::CVZRL,
    ];
    public static $PS_Commands = [
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
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCH4KF,
        DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
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

class Marantz_SR6010 extends Marantz_SR6009
{
    public static $Name = 'Marantz-SR6010';
    public static $internalID = 77;
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
}

class Marantz_SR6011 extends Marantz_SR6010
{
    public static $Name = 'Marantz-SR6011';
    public static $internalID = 91;
}

class Marantz_SR6012 extends Marantz_SR6011
{
    public static $Name = 'Marantz-SR6012';
    public static $internalID = 97;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
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
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::NET,
        DENON_API_Commands::BT,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];

}

class Marantz_SR6013 extends Marantz_SR6012
{
    public static $Name = 'Marantz-SR6013';
    public static $internalID = 103;
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];

}

/* ---------------------
 * Marantz SR700x Serie
   --------------------*/
class Marantz_SR7005 extends MarantzAVR
{
    public static $Name = 'Marantz-SR7005';
    public static $internalID = 78;
    public static $CV_Commands = [
        DENON_API_Commands::MV,
        DENON_API_Commands::CVFL, DENON_API_Commands::CVFR, DENON_API_Commands::CVC,
        DENON_API_Commands::CVSW,
        DENON_API_Commands::CVSL, DENON_API_Commands::CVSR,
        DENON_API_Commands::CVSBL, DENON_API_Commands::CVSBR, DENON_API_Commands::CVSB,
        DENON_API_Commands::CVFHL, DENON_API_Commands::CVFHR,
        DENON_API_Commands::CVFWL, DENON_API_Commands::CVFWR,
    ];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNSRC,
        DENON_API_Commands::DISPLAY,
    ];
    public static $MS_SubCommands = [
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
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT,
        DENON_API_Commands::VCR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
        DENON_API_Commands::PSDYNVOL,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSDCO,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
    ];
    public static $PSDYNVOL_SubCommands = [
        DENON_API_Commands::DYNVOLOFF,
        DENON_API_Commands::DYNVOLDAY,
        DENON_API_Commands::DYNVOLEVE,
        DENON_API_Commands::DYNVOLNGT,
    ];
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
    ];
}

class Marantz_SR7007 extends Marantz_SR7005
{
    public static $Name = 'Marantz-SR7007';
    public static $internalID = 79;
    //static $CV_Commands = [];
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
        DENON_API_Commands::MSVIRTUAL,
    ];
    public static $SV_SubCommands = [
        DENON_API_Commands::DVD,
        DENON_API_Commands::BD,
        DENON_API_Commands::TV,
        DENON_API_Commands::SAT_CBL,
        DENON_API_Commands::MPLAY,
        DENON_API_Commands::VCR,
        DENON_API_Commands::GAME,
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::CD,
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Marantz_SR7008 extends Marantz_SR7007
{
    public static $Name = 'Marantz-SR7008';
    public static $internalID = 80;
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
    public static $PS_Commands = [
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
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
}

class Marantz_SR7009 extends Marantz_SR7008
{
    public static $Name = 'Marantz-SR7009';
    public static $internalID = 81;
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::ECO,
        DENON_API_Commands::SLP,
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
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR, DENON_API_Commands::CVTS,
        DENON_API_Commands::CVZRL,
    ];
    public static $MS_SubCommands = [
        DENON_API_Commands::MSMOVIE,
        DENON_API_Commands::MSMUSIC,
        DENON_API_Commands::MSGAME,
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
    public static $PS_Commands = [
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCH4KF,
        DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
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

class Marantz_SR7010 extends Marantz_SR7009
{
    public static $Name = 'Marantz-SR7010';
    public static $internalID = 82;
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
}

class Marantz_SR7011 extends Marantz_SR7010
{
    public static $Name = 'Marantz-SR7011';
    public static $internalID = 92;
}

class Marantz_SR7012 extends Marantz_SR7011
{
    public static $Name = 'Marantz-SR7012';
    public static $internalID = 98;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
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
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::NET,
        DENON_API_Commands::BT,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSBSC,
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
}

class Marantz_SR7013 extends Marantz_SR7012
{
    public static $Name = 'Marantz-SR7013';
    public static $internalID = 104;
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCLV,
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
}

/* ---------------------
 * Marantz AV7005 Serie
   --------------------*/
class Marantz_AV7005 extends Marantz_SR7005
{
    public static $Name = 'Marantz-AV7005';
    public static $internalID = 84;
}

/* ---------------------
 * Marantz AV770x Serie
   --------------------*/
class Marantz_AV7701 extends MarantzAVR
{
    public static $Name = 'Marantz-AV7701';
    public static $internalID = 83;
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
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
        DENON_API_Commands::MSVIRTUAL,
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
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $PV_Commands = [
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
        DENON_API_Commands::Z2MU, DENON_API_Commands::Z3MU,
        DENON_API_Commands::Z2CS, DENON_API_Commands::Z3CS,
        DENON_API_Commands::Z2CVFL, DENON_API_Commands::Z3CVFL, DENON_API_Commands::Z2CVFR, DENON_API_Commands::Z3CVFR,
        DENON_API_Commands::Z2HPF, DENON_API_Commands::Z3HPF,
        DENON_API_Commands::Z2PSBAS, DENON_API_Commands::Z3PSBAS,
        DENON_API_Commands::Z2PSTRE, DENON_API_Commands::Z3PSTRE,
        DENON_API_Commands::Z2SLP, DENON_API_Commands::Z3SLP,
    ];
}

class Marantz_AV7702 extends Marantz_AV7701
{
    public static $Name = 'Marantz-AV7702';
    public static $internalID = 85;
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
    ];
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::SLP,
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
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR, DENON_API_Commands::CVTS,
        DENON_API_Commands::CVZRL,
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
        DENON_API_Commands::MSVIRTUAL,
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
    ];
    public static $PS_Commands = [
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
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCH4KF,
        DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
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

class Marantz_AV7702mkII extends Marantz_AV7702
{
    public static $Name = 'Marantz-AV7702 mk II';
    public static $internalID = 86;
    public static $PS_Commands = [
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
    ];
}

class Marantz_AV7703 extends Marantz_AV7702mkII
{
    public static $Name = 'Marantz-AV7703';
    public static $internalID = 93;
}

class Marantz_AV7704 extends Marantz_AV7703
{
    public static $Name = 'Marantz-AV7704';
    public static $internalID = 99;
    public static $httpMainZone = DENON_HTTP_Interface::NoHTTPInterface;
    public static $InfoFunctions = [];
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
        DENON_API_Commands::AUX1,
        DENON_API_Commands::AUX2,
        DENON_API_Commands::NET,
        DENON_API_Commands::BT,
    ];
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSBSC,
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
}

class Marantz_AV7705 extends Marantz_AV7704
{
    public static $Name = 'Marantz-AV7705';
    public static $internalID = 105;
    public static $PS_Commands = [
        DENON_API_Commands::PSFRONT,
        DENON_API_Commands::PSSWR,
        DENON_API_Commands::PSTONECTRL,
        DENON_API_Commands::PSBAS, DENON_API_Commands::PSTRE,
        DENON_API_Commands::PSLOM,
        DENON_API_Commands::PSBSC,
        DENON_API_Commands::PSSWL,
        DENON_API_Commands::PSSWL2,
        DENON_API_Commands::PSCLV,
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
        DENON_API_Commands::PSLFC,
        DENON_API_Commands::PSCNTAMT,
        DENON_API_Commands::PSGEQ,
        DENON_API_Commands::PSHEQ,
        DENON_API_Commands::PSDRC,
        DENON_API_Commands::PSMDAX,
        DENON_API_Commands::PSDELAY,
        DENON_API_Commands::PSAUROPR, DENON_API_Commands::PSAUROST,
    ];
}

/* ---------------------
 * Marantz AV880x Serie
   --------------------*/
class Marantz_AV8801 extends MarantzAVR
{
    public static $Name = 'Marantz-AV8801';
    public static $internalID = 87;
    public static $SystemControl_Commands = [
        DENON_API_Commands::MN,
        DENON_API_Commands::MNMEN,
        DENON_API_Commands::MNZST,
        DENON_API_Commands::DISPLAY,
        DENON_API_Commands::SSHOSALS,
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
        DENON_API_Commands::MSVIRTUAL,
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
        DENON_API_Commands::SOURCE,
    ];
    public static $PS_Commands = [
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
    public static $PV_Commands = [
        DENON_API_Commands::PVPICT,
        DENON_API_Commands::PVCN, DENON_API_Commands::PVBR,
        DENON_API_Commands::PVST,
        DENON_API_Commands::PVCM, DENON_API_Commands::PVHUE,
        DENON_API_Commands::PVDNR, DENON_API_Commands::PVENH,
    ];
    public static $VS_Commands = [
        DENON_API_Commands::VSASP,
        DENON_API_Commands::VSMONI,
        DENON_API_Commands::VSSC, DENON_API_Commands::VSSCH,
        DENON_API_Commands::VSAUDIO, DENON_API_Commands::VSVPM,
        DENON_API_Commands::VSVST,
    ];
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
        DENON_API_Commands::SCH48P,
        DENON_API_Commands::SCH10I,
        DENON_API_Commands::SCH72P,
        DENON_API_Commands::SCH10P,
        DENON_API_Commands::SCH10P24,
        DENON_API_Commands::SCH4K,
        DENON_API_Commands::SCHAUTO,
    ];
    public static $Zone_Commands = [
        DENON_API_Commands::Z2POWER, DENON_API_Commands::Z3POWER,
        DENON_API_Commands::Z2INPUT, DENON_API_Commands::Z3INPUT,
        DENON_API_Commands::Z2VOL, DENON_API_Commands::Z3VOL,
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

class Marantz_AV8802 extends Marantz_AV8801
{
    public static $Name = 'Marantz-AV8802';
    public static $internalID = 88;
    public static $PowerFunctions = [
        DENON_API_Commands::PW,
        DENON_API_Commands::ZM,
        DENON_API_Commands::MU,
        DENON_API_Commands::STBY,
        DENON_API_Commands::SLP,
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
        DENON_API_Commands::CVSHL, DENON_API_Commands::CVSHR, DENON_API_Commands::CVTS,
        DENON_API_Commands::CVZRL,
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
        DENON_API_Commands::MSVIRTUAL,
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
    ];
    public static $PS_Commands = [
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
    public static $VSSC_SubCommands = [
        DENON_API_Commands::SC48P,
        DENON_API_Commands::SC10I,
        DENON_API_Commands::SC72P,
        DENON_API_Commands::SC10P,
        DENON_API_Commands::SC10P24,
        DENON_API_Commands::SC4K,
        DENON_API_Commands::SC4KF,
        DENON_API_Commands::SCAUTO,
    ];
    public static $VSSCH_SubCommands = [
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
