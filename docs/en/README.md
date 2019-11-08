# IPSymconNanoleaf
[![Version](https://img.shields.io/badge/Symcon-PHPModule-red.svg)](https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/)
[![Version](https://img.shields.io/badge/Symcon%20Version-%3E%205.1-green.svg)](https://www.symcon.de/en/service/documentation/installation/)
![Code](https://img.shields.io/badge/Code-PHP-blue.svg)
[![StyleCI](https://github.styleci.io/repos/57190839/shield?branch=master)](https://github.styleci.io/repos/57190839)

Module for IP-Symcon version 4.1 or higher. Allows communication with a Denon AV Receiver or Marantz AV Receiver.

## Documentation

**Table of Contents**

1. [Features](#1-features)
2. [Requirements](#2-requirements)
3. [Installation](#3-installation)
4. [Function reference](#4-functionreference)
5. [Configuration](#5-configuration)
6. [Annex](#6-annex)

## 1. Features

The module can send commands to a Denon Receiver or Marantz Receier and receive the status feedback in IP-Symcon. There are two different modules that can be used.
One module uses Port 23 communication via the Denon AVR Control Protocol. The second module uses HTTP for communication.
The Denon AVR can only establish a single connection on port 23 at a time. Therefore, if this module is used, no further client can control the Denon AVR in this way via port 23.
The advantage, however, is that all documented commands can be sent to the Denon AVR and also receive feedback in IP-Symcon. The second option is to use the Denon HTTP module.
Depending on the year of manufacture of the receiver, feedback is not available for all commands. Even with the HTTP module, however, all documented commands can be sent to the receiver. It can also have multiple clients over HTTP
Send commands to the Denon receiver and receive feedback.

### Send commands to the Denon AVR:  

 - All documented commands can be sent to the Denon AVR 

### Status feedback:  

- For the module (Telnet Port 23), status feedback is also available for the documented commands. Only one client can be connected to port 23.
- At present, not all the receiver types have all the commands stored, these will be added gradually as needed.
- With the module (HTTP), depending on the receiver type and year of manufacture, a different number of status confirmations are available. Several clients can send Denon over HTTP commands and receive status.

### Denon models:  

AVR-3310, AVR-3311,  AVR-3312, AVR-3313, AVR-3808A, AVR-4310, AVR-4311, AVR-X1100W, AVR-X1200W,  AVR-X1300W, AVR-X1400H, AVR-X1500H, AVR-X2000,	AVR-X2100W,	AVR-X2200W,	AVR-X2300W,	AVR-X2400H,	AVR-X2500H, AVR-X3000, AVR-X3400H, AVR-X3500H, AVR-X4000, AVR-X4100W,
AVR-X4200W, AVR-X4300H, AVR-X4400H, AVR-X4500H, AVR-X5200W, AVR-X6200W, AVR-X6300H, AVR-X6400H, AVR-X6500H, AVR-X7200W, AVR-X7200WA, AVC-X8500H, DRA-N5, RCD-N8

### Marantz models: 

Marantz-NR1504,	Marantz-NR1506,	Marantz-NR1508,	Marantz-NR1602,	Marantz-NR1603,	Marantz-NR1604,	Marantz-NR1605,	Marantz-NR1606,	Marantz-NR1607,	Marantz-NR1608, Marantz-SR5006, Marantz-SR5007, Marantz-SR5008, Marantz-SR5009, Marantz-SR5010,
Marantz-SR5011, Marantz-SR5012,	Marantz-SR6005,	Marantz-SR6006,	Marantz-SR6007, Marantz-SR6008, Marantz-SR6009, Marantz-SR6010, Marantz-SR6011, Marantz-SR6012, Marantz-SR7005, Marantz-SR7007, Marantz-SR7008, Marantz-SR7009, Marantz-SR7010,
Marantz-SR7011, Marantz-SR7012, Marantz-AV7005, Marantz-AV7701, Marantz-AV7702, Marantz-AV7702 mk II, Marantz-AV7703, Marantz-AV7704, Marantz-AV8801, Marantz-AV8802 

## 2. Requirements

 - IPS 4.1
 - Denon AVR or Marantz AVR with network connection. Remote control of the Denon AVR or Marantz AVR must be activated (see AVR manual). IP Symcon must be in the same network as the AVR.

## 3. Installation

### a. Loading the module

Open the IP Console's web console with _http://<IP-Symcon IP>:3777/console/_.

Then click on the module store (IP-Symcon > 5.1) icon in the upper right corner.

![Store](img/store_icon.png?raw=true "open store")

In the search field type

```
Denon & Marantz
```  


![Store](img/module_store_search_en.png?raw=true "module search")

Then select the module and click _Install_

![Store](img/install_en.png?raw=true "install")


#### Install alternative via Modules instance

_Open_ the object tree.

![Objektbaum](img/object_tree.png?raw=true "object tree")	

Open the instance _'Modules'_ below core instances in the object tree of IP-Symcon (>= Ver 5.x) with a double-click and press the _Plus_ button.

![Modules](img/modules.png?raw=true "modules")	

![Plus](img/plus.png?raw=true "Plus")	

![ModulURL](img/add_module.png?raw=true "Add Module")
 
Enter the following URL in the field and confirm with _OK_:


```	
https://github.com/Wolbolar/IPSymconDenon
```
    
and confirm with _OK_.    
    
Then an entry for the module appears in the list of the instance _Modules_

By default, the branch _master_ is loaded, which contains current changes and adjustments.
Only the _master_ branch is kept current.

![Master](img/master.png?raw=true "master") 

If an older version of IP-Symcon smaller than version 5.1 (min 4.3) is used, click on the gear on the right side of the list.
It opens another window,

![SelectBranch](img/select_branch_en.png?raw=true "select branch") 

here you can switch to another branch, for older versions smaller than 5.1 (min 4.3) select _Old-Version_ .

### b.  Setup in IP-Symcon

In IP-Symcon a separate instance will be created for each zone of the AV receiver we want to use. The Denon IO and Denon Splitter will
automatically created.
In IP-Symcon _add Instance_ (_rightclick -> add object -> instance_) under the category under which you want to add the Denon/Marantz AVR instance,
and select _Denon_.

![Modulauswahl](img/install1_en.png?raw=true "Modulauswahl")

With _**Denon**_ we find the instance and with Ok the instance is created.

You can choose between the Denon / Marantz AV Receiver HTTP Control and the Denon / Marantz AV Receiver Telnet Control in IP-Symcon. The Denon / Marantz AV Receiver Telnet Control has the much larger functionality and should be used if possible.
However, only one device at a time can be connected to the AV receiver in this way. If another device or remote is already using this connection, Denon / Marantz AV Receiver HTTP Control can also be used as an alternative.
For the corresponding Denon Splitter, the IP address of the Denon AVR must be entered.

For the Denon / Marantz device, first select the manufacturer and then confirm with _Apply Changes_.

![Herstellerauswahl](img/config1_en.png?raw=true "Herstellerauswahl")

Then select the AV receiver model and confirm again with _Apply Changes_.

![AVRAuswahl](img/config2_en.png?raw=true "AVR Auswahl")

Now select the zone you want to use and confirm with _Apply Changes_.

![ZoneAuswahl](img/config3_en.png?raw=true "Zone Auswahl")

Now, depending on the AV Receiver model and zone, select commands are displayed. The configuration form adapts depending on the selection of the model. The commands to be used in the web front can now be selected or deselected if necessary.
The HTTP module updates the status automatically every 10 seconds. When a command is sent via the Denon HTTP module, the status updates immediately after the command has been issued.

With the Telnet module, the status for the corresponding variable is updated whenever a request has been requested or a command has been sent.
In order to get a current status after first setting up the Telnet module, a button _Status initialize_ is available in the test environment of the configuration form (at the bottom).

## 4. Function reference

### Denon Splitter Telnet
The IP address of the Denon AVR must be entered. The port remains set to 23 for Telnet.
	
### Denon Splitter  HTTP
The IP address of the Denon AVR must be entered and a check mark will be placed when opened.
 
### Denon AV Receiver Telnet Control
Select AVR Zone and select the commands that should be available. All commands can be individually added or deselected as needed.
 
### Denon AV Receiver HTTP Control
Select AVR Zone and select the commands that should be available. All other commands can be individually added or deselected as needed.

## 5. Configuration:

### Denon Splitter Telnet:

| Property    | Type    | Value        | Function                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Host        | string  |              | IP Adresss from Denon AVR                 |
| Port        | int     |              | Communication port 23 (do not change)     |

### Denon Splitter HTTP:

| Property    | Type    | Value        | Function                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Open        | bool    | true         | Connection to Denon AVR active / inactive |
| Host        | string  |              | IP address of the Denon AVR               |


### Denon AV Receiver Telnet Control:  

| Property    | Type    | Value        | Function                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| Type        | int     |              | Type of Denon AVR                                                     |
| Zone        | int     |              | Zone of the Denon AVR                                                 |
| command     | bool    |              | activate / deactivate to use the respective command                   |

### Denon AV Receiver HTTP Control:  

| Property    | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| Type        | int     |              | Type of Denon AVR                                                     |
| Zone        | int     |              | Zone of thenon AVR                                                    |
| command     | bool    |              | activate / deactivate to use the respective command                   |

## 6. Annex

###  a. Functions:

#### Denon HTTP Modul:

```php
DAVRH_Power(int $InstanceID, bool $Value)
```

Power on / Power Off 
Parameter $Value false (Off) / true (On)

```php
DAVRH_MainZonePower(int $InstanceID, bool $Value)
```

Main Zone Power On / Main Zone Power off
Parameter $Value false (Off) / true (On)

```php
DAVRH_MainMute(int $InstanceID, bool $Value)
```

MainMute on / off
Parameter $Value false (Off) / true (On)

#### Denon Telnet Modul:

```php
DAVRT_Power(int $InstanceID, bool $Value)
```

Power on / Power Off 
Parameter $Value false (Off) / true (On)

```php
DAVRT_MainZonePower(int $InstanceID, bool $Value)
```

Main Zone Power On / Main Zone Power off
Parameter $Value false (Off) / true (On)

```php
DAVRT_MainzoneAutoStandbySetting(int $InstanceID, int $Value)
```

Mainzone Auto Standby Setting in mMinutes (0 is Off)
Parameter $Value  0 (Off) / 15 / 30 / 60 (Minuten)

```php
DAVRT_MainzoneEcoModeSetting(int $InstanceID, string $Value)
```

Mainzone ECO Mode Setting
Parameter $Value  On / Auto / Off

```php
DAVRT_MasterVolume(int $InstanceID, string $Value)
```

Volume Mainzone up or down
Parameter $Value UP / DOWN

```php
DAVRT_MasterVolumeStep(int $InstanceID, string $Value, float $Step)
```

Volume Mainzone up or down with $Step , etc. increase volume 5
Parameter $Value UP / DOWN, $Step Schrittweite der Lautstärke Änderung Minimum 0.5

```php
DAVRT_MasterVolumeFix(int $InstanceID, float $Value)
```

set volume Mainzone
Parameter $Value float -80 bis 18 Schrittweite 0.5

```php
DAVRT_MainMute(int $InstanceID, bool $Value)
```

MainMute on / off
Parameter $Value false (Off) / true (On)

```php
DAVRT_Input(int $InstanceID, string $Value)
```

select Input Mainzone
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

set Dynamic Volume
Parameter $Value  Midnight / Evening / Day

```php
DAVRT_DolbyVolume(int $InstanceID, bool $Value)
``` 

Dolby Volume on /off
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

CinemaEQ on /off
Parameter $Value false (Off) / true (On)

```php
DAVRT_Panorama(int $InstanceID, bool $Value)
```

Panorama on / off
Parameter $Value false (Off) / true (On)

```php
DAVRT_DynamicEQ(int $InstanceID, bool $Value)
```

Dynamic EQ on / off
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

Subwoofer on / off
Parameter $Value false (Off) / true (On)

```php
DAVRT_SubwooferATT(int $InstanceID, bool $Value)
```

SubwooferATT on /off
Parameter $Value false (Off) / true (On)

```php
DAVRT_FrontHeight(int $InstanceID, bool $Value)
```

FrontHeight on /off
Parameter $Value false (Off) / true (On)

```php
DAVRT_ToneCTRL(int $InstanceID, bool $Value)
```

ToneCTRL on / off
Parameter $Value false (Off) / true (On)

```php
DAVRT_AudioDelay(int $InstanceID, int $Value)
```

set Audiodelay
Parameter $Value 0 to 300

```php
DAVRT_SpeakerOutputFront(int $InstanceID, string $Value)
```

Speaker Output Front
Parameter $Value Off , Wide , Height , Height/Wide

```php
DAVRT_AutoFlagDetectMode(int $InstanceID, bool $Value)
```

Auto Flag Detect Mode on / off
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

Effect on /off
Parameter $Value false (Off) / true (On)

```php
DAVRT_EffectLevel(int $InstanceID, float $Value)
```

Effect Level
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

Vertical Stretch on /off
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

GUI Menu on /off
Parameter $Value false (disable) / true (show)

```php
DAVRT_GUISourceSelectMenu(int $InstanceID, bool $Value)
```

GUI Source Select Menu on /off
Parameter $Value false (disable) / true (show)

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

Zone 2 Volume up / down
Parameter $Value UP / DOWN

```php
DAVRT_Z2_VolumeFix(int $InstanceID, float $Value)
```

set Zone 2 Volume to value
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

selcet Input Zone 2
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD
additional parameter with models AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVC-8500H, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
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

Zone 3 Volume up / down
Parameter $Value UP / DOWN

```php
DAVRT_Z3_VolumeFix(int $InstanceID, float $Value)
```

set Zone 3 Volume to value
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

select Input Zone 3
Parameter $Value PHONO, CD, TUNER, DVD, BD, TV, SAT/CBL, DVR, GAME, AUX, DOCK, IPOD, NET/USB, NAPSTER, LASTFM, FLICKR, FAVORITES, IRADIO, SERVER, USB/IPOD
additional parameter with models AVR-X7200W, AVR-X5200W, AVR-X4100W, AVR-X3100W, AVR-X2100W, S900W, AVR-7200WA, AVC-8500H, AVR-6200W, AVR-4200W, AVR-3200W, AVR-2200W, AVR-1200W
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

Generic sending of each command whose command is known
```php
DAVRT_SendCommand(int $InstanceID, string $Value)
```

Parameter $Value corresponds to the complete instruction according to Denon's documentation for the AVR model, e.g. PWON for Power On

###  b. GUIDs and data exchange:

#### Denon AV Receiver Telnet Control:

GUID: `{DC733830-533B-43CD-98F5-23FC2E61287F}` 


#### Denon AV Receiver HTTP Control:

GUID: `{5A53A01E-CED5-482F-A28D-331D80874B75}`

#### Denon Splitter Telnet:

GUID: `{9AE3087F-DC25-4ADB-AB46-AD7455E71032}`

#### Denon Splitter HTTP:

GUID: `{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}` 

