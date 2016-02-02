<?

require_once(__DIR__ . "/../DenonClass.php");  // diverse Klassen

class DenonAVRHTTP extends IPSModule
{

   
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // 1. Verf�gbarer DenonSplitter wird verbunden oder neu erzeugt, wenn nicht vorhanden.
        $this->ConnectParent("{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}");
		
		$this->RegisterPropertyInteger("Type", 0);
		$this->RegisterPropertyInteger("Zone", 0);
		$this->RegisterPropertyBoolean("Display", false);
		$this->RegisterPropertyBoolean("Control", false);
						
    }


    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();
		
		$this->ValidateConfiguration();
		
	}
		
	/**
    * Die folgenden Funktionen stehen automatisch zur Verf�gung, wenn das Modul �ber die "Module Control" eingef�gt wurden.
    * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verf�gung gestellt:
    *
    */
	private function ValidateConfiguration()
	{			
		//Type und Zone
		$Type = $this->ReadPropertyInteger('Type');
		$Zone = $this->ReadPropertyInteger('Zone');
							
		//Import Kategorie
		//$ImportCategoryID = $this->ReadPropertyInteger('ImportCategoryID');
		
		//Optionen
		$Display = $this->ReadPropertyBoolean('Display');
		$Control = $this->ReadPropertyBoolean('Control');
		
		//IP Pr�fen
		$ip = $this->GetIPDenon();
		
		if (!filter_var($ip, FILTER_VALIDATE_IP) === false)
		{
			//Auswahl Pr�fen
			if ($Display === true)
				{
					//Display
					$this->SetupDisplay($Type);
				}
			if ($Control === true)
				{
					//Control
					$this->SetupControl($Type);
				}
			if ($Zone === 0)
				{
					//Mainzone
					$this->SetupZone($Type, $Zone);
				}
			elseif ($Zone === 1)
				{
					//Zone 2
					$this->SetupZone($Type, $Zone);
				}
			elseif ($Zone === 2)
				{
					//Zone 3
					$this->SetupZone($Type, $Zone);
				}
		}
		
		else
		{
			// Status inaktiv
			$this->SetStatus(202);
		}
		
		
	}
	
	protected function SetupDisplay($Type)
	{	
		$this->RegisterVariableString("Display", "Display", "~HTMLBox", 32);
		//Display bauen
		$this->EnableAction("Display");
		// Status aktiv
		//$this->SetStatus(102);
	}
	
	protected function SetupControl($Type)
	{	
		$this->RegisterVariableString("Control", "Control", "~HTMLBox", 32);
		//Control bauen
		$this->EnableAction("Control");
		// Status aktiv
		//$this->SetStatus(102);
	}
	
	protected function SetupZone($Type, $Zone)
	{	
		$this->SetupProfiles($Type, $Zone);
		$this->SetupVar($Type, $Zone);	
		
		
		// Status aktiv
		//$this->SetStatus(102);
	}

	
	// HTTP Profile
	
	//Zuordnung und Auswahl der anzulegenden Profile
	protected function ProfileSelektor($MainZoneXml)
	{
	$Type = $this->ReadPropertyInteger('Type');	
	foreach($MainZoneXml as $Profil)
		{
		$Name = $Profil["Name"];
		$Name = "DENON_".$Type.".".$Name;
		$Value =	$Profil["Value"];
		$Vartype =	$Profil["Vartype"];
		$Icon = $Profil["Icon"];
		$Prefix = $Profil["Prefix"];
		$Suffix = $Profil["Suffix"];
		$MinValue = $Profil["MinValue"];
		$MaxValue = $Profil["MaxValue"];
		$StepSize = $Profil["StepSize"];
		$Digits = $Profil["Digits"];

		if ($Vartype == 1)
			{
			//Einschr�nkung f�r anzulegende Profile
			if($Name == "inputs")
				{
				RegisterProfileIntegerDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits);	
				}		
			}
		elseif ($Vartype == 2)
			{
			//Einschr�nkung f�r anzulegende Profile
			if($Name == "MasterVolume")
				{
				RegisterProfileFloatDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize);
				}		
			}
		
		elseif ($vartype == 3)
			{
			//Einschr�nkung f�r anzulegende Profile
			if($Name == "" || $Name == "")
				{
				RegisterProfileStringDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize);
				}
			}
		
		}
	}
	
	protected function SetupProfiles($Type, $Zone)
	{
		
	if($Zone === 0) //Mainzone
		{
				
		$MainZoneXml = $this->getStates($Zone, "MainZoneXml");
		$this->ProfileSelektor($MainZoneXml);
		
				
		/*
		//InputSource
		$Name = "DENON".$Type.".InputSource";
		$this->RegisterProfileIntegerDenonAss($Name, $Icon, "", "", 0, 19, 1, 0, Array(
												Array(0, "Phono",  "", -1),
												Array(1, "CD",  "", -1),
												Array(2, "Tuner",  "", -1),
												Array(3, "DVD",  "", -1),
												Array(4, "BD",  "", -1),
												Array(5, "TV",  "", -1),
												Array(6, "SAT/CBL",  "", -1),
												Array(7, "DVR",  "", -1),
												Array(8, "GAME",  "", -1),
												Array(9, "V.AUX",  "", -1),
												Array(10, "DOCK",  "", -1),
												Array(11, "IPOD",  "", -1),
												Array(12, "NET/USB",  "", -1),
												Array(13, "NAPSTER",  "", -1),
												Array(14, "LASTFM",  "", -1),
												Array(15, "FLICKR",  "", -1),
												Array(16, "FAVORITES",  "", -1),
												Array(17, "IRADIO",  "", -1),
												Array(18, "SERVER",  "", -1),
												Array(19, "USB/IPOD",  "", -1)			
												));
		
		//SurroundMode
		$Name = "DENON".$Type.".SurroundMode";
		$this->RegisterProfileIntegerDenonAss($Name, $Icon, "", "", 0, 14, 1, 0, Array(
												Array(0, "DIRECT",  "", -1),
												Array(1, "PURE DIRECT",  "", -1),
												Array(2, "STEREO",  "", -1),
												Array(3, "STANDARD",  "", -1),
												Array(4, "DOLBY DIGITAL",  "", -1),
												Array(5, "DTS SURROUND",  "", -1),
												Array(6, "DOLBY PL2X C",  "", -1),
												Array(7, "MCH STEREO",  "", -1),
												Array(8, "ROCK ARENA",  "", -1),
												Array(9, "JAZZ CLUB",  "", -1),
												Array(10, "MONO MOVIE",  "", -1),
												Array(11, "MATRIX",  "", -1),
												Array(12, "VIDEO GAME",  "", -1),
												Array(13, "VIRTUAL",  "", -1),
												Array(14, "MULTI CH IN 7.1",  "", -1)
												));
		*/										
			
		}
	elseif($Zone === 1) //Zone 2
		{
		//Zone2Volume
		$Name = "DENON".$Type.".Zone2Volume";
		$this->RegisterProfileFloatDenon($Name, $Icon, "", "%", -80, 18, 1, 1);
		
		
		
		//Input und Namen auslesen von http://192.168.55.14/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE1
		
		//Player
		
		//Video
		
		//Network
		
		//Tuner
		
		//Cursor
		
		/*
		//Zone2InputSource
		$Name = "DENON".$Type.".Zone2InputSource";
		$this->RegisterProfileIntegerDenonAss($Name, $Icon, "", "", 0, 19, 1, 0, Array(
												Array(0, "Phono",  "", -1),
												Array(1, "CD",  "", -1),
												Array(2, "Tuner",  "", -1),
												Array(3, "DVD",  "", -1),
												Array(4, "BD",  "", -1),
												Array(5, "TV",  "", -1),
												Array(6, "SAT/CBL",  "", -1),
												Array(7, "DVR",  "", -1),
												Array(8, "GAME",  "", -1),
												Array(9, "V.AUX",  "", -1),
												Array(10, "DOCK",  "", -1),
												Array(11, "IPOD",  "", -1),
												Array(12, "NET/USB",  "", -1),
												Array(13, "NAPSTER",  "", -1),
												Array(14, "LASTFM",  "", -1),
												Array(15, "FLICKR",  "", -1),
												Array(16, "FAVORITES",  "", -1),
												Array(17, "IRADIO",  "", -1),
												Array(18, "SERVER",  "", -1),
												Array(19, "USB/IPOD",  "", -1)			
												));
		*/
				
		}
	elseif($Zone === 2) //Zone 3
		{
		//Zone3Volume
		$Name = "DENON".$Type.".Zone3Volume";
		$this->RegisterProfileFloatDenon($Name, $Icon, "", "%", -80, 18, 1, 1);
		
		//Input und Namen auslesen von http://192.168.55.14/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE2
		
		//Player
		
		//Video
		
		//Network
		
		//Tuner
		
		//Cursor
		
		/*
		//Zone3InputSource
		$Name = "DENON".$Type.".Zone3InputSource";
		$this->RegisterProfileIntegerDenonAss($Name, $Icon, "", "", 0, 19, 1, 0, Array(
												Array(0, "Phono",  "", -1),
												Array(1, "CD",  "", -1),
												Array(2, "Tuner",  "", -1),
												Array(3, "DVD",  "", -1),
												Array(4, "BD",  "", -1),
												Array(5, "TV",  "", -1),
												Array(6, "SAT/CBL",  "", -1),
												Array(7, "DVR",  "", -1),
												Array(8, "GAME",  "", -1),
												Array(9, "V.AUX",  "", -1),
												Array(10, "DOCK",  "", -1),
												Array(11, "IPOD",  "", -1),
												Array(12, "NET/USB",  "", -1),
												Array(13, "NAPSTER",  "", -1),
												Array(14, "LASTFM",  "", -1),
												Array(15, "FLICKR",  "", -1),
												Array(16, "FAVORITES",  "", -1),
												Array(17, "IRADIO",  "", -1),
												Array(18, "SERVER",  "", -1),
												Array(19, "USB/IPOD",  "", -1)			
												));
		*/
		}
		
	}
	
	// HTTP Vars
	protected function VarSelektor($MainZoneXml)
	{
	foreach($MainZoneXml as $Profil)
		{
		$Name = $Profil["Name"];
		$Name = "DENONMODULTEST.".$Name;
		$Value =	$Profil["Value"];
		$Vartype =	$Profil["Vartype"];
		$Icon = $Profil["Icon"];
		$Prefix = $Profil["Prefix"];
		$Suffix = $Profil["Suffix"];
		$MinValue = $Profil["MinValue"];
		$MaxValue = $Profil["MaxValue"];
		$StepSize = $Profil["StepSize"];
		$Digits = $Profil["Digits"];

		if ($Name == "Power")
			{
			//Power
			$PowerId = $this->RegisterVariableBoolean($Name, $Name, "~Switch", 1);
			$this->EnableAction($Name);
			}
		elseif ($Name == "MainZonePower")
			{
			//MainZonePower
			$MainZonePowerId = $this->RegisterVariableBoolean($Name, $Name, "~Switch", 2);
			$this->EnableAction($Name);
			}
		elseif ($Name == "MasterVolume")
			{
			//MasterVolume
			$MasterVolumeId = $this->RegisterVariableFloat($Name, $Name, "DENON_".$Type.".".$Name, 3);
			$this->EnableAction($Name);
			}
		elseif ($Name == "MainMute")
			{
			//MainMute
			$MainMuteId = $this->RegisterVariableBoolean($Name, $Name, "~Switch", 4);
			$this->EnableAction($Name);
			}	
		elseif ($Name == "Inputs")
			{
			//MainMute
			$MainMuteId = $this->RegisterVariableInteger($Name, $Name, "DENON_".$Type.".".$Name, 3);
			$this->EnableAction($Name);
			}
				
		}
	// Status aktiv
		$this->SetStatus(102);	
	}
	
	protected function SetupVar($Type, $Zone)
	{
		//$this->GetStateHTTP();
		$ProfileName = "DENON".$Type.".";
		
		if($Zone === 0) //Mainzone
		{
			$MainZoneXml = $this->getStates($Zone, "MainZoneXml");
			$this->VarSelektor($MainZoneXml); 
			//Power
			//$PowerId = $this->RegisterVariableBoolean("Power", "Power", "~Switch", 1);
			//$this->EnableAction("Power");
			
			//MainZonePower
			//$MainZonePowerId = $this->RegisterVariableBoolean("MainZonePower", "MainZonePower", "~Switch", 2);
			//$this->EnableAction("MainZonePower");
			
			//MainMute
			//$MainMuteId = $this->RegisterVariableBoolean("MainMute", "MainMute", "~Switch", 3);
			//$this->EnableAction("MainMute");
			
			
			
			//MasterVolume
			//$MasterVolumeId = $this->RegisterVariableFloat("MasterVolume", "MasterVolume", $ProfileName."MasterVolume", 10);
			//$this->EnableAction("MasterVolume");
			
			//Player
		
			//Video
			
			//Network
			
			//Tuner
			
			//Cursor
			
			//DigitalInputMode
			//$DigitalInputModeId = $this->RegisterVariableInteger("DigitalInputMode", "DigitalInputMode", $ProfileName."DigitalInputMode", 14);
			//$this->EnableAction("DigitalInputMode");
			
			//InputSource
			//$InputSourceId = $this->RegisterVariableInteger("InputSource", "InputSource", $ProfileName."InputSource", 15);
			//$this->EnableAction("InputSource");
			
			//SurroundMode
			//$SurroundModeId = $this->RegisterVariableInteger("SurroundMode", "SurroundMode", $ProfileName."SurroundMode", 16);
			//$this->EnableAction("SurroundMode");
			
			//InputMode
			//$InputModeId = $this->RegisterVariableInteger("InputMode", "InputMode", $ProfileName."InputMode", 22);
			//$this->EnableAction("InputMode");
			
		}
		elseif($Zone === 1) //Zone 2
		{
			//Zone2Power
			$Zone2PowerId = $this->RegisterVariableBoolean("Zone2Power", "Zone2Power", "~Switch", 1);
			$this->EnableAction("Zone2Power");

			//Zone2Mute
			$Zone2MuteId = $this->RegisterVariableBoolean("Zone2Mute", "Zone2Mute", "~Switch", 2);
			$this->EnableAction("Zone2Mute");

			//Zone2Volume
			$Zone2VolumeId = $this->RegisterVariableFloat("Zone2Volume", "Zone2Volume", $ProfileName."Zone2Volume", 3);
			$this->EnableAction("Zone2Volume");
			
			//Player
		
			//Video
			
			//Network
			
			//Tuner
			
			//Cursor
			
			//Zone2InputSource
			$Zone2InputSourceId = $this->RegisterVariableInteger("Zone2InputSource", "Zone2InputSource", $ProfileName."Zone2InputSource", 4);
			$this->EnableAction("Zone2InputSource");
			
		}
		elseif($Zone === 2) //Zone 3
		{
			//Zone3Power
			$Zone3PowerId = $this->RegisterVariableBoolean("Zone3Power", "Zone3Power", "~Switch", 1);
			$this->EnableAction("Zone3Power");

			//Zone3Mute	
			$Zone3MuteId = $this->RegisterVariableBoolean("Zone3Mute", "Zone3Mute", "~Switch", 2);
			$this->EnableAction("Zone3Mute");
			
			//Zone3Volume
			$Zone3VolumeId = $this->RegisterVariableFloat("Zone3Volume", "Zone3Volume", $ProfileName."Zone3Volume", 3);
			$this->EnableAction("Zone3Volume");
			
			//Player
		
			//Video
			
			//Network
			
			//Tuner
			
			//Cursor
			
			//Zone3InputSource
			$Zone3InputSourceId = $this->RegisterVariableInteger("Zone3InputSource", "Zone3InputSource", $ProfileName."Zone3InputSource", 4);
			$this->EnableAction("Zone3InputSource");
			
		}
	}
	
	public function getStates ($Zone, $Info)
	{
		if ($Zone == 0) //Main
		{
			if ($Info == "MainZoneXml")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXml.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$MainZoneXml = $this->MainZoneXml($xml);
					return $MainZoneXml;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht ge�ffnet werden.");
					}
						
			}
			elseif ($Info == "MainZoneXmlStatus")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXmlStatus.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$MainZoneXmlStatus = $this->MainZoneXmlStatus($xml);
					return $MainZoneXmlStatus;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht ge�ffnet werden.");
					}
						
			}
			elseif ($Info == "NetAudioStatusXml")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_NetAudioStatusXml.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$NetAudioStatusXml = $this->NetAudioStatusXml($xml);
					return $NetAudioStatusXml;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht ge�ffnet werden.");
					}
						
			}
			elseif ($Info == "Deviceinfo")
			{
				$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_Deviceinfo.xml"));
				
				if ($xml)
					{
					//echo "Datei wurde gefunden";
					$Deviceinfo = $this->Deviceinfo($xml);
					return $Deviceinfo;
					
					}
				else
					{
					exit("Datei ".$xml." konnte nicht ge�ffnet werden.");
					}
						
			}
		}
		elseif ($Zone == 1) // Zone 2
		{
			$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE2"));
		}
		elseif ($Zone == 2) // Zone 3
		{
			$xml = new SimpleXMLElement(file_get_contents("http://".$this->GetIPDenon()."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE3"));
		}
	}
	
	protected function MainZoneXml($xml)
	{
	$MainZoneXml = array();
	
		//FriendlyName
		$FriendlyName = $xml->xpath('.//FriendlyName');
		if ($FriendlyName)
		{
			$MainZone[3]["Name"] = "FriendlyName";
			$MainZone[3]["Value"] = (string)$FriendlyName[0]->value;
			$MainZone[3]["Vartype"] = 3; //Vartype String
			$MainZone[3]["MinValue"] = ""; //MinValue
			$MainZone[3]["MaxValue"] = ""; //Number
			$MainZone[3]["Icon"] = "Power"; //Icon
			$MainZone[3]["Prefix"] = ""; //Prefix
			$MainZone[3]["Suffix"] = ""; //Suffix
			$MainZone[3]["StepSize"] = ""; //Stepsize
			$MainZone[3]["Digits"] = ""; //Digits
		}

		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{
			$MainZone[0]["Name"] = "Power";
			$MainZone[0]["Value"] = (string)$AVRPower[0]->value;
			$MainZone[0]["Vartype"] = 0; //Vartype Bool
			$MainZone[0]["MinValue"] = ""; //MinValue
			$MainZone[0]["MaxValue"] = ""; //MaxValue
			$MainZone[0]["Icon"] = "Power"; //Icon
			$MainZone[0]["Prefix"] = ""; //Prefix
			$MainZone[0]["Suffix"] = ""; //Suffix
			$MainZone[0]["StepSize"] = ""; //Stepsize
			$MainZone[0]["Digits"] = ""; //Digits
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$MainZone[1]["Name"] = "MainZonePower";
			$MainZone[1]["Value"] = (string)$ZonePower[0]->value;
			$MainZone[1]["Vartype"] = 0; //Vartype Bool
			$MainZone[1]["MinValue"] = ""; //MinValue
			$MainZone[1]["MaxValue"] = ""; //Number
			$MainZone[1]["Icon"] = "Power"; //Icon
			$MainZone[1]["Prefix"] = ""; //Prefix
			$MainZone[1]["Suffix"] = ""; //Suffix
			$MainZone[1]["StepSize"] = ""; //Stepsize
			$MainZone[1]["Digits"] = ""; //Digits
		}

		//RenameZone
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$MainZone[3]["Name"] = "MainZone";
			$MainZone[3]["Value"] = (string)$RenameZone[0]->value;
			$MainZone[3]["Vartype"] = 3; //Vartype String
			$MainZone[3]["MinValue"] = ""; //MinValue
			$MainZone[3]["MaxValue"] = ""; //Number
			$MainZone[3]["Icon"] = "Power"; //Icon
			$MainZone[3]["Prefix"] = ""; //Prefix
			$MainZone[3]["Suffix"] = ""; //Suffix
			$MainZone[3]["StepSize"] = ""; //Stepsize
			$MainZone[3]["Digits"] = ""; //Digits
		}



		//TopMenuLink
		$TopMenuLink = $xml->xpath('.//TopMenuLink');
		if ($TopMenuLink)
		{
			$MainZone[4]["Name"] = "TopMenuLink";
			$MainZone[4]["Value"] = (string)$TopMenuLink[0]->value;
			$MainZone[4]["Vartype"] = 3; //Vartype String
			$MainZone[4]["MinValue"] = ""; //MinValue
			$MainZone[4]["MaxValue"] = ""; //Number
			$MainZone[4]["Icon"] = "Power"; //Icon
			$MainZone[4]["Prefix"] = ""; //Prefix
			$MainZone[4]["Suffix"] = ""; //Suffix
			$MainZone[4]["StepSize"] = ""; //Stepsize
			$MainZone[4]["Digits"] = ""; //Digits
		}


		//ModelId
		$ModelId = $xml->xpath('.//ModelId');
		if ($ModelId)
		{
			$MainZone[5]["Name"] = "ModelId";
			$MainZone[5]["Value"] = (string)$ModelId[0]->value;
			$MainZone[5]["Vartype"] = 3; //Vartype String
			$MainZone[5]["MinValue"] = ""; //MinValue
			$MainZone[5]["MaxValue"] = ""; //Number
			$MainZone[5]["Icon"] = "Power"; //Icon
			$MainZone[5]["Prefix"] = ""; //Prefix
			$MainZone[5]["Suffix"] = ""; //Suffix
			$MainZone[5]["StepSize"] = ""; //Stepsize
			$MainZone[5]["Digits"] = ""; //Digits
		}


		//SalesArea
		$SalesArea = $xml->xpath('.//SalesArea');
		if ($SalesArea)
		{
			$MainZone[6]["Name"] = "SalesArea";
			$MainZone[6]["Value"] = (string)$SalesArea[0]->value;
			$MainZone[6]["Vartype"] = 3; //Vartype String
			$MainZone[6]["MinValue"] = ""; //MinValue
			$MainZone[6]["MaxValue"] = ""; //Number
			$MainZone[6]["Icon"] = "Power"; //Icon
			$MainZone[6]["Prefix"] = ""; //Prefix
			$MainZone[6]["Suffix"] = ""; //Suffix
			$MainZone[6]["StepSize"] = ""; //Stepsize
			$MainZone[6]["Digits"] = ""; //Digits
		}


		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
		{
			$MainZone[7]["Name"] = "InputFuncSelect";
			$MainZone[7]["Value"] = (string)$InputFuncSelect[0]->value;
			$MainZone[7]["Vartype"] = 3; //Vartype String
			$MainZone[7]["MinValue"] = ""; //MinValue
			$MainZone[7]["MaxValue"] = ""; //Number
			$MainZone[7]["Icon"] = "Power"; //Icon
			$MainZone[7]["Prefix"] = ""; //Prefix
			$MainZone[7]["Suffix"] = ""; //Suffix
			$MainZone[7]["StepSize"] = ""; //Stepsize
			$MainZone[7]["Digits"] = ""; //Digits
		}


		//NetFuncSelect
		$NetFuncSelect = $xml->xpath('.//NetFuncSelect');
		if ($NetFuncSelect)
		{
			$MainZone[8]["Name"] = "NetFuncSelect";
			$MainZone[8]["Value"] = (string)$NetFuncSelect[0]->value;
			$MainZone[8]["Vartype"] = 3; //Vartype String
			$MainZone[8]["MinValue"] = ""; //MinValue
			$MainZone[8]["MaxValue"] = ""; //Number
			$MainZone[8]["Icon"] = "Power"; //Icon
			$MainZone[8]["Prefix"] = ""; //Prefix
			$MainZone[8]["Suffix"] = ""; //Suffix
			$MainZone[8]["StepSize"] = ""; //Stepsize
			$MainZone[8]["Digits"] = ""; //Digits
		}


		//InputFuncSelectMain
		$InputFuncSelectMain = $xml->xpath('.//InputFuncSelectMain');
		if ($InputFuncSelectMain)
		{
		   $MainZone[9]["Name"] = "InputFuncSelectMain";
			$MainZone[9]["Value"] = (string)$InputFuncSelectMain[0]->value;
			$MainZone[9]["Vartype"] = 3; //Vartype String
			$MainZone[9]["MinValue"] = ""; //MinValue
			$MainZone[9]["MaxValue"] = ""; //Number
			$MainZone[9]["Icon"] = "Power"; //Icon
			$MainZone[9]["Prefix"] = ""; //Prefix
			$MainZone[9]["Suffix"] = ""; //Suffix
			$MainZone[9]["StepSize"] = ""; //Stepsize
			$MainZone[9]["Digits"] = ""; //Digits
		}

		//selectSurround
		$selectSurround = $xml->xpath('.//selectSurround');
		if ($selectSurround)
		{
			$MainZone[10]["Name"] = "selectSurround";
			$MainZone[10]["Value"] = (string)$selectSurround[0]->value;
			$MainZone[10]["Vartype"] = 3; //Vartype String
			$MainZone[10]["MinValue"] = ""; //MinValue
			$MainZone[10]["MaxValue"] = ""; //Number
			$MainZone[10]["Icon"] = "Power"; //Icon
			$MainZone[10]["Prefix"] = ""; //Prefix
			$MainZone[10]["Suffix"] = ""; //Suffix
			$MainZone[10]["StepSize"] = ""; //Stepsize
			$MainZone[10]["Digits"] = ""; //Digits
		}

		//VolumeDisplay
		$VolumeDisplay = $xml->xpath('.//VolumeDisplay');
		if ($VolumeDisplay)
		{
			$MainZone[10]["Name"] = "VolumeDisplay";
			$MainZone[10]["Value"] = (string)$VolumeDisplay[0]->value;
			$MainZone[10]["Vartype"] = 3; //Vartype String
			$MainZone[10]["MinValue"] = ""; //MinValue
			$MainZone[10]["MaxValue"] = ""; //Number
			$MainZone[10]["Icon"] = "Power"; //Icon
			$MainZone[10]["Prefix"] = ""; //Prefix
			$MainZone[10]["Suffix"] = ""; //Suffix
			$MainZone[10]["StepSize"] = ""; //Stepsize
			$MainZone[10]["Digits"] = ""; //Digits
		}



		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$MainZone[11]["Name"] = "MasterVolume";
			$MainZone[11]["Value"] = (string)$MasterVolume[0]->value;
			$MainZone[11]["Vartype"] = 2; //Vartype Float
			$MainZone[11]["MinValue"] = -80.0; //MinValue
			$MainZone[11]["MaxValue"] = 18.0; //Number
			$MainZone[11]["Icon"] = "Power"; //Icon
			$MainZone[11]["Prefix"] = ""; //Prefix
			$MainZone[11]["Suffix"] = "%"; //Suffix
			$MainZone[11]["StepSize"] = 0.5; //Stepsize
			$MainZone[11]["Digits"] = 0; //Digits
		}


		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MainZone[12]["Name"] = "Mute";
			$MainZone[12]["Value"] = (string)$Mute[0]->value;
			$MainZone[12]["Vartype"] = 0; //Vartype Bool
			$MainZone[12]["MinValue"] = ""; //MinValue
			$MainZone[12]["MaxValue"] = ""; //Number
			$MainZone[12]["Icon"] = "Power"; //Icon
			$MainZone[12]["Prefix"] = ""; //Prefix
			$MainZone[12]["Suffix"] = ""; //Suffix
			$MainZone[12]["StepSize"] = ""; //Stepsize
			$MainZone[12]["Digits"] = ""; //Digits
		}


		//RemoteMaintenance
		$RemoteMaintenance = $xml->xpath('.//RemoteMaintenance');
		if ($RemoteMaintenance)
		{
			$MainZone[13]["Name"] = "RemoteMaintenance";
			$MainZone[13]["Value"] = (string)$RemoteMaintenance[0]->value;
			$MainZone[13]["Vartype"] = 3; //Vartype String
			$MainZone[13]["MinValue"] = ""; //MinValue
			$MainZone[13]["MaxValue"] = ""; //Number
			$MainZone[13]["Icon"] = "Power"; //Icon
			$MainZone[13]["Prefix"] = ""; //Prefix
			$MainZone[13]["Suffix"] = ""; //Suffix
			$MainZone[13]["StepSize"] = ""; //Stepsize
			$MainZone[13]["Digits"] = ""; //Digits
		}


		//GameSourceDisplay
		$GameSourceDisplay = $xml->xpath('.//GameSourceDisplay');
		if ($GameSourceDisplay)
		{
			$MainZone[14]["Name"] = "GameSourceDisplay";
			$MainZone[14]["Value"] = (string)$GameSourceDisplay[0]->value;
			$MainZone[14]["Vartype"] = 3; //Vartype String
			$MainZone[14]["MinValue"] = ""; //MinValue
			$MainZone[14]["MaxValue"] = ""; //Number
			$MainZone[14]["Icon"] = "Power"; //Icon
			$MainZone[14]["Prefix"] = ""; //Prefix
			$MainZone[14]["Suffix"] = ""; //Suffix
			$MainZone[14]["StepSize"] = ""; //Stepsize
			$MainZone[14]["Digits"] = ""; //Digits
		}


		//LastfmDisplay
		$LastfmDisplay = $xml->xpath('.//LastfmDisplay');
		if ($LastfmDisplay)
		{
			$MainZone[15]["Name"] = "LastfmDisplay";
			$MainZone[15]["Value"] = (string)$LastfmDisplay[0]->value;
			$MainZone[15]["Vartype"] = 3; //Vartype String
			$MainZone[15]["MinValue"] = ""; //MinValue
			$MainZone[15]["MaxValue"] = ""; //Number
			$MainZone[15]["Icon"] = "Power"; //Icon
			$MainZone[15]["Prefix"] = ""; //Prefix
			$MainZone[15]["Suffix"] = ""; //Suffix
			$MainZone[15]["StepSize"] = ""; //Stepsize
			$MainZone[15]["Digits"] = ""; //Digits
		}


		//SubwooferDisplay
		$SubwooferDisplay = $xml->xpath('.//SubwooferDisplay');
		if ($SubwooferDisplay)
		{
			$MainZone[16]["Name"] = "SubwooferDisplay";
			$MainZone[16]["Value"] = (string)$SubwooferDisplay[0]->value;
			$MainZone[16]["Vartype"] = 3; //Vartype String
			$MainZone[16]["MinValue"] = ""; //MinValue
			$MainZone[16]["MaxValue"] = ""; //Number
			$MainZone[16]["Icon"] = "Power"; //Icon
			$MainZone[16]["Prefix"] = ""; //Prefix
			$MainZone[16]["Suffix"] = ""; //Suffix
			$MainZone[16]["StepSize"] = ""; //Stepsize
			$MainZone[16]["Digits"] = ""; //Digits
		}


		//Zone2VolDisp
		$Zone2VolDisp = $xml->xpath('.//Zone2VolDisp');
		if ($Zone2VolDisp )
		{
			$MainZone[17]["Name"] = "Zone2VolDisp";
			$MainZone[17]["Value"] = (string)$Zone2VolDisp[0]->value;
			$MainZone[17]["Vartype"] = 3; //Vartype String
			$MainZone[17]["MinValue"] = ""; //MinValue
			$MainZone[17]["MaxValue"] = ""; //Number
			$MainZone[17]["Icon"] = "Power"; //Icon
			$MainZone[17]["Prefix"] = ""; //Prefix
			$MainZone[17]["Suffix"] = ""; //Suffix
			$MainZone[17]["StepSize"] = ""; //Stepsize
			$MainZone[17]["Digits"] = ""; //Digits
		}

	
	return $MainZoneXml;
	}
	
	protected function MainZoneXmlStatus($xml)
	{
		$MainZoneStatus = array();

		//RestorerMode
		$RestorerMode = $xml->xpath('.//RestorerMode');
		if ($RestorerMode)
		{
			$MainZoneStatus[0]["Name"] = "RestorerMode";
			$MainZoneStatus[0]["Value"] = (string)$RestorerMode[0]->value;
			$MainZoneStatus[0]["Vartype"] = 3; //Vartype String
			$MainZoneStatus[0]["MinValue"] = ""; //MinValue
			$MainZoneStatus[0]["MaxValue"] = ""; //Number
			$MainZoneStatus[0]["Icon"] = "Power"; //Icon
			$MainZoneStatus[0]["Prefix"] = ""; //Prefix
			$MainZoneStatus[0]["Suffix"] = ""; //Suffix
			$MainZoneStatus[0]["StepSize"] = ""; //Stepsize
			$MainZoneStatus[0]["Digits"] = ""; //Digits
		}


		//SurrMode
		$SurrMode = $xml->xpath('.//SurrMode');
		if ($SurrMode )
		{
			$MainZoneStatus[1]["Name"] = "SurrMode";
			$MainZoneStatus[1]["Value"] = (string)$SurrMode[0]->value;
			$MainZoneStatus[1]["Vartype"] = 3; //Vartype String
			$MainZoneStatus[1]["MinValue"] = ""; //MinValue
			$MainZoneStatus[1]["MaxValue"] = ""; //Number
			$MainZoneStatus[1]["Icon"] = "Power"; //Icon
			$MainZoneStatus[1]["Prefix"] = ""; //Prefix
			$MainZoneStatus[1]["Suffix"] = ""; //Suffix
			$MainZoneStatus[1]["StepSize"] = ""; //Stepsize
			$MainZoneStatus[1]["Digits"] = ""; //Digits
		}

		//Inputs
		$InputFuncList = $xml->xpath('.//InputFuncList');
		if ($InputFuncList)
		{
			$countinput = count($InputFuncList[0]->value);
			$RenameSource = $xml->xpath('.//RenameSource');
			$SourceDelete = $xml->xpath('.//SourceDelete');
			$SourceDeleteUse = $xml->xpath('.//SourceDelete/value[. ="USE"]');
			$countUse = count($SourceDeleteUse);
			$MainZoneStatus[2]["Name"] = "Inputs";
			$Inputs = array();

			for ($i = 0; $i <= $countinput-1; $i++)
				{
					if ((string)$SourceDelete[0]->value[$i] == "USE")
					{
						if ((string)$RenameSource[0]->value[$i] != "")
							{
							$Inputs[$i] = (string)$RenameSource[0]->value[$i];
							}
						else
							{
							$Inputs[$i] = (string)$InputFuncList[0]->value[$i];
						   }
					}
			   }
			$MainZoneStatus[2]["Value"] = $Inputs;
			$MainZoneStatus[2]["Vartype"] = 1; //Vartype Integer
			$MainZoneStatus[2]["MinValue"] = 0; //MinValue
			$MainZoneStatus[2]["MaxValue"] = $countUse; //Number
			$MainZoneStatus[2]["Icon"] = "Power"; //Icon
			$MainZoneStatus[2]["Prefix"] = ""; //Prefix
			$MainZoneStatus[2]["Suffix"] = ""; //Suffix
			$MainZoneStatus[2]["StepSize"] = 1; //Stepsize
			$MainZoneStatus[2]["Digits"] = 0; //Digits
		}

		return $MainZoneStatus;
	}
	
	protected function NetAudioStatusXml($xml)
	{
		$NetAudioStatus = array();

		//Modell
		$szLine = $xml->xpath('.//szLine');
		$NetAudioStatus[0]["Name"] = "Modell";
		$NetAudioStatus[0]["Value"] = (string)$szLine[0]->value;
		$NetAudioStatus[0]["Vartype"] = 3; //Vartype String
		$NetAudioStatus[0]["MinValue"] = ""; //MinValue
		$NetAudioStatus[0]["MaxValue"] = ""; //Number
		$NetAudioStatus[0]["Icon"] = "Power"; //Icon
		$NetAudioStatus[0]["Prefix"] = ""; //Prefix
		$NetAudioStatus[0]["Suffix"] = ""; //Suffix
		$NetAudioStatus[0]["StepSize"] = ""; //Stepsize
		$NetAudioStatus[0]["Digits"] = ""; //Digits

		return $NetAudioStatus;
	}
	
	protected function Deviceinfo($xml)
	{
		$Deviceinfo = array();

		//ModelName
		$ModelName = $xml->xpath('.//ModelName');
		//var_dump($ModelName);
		$Deviceinfo[0]["Name"] = "ModelName";
		$Deviceinfo[0]["Value"] = (string)$ModelName[0];
		$Deviceinfo[0]["Vartype"] = 3; //Vartype String
		$Deviceinfo[0]["MinValue"] = ""; //MinValue
		$Deviceinfo[0]["MaxValue"] = ""; //Number
		$Deviceinfo[0]["Icon"] = "Power"; //Icon
		$Deviceinfo[0]["Prefix"] = ""; //Prefix
		$Deviceinfo[0]["Suffix"] = ""; //Suffix
		$Deviceinfo[0]["StepSize"] = ""; //Stepsize
		$Deviceinfo[0]["Digits"] = ""; //Digits

		return $Deviceinfo;
	}
	
	
	public function RequestAction($Ident, $Value)
    {
        //Type und Zone
		$Type = $this->ReadPropertyInteger('Type');
		$Zone = $this->ReadPropertyInteger('Zone');
				
		//Optionen
		$Display = $this->ReadPropertyBoolean('Display');
		$Control = $this->ReadPropertyBoolean('Control');
		
		
		if($Zone === 0) //Mainzone
			{
			switch($Ident)
				{
				case "Power":
					$this->PowerHTTP($Value);
				break;

				case "DigitalInputMode":
					$this->DigitalInputModeHTTP($Value);
				break;

				case "InputSource":
					$this->InputSourceHTTP($Value);
				break;

				case "InputMode":
					$this->InputModeHTTP($Value);
				break;

				case "MainMute":
					$this->MainMuteHTTP($Value);
				break;

				case "MasterVolume":
					$this->MasterVolumeFixHTTP($Value);
				break;

				case "MainZonePower":
					$this->MainZonePowerHTTP($Value);
				break;
									
				default:
					throw new Exception("Invalid ident");
				}
			}
		elseif($Zone === 1) //Zone 2
			{
			switch($Ident)
				{
				case "Zone2Power":
					$this->Zone2PowerHTTP($Value);
				break;

				case "Zone2Volume":
					$this->Zone2VolumeFixHTTP($Value);
				break;

				case "Zone2Mute":
					$this->Zone2MuteHTTP($Value);
				break;

				case "Zone2InputSource":
					$this->Zone2InputSourceHTTP($Value);
				break;
						
				default:
					throw new Exception("Invalid ident");
				}
			}
		elseif($Zone === 2) //Zone 3
			{
			switch($Ident)
				{
				case "Zone3Power":
					$this->Zone3PowerHTTP($Value);
				break;

				case "Zone3Volume":
					$this->Zone3VolumeFixHTTP($Value);
				break;

				case "Zone3Mute":
					$this->Zone3MuteHTTP($Value);
				break;

				case "Zone3InputSource":
					$this->Zone3InputSourceHTTP($Value);
				break;
						
				default:
					throw new Exception("Invalid ident");
				}
			}
		
		
		#################### Cursorsteuerung #####################################
		switch($Ident)
			{
				case "CursorUp":
					$this->CursorUp();
				break;

				case "CursorDown":
					$this->CursorDown();
				break;

				case "CursorLeft":
					$this->CursorLeft();
				break;

				case "CursorRight":
					$this->CursorRight();
				break;

				case "Enter":
					$this->Enter();
				break;

				case "Return":
					$this->CursorReturn();
				break;
					
				default:
					throw new Exception("Invalid ident");
			}			
    }
	
	
	
	protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);//array
		return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;//ConnectionID
    }
	
		
	//IP Denon 
	protected function GetIPDenon(){
		$ParentID = $this->GetParent();
		$IPDenon = IPS_GetProperty($ParentID, 'Host');
		return $IPDenon;
	}
	
	//Get Status HTTP 
	protected function GetStateHTTP(){
		
		return $state;
	}
	
	protected function RegisterProfileIntegerDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize, $Digits)
	{
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 1);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 1)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
		IPS_SetVariableProfileDigits($Name, $Digits); //  Nachkommastellen
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	protected function RegisterProfileIntegerDenonAss($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Digits, $Associations)
	{
        if ( sizeof($Associations) === 0 ){
            $MinValue = 0;
            $MaxValue = 0;
        } else {
            $MinValue = $Associations[0][0];
            $MaxValue = $Associations[sizeof($Associations)-1][0];
        }
        
        $this->RegisterProfileIntegerDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $Stepsize, $Digits);
        
        foreach($Associations as $Association) {
            IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
        }
        
    }
	
	protected function RegisterProfileStringDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize)
	{
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 3);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 3)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	protected function RegisterProfileFloatDenon($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize)
	{
        
        if(!IPS_VariableProfileExists($Name)) {
            IPS_CreateVariableProfile($Name, 2);
        } else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 2)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
        
    }
	
	//Funktionsscript von Raketenschnecke
	
	//--------- DENON AVR 3311 Anbindung V0.95 18.06.11 15:08.53 by Raketenschnecke ---------

	############################ Info ##############################################
	/*
	Inital-Autor: philipp, Quelle: http://www.ip-symcon.de/forum/f53/denon-avr-3808-integration-7007/

	Funktionen:
		*Funktionssammlung aller implementierten DENON-Status und Befehle
	*/

	//$id clientsocket id
	// senden an Parent und weiterleitung an socket

	######################### Main Functions #######################################
	/*
	public function Power($Value) // STANDBY oder ON
	{
		if ($Value == false)
			{
				$Value = "STANDBY";
			}
		else
			{
				$Value = "ON";
			}
		
	 CSCK_SendText($id, "PW".$Value.chr(13));
	}
	*/
	
	public function PowerHTTP($Value) // STANDBY oder ON
	{
		if ($Value == false)
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutSystem_OnStandby%2FSTANDBY&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('Power'), $Value);
			}
		else
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutSystem_OnStandby%2FON&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('Power'), $Value);
			}
		
	}
	
	public function MainZonePowerHTTP($Value) // ON oder OFF
	{
		if ($Value == false)
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutZone_OnOff%2FOFF&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainZonePower'), $Value);
			}
		else
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutZone_OnOff%2FON&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainZonePower'), $Value);
			}
		
	}
	
	public function MasterVolume($Value) // "UP" or "DOWN"
	{
	 CSCK_SendText($id, "MV".$Value.chr(13));
	}
	
	public function MasterVolumeFix($Value) // Volume direct -80(db) bis 18(db)
	{
	 $Value= intval($Value) +80;
	 CSCK_SendText($id, "MV".$Value.chr(13));
	}
	
	public function MasterVolumeFixHTTP($Value) // Volume direct -80(db) bis 18(db)
	{
		file_get_contents("http://".$this->GetIPDenon()."MainZone/index.put.asp?cmd0=PutMasterVolumeSet%2F".$Value);
	}

	public function BassLevel($Value)
	{
		$Value = (intval($Value) +50);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSBAS ".$Value.chr(13));
	}

	public function LFELevel($Value)
	{
		$Value = (intval($Value) +10);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSLFE ".$Value.chr(13));
	}

	public function TrebleLevel($Value)
	{
		$Value = (intval($Value) +50);
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSTRE ".$Value.chr(13));
	}

	public function ChannelVolume($Value) // setzen Korrekturlevel pro LS-Kanal
	{
	 CSCK_SendText($id, "CV".$Value.chr(13));
	}

	public function MainMute($Value) // "ON" or "OFF"
	{
	 CSCK_SendText($id, "MU".$Value.chr(13));
	}
	
	public function MainMuteHTTP($Value) // "ON" or "OFF"
	{
		if ($Value == false)
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutVolumeMute%2Foff&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainMute'), $Value);
			}
		else
			{
				file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutVolumeMute%2Fon&cmd1=aspMainZone_WebUpdateStatus%2F");
				SetValueBoolean($this->GetIDForIdent('MainMute'), $Value);
			}
	}

	public function Input($Value) // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	{
	 CSCK_SendText($id, "SI".$Value.chr(13));
	}

	public function MainZonePower($Value) // MainZone "ON" or "OFF"
	{
	  CSCK_SendText($id, "ZM".$Value.chr(13));
	}

	public function RecSelect($Value) //
	{
	 CSCK_SendText($id, "SR".$Value.chr(13)); // NET/USB; USB; NAPSTER; LASTFM; FLICKR; FAVORITES; IRADIO; SERVER; SERVER;  USB/IPOD
	}

	public function SelectDecodeMode($Value) // AUTO; HDMI; DIGITAL; ANALOG
	{
	  CSCK_SendText($id, "SD".$Value.chr(13));
	}

	public function DecodeMode($Value) // Auto, PCM, DTS
	{
	 CSCK_SendText($id, "DC".$Value.chr(13));
	}

	public function VideoSelect($Value) // Video Select DVD/BD/TV/SAT_CBL/DVR/GAME/V.AUX/DOCK/SOURCE
	{
	 CSCK_SendText($id, "SV".$Value.chr(13));
	}

	public function SLEEP($Value) //
	{
		if ($Value == 0)
		{
			CSCK_SendText($id, "SLPOFF".chr(13));
		}
		ELSE
		{
		$Value = str_pad($Value, 3 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "SLP".$Value.chr(13));
		}
	}

	public function ModeSelect($Value) //
	{
	 CSCK_SendText($id, "MS".$Value.chr(13));
	}

	public function VideoSet($Value) //
	{
	 CSCK_SendText($id, "VS".$Value.chr(13));
	}

	public function ParaSettings($Value) // S
	{
	 CSCK_SendText($id, "PS".$Value.chr(13));
	}

	public function ParaVideo($Value) //
	{
	 CSCK_SendText($id, "PV".$Value.chr(13));
	}

	public function QuickSelect($Value) // 1-5
	{
	  CSCK_SendText($id, "MSQUICK".$Value.chr(13));
	}

	public function Preset($Value) //
	{
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "NSB".$Value.chr(13));
	}

	public function NSE_Request($id) // fragt NSE-Werte ab
	{
	  CSCK_SendText($id, "NSE".chr(13));
	}

	public function DynEQ($Value) // Dynamic Equilizer ON/OFF
	{
	  CSCK_SendText($id, "PSDYNEQ ".$Value.chr(13));
	}

	public function CinEQ($Value) // Cinema Equilizer ON/OFF
	{
	  CSCK_SendText($id, "PSCINEMA EQ.".$Value.chr(13));
	}
	public function MultiEQMode($Value) // MultiEquilizer AUDYSSEE/BYP.LR/FLAT/MANUELL/OFF
	{
	  CSCK_SendText($id, "PSMULTEQ:".$Value.chr(13));
	}

	public function DynVol($Value) // Dynamic Volume NGT(EVE/DAY
	{
	  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
	}

	public function AudioDelay($Value) // Audio Delay 0-200 ms
	{
		$Value = str_pad($Value, 3 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSDELAY ".$Value.chr(13));
	}

	public function Dimension($Value) // Audio Delay 0-200 ms
	{
		$Value = str_pad($Value, 2 ,"0", STR_PAD_LEFT);
		CSCK_SendText($id, "PSDIM ".$Value.chr(13));
	}

	public function InputSource($Value) // Input Source
	{
	  CSCK_SendText($id, "SI".$Value.chr(13));
	}

	public function DynamicCompressor($Value) // Dynamic Compressor OFF/LOW/MID/HIGH
	{
	  CSCK_SendText($id, "PSDCO ".$Value.chr(13));
	}

	public function ToneDefeat($Value) // Tone Defeat (AVR3809) ON/OFF
	{
	  CSCK_SendText($id, "PSTONE DEFEAT ".$Value.chr(13));
	}

	public function ToneCTRL($Value) // Tone Control (AVR 3311) ON/OFF
	{
	  CSCK_SendText($id, "PSTONE CTRL ".$Value.chr(13));
	}

	public function AudioRestorer($Value) // Audio Restorer OFF/MODE1/MODE2/MODE3
	{
		switch ($Value)
		{
		   case 0:
			  $Value = "OFF";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

			case 1:
			  $Value = "MODE1";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

			case 2:
			  $Value = "MODE2";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

			case 3:
			  $Value = "MODE2";
			  CSCK_SendText($id, "PSRSTR ".$Value.chr(13));
			break;

		}
	}

	public function DigitalInputMode($Value) // Digital Input Mode AUTO/PCM/DTS
	{
	  CSCK_SendText($id, "DC".$Value.chr(13));
	}

	public function InputMode($Value) // Input Mode AUTO/HDMI/DIGITALANALOG/ARC/NO
	{
	  CSCK_SendText($id, "SD".$Value.chr(13));
	}
	
	public function InputModeHTTP($Value) // Input Mode HTTP
	{
		switch ($Value)
		{
		   case 0:
			  //BD
			  file_get_contents("http://".$this->GetIPDenon()."/MainZone/index.put.asp?cmd0=PutVolumeMute%2Foff&cmd1=aspMainZone_WebUpdateStatus%2F");
			break;

			case 1:
			  
			break;

			case 2:
			  
			break;

			case 3:
			  
			break;

		}
	}

	public function DynamicRange($Value) // DynamicRange
	{
	  CSCK_SendText($id, "PSDRC ".$Value.chr(13));
	}

	public function DynamicEQ($Value)
	{
	  CSCK_SendText($id, "PSDYNEQ ".$Value.chr(13));
	}

	public function DynamicVolume($Value)
	{
		switch ($Value)
			{
			   case 0:
				  $Value = "OFF";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

				case 1:
				  $Value = "NGT";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

				case 2:
				  $Value = "EVE";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

				case 3:
				  $Value = "DAY";
				  CSCK_SendText($id, "PSDYNVOL ".$Value.chr(13));
				break;

			}
	}

	public function RoomSize($Value)
	{
		switch ($Value)
			{
			   case 0:
				  $Value = "N";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 1:
				  $Value = "S";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 2:
				  $Value = "MS";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 3:
				  $Value = "M";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 4:
				  $Value = "MS";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

				case 5:
				  $Value = "L";
				  CSCK_SendText($id, "PSRSZ ".$Value.chr(13));
				break;

			}
	}

	public function SurroundBackMode($Value)
	{
	  CSCK_SendText($id, "PSSB:".$Value.chr(13));
	}

	public function CWidth($Value)
	{
	  CSCK_SendText($id, "PSCEN ".$Value.chr(13));
	}

	public function SurroundMode($Value)
	{
	  CSCK_SendText($id, "MS".$Value.chr(13));
	}

	public function SurroundPlayMode($Value)
	{
	  CSCK_SendText($id, "PSMODE:".$Value.chr(13));
	}

	public function CinemaEQ($Value)
	{
	  CSCK_SendText($id, "PSCINEMA EQ.".$Value.chr(13));
	}

	public function Panorama($Value)
	{
	  CSCK_SendText($id, "PSPAN ".$Value.chr(13));
	}

	public function FrontHeight($Value)
	{
	  CSCK_SendText($id, "PSFH:".$Value.chr(13));
	}

	public function NSE_DisplayRequest()
	{
	  CSCK_SendText($id, "NSE".chr(13));
	}

	public function NSA_DisplayRequest()
	{
	  CSCK_SendText($id, "NSA".chr(13));
	}

	public function PresetRequest()
	{
	  CSCK_SendText($id, "NSH".chr(13));
	}

	public function ChannelVolumeFL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFL ".$Value.chr(13));
	}

	public function ChannelVolumeFR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFR ".$Value.chr(13));
	}

	public function ChannelVolumeC($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVC ".$Value.chr(13));
	}

	public function ChannelVolumeSW($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSW ".$Value.chr(13));
	}

	public function ChannelVolumeSL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSL ".$Value.chr(13));
	}

	public function ChannelVolumeSR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSR ".$Value.chr(13));
	}

	public function ChannelVolumeSBL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSBL ".$Value.chr(13));
	}

	public function ChannelVolumeSBR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSBR ".$Value.chr(13));
	}

	public function ChannelVolumeSB($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVSB ".$Value.chr(13));
	}

	public function ChannelVolumeFHL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFHL ".$Value.chr(13));
	}

	public function ChannelVolumeFHR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFHR ".$Value.chr(13));
	}

	public function ChannelVolumeFWL($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFWL ".$Value.chr(13));
	}

	public function ChannelVolumeFWR($Value)
	{
		$Value = (intval($Value) +50);
		CSCK_SendText($id, "CVFWR ".$Value.chr(13));
	}

	######################## Cursor Steuerung ######################################

	public function CursorUp()
	{
	  CSCK_SendText($id, "MNCUP".chr(13));
	}

	public function CursorDown()
	{
	  CSCK_SendText($id, "MNCDN".chr(13));
	}

	public function CursorLeft()
	{
	  CSCK_SendText($id, "MNCLT".chr(13));
	}

	public function CursorRight()
	{
	  CSCK_SendText($id, "MNCRT".chr(13));
	}

	public function Enter()
	{
	  CSCK_SendText($id, "MNENT".chr(13));
	}

	public function CursorReturn()
	{
	  CSCK_SendText($id, "MNRTN".chr(13));
	}


	######################## Zone 2 functions ######################################

	public function Z2_Volume($Value) // "UP" or "DOWN"
	{
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2VolumeFix($Value) // 18(db) bis -80(db)
	{
		$Value= intval($Value) +80;
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2Power($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2Mute($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z2MU".$Value.chr(13));
	}

	public function Zone2InputSource($Value) // PHONO ; DVD ; HDP ; "TV/CBL" ; SAT ; "NET/USB" ; DVR ; TUNER
	{
		CSCK_SendText($id, "Z2".$Value.chr(13));
	}

	public function Zone2ChannelSetting($Value) // Zone 2 Channel Setting: STEREO/MONO
	{
		if ($Value == false)
					{
						$Value = "ST";
					}
					else
					{
						$Value = "MONO";
					}
		
		CSCK_SendText($id, "Z2CS".$Value.chr(13));
	}

	public function Zone2QuickSelect($Value) // Zone 2 Quickselect 1-5
	{
		$Value = $Value +1;
		CSCK_SendText($id, "Z2QUICK".$Value.chr(13));
	}

	public function Zone2ChannelVolumeFL($id)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z2CVFL ".$Value.chr(13));
	}

	public function Zone2ChannelVolumeFR($id)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z2CVFR ".$Value.chr(13));
	}

	########################## Zone 3 Functions ####################################

	public function Zone3Volume($Value) // "UP" or "DOWN"
	{
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3VolumeFix($Value) // 18(db) bis -80(db)
	{
		$Value= intval($Value) +80;
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3Power($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3Mute($Value) // "ON" or "OFF"
	{
		CSCK_SendText($id, "Z3MU".$Value.chr(13));
	}

	public function Zone3InputSource($Value) // PHONO ; DVD ; HDP ; "TV/CBL" ; SAT ; "NET/USB" ; DVR
	{
		CSCK_SendText($id, "Z3".$Value.chr(13));
	}

	public function Zone3ChannelSetting($Value) // Zone 3 Channel Setting: STEREO/MONO
	{
		if ($Value == false)
			{
				$Value = "ST";
			}
		else
			{
				$Value = "MONO";
			}
		
		CSCK_SendText($id, "Z3CS".$Value.chr(13));
	}

	public function Zone3QuickSelect($Value) // Zone 3 Quickselect 1-5
	{
	   $Value = $Value +1;
		CSCK_SendText($id, "Z3QUICK".$Value.chr(13));
	}

	public function Zone3ChannelVolumeFL($Value)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z3CVFL ".$Value.chr(13));
	}

	public function Zone3ChannelVolumeFR($Value)
	{
	   $Value = $Value + 50;
		CSCK_SendText($id, "Z3CVFR ".$Value.chr(13));
	}

	/*
	################## Datapoints

    public function ReceiveData($JSONString)
    {
        $Data = json_decode($JSONString);
//IPS_LogMessage('ReceiveData',print_r($Data,true));
        if ($Data->DataID <> '{43E4B48E-2345-4A9A-B506-3E8E7A964757}')
            return false;
        try
        {
            $this->GetZone();
        } catch (Exception $ex)
        {
            unset($ex);
            return false;
        }


        $APIData = new ISCP_API_Data();
        $APIData->GetDataFromJSONObject($Data);
//        IPS_LogMessage('ReceiveAPIData1', print_r($APIData, true));

        if ($this->OnkyoZone->CmdAvaiable($APIData) === false)
        {
//            IPS_LogMessage('CmdAvaiable', 'false');

            if ($this->OnkyoZone->SubCmdAvaiable($APIData) === false)
            {
//                IPS_LogMessage('SubCmdAvaiable', 'false');
                return false;
            } else
            {
                $APIData->GetMapping();
                $APIData->APICommand = $APIData->APISubCommand->{$this->OnkyoZone->thisZone};
                IPS_LogMessage('APISubCommand', $APIData->APICommand);
            }
        } else
            $APIData->GetMapping();

//        IPS_LogMessage('ReceiveAPIData2', print_r($APIData, true));


        $this->ReceiveAPIData($APIData);
    }
	
	
	*/
	 protected function SendDataToParent($Data)
    {
        // API-Daten verpacken und dann versenden.
        $JSONString = $Data->ToJSONString('{8F47273A-0B69-489E-AF36-F391AE5FBEC0}');
//        IPS_LogMessage('SendDataToSplitter:'.$this->InstanceID,$JSONString);
        // Daten senden
        return @IPS_SendDataToParent($this->InstanceID, $JSONString);
    }
	
	// Beispiel innerhalb einer Gateway/Splitter Instanz
	public function ReceiveData($JSONString) {
	 
		// Empfangene Daten vom I/O
		$data = json_decode($JSONString);
		IPS_LogMessage("ReceiveData", utf8_decode($data->Buffer));
	 
		// Hier werden die Daten verarbeitet
	 
		// Weiterleitung zu allen Ger�t-/Device-Instanzen
		$this->SendDataToChildren(json_encode(Array("DataID" => "{66164EB8-3439-4599-B937-A365D7A68567}", "Buffer" => $data->Buffer)));
	}
	
	// Data Empfang
	/*
	public function ReceiveData($JSONString)
	{
	 
		// Empfangene Daten vom Gateway/Splitter
		$data = json_decode($JSONString);
		IPS_LogMessage("ReceiveData", utf8_decode($data->Buffer));
	 
		// Datenverarbeitung und schreiben der Werte in die Statusvariablen
		//SetValue($this->GetIDForIdent("Value"), $data->Buffer);
	 
	}
	*/
	
	################## DATAPOINTS PARENT
/*
    public function ReceiveData($JSONString)
    {
        $data = json_decode($JSONString);
        //IPS_LogMessage('ReceiveDataFrom???:'.$this->InstanceID,  print_r($data,1));
        $this->CheckParents();
        if ($this->Mode === false){
    trigger_error("Wrong IO-Parent",E_USER_WARNING);
//            echo "Wrong IO-Parent";
            return false;
        }
        $bufferID = $this->GetIDForIdent("BufferIN");
        // Empfangs Lock setzen
        if (!$this->lock("ReceiveLock"))
        {
            trigger_error("ReceiveBuffer is locked",E_USER_NOTICE);
            return false;

//            throw new Exception("ReceiveBuffer is locked",E_USER_NOTICE);
        }
        // Datenstream zusammenf�gen
        $head = GetValueString($bufferID);
        SetValueString($bufferID, '');
        // Stream in einzelne Pakete schneiden
        $stream = $head . utf8_decode($data->Buffer);
        if ($this->Mode == ISCPSplitter::LAN)
        {
            $minTail = 24;

            $start = strpos($stream, 'ISCP');
            if ($start === false)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame without ISCP');
                $stream = '';
            }
            elseif ($start > 0)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame start not with ISCP');
                $stream = substr($stream, $start);
            }
            //Paket suchen
            if (strlen($stream) < $minTail)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame to short');
                SetValueString($bufferID, $stream);
                $this->unlock("ReceiveLock");
                return;
            }
            $header_len = ord($stream[6]) * 256 + ord($stream[7]);
            $frame_len = ord($stream[10]) * 256 + ord($stream[11]);
//             IPS_LogMessage('ISCP Gateway', 'LANFrame info ' . $header_len. '+'. $frame_len . ' Bytes.');            
            if (strlen($stream) < $header_len + $frame_len)
            {
                IPS_LogMessage('ISCP Gateway', 'LANFrame must have ' . $header_len . '+' . $frame_len . ' Bytes. ' . strlen($stream) . ' Bytes given.');
                SetValueString($bufferID, $stream);
                $this->unlock("ReceiveLock");
                return;
            }
            $header = substr($stream, 0, $header_len);
            $frame = substr($stream, $header_len, $frame_len);
            //EOT wegschneiden von reschts, aber nur wenn es einer der letzten drei zeichen ist
            $end = strrpos($frame, chr(0x1A));
            if ($end >= $frame_len - 3)
                $frame = substr($frame, 0, $end);
            //EOT wegschneiden von reschts, aber nur wenn es einer der letzten drei zeichen ist
            $end = strrpos($frame, chr(0x0D));
            if ($end >= $frame_len - 3)
                $frame = substr($frame, 0, $end);
            //EOT wegschneiden von reschts, aber nur wenn es einer der letzten drei zeichen ist
            $end = strrpos($frame, chr(0x0A));
            if ($end >= $frame_len - 3)
                $frame = substr($frame, 0, $end);
//                IPS_LogMessage('ISCP Gateway', 'LAN $header:' . $header);
//                IPS_LogMessage('ISCP Gateway', 'LAN $frame:' . $frame);
// 49 53 43 50  // ISCP
// 00 00 00 10  // HEADERLEN
// 00 00 00 0B  // DATALEN
// 01 00 00 00  // Version
// 21 31 4E 4C  // !1NL
// 53 43 2D 50  // SC-P
// 1A 0D 0A     // EOT CR LF
            $tail = substr($stream, $header_len + $frame_len);
            if ($this->eISCPVersion <> ord($header[12]))
            {
                $frame = false;
                trigger_error("Wrong eISCP Version",E_USER_NOTICE);
            }
        }
        else
        {
            $minTail = 6;
            $start = strpos($stream, '!');
            if ($start === false)
            {
                IPS_LogMessage('ISCP Gateway', 'eISCP Frame without !');
                $stream = '';
            }
            elseif ($start > 0)
            {
                IPS_LogMessage('ISCP Gateway', 'eISCP Frame do not start with !');
                $stream = substr($stream, $start);
            }
            //Paket suchen
            $end = strpos($stream, chr(0x1A));
            if (($end === false) or ( strlen($stream) < $minTail)) // Kein EOT oder zu klein
            {
                IPS_LogMessage('ISCP Gateway', 'eISCP Frame to short');
                SetValueString($bufferID, $stream);
                $this->unlock("ReceiveLock");
                return;
            }
            $frame = substr($stream, $start, $end - $start);
            // Ende wieder in den Buffer werfen
            $tail = ltrim(substr($stream, $end));
        }
        if ($tail === false)
            $tail = '';
        SetValueString($bufferID, $tail);
        $this->unlock("ReceiveLock");
        if ($frame !== false)
            $this->DecodeData($frame);
        // Ende war l�nger als 6 / 23 ? Dann nochmal Packet suchen.
        if (strlen($tail) >= $minTail)
            $this->ReceiveData(json_encode(array('Buffer' => '')));
        return true;
    }
	*/
	
	

}

?>