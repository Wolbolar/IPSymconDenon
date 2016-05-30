<?

//  API Datentypen
class DENONIPSVarType extends stdClass
{

    const vtNone = -1;
    const vtBoolean = 0;
    const vtInteger = 1;
    const vtFloat = 2;
    const vtString = 3;
    

}

class DENONIPSProfiles extends stdClass
{
	//Name übergeben
	// function  IM Array auf übereinstimmnung überprüfen match ausgeben
	// function create profile mit übergabewert aus array aufruf der neuen klasse var zu setzten der var mit übergabe des profilnames ( am besten in einer klasse zusammenführen)
	
	//public $description;
	public $AVRType;
	public $Zone;
	const DENON = "DENON";
	
	//Profiltype
	const ptSwitch = '~Switch';
    public $ptPower;
	public $ptMainZonePower;
	public $ptMainMute;
	public $ptCinemaEQ;
	public $ptPanorama;
	public $ptFrontHeight;
	public $ptToneCTRL;
	public $ptDynamicEQ;
	public $ptMasterVolume;
	public $ptInputSource;
	public $ptAudioDelay;
	public $ptLFELevel;
	public $ptQuickSelect;
	public $ptSleep;
	public $ptDigitalInputMode;
	public $ptSurroundMode;
	public $ptSurroundPlayMode;
	public $ptMultiEQMode;
	public $ptAudioRestorer;
	public $ptBassLevel;
	public $ptTrebleLevel;
	public $ptDimension;
	public $ptDynamicVolume;
	public $ptRoomSize;
	public $ptDynamicCompressor;
	public $ptCenterWidth;
	public $ptDynamicRange;
	public $ptVideoSelect;
	public $ptSurroundBackMode;
	public $ptPreset;
	public $ptInputMode;
	public $ptZone2Power;
	public $ptZone2Mute;
	public $ptZone2HPF;
	public $ptZone2Volume;
	public $ptZone2InputSource;
	public $ptZone2ChannelSetting;
	public $ptZone2ChannelVolumeFL;
	public $ptZone2ChannelVolumeFR;
	public $ptZone2QuickSelect;
	public $ptZone2Sleep;
	public $ptZone3Power;
	public $ptZone3Mute;
	public $ptZone3HPF;
	public $ptZone3Volume;
	public $ptZone3InputSource;
	public $ptZone3ChannelSetting;
	public $ptZone3ChannelVolumeFL;
	public $ptZone3ChannelVolumeFR;
	public $ptZone3QuickSelect;
	public $ptZone3Sleep;
	public $ptChannelVolumeFL;
	public $ptChannelVolumeFR;
	public $ptChannelVolumeC;
	public $ptChannelVolumeSW;
	public $ptChannelVolumeSW2;
	public $ptChannelVolumeSL;
	public $ptChannelVolumeSR;
	public $ptChannelVolumeSBL;
	public $ptChannelVolumeSBR;
	public $ptChannelVolumeSB;
	public $ptChannelVolumeFHL;
	public $ptChannelVolumeFHR;
	public $ptChannelVolumeFWL;
	public $ptChannelVolumeFWR;
	public $ptNavigation;
	public $ptContrast;
	public $ptBrightness;
	public $ptChromalevel;
	public $ptHue;
	public $ptEnhancer;
	public $ptSubwoofer;
	public $ptSubwooferATT;
	public $ptDNRDirectChange;
	public $ptEffect;
	public $ptAFDM;
	public $ptEffectLevel;
	public $ptCenterImage;
	public $ptStageWidth;
	public $ptStageHeight;
	public $ptAudysseyDSX;
	public $ptReferenceLevel;
	public $ptDRCDirectChange;
	public $ptSpeakerOutputFront;
	//public $ptDCOMPDirectChange;
	public $ptHDMIMonitor;
	public $ptASP;
	public $ptResolution;
	public $ptResolutionHDMI;
	public $ptHDMIAudioOutput;
	public $ptVideoProcessingMode;
	public $ptDolbyVolumeLeveler;
	public $ptDolbyVolumeModeler;
	public $ptPLIIZHeightGain;
	public $ptVerticalStretch;
	public $ptDolbyVolume;
	public $ptFriendlyName;
	public $ptMainZoneName;
	public $ptZone2Name;
	public $ptZone3Name;
	public $ptTopMenuLink;
	public $ptModel;
	public $ptGUISourceSelect;
	public $ptGUIMenu;
	public $ptSurroundDisplay;
	public $UsedInputSources;
	public $UsedInputSourcesZ2;
	public $UsedInputSourcesZ3;
	public $VarMappingInputSources;
	public $VarMappingInputSourcesZ2;
	public $VarMappingInputSourcesZ3;
	public $DenonIP;
	public $ptDisplay;
	
	//Zusatz ab AVR-X7200W / AVR-X5200W / AVR-X4100W / AVR-X3100W /	AVR-X2100W / S900W / AVR-X1100W / S700W / AVR-7200WA / AVR-6200W / AVR-4200W / AVR-3200W / AVR-2200W / AVR-1200W
	public $ptGraphicEQ;
	public $ptDimmer;
	public $ptDialogLevelAdjust;
	public $ptMAINZONEAutoStandbySetting;
	public $ptMAINZONEECOModeSetting;
	public $ptCenterspread;
	public $ptAuroMatic3DPreset;
	public $ptAuroMatic3DStrength;
	public $ptSurroundHeightLch;
	public $ptSurroundHeightRch;
	public $ptTopSurround;
	public $ptTopFrontLch;
	public $ptTopFrontRch;
	public $ptTopMiddleLch;
	public $ptTopMiddleRch;
	public $ptTopRearLch;
	public $ptTopRearRch;
	public $ptRearHeightLch;
	public $ptRearHeightRch;
	public $ptFrontDolbyLch;
	public $ptFrontDolbyRch;
	public $ptSurroundDolbyLch;
	public $ptSurroundDolbyRch;
	public $ptBackDolbyLch;
	public $ptBackDolbyRch;
	public $ptZONE2AutoStandbySetting;
	public $ptZONE3AutoStandbySetting;
	
	
	public function GetInputSources(integer $Zone, string $AVRType, boolean $FAVORITES, boolean $IRADIO, boolean $SERVER, boolean $NAPSTER, boolean $LASTFM, boolean $FLICKR)
	{
		
		if(($AVRType == "AVR-4311") || ($AVRType == "AVR-4310") || ($AVRType == "AVR-1912"))
		{
			if ($Zone == 0) // MainZone
			{
				$xmlMainZone = new SimpleXMLElement(file_get_contents("http://".$this->DenonIP."/goform/formMainZone_MainZoneXml.xml"));
				if ($xmlMainZone)
					{
					$RenameType = 1;	
					$Inputsources = $this->ReadInputSources($Zone, $xmlMainZone, $RenameType, $AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
					return $Inputsources;
					}
				else
					{
					exit("Datei ".$xmlMainZone." konnte nicht geöffnet werden.");
					}
			}		
			elseif ($Zone == 1) // Zone 2
			{
				$data = array();
				$xmlZone2 = new SimpleXMLElement(file_get_contents("http://".$this->DenonIP."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE2"));
				if ($xmlZone2)
						{
						$RenameType = 1;
						$InputsourcesZ2 = $this->ReadInputSources($Zone, $xmlZone2, $RenameType, $AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
						return $InputsourcesZ2;	
						}
					else
						{
						exit("Datei ".$xml." konnte nicht geöffnet werden.");
						}
				return $data; 		
			}
			elseif ($Zone == 2) // Zone 3
			{
				$data = array();
				$xmlZone3 = new SimpleXMLElement(file_get_contents("http://".$this->DenonIP."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE3"));
				if ($xmlZone3)
						{
						$RenameType = 1;	
						$InputsourcesZ3 = $this->ReadInputSources($Zone, $xmlZone3, $RenameType, $AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
						return $InputsourcesZ3;
						}
					else
						{
						exit("Datei ".$xml." konnte nicht geöffnet werden.");
						}
				return $data;
			}	
		}
		elseif(($AVRType == "AVR-3808A") || ($AVRType == "AVR-4308A"))
		{
			$Inputsources = $this->StandardInputSources($AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
			return $Inputsources;
		}
		
		elseif(($AVRType == "S700W") || ($AVRType == "S900W") || ($AVRType == "AVR-2313") || ($AVRType == "AVR-3313") ||  ($AVRType == "Marantz-NR1605") || ($AVRType == "AVR-X1000") || ($AVRType == "AVR-X1100W") || ($AVRType == "AVR-X1200W") || ($AVRType == "AVR-X2000")
							|| ($AVRType == "AVR-X2100W") || ($AVRType == "AVR-X2200W") || ($AVRType == "AVR-X3000") || ($AVRType == "AVR-X3100W") || ($AVRType == "AVR-X3200W") || ($AVRType == "AVR-X4000") || ($AVRType == "AVR-X4100W") || ($AVRType == "AVR-X4200W")
							|| ($AVRType == "AVR-X5200W") || ($AVRType == "AVR-6200W") || ($AVRType == "AVR-X7200W") || ($AVRType == "AVR-7200WA"))
		{
			if ($Zone == 0) // MainZone
			{
				$xmlMainZone = new SimpleXMLElement(file_get_contents("http://".$this->DenonIP."/goform/formMainZone_MainZoneXmlStatus.xml"));
				if ($xmlMainZone)
					{
					$RenameType = 2;	
					$Inputsources = $this->ReadInputSources($Zone, $xmlMainZone, $RenameType, $AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
					return $Inputsources;
					}
				else
					{
					exit("Datei ".$xmlMainZone." konnte nicht geöffnet werden.");
					}
			}		
			elseif ($Zone == 1) // Zone 2
			{
				$data = array();
				$xmlZone2 = new SimpleXMLElement(file_get_contents("http://".$this->DenonIP."/goform/formMainZone_MainZoneXmlStatus.xml?_=&ZoneName=ZONE2"));
				if ($xmlZone2)
						{
						$RenameType = 2;	
						$InputsourcesZ2 = $this->ReadInputSources($Zone, $xmlZone2, $RenameType, $AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
						return $InputsourcesZ2;	
						}
					else
						{
						exit("Datei ".$xml." konnte nicht geöffnet werden.");
						}
				return $data; 		
			}
			elseif ($Zone == 2) // Zone 3
			{
				$data = array();
				$xmlZone3 = new SimpleXMLElement(file_get_contents("http://".$this->DenonIP."/goform/formMainZone_MainZoneXmlStatus.xml?_=&ZoneName=ZONE3"));
				if ($xmlZone3)
						{
						$RenameType = 2;	
						$InputsourcesZ3 = $this->ReadInputSources($Zone, $xmlZone3, $RenameType, $AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR);
						return $InputsourcesZ3;
						}
					else
						{
						exit("Datei ".$xml." konnte nicht geöffnet werden.");
						}
				return $data;
			}
		}	
		
		
	}

	protected function StandardInputSources($AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR)
	{
		$UsedInputSources =  array(
				"Ident" => "SI",
				"Name" => "Input Source",
				"Profilesettings" => Array("Database", "", "", 0, 19, 0, 0),
				"Associations" => array(
									Array(0, "Phono",  "", -1),
									Array(1, "CD",  "", -1),
									Array(2, "Tuner",  "", -1),
									Array(3, "DVD",  "", -1),
									Array(4, "BD",  "", -1),
									Array(5, "TV",  "", -1),
									Array(6, "Sat/CBL",  "", -1),
									Array(7, "DVR",  "", -1),
									Array(8, "Game",  "", -1),
									Array(9, "V.Aux",  "", -1),
									Array(10, "Dock",  "", -1),
									Array(11, "IPod",  "", -1),
									Array(12, "Net/USB",  "", -1),
									Array(13, "Napster",  "", -1),
									Array(14, "LastFM",  "", -1),
									Array(15, "Flickr",  "", -1),
									Array(16, "Favorites",  "", -1),
									Array(17, "IRadio",  "", -1),
									Array(18, "Server",  "", -1),
									Array(19, "USB/IPod",  "", -1)
									)
									);

				$this->UsedInputSources = $UsedInputSources;

				$InputSourcesMapping = array(
                                 array ("Source" => "PHONO", "RenameSource" => "Phono"),
                                 array ("Source" => "CD", "RenameSource" => "CD"),
                                 array ("Source" => "TUNER", "RenameSource" => "Tuner"),
                                 array ("Source" => "DVD", "RenameSource" => "DVD"),
                                 array ("Source" => "BD", "RenameSource" => "Blu-ray"),
                                 array ("Source" => "TV", "RenameSource" => "TV"),
                                 array ("Source" => "SAT/CBL", "RenameSource" => "Sat/CBL"),
                                 array ("Source" => "DVR", "RenameSource" => "DVR"),
                                 array ("Source" => "GAME", "RenameSource" => "Game"),
                                 array ("Source" => "V.AUX", "RenameSource" => "V.Aux"),
                                 array ("Source" => "DOCK", "RenameSource" => "Dock"),
                                 array ("Source" => "IPOD", "RenameSource" => "Ipod"),
                                 array ("Source" => "NET/USB", "RenameSource" => "Net/USB"),
                                 array ("Source" => "NAPSTER", "RenameSource" => "Napster"),
                                 array ("Source" => "LASTFM", "RenameSource" => "LastFM"),
                                 array ("Source" => "FLICKR", "RenameSource" => "Flickr"),
                                 array ("Source" => "FAVORITES", "RenameSource" => "Favorites"),
                                 array ("Source" => "IRADIO", "RenameSource" => "IRadio"),
                                 array ("Source" => "SERVER", "RenameSource" => "Server"),
                                 array ("Source" => "USB/IPOD", "RenameSource" => "USB/iPod")
				);
				
				$InputMapping = array("AVRType" => $AVRType, "Inputs" => $InputSourcesMapping, "Writeprotected" => false );
				$this->VarMappingInputSources = $InputMapping;
				return $UsedInputSources;	
	}
	
	protected function ReadInputSources($Zone, $xml, $RenameType, $AVRType, $FAVORITES, $IRADIO, $SERVER, $NAPSTER, $LASTFM, $FLICKR)
	{
		//Inputs
		$InputFuncList = $xml->xpath('.//InputFuncList');
		if ($InputFuncList)
		{
			$countinput = count($InputFuncList[0]->value);
			$RenameSource = $xml->xpath('.//RenameSource');
			$SourceDelete = $xml->xpath('.//SourceDelete');
			$SourceDeleteUse = $xml->xpath('.//SourceDelete/value[. ="USE"]');
			$countUse = count($SourceDeleteUse);
			$Inputs = array();
			$MinValue = array();
			$UsedInput_i = -1;
			for ($i = 0; $i <= $countinput-1; $i++)
				{
					if ((string)$SourceDelete[0]->value[$i] == "USE")
					{
						$UsedInput_i++;
						$MinValue[$UsedInput_i] = $UsedInput_i;
						if ($RenameType == 1)
						{
							$RenameInput = (string)$RenameSource[0]->value[$i];
						}
						elseif ($RenameType == 2)
						{
							$RenameInput = (string)$RenameSource[0]->value[$i]->value;
						}
						if ($RenameInput != "")
							{
							$Inputs[$UsedInput_i] = array( "Source" => (string)$InputFuncList[0]->value[$i], "RenameSource" => $RenameInput);	
							//$Inputs[$i] = (string)$RenameSource[0]->value[$i];
							}
						else
							{
							$Inputs[$UsedInput_i] = array( "Source" => (string)$InputFuncList[0]->value[$i], "RenameSource" => (string)$InputFuncList[0]->value[$i]);
							//$Inputs[$i] = (string)$InputFuncList[0]->value[$i];
						   }
					}
			   }
			$MinValue = array_shift($MinValue);
			$MaxValue = ($countUse-1);
			if($Zone == 0)
			{
				$UsedInputSources = array
				(
				"Ident" => DENON_API_Commands::SI,
				"Name" => "Input Source",
				"Profilesettings" => Array("Database", "", "", $MinValue, $MaxValue, 0, 0),
				);
				$Associations = array();
				foreach ($Inputs as $Value => $Input)
				{
				$RenameSource = $Input["RenameSource"];	
				$SourceInput = str_replace(" ", "", $RenameSource);
				$Associations[] = array($Value, $SourceInput,  "", -1);
				}
				//zusätzliche Inputs bei Auswahl
				if($FAVORITES)
					{
						$countAssociations = count($Associations);
						$Associations[$countAssociations] = array($countAssociations, "Favoriten",  "", -1);
					}
				if($IRADIO)
					{
						$countAssociations = count($Associations);
						$Associations[$countAssociations] = array($countAssociations, "Internet Radio",  "", -1);
					}
				if($SERVER)
					{
						$countAssociations = count($Associations);
						$Associations[ $countAssociations] = array($countAssociations, "Server",  "", -1);
					}
				if($NAPSTER)
					{
						$countAssociations = count($Associations);
						$Associations[$countAssociations] = array($countAssociations, "Napster",  "", -1);
					}
				if($LASTFM)
					{
						$countAssociations = count($Associations);
						$Associations[$countAssociations] = array($countAssociations, "LastFM",  "", -1);
					}
				if($FLICKR)
					{
						$countAssociations = count($Associations);
						$Associations[$countAssociations] = array($countAssociations, "Flickr",  "", -1);
					}
				
				$UsedInputSources["Associations"] = $Associations;
				
				$this->UsedInputSources = $UsedInputSources;
				
				$InputSourcesMapping = array();
				foreach ($Inputs as $Value => $Input)
				{
				$Source = $Input["Source"];
				$SourceInput = str_replace(" ", "", $Source);
				$RenameSource = $Input["RenameSource"];
				$RenameSourceInput = str_replace(" ", "", $RenameSource);
				$InputSourcesMapping[$Value] = array ("Source" => $SourceInput, "RenameSource" => $RenameSourceInput) ;
				}
				//Zusätzliche Inputs
				//zusätzliche Inputs bei Auswahl
				if($FAVORITES)
					{
						$countInputSourcesMapping = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMapping] = array ("Source" => "FAVORITES", "RenameSource" => "Favoriten");
					}
				if($IRADIO)
					{
						$countInputSourcesMapping = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMapping] = array ("Source" => "IRADIO", "RenameSource" => "Internet Radio");
					}
				if($SERVER)
					{
						$countInputSourcesMapping = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMapping] = array ("Source" => "SERVER", "RenameSource" => "Server");
					}
				if($NAPSTER)
					{
						$countInputSourcesMapping = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMapping] = array ("Source" => "NAPSTER", "RenameSource" => "Napster");
					}
				if($LASTFM)
					{
						$countInputSourcesMapping = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMapping] = array ("Source" => "LASTFM", "RenameSource" => "LastFM");
					}
				if($FLICKR)
					{
						$countInputSourcesMapping = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMapping] = array ("Source" => "FLICKR", "RenameSource" => "Flickr");
					}
				$InputMapping = array("AVRType" => $AVRType, "Inputs" => $InputSourcesMapping, "Writeprotected" => false );
				
				$this->VarMappingInputSources = $InputMapping; // Varmapping
				
				return $UsedInputSources;
			}
			elseif($Zone == 1)
			{
				$UsedInputSourcesZ2 = array
				(
				"Ident" => DENON_API_Commands::Z2INPUT,
				"Name" => "Zone 2 Input Source",
				"Profilesettings" => Array("Database", "", "", $MinValue, $MaxValue, 0, 0),
				);
				$AssociationsZ2 = array();
				foreach ($Inputs as $Value => $Input)
				{
				$RenameSource = $Input["RenameSource"];	
				$SourceInput = str_replace(" ", "", $RenameSource);
				$AssociationsZ2[] = array($Value, $SourceInput,  "", -1);
				}
				//zusätzliche Inputs bei Auswahl
				if($FAVORITES)
					{
						$countAssociationsZ2 = count($AssociationsZ2);
						$Associations[$countAssociationsZ2] = array($countAssociationsZ2, "Favoriten",  "", -1);
					}
				if($IRADIO)
					{
						$countAssociationsZ2 = count($AssociationsZ2);
						$Associations[$countAssociationsZ2] = array($countAssociationsZ2, "Internet Radio",  "", -1);
					}
				if($SERVER)
					{
						$countAssociationsZ2 = count($AssociationsZ2);
						$Associations[ $countAssociationsZ2] = array($countAssociationsZ2, "Server",  "", -1);
					}
				if($NAPSTER)
					{
						$countAssociationsZ2 = count($AssociationsZ2);
						$Associations[$countAssociationsZ2] = array($countAssociationsZ2, "Napster",  "", -1);
					}
				if($LASTFM)
					{
						$countAssociationsZ2 = count($AssociationsZ2);
						$Associations[$countAssociationsZ2] = array($countAssociationsZ2, "LastFM",  "", -1);
					}
				if($FLICKR)
					{
						$countAssociationsZ2 = count($AssociationsZ2);
						$Associations[$countAssociationsZ2] = array($countAssociationsZ2, "Flickr",  "", -1);
					}
				$UsedInputSourcesZ2["Associations"] = $AssociationsZ2;
				
				$this->UsedInputSourcesZ2 = $UsedInputSourcesZ2;
				
				$InputSourcesMapping = array();
				foreach ($Inputs as $Value => $Input)
				{
				$Source = $Input["Source"];
				$SourceInput = str_replace(" ", "", $Source);
				$RenameSource = $Input["RenameSource"];
				$RenameSourceInput = str_replace(" ", "", $RenameSource);
				$InputSourcesMapping[$Value] = array ("Source" => $SourceInput, "RenameSource" => $RenameSourceInput) ;		
				}
				//Zusätzliche Inputs
				//zusätzliche Inputs bei Auswahl
				if($FAVORITES)
					{
						$countInputSourcesMappingZ2 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ2] = array ("Source" => "FAVORITES", "RenameSource" => "Favoriten");
					}
				if($IRADIO)
					{
						$countInputSourcesMappingZ2 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ2] = array ("Source" => "IRADIO", "RenameSource" => "Internet Radio");
					}
				if($SERVER)
					{
						$countInputSourcesMappingZ2 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ2] = array ("Source" => "SERVER", "RenameSource" => "Server");
					}
				if($NAPSTER)
					{
						$countInputSourcesMappingZ2 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ2] = array ("Source" => "NAPSTER", "RenameSource" => "Napster");
					}
				if($LASTFM)
					{
						$countInputSourcesMappingZ2 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ2] = array ("Source" => "LASTFM", "RenameSource" => "LastFM");
					}
				if($FLICKR)
					{
						$countInputSourcesMappingZ2 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ2] = array ("Source" => "FLICKR", "RenameSource" => "Flickr");
					}
				$InputMapping = array("AVRType" => $AVRType, "Inputs" => $InputSourcesMapping, "Writeprotected" => false );
				$this->VarMappingInputSourcesZ2 = $InputMapping;
				
				return $UsedInputSourcesZ2;
			}
			elseif($Zone == 2)
			{
				$UsedInputSourcesZ3 = array
				(
				"Ident" => DENON_API_Commands::Z3INPUT,
				"Name" => "Zone 3 Input Source",
				"Profilesettings" => Array("Database", "", "", $MinValue, $MaxValue, 0, 0),
				);
				$AssociationsZ3 = array();
				foreach ($Inputs as $Value => $Input)
				{
				$RenameSource = $Input["RenameSource"];	
				$SourceInput = str_replace(" ", "", $RenameSource);
				$AssociationsZ3[] = array($Value, $SourceInput,  "", -1);
				}
				//zusätzliche Inputs bei Auswahl
				if($FAVORITES)
					{
						$countAssociationsZ3 = count($AssociationsZ3);
						$Associations[$countAssociationsZ3] = array($countAssociationsZ3, "Favoriten",  "", -1);
					}
				if($IRADIO)
					{
						$countAssociationsZ3 = count($AssociationsZ3);
						$Associations[$countAssociationsZ3] = array($countAssociationsZ3, "Internet Radio",  "", -1);
					}
				if($SERVER)
					{
						$countAssociationsZ3 = count($AssociationsZ3);
						$Associations[ $countAssociationsZ3] = array($countAssociationsZ3, "Server",  "", -1);
					}
				if($NAPSTER)
					{
						$countAssociationsZ3 = count($AssociationsZ3);
						$Associations[$countAssociationsZ3] = array($countAssociationsZ3, "Napster",  "", -1);
					}
				if($LASTFM)
					{
						$countAssociationsZ3 = count($AssociationsZ3);
						$Associations[$countAssociationsZ3] = array($countAssociationsZ3, "LastFM",  "", -1);
					}
				if($FLICKR)
					{
						$countAssociationsZ3 = count($AssociationsZ3);
						$Associations[$countAssociationsZ3] = array($countAssociationsZ3, "Flickr",  "", -1);
					}
				$UsedInputSourcesZ3["Associations"] = $AssociationsZ3;
				
				$this->UsedInputSourcesZ3 = $UsedInputSourcesZ3;
				
				$InputSourcesMapping = array();
				foreach ($Inputs as $Value => $Input)
				{
				$Source = $Input["Source"];
				$SourceInput = str_replace(" ", "", $Source);
				$InputSourcesMapping[$SourceInput] = $Value;
				}
				//Zusätzliche Inputs
				//zusätzliche Inputs bei Auswahl
				if($FAVORITES)
					{
						$countInputSourcesMappingZ3 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ3] = array ("Source" => "FAVORITES", "RenameSource" => "Favoriten");
					}
				if($IRADIO)
					{
						$countInputSourcesMappingZ3 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ3] = array ("Source" => "IRADIO", "RenameSource" => "Internet Radio");
					}
				if($SERVER)
					{
						$countInputSourcesMappingZ3 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ3] = array ("Source" => "SERVER", "RenameSource" => "Server");
					}
				if($NAPSTER)
					{
						$countInputSourcesMappingZ3 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ3] = array ("Source" => "NAPSTER", "RenameSource" => "Napster");
					}
				if($LASTFM)
					{
						$countInputSourcesMappingZ3 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ3] = array ("Source" => "LASTFM", "RenameSource" => "LastFM");
					}
				if($FLICKR)
					{
						$countInputSourcesMappingZ3 = count($InputSourcesMapping);
						$InputSourcesMapping[$countInputSourcesMappingZ3] = array ("Source" => "FLICKR", "RenameSource" => "Flickr");
					}
				$InputMapping = array("AVRType" => $AVRType, "Inputs" => $InputSourcesMapping, "Writeprotected" => false );
				$this->VarMappingInputSourcesZ3 = $InputMapping;
				
				return $UsedInputSourcesZ3;
			}
			
		}
	}	
	
	public function GetInputVarmapping($Zone)
	{
		if ($Zone == 0)
		{
			$VarMappingInputSources = $this->VarMappingInputSources;
		}
		elseif ($Zone == 1)
		{
			$VarMappingInputSources = $this->VarMappingInputSourcesZ2;
		}
		elseif ($Zone == 2)
		{
			$VarMappingInputSources = $this->VarMappingInputSourcesZ3;
		}
	
		return $VarMappingInputSources;
	}
	
	public function SetupVarDenonString($profile, $AVRType)
	{
		//Ident, Name, Profile, Position 
		$profilesMainZone = array (
		$this->ptFriendlyName => array("FriendlyName", "Name Denon AVR", $this->ptFriendlyName, $this->getpos($profile), "Information"),
		$this->ptMainZoneName => array("MainZoneName", "MainZone Name", $this->ptMainZoneName, $this->getpos($profile), "Information"),
		$this->ptTopMenuLink => array("TopMenuLink", "Top Menu Link", $this->ptTopMenuLink, $this->getpos($profile), "Information"),
		$this->ptModel => array("Model", "Model", $this->ptModel, $this->getpos($profile), "Information"),
		$this->ptSurroundDisplay => array(DENON_API_Commands::SURROUNDDISPLAY, "Surround Mode", $this->ptSurroundDisplay, $this->getpos($profile), "Information"),
		$this->ptDisplay => array(DENON_API_Commands::DISPLAY, "Display", "~HTMLBox", $this->getpos($profile), "TV")
		);
		$profilesZone2 = array (
		$this->ptZone2Name => array("Zone2Name", "Zone2 Name", $this->ptZone2Name, $this->getpos($profile), "Information"),
		$this->ptModel => array("Model", "Model", $this->ptModel, $this->getpos($profile), "Information")
		);
		$profilesZone3 = array (
		$this->ptZone3Name => array("Zone3Name", "Zone3 Name", $this->ptZone3Name, $this->getpos($profile), "Information"),
		$this->ptModel => array("Model", "Model", $this->ptModel, $this->getpos($profile), "Information")
		);

		if($this->Zone == 0)
		{
			$profilestring = $this->sendprofilestring($profilesMainZone, $profile);
			return $profilestring;
		}
		elseif ($this->Zone == 1)
		{
			$profilestring = $this->sendprofilestring($profilesZone2, $profile);
			return $profilestring;
		}
		elseif ($this->Zone == 2)
		{
			$profilestring = $this->sendprofilestring($profilesZone3, $profile);
			return $profilestring;
		}	
	}
	
	private function sendprofilestring($profiles, $profile)
	{
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
			   $profilestring = array(
			   "Name" => $profilvar[1],
			   "Ident" => $profilvar[0],
			   "ProfilName" => $profilvar[2],
			   "Position" => $profilvar[3],
			   "Icon" => $profilvar[4]
			   );
			   
			   return $profilestring;
			}
		}	
	}
	
	public function SetupVarDenonBool($profile, $AVRType)
	{
		//Ident, Name, Profile, Position 
		$profilesMainZone = array (
		$this->ptPower => array(DENON_API_Commands::PW, "Power", "~Switch", $this->getpos($profile)),
		$this->ptMainZonePower => array(DENON_API_Commands::ZM, "MainZone Power", "~Switch", $this->getpos($profile)),
		$this->ptMainMute => array(DENON_API_Commands::MU, "Main Mute", "~Switch", $this->getpos($profile)),
		$this->ptCinemaEQ => array(DENON_API_Commands::PSCINEMAEQ, "Cinema EQ", "~Switch", $this->getpos($profile)),
		$this->ptDynamicEQ => array(DENON_API_Commands::PSDYNEQ, "Dynamic EQ", "~Switch", $this->getpos($profile)),
		$this->ptFrontHeight => array(DENON_API_Commands::PSFH, "Front Height", "~Switch", $this->getpos($profile)),
		$this->ptPanorama => array(DENON_API_Commands::PSPAN, "Panorama", "~Switch", $this->getpos($profile)),
		$this->ptToneCTRL => array(DENON_API_Commands::PSTONECTRL, "Tone CTRL", "~Switch", $this->getpos($profile)),
		$this->ptVerticalStretch => array(DENON_API_Commands::VSVST, "Vertical Stretch", "~Switch", $this->getpos($profile)),
		$this->ptDolbyVolume => array(DENON_API_Commands::PSDOLVOL, "Dolby Volume", "~Switch", $this->getpos($profile)),
		$this->ptEffect => array(DENON_API_Commands::PSEFFSWITCH, "Effect", "~Switch", $this->getpos($profile)),
		$this->ptAFDM => array(DENON_API_Commands::PSAFD, "Auto Flag Detect Mode", "~Switch", $this->getpos($profile)),
		$this->ptSubwoofer => array(DENON_API_Commands::PSSWR, "Subwoofer", "~Switch", $this->getpos($profile)),
		$this->ptSubwooferATT => array(DENON_API_Commands::PSATT, "Subwoofer ATT", "~Switch", $this->getpos($profile)),
		$this->ptGUIMenu => array(DENON_API_Commands::MNMEN, "GUI Menu", "~Switch", $this->getpos($profile)),
		$this->ptGUISourceSelect => array(DENON_API_Commands::MNSRC, "GUI Source Select Menu", "~Switch", $this->getpos($profile))
		);
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-X1100W" || $AVRType == "S700W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W" || $AVRType == "AVR-2200W" || $AVRType == "AVR-1200W")
			{
				$profilesMainZone[$this->ptGraphicEQ] = array(DENON_API_Commands::PSGRAPHICEQ, "Graphic EQ", "~Switch", $this->getpos($profile));
				$profilesMainZone[$this->ptDialogLevelAdjust] = array(DENON_API_Commands::PSDIL, "Dialog Level Adjust", "~Switch", $this->getpos($profile));
			}			
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W")
			{
				$profilesMainZone[$this->ptCenterspread] = array(DENON_API_Commands::PSCES, "Center Spread", "~Switch", $this->getpos($profile));
			}
		

		$profilesZone2 = array (
		$this->ptPower => array(DENON_API_Commands::PW, "Power", "~Switch", $this->getpos($profile)),
		$this->ptZone2Power => array(DENON_API_Commands::Z2POWER, "Zone 2 Power", "~Switch", $this->getpos($profile)),
		$this->ptZone2Mute => array(DENON_API_Commands::Z2MU, "Zone 2 Mute", "~Switch", $this->getpos($profile)),
		$this->ptZone2HPF => array(DENON_API_Commands::Z2HPF, "Zone 2 HPF", "~Switch", $this->getpos($profile))
		);
		
		$profilesZone3 = array (
		$this->ptPower => array(DENON_API_Commands::PW, "Power", "~Switch", $this->getpos($profile)),
		$this->ptZone3Power => array(DENON_API_Commands::Z3POWER, "Zone 3 Power", "~Switch", $this->getpos($profile)),
		$this->ptZone3Mute => array(DENON_API_Commands::Z3MU, "Zone 3 Mute", "~Switch", $this->getpos($profile)),
		$this->ptZone3HPF => array(DENON_API_Commands::Z3HPF, "Zone 3 HPF", "~Switch", $this->getpos($profile))
		);
		
		if($this->Zone == 0)
		{
			$profilebool = $this->sendprofilebool($profilesMainZone, $profile);
			return $profilebool;
		}
		elseif ($this->Zone == 1)
		{
			$profilebool = $this->sendprofilebool($profilesZone2, $profile);
			return $profilebool;
		}
		elseif ($this->Zone == 2)
		{
			$profilebool = $this->sendprofilebool($profilesZone3, $profile);
			return $profilebool;
		}
		
	}
	
	private function sendprofilebool($profiles, $profile)
	{
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
			   $profilebool = array(
			   "Name" => $profilvar[1],
			   "Ident" => $profilvar[0],
			   "ProfilName" => $profilvar[2],
			   "Position" => $profilvar[3]
			   );
			   
			   return $profilebool;
			}

		}	
	}
	
	public function SetupVarDenonInteger($profile, $AVRType)
	{
		//Sichtbare variablen profil suchen
		$profilesMainZone = array(
        $this->ptSleep => array(DENON_API_Commands::SLP, "Sleep", "Clock",  "", " Min", 0, 120, 10, 0),
		$this->ptDimension => array(DENON_API_Commands::PSDIM, "Dimension", "Intensity",  "", "", 0, 6, 1, 0)
		);

		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W")
			{
				$profilesMainZone[$this->ptAuroMatic3DStrength] = array(DENON_API_Commands::PSAUROST, "Auromatic 3D Strength", "Intensity", "", "", 1, 16, 1, 0);	
			}
		
		$profilesZone2 = array(
        $this->ptZone2Sleep => array(DENON_API_Commands::Z2SLP, "Sleep Zone 2", "Clock",  "", " Min", 0, 120, 10, 0)
		);
		
		$profilesZone3 = array(
        $this->ptZone3Sleep => array(DENON_API_Commands::Z3SLP, "Sleep Zone 3", "Clock",  "", " Min", 0, 120, 10, 0)
		);
		
		if($this->Zone == 0)
		{
			$profileinteger = $this->sendprofileinteger($profilesMainZone, $profile);
			return $profileinteger;
		}
		elseif ($this->Zone == 1)
		{
			$profileinteger = $this->sendprofileinteger($profilesZone2, $profile);
			return $profileinteger;
		}
		elseif ($this->Zone == 2)
		{
			$profileinteger = $this->sendprofileinteger($profilesZone3, $profile);
			return $profileinteger;
		}
		
	}
	
	private function sendprofileinteger($profiles, $profile)
	{
		foreach($profiles as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
				$pos = $this->getpos($profile);
				$profileinteger = array(
				"ProfilName" => $ptName,
				"Name" => $profilvar[1],
				"Ident" => $profilvar[0],
				"Icon" => $profilvar[2],
				"Prefix" => $profilvar[3],
				"Suffix" => $profilvar[4],
				"MinValue" => $profilvar[5],
				"MaxValue" => $profilvar[6],
				"Stepsize" => $profilvar[7],
				"Digits" => $profilvar[8],
				"Position" => $pos
				);
			   
			   return $profileinteger;
			}

		}	
	}
	
	public function SetupVarDenonIntegerAss($profile, $AVRType)
	{
				
		//Sichtbare variablen profil suchen
		//Associations
		//Associations Value, Association, Icon, Color

		$ProfilAssociationsMainZone = array
		(
			$this->ptNavigation => array(
				"Ident" => DENON_API_Commands::MN,
				"Name" => "Navigation",
				"Profilesettings" => Array("Move", "", "", 0, 5, 0, 0),
				"Associations" => array(
				Array(0, "Left",  "", -1),
				Array(1, "Down",  "", -1),
				Array(2, "Up",  "", -1),
				Array(3, "Right",  "", -1),
				Array(4, "Enter",  "", -1),
				Array(5, "Return",  "", -1)
				)		
			),
			$this->ptQuickSelect => array(
				"Ident" => DENON_API_Commands::MSQUICK,
				"Name" => "Quick Select",
				"Profilesettings" => Array("Database", "", "", 0, 5, 0, 0),
				"Associations" => array(
				Array(0, "NONE",  "", -1),
				Array(1, "Quick Select 1",  "", -1),
				Array(2, "Quick Select 2",  "", -1),
				Array(3, "Quick Select 3",  "", -1),
				Array(4, "Quick Select 4",  "", -1),
				Array(5, "Quick Select 5",  "", -1)
				)
			),
			$this->ptDigitalInputMode => array(
				"Ident" => DENON_API_Commands::DC,
				"Name" => "Digital Input Mode",
				"Profilesettings" => Array("Database", "", "", 0, 2, 0, 0),
				"Associations" => Array(
				Array(0, "Auto",  "", -1),
				Array(1, "PCM",  "", -1),
				Array(2, "DTS",  "", -1)
				)
			),
			$this->ptAudysseyDSX => array(
				"Ident" => DENON_API_Commands::PSDSX,
				"Name" => "Audyssey DSX",
				"Profilesettings" => Array("Speaker", "", "", 0, 3, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Audyssey DSX On(Wide)",  "", -1),
				Array(2, "Audyssey DSX On(Height)",  "", -1),
				Array(3, "Audyssey DSX On(Wide/Height)",  "", -1)
				)
			),
			$this->ptSurroundMode => array(
				"Ident" => DENON_API_Commands::MS,
				"Name" => "Surround Mode",
				"Profilesettings" => Array("Melody", "", "", 0, 15, 0, 0),
				"Associations" => Array(
				Array(0, "Direct",  "", -1),
				Array(1, "Pure Direct",  "", -1),
				Array(2, "Stereo",  "", -1),
				Array(3, "Standard",  "", -1),
				Array(4, "Dolby Digital",  "", -1),
				Array(5, "DTS Surround",  "", -1),
				Array(6, "Multichannel Stereo",  "", -1),
				Array(7, "Widescreen",  "", -1),
				Array(8, "Superstadium",  "", -1),
				Array(9, "Rock Arena",  "", -1),
				Array(10, "Jazz Club",  "", -1),
				Array(11, "Classic Concert",  "", -1),
				Array(12, "Mono Movie",  "", -1),
				Array(13, "Matrix",  "", -1),
				Array(14, "Video Game",  "", -1),
				Array(15, "Virtual",  "", -1)
				)
			),
			$this->ptSurroundPlayMode => array(
				"Ident" => DENON_API_Commands::PSMODE,
				"Name" => "Surround Play Mode",
				"Profilesettings" => Array("Database", "", "", 0, 3, 0, 0),
				"Associations" => Array(
				Array(0, "Cinema",  "", -1),
				Array(1, "Music",  "", -1),
				Array(2, "Game",  "", -1),
				Array(3, "Pro Logic",  "", -1)
				)
			),
			$this->ptMultiEQMode => array(
				"Ident" => DENON_API_Commands::PSMULTEQ,
				"Name" => "Multi EQ Mode",
				"Profilesettings" => Array("Database", "", "", 0, 4, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Audyssey",  "", -1),
				Array(2, "BYP.LR",  "", -1),
				Array(3, "Flat",  "", -1),
				Array(4, "Manual",  "", -1)
				)
			),
			$this->ptAudioRestorer => array(
				"Ident" => DENON_API_Commands::PSRSTR,
				"Name" => "Audio Restorer",
				"Profilesettings" => Array("Database", "", "", 0, 3, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Restorer 64",  "", -1),
				Array(2, "Restorer 96",  "", -1),
				Array(3, "Restorer HQ",  "", -1)
				)
			),
			$this->ptDynamicVolume => array(
				"Ident" => DENON_API_Commands::PSDYNVOL,
				"Name" => "Dynamic Volume",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 0, 0),
				"Associations" => Array(
				Array(0, "Midnight",  "", -1),
				Array(1, "Evening",  "", -1),
				Array(2, "Day",  "", -1)
				)
			),
			$this->ptRoomSize => array(
				"Ident" => DENON_API_Commands::PSRSZ,
				"Name" => "Room Size",
				"Profilesettings" => Array("Sofa", "", "", 0, 4, 0, 0),
				"Associations" => Array(
				Array(0, "Small",  "", -1),
				Array(1, "Small/Medium",  "", -1),
				Array(2, "Medium",  "", -1),
				Array(3, "Medium/Large",  "", -1),
				Array(4, "Large",  "", -1)
				)
			),
			$this->ptDynamicCompressor => array(
				"Ident" => DENON_API_Commands::PSDCO,
				"Name" => "Dynamic Compressor",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Low",  "", -1),
				Array(2, "Middle",  "", -1),
				Array(3, "High",  "", -1)
				)
			),
			$this->ptDRCDirectChange => array(
				"Ident" => DENON_API_Commands::PSDRC,
				"Name" => "Dynamic Range Compression",
				"Profilesettings" => Array("Intensity", "", "", 0, 4, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Auto",  "", -1),
				Array(2, "Low",  "", -1),
				Array(3, "Middle",  "", -1),
				Array(4, "High",  "", -1)
				)
			),
			$this->ptVideoSelect => array(
				"Ident" => DENON_API_Commands::SV,
				"Name" => "Video Select",
				"Profilesettings" => Array("Database", "", "", 0, 8, 0, 0),
				"Associations" => Array(
				Array(0, "DVD",  "", -1),
				Array(1, "BD",  "", -1),
				Array(2, "TV",  "", -1),
				Array(3, "Sat/CBL",  "", -1),
				Array(4, "DVR",  "", -1),
				Array(5, "Game",  "", -1),
				Array(6, "V.AUX",  "", -1),
				Array(7, "Dock",  "", -1),
				Array(8, "Source",  "", -1)
				)
			),
			$this->ptSurroundBackMode => array(
				"Ident" => DENON_API_Commands::PSSB,
				"Name" => "Surround Back Mode",
				"Profilesettings" => Array("Database", "", "", 0, 4, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "On",  "", -1),
				Array(2, "Matrix On",  "", -1),
				Array(3, "PL2X Cinema",  "", -1),
				Array(4, "PL2X Music",  "", -1)
				)
			),
			$this->ptHDMIMonitor => array(
				"Ident" => DENON_API_Commands::VSMONI,
				"Name" => "HDMI Monitor",
				"Profilesettings" => Array("TV", "", "", 0, 2, 0, 0),
				"Associations" => Array(
				Array(0, "Auto",  "", -1),
				Array(1, "Monitor 1",  "", -1),
				Array(2, "Monitor 2",  "", -1)
				)
			),
			$this->ptSpeakerOutputFront => array(
				"Ident" => DENON_API_Commands::PSSP,
				"Name" => "Speaker Output Front",
				"Profilesettings" => Array("Speaker", "", "", 0, 3, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Front Height",  "", -1),
				Array(2, "Front Wide",  "", -1),
				Array(3, "Height/Wide",  "", -1)
				)
			),
			$this->ptReferenceLevel => array(
				"Ident" => DENON_API_Commands::PSREFLEV,
				"Name" => "Reference Level",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 0, 0),
				"Associations" => Array(
				Array(0, "Offset 0",  "", -1),
				Array(1, "Offset 5",  "", -1),
				Array(2, "Offset 10",  "", -1),
				Array(3, "Offset 15",  "", -1)
				)
			),
			$this->ptPLIIZHeightGain => array(
				"Ident" => DENON_API_Commands::PSPHG,
				"Name" => "PLIIZ Height Gain",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 0, 0),
				"Associations" => Array(
				Array(0, "Low",  "", -1),
				Array(1, "Middle",  "", -1),
				Array(2, "High",  "", -1)
				)
			),
			$this->ptDolbyVolumeModeler => array(
				"Ident" => DENON_API_Commands::PSVOLMOD,
				"Name" => "Dolby Volume Modeler",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 0, 0),
				"Associations" => Array(
				Array(0, "Off",  "", -1),
				Array(1, "Half",  "", -1),
				Array(2, "Full",  "", -1)
				)
			),
			$this->ptDolbyVolumeLeveler => array(
				"Ident" => DENON_API_Commands::PSVOLLEV,
				"Name" => "Dolby Volume Leveler",
				"Profilesettings" => Array("Intensity", "", "", 0, 2, 0, 0),
				"Associations" => Array(
				Array(0, "Low",  "", -1),
				Array(1, "Middle",  "", -1),
				Array(2, "High",  "", -1)
				)
			),
			$this->ptVideoProcessingMode => array(
				"Ident" => DENON_API_Commands::VSVPM,
				"Name" => "Video Processing Mode",
				"Profilesettings" => Array("Database", "", "", 0, 2, 0, 0),
				"Associations" => Array(
				Array(0, "Auto",  "", -1),
				Array(1, "Game",  "", -1),
				Array(2, "Movie",  "", -1)
				)
			),
			$this->ptHDMIAudioOutput => array(
				"Ident" => DENON_API_Commands::VSAUDIO,
				"Name" => "HDMI Audio Output",
				"Profilesettings" => Array("TV", "", "", 0, 1, 0, 0),
				"Associations" => Array(
				Array(0, "TV",  "", -1),
				Array(1, "AMP",  "", -1)
				)
			),
			$this->ptResolutionHDMI => array(
				"Ident" => DENON_API_Commands::VSSCH,
				"Name" => "Resolution HDMI",
				"Profilesettings" => Array("TV", "", "", 0, 5, 0, 0),
				"Associations" => Array(
				Array(0, "480p/576p",  "", -1),
				Array(1, "1080i",  "", -1),
				Array(2, "720p",  "", -1),
				Array(3, "1080p",  "", -1),
				Array(4, "1080p 24Hz",  "", -1),
				Array(5, "Auto", "", -1)
				)
			),
			$this->ptResolution => array(
				"Ident" => DENON_API_Commands::VSSC,
				"Name" => "Resolution",
				"Profilesettings" => Array("TV", "", "", 0, 5, 0, 0),
				"Associations" => Array(
				Array(0, "480p/576p",  "", -1),
				Array(1, "1080i",  "", -1),
				Array(2, "720p",  "", -1),
				Array(3, "1080p",  "", -1),
				Array(4, "1080p 24Hz",  "", -1),
				Array(5, "Auto", "", -1)
				)
			),
			$this->ptASP => array(
				"Ident" => DENON_API_Commands::VSASP,
				"Name" => "ASP",
				"Profilesettings" => Array("Intensity", "", "", 0, 1, 0, 0),
				"Associations" => Array(
				Array(0, "Normal",  "", -1),
				Array(1, "Full",  "", -1)
				)
			),
			$this->ptDNRDirectChange => array(
				"Ident" => DENON_API_Commands::PVDNR,
				"Name" => "Digital Noise Reduction",
				"Profilesettings" => Array("Intensity", "", "", 0, 3, 0, 0),
				"Associations" => Array(
				Array(0, "OFF",  "", -1),
				Array(1, "Low",  "", -1),
				Array(2, "Middle",  "", -1),
				Array(3, "High",  "", -1)
				)
			),
			$this->ptInputMode => array(
				"Ident" => DENON_API_Commands::SD,
				"Name" => "Input Mode",
				"Profilesettings" => Array("Database", "", "", 0, 4, 0, 0),
				"Associations" => Array(
				Array(0, "AUTO",  "", -1),
				Array(1, "HDMI",  "", -1),
				Array(2, "DIGITAL",  "", -1),
				Array(3, "ANALOG",  "", -1),
				Array(4, "Ext.IN",  "", -1),				
				)
			)
		);
	
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W")
			{
				$ProfilAssociationsMainZone[$this->ptAuroMatic3DPreset] = array(
												"Ident" => DENON_API_Commands::PSAUROPR,
												"Name" => "Auro-Matic 3D Preset",
												"Profilesettings" => Array("Intensity",  "", "", 0, 3, 1, 0),
												"Associations" => Array(
												Array(0, "Small", "", -1),
												Array(1, "Medium", "", -1),
												Array(2, "Large", "", -1),
												Array(3, "SPE", "", -1)
												)
												);
			}	
		
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-X1100W" || $AVRType == "S700W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W" || $AVRType == "AVR-2200W" || $AVRType == "AVR-1200W")
			{
				$ProfilAssociationsMainZone[$this->ptMAINZONEAutoStandbySetting] = array(
												"Ident" => DENON_API_Commands::STBY,
												"Name" => "Mainzone Auto Standby",
												"Profilesettings" => Array("Intensity",  "", "", 0, 3, 1, 0),
												"Associations" => Array(
												Array(0, "Off", "", -1),
												Array(1, "15 Min", "", -1),
												Array(2, "30 Min", "", -1),
												Array(3, "60 Min", "", -1)
												)
												);
												
				$ProfilAssociationsMainZone[$this->ptMAINZONEECOModeSetting] = array(
												"Ident" => DENON_API_Commands::ECO,
												"Name" => "Mainzone ECO Mode",
												"Profilesettings" => Array("Intensity",  "", "", 0, 2, 1, 0),
												"Associations" => Array(
												Array(0, "Off", "", -1),
												Array(1, "Auto", "", -1),
												Array(2, "On", "", -1)
												)
												);

				$ProfilAssociationsMainZone[$this->ptDimmer] = array(
												"Ident" => DENON_API_Commands::DIM,
												"Name" => "Dimmer",
												"Profilesettings" => Array("Intensity",  "", "", 0, 3, 1, 0),
												"Associations" => Array(
												Array(0, "Off", "", -1),
												Array(1, "Dark", "", -1),
												Array(2, "Dim", "", -1),
												Array(3, "Bright", "", -1)
												)
												);									
			}
		
		if ($AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-2200W")
			{
			   $ProfilAssociationsMainZone[$this->ptResolutionHDMI] = array(
												"Ident" => DENON_API_Commands::VSSCH,
												"Name" => "Resolution HDMI",
												"Profilesettings" => Array("TV", "", "", 0, 6, 0, 0),
												"Associations" => Array(
												Array(0, "480p/576p",  "", -1),
												Array(1, "1080i",  "", -1),
												Array(2, "720p",  "", -1),
												Array(3, "1080p",  "", -1),
												Array(4, "1080p 24Hz",  "", -1),
												Array(5, "4K", "", -1),
												Array(6, "Auto", "", -1)
												)
												);
				$ProfilAssociationsMainZone[$this->ptResolution] = array(
												"Ident" => DENON_API_Commands::VSSC,
												"Name" => "Resolution",
												"Profilesettings" => Array("TV", "", "", 0, 6, 0, 0),
												"Associations" => Array(
												Array(0, "480p/576p",  "", -1),
												Array(1, "1080i",  "", -1),
												Array(2, "720p",  "", -1),
												Array(3, "1080p",  "", -1),
												Array(4, "1080p 24Hz",  "", -1),
												Array(5, "4K", "", -1),
												Array(6, "Auto", "", -1)
												)
												);
			}

		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W")
			{
			   $ProfilAssociationsMainZone[$this->ptResolutionHDMI] = array(
												"Ident" => DENON_API_Commands::VSSCH,
												"Name" => "Resolution HDMI",
												"Profilesettings" => Array("TV", "", "", 0, 7, 0, 0),
												"Associations" => Array(
												Array(0, "480p/576p",  "", -1),
												Array(1, "1080i",  "", -1),
												Array(2, "720p",  "", -1),
												Array(3, "1080p",  "", -1),
												Array(4, "1080p 24Hz",  "", -1),
												Array(5, "4K", "", -1),
												Array(6, "4K(60/50)", "", -1),
												Array(7, "Auto", "", -1)
												)
												);
				$ProfilAssociationsMainZone[$this->ptResolution] = array(
												"Ident" => DENON_API_Commands::VSSC,
												"Name" => "Resolution",
												"Profilesettings" => Array("TV", "", "", 0, 7, 0, 0),
												"Associations" => Array(
												Array(0, "480p/576p",  "", -1),
												Array(1, "1080i",  "", -1),
												Array(2, "720p",  "", -1),
												Array(3, "1080p",  "", -1),
												Array(4, "1080p 24Hz",  "", -1),
												Array(5, "4K", "", -1),
												Array(6, "4K(60/50)", "", -1),
												Array(7, "Auto", "", -1)
												)
												);
				$ProfilAssociationsMainZone[$this->ptSurroundMode] = array(
												"Ident" => DENON_API_Commands::MS,
												"Name" => "Surround Mode",
												"Profilesettings" => Array("Melody", "", "", 0, 20, 0, 0),
												"Associations" => Array(
												Array(0, "Direct",  "", -1),
												Array(1, "Pure Direct",  "", -1),
												Array(2, "Stereo",  "", -1),
												Array(3, "Auto",  "", -1),
												Array(4, "Dolby Digital",  "", -1),
												Array(5, "DTS Surround",  "", -1),
												Array(6, "Auro 3D",  "", -1),
												Array(7, "Auro 2D Surround",  "", -1),
												Array(8, "Multichannel Stereo",  "", -1),
												Array(9, "Widescreen",  "", -1),
												Array(10, "Superstadium",  "", -1),
												Array(11, "Rock Arena",  "", -1),
												Array(12, "Jazz Club",  "", -1),
												Array(13, "Classic Concert",  "", -1),
												Array(14, "Mono Movie",  "", -1),
												Array(15, "Matrix",  "", -1),
												Array(16, "Video Game",  "", -1),
												Array(17, "Virtual",  "", -1),
												Array(18, "Movie",  "", -1),
												Array(19, "Music",  "", -1),
												Array(20, "Game",  "", -1)
												)
											);
			}
		
		$ProfilAssociationsMainZone[$this->ptInputSource] = $this->UsedInputSources;
			/*	
				array(
				"Ident" => DENON_API_Commands::SI,
				"Name" => "Input Source",
				"Profilesettings" => Array("Database", "", "", 0, 19, 0, 0),
				"Associations" => array(
				Array(0, "Phono",  "", -1),
				Array(1, "CD",  "", -1),
				Array(2, "Tuner",  "", -1),
				Array(3, "DVD",  "", -1),
				Array(4, "BD",  "", -1),
				Array(5, "TV",  "", -1),
				Array(6, "Sat/CBL",  "", -1),
				Array(7, "DVR",  "", -1),
				Array(8, "Game",  "", -1),
				Array(9, "V.Aux",  "", -1),
				Array(10, "Dock",  "", -1),
				Array(11, "IPod",  "", -1),
				Array(12, "Net/USB",  "", -1),
				Array(13, "Napster",  "", -1),
				Array(14, "LastFM",  "", -1),
				Array(15, "Flickr",  "", -1),
				Array(16, "Favorites",  "", -1),
				Array(17, "IRadio",  "", -1),
				Array(18, "Server",  "", -1),
				Array(19, "USB/IPod",  "", -1)
				)
			),*/
			
		
		
		
		
		$ProfilAssociationsZone2 = array
		(	
			/*
			$this->ptZone2InputSource => array(
				"Ident" => DENON_API_Commands::Z2,
				"Name" => "Zone 2 Input Source",
				"Profilesettings" => Array("Database", "", "", 0, 19, 1, 0),
				"Associations" => Array(
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
				)
			),
			*/
			$this->ptSurroundMode => array(
				"Ident" => DENON_API_Commands::MS,
				"Name" => "Surround Mode",
				"Profilesettings" => Array("Melody", "", "", 0, 15, 0, 0),
				"Associations" => Array(
				Array(0, "Direct",  "", -1),
				Array(1, "Pure Direct",  "", -1),
				Array(2, "Stereo",  "", -1),
				Array(3, "Standard",  "", -1),
				Array(4, "Dolby Digital",  "", -1),
				Array(5, "DTS Surround",  "", -1),
				Array(6, "Multichannel Stereo",  "", -1),
				Array(7, "Widescreen",  "", -1),
				Array(8, "Superstadium",  "", -1),
				Array(9, "Rock Arena",  "", -1),
				Array(10, "Jazz Club",  "", -1),
				Array(11, "Classic Concert",  "", -1),
				Array(12, "Mono Movie",  "", -1),
				Array(13, "Matrix",  "", -1),
				Array(14, "Video Game",  "", -1),
				Array(15, "Virtual",  "", -1)
				)
			),
			$this->ptNavigation => array(
				"Ident" => DENON_API_Commands::MN,
				"Name" => "Navigation",
				"Profilesettings" => Array("Move", "", "", 0, 5, 0, 0),
				"Associations" => array(
				Array(0, "Left",  "", -1),
				Array(1, "Down",  "", -1),
				Array(2, "Up",  "", -1),
				Array(3, "Right",  "", -1),
				Array(4, "Enter",  "", -1),
				Array(5, "Return",  "", -1)
				)		
			),
			$this->ptZone2ChannelSetting => array(
				"Ident" => DENON_API_Commands::Z2CS,
				"Name" => "Zone 2 Channel Setting",
				"Profilesettings" => Array("Database", "", "", 0, 1, 0, 0),
				"Associations" => Array(
				Array(0, "Stereo",  "", -1),
				Array(1, "Mono",  "", -1)
				)
			),
			$this->ptZone2QuickSelect => array(
				"Ident" => DENON_API_Commands::Z2QUICK,
				"Name" => "Zone 2 Quick Selektion",
				"Profilesettings" => Array("Database", "", "", 0, 5, 0, 0),
				"Associations" => Array(
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
				)
			)
		);
		
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-X1100W" || $AVRType == "S700W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W" || $AVRType == "AVR-2200W" || $AVRType == "AVR-1200W")
			{
				$ProfilAssociationsZone2[$this->ptZONE2AutoStandbySetting] = array(
												"Ident" => DENON_API_Commands::Z2STBY,
												"Name" => "Zone 2 Auto Standby",
												"Profilesettings" => Array("Intensity",  "", "", 0, 3, 1, 0),
												"Associations" => Array(
												Array(0, "Off", "", -1),
												Array(1, "2 h", "", -1),
												Array(2, "4 h", "", -1),
												Array(3, "8 h", "", -1)
												)
												);
				$ProfilAssociationsZone2[$this->ptSurroundMode] = array(
												"Ident" => DENON_API_Commands::MS,
												"Name" => "Surround Mode",
												"Profilesettings" => Array("Melody", "", "", 0, 20, 0, 0),
												"Associations" => Array(
												Array(0, "Direct",  "", -1),
												Array(1, "Pure Direct",  "", -1),
												Array(2, "Stereo",  "", -1),
												Array(3, "Auto",  "", -1),
												Array(4, "Dolby Digital",  "", -1),
												Array(5, "DTS Surround",  "", -1),
												Array(6, "Auro 3D",  "", -1),
												Array(7, "Auro 2D Surround",  "", -1),
												Array(8, "Multichannel Stereo",  "", -1),
												Array(9, "Widescreen",  "", -1),
												Array(10, "Superstadium",  "", -1),
												Array(11, "Rock Arena",  "", -1),
												Array(12, "Jazz Club",  "", -1),
												Array(13, "Classic Concert",  "", -1),
												Array(14, "Mono Movie",  "", -1),
												Array(15, "Matrix",  "", -1),
												Array(16, "Video Game",  "", -1),
												Array(17, "Virtual",  "", -1),
												Array(18, "Movie",  "", -1),
												Array(19, "Music",  "", -1),
												Array(20, "Game",  "", -1)
												)
											);									
			}
		
		$ProfilAssociationsZone2[$this->ptZone2InputSource] = $this->UsedInputSourcesZ2;
		
		$ProfilAssociationsZone3 = array
		(
			/*
			$this->ptZone3InputSource => array(
				"Ident" => DENON_API_Commands::Z3,
				"Name" => "Zone 3 Input Source",
				"Profilesettings" => Array("Database", "", "", 0, 19, 1, 0),
				"Associations" => Array(
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
				)
			),
			*/
			$this->ptSurroundMode => array(
				"Ident" => DENON_API_Commands::MS,
				"Name" => "Surround Mode",
				"Profilesettings" => Array("Melody", "", "", 0, 15, 0, 0),
				"Associations" => Array(
				Array(0, "Direct",  "", -1),
				Array(1, "Pure Direct",  "", -1),
				Array(2, "Stereo",  "", -1),
				Array(3, "Standard",  "", -1),
				Array(4, "Dolby Digital",  "", -1),
				Array(5, "DTS Surround",  "", -1),
				Array(6, "Multichannel Stereo",  "", -1),
				Array(7, "Widescreen",  "", -1),
				Array(8, "Superstadium",  "", -1),
				Array(9, "Rock Arena",  "", -1),
				Array(10, "Jazz Club",  "", -1),
				Array(11, "Classic Concert",  "", -1),
				Array(12, "Mono Movie",  "", -1),
				Array(13, "Matrix",  "", -1),
				Array(14, "Video Game",  "", -1),
				Array(15, "Virtual",  "", -1)
				)
			),
			$this->ptNavigation => array(
				"Ident" => DENON_API_Commands::MN,
				"Name" => "Navigation",
				"Profilesettings" => Array("Move", "", "", 0, 5, 0, 0),
				"Associations" => array(
				Array(0, "Left",  "", -1),
				Array(1, "Down",  "", -1),
				Array(2, "Up",  "", -1),
				Array(3, "Right",  "", -1),
				Array(4, "Enter",  "", -1),
				Array(5, "Return",  "", -1)
				)		
			),
			$this->ptZone3ChannelSetting => array(
				"Ident" => DENON_API_Commands::Z3CS,
				"Name" => "Zone 3 Channel Setting",
				"Profilesettings" => Array("Database", "", "", 0, 1, 0, 0),
				"Associations" => Array(
				Array(0, "Stereo",  "", -1),
				Array(1, "Mono",  "", -1)
				)
			),
			$this->ptZone3QuickSelect => array(
				"Ident" => DENON_API_Commands::Z3QUICK,
				"Name" => "Zone 3 Quick Select",
				"Profilesettings" => Array("DataMainbase", "", "", 0, 5, 0, 0),
				"Associations" => Array(
				Array(0, "NONE",  "", -1),
				Array(1, "QS 1",  "", -1),
				Array(2, "QS 2",  "", -1),
				Array(3, "QS 3",  "", -1),
				Array(4, "QS 4",  "", -1),
				Array(5, "QS 5",  "", -1)
				)
			)
		);
		
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-X1100W" || $AVRType == "S700W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W" || $AVRType == "AVR-2200W" || $AVRType == "AVR-1200W")
			{
				$ProfilAssociationsZone3[$this->ptZONE3AutoStandbySetting] = array(
												"Ident" => DENON_API_Commands::Z2STBY,
												"Name" => "Zone 3 Auto Standby",
												"Profilesettings" => Array("Intensity",  "", "", 0, 3, 1, 0),
												"Associations" => Array(
												Array(0, "Off", "", -1),
												Array(1, "2 h", "", -1),
												Array(2, "4 h", "", -1),
												Array(3, "8 h", "", -1)
												)
												);
				$ProfilAssociationsZone3[$this->ptSurroundMode] = array(
												"Ident" => DENON_API_Commands::MS,
												"Name" => "Surround Mode",
												"Profilesettings" => Array("Melody", "", "", 0, 20, 0, 0),
												"Associations" => Array(
												Array(0, "Direct",  "", -1),
												Array(1, "Pure Direct",  "", -1),
												Array(2, "Stereo",  "", -1),
												Array(3, "Auto",  "", -1),
												Array(4, "Dolby Digital",  "", -1),
												Array(5, "DTS Surround",  "", -1),
												Array(6, "Auro 3D",  "", -1),
												Array(7, "Auro 2D Surround",  "", -1),
												Array(8, "Multichannel Stereo",  "", -1),
												Array(9, "Widescreen",  "", -1),
												Array(10, "Superstadium",  "", -1),
												Array(11, "Rock Arena",  "", -1),
												Array(12, "Jazz Club",  "", -1),
												Array(13, "Classic Concert",  "", -1),
												Array(14, "Mono Movie",  "", -1),
												Array(15, "Matrix",  "", -1),
												Array(16, "Video Game",  "", -1),
												Array(17, "Virtual",  "", -1),
												Array(18, "Movie",  "", -1),
												Array(19, "Music",  "", -1),
												Array(20, "Game",  "", -1)
												)
											);											
			}
		
		$ProfilAssociationsZone3[$this->ptZone3InputSource] = $this->UsedInputSourcesZ3;
		
		if($this->Zone == 0)
		{
			$profileintegerass = $this->sendprofileintegerass($ProfilAssociationsMainZone, $profile);
			return $profileintegerass;
		}
		elseif ($this->Zone == 1)
		{
			$profileintegerass = $this->sendprofileintegerass($ProfilAssociationsZone2, $profile);
			return $profileintegerass;
		}
		elseif ($this->Zone == 2)
		{
			$profileintegerass = $this->sendprofileintegerass($ProfilAssociationsZone3, $profile);
			return $profileintegerass;
		}
		
		
	}
	
	private function sendprofileintegerass($ProfilAssociationsZone, $profile)
	{
		foreach($ProfilAssociationsZone as $ptName => $profilvar)
			{
				if($ptName == $profile)
				{
					$pos = $this->getpos($profile);
				    $profilesettings = $profilvar["Profilesettings"];
					$Ident = $profilvar["Ident"];
					$Name = $profilvar["Name"];
					$profileintegerass = array(
					"ProfilName" => $ptName,
					"Ident" => $Ident,
					"Name" => $Name,
					"Icon" => $profilesettings[0],
					"Prefix" => $profilesettings[1],
					"Suffix" => $profilesettings[2],
					"MinValue" => $profilesettings[3],
					"MaxValue" => $profilesettings[4],
					"Stepsize" => $profilesettings[5],
					"Digits" => $profilesettings[6],
					"Associations" => $profilvar["Associations"],
					"Position" => $pos
				   );
				   
				   return $profileintegerass;
				}

			}	
	}
	
	
	public function SetupVarDenonFloat($profile, $AVRType)
	{
		//Sichtbare variablen profil suchen
		$profilesMainZone = array(
		$this->ptMasterVolume => array(DENON_API_Commands::MV, "Master Volume", "Intensity", "", " dB", -80.0, 18.0, 0.5, 1),
		$this->ptChannelVolumeFL => array(DENON_API_Commands::CVFL, "Channel Volume Front Left", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeFR => array(DENON_API_Commands::CVFR, "Channel Volume Front Right", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeC => array(DENON_API_Commands::CVC, "Channel Volume Center", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeSW => array(DENON_API_Commands::CVSW, "Channel Volume Subwoofer", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeSW2 => array(DENON_API_Commands::CVSW2, "Channel Volume Subwoofer 2", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeSL => array(DENON_API_Commands::CVSL, "Channel Volume Surround Left", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeSR => array(DENON_API_Commands::CVSR, "Channel Volume Surround Right", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeSBL => array(DENON_API_Commands::CVSBL, "Channel Volume Surround Back Left", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeSBR => array(DENON_API_Commands::CVSBR, "Channel Volume Surround Back Right", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeSB => array(DENON_API_Commands::CVSB, "Channel Volume Surround Back", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeFHL => array(DENON_API_Commands::CVFHL, "Channel Volume Front Height Left", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeFHR => array(DENON_API_Commands::CVFHR, "Channel Volume Front Height Right", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeFWL => array(DENON_API_Commands::CVFWL, "Channel Volume Front Wide Left", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptChannelVolumeFWR => array(DENON_API_Commands::CVFWR, "Channel Volume Front Wide Right", "Intensity", "", " dB", -12, 12, 0.5, 1),
		$this->ptAudioDelay => array(DENON_API_Commands::PSDELAY, "Audio Delay", "Intensity", "", " ms", 0, 200, 1, 0),
		$this->ptLFELevel => array(DENON_API_Commands::PSLFE, "LFE Level", "Intensity", "-", " dB", -10.0, 0.0, 0.5, 1),
		$this->ptBassLevel => array(DENON_API_Commands::PSBAS, "Bass Level", "Intensity", "", " dB", -6, 6, 0.5, 1),
		$this->ptTrebleLevel => array(DENON_API_Commands::PSTRE, "Treble Level", "Intensity", "", " dB", -6, 6, 0.5, 1),
		$this->ptCenterWidth => array(DENON_API_Commands::PSCEN, "Center Width", "Intensity",  "", "", 0, 7, 0.5, 1),
		$this->ptEffectLevel => array(DENON_API_Commands::PSEFF, "Effect Level", "Intensity", "", "", 0, 15, 0.5, 1),
		$this->ptCenterImage => array(DENON_API_Commands::PSCEI, "Center Image", "Intensity", "", "", 0.0, 1.0, 0.1, 1),
		$this->ptContrast => array(DENON_API_Commands::PVCN, "Contrast", "Intensity", "", "", -6, 6, 0.5, 1),
		$this->ptBrightness => array(DENON_API_Commands::PVBR, "Brightness", "Intensity", "", "", 0, 12, 0.5, 1),
		$this->ptChromalevel => array(DENON_API_Commands::PVCM, "Chroma Level", "Intensity", "", "", -6, 6, 0.5, 1),
		$this->ptHue => array(DENON_API_Commands::PVHUE, "Hue", "Intensity", "", "", -6, 6, 0.5, 1),
		$this->ptEnhancer => array(DENON_API_Commands::PVENH, "Enhancer", "Intensity", "", "", 0, 12, 0.5, 1),
		$this->ptStageHeight => array(DENON_API_Commands::PSSTH, "Stage Height", "Intensity", "", "", -10, 10, 0.5, 1),
		$this->ptStageWidth => array(DENON_API_Commands::PSSTW, "Stage Width", "Intensity", "", "", -10, 10, 0.5, 1)
		);
		
		
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W")
		{
			$profilesMainZone[$this->ptSurroundHeightLch] = array(
												DENON_API_Commands::CVSHL,
												"Surround Height Left",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);
						
			$profilesMainZone[$this->ptSurroundHeightRch] = array(
												DENON_API_Commands::CVSHR,
												"Surround Height Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);
												
			$profilesMainZone[$this->ptTopSurround] = array(
												DENON_API_Commands::CVTS,
												"Top Surround",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);																		
		}
		
		
			
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W")
		{
			$profilesMainZone[$this->ptTopFrontLch] = array(
												DENON_API_Commands::CVTFL,
												"Top Front Left",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);
			
			$profilesMainZone[$this->ptTopFrontRch] = array(
												DENON_API_Commands::CVTFR,
												"Top Front Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);
			
			$profilesMainZone[$this->ptTopMiddleLch] = array(
												DENON_API_Commands::CVTML,
												"Top Middle Left",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);
			
			$profilesMainZone[$this->ptTopMiddleRch] = array(
												DENON_API_Commands::CVTMR,
												"Top Middle Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);
			
			$profilesMainZone[$this->ptTopRearLch] = array(
												DENON_API_Commands::CVTRL,
												"Top Rear Left",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);

			$profilesMainZone[$this->ptTopRearRch] = array(
												DENON_API_Commands::CVTRR,
												"Top Rear Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);										
			
			$profilesMainZone[$this->ptRearHeightLch] = array(
												DENON_API_Commands::CVRHL,
												"Rear Height Left",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);	

			$profilesMainZone[$this->ptRearHeightRch] = array(
												DENON_API_Commands::CVRHR,
												"Rear Height Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);											
				
			$profilesMainZone[$this->ptFrontDolbyLch] = array(
												DENON_API_Commands::CVFDL,
												"Front Dolby Left",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);	
			
			$profilesMainZone[$this->ptFrontDolbyRch] = array(
												DENON_API_Commands::CVFDR,
												"Front Dolby Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);	
			
			$profilesMainZone[$this->ptSurroundDolbyLch] = array(
												DENON_API_Commands::CVSDL,
												"Surround Dolby Left",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);	
			
			$profilesMainZone[$this->ptSurroundDolbyRch] = array(
												DENON_API_Commands::CVSDR,
												"Surround Dolby Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);	
			
			$profilesMainZone[$this->ptBackDolbyLch] = array(
												DENON_API_Commands::CVBDL,
												"Front Dolby Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);	
												
			$profilesMainZone[$this->ptBackDolbyRch] = array(
												DENON_API_Commands::CVBDR,
												"Front Dolby Right",
												"Intensity",  "", " dB", -12, 12, 0.5, 1);	
			}	
		
		$profilesZone2 = array(
		$this->ptZone2Volume => array(DENON_API_Commands::Z2VOL, "Zone 2 Volume", "Intensity", "", " %", -80.0, 18.0, 0.5, 1),
		$this->ptZone2ChannelVolumeFL => array(DENON_API_Commands::Z2CVFL, "Zone 2 Channel Volume Front Left", "Intensity", "", " %", -10.0, 10.0, 0.5, 1),
		$this->ptZone2ChannelVolumeFR => array(DENON_API_Commands::Z2CVFR, "Zone 2 Channel Volume Front Right", "Intensity", "", " %", -10.0, 10.0, 0.5, 1)
		);
		
		$profilesZone3 = array(
		$this->ptZone3Volume => array(DENON_API_Commands::Z3VOL, "Zone 3 Volume", "Intensity", "", " %", -80.0, 18.0, 0.5, 1),
		$this->ptZone3ChannelVolumeFL => array(DENON_API_Commands::Z3CVFL, "Zone 3 Channel Volume Front Left", "Intensity", "", " %", -10.0, 10.0, 0.5, 1),
		$this->ptZone3ChannelVolumeFR => array(DENON_API_Commands::Z3CVFR, "Zone 3 Channel Volume Front Right", "Intensity", "", " %", -10.0, 10.0, 0.5, 1)
		);
		
		if ($this->Zone == 0)
		{
			$profilefloat = $this->sendprofilefloat($profilesMainZone, $profile);
			return $profilefloat;
		}
		elseif ($this->Zone == 1)
		{
			$profilefloat = $this->sendprofilefloat($profilesZone2, $profile);
			return $profilefloat;
		}
		elseif ($this->Zone == 2)
		{
			$profilefloat = $this->sendprofilefloat($profilesZone3, $profile);
			return $profilefloat;
		}
	}

	
	private function sendprofilefloat($profilesZone, $profile)
	{
		foreach($profilesZone as $ptName => $profilvar)
		{
			if($ptName == $profile)
			{
				$pos = $this->getpos($profile);
				$Ident = $profilvar[0];
				$Name = $profilvar[1];
				$profilefloat = array(
				"ProfilName" => $ptName,
				"Name" => $Name,
				"Ident" => $Ident,
				"Icon" => $profilvar[2],
				"Prefix" => $profilvar[3],
				"Suffix" => $profilvar[4],
				"MinValue" => $profilvar[5],
				"MaxValue" => $profilvar[6],
				"Stepsize" => $profilvar[7],
				"Digits" => $profilvar[8],
				"Position" => $pos
			   
			   
			   );
			   
			   return $profilefloat;
			}

		}	
	}
	
	private function getpos($profile)
	{
		$positions = array 
						( 
                            $this->ptPower => 10,
							$this->ptMainZonePower => 11,
							$this->ptMainMute => 12,
							$this->ptMasterVolume => 13,
							$this->ptInputSource => 14,
							$this->ptSurroundMode => 15,
							$this->ptSurroundDisplay => 16,
							$this->ptNavigation => 17,
							$this->ptDynamicVolume => 18,
							$this->ptDolbyVolume => 19,
							$this->ptDolbyVolumeLeveler => 20,
							$this->ptDolbyVolumeModeler => 21,
							$this->ptDynamicCompressor => 22,
							$this->ptDynamicRange => 23,
							$this->ptDRCDirectChange => 24,
							$this->ptAudysseyDSX => 25,
							$this->ptCinemaEQ => 26,
							$this->ptPanorama => 27,
							$this->ptNavigation => 28,
							$this->ptDynamicEQ => 29,
							$this->ptSleep => 30,
							$this->ptQuickSelect => 31,
							$this->ptDisplay => 32,
							//Lautsprecher
							$this->ptChannelVolumeFL => 40,
							$this->ptChannelVolumeFR => 41,
							$this->ptChannelVolumeC => 42,
							$this->ptChannelVolumeSW => 43,
							$this->ptChannelVolumeSW2 => 44,
							$this->ptChannelVolumeSL => 45,
							$this->ptChannelVolumeSR => 46,
							$this->ptChannelVolumeSBL => 47,
							$this->ptChannelVolumeSBR => 48,
							$this->ptChannelVolumeSB => 49,
							$this->ptChannelVolumeFHL => 50,
							$this->ptChannelVolumeFHR => 51,
							$this->ptChannelVolumeFWL => 52,
							$this->ptChannelVolumeFWR => 53,
							
							$this->ptTopFrontLch => 54,
							$this->ptTopFrontRch => 55,
							$this->ptTopMiddleLch => 56,
							$this->ptTopMiddleRch => 57,
							$this->ptTopRearLch => 58,
							$this->ptTopRearRch => 59,
							$this->ptRearHeightLch => 60,
							$this->ptRearHeightRch => 61,
							$this->ptFrontDolbyLch => 62,
							$this->ptFrontDolbyRch => 63,
							$this->ptSurroundDolbyLch => 64,
							$this->ptSurroundDolbyRch => 65,
							$this->ptBackDolbyLch => 66,
							$this->ptBackDolbyRch => 67,
							$this->ptSurroundDolbyLch => 68,
							$this->ptSurroundDolbyRch => 69,
							$this->ptTopSurround => 70,
											
							$this->ptSubwoofer => 71,
							$this->ptSubwooferATT => 72,
							$this->ptFrontHeight => 73,
							$this->ptToneCTRL => 74,
							$this->ptAudioDelay => 75,
							$this->ptSpeakerOutputFront => 76,
							$this->ptGraphicEQ => 77,
							$this->ptDialogLevelAdjust => 78,
							$this->ptCenterspread => 79,
														
							$this->ptAFDM => 80,
							$this->ptASP => 81,
							$this->ptAudioRestorer => 82,
							$this->ptCenterImage => 83,
							$this->ptCenterWidth => 84,
							$this->ptDigitalInputMode => 85,
							$this->ptDimension => 86,
							$this->ptEffect => 87,
							$this->ptEffectLevel => 88,
							$this->ptHDMIAudioOutput => 89,
							$this->ptInputMode => 90,
							$this->ptMultiEQMode => 91,
							$this->ptPLIIZHeightGain => 92,
							$this->ptPreset => 93,
							$this->ptReferenceLevel => 94,
							$this->ptRoomSize => 95,
							$this->ptStageWidth => 96,
							$this->ptStageHeight => 97,
							$this->ptSurroundBackMode => 98,
							$this->ptSurroundPlayMode => 99,
							$this->ptVerticalStretch => 100,
							
							//Level
							$this->ptBassLevel => 101,
							$this->ptTrebleLevel => 102,
							$this->ptLFELevel => 103,
							//Video
							$this->ptVideoSelect => 110,
							$this->ptContrast => 111,
							$this->ptBrightness => 112,
							$this->ptChromalevel => 113,
							$this->ptDNRDirectChange => 114,
							$this->ptEnhancer => 115,
							$this->ptHDMIMonitor => 116,
							$this->ptHue => 117,
							$this->ptResolution => 118,
							$this->ptResolutionHDMI => 119,
							$this->ptVideoProcessingMode => 120,
							//GUI
							$this->ptMainZoneName => 130,
							$this->ptFriendlyName => 131,
							$this->ptModel => 132,
							$this->ptGUIMenu => 133,
							$this->ptGUISourceSelect => 134,
							$this->ptTopMenuLink => 135,
							$this->ptGraphicEQ => 136,
							
							$this->ptDialogLevelAdjust => 137,
							$this->ptCenterspread => 138,
							$this->ptAuroMatic3DStrength => 139,
							$this->ptAuroMatic3DPreset => 140,
							$this->ptMAINZONEAutoStandbySetting => 141,
							$this->ptMAINZONEECOModeSetting => 142,
							$this->ptDimmer => 143,
							
							//Zone 2
							$this->ptZone2Power => 201,
							$this->ptZone2Mute => 202,
							$this->ptZone2Volume => 203,
							$this->ptZone2InputSource => 204,
							$this->ptZone2ChannelSetting => 205,
							$this->ptZone2ChannelVolumeFL => 206,
							$this->ptZone2ChannelVolumeFR => 207,
							$this->ptZone2QuickSelect => 208,
							$this->ptZone2HPF => 209,
							$this->ptZone2Name => 210,
							$this->ptZone2Sleep => 211,
							$this->ptZONE2AutoStandbySetting => 212,
							//Zone 3
							$this->ptZone3Power => 300,
							$this->ptZone3Mute => 301,
							$this->ptZone3Volume => 302,
							$this->ptZone3InputSource => 303,
							$this->ptZone3ChannelSetting => 304,
							$this->ptZone3ChannelVolumeFL => 305,
							$this->ptZone3ChannelVolumeFR => 306,
							$this->ptZone3QuickSelect => 307,
							$this->ptZone3HPF => 308,
							$this->ptZone3Name => 309,
							$this->ptZone3Sleep => 310,
							$this->ptZONE3AutoStandbySetting => 311

						);
		foreach($positions as $ptName => $position)
		{
			if($ptName == $profile)
			{
			   return $position;
			}

		}				
	}
}

class DENON_StatusHTML extends stdClass
{
	public $ipdenon;
	public $InputMapping;
	public $AVRType;	
	//Status
	public function getStates ($InputMapping, $AVRType)
	{
		//Main
		$DataMain = array();
		try { 
			$xmlMainZone = @new SimpleXMLElement(file_get_contents("http://".$this->ipdenon."/goform/formMainZone_MainZoneXml.xml"));
			if ($xmlMainZone)
				{
				$DataMain = $this->MainZoneXml($xmlMainZone, $DataMain, $InputMapping, $AVRType);
				}
			else
				{
				exit("Datei ".$xmlMainZone." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			} 

		try { 
			$xmlMainZoneStatus = @new SimpleXMLElement(file_get_contents("http://".$this->ipdenon."/goform/formMainZone_MainZoneXmlStatus.xml"));
			if ($xmlMainZoneStatus)
				{
				$DataMain = $this->MainZoneXmlStatus($xmlMainZoneStatus, $DataMain, $InputMapping, $AVRType);
				}
			else
				{
				exit("Datei ".$xmlMainZoneStatus." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			} 	

		try { 
			$xmlNetAudioStatus = @new SimpleXMLElement(file_get_contents("http://".$this->ipdenon."/goform/formMainZone_NetAudioStatusXml.xml"));
			if ($xmlNetAudioStatus)
				{
				$DataMain = $this->NetAudioStatusXml($xmlNetAudioStatus, $DataMain);
				}
			else
				{
				exit("Datei ".$xmlNetAudioStatus." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			} 	
		
		
		try { 
			$xmlDeviceinfo = @new SimpleXMLElement(file_get_contents("http://".$this->ipdenon."/goform/formMainZone_Deviceinfo.xml"));
			if ($xmlDeviceinfo)
				{
				$DataMain = $this->Deviceinfo($xmlDeviceinfo, $DataMain);
				}
			else
				{
				exit("Datei ".$xmlDeviceinfo." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}	

		 // Zone 2
		
		$DataZ2 = array();
		try { 
			  $xml = @new SimpleXMLElement(file_get_contents("http://".$this->ipdenon."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE2"));
			  if ($xml)
				{
				$DataZ2 = $this->StateZone2($xml, $DataZ2, $InputMapping, $AVRType);
				}
			else
				{
				exit("Datei ".$xml." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}
	
		// Zone 3
		
		$DataZ3 = array();
		try { 
			$xml = @new SimpleXMLElement(file_get_contents("http://".$this->ipdenon."/goform/formMainZone_MainZoneXml.xml?_=&ZoneName=ZONE3"));
			if ($xml)
				{
				$DataZ3 = $this->StateZone3($xml, $DataZ3, $InputMapping, $AVRType);
				}
			else
				{
				exit("Datei ".$xml." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}
		
		
		//Model
		try { 
			$xmlDeviceSearch = @new SimpleXMLElement(file_get_contents("http://".$this->ipdenon."/goform/formiPhoneAppDeviceSearch.xml"));
			if ($xmlDeviceSearch)
				{
				$DataMain = $this->DeviceSearch($xmlDeviceSearch, $DataMain);
				$DataZ2 = $this->DeviceSearch($xmlDeviceSearch, $DataZ2);
				$DataZ3 = $this->DeviceSearch($xmlDeviceSearch, $DataZ3);
				}
			else
				{
				exit("Datei ".$xmlDeviceSearch." konnte nicht geöffnet werden.");
				}
			}
		catch (Exception $e)
			{ 
			  echo $e->getMessage();
			  //echo "bad xml"; 
			}		
			
		
		$datasend = array(
			'ResponseType' => 'HTTP',
			'Data' => array(
					'Mainzone' => $DataMain,
					'Zone2' => $DataZ2,
					'Zone3' => $DataZ3
					)
			);
			
			return $datasend;
	}
	
	protected function MainZoneXml($xml, $data, $InputMapping, $AVRType)
	{
		
		//FriendlyName
		/*
		$FriendlyName = $xml->xpath('.//FriendlyName');
		if ($FriendlyName)
		{
			$data['FriendlyName'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$FriendlyName[0]->value, 'Subcommand' => 'Denon AVR Name');
		}
		*/
		
		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{	
			$AVRPowerMapping = array("ON" => true, "STANDBY" => false);
			foreach ($AVRPowerMapping as $Command => $AVRPowerValue)
			{
			if ($Command == (string)$AVRPower[0]->value)
				{
				$data[DENON_API_Commands::PW] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $AVRPowerValue, 'Subcommand' => $Command);	
				}
			}	
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$ZonePowerMapping = array("ON" => true, "OFF" => false);
			foreach ($ZonePowerMapping as $Command => $ZonePowerValue)
			{
			if ($Command == (string)$ZonePower[0]->value)
				{
				$data[DENON_API_Commands::ZM] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $ZonePowerValue, 'Subcommand' => $Command);
				}
			}	
		}

		//RenameZone
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$data['MainZoneName'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$RenameZone[0]->value, 'Subcommand' => 'MainZone Name');	
		}



		//TopMenuLink
		/*
		$TopMenuLink = $xml->xpath('.//TopMenuLink');
		if ($TopMenuLink)
		{
			$data['TopMenuLink'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$TopMenuLink[0]->value, 'Subcommand' => 'TopMenu Link');
		}
		*/

		//ModelId
		/*
		$ModelId = $xml->xpath('.//ModelId');
		if ($ModelId)
		{
			$data['ModelId'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$ModelId[0]->value, 'Subcommand' => 'ModelId');
		}
		*/

		//SalesArea
		/*
		$SalesArea = $xml->xpath('.//SalesArea');
		if ($SalesArea)
		{
			$data['SalesArea'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$SalesArea[0]->value, 'Subcommand' => 'SalesArea');
		}
		*/
		
		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
			{	
				$InputSelected = (string)$InputFuncSelect[0]->value;
				if ($InputSelected == "CBL/SAT")
				{
					$InputSelected = "SAT/CBL";
				}
				elseif ($InputSelected == "MediaPlayer")
				{
					$InputSelected = "MPLAY";
				}
				elseif ($InputSelected == "iPod/USB")
				{
					$InputSelected = "USB/IPOD";
				}
				elseif ($InputSelected == "TVAUDIO")
				{
					$InputSelected = "TV";
				}
				elseif ($InputSelected == "Bluetooth")
				{
					$InputSelected = "BT";
				}
				elseif ($InputSelected == "Blu-ray")
				{
					$InputSelected = "BD";
				}
				foreach ($InputMapping as $Command => $InputSourceValue)
				{
				if ($Command == $InputSelected)
					{
					$data[DENON_API_Commands::SI] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $InputSourceValue, 'Subcommand' => $Command);
					}
				}	
				
			}

		//NetFuncSelect
		/*
		$NetFuncSelect = $xml->xpath('.//NetFuncSelect');
		if ($NetFuncSelect)
		{
			$data['NetFuncSelect'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$NetFuncSelect[0]->value, 'Subcommand' => 'NetFuncSelect');
		}
		*/

		//InputFuncSelectMain
		/*
		$InputFuncSelectMain = $xml->xpath('.//InputFuncSelectMain');
		if ($InputFuncSelectMain)
		{
			$data['SI'] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => (string)$InputFuncSelectMain[0]->value, 'Subcommand' => 'Input Source');
		}
		*/
		
		//selectSurround
		/*
		$selectSurround = $xml->xpath('.//selectSurround');
		if ($selectSurround)
		{
			$data['MS'] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => (string)$selectSurround[0]->value, 'Subcommand' => 'Surround Mode');
		}
		*/
		
		//VolumeDisplay z.B. relative
		/*
		$VolumeDisplay = $xml->xpath('.//VolumeDisplay');
		if ($VolumeDisplay)
		{
			$data['VolumeDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$VolumeDisplay[0]->value, 'Subcommand' => 'VolumeDisplay');
		}
		*/


		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$data[DENON_API_Commands::MV] =  array('VarType' => DENONIPSVarType::vtFloat, 'Value' => (float)$MasterVolume[0]->value, 'Subcommand' => (float)$MasterVolume[0]->value);
		}
		

		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MuteMapping = array("on" => true, "off" => false);
			foreach ($MuteMapping as $Command => $MuteValue)
			{
			if ($Command == (string)$Mute[0]->value)
				{
				$data[DENON_API_Commands::MU] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $MuteValue, 'Subcommand' => $Command);
				}
			}	
		}

		//RemoteMaintenance
		/*
		$RemoteMaintenance = $xml->xpath('.//RemoteMaintenance');
		if ($RemoteMaintenance)
		{
			$RemoteMaintenanceMapping = array("ON" => true, "OFF" => false);
			foreach ($RemoteMaintenanceMapping as $Command => $RemoteMaintenanceValue)
			{
			if ($Command == (string)$RemoteMaintenance[0]->value)
				{
				$data['RemoteMaintenance'] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $RemoteMaintenanceValue, 'Subcommand' => 'RemoteMaintenance');
				}
			}	
		}
		*/

		//GameSourceDisplay
		/*
		$GameSourceDisplay = $xml->xpath('.//GameSourceDisplay');
		if ($GameSourceDisplay)
		{
			$data['GameSourceDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$GameSourceDisplay[0]->value, 'Subcommand' => 'GameSourceDisplay');
		}
		*/

		//LastfmDisplay
		/*
		$LastfmDisplay = $xml->xpath('.//LastfmDisplay');
		if ($LastfmDisplay)
		{
			$data['LastfmDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$LastfmDisplay[0]->value, 'Subcommand' => 'LastfmDisplay');
		}
		*/

		//SubwooferDisplay
		/*
		$SubwooferDisplay = $xml->xpath('.//SubwooferDisplay');
		if ($SubwooferDisplay)
		{
			$data['SubwooferDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$SubwooferDisplay[0]->value, 'Subcommand' => 'SubwooferDisplay');
		}
		*/


		//Zone2VolDisp
		/*
		$Zone2VolDisp = $xml->xpath('.//Zone2VolDisp');
		if ($Zone2VolDisp )
		{
			$data['Zone2VolDisp'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$Zone2VolDisp[0]->value, 'Subcommand' => 'Zone2VolDisp');
		}
		*/
		
	
	return $data;
	}
	
	protected function MainZoneXmlStatus($xml, $data, $InputMapping, $AVRType)
	{
		
		//RestorerMode
		/*
		$RestorerMode = $xml->xpath('.//RestorerMode');
		if ($RestorerMode)
		{
			$data[DENON_API_Commands::PSRSTR] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => (string)$RestorerMode[0]->value, 'Subcommand' => 'Audio Restorer');
		}
		*/
		
		//InputFuncSelect
		/*
		if ($AVRType == "AVR-4311")
		{
			$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
			if ($InputFuncSelect)
			{
				foreach ($InputMapping as $Command => $InputSourceValue)
				{
				if ($Command == (string)$InputFuncSelect[0]->value)
					{
					$data[DENON_API_Commands::SI] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $InputSourceValue, 'Subcommand' => $Command);
					}
				}	
				
			}
		}
		*/
		//SurrMode
		$SurrMode = $xml->xpath('.//SurrMode');
		if ($SurrMode)
		{	
			if($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W")
			{
				$SurroundMapping = array("Direct" => 0, "Pure_Direct" => 1, "Stereo" => 2, "Standard" => 3, "Standard(Dolby)" => 4, "Standard(DTS)" => 5, "Auro 3D" => 6, "Auro 2D Surround" => 7, "Multichannel Stereo" => 8, "Widescreen" => 9, "Superstadium" => 10, "Rock Arena" => 11, "Jazz Club" => 12, "Classic Concert" => 13, "Mono Movie" => 14,
												"Matrix" => 15, "Video Game" => 16, "Virtual" => 17);
			}
			else
			{
				$SurroundMapping = array("Direct" => 0, "Pure_Direct" => 1, "Stereo" => 2, "Standard" => 3, "Standard(Dolby)" => 4, "Standard(DTS)" => 5, "Multi_CH_Stereo" => 6, "Wide_Screen" => 7, "Super_Stadium" => 8, "Rock_Arena" => 9, "Jazz_Club" => 10, "Classic_Concert" => 11, "Mono_Movie" => 12, "Matrix" => 13, "Video_Game" => 14,
												"Virtual" => 15);
			}
			foreach ($SurroundMapping as $Command => $SurroundValue)
			{
			if ($Command == (string)$SurrMode[0]->value)
				{
				$data[DENON_API_Commands::MS] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $SurroundValue, 'Subcommand' => 'Surround Mode');
				}
			}	
			
			
		}

		return $data;
	}
	
	protected function NetAudioStatusXml($xml, $data)
	{
		//Model
		$szLine = $xml->xpath('.//szLine');
		if ($szLine)
			{
				$data['ModelDisplay'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$szLine[0]->value, 'Subcommand' => 'ModelDisplay');
			}
		

		return $data;
	}
	
	protected function Deviceinfo($xml, $data)
	{
		//ModelName
		$ModelName = $xml->xpath('.//ModelName');
		if ($ModelName)
			{
				$data['ModelName'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$ModelName[0], 'Subcommand' => 'ModelName');
			}
		
		
		
		return $data;
	}
	
	protected function DeviceSearch($xml, $data)
	{
		//Model
		$Model = $xml->xpath('.//Model');
		if ($Model)
			{
				$ModelValue = str_replace(" ", "", (string)$Model[0]->value);
				$data['Model'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => $ModelValue, 'Subcommand' => 'Model');
			}
		

		return $data;
	}
	
	protected function StateZone2($xml, $data, $InputMapping, $AVRType)
	{
		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{	
			$AVRPowerMapping = array("ON" => true, "STANDBY" => false);
			foreach ($AVRPowerMapping as $Command => $AVRPowerValue)
			{
			if ($Command == (string)$AVRPower[0]->value)
				{
				$data[DENON_API_Commands::PW] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $AVRPowerValue, 'Subcommand' => $Command);	
				}
			}	
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$ZonePowerMapping = array("ON" => true, "OFF" => false);
			foreach ($ZonePowerMapping as $Command => $ZonePowerValue)
			{
			if ($Command == (string)$ZonePower[0]->value)
				{
				$data[DENON_API_Commands::Z2POWER] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $ZonePowerValue, 'Subcommand' => $Command);
				}
			}	
		}

		//Zone Name
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$data['Zone2Name'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$RenameZone[0]->value, 'Subcommand' => 'Zone2 Name');	
		}
		
		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
		{
			foreach ($InputMapping as $Command => $InputSourceValue)
			{
			if ($Command == (string)$InputFuncSelect[0]->value)
				{
				$data[DENON_API_Commands::Z2INPUT] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $InputSourceValue, 'Subcommand' => $Command);
				}
			}	
			
		}
		
		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$data[DENON_API_Commands::Z2VOL] =  array('VarType' => DENONIPSVarType::vtFloat, 'Value' => (float)$MasterVolume[0]->value, 'Subcommand' => (float)$MasterVolume[0]->value);
		}
		

		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MuteMapping = array("on" => true, "off" => false);
			foreach ($MuteMapping as $Command => $MuteValue)
			{
			if ($Command == (string)$Mute[0]->value)
				{
				$data[DENON_API_Commands::Z2MU] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $MuteValue, 'Subcommand' => $Command);
				}
			}	
		}

	return $data;
	}
	
	protected function StateZone3($xml, $data, $InputMapping, $AVRType)
	{
		//Power
		$AVRPower = $xml->xpath('.//Power');
		if ($AVRPower)
		{	
			$AVRPowerMapping = array("ON" => true, "STANDBY" => false);
			foreach ($AVRPowerMapping as $Command => $AVRPowerValue)
			{
			if ($Command == (string)$AVRPower[0]->value)
				{
				$data[DENON_API_Commands::PW] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $AVRPowerValue, 'Subcommand' => $Command);	
				}
			}	
		}


		//Zone Power
		$ZonePower = $xml->xpath('.//ZonePower');
		if ($ZonePower)
		{
			$ZonePowerMapping = array("ON" => true, "OFF" => false);
			foreach ($ZonePowerMapping as $Command => $ZonePowerValue)
			{
			if ($Command == (string)$ZonePower[0]->value)
				{
				$data[DENON_API_Commands::Z3POWER] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $ZonePowerValue, 'Subcommand' => $Command);
				}
			}	
		}

		//Zone Name
		$RenameZone = $xml->xpath('.//RenameZone');
		if ($RenameZone)
		{
			$data['Zone3Name'] =  array('VarType' => DENONIPSVarType::vtString, 'Value' => (string)$RenameZone[0]->value, 'Subcommand' => 'Zone3 Name');	
		}
		
		//InputFuncSelect
		$InputFuncSelect = $xml->xpath('.//InputFuncSelect');
		if ($InputFuncSelect)
		{
			foreach ($InputMapping as $Command => $InputSourceValue)
			{
			if ($Command == (string)$InputFuncSelect[0]->value)
				{
				$data[DENON_API_Commands::Z3INPUT] =  array('VarType' => DENONIPSVarType::vtInteger, 'Value' => $InputSourceValue, 'Subcommand' => $Command);
				}
			}	
			
		}
		
		//MasterVolume
		$MasterVolume = $xml->xpath('.//MasterVolume');
		if ($MasterVolume)
		{
			$data[DENON_API_Commands::Z3VOL] =  array('VarType' => DENONIPSVarType::vtFloat, 'Value' => (float)$MasterVolume[0]->value, 'Subcommand' => (float)$MasterVolume[0]->value);
		}
		

		//Mute
		$Mute = $xml->xpath('.//Mute');
		if ($Mute)
		{
			$MuteMapping = array("on" => true, "off" => false);
			foreach ($MuteMapping as $Command => $MuteValue)
			{
			if ($Command == (string)$Mute[0]->value)
				{
				$data[DENON_API_Commands::Z3MU] =  array('VarType' => DENONIPSVarType::vtBoolean, 'Value' => $MuteValue, 'Subcommand' => $Command);
				}
			}	
		}

	return $data;
	}
	
}

class DENON_Zone extends stdClass
{

    const Mainzone = 0;
    const Zone2 = 1;
    const Zone3 = 2;
	const None = 6;
    
    public $thisZone;
	static $ZoneCMDs = array(
        DENON_Zone::Mainzone => array(
            DENON_API_Commands::PW,
			DENON_API_Commands::MV,
			DENON_API_Commands::CVFL,
			DENON_API_Commands::CVFR,
			DENON_API_Commands::CVC,
			DENON_API_Commands::CVSW,
			DENON_API_Commands::CVSW2,
			DENON_API_Commands::CVSL,
			DENON_API_Commands::CVSR,
			DENON_API_Commands::CVSBL,
			DENON_API_Commands::CVSBR,
			DENON_API_Commands::CVSB,
			DENON_API_Commands::CVFHL,
			DENON_API_Commands::CVFHR,
			DENON_API_Commands::CVFWL,
			DENON_API_Commands::CVFWR,
			DENON_API_Commands::MU,
			DENON_API_Commands::SI,
			DENON_API_Commands::ZM,
			DENON_API_Commands::SD,
			DENON_API_Commands::DC,
			DENON_API_Commands::SV,
			DENON_API_Commands::SLP,
			DENON_API_Commands::MS,
			DENON_API_Commands::MSQUICK,
			DENON_API_Commands::MSQUICKMEMORY,			
			DENON_API_Commands::PSATT,
			DENON_API_Commands::VSASP,
			DENON_API_Commands::VSSC,
			DENON_API_Commands::VSSCH,
			DENON_API_Commands::VSAUDIO,
			DENON_API_Commands::VSMONI,
			DENON_API_Commands::VSVPM,
			DENON_API_Commands::VSVST,
			DENON_API_Commands::PSTONECTRL,
			DENON_API_Commands::PSSB,
			DENON_API_Commands::PSCINEMAEQ,
			DENON_API_Commands::PSMODE,
			DENON_API_Commands::PSDOLVOL,
			DENON_API_Commands::PSVOLLEV,
			DENON_API_Commands::PSVOLMOD,
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
			DENON_API_Commands::PSBAS,
			DENON_API_Commands::PSTRE,
			DENON_API_Commands::PSDRC,
			DENON_API_Commands::PSDCO,
			DENON_API_Commands::PSLFE,
			DENON_API_Commands::PSEFF,
			DENON_API_Commands::PSDELAY,
			DENON_API_Commands::PSAFD,
			DENON_API_Commands::PSPAN,
			DENON_API_Commands::PSDIM,
			DENON_API_Commands::PSCEN,
			DENON_API_Commands::PSCEI,
			DENON_API_Commands::PSRSTR,
			DENON_API_Commands::PSRSZ,
			DENON_API_Commands::PSSWR,
			DENON_API_Commands::PSATT,			
            DENON_API_Commands::PVCN,
            DENON_API_Commands::PVBR,
            DENON_API_Commands::PVCM,
            DENON_API_Commands::PVHUE,
            DENON_API_Commands::PVDNR,
            DENON_API_Commands::PVENH,
			DENON_API_Commands::MN,
			DENON_API_Commands::MNMEN,
			DENON_API_Commands::MNSRC

        ),
        DENON_Zone::Zone2 => array(
            DENON_API_Commands::Z2,
            DENON_API_Commands::Z2MU,
			DENON_API_Commands::Z2CS,
			DENON_API_Commands::Z2CVFL,
			DENON_API_Commands::Z2CVFR,
			DENON_API_Commands::Z2HPF,
			DENON_API_Commands::Z2PSBAS,
			DENON_API_Commands::Z2PSTRE,
			DENON_API_Commands::Z2SLP
        ),
        DENON_Zone::Zone3 => array(
            DENON_API_Commands::Z3,
			DENON_API_Commands::Z3MU,
			DENON_API_Commands::Z3CS,
			DENON_API_Commands::Z3CVFL,
			DENON_API_Commands::Z3CVFR,
			DENON_API_Commands::Z3HPF,
			DENON_API_Commands::Z3PSBAS,
			DENON_API_Commands::Z3PSTRE,
            DENON_API_Commands::Z3SLP
        )
		
    );
	
	public function CmdAvaiable(DenonAVRCP_API_Data $API_Data)
    {
        return (in_array($API_Data->APICommand, self::$ZoneCMDs[$this->thisZone]));
    }
	
	public function SubCmdAvaiable(DenonAVRCP_API_Data $API_Data)
    {

	//  IPS_LogMessage('APISubCommand', print_r($API_Data->APISubCommand, 1));
	//  IPS_LogMessage('ZoneCMDs', print_r(self::$ZoneCMDs[$this->thisZone], 1));
        if ($API_Data->APISubCommand <> null)
            if (property_exists($API_Data->APISubCommand, $this->thisZone))
                return (in_array($API_Data->APISubCommand->{$this->thisZone}, self::$ZoneCMDs[$this->thisZone]));
        return false;
    }
	
}

class DENON_API_Commands extends stdClass
{

//MAIN Zone
    const PW = "PW"; // Power
    const MV = "MV"; // Master Volume
	//const CV = "CV"; // Channel Volume
	//CV
	const CVFL = "CVFL"; // Channel Volume Front Left
	const CVFR = "CVFR"; // Channel Volume Front Right
	const CVC = "CVC"; // Channel Volume Center
	const CVSW = "CVSW"; // Channel Volume Subwoofer
	const CVSW2 = "CVSW2"; // Channel Volume Subwoofer2
	const CVSL = "CVSL"; // Channel Volume Surround Left
	const CVSR = "CVSR"; // Channel Volume Surround Right
	const CVSBL = "CVSBL"; // Channel Volume Surround Back Left
	const CVSBR = "CVSBR"; // Channel Volume Surround Back Right
	const CVSB = "CVSB"; // Channel Volume Surround Back
	const CVFHL = "FHL"; // Channel Volume Front Height Left
	const CVFHR = "FHR"; // Channel Volume Front Height Right
	const CVFWL = "FWL"; // Channel Volume Front Wide Left
	const CVFWR = "FWR"; // Channel Volume Front Wide Right
	const MU = "MU"; // Volume Mute
	const SI = "SI"; // Select
	const ZM = "ZM"; // Main Zone
	const SD = "SD"; // Select Auto/HDMI/Digital/Analog
	const DC = "DC"; // Digital Input Mode Select Auto/PCM/DTS
	const SV = "SV"; // Video Select
	const SLP = "SLP"; // Main Zone Sleep Timer
	const MS = "MS"; // Select Surround Mode
	const MSQUICK = "MSQUICK"; // Quick Select Mode Select
	const MSQUICKMEMORY = "MEMORY"; // Quick Select Mode Memory
	
	//MU
	const MUON = "ON"; // Volume Mute ON
	const MUOFF = "OFF"; // Volume Mute Off
	
	//VS
	const VS = "VS"; // Video Setting
	const VSASP = "VSASP"; // ASP
	const VSSC = "VSSC"; // Set Resolution
	const VSSCH = "VSSCH"; // Set Resolution HDMI
	const VSAUDIO = "VSAUDIO"; // Set HDMI Audio Output
	const VSMONI = "VSMONI"; // Set HDMI Monitor
	const VSVPM = "VSVPM"; // Set Video Processing Mode
	const VSVST = "VSVST"; // Set Vertical Stretch
	//PS
	const PS = "PS"; // Parameter Setting
	const PSATT = "PSATT"; // SW ATT
	const PSTONECTRL = "PSTONE_CTRL"; // Tone Control
	const PSSB = "PSSB"; // Surround Back SP Mode
	const PSCINEMAEQ = "PSCINEMA_EQ"; // Cinema EQ
	const PSMODE = "PSMODE"; // Mode Music
	const PSDOLVOL = "PSDOLVOL"; // Dolby Volume direct change
	const PSVOLLEV = "PSVOLLEV"; // Dolby Volume Leveler direct change
	const PSVOLMOD = "PSVOLMOD"; // Dolby Volume Modeler direct change
	const PSFH = "PSFH"; // FRONT HEIGHT
	const PSPHG = "PSPHG"; // PL2z HEIGHT GAIN direct change
	const PSSP = "PSSP"; // Speaker Output set
	const PSMULTEQ = "PSMULTEQ"; // MultEQ XT 32 mode direct change
	const PSDYNEQ = "PSDYNEQ"; // Dynamic EQ
	const PSREFLEV = "PSREFLEV"; // Reference Level Offset
	const PSDYNVOL = "PSDYNVOL"; // Dynamic Volume
	const PSDSX = "PSDSX"; // Audyssey DSX Change
	const PSSTW = "PSSTW"; // STAGE WIDTH
	const PSSTH = "PSSTH"; // STAGE HEIGHT
	const PSBAS = "PSBAS"; // BASS
	const PSTRE = "PSTRE"; // TREBLE
	const PSDRC = "PSDRC"; // DRC direct change
	const PSDCO = "PSDCO"; // D.COMP direct change	
	const PSLFE = "PSLFE"; // LFE
	const PSEFF = "PSEFF"; // EFFECT direct change	Level
	const PSEFFSWITCH = "PSEFF_O"; // EFFECT Switch On / Off
	const PSDELAY = "PSDELAY"; // Audio DELAY	
	const PSAFD = "PSAFD"; // Auto Flag Detect Mode	
	const PSPAN = "PSPAN"; // PANORAMA	
	const PSDIM = "PSDIM"; // DIMENSION	
	const PSCEN = "PSCEN"; // CENTER WIDTH	
	const PSCEI = "PSCEI"; // CENTER IMAGE
	const PSRSTR = "PSRSTR"; //Audio Restorer
	const PSRSZ = "PSRSZ"; //Room Size
	const PSSWR = "PSSWR"; //Subwoofer
	
	//PV
	const PVCN = "PVCN"; // Contrast
	const PVBR = "PVBR"; // Brightness
	const PVCM = "PVCM"; // Chroma
	const PVHUE = "PVHUE"; // Hue
	const PVENH = "PVENH"; // Enhancer
	
	const PVDNR = "PVDNR"; // Digital Noise Reduction direct change
	const PVDNROFF = " OFF"; // Digital Noise Reduction Off
	const PVDNRLOW = " LOW"; // Digital Noise Reduction Low
	const PVDNRMID = " MID"; // Digital Noise Reduction Middle
	const PVDNRHI = " HI"; // Digital Noise Reduction High
	
	const SR = " ?"; //Status Request
	
	//Zone 2
	const Z2 = "Z2"; // Zone 2
	const Z2ON = "ON"; // Zone 2 On
	const Z2OFF = "OFF"; // Zone 2 Off
	const Z2POWER = "Z2POWER"; // Zone 2 Power Z2 beim Senden
	const Z2INPUT = "Z2INPUT"; // Zone 2 Input Z2 beim Senden
	const Z2VOL = "Z2VOL"; // Zone 2 Volume Z2 beim Senden
	const Z2MU = "Z2MU"; // Zone 2 Mute
	const Z2CS = "Z2CS"; // Zone 2 Channel Setting
	const Z2CSST = "ST"; // Zone 2 Channel Setting Stereo
	const Z2CSMONO = "MONO"; // Zone 2 Channel Setting Mono
	const Z2CVFL = "Z2CVFL"; // Zone 2 Channel Volume FL
	const Z2CVFR = "Z2CVFR"; // Zone 2 Channel Volume FR
	const Z2HPF = "Z2HPF"; // Zone 2 HPF
	const Z2PSBAS = "Z2PSBAS"; // Zone 2 Parameter Bass
	const Z2PSTRE = "Z2PSTRE"; // Zone 2 Parameter Treble
	const Z2SLP = "Z2SLP"; // Zone 2 Sleep Timer
	const Z2QUICK = "Z2QUICK"; // Zone 2 Quick
	
	//Zone 3
	const Z3 = "Z3"; // Zone 3
	const Z3ON = "ON"; // Zone 3 On
	const Z3OFF = "OFF"; // Zone 3 Off
	const Z3POWER = "Z3POWER"; // Zone 3 Power Z3 beim Senden
	const Z3INPUT = "Z3INPUT"; // Zone 3 Input Z3 beim Senden
	const Z3VOL = "Z2VOL"; // Zone 3 Volume Z3 beim Senden
	const Z3MU = "Z3MU"; // Zone 3 Mute
	const Z3CS = "Z3CS"; // Zone 3 Channel Setting
	const Z3CSST = "ST"; // Zone 3 Channel Setting Stereo
	const Z3CSMONO = "MONO"; // Zone 3 Channel Setting Mono
	const Z3CVFL = "Z3CVFL"; // Zone 3 Channel Volume FL
	const Z3CVFR = "Z3CVFR"; // Zone 3 Channel Volume FR
	const Z3HPF = "Z3HPF"; // Zone 3 HPF
	const Z3PSBAS = "Z3PSBAS"; // Zone 3 Parameter Bass
	const Z3PSTRE = "Z3PSTRE"; // Zone 3 Parameter Treble
	const Z3SLP = "Z3SLP"; // Zone 3 Sleep Timer
	const Z3QUICK = "Z3QUICK"; // Zone 3 Quick
	
	const TF = "TF"; // Tuner Frequency
	const TP = "TP"; // Tuner Preset
	const TM = "TM"; // Tuner Mode
	const NS = "NS"; // Network Audio
	const TR = "TR"; // Trigger
	const SY = "SY"; // Remote Lock
	const UG = "UG"; // Upgrade ID Display
	
	// Display Network Audio Navigation
	const NAUP = "NS90"; // Network Audio Cursor Up Control
	const NADOWN = "NS91"; // Network Audio Cursor Down Control
	const NALEFT = "NS92"; // Network Audio Cursor Left Control
	const NARIGHT = "NS93"; // Network Audio Cursor Right Control
	const NAENTER = "NS94"; // Network Audio Cursor Enter Control
	const NAPLAY = "NS9A"; // Network Audio Play
	const NAPAUSE = "NS9B"; // Network Audio Pause
	const NASTOP = "NS9C"; // Network Audio Stop
	const NASKIPPLUS = "NS9D"; // Network Audio Skip +
	const NASKIPMINUS = "NS9E"; // Network Audio Skip -
	const NAREPEATONE = "NS9H"; // Network Audio Repeat One
	const NAREPEATALL = "NS9I"; // Network Audio Repeat All
	const NAREPEATOFF = "NS9J"; // Network Audio Repeat Off
	const NARANDOMON = "NS9K"; // Network Audio Random On
	const NARANDOMOFF = "NS9M"; // Network Audio Random Off
	const NATOGGLE = "NS9W"; // Network Audio Toggle Switch
	const NAPAGENEXT = "NS9X"; // Network Audio Page Next
	const NAPAGEPREV = "NS9Y"; // Network Audio Page Previous
	
	
	//Display 
	const DISPLAY = "Display"; // Display zur Anzeige
	const NSA = "NSA"; // Network Audio Extended
	const NSA0 = "NSA0"; // Network Audio Extended Line 0
	const NSA1 = "NSA1"; // Network Audio Extended Line 1
	const NSA2 = "NSA2"; // Network Audio Extended Line 2
	const NSA3 = "NSA3"; // Network Audio Extended Line 3
	const NSA4 = "NSA4"; // Network Audio Extended Line 4
	const NSA5 = "NSA5"; // Network Audio Extended Line 5
	const NSA6 = "NSA6"; // Network Audio Extended Line 6
	const NSA7 = "NSA7"; // Network Audio Extended Line 7
	const NSA8 = "NSA8"; // Network Audio Extended Line 8
	
	const NSE = "NSE"; // Network Audio Onscreen Display Information
	const NSE0 = "NSE0"; // Network Audio Onscreen Display Information Line 0
	const NSE1 = "NSE1"; // Network Audio Onscreen Display Information Line 1
	const NSE2 = "NSE2"; // Network Audio Onscreen Display Information Line 2
	const NSE3 = "NSE3"; // Network Audio Onscreen Display Information Line 3
	const NSE4 = "NSE4"; // Network Audio Onscreen Display Information Line 4
	const NSE5 = "NSE5"; // Network Audio Onscreen Display Information Line 5
	const NSE6 = "NSE6"; // Network Audio Onscreen Display Information Line 6
	const NSE7 = "NSE7"; // Network Audio Onscreen Display Information Line 7
	const NSE8 = "NSE8"; // Network Audio Onscreen Display Information Line 8
	const NSE9 = "NSE9"; // Network Audio Onscreen Display Information Line 9
	
	//SUB Commands
	
	//PW
	const PWON = "ON"; // Power On
	const PWSTANDBY = "STANDBY"; // Power Standbye
	
	//MV
	const MVUP = "UP"; // Master Volume Up
	const MVDOWN = "DOWN"; // Master Volume Down
	
	
	//SI
	const PHONO = "PHONO"; // Select Input Source Phono
	const CD = "CD"; // Select Input Source CD
	const TUNER = "TUNER"; // Select Input Source Tuner
	const DVD = "DVD"; // Select Input Source DVD
	const BD = "BD"; // Select Input Source BD
	const BT = "BT"; // Select Input Source Blutooth
	const MPLAY = "MPLAY"; // Select Input Source Mediaplayer
	const TV = "TV"; // Select Input Source TV
	const SAT = "SAT/CBL"; // Select Input Source Sat/CBL
	const DVR = "DVR"; // Select Input Source DVR
	const GAME = "GAME"; // Select Input Source Game
	const VAUX = "V.AUX"; // Select Input Source V.AUX
	const DOCK = "DOCK"; // Select Input Source Dock
	const IPOD = "IPOD"; // Select Input Source iPOD
	const NETUSB = "NET/USB"; // Select Input Source NET/USB
	const LASTFM = "LASTFM"; // Select Input Source LastFM
	const FLICKR = "FLICKR"; // Select Input Source Flickr
	const FAVORITES = "FAVORITES"; // Select Input Source Favorites
	const IRADIO = "IRADIO"; // Select Input Source Internet Radio
	const SERVER = "SERVER"; // Select Input Source Server
	
	//ZM Mainzone
	const ZMOFF = "OFF"; // Power Off
	const ZMON = "ON"; // Power On
	
	//SD
	const AUTO = "AUTO"; // Auto Mode
	const HDMI = "HDMI"; // HDMI Mode
	const DIGITAL = "DIGITAL"; // Digital Mode
	const ANALOG = "ANALOG"; // Analog Mode
	const EXTIN = "EXT.IN"; // Ext.In Mode
	const NO = "NO"; // no Input
	
	//DC Digital Input
	const DCAUTO = "AUTO"; // Auto Mode
	const DCPCM = "PCM"; // PCM Mode
	const DCDTS = "DTS"; // DTS Mode
	
	//MS Surround Mode
	const MSDIRECT = "DIRECT"; // Direct Mode
	const MSPUREDIRECT = "PURE DIRECT"; // Pure Direct Mode
	const MSSTEREO = "STEREO"; // Stereo Mode
	const MSSTANDARD = "STANDARD"; // Standard Mode
	const MSDOLBYDIGITAL = "DOLBY DIGITAL"; // Dolby Digital Mode
	const MSDTSSUROUND = "DTS SURROUND"; // DTS Suround Mode
	const MSMCHSTEREO = "MCH STEREO"; // Multi Channel Stereo Mode
	const MSWIDESCREEN = "WIDE SCREEN"; // Wide Screen Mode
	const MSSUPERSTADIUM = "SUPER STADIUM"; // Super Stadium Mode
	const MSROCKARENA = "ROCK ARENA"; // Rock Arena Mode
	const MSJAZZCLUB = "JAZZ CLUB"; // Jazz Club Mode
	const MSCLASSICCONCERT = "CLASSIC CONCERT"; // Classic Concert Mode
	const MSMONOMOVIE = "MONO MOVIE"; // Mono Movie Mode
	const MSMATRIX = "MATRIX"; // Matrix Mode
	const MSVIDEOGAME = "VIDEO GAME"; // Video Game Mode
	const MSVIRTUAL = "VIRTUAL"; // Virtual Mode
	//Quick Select Mode
	const MSQUICK1 = "1"; // Quick Select 1 Mode Select
	const MSQUICK2 = "2"; // Quick Select 2 Mode Select
	const MSQUICK3 = "3"; // Quick Select 3 Mode Select
	const MSQUICK4 = "4"; // Quick Select 4 Mode Select
	const MSQUICK5 = "5"; // Quick Select 5 Mode Select
	
	//MSQUICKMEMORY
	const MSQUICK1MEMORY = "1 MEMORY"; // Quick Select 1 Mode Memory
	const MSQUICK2MEMORY = "2 MEMORY"; // Quick Select 2 Mode Memory
	const MSQUICK3MEMORY = "3 MEMORY"; // Quick Select 3 Mode Memory
	const MSQUICK4MEMORY = "4 MEMORY"; // Quick Select 4 Mode Memory
	const MSQUICK5MEMORY = "5 MEMORY"; // Quick Select 5 Mode Memory
	const MSQUICKSTATE = "QUICK ?"; // QUICK ? Return MSQUICK Status
	
	//VS
	//VSMONI Set HDMI Monitor
	const VSMONIAUTO = "AUTO"; // 1
	const VSMONI1 = "1"; // 1
	const VSMONI2 = "2"; // 2
	
	
	//VSASP
	const ASPNRM = "NRM"; // Set Normal Mode
	const ASPFUL = "FUL"; // Set Full Mode
	const ASP = " ?"; // ASP ? Return VSASP Status
	
	//VSSC Set Resolution
	const SC48P = "48P"; // Set Resolution to 480p/576p
	const SC10I = "10I"; // Set Resolution to 1080i
	const SC72P = "72P"; // Set Resolution to 720p
	const SC10P = "10P"; // Set Resolution to 1080p
	const SC10P24 = "10P24"; // Set Resolution to 1080p:24Hz
	const SC4K = "4K"; // Set Resolution to 4K
	const SC4KF = "4KF"; // Set Resolution to 4K (60/50)
	const SCAUTO = "AUTO"; // Set Resolution to Auto
	const SC = " ?"; // SC ? Return VSSC Status
	
	//VSSCH Set Resolution HDMI
	const SCH48P = "48P"; // Set Resolution to 480p/576p HDMI
	const SCH10I = "10I"; // Set Resolution to 1080i HDMI
	const SCH72P = "72P"; // Set Resolution to 720p HDMI
	const SCH10P = "10P"; // Set Resolution to 1080p HDMI
	const SCH10P24 = "10P24"; // Set Resolution to 1080p:24Hz HDMI
	const SCH4K = "4K"; // Set Resolution to 4K
	const SCH4KF = "4KF"; // Set Resolution to 4K (60/50)
	const SCHAUTO = "AUTO"; // Set Resolution to Auto HDMI
	const SCH = " ?"; // SCH ? Return VSSCH Status(HDMI)
	
	//VSAUDIO Set HDMI Audio Output
	const AUDIOAMP = " AMP"; // Set HDMI Audio Output to AMP
	const AUDIOTV = " TV"; // Set HDMI Audio Output to TV
	const AUDIO = " ?"; // AUDIO ? Return VSAUDIO Status
	
	//VSVPM Set Video Processing Mode
	const VPMAUTO = "AUTO"; // Set Video Processing Mode to Auto
	const VPGAME = "GAME"; // Set Video Processing Mode to Game
	const VPMOVI = "OVI"; // Set Video Processing Mode to Movie
	const VPM = " ?"; // VPM ? Return VSVPM Status
	
	//VSVST Set Vertical Stretch
	const VSTON = " ON"; // Set Vertical Stretch On
	const VSTOFF = " OFF"; // Set Vertical Stretch Off 
	const VST = " ?"; // VST ? Return VSVST Status
	
	//PS Parameter
	//PSTONE Tone Control
	const TONECTRL = "PSTONE CTRL"; // Tone Control On
	const PSTONECTRLON = " ON"; // Tone Control On
	const PSTONECTRLOFF = " OFF"; // Tone Control Off
	const PSTONECTRLSTATE = " ?"; // TONE CTRL ? Return PSTONE CONTROL Status
	
	//PSSB Surround Back SP Mode
	const SBMTRXON = ":MTRX ON"; // Surround Back SP Mode Matrix
	const SBPL2XCINEMA = ":PL2X CINEMA"; // Surround Back SP Mode	PL2X Cinema
	const SBPL2XMUSIC = ":PL2X MUSIC"; // Surround Back SP Mode	PL2X Music
	const SBON = ":ON"; // Surround Back SP Mode on
	const SBOFF = ":OFF"; // Surround Back SP Mode off
	
	//PSCINEMAEQ Cinema EQ
	const CINEMAEQCOMMAND = "PSCINEMA EQ"; // Cinema EQ
	const CINEMAEQON = ".ON"; // Cinema EQ on
	const CINEMAEQOFF = ".OFF"; // Cinema EQ off
	const CINEMAEQ = ". ?"; // Return PSCINEMA EQ.Status
	
	//PSMODE Mode Music
	const MODEMUSIC = "MUSIC"; // Mode Music CINEMA / MUSIC / GAME / PL mode change
	const MODECINEMA = "CINEMA"; // This parameter can change DOLBY PL2,PL2x,NEO:6 mode.
	const MODEGAME = "GAME"; // SB=ON：PL2x mode / SB=OFF：PL2 mode GAME can change DOLBY PL2 & PL2x mode PSMODE:PRO LOGIC
	const MODEPROLOGIC = "PRO LOGIC"; // PL can change ONLY DOLBY PL2 mode
	const MODE = "chr(32).chr(63)"; // Return PSMODE: Status
	
	//PSDOLVOL Dolby Volume direct change
	const DOLVOLON = " ON"; // Dolby Volume direct change on
	const DOLVOLOFF = " OFF"; // Dolby Volume direct change off
	const DOLVOL = "chr(32).chr(63)"; // Return PSDOLVOL Status
	
	//PSVOLLEV Dolby Volume Leveler direct change
	const VOLLEVLOW = " LOW"; // Dolby Volume Leveler direct change Low
	const VOLLEVMID = " MID"; // Dolby Volume Leveler direct change Middle
	const VOLLEVHI = " HI"; // Dolby Volume Leveler direct change High
	const VOLLEV = "chr(32).chr(63)"; // Return PSVOLLEV Status
	
	// PSVOLMOD Dolby Volume Modeler direct change
	const VOLMODHLF = " HLF"; // Dolby Volume Modeler direct change half
	const VOLMODFUL = " FUL"; // Dolby Volume Modeler direct change full
	const VOLMODOFF = " OFF"; // Dolby Volume Modeler direct change off
	const VOLMOD = "chr(32).chr(63)"; // Return PSVOLMOD Status

	//PSFH Front Height
	const PSFHON = "chr(58).chr(79).chr(78)"; // FRONT HEIGHT ON
	const PSFHOFF = "chr(58).chr(79).chr(70).chr(70)"; // FRONT HEIGHT OFF
	const PSFHSTATUS = "chr(58).chr(32).chr(63)"; // Return PSFH: Status
	
	//PSPHG PL2z Height Gain direct change
	const PHGLOW = " LOW"; // PL2z HEIGHT GAIN direct change low
	const PHGMID = " MID"; // PL2z HEIGHT GAIN direct change middle
	const PHGHI = " HI"; // PL2z HEIGHT GAIN direct change high
	const PHG = "chr(32).chr(63)"; // Return PSPHG Status
	
	//PSSP Speaker Output set
	const SPFH = ":FH"; // Speaker Output set FH
	const SPFW = ":FW"; // Speaker Output set FW
	const SPHW = ":HW"; // Speaker Output set HW
	const SPOFF = ":OFF"; // Speaker Output set off
	const SP = "chr(32).chr(63)"; // Return PSSP: Status

	// MulEQ XT 32 mode direct change
	const MULTEQAUDYSSEY = "AUDYSSEY"; // MultEQ XT 32 mode direct change MULTEQ:AUDYSSEY
	const MULTEQBYPLR = "BYP.LR"; // MultEQ XT 32 mode direct change MULTEQ:BYP.LR
	const MULTEQFLAT = "FLAT"; // MultEQ XT 32 mode direct change MULTEQ:FLAT
	const MULTEQMANUAL = "MANUAL"; // MultEQ XT 32 mode direct change MULTEQ:MANUAL
	const MULTEQOFF = "OFF"; // MultEQ XT 32 mode direct change MULTEQ:OFF
	const MULTEQ = " ?"; // Return PSMULTEQ: Status
	
	//PSDYNEQ Dynamic EQ
	const DYNEQON = " ON"; // Dynamic EQ = ON
	const DYNEQOFF = " OFF"; // Dynamic EQ = OFF
	const DYNEQ = " ?"; // Return PSDYNEQ Status
	
	//PSREFLEV Reference Level Offset
	const REFLEV0 = " 0"; // Reference Level Offset=0dB
	const REFLEV5 = " 5"; // Reference Level Offset=5dB
	const REFLEV10 = " 10"; // Reference Level Offset=10dB
	const REFLEV15 = " 15"; // Reference Level Offset=15dB
	const REFLEV = " ?"; // Return PSREFLEV Status
	
	//PSDYNVOL Dynamic Volume
	const DYNVOLNGT = " NGT"; // Dynamic Volume = Midnight
	const DYNVOLEVE = " EVE"; // Dynamic Volume = Evening
	const DYNVOLDAY = " DAY"; // Dynamic Volume = Day
	const DYNVOL = " ?"; // Return PSDYNVOL Status
	
	//PSDSX Audyssey DSX ON
	const PSDSXONHW = " ONHW"; // Audyssey DSX ON(Height/Wide)
	const PSDSXONH = " ONH"; // Audyssey DSX ON(Height)
	const PSDSXONW = " ONW"; // Audyssey DSX ON(Wide)
	const PSDSXOFF = " OFF"; // Audyssey DSX OFF
	const PSDSXSTATUS = " ?"; // Return PSDSX Status
	
	//PSSTW Stage Width
	const STWUP = " UP"; // STAGE WIDTH UP
	const STWDOWN = " DOWN"; // STAGE WIDTH DOWN
	const STW = " "; // STAGE WIDTH ** ---AVR-4311 can be operated from -10 to +10
	
	//PSSTH Stage Height
	const STHUP = " UP"; // STAGE HEIGHT UP
	const STHDOWN = " DOWN"; // STAGE HEIGHT DOWN
	const STH = " "; // STAGE HEIGHT ** ---AVR-4311 can be operated from -10 to +10
	
	//PSBAS Bass
	const BASUP = " UP"; // BASS UP
	const BASDOWN = " DOWN"; // BASS DOWN
	const BAS = " "; // BASS ** ---AVR-4311 can be operated from -6 to +6
	
	//PSTRE Treble
	const TREUP = " UP"; // TREBLE UP
	const TREDOWN = " DOWN"; // TREBLE DOWN
	const TRE = " "; // TREBLE ** ---AVR-4311 can be operated from -6 to +6
	
	//PSDRC DRC direct change
	const DRCAUTO = " AUTO"; // DRC direct change
	const DRCLOW = " LOW"; // DRC Low
	const DRCMID = " MID"; // DRC Middle
	const DRCHI = " HI"; // DRC High
	const DRCOFF = " OFF"; // DRC off
	const DRC = " ?"; // Return PSDRC Status
	

	//PSDCO D.Comp direct change
	const DCOOFF = " OFF"; // D.COMP direct change
	const DCOLOW = " LOW"; // D.COMP Low
	const DCOMID = " MID"; // D.COMP Middle
	const DCOHIGH = " HIGH"; // D.COMP High
	const DCO = " ?"; // Return PSDCO Status

	//PSLFE LFE	
	const LFEDOWN = " DOWN"; // LFE DOWN
	const LFEUP = " UP"; // LFE UP
	const LFE = " "; // LFE ** ---AVR-4311 can be operated from 0 to -10


	//PSEFF Effect direct change
	const PSEFFON = "N"; // EFFECT ON direct change
	const PSEFFOFF = "FF"; // EFFECT OFF direct change
	
	const PSEFFUP = " UP"; // EFFECT UP direct change
	const PSEFFDOWN = " DOWN"; // EFFECT DOWN direct change
	const PSEFFSTATUS = " ?"; // EFFECT ** ---AVR-4311 can be operated from 1 to 15


	//PSDELAY Delay
	const PSDELAYUP = " UP"; // DELAY UP
	const PSDELAYDOWN = " DOWN"; // DELAY DOWN
	const PSDELAYVAL = " "; // DELAY ** ---AVR-4311 can be operated from 0 to 300

	//PSAFD Auto Flag Detection Mode
	const AFDON = " ON"; // AFDM ON
	const AFDOFF = " OFF"; // AFDM OFF
	const AFD = " "; // Return PSAFD Status


	//PSPAN Panorama
	const PANON = "PAN ON"; // PANORAMA ON
	const PANOFF = "PAN OFF"; // PANORAMA OFF
	const PAN = "PAN ?"; // Return PSPAN Status


	//PSDIM Dimension
	const PSDIMUP = " UP"; // DIMENSION UP
	const PSDIMDOWN = " DOWN"; // DIMENSION DOWN
	const PSDIMSET = " "; // ---AVR-4311 can be operated from 0 to 6


	//PSCEN Center Width
	const CENUP = "CEN UP"; // CENTER WIDTH UP
	const CENDOWN = "CEN DOWN"; // CENTER WIDTH DOWN
	const CEN = "CEN "; // ---AVR-4311 can be operated from 0 to 7

	//PSCEI Center Image
	const CEIUP = "CEI UP"; // CENTER IMAGE UP
	const CEIDOWN = "CEI DOWN"; // CENTER IMAGE DOWN
	const CEI = "CEI "; // ---AVR-4311 can be operated from 0 to 7
	
	
	//PSRSZ Room Size
	const RSZS = " S";
	const RSZMS = " MS";
	const RSZM = " M";
	const RSZML = " ML";
	const RSZL = " L";
	
	
	//PSSW ATT
	const ATTON = "ATT ON"; // SW ATT ON
	const ATTOFF = "ATT OFF"; // SW ATT OFF
	const ATT = "ATT ?"; // Return PSATT Status
	
	//PSSWR
	const PSSWRON = " ON"; // SW ATT ON
	const PSSWROFF = " OFF"; // SW ATT OFF
	const SWR = " ?"; // Return PSATT Status
	
	//Audio Restorer
	const PSRSTROFF = " OFF"; //Audio Restorer Off
	const PSRSTRMODE1 = " MODE1"; //Audio Restorer 64
	const PSRSTRMODE2 = " MODE2"; //Audio Restorer 96
	const PSRSTRMODE3 = " MODE3"; //Audio Restorer HQ
	
	//Cursor
	const MN = "MN"; // Cursor Navigation
	const MNCUP = "CUP"; // Cursor Up
	const MNCDN = "CDN"; // Cursor Down
	const MNCRT = "CRT"; // Cursor Right
	const MNCLT = "CLT"; // Cursor Left
	const MNENT = "ENT"; // Cursor Enter
	const MNRTN = "RTN"; // Cursor Return
	
	//GUI Menu
	const MNMEN = "MNMEN"; // GUI Menu
	const MNMENON = " ON"; // GUI Menu On
	const MNMENOFF = " OFF"; // GUI Menu Off
	
	//GUI Source Select Menu
	const MNSRC = "MNSRC"; // GUI Menu
	const MNSRCON = " ON"; // GUI Menu On
	const MNSRCOFF = " OFF"; // GUI Menu Off
	
	// Surround Modes Response
	
	//Dolby Digital
	const MSDOLBYPROLOGIC = "MSDOLBY PRO LOGIC"; // DOLBY PRO LOGIC
	const MSDOLBYPL2C = "MSDOLBY PL2 C"; // DOLBY PL2 C
	const MSDOLBYPL2M = "MSDOLBY PL2 M"; // DOLBY PL2 M
	const MSDOLBYPL2G = "MSDOLBY PL2 G"; // DOLBY PL2 G
	const MSDOLBYPL2XC = "MSDOLBY PL2X C"; // DOLBY PL2X C
	const MSDOLBYPL2XM = "MSDOLBY PL2X M"; // DOLBY PL2X M
	const MSDOLBYPL2XG = "MSDOLBY PL2X G"; // DOLBY PL2X G
	const MSDOLBYPL2ZH = "MSDOLBY PL2Z H"; // DOLBY PL2Z H
	const MSDOLBYPL2XH = "MSDOLBY PL2X H"; // DOLBY PL2X H"
	const MSDOLBYDEX = "MSDOLBY D EX"; // DOLBY D EX
	const MSDOLBYD = "MSDOLBY D+"; // MSDOLBY D+
	const MSDOLBYDPL2XC = "MSDOLBY D+PL2X C"; // DOLBY D+PL2X C
	const MSDOLBYDPL2XM = "MSDOLBY D+PL2X M"; // DOLBY D+PL2X M
	const MSDOLBYDPL2XH = "MSDOLBY D+PL2X H"; // DOLBY D+PL2X H
	const MSPLDSX = "MSPL DSX"; // PL DSX
	const MSPL2CDSX = "MSPL2 C DSX"; // PL2 C DSX
	const MSPL2MDSX = "MSPL2 M DSX"; // PL2 M DSX
	const MSPL2GDSX = "MSPL2 G DSX"; // PL2 G DSX
	const MSPL2XCDSX = "MSPL2X C DSX"; // PL2X C DSX
	const MSPL2XMDSX = "MSPL2X M DSX"; // PL2X M DSX
	const MSPL2XGDSX = "MSPL2X G DSX"; // PL2X G DSX
	const MSDOLBYDPLUSPL2XC = "MSDOLBY D+ +PL2X C"; // DOLBY D+ +PL2X C
	const MSDOLBYDPLUSPL2XM = "MSDOLBY D+ +PL2X M"; // DOLBY D+ +PL2X M
	const MSDOLBYDPLUSPL2XH = "MSDOLBY D+ +PL2X H"; // DOLBY D+ +PL2X H
	const MSDOLBYHDPL2XC = "MSDOLBY HD+PL2X C"; // DOLBY HD+PL2X C
	const MSDOLBYHDPL2XM = "MSDOLBY HD+PL2X M"; // DOLBY HD+PL2X M
	const MSDOLBYHDPL2XH = "MSDOLBY HD+PL2X H"; // DOLBY HD+PL2X H
	const MSMULTICNIN = "MSMULTI CH IN"; // MULTI CH IN
	const MSMCHINPL2XC = "MSM CH IN+PL2X C"; // M CH IN+PL2X C
	const MSMCHINPL2XM = "MSM CH IN+PL2X M"; // M CH IN+PL2X M
	const MSMCHINPL2XH = "MSM CH IN+PL2X H"; // M CH IN+PL2X H
	const MSDOLBYDPLUS = "MSDOLBY D+"; // DOLBY D+
	const MSDOLBYDPLUSEX = "MSDOLBY D+ +EX"; // DOLBY D+ +EX
	const MSDOLBYTRUEHD = "MSDOLBY TRUEHD"; // DOLBY TRUEHD
	const MSDOLBYHD = "MSDOLBY HD"; // DOLBY HD
	const MSDOLBYHDEX = "MSDOLBY HD+EX"; // DOLBY HD+EX
	const MSDOLBYPL2H = "MSDOLBY PL2 H"; // MSDOLBY PL2 H
	
	const MSDOLBYSURROUND = "MSDOLBY SURROUND"; // MSDOLBY SURROUND
	const MSDOLBYATMOS = "MSDOLBY ATMOS"; // MSDOLBY ATMOS
	const MSDOLBYDIGITALRES = "MSDOLBY DIGITAL"; // MSDOLBY DIGITAL
	const MSDOLBYDDS = "MSDOLBY D+DS"; // MSDOLBY D+DS
	const MSMPEG2AAC = "MSMPEG2 AAC"; // MSMPEG2 AAC
	const MSAACDOLBYEX = "MSAAC+DOLBY EX"; // MSAAC+DOLBY EX
	const MSAACPL2XC = "MSAAC+PL2X C"; // MSAAC+PL2X C
	const MSAACPL2XM = "MSAAC+PL2X M"; // MSAAC+PL2X M
	const MSAACPL2XH = "MSAAC+PL2X H"; // MSAAC+PL2X H
	const MSAACDS = "MSAAC+DS"; // MSAAC+DS
	const MSAACNEOXC = "MSAAC+NEO:X C"; // MSAAC+NEO:X C
	const MSAACNEOXM = "MSAAC+NEO:X M"; // MSAAC+NEO:X M
	const MSAACNEOXG = "MSAAC+NEO:X G"; // MSAAC+NEO:X G
	
	//DTS Surround
	const MSDTSSURROUNDRES = "MSDTS SURROUND"; // MSDTS SURROUND
	const MSDTSNEO6C = "MSDTS NEO:6 C"; // DTS NEO:6 C
	const MSDTSNEO6M = "MSDTS NEO:6 M"; // DTS NEO:6 M
	const MSDTSNEOXC = "MSDTS NEO:X C"; // DTS NEO:X C
	const MSDTSNEOXM = "MSDTS NEO:X M"; // DTS NEO:X M
	const MSDTSNEOXG = "MSDTS NEO:X G"; // DTS NEO:X G
	const MSDTSESDSCRT61 = "MSDTS ES DSCRT6.1"; // DTS ES DSCRT6.1
	const MSDTSESMTRX61 = "MSDTS ES MTRX6.1"; // DTS ES MTRX6.1
	const MSDTSPL2XC = "MSDTS+PL2X C"; // DTS+PL2X C
	const MSDTSPL2XM = "MSDTS+PL2X M"; // DTS+PL2X M	
	const MSDTSPL2ZH = "MSDTS+PL2Z H"; // DTS+PL2Z H
	const MSDTSNEO6 = "MSDTS+NEO:6"; // DTS+NEO:6 
	const MSDTS9624 = "MSDTS96/24"; // DTS96/24
	const MSDTS96ESMTRX = "MSDTS96 ES MTRX"; // DTS96 ES MTRX
	const MSDTSHDPL2XC = "MSDTS HD+PL2X C"; // DTS HD+PL2X C
	const MSDTSHDPL2XM = "MSDTS HD+PL2X M"; // DTS HD+PL2X M
	const MSDTSHDPL2XH = "MSDTS HD+PL2X H"; // DTS HD+PL2X H
	const MSNEO6CDSX = "MSNEO:6 C DSX"; // NEO:6 C DSX
	const MSNEO6MDSX = "MSNEO:6 M DSX"; // NEO:6 M DSX
	const MSDTSHD = "MSDTS HD"; // DTS HD 
	const MSDTSHDMSTR = "MSDTS HD MSTR"; // DTS HD MSTR
	const MSDTSHDNEO6 = "MSDTS HD+NEO:6"; // DTS HD+NEO:6
	const MSDTSES8CHDSCRT = "MSDTS ES 8CH DSCRT"; // DTS ES 8CH DSCRT
	const MSDTSEXPRESS = "MSDTS EXPRESS"; // DTS EXPRESS
	const MSDTSDS = "MSDTS+DS"; // MSDTS+DS
	const MSDOLBYDNEOXC = "MSDOLBY D+NEO:X C"; // MSDOLBY D+NEO:X C
	const MSDOLBYDNEOXM = "MSDOLBY D+NEO:X M"; // MSDOLBY D+NEO:X M
	const MSDOLBYDNEOXG = "MSDOLBY D+NEO:X G"; // MSDOLBY D+NEO:X G
	const MSMCHINDS = "MSM CH IN+DS"; // MSM CH IN+DS
	const MSMCHINNEOXC = "MSM CH IN+NEO:X C"; // MSM CH IN+NEO:X C
	const MSMCHINNEOXM = "MSM CH IN+NEO:X M"; // MSM CH IN+NEO:X M
	const MSMCHINNEOXG = "MSM CH IN+NEO:X G"; // MSM CH IN+NEO:G C
	const MSDOLBYDNEWNEOXC = "MSDOLBY D+ +NEO:X C"; // MSDOLBY D+ +NEO:X C
	const MSDOLBYDNEWNEOXM = "MSDOLBY D+ +NEO:X M"; // MSDOLBY D+ +NEO:X M
	const MSDOLBYDNEWNEOXG = "MSDOLBY D+ +NEO:X G"; // MSDOLBY D+ +NEO:X G
	const MSDOLBYHDDS = "MSDOLBY HD+DS"; // MSDOLBY HD+DS
	const MSDOLBYHDNEOXC = "MSDOLBY HD+NEO:X C"; // MSDOLBY HD+NEO:X C
	const MSDOLBYHDNEOXM = "MSDOLBY HD+NEO:X M"; // MSDOLBY HD+NEO:X M
	const MSDOLBYHDNEOXG = "MSDOLBY HD+NEO:X G"; // MSDOLBY HD+NEO:X G
	const MSDTSHDDS = "MSDTS HD+DS"; // MSDTS HD+DS
	const MSDTSHDNEOXC = "MSDTS HD+NEO:X C"; // MSDTS HD+NEO:X C
	const MSDTSHDNEOXM = "MSDTS HD+NEO:X M"; // MSDTS HD+NEO:X M
	const MSDTSHDNEOXG = "MSDTS HD+NEO:X G"; // MSDTS HD+NEO:X G
	
	//Auro 3D
	const MSAURO3D = "MSAURO3D"; //MSAURO3D
	const MSAURO2DSURR = "MSAURO2DSURR";//MSAURO2DSURR

	const MSDSDDIRECT = "MSDSD DIRECT"; // DSD DIRECT
	
	const MSMCHINDOLBYEX = "MSM CH IN+DOLBY EX"; // M CH IN+DOLBY EX
	const MSMULTICHIN71 = "MSMULTI CH IN 7.1"; // MULTI CH IN 7.1

	const MSAUDYSSEYDSX = "MSAUDYSSEY DSX"; // AUDYSSEY DSX
	
	// Surround Modes Varmapping
	
	//Dolby Digital
	const DOLBYPROLOGIC = "DOLBY PRO LOGIC"; // DOLBY PRO LOGIC
	const DOLBYPL2C = "DOLBY PL2 C"; // DOLBY PL2 C
	const DOLBYPL2M = "DOLBY PL2 M"; // DOLBY PL2 M
	const DOLBYPL2G = "DOLBY PL2 G"; // DOLBY PL2 G
	const DOLBYPL2XC = "DOLBY PL2X C"; // DOLBY PL2X C
	const DOLBYPL2XM = "DOLBY PL2X M"; // DOLBY PL2X M
	const DOLBYPL2XG = "DOLBY PL2X G"; // DOLBY PL2X G
	const DOLBYPL2ZH = "DOLBY PL2Z H"; // DOLBY PL2Z H
	const DOLBYPL2XH = "DOLBY PL2X H"; // DOLBY PL2X H"
	const DOLBYDEX = "DOLBY D EX"; // DOLBY D EX
	const DOLBYD = "DOLBY D+"; // MSDOLBY D+
	const DOLBYDPL2XC = "DOLBY D+PL2X C"; // DOLBY D+PL2X C
	const DOLBYDPL2XM = "DOLBY D+PL2X M"; // DOLBY D+PL2X M
	const DOLBYDPL2XH = "DOLBY D+PL2X H"; // DOLBY D+PL2X H
	const PLDSX = "PL DSX"; // PL DSX
	const PL2CDSX = "PL2 C DSX"; // PL2 C DSX
	const PL2MDSX = "PL2 M DSX"; // PL2 M DSX
	const PL2GDSX = "PL2 G DSX"; // PL2 G DSX
	const PL2XCDSX = "PL2X C DSX"; // PL2X C DSX
	const PL2XMDSX = "PL2X M DSX"; // PL2X M DSX
	const PL2XGDSX = "PL2X G DSX"; // PL2X G DSX
	const DOLBYDPLUSPL2XC = "DOLBY D+ +PL2X C"; // DOLBY D+ +PL2X C
	const DOLBYDPLUSPL2XM = "DOLBY D+ +PL2X M"; // DOLBY D+ +PL2X M
	const DOLBYDPLUSPL2XH = "DOLBY D+ +PL2X H"; // DOLBY D+ +PL2X H
	const DOLBYHDPL2XC = "DOLBY HD+PL2X C"; // DOLBY HD+PL2X C
	const DOLBYHDPL2XM = "DOLBY HD+PL2X M"; // DOLBY HD+PL2X M
	const DOLBYHDPL2XH = "DOLBY HD+PL2X H"; // DOLBY HD+PL2X H
	const MULTICNIN = "MULTI CH IN"; // MULTI CH IN
	const MCHINPL2XC = "M CH IN+PL2X C"; // M CH IN+PL2X C
	const MCHINPL2XM = "M CH IN+PL2X M"; // M CH IN+PL2X M
	const MCHINPL2XH = "M CH IN+PL2X H"; // M CH IN+PL2X H
	const DOLBYDPLUS = "DOLBY D+"; // DOLBY D+
	const DOLBYDPLUSEX = "DOLBY D+ +EX"; // DOLBY D+ +EX
	const DOLBYTRUEHD = "DOLBY TRUEHD"; // DOLBY TRUEHD
	const DOLBYHD = "DOLBY HD"; // DOLBY HD
	const DOLBYHDEX = "DOLBY HD+EX"; // DOLBY HD+EX
	const DOLBYPL2H = "DOLBY PL2 H"; // MSDOLBY PL2 H
	
	const DOLBYSURROUND = "DOLBY SURROUND"; // MSDOLBY SURROUND
	const DOLBYATMOS = "DOLBY ATMOS"; // MSDOLBY ATMOS
	const DOLBYDIGITALRES = "DOLBY DIGITAL"; // MSDOLBY DIGITAL
	const DOLBYDDS = "DOLBY D+DS"; // MSDOLBY D+DS
	const MPEG2AAC = "MPEG2 AAC"; // MSMPEG2 AAC
	const AACDOLBYEX = "AAC+DOLBY EX"; // MSAAC+DOLBY EX
	const AACPL2XC = "AAC+PL2X C"; // MSAAC+PL2X C
	const AACPL2XM = "AAC+PL2X M"; // MSAAC+PL2X M
	const AACPL2XH = "AAC+PL2X H"; // MSAAC+PL2X H
	const AACDS = "AAC+DS"; // MSAAC+DS
	const AACNEOXC = "AAC+NEO:X C"; // MSAAC+NEO:X C
	const AACNEOXM = "AAC+NEO:X M"; // MSAAC+NEO:X M
	const AACNEOXG = "AAC+NEO:X G"; // MSAAC+NEO:X G
	
	//DTS Surround
	const DTSSURROUNDRES = "DTS SURROUND"; // MSDTS SURROUND
	const DTSNEO6C = "DTS NEO:6 C"; // DTS NEO:6 C
	const DTSNEO6M = "DTS NEO:6 M"; // DTS NEO:6 M
	const DTSNEOXC = "DTS NEO:X C"; // DTS NEO:X C
	const DTSNEOXM = "DTS NEO:X M"; // DTS NEO:X M
	const DTSNEOXG = "DTS NEO:X G"; // DTS NEO:X G
	const DTSESDSCRT61 = "DTS ES DSCRT6.1"; // DTS ES DSCRT6.1
	const DTSESMTRX61 = "DTS ES MTRX6.1"; // DTS ES MTRX6.1
	const DTSPL2XC = "DTS+PL2X C"; // DTS+PL2X C
	const DTSPL2XM = "DTS+PL2X M"; // DTS+PL2X M	
	const DTSPL2ZH = "DTS+PL2Z H"; // DTS+PL2Z H
	const DTSNEO6 = "DTS+NEO:6"; // DTS+NEO:6 
	const DTS9624 = "DTS96/24"; // DTS96/24
	const DTS96ESMTRX = "DTS96 ES MTRX"; // DTS96 ES MTRX
	const DTSHDPL2XC = "DTS HD+PL2X C"; // DTS HD+PL2X C
	const DTSHDPL2XM = "DTS HD+PL2X M"; // DTS HD+PL2X M
	const DTSHDPL2XH = "DTS HD+PL2X H"; // DTS HD+PL2X H
	const NEO6CDSX = "NEO:6 C DSX"; // NEO:6 C DSX
	const NEO6MDSX = "NEO:6 M DSX"; // NEO:6 M DSX
	const DTSHD = "DTS HD"; // DTS HD 
	const DTSHDMSTR = "DTS HD MSTR"; // DTS HD MSTR
	const DTSHDNEO6 = "DTS HD+NEO:6"; // DTS HD+NEO:6
	const DTSES8CHDSCRT = "DTS ES 8CH DSCRT"; // DTS ES 8CH DSCRT
	const DTSEXPRESS = "DTS EXPRESS"; // DTS EXPRESS
	const DTSDS = "DTS+DS"; // MSDTS+DS
	const DOLBYDNEOXC = "DOLBY D+NEO:X C"; // MSDOLBY D+NEO:X C
	const DOLBYDNEOXM = "DOLBY D+NEO:X M"; // MSDOLBY D+NEO:X M
	const DOLBYDNEOXG = "DOLBY D+NEO:X G"; // MSDOLBY D+NEO:X G
	const MCHINDS = "M CH IN+DS"; // MSM CH IN+DS
	const MCHINNEOXC = "M CH IN+NEO:X C"; // MSM CH IN+NEO:X C
	const MCHINNEOXM = "M CH IN+NEO:X M"; // MSM CH IN+NEO:X M
	const MCHINNEOXG = "M CH IN+NEO:X G"; // MSM CH IN+NEO:G C
	const DOLBYDNEWNEOXC = "DOLBY D+ +NEO:X C"; // MSDOLBY D+ +NEO:X C
	const DOLBYDNEWNEOXM = "DOLBY D+ +NEO:X M"; // MSDOLBY D+ +NEO:X M
	const DOLBYDNEWNEOXG = "DOLBY D+ +NEO:X G"; // MSDOLBY D+ +NEO:X G
	const DOLBYHDDS = "DOLBY HD+DS"; // MSDOLBY HD+DS
	const DOLBYHDNEOXC = "DOLBY HD+NEO:X C"; // MSDOLBY HD+NEO:X C
	const DOLBYHDNEOXM = "DOLBY HD+NEO:X M"; // MSDOLBY HD+NEO:X M
	const DOLBYHDNEOXG = "DOLBY HD+NEO:X G"; // MSDOLBY HD+NEO:X G
	const DTSHDDS = "DTS HD+DS"; // MSDTS HD+DS
	const DTSHDNEOXC = "DTS HD+NEO:X C"; // MSDTS HD+NEO:X C
	const DTSHDNEOXM = "DTS HD+NEO:X M"; // MSDTS HD+NEO:X M
	const DTSHDNEOXG = "DTS HD+NEO:X G"; // MSDTS HD+NEO:X G
	
	//Auro 3D
	const AURO3D = "AURO3D"; //MSAURO3D
	const AURO2DSURR = "AURO2DSURR";//MSAURO2DSURR

	const DSDDIRECT = "DSD DIRECT"; // DSD DIRECT
	
	const MCHINDOLBYEX = "M CH IN+DOLBY EX"; // M CH IN+DOLBY EX
	const MULTICHIN71 = "MULTI CH IN 7.1"; // MULTI CH IN 7.1

	const AUDYSSEYDSX = "AUDYSSEY DSX"; // AUDYSSEY DSX
	
	
	const SURROUNDDISPLAY = "SurroundDisplay"; // Nur DisplayIdent
	
	
	// AVR-X7200W / AVR-X5200W / AVR-X4100W / AVR-X3100W / AVR-X2100W / S900W / AVR-X1100W / S700W
	const PSGRAPHICEQ = "PSGEQ"; // Graphic EQ
	const PSGRAPHICEQON = " ON"; // Graphic EQ On
	const PSGRAPHICEQOFF = " OFF"; // Graphic EQ Off
	
	const PSDIL = "PSDIL"; // Dialog Level Adjust
	const PSDILON = " ON"; // Dialog Level Adjust On
	const PSDILOFF = " OFF"; // Dialog Level Adjust Off
	
	const STBY = "STBY"; // Mainzone Auto Standby
	const STBY15M = "15M"; // Mainzone Auto Standby 15 Minuten
	const STBY30M = "30M"; // Mainzone Auto Standby 30 Minuten
	const STBY60M = "60M"; // Mainzone Auto Standby 60 Minuten
	const STBYOFF = "OFF"; // Mainzone Auto Standby Off
	const Z2STBY = "Z2STBY"; // Zone 2 Auto Standby
	const Z2STBY2H = "2H"; // Zone 2 Auto Standby 2h
	const Z2STBY4H = "4H"; // Zone 2 Auto Standby 4h
	const Z2STBY8H = "8H"; // Zone 2 Auto Standby 8h
	const Z2STBYOFF = "OFF"; // Zone 2 Auto Standby Off
	const Z3STBY = "Z3STBY"; // Zone 3 Auto Standby
	const Z3STBY2H = "2H"; // Zone 3 Auto Standby 2H
	const Z3STBY4H = "4H"; // Zone 3 Auto Standby 4h
	const Z3STBY8H = "8H"; // Zone 3 Auto Standby 8h
	const Z3STBYOFF = "OFF"; // Zone 3 Auto Standby Off
	const ECO = "ECO"; // ECO Mode
	const ECOON = "ON"; // ECO Mode On
	const ECOAUTO = "AUTO"; // ECO Mode Auto
	const ECOOFF = "OFF"; // ECO Mode Off
	const DIM = "DIM"; // Dimmer
	const DIMBRI = " BRI"; // Bright
	const DIMDIM = " DIM"; // DIM
	const DIMDAR = " DAR"; // Dark
	const DIMOFF = " OFF"; // Dimmer off

	// AVR-X7200W / AVR-X5200W / AVR-X4100W
	const PSCES = "PSCES"; // Center Spread
	const PSCESON = " ON"; // Center Spread On
	const PSCESOFF = " OFF"; // Center Spread Off
	const PSAUROST = "PSAUROPR"; // Auro Matic 3D Strength
	const PSAUROSTUP = " UP"; // Auro Matic 3D Strength Up
	const PSAUROSTDOWN = " DOWN"; // Auro Matic 3D Strength Down
	
	const PSAUROPR = "PSAUROPR"; // Auro Matic 3D Present
	const PSAUROPRSMA = " SMA"; // Auro Matic 3D Present Small
	const PSAUROPRMED = " MED"; // Auro Matic 3D Present Medium
	const PSAUROPRLAR = " LAR"; // Auro Matic 3D Present Large
	const PSAUROPRSPE = " SPE"; // Auro Matic 3D Present SPE
	
	const CVSHL = "CVSHL"; // Surround Height Left
	const CVSHR = "CVSHR"; // Surround Height Right
	const CVTS = "CVTS"; // Top Surround
	
	const CVTFL = "CVTFL"; // Top Front Left
	const CVTFR = "CVTFR"; // Top Front Right
	const CVTML = "CVTML"; // Top Middle Left
	const CVTMR = "CVTMR"; // Top Middle Right
	const CVTRL = "CVTRL"; // Top Rear Left
	const CVTRR = "CVTRR"; // Top Rear Right
	const CVRHL = "CVRHL"; // Rear Height Left
	const CVRHR = "CVRHR"; // Rear Height Right
	const CVFDL = "CVFDL"; // Front Dolby Left
	const CVFDR = "CVFDR"; // Front Dolby Right
	const CVSDL = "CVSDL"; // Surround Dolby Left
	const CVSDR = "CVSDR"; // Surround Dolby Right
	const CVBDL = "CVBDL"; // Back Dolby Left
	const CVBDR = "CVBDR"; // Back Dolby Right
	
	
	const IsVariable = 0;
    const VarType = 1;
    const VarName = 2;
    const Profile = 3;
    const EnableAction = 4;
    const RequestValue = 5;
    const ValueMapping = 6;
    const ValuePrefix = 7;
	
	// Mapping von CMDs der Main auf identische CMDs der Zonen
	
    static $CMDMapping = array(
        DENON_API_Commands::PW => array(
            DENON_Zone::Mainzone => DENON_API_Commands::ZM,            
            DENON_Zone::Zone2 => DENON_API_Commands::Z2,
            DENON_Zone::Zone3 => DENON_API_Commands::Z3
        )
    );
}	

class DENON_API_Command_Mapping extends stdClass
{

    static public function GetMapping($Cmd) //__construct($Cmd)
    {
        if (array_key_exists($Cmd, DENON_API_Commands::$CMDMapping))
        {
//            IPS_LogMessage('GetMapping', print_r(ISCP_API_Commands::$CMDMapping[$Cmd], 1));
            return DENON_API_Commands::$CMDMapping[$Cmd];
            /*
              $this->VarType = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::VarType];
              $this->EnableAction = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::EnableAction];
              $this->Profile = ISCP_API_Commands::$VarMapping[$Cmd][ISCP_API_Commands::Profile];
             */
        }
        else
            return null;
    }

}

class DENON_API_Data_Mapping extends stdClass
{

//    public $VarType;
//    public $EnableAction;
//    public $Profile;

    static public function GetMapping($Cmd) //__construct($Cmd)
    {
        if (array_key_exists($Cmd, DENON_API_Commands::$VarMapping))
        {
            $result = new stdClass;
            $result->IsVariable = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::IsVariable];
            $result->VarType = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::VarType];
            $result->VarName = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::VarName];
            $result->Profile = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::Profile];
            $result->EnableAction = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::EnableAction];
            $result->RequestValue = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::RequestValue];

            $result->ValueMapping = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::ValueMapping];

            if (array_key_exists(DENON_API_Commands::ValuePrefix, DENON_API_Commands::$VarMapping[$Cmd]))
                $result->ValuePrefix = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::ValuePrefix];

            return $result;
            /*
              $this->VarType = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::VarType];
              $this->EnableAction = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::EnableAction];
              $this->Profile = DENON_API_Commands::$VarMapping[$Cmd][DENON_API_Commands::Profile];
             */
        }
        else
            return null;
    }

}


class DenonAVRCP_API_Data extends stdClass
{

    public $APICommand;
	public $APIIdent;
    public $Data;
    public $Mapping = null;
    public $APISubCommand = null;
	public $MapMainzoneInputs;
	public $MapZ2Inputs;
	public $MapZ3Inputs;
	public $AVRProtocol;
	public $InputMapping;
	public $AVRType;
	public $AVRZone;
		
	public $VarMapping = array
				(
					//Boolean
					//Power
					DENON_API_Commands::PW
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "STANDBY" => false)
					),
					//MainZonePower
					DENON_API_Commands::ZM
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//MainMute
					DENON_API_Commands::MU
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//CinemaEQ
					DENON_API_Commands::PSCINEMAEQ
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(".ON" => true, ".OFF" => false)
					),
					//Panorama
					DENON_API_Commands::PSPAN
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//ToneCTRL
					DENON_API_Commands::PSTONECTRL
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//FrontHeight
					DENON_API_Commands::PSFH
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(":ON" => true, ":OFF" => false)
					),
					//DynamicEQ
					DENON_API_Commands::PSDYNEQ
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//Vertical Stretch
					DENON_API_Commands::VSVST
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//Dolby Volume
					DENON_API_Commands::PSDOLVOL
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//Effect
					DENON_API_Commands::PSEFF
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//AFDM
					DENON_API_Commands::PSAFD
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//Subwoofer
					DENON_API_Commands::PSSWR
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//Subwoofer ATT
					DENON_API_Commands::PSATT
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//Zone 2
					//Zone 2 Power
					DENON_API_Commands::Z2POWER
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//Zone 2 Mute
					DENON_API_Commands::Z2MU
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//Zone 2 HPF
					DENON_API_Commands::Z2HPF
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//Zone 3
					//Zone 3 Power
					DENON_API_Commands::Z3POWER
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//Zone 3 Mute
					DENON_API_Commands::Z3MU
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					//Zone 3 HPF
					DENON_API_Commands::Z3HPF
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("ON" => true, "OFF" => false)
					),
					
					//Integer
					//Sleep ***:001 to 120 by ASCII , 010=10min
					DENON_API_Commands::SLP
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("OFF" => 0, "010" => 10, "020" => 20, "030" => 30, "040" => 40, "050" => 50, "060" => 60, "070" => 70, "080" => 80, "090" => 90, "100" => 100, "110" => 110, "120" => 120)
					),
					//Dimension **:00 to 06 by ASCII , 00=0, can be operated from 0 to 6
					DENON_API_Commands::PSDIM
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" 00" => 0, " 01" => 1, " 02" => 2, " 03" => 3, " 04" => 4, " 05" => 5, " 06" => 6)
					),
					//Zone 2
					//Sleep Zone 2 ***:001 to 120 by ASCII , 010=10min
					DENON_API_Commands::Z2SLP
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("OFF" => 0, "010" => 10, "020" => 20, "030" => 30, "040" => 40, "050" => 50, "060" => 60, "070" => 70, "080" => 80, "090" => 90, "100" => 100, "110" => 110, "120" => 120)
					),
					//Zone 3
					//Sleep Zone 3 ***:001 to 120 by ASCII , 010=10min
					DENON_API_Commands::Z3SLP
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("OFF" => 0, "010" => 10, "020" => 20, "030" => 30, "040" => 40, "050" => 50, "060" => 60, "070" => 70, "080" => 80, "090" => 90, "100" => 100, "110" => 110, "120" => 120)
					),
					// Integer Association
					//Navigation
					DENON_API_Commands::MN
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("CLT" => 0, "CDN" => 1, "CUP" => 2, "CRT" => 3, "ENT" => 4, "RTN" => 5)
					),
					//Quick Select
					DENON_API_Commands::MSQUICK
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("0" => 0, "1" => 1, "2" => 2, "3" => 3, "4" => 4, "5" => 5)
					),
					//Digital Input Mode
					DENON_API_Commands::DC
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("AUTO" => 0, "PCM" => 1, "DTS" => 2)
					),
					//Surround Play Mode
					DENON_API_Commands::PSMODE
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(":CINEMA" => 0, ":MUSIC" => 1, ":GAME" => 2, ":PRO LOGIC" => 3)
					),
					//Multi EQ Mode
					DENON_API_Commands::PSMULTEQ
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(":OFF" => 0, ":AUDYSSEY" => 1, ":BYP.LR" => 2, ":FLAT" => 3, ":MANUAL" => 4)
					),
					//Audio Restorer
					DENON_API_Commands::PSRSTR
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" OFF" => 0, " MODE1" => 1, " MODE2" => 2, " MODE3" => 3)
					),
					//Dynamic Volume
					DENON_API_Commands::PSDYNVOL
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" NGT" => 0, " EVE" => 1, " DAY" => 2)
					),
					//Room Size
					DENON_API_Commands::PSRSZ
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" S" => 0, " MS" => 1, " N" => 2, " ML" => 3, " L" => 4)
					),
					//Dynamic Compressor
					DENON_API_Commands::PSDCO
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" OFF" => 0, " LOW" => 1, " MID" => 2, " HIGH" => 3)
					),
					//Dynamic Range
					DENON_API_Commands::PSDRC
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" OFF" => 0, " AUTO" => 1, " LOW" => 2, " MID" => 3, " HIGH" => 4)
					),
					//Video Select
					DENON_API_Commands::SV
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("DVD" => 0, "BD" => 1, "TV" => 2, "SAT/CBL" => 3, "DVR" => 4, "GAME" => 5, "V.AUX" => 6, "DOCK" => 7, "SOURCE" => 8)
					),
					//Surround Back Mode
					DENON_API_Commands::PSSB
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(":OFF" => 0, ":ON" => 1, ":MTRX ON" => 2, ":PL2X CINEMA" => 3, ":PL2X MUSIC" => 4)
					),
					//HDMI Monitor
					DENON_API_Commands::VSMONI
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("AUTO" => 0, "1" => 1, "2" => 2)
					),
					//Speaker Output Front
					DENON_API_Commands::PSSP
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(":OFF" => 0, ":FH" => 1, ":FW" => 2, ":HW" => 3)
					),
					//Reference Level
					DENON_API_Commands::PSREFLEV
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" 0" => 0, " 5" => 1, " 10" => 2, " 15" => 3)
					),
					//PLIIZ Height Gain
					DENON_API_Commands::PSPHG
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" LOW" => 0, " MID" => 1, " HI" => 2)
					),
					//Dolby Volume Modeler
					DENON_API_Commands::PSVOLMOD
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" OFF" => 0, " HLF" => 1, " FUL" => 2)
					),
					//Dolby Volume Leveler
					DENON_API_Commands::PSVOLLEV
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" LOW" => 0, " MID" => 1, " HI" => 2)
					),
					//Video Processing Mode
					DENON_API_Commands::VSVPM
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("AUTO" => 0, "GAME" => 1, "MOVIE" => 2)
					),
					//HDMI Audio Output
					DENON_API_Commands::VSAUDIO
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" TV" => 0, " AMP" => 1)
					),
					//Resolution HDMI
					DENON_API_Commands::VSSCH
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("48P" => 0, "10I" => 1, "72P" => 2, "10P" => 3, "10P24" => 4, "AUTO" => 5)
					),
					//Resolution
					DENON_API_Commands::VSSC
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("48P" => 0, "10I" => 1, "72P" => 2, "10P" => 3, "10P24" => 4, "AUTO" => 5)
					),
					//ASP
					DENON_API_Commands::VSASP
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("NRM" => 0, "FUL" => 1)
					),
					//DNR Direct Change
					DENON_API_Commands::PVDNR
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" OFF" => 0, " LOW" => 1, " MID" => 2, " HI" => 3)
					),
					//Input Mode
					DENON_API_Commands::SD
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("AUTO" => 0, "HDMI" => 1, "DIGITAL" => 2, "ANALOG" => 3, "EXT.IN" => 4)
					),
					//Audyssey DSX
					DENON_API_Commands::PSDSX
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" OFF" => 0, " ONW" => 1, " ONH" => 2, " ONHW" => 3)
					),
					//Zone 2
								
					//Zone 2 Channel Setting
					DENON_API_Commands::Z2CS
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("ST" => 0, "MONO" => 1)
					),
					//Zone 2 Quick Selektion
					DENON_API_Commands::Z2QUICK
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" ?" => 0, "1" => 1, "2" => 2, "3" => 3, "4" => 4, "5" => 5)
					),
					//Zone 3
					
					//Zone 3 Channel Setting
					DENON_API_Commands::Z3CS
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array("ST" => 0, "MONO" => 1)
					),
					//Zone 3 Quick Selektion
					DENON_API_Commands::Z3QUICK
					=> array(
						"VarType" => DENONIPSVarType::vtInteger,
						"ValueMapping" => array(" ?" => 0, "1" => 1, "2" => 2, "3" => 3, "4" => 4, "5" => 5)
					),				
					//Float
					//Master Volume
					DENON_API_Commands::MV
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array
						(
						"00" => -80, 
						"005" => -79.5, 
						"01" => -79, 
						"015" => -78.5, 
						"02" => -78, 
						"025" => -77.5, 
						"03" => -77, 
						"035" => -76.5, 
						"04" => -76, 
						"045" => -75.5, 
						"05" => -75, 
						"055" => -74.5, 
						"06" => -74, 
						"065" => -73.5, 
						"07" => -73, 
						"075" => -72.5, 
						"08" => -72, 
						"085" => -71.5, 
						"09" => -71, 
						"095" => -70.5, 
						"10" => -70, 
						"105" => -69.5, 
						"11" => -69, 
						"115" => -68.5, 
						"12" => -68, 
						"125" => -67.5, 
						"13" => -67, 
						"135" => -66.5, 
						"14" => -66, 
						"145" => -65.5, 
						"15" => -65, 
						"155" => -64.5, 
						"16" => -64, 
						"165" => -63.5, 
						"17" => -63, 
						"175" => -62.5, 
						"18" => -62, 
						"185" => -61.5, 
						"19" => -61, 
						"195" => -60.5, 
						"20" => -60, 
						"205" => -59.5, 
						"21" => -59, 
						"215" => -58.5, 
						"22" => -58, 
						"225" => -57.5, 
						"23" => -57, 
						"235" => -56.5, 
						"24" => -56, 
						"245" => -55.5, 
						"25" => -55, 
						"255" => -54.5, 
						"26" => -54, 
						"265" => -53.5, 
						"27" => -53, 
						"275" => -52.5, 
						"28" => -52, 
						"285" => -51.5, 
						"29" => -51, 
						"295" => -50.5, 
						"30" => -50, 
						"305" => -49.5, 
						"31" => -49, 
						"315" => -48.5, 
						"32" => -48, 
						"325" => -47.5, 
						"33" => -47, 
						"335" => -46.5, 
						"34" => -46, 
						"345" => -45.5, 
						"35" => -45, 
						"355" => -44.5, 
						"36" => -44, 
						"365" => -43.5, 
						"37" => -43, 
						"375" => -42.5, 
						"38" => -42, 
						"385" => -41.5, 
						"39" => -41, 
						"395" => -40.5, 
						"40" => -40, 
						"405" => -39.5, 
						"41" => -39, 
						"415" => -38.5, 
						"42" => -38, 
						"425" => -37.5, 
						"43" => -37, 
						"435" => -36.5, 
						"44" => -36, 
						"445" => -35.5, 
						"45" => -35, 
						"455" => -34.5, 
						"46" => -34, 
						"465" => -33.5, 
						"47" => -33, 
						"475" => -32.5, 
						"48" => -32, 
						"485" => -31.5, 
						"49" => -31, 
						"495" => -30.5, 
						"50" => -30, 
						"505" => -29.5, 
						"51" => -29, 
						"515" => -28.5, 
						"52" => -28, 
						"525" => -27.5, 
						"53" => -27, 
						"535" => -26.5, 
						"54" => -26, 
						"545" => -25.5, 
						"55" => -25, 
						"555" => -24.5, 
						"56" => -24, 
						"565" => -23.5, 
						"57" => -23, 
						"575" => -22.5, 
						"58" => -22, 
						"585" => -21.5, 
						"59" => -21, 
						"595" => -20.5, 
						"60" => -20, 
						"605" => -19.5, 
						"61" => -19, 
						"615" => -18.5, 
						"62" => -18, 
						"625" => -17.5, 
						"63" => -17, 
						"635" => -16.5, 
						"64" => -16, 
						"645" => -15.5, 
						"65" => -15, 
						"655" => -14.5, 
						"66" => -14, 
						"665" => -13.5, 
						"67" => -13, 
						"675" => -12.5, 
						"68" => -12, 
						"685" => -11.5, 
						"69" => -11, 
						"695" => -10.5, 
						"70" => -10, 
						"705" => -9.5, 
						"71" => -9, 
						"715" => -8.5, 
						"72" => -8, 
						"725" => -7.5, 
						"73" => -7, 
						"735" => -6.5, 
						"74" => -6, 
						"745" => -5.5, 
						"75" => -5, 
						"755" => -4.5, 
						"76" => -4, 
						"765" => -3.5, 
						"77" => -3, 
						"775" => -2.5, 
						"78" => -2, 
						"785" => -1.5, 
						"79" => -1, 
						"795" => -0.5, 
						"80" => 0, 
						"805" => 0.5, 
						"81" => 1, 
						"815" => 1.5, 
						"82" => 2, 
						"825" => 2.5, 
						"83" => 3, 
						"835" => 3.5, 
						"84" => 4, 
						"845" => 4.5, 
						"85" => 5, 
						"855" => 5.5, 
						"86" => 6, 
						"865" => 6.5, 
						"87" => 7, 
						"875" => 7.5, 
						"88" => 8, 
						"885" => 8.5, 
						"89" => 9, 
						"895" => 9.5, 
						"90" => 10, 
						"905" => 10.5, 
						"91" => 11, 
						"915" => 11.5, 
						"92" => 12, 
						"925" => 12.5, 
						"93" => 13, 
						"935" => 13.5, 
						"94" => 14, 
						"945" => 14.5, 
						"95" => 15, 
						"955" => 15.5, 
						"96" => 16, 
						"965" => 16.5, 
						"97" => 17, 
						"975" => 17.5, 
						"98" => 18
						)
					),
					//Channel Volume FL **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVFL
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume FR **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVFR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume C **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVC
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume SW **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVSW
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume SW2 **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVSW2
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume SL **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVSL
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume SR **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVSR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume SBL **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVSBL
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume SBR **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVSBR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume SB **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVSB
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume FHL **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVFHL
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume FHR **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVFHR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume FWL **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVFWL
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Channel Volume FWR **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::CVFWR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Audio Delay ***:000 to 300 by ASCII , 000=0ms, 300=300ms
					DENON_API_Commands::PSDELAY
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 000" => 0, " 001" => 1, " 002" => 2, " 003" => 3, " 004" => 4, " 005" => 5, " 006" => 6, " 007" => 7, " 008" => 8, " 009" => 9, " 010" => 10, " 011" => 11, " 012" => 12,
						" 013" => 13, " 014" => 14, " 015" => 15, " 016" => 16, " 017" => 17, " 018" => 18, " 019" => 19, " 020" => 20, " 021" => 21, " 022" => 22, " 023" => 23, " 024" => 24, " 025" => 25, " 026" => 26,
						" 027" => 27, " 028" => 28, " 029" => 29, " 030" => 30, " 031" => 31, " 032" => 32, " 033" => 33, " 034" => 34, " 035" => 35, " 036" => 36, " 037" => 37, " 038" => 38, " 039" => 39, " 040" => 40,
						" 041" => 41,
					" 042" => 42,
					" 043" => 43,
					" 044" => 44,
					" 045" => 45,
					" 046" => 46,
					" 047" => 47,
					" 048" => 48,
					" 049" => 49,
					" 050" => 50,
					" 051" => 51,
					" 052" => 52,
					" 053" => 53,
					" 054" => 54,
					" 055" => 55,
					" 056" => 56,
					" 057" => 57,
					" 058" => 58,
					" 059" => 59,
					" 060" => 60,
					" 061" => 61,
					" 062" => 62,
					" 063" => 63,
					" 064" => 64,
					" 065" => 65,
					" 066" => 66,
					" 067" => 67,
					" 068" => 68,
					" 069" => 69,
					" 070" => 70,
					" 071" => 71,
					" 072" => 72,
					" 073" => 73,
					" 074" => 74,
					" 075" => 75,
					" 076" => 76,
					" 077" => 77,
					" 078" => 78,
					" 079" => 79,
					" 080" => 80,
					" 081" => 81,
					" 082" => 82,
					" 083" => 83,
					" 084" => 84,
					" 085" => 85,
					" 086" => 86,
					" 087" => 87,
					" 088" => 88,
					" 089" => 89,
					" 090" => 90,
					" 091" => 91,
					" 092" => 92,
					" 093" => 93,
					" 094" => 94,
					" 095" => 95,
					" 096" => 96,
					" 097" => 97,
					" 098" => 98,
					" 099" => 99,
					" 100" => 100,
					" 101" => 101,
					" 102" => 102,
					" 103" => 103,
					" 104" => 104,
					" 105" => 105,
					" 106" => 106,
					" 107" => 107,
					" 108" => 108,
					" 109" => 109,
					" 110" => 110,
					" 111" => 111,
					" 112" => 112,
					" 113" => 113,
					" 114" => 114,
					" 115" => 115,
					" 116" => 116,
					" 117" => 117,
					" 118" => 118,
					" 119" => 119,
					" 120" => 120,
					" 121" => 121,
					" 122" => 122,
					" 123" => 123,
					" 124" => 124,
					" 125" => 125,
					" 126" => 126,
					" 127" => 127,
					" 128" => 128,
					" 129" => 129,
					" 130" => 130,
					" 131" => 131,
					" 132" => 132,
					" 133" => 133,
					" 134" => 134,
					" 135" => 135,
					" 136" => 136,
					" 137" => 137,
					" 138" => 138,
					" 139" => 139,
					" 140" => 140,
					" 141" => 141,
					" 142" => 142,
					" 143" => 143,
					" 144" => 144,
					" 145" => 145,
					" 146" => 146,
					" 147" => 147,
					" 148" => 148,
					" 149" => 149,
					" 150" => 150,
					" 151" => 151,
					" 152" => 152,
					" 153" => 153,
					" 154" => 154,
					" 155" => 155,
					" 156" => 156,
					" 157" => 157,
					" 158" => 158,
					" 159" => 159,
					" 160" => 160,
					" 161" => 161,
					" 162" => 162,
					" 163" => 163,
					" 164" => 164,
					" 165" => 165,
					" 166" => 166,
					" 167" => 167,
					" 168" => 168,
					" 169" => 169,
					" 170" => 170,
					" 171" => 171,
					" 172" => 172,
					" 173" => 173,
					" 174" => 174,
					" 175" => 175,
					" 176" => 176,
					" 177" => 177,
					" 178" => 178,
					" 179" => 179,
					" 180" => 180,
					" 181" => 181,
					" 182" => 182,
					" 183" => 183,
					" 184" => 184,
					" 185" => 185,
					" 186" => 186,
					" 187" => 187,
					" 188" => 188,
					" 189" => 189,
					" 190" => 190,
					" 191" => 191,
					" 192" => 192,
					" 193" => 193,
					" 194" => 194,
					" 195" => 195,
					" 196" => 196,
					" 197" => 197,
					" 198" => 198,
					" 199" => 199,
					" 200" => 200,
					" 201" => 201,
					" 202" => 202,
					" 203" => 203,
					" 204" => 204,
					" 205" => 205,
					" 206" => 206,
					" 207" => 207,
					" 208" => 208,
					" 209" => 209,
					" 210" => 210,
					" 211" => 211,
					" 212" => 212,
					" 213" => 213,
					" 214" => 214,
					" 215" => 215,
					" 216" => 216,
					" 217" => 217,
					" 218" => 218,
					" 219" => 219,
					" 220" => 220,
					" 221" => 221,
					" 222" => 222,
					" 223" => 223,
					" 224" => 224,
					" 225" => 225,
					" 226" => 226,
					" 227" => 227,
					" 228" => 228,
					" 229" => 229,
					" 230" => 230,
					" 231" => 231,
					" 232" => 232,
					" 233" => 233,
					" 234" => 234,
					" 235" => 235,
					" 236" => 236,
					" 237" => 237,
					" 238" => 238,
					" 239" => 239,
					" 240" => 240,
					" 241" => 241,
					" 242" => 242,
					" 243" => 243,
					" 244" => 244,
					" 245" => 245,
					" 246" => 246,
					" 247" => 247,
					" 248" => 248,
					" 249" => 249,
					" 250" => 250,
					" 251" => 251,
					" 252" => 252,
					" 253" => 253,
					" 254" => 254,
					" 255" => 255,
					" 256" => 256,
					" 257" => 257,
					" 258" => 258,
					" 259" => 259,
					" 260" => 260,
					" 261" => 261,
					" 262" => 262,
					" 263" => 263,
					" 264" => 264,
					" 265" => 265,
					" 266" => 266,
					" 267" => 267,
					" 268" => 268,
					" 269" => 269,
					" 270" => 270,
					" 271" => 271,
					" 272" => 272,
					" 273" => 273,
					" 274" => 274,
					" 275" => 275,
					" 276" => 276,
					" 277" => 277,
					" 278" => 278,
					" 279" => 279,
					" 280" => 280,
					" 281" => 281,
					" 282" => 282,
					" 283" => 283,
					" 284" => 284,
					" 285" => 285,
					" 286" => 286,
					" 287" => 287,
					" 288" => 288,
					" 289" => 289,
					" 290" => 290,
					" 291" => 291,
					" 292" => 292,
					" 293" => 293,
					" 294" => 294,
					" 295" => 295,
					" 296" => 296,
					" 297" => 297,
					" 298" => 298,
					" 299" => 299,
					" 300" => 300)
					),
					//LFELevel **:00 to 10 by ASCII , 00=0dB, 10=-10dB
					DENON_API_Commands::PSLFE
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 00" => 0, " 005" => -0.5, " 01" => -1, " 015" => -1.5, " 02" => -2, " 025" => -2.5, " 03" => -3, " 035" => -3.5, " 04" => -4, " 045" => -4.5,
												" 05" => -5, " 055" => -5.5, " 06" => -6, " 065" => -6.5, " 07" => -7, " 075" => -7.5, " 08" => -8, " 085" => -8.5, " 09" => -9, " 095" => -9.5,
												" 10" => 10)
					),
					//Bass Level **:44 to 56 by ASCII , 50=0dB can be operated from -6 to +6
					DENON_API_Commands::PSBAS
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6)
												
					),
					//Treble Level **:44 to 56 by ASCII , 50=0dB can be operated from -6 to +6
					DENON_API_Commands::PSTRE
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6)
					),
					//Center Width **:00 to 07 by ASCII , 00=0 can be operated from 0 to 7
					DENON_API_Commands::PSCEN
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 00" => 0, " 005" => 0.5, " 01" => 1, " 015" => 1.5, " 02" => 2, " 025" => 2.5, " 03" => 3, " 035" => 3.5, " 04" => 4, " 045" => 4.5,
												" 05" => 5, " 055" => 5.5, " 06" => 6, " 065" => 6.5, " 07" => 7)
					),
					//Effect Level On / Off
					DENON_API_Commands::PSEFFSWITCH
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array("N" => true, "FF" => false)
					),
					//Effect Level **:00 to 15 by ASCII , 00=0dB, 10=10dB can be operated from 1 to 15
					DENON_API_Commands::PSEFF
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 00" => 0, " 005" => 0.5, " 01" => 1, " 015" => 1.5, " 02" => 2, " 025" => 2.5, " 03" => 3, " 035" => 3.5, " 04" => 4, " 045" => 4.5,
												" 05" => 5, " 055" => 5.5, " 06" => 6, " 065" => 6.5, " 07" => 7, " 075" => 7.5, " 08" => 8, " 085" => 8.5, " 09" => 9, " 095" => 9.5,
												" 10" => 10, " 105" => 10.5, " 11" => 11, " 115" => 11.5, " 12" => 12, " 125" => 12.5, " 13" => 13, " 135" => 13.5, " 14" => 14, " 145" => 14.5, " 15" => 15)
					),
					//Center Image **:00 to 10 by ASCII , 00=0.0 can be operated from 0.0 to 1.0
					DENON_API_Commands::PSCEI
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 00" => 0, " 01" => 0.1, " 02" => 0.2, " 03" => 0.3, " 04" => 0.4, " 05" => 0.5, " 06" => 0.6, " 07" => 0.7, " 08" => 0.8, " 09" => 0.9, " 10" => 1.0)
					),
					//Contrast **:44 to 56 by ASCII , 50=0 can be operated from -6 to +6(44 to 56)
					DENON_API_Commands::PVCN
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6)
					),
					//Brightness **:00 to 12 by ASCII , 00=0 can be operated from 0 to 12
					DENON_API_Commands::PVBR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 00" => 0, " 005" => 0.5, " 01" => 1, " 015" => 1.5, " 02" => 2, " 025" => 2.5, " 03" => 3, " 035" => 3.5, " 04" => 4, " 045" => 4.5,
												" 05" => 5, " 055" => 5.5, " 06" => 6, " 065" => 6.5, " 07" => 7, " 075" => 7.5, " 08" => 8, " 085" => 8.5, " 09" => 9, " 095" => 9.5,
												" 10" => 10, " 105" => 10.5, " 11" => 11, " 115" => 11.5, " 12" => 12)
					),
					//Chroma Level **:44 to 56 by ASCII , 50=0 can be operated from -6 to +6(44 to 56)
					DENON_API_Commands::PVCM
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6)
					),
					//Hue **:44 to 56 by ASCII , 50=0 can be operated from -6 to +6(44 to 56)
					DENON_API_Commands::PVHUE
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6)
					),
					//Enhancer **:00 to 12 by ASCII, 00=0 can be operated from 0 to 12
					DENON_API_Commands::PVENH
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 00" => 0, " 005" => 0.5, " 01" => 1, " 015" => 1.5, " 02" => 2, " 025" => 2.5, " 03" => 3, " 035" => 3.5, " 04" => 4, " 045" => 4.5,
												" 05" => 5, " 055" => 5.5, " 06" => 6, " 065" => 6.5, " 07" => 7, " 075" => 7.5, " 08" => 8, " 085" => 8.5, " 09" => 9, " 095" => 9.5,
												" 10" => 10, " 105" => 10.5, " 11" => 11, " 115" => 11.5, " 12" => 12)
					),
					//Stage Height **:40 to 60 by ASCII , 50=0dB can be operated from -10 to +10
					DENON_API_Commands::PSSTH
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5, " 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5,
												" 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5, " 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5,
												" 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5, " 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5,
												" 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8, " 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10)
					),
					//Stage Width **:40 to 60 by ASCII , 50=0dB can be operated from -10 to +10
					DENON_API_Commands::PSSTW
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5, " 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5,
												" 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5, " 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5,
												" 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5, " 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5,
												" 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8, " 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10)
					),
					//Zone 2
					//Zone 2 Volume **:00 to 99 by ASCII , 80=0dB, 99=---(MIN) 00=-80dB
					DENON_API_Commands::Z2
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(
												"00" => -80, 
												"005" => -79.5, 
												"01" => -79, 
												"015" => -78.5, 
												"02" => -78, 
												"025" => -77.5, 
												"03" => -77, 
												"035" => -76.5, 
												"04" => -76, 
												"045" => -75.5, 
												"05" => -75, 
												"055" => -74.5, 
												"06" => -74, 
												"065" => -73.5, 
												"07" => -73, 
												"075" => -72.5, 
												"08" => -72, 
												"085" => -71.5, 
												"09" => -71, 
												"095" => -70.5, 
												"10" => -70, 
												"105" => -69.5, 
												"11" => -69, 
												"115" => -68.5, 
												"12" => -68, 
												"125" => -67.5, 
												"13" => -67, 
												"135" => -66.5, 
												"14" => -66, 
												"145" => -65.5, 
												"15" => -65, 
												"155" => -64.5, 
												"16" => -64, 
												"165" => -63.5, 
												"17" => -63, 
												"175" => -62.5, 
												"18" => -62, 
												"185" => -61.5, 
												"19" => -61, 
												"195" => -60.5, 
												"20" => -60, 
												"205" => -59.5, 
												"21" => -59, 
												"215" => -58.5, 
												"22" => -58, 
												"225" => -57.5, 
												"23" => -57, 
												"235" => -56.5, 
												"24" => -56, 
												"245" => -55.5, 
												"25" => -55, 
												"255" => -54.5, 
												"26" => -54, 
												"265" => -53.5, 
												"27" => -53, 
												"275" => -52.5, 
												"28" => -52, 
												"285" => -51.5, 
												"29" => -51, 
												"295" => -50.5, 
												"30" => -50, 
												"305" => -49.5, 
												"31" => -49, 
												"315" => -48.5, 
												"32" => -48, 
												"325" => -47.5, 
												"33" => -47, 
												"335" => -46.5, 
												"34" => -46, 
												"345" => -45.5, 
												"35" => -45, 
												"355" => -44.5, 
												"36" => -44, 
												"365" => -43.5, 
												"37" => -43, 
												"375" => -42.5, 
												"38" => -42, 
												"385" => -41.5, 
												"39" => -41, 
												"395" => -40.5, 
												"40" => -40, 
												"405" => -39.5, 
												"41" => -39, 
												"415" => -38.5, 
												"42" => -38, 
												"425" => -37.5, 
												"43" => -37, 
												"435" => -36.5, 
												"44" => -36, 
												"445" => -35.5, 
												"45" => -35, 
												"455" => -34.5, 
												"46" => -34, 
												"465" => -33.5, 
												"47" => -33, 
												"475" => -32.5, 
												"48" => -32, 
												"485" => -31.5, 
												"49" => -31, 
												"495" => -30.5, 
												"50" => -30, 
												"505" => -29.5, 
												"51" => -29, 
												"515" => -28.5, 
												"52" => -28, 
												"525" => -27.5, 
												"53" => -27, 
												"535" => -26.5, 
												"54" => -26, 
												"545" => -25.5, 
												"55" => -25, 
												"555" => -24.5, 
												"56" => -24, 
												"565" => -23.5, 
												"57" => -23, 
												"575" => -22.5, 
												"58" => -22, 
												"585" => -21.5, 
												"59" => -21, 
												"595" => -20.5, 
												"60" => -20, 
												"605" => -19.5, 
												"61" => -19, 
												"615" => -18.5, 
												"62" => -18, 
												"625" => -17.5, 
												"63" => -17, 
												"635" => -16.5, 
												"64" => -16, 
												"645" => -15.5, 
												"65" => -15, 
												"655" => -14.5, 
												"66" => -14, 
												"665" => -13.5, 
												"67" => -13, 
												"675" => -12.5, 
												"68" => -12, 
												"685" => -11.5, 
												"69" => -11, 
												"695" => -10.5, 
												"70" => -10, 
												"705" => -9.5, 
												"71" => -9, 
												"715" => -8.5, 
												"72" => -8, 
												"725" => -7.5, 
												"73" => -7, 
												"735" => -6.5, 
												"74" => -6, 
												"745" => -5.5, 
												"75" => -5, 
												"755" => -4.5, 
												"76" => -4, 
												"765" => -3.5, 
												"77" => -3, 
												"775" => -2.5, 
												"78" => -2, 
												"785" => -1.5, 
												"79" => -1, 
												"795" => -0.5, 
												"80" => 0, 
												"805" => 0.5, 
												"81" => 1, 
												"815" => 1.5, 
												"82" => 2, 
												"825" => 2.5, 
												"83" => 3, 
												"835" => 3.5, 
												"84" => 4, 
												"845" => 4.5, 
												"85" => 5, 
												"855" => 5.5, 
												"86" => 6, 
												"865" => 6.5, 
												"87" => 7, 
												"875" => 7.5, 
												"88" => 8, 
												"885" => 8.5, 
												"89" => 9, 
												"895" => 9.5, 
												"90" => 10, 
												"905" => 10.5, 
												"91" => 11, 
												"915" => 11.5, 
												"92" => 12, 
												"925" => 12.5, 
												"93" => 13, 
												"935" => 13.5, 
												"94" => 14, 
												"945" => 14.5, 
												"95" => 15, 
												"955" => 15.5, 
												"96" => 16, 
												"965" => 16.5, 
												"97" => 17, 
												"975" => 17.5, 
												"98" => 18
												)
					),
					//Zone 2 Channel Volume FL **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::Z2CVFL
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
								
					),
					//Zone 2 Channel Volume FR **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::Z2CVFR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Zone 3
					//Zone 3 Volume **:00 to 99 by ASCII , 80=0dB, 99=---(MIN) 00=-80dB
					DENON_API_Commands::Z3
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array
									(
										"00" => -80, 
										"005" => -79.5, 
										"01" => -79, 
										"015" => -78.5, 
										"02" => -78, 
										"025" => -77.5, 
										"03" => -77, 
										"035" => -76.5, 
										"04" => -76, 
										"045" => -75.5, 
										"05" => -75, 
										"055" => -74.5, 
										"06" => -74, 
										"065" => -73.5, 
										"07" => -73, 
										"075" => -72.5, 
										"08" => -72, 
										"085" => -71.5, 
										"09" => -71, 
										"095" => -70.5, 
										"10" => -70, 
										"105" => -69.5, 
										"11" => -69, 
										"115" => -68.5, 
										"12" => -68, 
										"125" => -67.5, 
										"13" => -67, 
										"135" => -66.5, 
										"14" => -66, 
										"145" => -65.5, 
										"15" => -65, 
										"155" => -64.5, 
										"16" => -64, 
										"165" => -63.5, 
										"17" => -63, 
										"175" => -62.5, 
										"18" => -62, 
										"185" => -61.5, 
										"19" => -61, 
										"195" => -60.5, 
										"20" => -60, 
										"205" => -59.5, 
										"21" => -59, 
										"215" => -58.5, 
										"22" => -58, 
										"225" => -57.5, 
										"23" => -57, 
										"235" => -56.5, 
										"24" => -56, 
										"245" => -55.5, 
										"25" => -55, 
										"255" => -54.5, 
										"26" => -54, 
										"265" => -53.5, 
										"27" => -53, 
										"275" => -52.5, 
										"28" => -52, 
										"285" => -51.5, 
										"29" => -51, 
										"295" => -50.5, 
										"30" => -50, 
										"305" => -49.5, 
										"31" => -49, 
										"315" => -48.5, 
										"32" => -48, 
										"325" => -47.5, 
										"33" => -47, 
										"335" => -46.5, 
										"34" => -46, 
										"345" => -45.5, 
										"35" => -45, 
										"355" => -44.5, 
										"36" => -44, 
										"365" => -43.5, 
										"37" => -43, 
										"375" => -42.5, 
										"38" => -42, 
										"385" => -41.5, 
										"39" => -41, 
										"395" => -40.5, 
										"40" => -40, 
										"405" => -39.5, 
										"41" => -39, 
										"415" => -38.5, 
										"42" => -38, 
										"425" => -37.5, 
										"43" => -37, 
										"435" => -36.5, 
										"44" => -36, 
										"445" => -35.5, 
										"45" => -35, 
										"455" => -34.5, 
										"46" => -34, 
										"465" => -33.5, 
										"47" => -33, 
										"475" => -32.5, 
										"48" => -32, 
										"485" => -31.5, 
										"49" => -31, 
										"495" => -30.5, 
										"50" => -30, 
										"505" => -29.5, 
										"51" => -29, 
										"515" => -28.5, 
										"52" => -28, 
										"525" => -27.5, 
										"53" => -27, 
										"535" => -26.5, 
										"54" => -26, 
										"545" => -25.5, 
										"55" => -25, 
										"555" => -24.5, 
										"56" => -24, 
										"565" => -23.5, 
										"57" => -23, 
										"575" => -22.5, 
										"58" => -22, 
										"585" => -21.5, 
										"59" => -21, 
										"595" => -20.5, 
										"60" => -20, 
										"605" => -19.5, 
										"61" => -19, 
										"615" => -18.5, 
										"62" => -18, 
										"625" => -17.5, 
										"63" => -17, 
										"635" => -16.5, 
										"64" => -16, 
										"645" => -15.5, 
										"65" => -15, 
										"655" => -14.5, 
										"66" => -14, 
										"665" => -13.5, 
										"67" => -13, 
										"675" => -12.5, 
										"68" => -12, 
										"685" => -11.5, 
										"69" => -11, 
										"695" => -10.5, 
										"70" => -10, 
										"705" => -9.5, 
										"71" => -9, 
										"715" => -8.5, 
										"72" => -8, 
										"725" => -7.5, 
										"73" => -7, 
										"735" => -6.5, 
										"74" => -6, 
										"745" => -5.5, 
										"75" => -5, 
										"755" => -4.5, 
										"76" => -4, 
										"765" => -3.5, 
										"77" => -3, 
										"775" => -2.5, 
										"78" => -2, 
										"785" => -1.5, 
										"79" => -1, 
										"795" => -0.5, 
										"80" => 0, 
										"805" => 0.5, 
										"81" => 1, 
										"815" => 1.5, 
										"82" => 2, 
										"825" => 2.5, 
										"83" => 3, 
										"835" => 3.5, 
										"84" => 4, 
										"845" => 4.5, 
										"85" => 5, 
										"855" => 5.5, 
										"86" => 6, 
										"865" => 6.5, 
										"87" => 7, 
										"875" => 7.5, 
										"88" => 8, 
										"885" => 8.5, 
										"89" => 9, 
										"895" => 9.5, 
										"90" => 10, 
										"905" => 10.5, 
										"91" => 11, 
										"915" => 11.5, 
										"92" => 12, 
										"925" => 12.5, 
										"93" => 13, 
										"935" => 13.5, 
										"94" => 14, 
										"945" => 14.5, 
										"95" => 15, 
										"955" => 15.5, 
										"96" => 16, 
										"965" => 16.5, 
										"97" => 17, 
										"975" => 17.5, 
										"98" => 18
									)
					),
					//Zone 3 Channel Volume FL **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::Z3CVFL
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//Zone 3 Channel Volume FR **:38 to 62 by ASCII , 50=0dB
					DENON_API_Commands::Z3CVFR
					=> array(
						"VarType" => DENONIPSVarType::vtFloat,
						"ValueMapping" => array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12)
					),
					//GUI Menu
					DENON_API_Commands::MNMEN
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					),
					//GUI Source Select Menu
					DENON_API_Commands::MNSRC
					=> array(
						"VarType" => DENONIPSVarType::vtBoolean,
						"ValueMapping" => array(" ON" => true, " OFF" => false)
					)
				);
	
	//Input Source
	protected function VarMapping($InputMapping, $CommunicationType)
	{
		$Zone = $this->AVRZone;
		$AVRType = $this->AVRType;
		$VarMapping = $this->VarMapping;
		
		if ($CommunicationType == "Send") //Send 
		{
			if ($Zone == 0) //Main Zone
			{
				$AVRInputsArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRInputsArray["ValueMapping"] = $InputMapping;
				$VarMapping[DENON_API_Commands::SI] = $AVRInputsArray;
			}
			elseif ($Zone == 1) //Zone 1
			{
				$AVRInputsArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRInputsArray["ValueMapping"] = $InputMapping;
				$VarMapping[DENON_API_Commands::Z2INPUT] = $AVRInputsArray;
			}
			elseif ($Zone == 2) //Zone 2
			{
				$AVRInputsArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRInputsArray["ValueMapping"] = $InputMapping;
				$VarMapping[DENON_API_Commands::Z3INPUT] = $AVRInputsArray;
			}
			if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W")
			{
				//Surround Mode
				$AVRSurroundModeArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRSurroundModeArray["ValueMapping"] = array("DIRECT" => 0, "PURE DIRECT" => 1, "STEREO" => 2, "AUTO" => 3, "DOLBY DIGITAL" => 4,  "DTS SURROUND" => 5, "AURO3D" => 6, "AURO2DSURR" => 7, "MCH STEREO" => 8, "WIDE SCREEN" => 9, "SUPER STADIUM" => 10, "ROCK ARENA" => 11, "JAZZ CLUB" => 12, "CLASSIC CONCERT" => 13, "MONO MOVIE" => 14, "MATRIX" => 15, "VIDEO GAME" => 16,
													"VIRTUAL" => 17, "MOVIE" => 18, "MUSIC" => 19, "GAME" => 20);
			}
			elseif ($AVRType == "AVR-4311")
			{
				//Surround Mode
				$AVRSurroundModeArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRSurroundModeArray["ValueMapping"] = array("DIRECT" => 0, "PURE DIRECT" => 1, "STEREO" => 2, "STANDARD" => 3, "DOLBY DIGITAL" => 4,  "DTS SURROUND" => 5, "MCH STEREO" => 6, "WIDE SCREEN" => 7, "SUPER STADIUM" => 8, "ROCK ARENA" => 9, "JAZZ CLUB" => 10, "CLASSIC CONCERT" => 11, "MONO MOVIE" => 12, "MATRIX" => 13, "VIDEO GAME" => 14,
													"VIRTUAL" => 15);
			}
			else
			{
				//Surround Mode
				$AVRSurroundModeArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRSurroundModeArray["ValueMapping"] = array("DIRECT" => 0, "PURE DIRECT" => 1, "STEREO" => 2, "STANDARD" => 3, "DOLBY DIGITAL" => 4,  "DTS SURROUND" => 5, "MCH STEREO" => 6, "WIDE SCREEN" => 7, "SUPER STADIUM" => 8, "ROCK ARENA" => 9, "JAZZ CLUB" => 10, "CLASSIC CONCERT" => 11, "MONO MOVIE" => 12, "MATRIX" => 13, "VIDEO GAME" => 14,
													"VIRTUAL" => 15);
			}
			
			$VarMapping[DENON_API_Commands::MS] = $AVRSurroundModeArray;		
		}
		elseif($CommunicationType == "Response") //Response
		{
			//Bei Response Zone unbekannt, muss ausgelesen werden
			
			$AVRInputsArrayMainZone = array("VarType" => DENONIPSVarType::vtInteger);
			$AVRInputsArrayMainZone["ValueMapping"] = $InputMapping;
			$VarMapping[DENON_API_Commands::SI] = $AVRInputsArrayMainZone;
			
			$AVRInputsArrayZ2 = array("VarType" => DENONIPSVarType::vtInteger);
			$AVRInputsArrayZ2["ValueMapping"] = $InputMapping;
			$VarMapping[DENON_API_Commands::Z2INPUT] = $AVRInputsArrayZ2;
			
			$AVRInputsArrayZ3 = array("VarType" => DENONIPSVarType::vtInteger);
			$AVRInputsArrayZ3["ValueMapping"] = $InputMapping;
			$VarMapping[DENON_API_Commands::Z3INPUT] = $AVRInputsArrayZ3;
			
			if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W")
			{
				//Surround Mode
				$AVRSurroundModeArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRSurroundModeArray["ValueMapping"] = array("DIRECT" => 0, "PURE DIRECT" => 1, "STEREO" => 2, "AUTO" => 3, DENON_API_Commands::DOLBYDIGITALRES => 4, DENON_API_Commands::DOLBYPROLOGIC => 4, DENON_API_Commands::DOLBYPL2XC => 4, DENON_API_Commands::DOLBYPL2XM => 4,
															DENON_API_Commands::DOLBYPL2XG => 4, DENON_API_Commands::DOLBYPL2ZH => 4, DENON_API_Commands::DOLBYPL2XH => 4, DENON_API_Commands::DOLBYDEX => 4, DENON_API_Commands::DOLBYD => 4, DENON_API_Commands::DOLBYDPL2XC => 4,
															DENON_API_Commands::DOLBYDPL2XM => 4, DENON_API_Commands::DOLBYDPL2XH => 4, DENON_API_Commands::PLDSX => 4, DENON_API_Commands::PL2CDSX => 4, DENON_API_Commands::PL2MDSX => 4, DENON_API_Commands::PL2GDSX => 4,
															DENON_API_Commands::PL2XCDSX => 4, DENON_API_Commands::PL2XMDSX => 4, DENON_API_Commands::PL2XGDSX => 4, DENON_API_Commands::DOLBYDPLUSPL2XC => 4, DENON_API_Commands::DOLBYDPLUSPL2XM => 4, DENON_API_Commands::DOLBYDPLUSPL2XH => 4,
															DENON_API_Commands::DOLBYHDPL2XC => 4, DENON_API_Commands::DOLBYHDPL2XM => 4, DENON_API_Commands::DOLBYHDPL2XH => 4, DENON_API_Commands::MULTICNIN => 4, DENON_API_Commands::MCHINPL2XC => 4, DENON_API_Commands::DOLBYHDPL2XM => 4,
															DENON_API_Commands::DOLBYHDPL2XH => 4, DENON_API_Commands::DOLBYDPLUS => 4, DENON_API_Commands::DOLBYDPLUSEX => 4, DENON_API_Commands::DOLBYTRUEHD => 4, DENON_API_Commands::DOLBYHD => 4, DENON_API_Commands::DOLBYHDEX => 4,
															DENON_API_Commands::DOLBYPL2H => 4, DENON_API_Commands::DOLBYSURROUND => 4, DENON_API_Commands::DOLBYATMOS => 4, DENON_API_Commands::DOLBYDDS => 4, DENON_API_Commands::MPEG2AAC => 4, DENON_API_Commands::AACDOLBYEX => 4,
															DENON_API_Commands::AACPL2XC => 4, DENON_API_Commands::AACPL2XM => 4, DENON_API_Commands::AACPL2XH => 4, DENON_API_Commands::AACDS => 4, DENON_API_Commands::AACNEOXC => 4, DENON_API_Commands::AACNEOXM => 4, DENON_API_Commands::AACNEOXG => 4,
															DENON_API_Commands::DTSSURROUNDRES => 5, DENON_API_Commands::DTSNEO6C => 5, DENON_API_Commands::DTSNEO6M => 5, DENON_API_Commands::DTSNEOXM => 5, DENON_API_Commands::DTSNEOXG => 5, DENON_API_Commands::DTSESDSCRT61 => 5,
															DENON_API_Commands::DTSESMTRX61 => 5, DENON_API_Commands::DTSPL2XC => 5, DENON_API_Commands::DTSPL2XM => 5, DENON_API_Commands::DTSPL2ZH => 5, DENON_API_Commands::DTSNEO6 => 5, DENON_API_Commands::DTS9624 => 5, DENON_API_Commands::DTS96ESMTRX => 5,
															DENON_API_Commands::DTSHDPL2XC => 5, DENON_API_Commands::DTSHDPL2XM => 5, DENON_API_Commands::DTSHDPL2XH => 5, DENON_API_Commands::NEO6CDSX => 5, DENON_API_Commands::NEO6MDSX => 5, DENON_API_Commands::DTSHD => 5, DENON_API_Commands::DTSHDMSTR => 5,
															DENON_API_Commands::DTSHDNEO6 => 5, DENON_API_Commands::DTSES8CHDSCRT => 5, DENON_API_Commands::DTSEXPRESS => 5, DENON_API_Commands::DTSDS => 5, DENON_API_Commands::DOLBYDNEOXC => 5, DENON_API_Commands::DOLBYDNEOXM => 5, DENON_API_Commands::DOLBYDNEOXG => 5,
															DENON_API_Commands::MCHINDS => 5, DENON_API_Commands::MCHINNEOXC => 5, DENON_API_Commands::DOLBYDNEOXM => 5, DENON_API_Commands::DOLBYDNEOXG => 5, DENON_API_Commands::DOLBYDNEWNEOXC => 5, DENON_API_Commands::DOLBYDNEWNEOXM => 5, DENON_API_Commands::DOLBYDNEWNEOXG => 5,
															DENON_API_Commands::DOLBYHDDS => 5, DENON_API_Commands::DOLBYHDNEOXC => 5, DENON_API_Commands::DOLBYHDNEOXM => 5, DENON_API_Commands::DOLBYHDNEOXG => 5, DENON_API_Commands::DTSHDDS => 5, DENON_API_Commands::DTSHDNEOXC => 5, DENON_API_Commands::DTSHDNEOXM => 5,
															DENON_API_Commands::DTSHDNEOXG => 5, DENON_API_Commands::AURO3D => 6, DENON_API_Commands::AURO2DSURR => 7, "MCH STEREO" => 8, "WIDE SCREEN" => 9, "SUPER STADIUM" => 10, "ROCK ARENA" => 11, "JAZZ CLUB" => 12, "CLASSIC CONCERT" => 13, "MONO MOVIE" => 14, "MATRIX" => 15, "VIDEO GAME" => 16,
															"VIRTUAL" => 17, DENON_API_Commands::DOLBYPL2C => 18, DENON_API_Commands::DOLBYPL2M => 19, DENON_API_Commands::DOLBYPL2G => 20);
			}
			elseif($AVRType == "AVR-4311")
			{
				//Surround Mode
				$AVRSurroundModeArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRSurroundModeArray["ValueMapping"] = array("DIRECT" => 0, "PURE DIRECT" => 1, "STEREO" => 2, "STANDARD" => 3, DENON_API_Commands::DOLBYDIGITALRES => 4, DENON_API_Commands::DOLBYPL2C => 4, DENON_API_Commands::DOLBYPL2G => 4, DENON_API_Commands::DOLBYPL2M => 4, DENON_API_Commands::DOLBYPL2H => 4, DENON_API_Commands::DOLBYPROLOGIC => 4, DENON_API_Commands::DOLBYPL2XC => 4, DENON_API_Commands::DOLBYPL2XM => 4,
															DENON_API_Commands::DOLBYPL2XG => 4, DENON_API_Commands::DOLBYPL2ZH => 4, DENON_API_Commands::DOLBYPL2XH => 4, DENON_API_Commands::DOLBYDEX => 4, DENON_API_Commands::DOLBYD => 4, DENON_API_Commands::DOLBYDPL2XC => 4,
															DENON_API_Commands::DOLBYDPL2XM => 4, DENON_API_Commands::DOLBYDPL2XH => 4, DENON_API_Commands::PLDSX => 4, DENON_API_Commands::PL2CDSX => 4, DENON_API_Commands::PL2MDSX => 4, DENON_API_Commands::PL2GDSX => 4,
															DENON_API_Commands::PL2XCDSX => 4, DENON_API_Commands::PL2XMDSX => 4, DENON_API_Commands::PL2XGDSX => 4, DENON_API_Commands::DOLBYDPLUSPL2XC => 4, DENON_API_Commands::DOLBYDPLUSPL2XM => 4, DENON_API_Commands::DOLBYDPLUSPL2XH => 4,
															DENON_API_Commands::DOLBYHDPL2XC => 4, DENON_API_Commands::DOLBYHDPL2XM => 4, DENON_API_Commands::DOLBYHDPL2XH => 4, DENON_API_Commands::MULTICNIN => 4, DENON_API_Commands::MCHINPL2XC => 4, DENON_API_Commands::DOLBYHDPL2XM => 4,
															DENON_API_Commands::DOLBYHDPL2XH => 4, DENON_API_Commands::DOLBYDPLUS => 4, DENON_API_Commands::DOLBYDPLUSEX => 4, DENON_API_Commands::DOLBYTRUEHD => 4, DENON_API_Commands::DOLBYHD => 4, DENON_API_Commands::DOLBYHDEX => 4,
															DENON_API_Commands::DOLBYPL2H => 4, DENON_API_Commands::DOLBYSURROUND => 4, DENON_API_Commands::DOLBYATMOS => 4, DENON_API_Commands::DOLBYDDS => 4, DENON_API_Commands::MPEG2AAC => 4, DENON_API_Commands::AACDOLBYEX => 4,
															DENON_API_Commands::AACPL2XC => 4, DENON_API_Commands::AACPL2XM => 4, DENON_API_Commands::AACPL2XH => 4, DENON_API_Commands::AACDS => 4, DENON_API_Commands::AACNEOXC => 4, DENON_API_Commands::AACNEOXM => 4, DENON_API_Commands::AACNEOXG => 4,
															DENON_API_Commands::DTSSURROUNDRES => 5, DENON_API_Commands::DTSNEO6C => 5, DENON_API_Commands::DTSNEO6M => 5, DENON_API_Commands::DTSNEOXM => 5, DENON_API_Commands::DTSNEOXG => 5, DENON_API_Commands::DTSESDSCRT61 => 5,
															DENON_API_Commands::DTSESMTRX61 => 5, DENON_API_Commands::DTSPL2XC => 5, DENON_API_Commands::DTSPL2XM => 5, DENON_API_Commands::DTSPL2ZH => 5, DENON_API_Commands::DTSNEO6 => 5, DENON_API_Commands::DTS9624 => 5, DENON_API_Commands::DTS96ESMTRX => 5,
															DENON_API_Commands::DTSHDPL2XC => 5, DENON_API_Commands::DTSHDPL2XM => 5, DENON_API_Commands::DTSHDPL2XH => 5, DENON_API_Commands::NEO6CDSX => 5, DENON_API_Commands::NEO6MDSX => 5, DENON_API_Commands::DTSHD => 5, DENON_API_Commands::DTSHDMSTR => 5,
															DENON_API_Commands::DTSHDNEO6 => 5, DENON_API_Commands::DTSES8CHDSCRT => 5, DENON_API_Commands::DTSEXPRESS => 5, DENON_API_Commands::DTSDS => 5, DENON_API_Commands::DOLBYDNEOXC => 5, DENON_API_Commands::DOLBYDNEOXM => 5, DENON_API_Commands::DOLBYDNEOXG => 5,
															DENON_API_Commands::MCHINDS => 5, DENON_API_Commands::MCHINNEOXC => 5, DENON_API_Commands::DOLBYDNEOXM => 5, DENON_API_Commands::DOLBYDNEOXG => 5, DENON_API_Commands::DOLBYDNEWNEOXC => 5, DENON_API_Commands::DOLBYDNEWNEOXM => 5, DENON_API_Commands::DOLBYDNEWNEOXG => 5,
															DENON_API_Commands::DOLBYHDDS => 5, DENON_API_Commands::DOLBYHDNEOXC => 5, DENON_API_Commands::DOLBYHDNEOXM => 5, DENON_API_Commands::DOLBYHDNEOXG => 5, DENON_API_Commands::DTSHDDS => 5, DENON_API_Commands::DTSHDNEOXC => 5, DENON_API_Commands::DTSHDNEOXM => 5,
															DENON_API_Commands::DTSHDNEOXG => 5, "MCH STEREO" => 6, "WIDE SCREEN" => 7, "SUPER STADIUM" => 8, "ROCK ARENA" => 9, "JAZZ CLUB" => 10, "CLASSIC CONCERT" => 11, "MONO MOVIE" => 12, "MATRIX" => 13, "VIDEO GAME" => 14,
															"VIRTUAL" => 15);
			}
			else
			{
				//Surround Mode
				$AVRSurroundModeArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRSurroundModeArray["ValueMapping"] = array("DIRECT" => 0, "PURE DIRECT" => 1, "STEREO" => 2, "STANDARD" => 3, DENON_API_Commands::DOLBYDIGITALRES => 4, DENON_API_Commands::DOLBYPL2C => 4, DENON_API_Commands::DOLBYPL2G => 4, DENON_API_Commands::DOLBYPL2M => 4, DENON_API_Commands::DOLBYPL2H => 4, DENON_API_Commands::DOLBYPROLOGIC => 4, DENON_API_Commands::DOLBYPL2XC => 4, DENON_API_Commands::DOLBYPL2XM => 4,
															DENON_API_Commands::DOLBYPL2XG => 4, DENON_API_Commands::DOLBYPL2ZH => 4, DENON_API_Commands::DOLBYPL2XH => 4, DENON_API_Commands::DOLBYDEX => 4, DENON_API_Commands::DOLBYD => 4, DENON_API_Commands::DOLBYDPL2XC => 4,
															DENON_API_Commands::DOLBYDPL2XM => 4, DENON_API_Commands::DOLBYDPL2XH => 4, DENON_API_Commands::PLDSX => 4, DENON_API_Commands::PL2CDSX => 4, DENON_API_Commands::PL2MDSX => 4, DENON_API_Commands::PL2GDSX => 4,
															DENON_API_Commands::PL2XCDSX => 4, DENON_API_Commands::PL2XMDSX => 4, DENON_API_Commands::PL2XGDSX => 4, DENON_API_Commands::DOLBYDPLUSPL2XC => 4, DENON_API_Commands::DOLBYDPLUSPL2XM => 4, DENON_API_Commands::DOLBYDPLUSPL2XH => 4,
															DENON_API_Commands::DOLBYHDPL2XC => 4, DENON_API_Commands::DOLBYHDPL2XM => 4, DENON_API_Commands::DOLBYHDPL2XH => 4, DENON_API_Commands::MULTICNIN => 4, DENON_API_Commands::MCHINPL2XC => 4, DENON_API_Commands::DOLBYHDPL2XM => 4,
															DENON_API_Commands::DOLBYHDPL2XH => 4, DENON_API_Commands::DOLBYDPLUS => 4, DENON_API_Commands::DOLBYDPLUSEX => 4, DENON_API_Commands::DOLBYTRUEHD => 4, DENON_API_Commands::DOLBYHD => 4, DENON_API_Commands::DOLBYHDEX => 4,
															DENON_API_Commands::DOLBYPL2H => 4, DENON_API_Commands::DOLBYSURROUND => 4, DENON_API_Commands::DOLBYATMOS => 4, DENON_API_Commands::DOLBYDDS => 4, DENON_API_Commands::MPEG2AAC => 4, DENON_API_Commands::AACDOLBYEX => 4,
															DENON_API_Commands::AACPL2XC => 4, DENON_API_Commands::AACPL2XM => 4, DENON_API_Commands::AACPL2XH => 4, DENON_API_Commands::AACDS => 4, DENON_API_Commands::AACNEOXC => 4, DENON_API_Commands::AACNEOXM => 4, DENON_API_Commands::AACNEOXG => 4,
															DENON_API_Commands::DTSSURROUNDRES => 5, DENON_API_Commands::DTSNEO6C => 5, DENON_API_Commands::DTSNEO6M => 5, DENON_API_Commands::DTSNEOXM => 5, DENON_API_Commands::DTSNEOXG => 5, DENON_API_Commands::DTSESDSCRT61 => 5,
															DENON_API_Commands::DTSESMTRX61 => 5, DENON_API_Commands::DTSPL2XC => 5, DENON_API_Commands::DTSPL2XM => 5, DENON_API_Commands::DTSPL2ZH => 5, DENON_API_Commands::DTSNEO6 => 5, DENON_API_Commands::DTS9624 => 5, DENON_API_Commands::DTS96ESMTRX => 5,
															DENON_API_Commands::DTSHDPL2XC => 5, DENON_API_Commands::DTSHDPL2XM => 5, DENON_API_Commands::DTSHDPL2XH => 5, DENON_API_Commands::NEO6CDSX => 5, DENON_API_Commands::NEO6MDSX => 5, DENON_API_Commands::DTSHD => 5, DENON_API_Commands::DTSHDMSTR => 5,
															DENON_API_Commands::DTSHDNEO6 => 5, DENON_API_Commands::DTSES8CHDSCRT => 5, DENON_API_Commands::DTSEXPRESS => 5, DENON_API_Commands::DTSDS => 5, DENON_API_Commands::DOLBYDNEOXC => 5, DENON_API_Commands::DOLBYDNEOXM => 5, DENON_API_Commands::DOLBYDNEOXG => 5,
															DENON_API_Commands::MCHINDS => 5, DENON_API_Commands::MCHINNEOXC => 5, DENON_API_Commands::DOLBYDNEOXM => 5, DENON_API_Commands::DOLBYDNEOXG => 5, DENON_API_Commands::DOLBYDNEWNEOXC => 5, DENON_API_Commands::DOLBYDNEWNEOXM => 5, DENON_API_Commands::DOLBYDNEWNEOXG => 5,
															DENON_API_Commands::DOLBYHDDS => 5, DENON_API_Commands::DOLBYHDNEOXC => 5, DENON_API_Commands::DOLBYHDNEOXM => 5, DENON_API_Commands::DOLBYHDNEOXG => 5, DENON_API_Commands::DTSHDDS => 5, DENON_API_Commands::DTSHDNEOXC => 5, DENON_API_Commands::DTSHDNEOXM => 5,
															DENON_API_Commands::DTSHDNEOXG => 5, "MCH STEREO" => 6, "WIDE SCREEN" => 7, "SUPER STADIUM" => 8, "ROCK ARENA" => 9, "JAZZ CLUB" => 10, "CLASSIC CONCERT" => 11, "MONO MOVIE" => 12, "MATRIX" => 13, "VIDEO GAME" => 14,
															"VIRTUAL" => 15);
			}
			$VarMapping[DENON_API_Commands::MS] = $AVRSurroundModeArray;		
		}
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W")
		{
			// Channel Volume TFL **:38 to 62 by ASCII , 50=0dB
			$AVRTFLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRTFLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVTFL] = $AVRTFLArray;	
			
			// Channel Volume TFR **:38 to 62 by ASCII , 50=0dB
			$AVRTFRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRTFRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVTFR] = $AVRTFRArray;

			// Channel Volume TML **:38 to 62 by ASCII , 50=0dB
			$AVRTMLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRTMLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVTML] = $AVRTMLArray;	

			// Channel Volume TMR **:38 to 62 by ASCII , 50=0dB
			$AVRTMRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRTMRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVTMR] = $AVRTMRArray;		
			
			// Channel Volume TRL **:38 to 62 by ASCII , 50=0dB
			$AVRTRLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRTRLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVTRL] = $AVRTRLArray;

			// Channel Volume TRR **:38 to 62 by ASCII , 50=0dB
			$AVRTRRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRTRRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVTRR] = $AVRTRRArray;

			// Channel Volume RHL **:38 to 62 by ASCII , 50=0dB
			$AVRRHLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRRHLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVRHL] = $AVRRHLArray;	

			// Channel Volume RHR **:38 to 62 by ASCII , 50=0dB
			$AVRRHRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRRHRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVRHR] = $AVRRHRArray;

			// Channel Volume FDL **:38 to 62 by ASCII , 50=0dB
			$AVRFDLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRFDLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVFDL] = $AVRFDLArray;

			// Channel Volume FDR **:38 to 62 by ASCII , 50=0dB
			$AVRFDRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRFDRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVFDR] = $AVRFDRArray;

			// Channel Volume SDL **:38 to 62 by ASCII , 50=0dB
			$AVRSDLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRSDLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVSDL] = $AVRSDLArray;	

			// Channel Volume SDR **:38 to 62 by ASCII , 50=0dB
			$AVRSDRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRSDRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVSDR] = $AVRSDRArray;

			// Channel Volume BDL **:38 to 62 by ASCII , 50=0dB
			$AVRBDLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRBDLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVBDL] = $AVRBDLArray;

			// Channel Volume BDR **:38 to 62 by ASCII , 50=0dB
			$AVRBDRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRBDRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVBDR] = $AVRBDRArray;		
		}
		
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W")
		{
			// Channel Volume SHL **:38 to 62 by ASCII , 50=0dB
			$AVRSHLArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRSHLArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVSHL] = $AVRSHLArray;	
			
			// Channel Volume SHR **:38 to 62 by ASCII , 50=0dB
			$AVRSHRArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRSHRArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVSHR] = $AVRSHRArray;

			// Channel Volume TS **:38 to 62 by ASCII , 50=0dB
			$AVRTSArray = array("VarType" => DENONIPSVarType::vtFloat);
			$AVRTSArray["ValueMapping"] = $this->Range38to62();
			$VarMapping[DENON_API_Commands::CVTS] = $AVRTSArray;		
		}
		
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W")
		{
			// AuroMatic3DPreset AUROPR 
			$AVRAUROPRArray = array("VarType" => DENONIPSVarType::vtInteger);
			$AVRAUROPRArray["ValueMapping"] = array(DENON_API_Commands::PSAUROPRSMA => 0, DENON_API_Commands::PSAUROPRMED => 1, DENON_API_Commands::PSAUROPRLAR => 2, DENON_API_Commands::PSAUROPRSPE => 3);
			$VarMapping[DENON_API_Commands::PSAUROPR] = $AVRAUROPRArray;
			
			// Center Spread PSCES
			$AVRPSCESArray = array("VarType" => DENONIPSVarType::vtBoolean);
			$AVRPSCESArray["ValueMapping"] = array(DENON_API_Commands::PSCESON => true, DENON_API_Commands::PSCESOFF => false);
			$VarMapping[DENON_API_Commands::PSGRAPHICEQ] = $AVRPSCESArray;

			// AuroMatic3DStrength AUROST 
			$AVRAUROSTArray = array("VarType" => DENONIPSVarType::vtInteger);
			$AVRAUROSTArray["ValueMapping"] = array("01" => 1, "02" => 2, "03" => 3, "04" => 4, "05" => 5, "06" => 6, "07" => 7, "08" => 8, "09" => 9, "10" => 10, "11" => 11, "12" => 12, "13" => 13, "14" => 14,
													"15" => 15, "16" => 16);
			$VarMapping[DENON_API_Commands::PSAUROST] = $AVRAUROSTArray;	
		}
				
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-X1100W" || $AVRType == "S700W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W" || $AVRType == "AVR-2200W" || $AVRType == "AVR-1200W")
			{
				// Mainzone Auto Standby STBY 
				$AVRSTBYArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRSTBYArray["ValueMapping"] = array(DENON_API_Commands::STBYOFF => 0, DENON_API_Commands::STBY15M => 1, DENON_API_Commands::STBY30M => 2, DENON_API_Commands::STBY60M => 3);
				$VarMapping[DENON_API_Commands::STBY] = $AVRSTBYArray;
				
				// Mainzone ECO Mode ECO 
				$AVRECOArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRECOArray["ValueMapping"] = array(DENON_API_Commands::ECOOFF => 0, DENON_API_Commands::ECOAUTO => 1, DENON_API_Commands::ECOON => 2);
				$VarMapping[DENON_API_Commands::ECO] = $AVRECOArray;
				
				// Dimmer DIM
				$AVRDIMArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRDIMArray["ValueMapping"] = array(DENON_API_Commands::DIMOFF => 0, DENON_API_Commands::DIMDAR => 1, DENON_API_Commands::DIMDIM => 2, DENON_API_Commands::DIMBRI => 3);
				$VarMapping[DENON_API_Commands::DIM] = $AVRDIMArray;

				// Graphic EQ PSGRAPHICEQ
				$AVRPSGRAPHICEQArray = array("VarType" => DENONIPSVarType::vtBoolean);
				$AVRPSGRAPHICEQArray["ValueMapping"] = array(DENON_API_Commands::PSGRAPHICEQON => true, DENON_API_Commands::PSGRAPHICEQOFF => false);
				$VarMapping[DENON_API_Commands::PSGRAPHICEQ] = $AVRPSGRAPHICEQArray;
				
				// Zone 2 Auto Standby Z2STBY 
				$AVRZ2STBYArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRZ2STBYArray["ValueMapping"] = array(DENON_API_Commands::Z2STBYOFF => 0, DENON_API_Commands::Z2STBY2H => 1, DENON_API_Commands::Z2STBY4H => 2, DENON_API_Commands::Z2STBY8H => 3);
				$VarMapping[DENON_API_Commands::STBY] = $AVRZ2STBYArray;
				
				// Zone 3 Auto Standby Z3STBY 
				$AVRZ3STBYArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRZ3STBYArray["ValueMapping"] = array(DENON_API_Commands::Z3STBYOFF => 0, DENON_API_Commands::Z3STBY2H => 1, DENON_API_Commands::Z3STBY4H => 2, DENON_API_Commands::Z3STBY8H => 3);
				$VarMapping[DENON_API_Commands::STBY] = $AVRZ3STBYArray;	
			}
		if ($AVRType == "AVR-X2100W" || $AVRType == "S900W" || $AVRType == "AVR-2200W")
			{
				// Resolution 
				$AVRVSSCArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRVSSCArray["ValueMapping"] = array(DENON_API_Commands::SC48P => 0, DENON_API_Commands::SC10I => 1, DENON_API_Commands::SC72P => 2, DENON_API_Commands::SC10P => 3, DENON_API_Commands::SC10P24 => 4, DENON_API_Commands::SC4K => 5, DENON_API_Commands::SCAUTO => 6);
				$VarMapping[DENON_API_Commands::VSSC] = $AVRVSSCArray;
				
				// Resolution HDMI
				$AVRVSSCHArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRVSSCHArray["ValueMapping"] = array(DENON_API_Commands::SCH48P => 0, DENON_API_Commands::SCH10I => 1, DENON_API_Commands::SCH72P => 2, DENON_API_Commands::SCH10P => 3, DENON_API_Commands::SCH10P24 => 4, DENON_API_Commands::SCH4K => 5, DENON_API_Commands::SCHAUTO => 6);
				$VarMapping[DENON_API_Commands::VSSCH] = $AVRVSSCHArray;
			}
		
		if ($AVRType == "AVR-X7200W" || $AVRType == "AVR-X5200W" || $AVRType == "AVR-X4100W" || $AVRType == "AVR-X3100W" || $AVRType == "AVR-7200WA"  || $AVRType == "AVR-6200W" || $AVRType == "AVR-4200W" || $AVRType == "AVR-3200W")
			{
				// Resolution 
				$AVRVSSCArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRVSSCArray["ValueMapping"] = array(DENON_API_Commands::SC48P => 0, DENON_API_Commands::SC10I => 1, DENON_API_Commands::SC72P => 2, DENON_API_Commands::SC10P => 3, DENON_API_Commands::SC10P24 => 4, DENON_API_Commands::SC4K => 5, DENON_API_Commands::SC4KF => 6, DENON_API_Commands::SCAUTO => 7);
				$VarMapping[DENON_API_Commands::VSSC] = $AVRVSSCArray;
				
				// Resolution HDMI
				$AVRVSSCHArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRVSSCHArray["ValueMapping"] = array(DENON_API_Commands::SCH48P => 0, DENON_API_Commands::SCH10I => 1, DENON_API_Commands::SCH72P => 2, DENON_API_Commands::SCH10P => 3, DENON_API_Commands::SCH10P24 => 4, DENON_API_Commands::SCH4K => 5, DENON_API_Commands::SCH4KF => 6, DENON_API_Commands::SCAUTO => 7);
				$VarMapping[DENON_API_Commands::VSSCH] = $AVRVSSCHArray;
				
				// Surround Mode
				$AVRMSArray = array("VarType" => DENONIPSVarType::vtInteger);
				$AVRMSArray["ValueMapping"] = array(DENON_API_Commands::SCH48P => 0, DENON_API_Commands::SCH10I => 1, DENON_API_Commands::SCH72P => 2, DENON_API_Commands::SCH10P => 3, DENON_API_Commands::SCH10P24 => 4, DENON_API_Commands::SCH4K => 5, DENON_API_Commands::SCH4KF => 6, DENON_API_Commands::SCAUTO => 7);
				$VarMapping[DENON_API_Commands::VSSCH] = $AVRMSArray;
			}
		
		return $VarMapping;	
	}
	
	protected function Range38to62()
	{
		$Range38to62 = array(" 38" => -12, " 385" => -11.5, " 39" => -11, " 395" => -10.5, " 40" => -10, " 405" => -9.5, " 41" => -9, " 415" => -8.5, " 42" => -8, " 425" => -7.5,
												" 43" => -7, " 435" => -6.5, " 44" => -6, " 445" => -5.5, " 45" => -5, " 455" => -4.5, " 46" => -4, " 465" => -3.5, " 47" => -3, " 475" => -2.5,
												" 48" => -2, " 485" => -1.5, " 49" => -1, " 495" => -0.5, " 50" => 0, " 505" => 0.5, " 51" => 1, " 515" => 1.5, " 52" => 2, " 525" => 2.5,
												" 53" => 3, " 535" => 3.5, " 54" => 4, " 545" => 4.5, " 55" => 5, " 555" => 5.5, " 56" => 6, " 565" => 6.5, " 57" => 7, " 575" => 7.5, " 58" => 8,
												" 585" => 8.5, " 59" => 9, " 595" => 9.5, " 60" => 10, " 605" => 10.5, " 61" => 11, " 615" => 11.5, " 62" => 12);
		return $Range38to62;
	}
	
    public function GetDataFromJSONObject($Data)
    {
        $this->APICommand = $Data->APICommand;
        $this->Data = utf8_decode($Data->Data);
        if (property_exists($Data, 'APISubCommand'))
            $this->APISubCommand = $Data->APISubCommand;
    }

    public function ToJSONString($GUID)
    {
        $SendData = new stdClass;
        $SendData->DataID = $GUID;
        $SendData->APICommand = $this->APICommand;
        $SendData->Data = utf8_encode($this->Data);
//        if (is_array($this->APISubCommand))
//        if ($this->APISubCommand <> null)        
        $SendData->APISubCommand = $this->APISubCommand;
        return json_encode($SendData);
    }
	
	public function GetSubCommand($Ident, $Value, $InputMapping) 
    {
		$CommunicationType = "Send";
		if (array_key_exists( $Ident, ($this->VarMapping($InputMapping, $CommunicationType)) ))
        {
			foreach(($this->VarMapping($InputMapping, $CommunicationType)) as $Command => $ValMap)
			{
				if($Command == $Ident)
				{
				    $ValueMapping = $ValMap["ValueMapping"];
				    foreach($ValueMapping as $SubCommand => $SubCommandValue)
				    {
						if($SubCommandValue == $Value)
							{
								return $SubCommand;
							}
					}
				}
			}
        }
        else
            return null;
    }
	
	public function GetCommandResponse ($data, $InputMapping)
	{	
		$debug = false;
		//Surround Display
		$displaysurround = array(
								//Dolby Digital
								"Dolby Digital" => DENON_API_Commands::MSDOLBYDIGITALRES,
								"Dolby Pro Logic" => DENON_API_Commands::MSDOLBYPROLOGIC,
								"Dolby Pro Logic II Cinema" => DENON_API_Commands::MSDOLBYPL2C,
								"Dolby Pro Logic II Music" => DENON_API_Commands::MSDOLBYPL2M,
								"Dolby Pro Logic II Height" => DENON_API_Commands::MSDOLBYPL2H,
								"Dolby Pro Logic II Game" => DENON_API_Commands::MSDOLBYPL2G, 
								"Dolby Pro Logic IIx Cinema" => DENON_API_Commands::MSDOLBYPL2XC,
								"Dolby Pro Logic IIx Music" => DENON_API_Commands::MSDOLBYPL2XM,
								"Dolby Pro Logic IIx Height" => DENON_API_Commands::MSDOLBYPL2XH,
								"Dolby Pro Logic IIx Game" => DENON_API_Commands::MSDOLBYPL2XG,
								"Dolby Surround" => DENON_API_Commands::MSDOLBYSURROUND,
								"Dolby Atmos" => DENON_API_Commands::MSDOLBYATMOS,
								"Dolby Digital Ex" => DENON_API_Commands::MSDOLBYDEX,
								"Dolby True HD + Pro Logic IIx Cinema" => DENON_API_Commands::MSDOLBYDPL2XC,
								"Dolby True HD + Pro Logic IIx Music" => DENON_API_Commands::MSDOLBYDPL2XM,
								"Dolby True HD + Pro Logic IIx Height" => DENON_API_Commands::MSDOLBYDPL2XH,
								"Dolby Digital + DS" => DENON_API_Commands::MSDOLBYDDS,
								"Dolby Digital + NEO:X Cinema" => DENON_API_Commands::MSDOLBYDNEOXC,
								"Dolby Digital + NEO:X Music" => DENON_API_Commands::MSDOLBYDNEOXM,
								"Dolby Digital + NEO:X Game" => DENON_API_Commands::MSDOLBYDNEOXG,
								"Dolby Digital Plus + NEO:X Cinema" => DENON_API_Commands::MSDOLBYDNEWNEOXC,
								"Dolby Digital Plus + NEO:X Music" => DENON_API_Commands::MSDOLBYDNEWNEOXM,
								"Dolby Digital Plus + NEO:X Game" => DENON_API_Commands::MSDOLBYDNEWNEOXG,
								"DTS Surround" => DENON_API_Commands::MSDTSSUROUND,
								"DTS ES Discrete 6.1" => DENON_API_Commands::MSDTSESDSCRT61,
								"DTS ES Matrix 6.1" => DENON_API_Commands::MSDTSESMTRX61,
								"DTS + Dolby Pro Logic IIx Cinema" => DENON_API_Commands::MSDTSPL2XC,
								"DTS + Dolby Pro Logic IIx Music" => DENON_API_Commands::MSDTSPL2XM,
								"DTS + Dolby Pro Logic IIx Height" => DENON_API_Commands::MSDTSPL2ZH,
								"DTS + Dolby Surround" => DENON_API_Commands::MSDTSDS,
								"DTS 96/24" => DENON_API_Commands::MSDTS9624,
								"DTS 96/24 ES Matrix" => DENON_API_Commands::MSDTS96ESMTRX,
								"DTS + NEO:6" => DENON_API_Commands::MSDTSNEO6,
								"DTS + NEO:X Cinema" => DENON_API_Commands::MSDTSNEOXC,
								"DTS + NEO:X Music" => DENON_API_Commands::MSDTSNEOXM,
								"DTS + NEO:X Game" => DENON_API_Commands::MSDTSNEOXG,
								"Multi Channel In" => DENON_API_Commands::MSMULTICNIN,
								"Multi Channel In 7.1" => DENON_API_Commands::MSMULTICHIN71,
								"Multi Channel In + Dolby Ex" => DENON_API_Commands::MSMCHINDOLBYEX,
								"Multi Channel In + Dolby Pro Logic IIx Cinema" => DENON_API_Commands::MSMCHINPL2XC,
								"Multi Channel In + Dolby Pro Logic IIx Music" => DENON_API_Commands::MSMCHINPL2XM,
								"Multi Channel In + Dolby Pro Logic IIx Height" => DENON_API_Commands::MSMCHINPL2XH,
								"Multi Channel In + Dolby Surround" => DENON_API_Commands::MSMCHINDS,
								"Multi Channel In + NEO:X Cinema" => DENON_API_Commands::MSMCHINNEOXC,
								"Multi Channel In + NEO:X Music" => DENON_API_Commands::MSMCHINNEOXM,
								"Multi Channel In + NEO:X Game" => DENON_API_Commands::MSMCHINNEOXG,
								"Dolby Digital Plus" => DENON_API_Commands::MSDOLBYD,
								"Dolby Digital Plus + EX" => DENON_API_Commands::MSDOLBYDEX,
								"Dolby Digital Plus + Dolby Pro Logic IIx Cinema" => DENON_API_Commands::MSDOLBYDPL2XC,
								"Dolby Digital Plus + Dolby Pro Logic IIx Music" => DENON_API_Commands::MSDOLBYDPL2XM,
								"Dolby Digital Plus + Dolby Pro Logic IIx Height" => DENON_API_Commands::MSDOLBYDPL2XH,
								"Dolby Digital Plus + Dolby Surround" => DENON_API_Commands::MSDOLBYDDS,
								"Dolby True HD" => DENON_API_Commands::MSDOLBYTRUEHD,
								"Dolby HD" => DENON_API_Commands::MSDOLBYHD,
								"Dolby True HD + Ex" => DENON_API_Commands::MSDOLBYHDEX,
								"Dolby True HD + Dolby Pro Logic IIx Cinema" => DENON_API_Commands::MSDOLBYHDPL2XC,
								"Dolby True HD + Dolby Pro Logic IIx Music" => DENON_API_Commands::MSDOLBYHDPL2XM,
								"Dolby True HD + Dolby Pro Logic IIx Height" => DENON_API_Commands::MSDOLBYHDPL2XH,
								"Dolby True HD + Dolby Surround" => DENON_API_Commands::MSDOLBYHDDS,
								"Dolby True HD + NEO:X Cinema" => DENON_API_Commands::MSDOLBYHDNEOXC,
								"Dolby True HD + NEO:X Music" => DENON_API_Commands::MSDOLBYHDNEOXM,
								"Dolby True HD + NEO:X Game" => DENON_API_Commands::MSDOLBYHDNEOXG,
								"DTS HD" => DENON_API_Commands::MSDTSHD,
								"DTS HD Master" => DENON_API_Commands::MSDTSHDMSTR,
								"DTS HD + NEO:6" => DENON_API_Commands::MSDTSHDNEO6,
								"DTS HD + Dolby Pro Logic IIx Cinema" => DENON_API_Commands::MSDTSHDPL2XC,
								"DTS HD + Dolby Pro Logic IIx Music" => DENON_API_Commands::MSDTSHDPL2XM,
								"DTS HD + Dolby Pro Logic IIx Height" => DENON_API_Commands::MSDTSHDPL2XH,
								"DTS HD ES 8 Channel Discrect" => DENON_API_Commands::MSDTSES8CHDSCRT,
								"DTS HD + Dolby Surround" => DENON_API_Commands::MSDTSHDDS,
								"DTS HD + NEO:X Cinema" => DENON_API_Commands::MSDTSNEOXC,
								"DTS HD + NEO:X Music" => DENON_API_Commands::MSDTSNEOXM,
								"DTS HD + NEO:X Game" => DENON_API_Commands::MSDTSNEOXG,
								"DTS Express" => DENON_API_Commands::MSDTSEXPRESS,
								"DTS ES 8 CH Discrete" => DENON_API_Commands::MSDTSES8CHDSCRT,
								"MPEG2 AAC" => DENON_API_Commands::MSMPEG2AAC,
								"AAC + Dolby EX" => DENON_API_Commands::MSAACDOLBYEX,
								"AAC + PL2X Cinema" => DENON_API_Commands::MSAACPL2XC,
								"AAC + PL2X Music" => DENON_API_Commands::MSAACPL2XM,
								"AAC + PL2X Height" => DENON_API_Commands::MSAACPL2XH,
								"AAC + Dolby Surround" => DENON_API_Commands::MSAACDS,
								"AAC + NEO:X Cinema" => DENON_API_Commands::MSAACNEOXC,
								"AAC + NEO:X Music" => DENON_API_Commands::MSAACNEOXM,
								"AAC + NEO:X Game" => DENON_API_Commands::MSAACNEOXG,
								"Dolby Pro Logic DSX" => DENON_API_Commands::MSPLDSX,
								"Dolby Pro Logic II Cinema DSX" => DENON_API_Commands::MSPL2CDSX,
								"Dolby Pro Logic II Music DSX" => DENON_API_Commands::MSPL2MDSX,	
								"Dolby Pro Logic II Height DSX" => DENON_API_Commands::MSPL2GDSX,	
								"Dolby Pro Logic IIx Cinema DSX" => DENON_API_Commands::MSPL2XCDSX,	
								"Dolby Pro Logic IIx Music DSX" => DENON_API_Commands::MSPL2XMDSX,	
								"Dolby Pro Logic IIx Game DSX" => DENON_API_Commands::MSPL2XGDSX,	
								"Audyssey DSX" => DENON_API_Commands::MSAUDYSSEYDSX,
								// DTS SURROUND
								"NEO:6 Cinema DSX" => DENON_API_Commands::MSNEO6CDSX,	
								"NEO:6 Music DSX" => DENON_API_Commands::MSNEO6MDSX,
								"DTS NEO:6 Cinema" => DENON_API_Commands::MSDTSNEO6C,
								"DTS NEO:6 Music" => DENON_API_Commands::MSDTSNEO6M,
								"DSD Direct" => DENON_API_Commands::MSDSDDIRECT,
								"DTS NEO:X Cinema" => DENON_API_Commands::MSDTSNEOXC,
								"DTS NEO:X Music" => DENON_API_Commands::MSDTSNEOXM,
								"DTS NEO:X Game" => DENON_API_Commands::MSDTSNEOXG,
								"Dolby Digital EX" => DENON_API_Commands::MSDOLBYDEX,
								"Multi Channel In + Dolby EX" => DENON_API_Commands::MSMCHINDOLBYEX,
								"DTS HD + NEO:6" => DENON_API_Commands::MSDTSHDNEO6,
								"NEO:6 Cinema DSX" => DENON_API_Commands::MSNEO6CDSX,
								"NEO:6 Music DSX" => DENON_API_Commands::MSNEO6MDSX,
								// Auro
								"Auro 3D" => DENON_API_Commands::MSAURO3D,		
								"Auro 2D Surround" => DENON_API_Commands::MSAURO2DSURR
								);
								
		$showsurrounddisplay = "";						
		foreach($displaysurround as $showdisplay => $responsedisplay)
			{
				$displaykey = array_search($responsedisplay, $data);  // durchsucht data, false wenn nichts gefunden
				if($displaykey !== false)
					{
					$showsurrounddisplay = $showdisplay;
					}
				
			
			}
		// Response an besondere Idents anpassen
		$specialcommands = array
							("PSCINEMA_EQ.OFF" => "PSCINEMA EQ.OFF",
							"PSCINEMA_EQ.ON" => "PSCINEMA EQ.ON",
							"PSTONE_CTRL OFF" => "PSTONE CTRL OFF",
							"PSTONE_CTRL ON" => "PSTONE CTRL ON",
							"PSEFF_ON" => "PSEFF ON",
							"PSEFF_OFF" => "PSEFF OFF",
							"Z2POWERON" => "Z2ON",
							"Z2POWEROFF" => "Z2OFF",
							"Z3POWERON" => "Z3ON",
							"Z3POWEROFF" => "Z3OFF",
							"Z2INPUTCD" => "Z2CD",
							"Z2INPUTDVD" => "Z2DVD",
							"Z2INPUTBD" => "Z2BD",
							"Z2INPUTSAT/CBL" => "Z2SAT/CBL",
							"Z2INPUTDOCK" => "Z2DOCK",
							"Z2INPUTDVR" => "Z2DVR",
							"Z2INPUTGAME" => "Z2GAME",
							"Z2INPUTV.AUX" => "Z2V.AUX",
							"Z2INPUTIRADIO" => "Z2IRADIO",
							"Z2INPUTTV" => "Z2TV",
							"Z2INPUTSERVER" => "Z2SERVER",
							"Z3INPUTCD" => "Z3CD",
							"Z3INPUTDVD" => "Z3DVD",
							"Z3INPUTBD" => "Z3BD",
							"Z3INPUTSAT/CBL" => "Z3SAT/CBL",
							"Z3INPUTDOCK" => "Z3DOCK",
							"Z3INPUTDVR" => "Z3DVR",
							"Z3INPUTGAME" => "Z3GAME",
							"Z3INPUTV.AUX" => "Z3V.AUX",
							"Z3INPUTIRADIO" => "Z3IRADIO",
							"Z3INPUTTV" => "Z3TV",
							"Z3INPUTSERVER" => "Z3SERVER"
							);
				
		foreach($specialcommands as $specialcommand => $responsesc)
			{
				$specialkey = array_search($responsesc, $data);  // false wenn nichts gefunden
				if($specialkey !== false)
					{
						$data[$specialkey] = str_replace($responsesc, $specialcommand, $data[$specialkey]);
					}
			}
		
		$datavalues = array();
		$NSADisplay = array();
		$CommunicationType = "Response";
		//Response einzeln auswerten
		foreach($data as $key => $response)
			{
				$NSAResponse = stripos($response, "NSA");
				if ($NSAResponse !== false) //Display auslesen
					{
					$NSARow = substr($response, 3, 1);
					if ($NSARow == 0)
						{
						$response = str_replace("NSA0", "", $response);
						}
					if ($NSARow == 1)
						{
						$response = str_replace("NSA1", "", $response);
						}
					if ($NSARow == 2)
						{
						$response = str_replace("NSA2", "", $response);
						}
					if ($NSARow == 3)
						{
						$response = str_replace("NSA3", "", $response);
						}
					if ($NSARow == 4)
						{
						$response = str_replace("NSA4", "", $response);
						}
					if ($NSARow == 5)
						{
						$response = str_replace("NSA5", "", $response);
						}
					if ($NSARow == 6)
						{
						$response = str_replace("NSA6", "", $response);
						}
					if ($NSARow == 7)
						{
						$response = str_replace("NSA7", "", $response);
						}
					if ($NSARow == 8)
						{
						$response = str_replace("NSA8", "", $response);
						}
					$response = str_replace("<LF>", "", $response);
					$response = str_replace("<STX>", "", $response);
					$response = str_replace("<NUL>", "", $response);
					$response = trim($response);
					$NSADisplay[$NSARow] = $response;
					}

				foreach(($this->VarMapping($InputMapping, $CommunicationType)) as $Command => $ValMap) //Zuordung suchen
				{
					$pos = stripos($response, $Command);
					if ($pos !== false) // Subcommand ermitteln
					{
						$lengthCommand = strlen($Command);
						$ResponseSubCommand = substr($response, $lengthCommand);
						$ValueMapping = $ValMap["ValueMapping"];
						$VarType = $ValMap["VarType"];
						foreach($ValueMapping as $SubCommand => $SubCommandValue)
						{
							if($SubCommand == $ResponseSubCommand)
								{
									$Ident = $Command; //Ident enthält _
									$datavalues[$Ident] =  array('VarType' => $VarType, 'Value' => $SubCommandValue, 'Subcommand' => $ResponseSubCommand);
								}
						}
					}
				}
			}
		$datasend = array(
			'ResponseType' => 'TELNET',
			'Data' => $datavalues,
			'SurroundDisplay' => $showsurrounddisplay,
			'NSADisplay' => $NSADisplay
			);
		//Debug Log
		$NSADisplayMessage = json_encode($NSADisplay);
		if ($debug)
		{
			IPS_LogMessage('Denon Class','NSADisplay:'.$NSADisplayMessage);	
		}
		return $datasend;	
	}
	
    public function GetMapping()
    {
        $this->Mapping = DENON_API_Data_Mapping::GetMapping($this->APICommand);
    }

    public function GetSubCommandold()
    {
//        IPS_LogMessage('GetSubCommand', print_r(ISCP_API_Command_Mapping::GetMapping($this->APICommand), 1));
        $this->APISubCommand = (object) DENON_API_Command_Mapping::GetMapping($this->APICommand);
    }

}





?>