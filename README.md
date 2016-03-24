# IPSymconDenonAVR

Modul für IP-Symcon ab Version 4. Ermöglicht die Kommunikation mit einem Denon AV Receiver.
Noch nicht funktionsfähig, alpha Test

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
Abhänig nach dem alter des Receivers sind aber nicht für alle Befhle auch eine Rückmeldung verfügbar. Auch mit dem HTTP Modul können aber alle dokumentierten Befhle an den Receiver geschickt werden. Es können auch mehrere Clients über HTTP
Befehle an den Denon Receiver verschicken und Rückmeldung erhalten.

### Befehle an den Denon AVR senden:  

 - Alle dokumentiereten Befehle können an den Denon AVR gesendet werden  

### Status Rückmeldung:  

 - Bei dem Modul (Telnet Port 23) sind für alle Befhel auch eine Statusrückmledung verfügbar. Es kann nur ein Client auf Port 23 verbunden sein.  
 - Bei dem Modul (HTTP) sind abhänig vom Receivertyp und Baujahr eine unterschiedliche Anzhal an Statusrückmeldungen verfügbar. Es können mehrere Clients dem Denon über HTTP Befehle senden und Status erhalten.    
  

## 2. Voraussetzungen

 - IPS 4.x
 - Denon AVR mit Netzwerkanschluss. Fernsteuerung des Denon AVR muss aktiviert sein (siehe Handbuch Denon AVR). Ip-Symcon muss im gleichen Netzwerk wie der Denon AVR sein.

## 3. Installation

### a. Laden des Moduls

   Über das 'Modul Control' in IP-Symcon (Ver. 4.x) folgende URL hinzufügen:
	
    `git://github.com/Wolbolar/IPSymconDenon.git`  

### b. Einrichtung in IPS

	In IP-Symcon das gewünschte Device Denon AV Receiver HTTP Control oder Denon AV Receiver Telnet Control anlegen. Sollte noch kein Denon I/O und Denon Splitter angelegt worden sein, wird dies automatisch mit angelegt.
	Bei dem entsprechenden Denon Splitter ist die IP Adresse des Denon AVR einzutragen. Bei dem Denon Device sind die gewünschten Befehle auszuwählen die angezeigt werden sollen.


## 4. Funktionsreferenz

### Denon Splitter Telnet:
	Die IP Adresse des Denon AVR ist einzutragen der Port bleibt auf 23 bei Telnet eingestellt. Bei Öffnen ist ein Haken zu setzten.
	
### Denon Splitter  HTTP
 Die IP Adresse des Denon AVR ist einzutragen und bei Öffnen ist ein Haken zu setzten.
 
### Denon AV Receiver Telnet Control
 AVR Zone auswählen und die Befehle die zur Verfügung stehen sollen. Wenn nur die Zone ausgewählt wird ohne eine zusätzliche Auswahl wird automatisch Power, Mainzonepower, Mute Volume und Input Source angelegt.
 Alle weiteren Befehle können einzeln bei Bedarf hinzugefügt oder auch wieder abgewählt werden.
 
### Denon AV Receiver HTTP Control
 AVR Zone auswählen und die Befehle die zur Verfügung stehen sollen. Wenn nur die Zone ausgewählt wird ohne eine zusätzliche Auswahl wird automatisch Power, Mainzonepower, Mute Volume und Input Source angelegt.
 Alle weiteren Befehle können einzeln bei Bedarf hinzugefügt oder auch wieder abgewählt werden.


## 5. Konfiguration:

### Denon Splitter Telnet:

| Eigenschaft | Typ     | Standardwert | Funktion                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Open        | boolean | true         | Verbindung zum aioGateway aktiv / deaktiv |
| Host        | string  |              | IP Adresse des Denon AVR                  |
| Port        | integer |              | Kommunikationsport 23 (nicht ändern)      |

### Denon Splitter HTTP:

| Eigenschaft | Typ     | Standardwert | Funktion                                  |
| :---------: | :-----: | :----------: | :---------------------------------------: |
| Open        | boolean | true         | Verbindung zum aioGateway aktiv / deaktiv |
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

###  b. GUIDs und Datenaustausch:

#### Denon AV Receiver Telnet Control:

GUID: `{DC733830-533B-43CD-98F5-23FC2E61287F}` 


#### Denon AV Receiver HTTP Control:

GUID: `{5A53A01E-CED5-482F-A28D-331D80874B75}`

#### Denon Splitter Telnet:

GUID: `{9AE3087F-DC25-4ADB-AB46-AD7455E71032}`

#### Denon Splitter HTTP:

GUID: `{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}` 



