<?
//AVR-X4000

//AVR4311
/*
*
*
*/
//Power
PWON
PWSTANDBY
PW? //Return Status

//Master Volume
MVUP
MVDOWN
MV80
MV?

//Channel Volume
CVFL UP
CVFL DOWN
CVFL 50
CVFR UP
CVFR DOWN
CVFR 50
CVC UP
CVC DOWN
CVC 50
CVSW UP
CVSW DOWN
CVSW 50
CVSW2 UP
CVSW2 DOWN
CVSW2 50
CVSL UP
CVSL DOWN
CVSL 50
CVSR UP
CVSR DOWN
CVSR 50
CVSBL UP
CVSBL DOWN
CVSBL 50
CVSBR UP
CVSBR DOWN
CVSBR 50
CVSB UP
CVSB DOWN
CVSB 50
FHL UP
FHL DOWN
FHL 50
FHR UP
FHR DOWN
FHR 50
FWL UP
FWL DOWN
FWL 50
FWR UP
FWR DOWN
FWR 50

//Mute
MUON
MUOFF
MU?

//Input
SIPHONO
SICD
SITUNER
SIDVD
SIBD
SITV
SISAT/CBL
SIDVR
SIGAME
SIV.AUX
SIDOCK
SIIPOD
SINET/USB
SILASTFM
SIFAVORITES
SIIRADIO
SISERVER
SIUSB/IPOD
SI?

//Mainzone
ZMON
ZMOFF
ZM?

//Set Mode
SDAUTO
SDHDMI
SDDIGITAL
SDANALOG
SDEXT.IN
SD?

//SET PCM DTS
DCAUTO
DCPCM
DCDTS
DC?

//Video Select
SVDVD
SVBD
SVTV
SVSAT/CBL
SVDVR
SVGAME
SVV.AUX
SVDOCK
SVSOURCE
SV?

//Main Zone Sleep
SLPOFF
SLP120 //001 bis 120 010=10 Minuten
SLP?

//Select Surround Mode
MSDIRECT
MSPURE DIRECT
MSSTEREO
MSSTANDARD
MSDOLBY DIGITAL
MSDTS SUROUND
MSMCH STEREO
MSWIDE SCREEN
MSSUPER STADIUM
MSROCK ARENA
MSJAZZ CLUB
MSCLASSIC CONCERT
MSMONO MOVIE
MSMATRIX
MSVIDEO GAME
MSVIRTUAL
MS?

//Quick Mode
MSQUICK1
MSQUICK2
MSQUICK3
MSQUICK4
MSQUICK5
MSQUICK ?

//Video Select
VS

//Parameter Setting
PSDOLVOL ON //Dolby Volume 
PSDOLVOL OFF
PSDOLVOL ?
PSFH: ON //Front Height on
PSFH: OFF
PSFH: ?
PSDYNVOL NGT //Dynamic Volume Midnight
PSDYNVOL EVE //Dynamic Volume Evening
PSDYNVOL DAY //Dynamic Volume Day
PSDYNVOL ?
PSBAS UP //Bass
PSBAS DOWN
PSBAS?





//AVR-S700_S900_X1100_X2100_X3100_X4100_X5200_X7200


/* http Command
Features

Multiple simultaneous connections. 
Different command structure than rs232.
Undocumented protocol.
Protocol used in the official iphone app.
Available on 2011 and later receivers.
Not as many commands as IP/serial method.
*/


<key id="volumeDown" code="PutMasterVolumeBtn%2F%3C"/>
    <key id="volumeUp" code="PutMasterVolumeBtn%2F%3E"/>
    <key id="muteOn" code="PutVolumeMute%2Fon&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="muteOff" code="PutVolumeMute%2Foff&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="powerOn" code="PutZone_OnOff%2FON&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="powerOff" code="PutZone_OnOff%2FOFF&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="standbyOn" code="PutSystem_OnStandby%2FON&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="standbyOff" code="PutSystem_OnStandby%2FSTANDBY&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="tuner" code="PutZone_InputFunction%2FTUNER&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="phono" code="PutZone_InputFunction%2PHONO&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="cd" code="PutZone_InputFunction%2FCD&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="dvd" code="PutZone_InputFunction%2FDVD&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="bd" code="PutZone_InputFunction%2FBD&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="tv" code="PutZone_InputFunction%2FTV&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="sat_cable" code="PutZone_InputFunction%2FSAT%2FCBL&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="game" code="PutZone_InputFunction%2FGAME&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="dock" code="PutZone_InputFunction%2FDOCK&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="dvr" code="PutZone_InputFunction%2FDVR&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="v_aux" code="PutZone_InputFunction%2FV.AUX&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>
    <key id="net_usb" code="PutZone_InputFunction%2FNET%2FUSB&amp;cmd1=aspMainZone_WebUpdateStatus%2F"/>

//Zone 1
MainZone/index.put.asp?cmd0=PutSystem_OnStandby%2FSTANDBY&cmd1=aspMainZone_WebUpdateStatus%2F // Standby
MainZone/index.put.asp?cmd0=PutSystem_OnStandby%2FON&cmd1=aspMainZone_WebUpdateStatus%2F // On
MainZone/index.put.asp?cmd0=PutZone_OnOff%2FON&cmd1=aspMainZone_WebUpdateStatus%2F // Mainzone powerOn
MainZone/index.put.asp?cmd0=PutZone_OnOff%2FOFF&cmd1=aspMainZone_WebUpdateStatus%2F //Mainzone powerOff

MainZone/index.put.asp?cmd0=PutMasterVolumeBtn%2F%3E
MainZone/index.put.asp?cmd0=PutMasterVolumeBtn%2F%3C
MainZone/index.put.asp?cmd0=PutMasterVolumeSet%2F-30.0

MainZone/index.put.asp?cmd0=PutVolumeMute%2Fon&cmd1=aspMainZone_WebUpdateStatus%2F //Muteon
MainZone/index.put.asp?cmd0=PutVolumeMute%2Foff&cmd1=aspMainZone_WebUpdateStatus%2F //Muteoff

MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FBD&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FCD&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FDVD&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FSAT&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FMPLAY&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FGAME&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FTUNER&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FM-XPORT&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FNET%2FUSB&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FFAVORITES&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FINTERNET+RADIO&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FMEDIA+SERVER&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FUSB%2FIPOD&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FFLICKR&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FPANDORA&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FNAPSTER&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FRHAPSODY&cmd1=aspMainZone_WebUpdateStatus%2F

MainZone/index.put.asp?cmd0=PutNetAudioCommand%2FCurLeft&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutNetAudioCommand%2FCurRight&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutNetAudioCommand%2FCurUp&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutNetAudioCommand%2FCurDown&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=MAIN+ZONE

MainZone/index.put.asp?cmd0=PutSurroundMode%2FRIGHT
MainZone/index.put.asp?cmd0=PutSurroundMode%2FLEFT
MainZone/index.put.asp?cmd0=PutSurroundMode%2FDOLBY+DIGITAL&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutSurroundMode%2FDTS+SURROUND&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutSurroundMode%2FDIRECT&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutSurroundMode%2FPURE+DIRECT&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutSurroundMode%2FSTEREO&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutSurroundMode%2FMCH+STEREO&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutSurroundMode%2FVIRTUAL&cmd1=aspMainZone_WebUpdateStatus%2F
MainZone/index.put.asp?cmd0=PutSurroundMode%2FAUTO&cmd1=aspMainZone_WebUpdateStatus%2F

MainZone/index.put.asp?cmd0=PutTunerBand%2FFM&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutTunerBand%2FAM&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutTunerFrequencyBtn%2F%3C&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutTunerFrequencyBtn%2F%3E&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutTunerAuto%2FAUTO&ZoneName=MAIN+ZONE
MainZone/index.put.asp?cmd0=PutTunerAuto%2FMANUAL&ZoneName=MAIN+ZONE

goform/formMainZone_MainZoneXml.xml


//Zone 2
MainZone/index.put.asp?cmd0=PutZone_OnOff%2FON&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_OnOff%2FOFF&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2

MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FBD&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FCD&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FDVD&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FSAT&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FGAME&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FTUNER&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FM-XPORT&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FNET%2FUSB&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FFAVORITES&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FINTERNET+RADIO&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FMEDIA+SERVER&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FUSB%2FIPOD&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FFLICKR&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FPANDORA&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FNAPSTER&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FRHAPSODY&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2

MainZone/index.put.asp?cmd0=PutVolumeMute%2Fon&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutVolumeMute%2Foff&cmd1=aspMainZone_WebUpdateStatus%2F&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutMasterVolumeBtn%2F%3E&ZoneName=ZONE2
MainZone/index.put.asp?cmd0=PutMasterVolumeBtn%2F%3C&ZoneName=ZONE2

goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE2

//example
volume up:
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutMasterVolumeBtn/>

volume down:
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutMasterVolumeBtn/<

set volume at 35 (-45=35-80):
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutMasterVolumeSet/-45.0

volume mute:
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutVolumeMute/off
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutVolumeMute/on

Inputs:
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FSAT%2FCBL
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FMPLAY
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutZone_InputFunction%2FDVD

DRC:
http://192.168.0.120/SETUP/AUDIO/s_surrpara_1.asp?listDynamicComp=Mid

Power:
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutZone_OnOff%2FON
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutZone_OnOff%2FOFF
http://192.168.0.120/MainZone/index.put.asp?cmd0=PutSystem_OnStandby%2FSTANDBY


http://192.168.1.102/MainZone/index.put.asp?cmd0=PutZone_OnOff%2FON&cmd1=PutZone_InputFunction%2FCD&cmd2=PutMasterVolumeSet/-25.0


//IP 192.168.55.14

get the /goform/formMainZone_MainZoneXml.xml and in the "Xpath Expression:" field just write:

MasterVolume +80


<item>
<Power>
<value>STANDBY</value>
</Power>
<ZonePower>
<value>OFF</value>
</ZonePower>
<InputFuncList>
<value>SOURCE</value>
<value>TUNER</value>
<value>PHONO</value>
<value>CD</value>
<value>BD</value>
<value>DVD</value>
<value>TV</value>
<value>SAT/CBL</value>
<value>GAME</value>
<value>DOCK</value>
<value>DVR</value>
<value>V.AUX</value>
<value>NET/USB</value>
<value>SIRIUS</value>
<value>HDRADIO</value>
</InputFuncList>
<RenameSource>
<value/>
<value>TUNER</value>
<value>PHONO</value>
<value>CD</value>
<value>Plex</value>
<value>DVD</value>
<value>TV</value>
<value>Dreambox</value>
<value>GAME</value>
<value>DOCK</value>
<value>Sonos</value>
<value>V.AUX</value>
<value>NET/USB</value>
<value/>
<value/>
</RenameSource>
<RenameZone>
<value>MAIN ZONE</value>
</RenameZone>
<SourceDelete>
<value>DEL</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>USE</value>
<value>DEL</value>
<value>DEL</value>
</SourceDelete>
<TopMenuLink>
<value>OFF</value>
</TopMenuLink>
<ModelId>
<value>2</value>
</ModelId>
<SalesArea>
<value>1</value>
</SalesArea>
<InputFuncSelect>
<value>SAT/CBL</value>
</InputFuncSelect>
<NetFuncSelect>
<value>NET/USB</value>
</NetFuncSelect>
<InputFuncSelectMain>
<value>SAT/CBL</value>
</InputFuncSelectMain>
<VolumeDisplay>
<value>Relative</value>
</VolumeDisplay>
<MasterVolume>
<value>-42.5</value>
</MasterVolume>
<Mute>
<value>off</value>
</Mute>
<RemoteMaintenance>
<value>OFF</value>
</RemoteMaintenance>
<GameSourceDisplay>
<value>TRUE</value>
</GameSourceDisplay>
<LastfmDisplay>
<value>TRUE</value>
</LastfmDisplay>
<SubwooferDisplay>
<value>FALSE</value>
</SubwooferDisplay>
<Zone2VolDisp>
<value>TRUE</value>
</Zone2VolDisp>
</item>



?>