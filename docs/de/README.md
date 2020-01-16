# IPSymconDenonAVR
[![Version](https://img.shields.io/badge/Symcon-PHPModul-red.svg)](https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/)
[![Version](https://img.shields.io/badge/Symcon%20Version-%3E%205.1-green.svg)](https://www.symcon.de/service/dokumentation/installation/)
![Code](https://img.shields.io/badge/Code-PHP-blue.svg)
[![StyleCI](https://github.styleci.io/repos/57190839/shield?branch=master)](https://github.styleci.io/repos/57190839)

Modul für IP-Symcon ab Version 4.1. Ermöglicht die Kommunikation mit einem Denon AV Receiver oder Marantz AV Receiver.

## Dokumentation

**Inhaltsverzeichnis**

1. [Funktionsumfang](#1-funktionsumfang)  
2. [Voraussetzungen](#2-voraussetzungen)  
3. [Installation](#3-installation)  
4. [Funktionsreferenz](#4-funktionsreferenz)
5. [Konfiguration](#5-konfiguration)  
6. [Anhang](#6-anhang)  

## 1. Funktionsumfang

Mit dem Modul lassen sich Befehle an einen Denon Receiver oder Marantz Receier absenden und die Statusrückmeldung in IP-Symcon empfangen. Es gibt zwei unterschiedliche Module die benutzt werden können.
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

### Denon Modelle:  

AVR-3310, AVR-3311,  AVR-3312, AVR-3313, AVR-3808A, AVR-4310, AVR-4311, AVR-X1100W, AVR-X1200W,  AVR-X1300W, AVR-X1400H, AVR-X1500H, AVR-X1600H, AVR-X2000,	AVR-X2100W,	AVR-X2200W,	AVR-X2300W,	AVR-X2400H,	AVR-X2500H, AVR-X2600H, AVR-X3000, AVR-X3400H, AVR-X3500H, AVR-X4000, AVR-X4100W,
AVR-X4200W, AVR-X4300H, AVR-X4400H, AVR-X4500H, AVR-X5200W, AVR-X6200W, AVR-X6300H, AVR-X6400H, AVR-X6500H, AVR-X7200W, AVR-X7200WA, AVC-X8500H, DRA-N5, RCD-N8

### Marantz Modelle: 

Marantz-NR1504,	Marantz-NR1506,	Marantz-NR1508,	Marantz-NR1509,	Marantz-NR1602,	Marantz-NR1603,	Marantz-NR1604,	Marantz-NR1605,	Marantz-NR1606,	Marantz-NR1607,	Marantz-NR1608,Marantz-NR1609, Marantz-SR5006, Marantz-SR5007, Marantz-SR5008, Marantz-SR5009, Marantz-SR5010,
Marantz-SR5011, Marantz-SR5012, Marantz-SR5013,	Marantz-SR6005,	Marantz-SR6006,	Marantz-SR6007, Marantz-SR6008, Marantz-SR6009, Marantz-SR6010, Marantz-SR6011, Marantz-SR6012, Marantz-SR6013, Marantz-SR7005, Marantz-SR7007, Marantz-SR7008, Marantz-SR7009, Marantz-SR7010,
Marantz-SR7011, Marantz-SR7012,  Marantz-SR7013, Marantz-AV7005, Marantz-AV7701, Marantz-AV7702, Marantz-AV7702 mk II, Marantz-AV7703, Marantz-AV7704, Marantz-AV7705, Marantz-AV8801, Marantz-AV8802 
	  
## 2. Voraussetzungen

 - IPS 4.1
 - Denon AVR oder Marantz AVR mit Netzwerkanschluss. Fernsteuerung des Denon AVR oder Marantz AVR muss aktiviert sein (siehe Handbuch AVR). IP-Symcon muss im gleichen Netzwerk wie der AVR sein.

## 3. Installation

### a. Laden des Moduls

Die Webconsole von IP-Symcon mit _http://{IP-Symcon IP}:3777/console/_ öffnen. 


Anschließend oben rechts auf das Symbol für den Modulstore (IP-Symcon > 5.1) klicken

![Store](img/store_icon.png?raw=true "open store")

Im Suchfeld nun

```
Denon & Marantz
```  

eingeben

![Store](img/module_store_search.png?raw=true "module search")

und schließend das Modul auswählen und auf _Installieren_

![Store](img/install.png?raw=true "install")

drücken.


#### Alternatives Installieren über Modules Instanz

Den Objektbaum _Öffnen_.

![Objektbaum](img/objektbaum.png?raw=true "Objektbaum")	

Die Instanz _'Modules'_ unterhalb von Kerninstanzen im Objektbaum von IP-Symcon (>=Ver. 5.x) mit einem Doppelklick öffnen und das  _Plus_ Zeichen drücken.

![Modules](img/Modules.png?raw=true "Modules")	

![Plus](img/plus.png?raw=true "Plus")	

![ModulURL](img/add_module.png?raw=true "Add Module")
 
Im Feld die folgende URL eintragen und mit _OK_ bestätigen:

```
https://github.com/Wolbolar/IPSymconDenon
```  
	
Anschließend erscheint ein Eintrag für das Modul in der Liste der Instanz _Modules_    

Es wird im Standard der Zweig (Branch) _master_ geladen, dieser enthält aktuelle Änderungen und Anpassungen.
Nur der Zweig _master_ wird aktuell gehalten.

![Master](img/master.png?raw=true "master") 

Sollte eine ältere Version von IP-Symcon die kleiner ist als Version 5.1 (min 4.3) eingesetzt werden, ist auf das Zahnrad rechts in der Liste zu klicken.
Es öffnet sich ein weiteres Fenster,

![SelectBranch](img/select_branch.png?raw=true "select branch") 

hier kann man auf einen anderen Zweig wechseln, für ältere Versionen kleiner als 5.1 (min 4.3) ist hier
_Old-Version_ auszuwählen. 


### b. Einrichtung in IP-Symcon

In IP-Symcon wird für jede Zone des AV Receivers die wir nutzen wollen eine separate Instanz angelegt. Der Denon IO und Denon Splitter wird
automatisch mit angelegt. 	
In IP-Symcon nun _Instanz hinzufügen_ (_Rechtsklick -> Objekt hinzufügen -> Instanz_) auswählen unter der Kategorie, unter der man die Denon/Marantz AVR Instanz hinzufügen will,
und _Denon_ auswählen.

![Modulauswahl](img/install1.png?raw=true "Modulauswahl")

Über _**Denon**_ finden wir die Instanz und mit weiter und Ok wird diese angelegt.

Zur Auswahl stehen in IP-Symcon das Denon/Marantz AV Receiver HTTP Control und das Denon/Marantz AV Receiver Telnet Control. Die Denon/Marantz AV Receiver Telnet Control verfügt über den deutlich größeren Funktionsumfang und sollte nach Möglichkeit genutzt werden.
Es kann aber jeweils nur ein Gerät auf diese Weise mit dem AV Receiver verbunden sein. Sollte also bereits ein anderes Gerät oder Remote diese Verbindung nutzen kann auch alternativ Denon/Marantz AV Receiver HTTP Control genutzt werden. 
Bei dem entsprechenden Denon Splitter ist die IP Adresse des Denon AVR einzutragen.

Bei dem Denon/Marantz Device ist zunächst der Hersteller auszuwählen und dann mit _Übernehmen_ zu bestätigen.

![Herstellerauswahl](img/config1.png?raw=true "Herstellerauswahl")

Anschließend ist das AV Receiver Modell auszuwählen und wieder mit _Übernehmen_ zu bestätigen.

![AVRAuswahl](img/config2.png?raw=true "AVR Auswahl")

Jetzt noch die Zone selektieren, die benutzt werden soll, und mit _Übernehmen_ bestätigen.

![ZoneAuswahl](img/config3.png?raw=true "Zone Auswahl")

Jetzt wird abhängig von dem AV Receiver Modell und der Zone Befehle zum Selektieren angezeigt. Das Konfigurationsformular passt sich je nach Auswahl des Modells an. Die Befehle, die im Webfront genutzt werden sollen, können nun ausgewählt werden oder auch wieder bei Bedarf abgewählt werden.
Beim HTTP Modul wird der Status automatisch regelmäßig alle 10 Sekunden aktualisiert. Wenn ein Befehl über das Denon HTTP Modul versendet wird aktualisiert sich der Status unmittelbar nach dem Absetzten des Befehls.

Beim Telnet Modul erfolgt ein Update des Status für die entsprechende Variable immer dann wenn ein Request angefordert wurde oder ein Befehl gesendet wurde.
Um nach dem ersten Einrichten beim Telnet Modul einen aktuellen Status zu erhalten steht in der Testumgebung des Konfigurationsformulars (ganz unten) ein Button _Status initialisieren_ zur Verfügung.

## 4. Funktionsreferenz

### Denon Splitter Telnet
Die IP Adresse des Denon AVR ist einzutragen der Port bleibt auf 23 bei Telnet eingestellt.
	
### Denon Splitter  HTTP
Die IP Adresse des Denon AVR ist einzutragen und bei Öffnen ist ein Haken zu setzten.
 
### Denon AV Receiver Telnet Control
 AVR Zone auswählen und die Befehle, die zur Verfügung stehen sollen, auswählen. Alle Befehle können einzeln bei Bedarf hinzugefügt oder auch wieder abgewählt werden.
 
### Denon AV Receiver HTTP Control
 AVR Zone auswählen und die Befehle, die zur Verfügung stehen sollen, auswählen. Alle weiteren Befehle können einzeln bei Bedarf hinzugefügt oder auch wieder abgewählt werden.

## 5. Konfiguration:

### Denon Splitter Telnet:

| Eigenschaft | Typ     | Standardwert | Funktion                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Host        | string  |              | IP Adresse des Denon AVR                  |
| Port        | int     |              | Kommunikationsport 23 (nicht ändern)      |

### Denon Splitter HTTP:

| Eigenschaft | Typ     | Standardwert | Funktion                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Open        | bool    | true         | Verbindung zum Denon AVR  aktiv / deaktiv |
| Host        | string  |              | IP Adresse des Denon AVR                  |


### Denon AV Receiver Telnet Control:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| Type        | int     |              | Typ des Denon AVR                                                     |
| Zone        | int     |              | Zone des Denon AVR                                                    |
| Befehl      | bool    |              | aktivieren / deaktivieren um den jeweiligen Befehl zu nutzten         |

### Denon AV Receiver HTTP Control:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| Type        | int     |              | Typ des Denon AVR                                                     |
| Zone        | int     |              | Zone des Denon AVR                                                    |
| Befehl      | bool    |              | aktivieren / deaktivieren um den jeweiligen Befehl zu nutzten         |


## 6. Anhang

###  a. Funktionen:

#### Denon HTTP Modul:

```php
DAVRH_Power(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten 
Parameter $Value false (Off) / true (On)

```php
DAVRH_MainZonePower(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Mainzone
Parameter $Value false (Off) / true (On)

```php
DAVRH_MainMute(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten MainMute
Parameter $Value false (Off) / true (On)

#### Denon Telnet Modul:

```php
DAVRT_Power(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten 
Parameter $Value false (Off) / true (On)

```php
DAVRT_MainZonePower(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Mainzone
Parameter $Value false (Off) / true (On)

```php
DAVRT_MainzoneAutoStandbySetting(int $InstanceID, int $Value)
```

Mainzone Auto Standby Setting in Minuten (0 ist Off)
Parameter $Value  0 (Off) / 15 / 30 / 60 (Minuten)

```php
DAVRT_MainzoneEcoModeSetting(int $InstanceID, string $Value)
```

Mainzone ECO Mode Setting
Parameter $Value  On / Auto / Off

```php
DAVRT_MasterVolume(int $InstanceID, string $Value)
```

Volume Mainzone hoch oder runter schalten
Parameter $Value UP / DOWN

```php
DAVRT_MasterVolumeStep(int $InstanceID, string $Value, float $Step)
```

Volume Mainzone hoch oder runter um $Step schalten, z.B. Lautstärke um 5 erhöhen
Parameter $Value UP / DOWN, $Step Schrittweite der Lautstärke Änderung Minimum 0.5

```php
DAVRT_MasterVolumeFix(int $InstanceID, float $Value)
```

Volume Mainzone auf Wert setzten
Parameter $Value float -80 bis 18 Schrittweite 0.5

```php
DAVRT_MainMute(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten MainMute
Parameter $Value false (Off) / true (On)

```php
DAVRT_Input(int $InstanceID, string $Value)
```

Auswählen Input Mainzone
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD, MPLAY (Mediaplayer), NET (Online Music), BT (Bluetooth), USB (Select INPUT source USB and USB Start Playback), IPD	(Select INPUT source USB and iPod DIRECT Start Playback),
 IRP (Select INPUT source NET/USB and iRadio Recent Play), FVP (Select INPUT source NET/USB and Favorites Play)

```php
DAVRT_NSADisplay(int $InstanceID)
```

Update Display NSA

```php
DAVRT_NSEDisplay(int $InstanceID)
```

Update Display NSE

```php
DAVRT_DynamicVolume(int $InstanceID, string $Value)
```

Dynamic Volume schalten
Parameter $Value  Midnight / Evening / Day

```php
DAVRT_DolbyVolume(int $InstanceID, bool $Value)
``` 

Einschalten / Ausschalten Dolby Volume
Parameter $Value false (Off) / true (On)

```php
DAVRT_DolbyVolumeModeler(int $InstanceID, string $Value)
```

Dolby Volume Modeler
Parameter $Value Off / Half / Full

```php
DAVRT_DolbyVolumeLeveler(int $InstanceID, string $Value)
```

Dolby Volume Leveler
Parameter $Value Low / Middle / High

```php
DAVRT_DynamicCompressor(int $InstanceID, string $Value)
```

Dynamic Compressor
Parameter $Value Off / Low / Middle / High

```php
DAVRT_DynamicRangeCompression(int $InstanceID, string $Value)
```

Dynamic Range Compression
Parameter $Value Off / Auto / Low / Middle / High

```php
DAVRT_AudysseyDSX(int $InstanceID, string $Value)
```

Dynamic Range Compression
Parameter $Value Off / Wide (Audyssey DSX ON(Wide)) / Height (Audyssey DSX ON(Height)) / Height/Wide (Audyssey DSX ON(Height/Wide))

```php
DAVRT_CinemaEQ(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten CinemaEQ
Parameter $Value false (Off) / true (On)

```php
DAVRT_Panorama(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Panorama
Parameter $Value false (Off) / true (On)

```php
DAVRT_DynamicEQ(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Dynamic EQ
Parameter $Value false (Off) / true (On)

```php
DAVRT_ChannelVolumeFL(int $InstanceID, float $Value)
```

Channel Volume Front Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeFR(int $InstanceID, float $Value)
```

Channel Volume Front Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeC(int $InstanceID, float $Value)
```

Channel Volume Center
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSW(int $InstanceID, float $Value)
```

Channel Volume Subwoofer
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSW2(int $InstanceID, float $Value)
```

Channel Volume Subwoofer 2
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSL(int $InstanceID, float $Value)
```

Channel Volume Surround Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSR(int $InstanceID, float $Value)
```

Channel Volume Surround Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSBL(int $InstanceID, float $Value)
```

Channel Volume Surround Back Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSBR(int $InstanceID, float $Value)
```

Channel Volume Surround Back Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSB(int $InstanceID, float $Value)
```

Channel Volume Surround Back
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeFHL(int $InstanceID, float $Value)
```

Channel Volume Front Height Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeFHR(int $InstanceID, float $Value)
```

Channel Volume Front Height Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeFWL(int $InstanceID, float $Value)
```

Channel Volume Front Wide Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeFWR(int $InstanceID, float $Value)
```

Channel Volume Front Wide Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSHL(int $InstanceID, float $Value)
```

Channel Volume Surround Height Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSHR(int $InstanceID, float $Value)
```

Channel Volume Surround Height Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeTS(int $InstanceID, float $Value)
```

Channel Volume Top Surround
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeZRL(int $InstanceID, float $Value)
```

```php
DAVRT_ChannelVolumeTFL(int $InstanceID, float $Value)
```

Channel Volume Top Front Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeTFR(int $InstanceID, float $Value)
```

Channel Volume Top Front Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeTML(int $InstanceID, float $Value)
```

Channel Volume Top Middle Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeTMR(int $InstanceID, float $Value)
```

Channel Volume Top Middle Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeTRL(int $InstanceID, float $Value)
```

Channel Volume Top Rear Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeTRR(int $InstanceID, float $Value)
```

Channel Volume Top Rear Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeRHL(int $InstanceID, float $Value)
```

Channel Volume Rear Height Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeRHR(int $InstanceID, float $Value)
```

Channel Volume Rear Height Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeFDL(int $InstanceID, float $Value)
```

Channel Volume Front Dolby Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeFDR(int $InstanceID, float $Value)
```

Channel Volume Front Dolby Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSDL(int $InstanceID, float $Value)
```

Channel Volume Surround Dolby Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeSDR(int $InstanceID, float $Value)
```

Channel Volume Surround Dolby Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeBDL(int $InstanceID, float $Value)
```

Channel Volume Back Dolby Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_ChannelVolumeBDR(int $InstanceID, float $Value)
```

Channel Volume Back Dolby Right
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_VideoSelect(int $InstanceID, string $Value)
```

Video Select 
Parameter $Value DVD , BD , TV , SAT/CBL , DVR ,GAME , AUX , DOCK , SOURCE, MPLAY

```php
DAVRT_Subwoofer(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Subwoofer
Parameter $Value false (Off) / true (On)

```php
DAVRT_SubwooferATT(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten SubwooferATT
Parameter $Value false (Off) / true (On)

```php
DAVRT_FrontHeight(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten FrontHeight
Parameter $Value false (Off) / true (On)

```php
DAVRT_ToneCTRL(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten ToneCTRL
Parameter $Value false (Off) / true (On)

```php
DAVRT_AudioDelay(int $InstanceID, int $Value)
```

Audiodelay setzten
Parameter $Value 0 to 300

```php
DAVRT_SpeakerOutputFront(int $InstanceID, string $Value)
```

Speaker Output Front
Parameter $Value Off , Wide , Height , Height/Wide

```php
DAVRT_AutoFlagDetectMode(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Auto Flag Detect Mode
Parameter $Value false (Off) / true (On)

```php
DAVRT_ASP(int $InstanceID, string $Value)
```

ASP
Parameter $Value Normal / Full

```php
DAVRT_AudioRestorer(int $InstanceID, string $Value)
```

AudioRestorer
Parameter $Value Off / 64 / 96 / HQ

```php
DAVRT_CenterImage(int $InstanceID, float $Value)
```

Center Image
Parameter $Value 0.0 to 1.0 , Step 0.1

```php
DAVRT_CenterWidth(int $InstanceID, float $Value)
```


Center Width
Parameter $Value 0 to 7 , Step 0.5

```php
DAVRT_SelectDecodeMode(int $InstanceID, string $Value)
```

Select Decode Mode
Parameter $Value AUTO, HDMI, DIGITAL, ANALOG

```php
DAVRT_DigitalInputMode(int $InstanceID, string $Value)
```

Digital Input Mode
Parameter $Value Auto / PCM / DTS

```php
DAVRT_Dimension(int $InstanceID, int $Value)
```

Dimension
Parameter $Value 0 to 6

```php
DAVRT_Effect(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Effect
Parameter $Value false (Off) / true (On)

```php
DAVRT_EffectLevel(int $InstanceID, float $Value)
```

Einschalten / Ausschalten Effect
Parameter $Value 1 to 15 , Step 0.5

```php
DAVRT_HDMIAudioOutput(int $InstanceID, string $Value)
```

HDMI Audio Output
Parameter $Value TV / AMP

```php
DAVRT_MultiEQMode(int $InstanceID, string $Value)
```

MultiEQMode
Parameter $Value Audyssey / BYP.LR / Flat / Manual / Off

```php
DAVRT_PLIIZHeightGain(int $InstanceID, string $Value)
```

PLIIZHeightGain
Parameter $Value Low / Middle / High

```php
DAVRT_RoomSize(int $InstanceID, string $Value)
```

Room Size
Parameter $Value Small , Small/Medium , Medium , Medium/Large , Large

```php
DAVRT_StageWidth(int $InstanceID, float $Value)
```

Stage Width
Parameter $Value -10 to +10 , Step 0.5

```php
DAVRT_StageHeight(int $InstanceID, float $Value)
```

Stage Height
Parameter $Value -10 to +10 , Step 0.5

```php
DAVRT_SurroundBackMode(int $InstanceID, string $Value)
```

Surround Back Mode
Parameter $Value Off / On / Matrix / Cinema / Music

```php
DAVRT_SurroundPlayMode(int $InstanceID, string $Value)
```

Surround Play Mode
Parameter $Value Music / Cinema / Game / Pro Logic

```php
DAVRT_VerticalStretch(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten Vertical Stretch
Parameter $Value false (Off) / true (On)

```php
DAVRT_Contrast(int $InstanceID, float $Value)
```

Contrast
Parameter $Value -6 to 6 , Step 0.5

```php
DAVRT_Brightness(int $InstanceID, float $Value)
```

Brightness
Parameter $Value 0 to 12 , Step 0.5

```php
DAVRT_ChromaLevel(int $InstanceID, float $Value)
```

ChromaLevel
Parameter $Value -6 to 6 , Step 0.5

```php
DAVRT_DigitalNoiseReduction(int $InstanceID, string $Value)
```

Digital Noise Reduction
Parameter $Value Off / Low / Middle / High

```php
DAVRT_Enhancer(int $InstanceID, float $Value)
```

Enhancer
Parameter $Value 0 to 12 , Step 0.5

```php
DAVRT_HDMIMonitor(int $InstanceID, string $Value)
```

HDMIMonitor
Parameter $Value Auto / Monitor 1 / Monitor 2 

```php
DAVRT_Hue(int $InstanceID, float $Value)
```

Hue
Parameter $Value -6 to 6 , Step 0.5

```php
DAVRT_Resolution(int $InstanceID, string $Value)
```

Resolution
Parameter $Value 480p/576p , 1080i , 720p , 1080p , 1080p:24Hz , Auto , 4K , 4K(60/50)

```php
DAVRT_ResolutionHDMI(int $InstanceID, string $Value)
```

Resolution HDMI
Parameter $Value 480p/576p , 1080i , 720p , 1080p , 1080p:24Hz , Auto , 4K , 4K(60/50)

```php
DAVRT_VideoProcessingMode(int $InstanceID, string $Value)
```

Video Processing Mode
Parameter $Value Auto / Monitor 1 / Monitor 2 

```php
DAVRT_GUIMenu(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten GUI Menü
Parameter $Value false (Ausblenden) / true (Einblenden)

```php
DAVRT_GUISourceSelectMenu(int $InstanceID, bool $Value)
```

Einschalten / Ausschalten GUI Source Select Menü
Parameter $Value false (Ausblenden) / true (Einblenden)

```php
DAVRT_CursorUp(int $InstanceID)
```

Cursor Up

```php
DAVRT_CursorDown(int $InstanceID)
```

Cursor Down

```php
DAVRT_CursorLeft(int $InstanceID)
```

Cursor Left

```php
DAVRT_CursorRight(int $InstanceID)
```

Cursor Right  

```php
DAVRT_Enter(int $InstanceID)
```

Enter

```php
DAVRT_CursorReturn(int $InstanceID)
```

Cursor Return

```php
DAVRT_BassLevel(int $InstanceID, float $Value)
```

Bass Level
Parameter $Value -6 to 6 , Step 0.5

```php
DAVRT_LFELevel(int $InstanceID, float $Value)
```

LFE Level
Parameter $Value 0 to -10, Step 0.5

```php
DAVRT_TrebleLevel(int $InstanceID, float $Value)
```

LFE Level
Parameter $Value -6 to 6 , Step 0.5

```php
DAVRT_Sleep(int $InstanceID, int $Value)
```

Sleep
Parameter $Value 0 ist aus bis 120, Step 10

```php
DAVRT_NACursorUp(int $InstanceID)
```	

Network Audio Navigation Cursor Up	

```php
DAVRT_NACursorDown(int $InstanceID)
```

Network Audio Navigation Cursor Down	

```php
DAVRT_NACursorLeft(int $InstanceID)
```

Network Audio Navigation Cursor Left

```php
DAVRT_NACursorRight(int $InstanceID)
```

Network Audio Navigation Cursor Right

```php
DAVRT_NAEnter(int $InstanceID)
```

Network Audio Navigation Cursor Enter

```php
DAVRT_NAPlay(int $InstanceID)
```

Network Audio Navigation Play

```php
DAVRT_NAPause(int $InstanceID)
```

Network Audio Navigation Pause

```php
DAVRT_NAStop(int $InstanceID)
```

Network Audio Navigation Stop

```php
DAVRT_NASkipPlus(int $InstanceID)
```

Network Audio Navigation Skip +	

```php
DAVRT_NASkipMinus(int $InstanceID)
```

Network Audio Navigation Skip -				

```php
DAVRT_NARepeatOne(int $InstanceID)
```	

Network Audio Navigation Repeat One	

```php
DAVRT_NARepeatAll(int $InstanceID)
```	

Network Audio Navigation Repeat All	

```php
DAVRT_NARepeatOff(int $InstanceID)
```

Network Audio Navigation Repeat Off

```php
DAVRT_NARandomOn(int $InstanceID)
```

Network Audio Navigation Random On		

```php
DAVRT_NARandomOff(int $InstanceID)
```

Network Audio Navigation Random Off		

```php
DAVRT_NAPageNext(int $InstanceID)
```

Network Audio Navigation Page Next		

```php
DAVRT_NAPagePrevious(int $InstanceID)
```

Network Audio Navigation Page Previous	


Analog Tuner
```php
DAVRT_SelectTunerPresetAnalog(int $InstanceID, string $Value)
```

Select Tuner Preset
Parameter $Value A1 - G8 	

Zone 2

```php
DAVRT_Z2_Volume(int $InstanceID, string $Value)
```

Zone 2 Volume höher / niederiger stellen
Parameter $Value UP / DOWN

```php
DAVRT_Z2_VolumeFix(int $InstanceID, float $Value)
```

Zone 2 Volume auf Wert setzten
Parameter $Value float -80 bis 18 Schrittweite 0.5

```php
DAVRT_Zone2Power(int $InstanceID, bool $Value)
```

Zone 2 Power
Parameter $Value false (Off) / true (On)

```php
DAVRT_Zone2Mute(int $InstanceID, bool $Value)
```	

Zone 2 Mute
Parameter $Value false (Off) / true (On)	

```php
DAVRT_Zone2InputSource(int $InstanceID, string $Value)
```

Auswählen Input Zone 2
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD
zusätzliche Parameter Modelle bei AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVC-8500H, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
Parameter $Value MPLAY (Mediaplayer), NET (Online Music), BT (Bluetooth), USB (Select INPUT source USB and USB Start Playback), IPD	(Select INPUT source USB and iPod DIRECT Start Playback),
 IRP (Select INPUT source NET/USB and iRadio Recent Play), FVP (Select INPUT source NET/USB and Favorites Play)

```php
DAVRT_Zone2ChannelVolumeFL(int $InstanceID, float $Value)
``` 

Channel Volume Zone 2 Front Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_Zone2ChannelVolumeFR(int $InstanceID, float $Value)
```

Channel Volume Zone 2 Front Right
Parameter Range float $Value -12 to 12, Step 0.5	

```php
DAVRT_Zone2ChannelSetting(int $InstanceID, string $Value)
```	

Zone2 Channel Setting
Parameter $Value Stereo / Mono	

Zone 3

```php
DAVRT_Z3_Volume(int $InstanceID, string $Value)
```

Zone 3 Volume höher / niederiger stellen
Parameter $Value UP / DOWN

```php
DAVRT_Z3_VolumeFix(int $InstanceID, float $Value)
```

Zone 3 Volume auf Wert setzten
Parameter $Value float -80 bis 18 Schrittweite 0.5

```php
DAVRT_Zone3Power(int $InstanceID, bool $Value)
```

Zone 3 Power
Parameter $Value false (Off) / true (On)

```php
DAVRT_Zone3Mute(int $InstanceID, bool $Value)
```	

Zone 3 Mute
Parameter $Value false (Off) / true (On)	

```php
DAVRT_Zone3InputSource(int $InstanceID, string $Value)
```

Auswählen Input Zone 3
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD
zusätzliche Parameter Modelle bei AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVC-8500H, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
Parameter $Value MPLAY (Mediaplayer), NET (Online Music), BT (Bluetooth), USB (Select INPUT source USB and USB Start Playback), IPD	(Select INPUT source USB and iPod DIRECT Start Playback),
 IRP (Select INPUT source NET/USB and iRadio Recent Play), FVP (Select INPUT source NET/USB and Favorites Play)

```php
DAVRT_Zone3ChannelVolumeFL(int $InstanceID, float $Value)
``` 

Channel Volume Zone 3 Front Left
Parameter Range float $Value -12 to 12, Step 0.5

```php
DAVRT_Zone3ChannelVolumeFR(int $InstanceID, float $Value)
```

Channel Volume Zone 3 Front Right
Parameter Range float $Value -12 to 12, Step 0.5	

```php
DAVRT_Zone3ChannelSetting(int $InstanceID, string $Value)
```	

Zone3 Channel Setting
Parameter $Value Stereo / Mono

Allgemeines Senden von jedem Befehl dessen Command bekannt ist	
```php
DAVRT_SendCommand(int $InstanceID, string $Value)
```

Parameter $Value entspricht dem vollständigen Befehl entsprechend der Dokumentaion von Denon für das AVR Modell, z.B. PWON für Power On	


###  b. GUIDs und Datenaustausch:

#### Denon AV Receiver Telnet Control:

GUID: `{DC733830-533B-43CD-98F5-23FC2E61287F}` 


#### Denon AV Receiver HTTP Control:

GUID: `{5A53A01E-CED5-482F-A28D-331D80874B75}`

#### Denon Splitter Telnet:

GUID: `{9AE3087F-DC25-4ADB-AB46-AD7455E71032}`

#### Denon Splitter HTTP:

GUID: `{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}` 