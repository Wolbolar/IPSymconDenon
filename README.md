# IPSymconDenonAVR

Modul für IP-Symcon ab Version 4. Ermöglicht die Kommunikation mit einem Denon AV Receiver.
Beta Test

## Dokumentation

**Inhaltsverzeichnis**

1. [Funktionsumfang](#1-funktionsumfang)  
2. [Voraussetzungen](#2-voraussetzungen)  
3. [Installation](#3-installation)  
4. [Funktionsreferenz](#4-funktionsreferenz)
5. [Konfiguration](#5-konfiguartion)  
6. [Anhang](#6-anhang)  

## 1. Funktionsumfang

Mit dem Modul lassen sich Befehle an einen Denon Receiver absenden und die Statusrückmeldung in IP-Symcon (ab Version 4) empfangen. Es gibt zwei unterschiedliche Module die benutzt werden können.
Ein Modul nutzt als Kommunikation Port 23 über das Denon AVR Control Protocol. Das zweite Modul nutzt zur Kommunikation HTTP.
Der Denon AVR kann jeweils nur einen einzige Verbindung auf Port 23 aufbauen. Daher kann, wenn dieses Modul benutzt wird, kein weiterer Client mehr den Denon AVR auf diese Weise über Port 23 steuern.
Der Vorteil ist jedoch, dass sämtliche dokumentierte Befehle an den Denon AVR geschickt und auch eine Rückmeldung in IP-Symcon dafür empfangen werden kann. Die zweite Möglichkeit ist das Denon HTTP Modul zu benutzten.
Abhängig vom Baujahr des Receivers sind aber nicht für alle Befehle auch eine Rückmeldung verfügbar. Auch mit dem HTTP Modul können aber alle dokumentierten Befehle an den Receiver geschickt werden. Es können auch mehrere Clients über HTTP
Befehle an den Denon Receiver verschicken und Rückmeldung erhalten.

### Befehle an den Denon AVR senden:  

 - Alle dokumentierten Befehle können an den Denon AVR gesendet werden  

### Status Rückmeldung:  

 - Bei dem Modul (Telnet Port 23) sind für die dokumentierten Befehle auch eine Statusrückmeldung verfügbar. Es kann nur ein Client auf Port 23 verbunden sein. 
 - Zur Zeit sind nicht für alle Receivertypen alle Befehle hinterlegt, diese werden nach und nach bei Bedarf ergänzt.
 - Bei dem Modul (HTTP) sind abhänig vom Receivertyp und Baujahr eine unterschiedliche Anzahl an Statusrückmeldungen verfügbar. Es können mehrere Clients dem Denon über HTTP Befehle senden und Status erhalten.    
  

## 2. Voraussetzungen

 - IPS 4.x
 - Denon AVR mit Netzwerkanschluss. Fernsteuerung des Denon AVR muss aktiviert sein (siehe Handbuch Denon AVR). IP-Symcon muss im gleichen Netzwerk wie der Denon AVR sein.

## 3. Installation

### a. Laden des Moduls

   Über das 'Modul Control' in IP-Symcon (Ver. 4.x) folgende URL hinzufügen:
	
    `https://github.com/Wolbolar/IPSymconDenon`  

### b. Einrichtung in IPS

	In IP-Symcon das gewünschte Device Denon AV Receiver HTTP Control oder Denon AV Receiver Telnet Control anlegen. Sollte noch kein Denon I/O und Denon Splitter angelegt worden sein, wird dies automatisch mit angelegt.
	Bei dem entsprechenden Denon Splitter ist die IP Adresse des Denon AVR einzutragen. Bei dem Denon Device sind die gewünschten Befehle auszuwählen die angezeigt werden sollen. Pro genutzter Zone muss jeweils eine neue Instanz
	in IP-Symcon angelegt werden. Das Konfigurationsformular sieht technisch durch IPS bedingt immer gleich aus. Es sind dann entsprechend der Auswahl unter AVR Zone nur die entsprechnden Haken zu setzten, die der jeweiligen korrespondierenden Zone entsprechen.
	Eine Auswahl von Befehlen die nur in der Mainzone verfügbar sind bleibt also z.B. bei anlegen der Instanz und Auswahl AVR Zone 2 unberücksichtigt.
	Beim HTTP Modul wird der Status automatisch in regelmäßig alle 30 Sekunden aktualisiert. Wenn ein Befehl über das Denon HTTP Modul versendet wird aktualisiert sich der Status unmittelbar nach dem Absetzten des Befehls.
	Beim Telnet Modul erfolgt ein Update des Status für die entsprechnde Variable immer dann wenn ein Request angefordert wurde oder ein Befehl gesendet wurde.
	Um nach dem ersten Einrichten beim Telnet Modul einen aktuellen Status zu erhalten steht in der Testumgebung des Konfigurationsformulars (ganz unten) ein Button  Status Initialisieren zu Verfügung.


## 4. Funktionsreferenz

### Denon Splitter Telnet:
	Die IP Adresse des Denon AVR ist einzutragen der Port bleibt auf 23 bei Telnet eingestellt. Bei Öffnen ist ein Haken zu setzten.
	
### Denon Splitter  HTTP
 Die IP Adresse des Denon AVR ist einzutragen und bei Öffnen ist ein Haken zu setzten.
 
### Denon AV Receiver Telnet Control
 AVR Zone auswählen und die Befehle die zur Verfügung stehen sollen auswählen. Wenn nur die Zone ausgewählt wird ohne eine zusätzliche Auswahl wird automatisch Power, Mainzonepower, Mute Volume und Input Source angelegt.
 Alle weiteren Befehle können einzeln bei Bedarf hinzugefügt oder auch wieder abgewählt werden.
 
### Denon AV Receiver HTTP Control
 AVR Zone auswählen und die Befehle die zur Verfügung stehen sollen. Wenn nur die Zone ausgewählt wird ohne eine zusätzliche Auswahl wird automatisch Power, Mainzonepower, Mute Volume und Input Source angelegt.
 Alle weiteren Befehle können einzeln bei Bedarf hinzugefügt oder auch wieder abgewählt werden.


## 5. Konfiguration:

### Denon Splitter Telnet:

| Eigenschaft | Typ     | Standardwert | Funktion                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Open        | boolean | true         | Verbindung zum Denon AVR  aktiv / deaktiv |
| Host        | string  |              | IP Adresse des Denon AVR                  |
| Port        | integer |              | Kommunikationsport 23 (nicht ändern)      |

### Denon Splitter HTTP:

| Eigenschaft | Typ     | Standardwert | Funktion                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Open        | boolean | true         | Verbindung zum Denon AVR  aktiv / deaktiv |
| Host        | string  |              | IP Adresse des Denon AVR                  |


### Denon AV Receiver Telnet Control:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| Type        | integer |              | Typ des Denon AVR                                                     |
| Zone        | integer |              | Zone des Denon AVR                                                    |
| Befehl      | boolean |              | aktivieren / deaktivieren um den jeweiligen Befehl zu nutzten         |

### Denon AV Receiver HTTP Control:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| Type        | integer |              | Typ des Denon AVR                                                     |
| Zone        | integer |              | Zone des Denon AVR                                                    |
| Befehl      | boolean |              | aktivieren / deaktivieren um den jeweiligen Befehl zu nutzten         |



## 6. Anhang

###  a. Funktionen:

#### Denon HTTP Modul:

`DAVRH_Power(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten 
Parameter $Value false (Off) / true (On)

`DAVRH_MainZonePower(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Mainzone
Parameter $Value false (Off) / true (On)

`DAVRH_MainMute(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten MainMute
Parameter $Value false (Off) / true (On)

#### Denon Telnet Modul:

`DAVRT_Power(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten 
Parameter $Value false (Off) / true (On)

`DAVRT_MainZonePower(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Mainzone
Parameter $Value false (Off) / true (On)

Modelle bei AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
`DAVRT_MainzoneAutoStandbySetting(integer $InstanceID, integer $Value)`
Mainzone Auto Standby Setting in Minuten (0 ist Off)
Parameter $Value  0 (Off) / 15 / 30 / 60 (Minuten)

Modelle bei AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
`DAVRT_MainzoneEcoModeSetting(integer $InstanceID, string $Value)`
Mainzone ECO Mode Setting
Parameter $Value  On / Auto / Off

`DAVRT_MasterVolume(integer $InstanceID, string $Value)`
Volume Mainzone hoch oder runter schalten
Parameter $Value UP / DOWN

`DAVRT_MasterVolumeFix(integer $InstanceID, float $Value)`
Volume Mainzone auf Wert setzten
Parameter $Value float -80 bis 18 Schrittweite 0.5

`DAVRT_MainMute(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten MainMute
Parameter $Value false (Off) / true (On)

`DAVRT_Input(integer $InstanceID, string $Value)`
Auswählen Input Mainzone
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD
zusätzliche Parameter Modelle bei AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
Parameter $Value MPLAY (Mediaplayer), NET (Online Music), BT (Bluetooth), USB (Select INPUT source USB and USB Start Playback), IPD	(Select INPUT source USB and iPod DIRECT Start Playback),
 IRP (Select INPUT source NET/USB and iRadio Recent Play), FVP (Select INPUT source NET/USB and Favorites Play)

`DAVRT_NSADisplay(integer $InstanceID)`
Update Display NSA

`DAVRT_NSEDisplay(integer $InstanceID)`
Update Display NSE

`DAVRT_DynamicVolume(integer $InstanceID, string $Value)`
Dynamic Volume schalten
Parameter $Value  Midnight / Evening / Day
 
`DAVRT_DolbyVolume(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Dolby Volume
Parameter $Value false (Off) / true (On)

`DAVRT_DolbyVolumeModeler(integer $InstanceID, string $Value)`
Dolby Volume Modeler
Parameter $Value Off / Half / Full

`DAVRT_DolbyVolumeLeveler(integer $InstanceID, string $Value)`
Dolby Volume Leveler
Parameter $Value Low / Middle / High

`DAVRT_DynamicCompressor(integer $InstanceID, string $Value)`
Dynamic Compressor
Parameter $Value Off / Low / Middle / High

`DAVRT_DynamicRangeCompression(integer $InstanceID, string $Value)`
Dynamic Range Compression
Parameter $Value Off / Auto / Low / Middle / High

`DAVRT_AudysseyDSX(integer $InstanceID, string $Value)`
Dynamic Range Compression
Parameter $Value Off / Wide (Audyssey DSX ON(Wide)) / Height (Audyssey DSX ON(Height)) / Height/Wide (Audyssey DSX ON(Height/Wide))

`DAVRT_CinemaEQ(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten CinemaEQ
Parameter $Value false (Off) / true (On)

`DAVRT_Panorama(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Panorama
Parameter $Value false (Off) / true (On)

`DAVRT_DynamicEQ(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Dynamic EQ
Parameter $Value false (Off) / true (On)

`DAVRT_ChannelVolumeFL(integer $InstanceID, float $Value)`
Channel Volume Front Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeFR(integer $InstanceID, float $Value)`
Channel Volume Front Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeC(integer $InstanceID, float $Value)`
Channel Volume Center
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSW(integer $InstanceID, float $Value)`
Channel Volume Subwoofer
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSW2(integer $InstanceID, float $Value)`
Channel Volume Subwoofer 2
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSL(integer $InstanceID, float $Value)`
Channel Volume Surround Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSR(integer $InstanceID, float $Value)`
Channel Volume Surround Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSBL(integer $InstanceID, float $Value)`
Channel Volume Surround Back Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSBR(integer $InstanceID, float $Value)`
Channel Volume Surround Back Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSB(integer $InstanceID, float $Value)`
Channel Volume Surround Back
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeFHL(integer $InstanceID, float $Value)`
Channel Volume Front Height Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeFHR(integer $InstanceID, float $Value)`
Channel Volume Front Height Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeFWL(integer $InstanceID, float $Value)`
Channel Volume Front Wide Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeFWR(integer $InstanceID, float $Value)`
Channel Volume Front Wide Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSHL(integer $InstanceID, float $Value)`
Channel Volume Surround Height Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSHR(integer $InstanceID, float $Value)`
Channel Volume Surround Height Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeTS(integer $InstanceID, float $Value)`
Channel Volume Top Surround
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeTFL(integer $InstanceID, float $Value)`
Channel Volume Top Front Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeTFR(integer $InstanceID, float $Value)`
Channel Volume Top Front Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeTML(integer $InstanceID, float $Value)`
Channel Volume Top Middle Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeTMR(integer $InstanceID, float $Value)`
Channel Volume Top Middle Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeTRL(integer $InstanceID, float $Value)`
Channel Volume Top Rear Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeTRR(integer $InstanceID, float $Value)`
Channel Volume Top Rear Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeRHL(integer $InstanceID, float $Value)`
Channel Volume Rear Height Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeRHR(integer $InstanceID, float $Value)`
Channel Volume Rear Height Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeFDL(integer $InstanceID, float $Value)`
Channel Volume Front Dolby Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeFDR(integer $InstanceID, float $Value)`
Channel Volume Front Dolby Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSDL(integer $InstanceID, float $Value)`
Channel Volume Surround Dolby Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeSDR(integer $InstanceID, float $Value)`
Channel Volume Surround Dolby Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeBDL(integer $InstanceID, float $Value)`
Channel Volume Back Dolby Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_ChannelVolumeBDR(integer $InstanceID, float $Value)`
Channel Volume Back Dolby Right
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_VideoSelect(integer $InstanceID, string $Value)`
Video Select 
Parameter $Value DVD , BD , TV , SAT/CBL , DVR ,GAME , AUX , DOCK , SOURCE, MPLAY

`DAVRT_Subwoofer(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Subwoofer
Parameter $Value false (Off) / true (On)

`DAVRT_SubwooferATT(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten SubwooferATT
Parameter $Value false (Off) / true (On)

`DAVRT_FrontHeight(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten FrontHeight
Parameter $Value false (Off) / true (On)

`DAVRT_ToneCTRL(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten ToneCTRL
Parameter $Value false (Off) / true (On)

`DAVRT_AudioDelay(integer $InstanceID, integer $Value)`
Audiodelay setzten
Parameter $Value 0 to 300

`DAVRT_SpeakerOutputFront(integer $InstanceID, string $Value)`
Speaker Output Front
Parameter $Value Off , Wide , Height , Height/Wide

`DAVRT_AutoFlagDetectMode(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Auto Flag Detect Mode
Parameter $Value false (Off) / true (On)

`DAVRT_ASP(integer $InstanceID, string $Value)`
ASP
Parameter $Value Normal / Full

`DAVRT_AudioRestorer(integer $InstanceID, string $Value)`
AudioRestorer
Parameter $Value Off / 64 / 96 / HQ

`DAVRT_CenterImage(integer $InstanceID, float $Value)`
Center Image
Parameter $Value 0.0 to 1.0 , Step 0.1

`DAVRT_CenterWidth(integer $InstanceID, float $Value)`
Center Width
Parameter $Value 0 to 7 , Step 0.5

`DAVRT_SelectDecodeMode(integer $InstanceID, string $Value)`
Select Decode Mode
Parameter $Value AUTO, HDMI, DIGITAL, ANALOG

`DAVRT_DigitalInputMode(integer $InstanceID, string $Value)`
Digital Input Mode
Parameter $Value Auto / PCM / DTS

`DAVRT_Dimension(integer $InstanceID, integer $Value)`
Dimension
Parameter $Value 0 to 6

`DAVRT_Effect(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Effect
Parameter $Value false (Off) / true (On)

`DAVRT_EffectLevel(integer $InstanceID, float $Value)`
Einschalten / Ausschalten Effect
Parameter $Value 1 to 15 , Step 0.5

`DAVRT_HDMIAudioOutput(integer $InstanceID, string $Value)`
HDMI Audio Output
Parameter $Value TV / AMP

`DAVRT_MultiEQMode(integer $InstanceID, string $Value)`
MultiEQMode
Parameter $Value Audyssey / BYP.LR / Flat / Manual / Off

`DAVRT_PLIIZHeightGain(integer $InstanceID, string $Value)`
PLIIZHeightGain
Parameter $Value Low / Middle / High

`DAVRT_RoomSize(integer $InstanceID, string $Value)`
Room Size
Parameter $Value Small , Small/Medium , Medium , Medium/Large , Large

`DAVRT_StageWidth(integer $InstanceID, float $Value)`
Stage Width
Parameter $Value -10 to +10 , Step 0.5

`DAVRT_StageHeight(integer $InstanceID, float $Value)`
Stage Height
Parameter $Value -10 to +10 , Step 0.5

`DAVRT_SurroundBackMode(integer $InstanceID, string $Value)`
Surround Back Mode
Parameter $Value Off / On / Matrix / Cinema / Music

`DAVRT_SurroundPlayMode(integer $InstanceID, string $Value)`
Surround Play Mode
Parameter $Value Music / Cinema / Game / Pro Logic

`DAVRT_VerticalStretch(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten Vertical Stretch
Parameter $Value false (Off) / true (On)

`DAVRT_Contrast(integer $InstanceID, float $Value)`
Contrast
Parameter $Value -6 to 6 , Step 0.5

`DAVRT_Brightness(integer $InstanceID, float $Value)`
Brightness
Parameter $Value 0 to 12 , Step 0.5

`DAVRT_ChromaLevel(integer $InstanceID, float $Value)`
ChromaLevel
Parameter $Value -6 to 6 , Step 0.5

`DAVRT_DigitalNoiseReduction(integer $InstanceID, string $Value)`
Digital Noise Reduction
Parameter $Value Off / Low / Middle / High

`DAVRT_Enhancer(integer $InstanceID, float $Value)`
Enhancer
Parameter $Value 0 to 12 , Step 0.5

`DAVRT_HDMIMonitor(integer $InstanceID, string $Value)`
HDMIMonitor
Parameter $Value Auto / Monitor 1 / Monitor 2 

`DAVRT_Hue(integer $InstanceID, float $Value)`
Hue
Parameter $Value -6 to 6 , Step 0.5

`DAVRT_Resolution(integer $InstanceID, string $Value)`
Resolution
Parameter $Value 480p/576p , 1080i , 720p , 1080p , 1080p:24Hz , Auto , 4K , 4K(60/50)

`DAVRT_ResolutionHDMI(integer $InstanceID, string $Value)`
Resolution HDMI
Parameter $Value 480p/576p , 1080i , 720p , 1080p , 1080p:24Hz , Auto , 4K , 4K(60/50)

`DAVRT_VideoProcessingMode(integer $InstanceID, string $Value)`
Video Processing Mode
Parameter $Value Auto / Monitor 1 / Monitor 2 

`DAVRT_GUIMenu(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten GUI Menü
Parameter $Value false (Ausblenden) / true (Einblenden)

`DAVRT_GUISourceSelectMenu(integer $InstanceID, boolean $Value)`
Einschalten / Ausschalten GUI Source Select Menü
Parameter $Value false (Ausblenden) / true (Einblenden)

`DAVRT_CursorUp(integer $InstanceID)`
Cursor Up

`DAVRT_CursorDown(integer $InstanceID)`
Cursor Up 

`DAVRT_CursorLeft(integer $InstanceID)`
Cursor Up 

`DAVRT_CursorRight(integer $InstanceID)`
Cursor Up  

`DAVRT_Enter(integer $InstanceID)`
Enter

`DAVRT_CursorReturn(integer $InstanceID)`
Cursor Return

`DAVRT_BassLevel(integer $InstanceID, float $Value)`
Bass Level
Parameter $Value -6 to 6 , Step 0.5

`DAVRT_LFELevel(integer $InstanceID, float $Value)`
LFE Level
Parameter $Value 0 to -10, Step 0.5

`DAVRT_TrebleLevel(integer $InstanceID, float $Value)`
LFE Level
Parameter $Value -6 to 6 , Step 0.5

`DAVRT_Sleep(integer $InstanceID, integer $Value)`
Sleep
Parameter $Value 0 ist aus bis 120, Step 10
	
`DAVRT_NACursorUp(integer $InstanceID)`
Network Audio Navigation Cursor Up	

`DAVRT_NACursorDown(integer $InstanceID)`
Network Audio Navigation Cursor Down	

`DAVRT_NACursorLeft(integer $InstanceID)`
Network Audio Navigation Cursor Left

`DAVRT_NACursorRight(integer $InstanceID)`
Network Audio Navigation Cursor Right

`DAVRT_NAEnter(integer $InstanceID)`
Network Audio Navigation Cursor Enter

`DAVRT_NAPlay(integer $InstanceID)`
Network Audio Navigation Play

`DAVRT_NAPause(integer $InstanceID)`
Network Audio Navigation Pause

`DAVRT_NAStop(integer $InstanceID)`
Network Audio Navigation Stop

`DAVRT_NASkipPlus(integer $InstanceID)`
Network Audio Navigation Skip +	

`DAVRT_NASkipMinus(integer $InstanceID)`
Network Audio Navigation Skip -				
	
`DAVRT_NARepeatOne(integer $InstanceID)`
Network Audio Navigation Repeat One	
	
`DAVRT_NARepeatAll(integer $InstanceID)`
Network Audio Navigation Repeat All	

`DAVRT_NARepeatOff(integer $InstanceID)`
Network Audio Navigation Repeat Off

`DAVRT_NARandomOn(integer $InstanceID)`
Network Audio Navigation Random On		

`DAVRT_NARandomOff(integer $InstanceID)`
Network Audio Navigation Random Off		

`DAVRT_NAPageNext(integer $InstanceID)`
Network Audio Navigation Page Next		

`DAVRT_NAPagePrevious(integer $InstanceID)`
Network Audio Navigation Page Previous	
	

Zone 2

`DAVRT_Z2_Volume(integer $InstanceID, string $Value)`
Zone 2 Volume höher / niederiger stellen
Parameter $Value UP / DOWN

`DAVRT_Z2_VolumeFix(integer $InstanceID, float $Value)`
Zone 2 Volume auf Wert setzten
Parameter $Value float -80 bis 18 Schrittweite 0.5

`DAVRT_Zone2Power(integer $InstanceID, boolean $Value)`
Zone 2 Power
Parameter $Value false (Off) / true (On)
	
`DAVRT_Zone2Mute(integer $InstanceID, boolean $Value)`
Zone 2 Mute
Parameter $Value false (Off) / true (On)	

`DAVRT_Zone2InputSource(integer $InstanceID, string $Value)`
Auswählen Input Zone 2
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD
zusätzliche Parameter Modelle bei AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
Parameter $Value MPLAY (Mediaplayer), NET (Online Music), BT (Bluetooth), USB (Select INPUT source USB and USB Start Playback), IPD	(Select INPUT source USB and iPod DIRECT Start Playback),
 IRP (Select INPUT source NET/USB and iRadio Recent Play), FVP (Select INPUT source NET/USB and Favorites Play)
	
`DAVRT_Zone2ChannelVolumeFL(integer $InstanceID, float $Value)`
Channel Volume Zone 2 Front Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_Zone2ChannelVolumeFR(integer $InstanceID, float $Value)`
Channel Volume Zone 2 Front Right
Parameter Range float $Value -12 to 12, Step 0.5	
	
`DAVRT_Zone2ChannelSetting(integer $InstanceID, string $Value)`
Zone2 Channel Setting
Parameter $Value Stereo / Mono	

Zone 3

`DAVRT_Z3_Volume(integer $InstanceID, string $Value)`
Zone 3 Volume höher / niederiger stellen
Parameter $Value UP / DOWN

`DAVRT_Z3_VolumeFix(integer $InstanceID, float $Value)`
Zone 3 Volume auf Wert setzten
Parameter $Value float -80 bis 18 Schrittweite 0.5

`DAVRT_Zone3Power(integer $InstanceID, boolean $Value)`
Zone 3 Power
Parameter $Value false (Off) / true (On)
	
`DAVRT_Zone3Mute(integer $InstanceID, boolean $Value)`
Zone 3 Mute
Parameter $Value false (Off) / true (On)	

`DAVRT_Zone3InputSource(integer $InstanceID, string $Value)`
Auswählen Input Zone 3
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD
zusätzliche Parameter Modelle bei AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
Parameter $Value MPLAY (Mediaplayer), NET (Online Music), BT (Bluetooth), USB (Select INPUT source USB and USB Start Playback), IPD	(Select INPUT source USB and iPod DIRECT Start Playback),
 IRP (Select INPUT source NET/USB and iRadio Recent Play), FVP (Select INPUT source NET/USB and Favorites Play)
	
`DAVRT_Zone3ChannelVolumeFL(integer $InstanceID, float $Value)`
Channel Volume Zone 3 Front Left
Parameter Range float $Value -12 to 12, Step 0.5

`DAVRT_Zone3ChannelVolumeFR(integer $InstanceID, float $Value)`
Channel Volume Zone 3 Front Right
Parameter Range float $Value -12 to 12, Step 0.5	
	
`DAVRT_Zone3ChannelSetting(integer $InstanceID, string $Value)`
Zone3 Channel Setting
Parameter $Value Stereo / Mono	
	

###  b. GUIDs und Datenaustausch:

#### Denon AV Receiver Telnet Control:

GUID: `{DC733830-533B-43CD-98F5-23FC2E61287F}` 


#### Denon AV Receiver HTTP Control:

GUID: `{5A53A01E-CED5-482F-A28D-331D80874B75}`

#### Denon Splitter Telnet:

GUID: `{9AE3087F-DC25-4ADB-AB46-AD7455E71032}`

#### Denon Splitter HTTP:

GUID: `{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}` 



