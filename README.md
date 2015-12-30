# IPSymconDenonAVR

Modul für IP-Symcon ab Version 4. Ermöglicht die Kommunikation mit einem Denon AV Receiver.
Noch nicht funktionsfähig, alpha Test

## Dokumentation

**Inhaltsverzeichnis**

1. [Funktionsumfang](#1-funktionsumfang)  
2. [Voraussetzungen](#2-voraussetzungen)  
3. [Installation](#3-installation)  
4. [Funktionsreferenz](#4-funktionsreferenz)  
5. [Anhang](#5-anhang)  

## 1. Funktionsumfang

Mit Hilfe des AIO Gateways sind Geräte bedienbar, die sonst über IR-Fernbedienungen oder mit Funk 433/868 MHz steuerbar sind.
Nähere Informationen zu ansteuerbaren Geräten über das AIO Gateway unter
http://www.mediola.com/recherche-tool-gesamt 

### IR Code Senden:  

 - Senden eines IR Signals über das AIO Gateway  

### Intertechno Steckdosen:  

 - Schalten von Intertechno Steckdosen über das AIO Gateway  
 - An / Aus.    

### FS20 Dimmer:  

 - Schalten von FS20 Dimmern über das AIO Gateway.  
 - Befehle: On, Off, Last, Toggle, Dimup, DimDown, 6,25%, 12,50%, 18,75%, 25,00%, 31,25%, 37,50%, 43,75%, 50,00%, 59,25%, 62,50%, 68,75%, 75,00%, 81,25%, 87,50%, 93,75%.

### FS20 Switch:  

 - Schalten von einem FS20 Switch über das AIO Gateway.  
 - Ein / Aus

### LED Controller:  

 - Schalten von einem LED Controller über das AIO Gateway.  
 - Befehle: 	power, up, down, play_pause, red, green, blue, white, orange, yellow, cyan, purple, auto, jump3, fade3, flash, jump7, fade7, speedUp, speedDown.
   

## 2. Voraussetzungen

 - IPS 4.x
 - AIO Gateway im gleichen Netzwerk wie IP-Symcon

## 3. Installation

### a. Laden des Moduls

   Über das 'Modul Control' in IP-Symcon (Ver. 4.x) folgende URL hinzufügen:
	
    `git://github.com/Wolbolar/IPSymconAIOGateway.git`  

### b. Einrichtung in IPS

	In IP-Symcon das gewünschte Device anlegen. Sollte noch kein AIO Gateway angelegt worden sein, wird dies automatisch mit angelegt.
	Bei dem entsprechenden Device sind jeweils die Werte die im AIO Creator NEO eingetragen sind zu übernehmen.


## 4. Funktionsreferenz

### aioGatewaySplitter:

### IR Codes
 Die IR Codes sind aus dem AIO Creator zu kopieren
 
### Intertechno
 Zum Ansteuern der Intertechno Steckdosen ist der Familycode und Devicecode einzutragen.
 
### ELRO
 Zum Ansteuern der ELRO Steckdosen ist der Familycode und Devicecode einzutragen. 

### FS20
 Zum Ansteuern von FS20 ist der HC1, HC2 Wert und die FS20 Adresse aus dem AIO Creator einzutragen. Aus den drei Werten wird ein Wert errechnet der an das AIO Gateway gesendet wird. 

## 5. Konfiguration:

### aioGatewaySplitter:

| Eigenschaft | Typ     | Standardwert | Funktion                           |
| :---------: | :-----: | :----------: | :--------------------------------: |
| Open        | boolean | true         | Verbindung zum aioGateway aktiv / deaktiv |
| Host        | string  |              | Adresse des aioGateway                    |


### FS20:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| HC1         | string  |              | HC1 Wert des FS20 Geräts abzulesen im Gerätemanager des AIO Creator   |
| HC2         | string  |              | HC1 Wert des FS20 Geräts abzulesen im Gerätemanager des AIO Creator   |
| FS20Adresse | string  |              | FS20Adresse des FS20 Geräts abzulesen im Gerätemanager des AIO Creator|

### Intertechno:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| FamilyCode  | string  |              | Familien Code des Geräts abzulesen im Gerätemanager des AIO Creator   |
| DeviceCode  | string  |              | Geräte Code des Geräts abzulesen im Gerätemanager des AIO Creator     |

### ELRO:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| FamilyCode  | string  |              | Familien Code des Geräts abzulesen im Gerätemanager des AIO Creator   |
| DeviceCode  | string  |              | Geräte Code des Geräts abzulesen im Gerätemanager des AIO Creator     |

### Lightmanager:  

| Eigenschaft | Typ     | Standardwert | Funktion                                                              |
| :---------: | :-----: | :----------: | :-------------------------------------------------------------------: |
| Adresse     | string  |              | Adresse des Geräts abzulesen im Gerätemanager des AIO Creator         |


## 6. Anhang

###  b. GUIDs und Datenaustausch:

#### AIOGatewaySplitter:

GUID: `{7E03C651-E5BF-4EC6-B1E8-397234992DB4}` 


#### AIOITDevice:

GUID: `{C45FF6B3-92E9-4930-B722-0A6193C7FFB5}

#### AIOFS20Device:

GUID: `{8C7554CA-2530-4E6B-98DB-AC59CD6215A6}

#### AIOELRODevice:

GUID: `{1B755DCC-7F12-4136-8D14-2ED86E6609B7}` 

#### AIOIRDevice:

GUID: `{4B0D8167-2932-4AD0-8455-26DC0C74485C}` 

#### Lightmanager:

GUID: `{488F8C6E-9448-44AD-8015-DF9DAD3232F3}` 


