<?php

require_once __DIR__.'/../DenonClass.php';  // diverse Klassen

class DenonAVRHTTP extends AVRModule
{
    public static $NEO_Parameter = ['PW'      => ['DAVRH_Power', 'Power'],
                             'ZM'      => ['DAVRH_MainZonePower', 'MainZonePower'],
                             'MU'      => ['DAVRH_MainMute', 'Mute'],
                             'Z2POWER' => ['DAVRH_Zone2Power', 'Zone2Power'],
                             'Z3POWER' => ['DAVRH_Zone3Power', 'Zone3Power'],
                             'Z2MU'    => ['DAVRH_Zone2Mute', 'Zone 2 Mute'],
                             'Z3MU'    => ['DAVRH_Zone3Mute', 'Zone 3 Mute'],
                            ];

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // 1. Verfügbarer DenonSplitter wird verbunden oder neu erzeugt, wenn nicht vorhanden.
        $this->ConnectParent('{0C62027E-7CD7-4DF8-890B-B0FEE37857D4}');

        $this->RegisterProperties();
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        $this->ValidateConfiguration();
    }

    private function ValidateConfiguration()
    {
        if (IPS_GetKernelRunlevel() != KR_READY) {
            return;
        }

        if (!$this->SetInstanceStatus()) {
            return;
        }

        //Zone prüfen
        $Zone = $this->ReadPropertyInteger('Zone');
        $manufacturername = $this->GetManufacturerName();
        $AVRType = $this->GetAVRType($manufacturername);

        $DenonAVRVar = new DENONIPSProfiles($AVRType);

        //Inputs ablegen, damit sie später dem Splitter zur Verfügung stehen
        DAVRSH_SaveInputVarmapping($this->GetParent(), json_encode($this->GetInputsAVR($DenonAVRVar)));

        $AVRCaps = AVRs::getCapabilities($AVRType);

        if ($this->GetIPParent() !== false) {
            $this->SetStatus(IS_ACTIVE);
        }

        $profiles = $DenonAVRVar->GetAllProfilesSortedByPos();
        $idents = [];

        if ($Zone == 0) {//Mainzone

            $idents[DENONIPSProfiles::ptMainZoneName] = $this->ReadPropertyBoolean('ZoneName');
            $idents[DENONIPSProfiles::ptModel] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptModel);
            $idents[DENONIPSProfiles::ptPower] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptPower);
            $idents[DENONIPSProfiles::ptMainZonePower] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptMainZonePower);
            $idents[DENONIPSProfiles::ptMainMute] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptMainMute);
            $idents[DENONIPSProfiles::ptSleep] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptSleep);
            $idents[DENONIPSProfiles::ptSurroundMode] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptSurroundMode);
            $idents[DENONIPSProfiles::ptNavigation] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptNavigation);
            $idents[DENONIPSProfiles::ptInputSource] = $this->ReadPropertyBoolean('InputSource');
            $idents[DENONIPSProfiles::ptSurroundPlayMode] = $this->ReadPropertyBoolean(DENONIPSProfiles::ptSurroundPlayMode);

            $Caps = $AVRCaps['CV_Commands'];

            foreach ($profiles as $key=>$profile) {
                if (in_array($profile['Ident'], $Caps)) {
                    $idents[$key] = $this->ReadPropertyBoolean($profile['PropertyName']);
                }
            }
        } else {//Zone 2 oder 3

            // ReadProperty of CommandArea 'Zone_Commands'
            foreach ($profiles as $key=>$profile) {
                if (in_array($profile['Ident'], $AVRCaps['Zone_Commands'])) {
                    // if it is a zone specific Command
                    if (in_array(substr($profile['Ident'], 0, 2), ['Z2', 'Z3'])
                        || in_array(substr($profile['Ident'], 0, 5), ['Zone2', 'Zone3'])) {

                        //select only the idents of the current zone
                        if ((substr($profile['Ident'], 0, 2) == 'Z'.($Zone + 1))
                            || (substr($profile['Ident'], 0, 5) == 'Zone'.($Zone + 1))) {
                            $idents[$key] = $this->ReadPropertyBoolean($profile['PropertyName']);
                        }
                    } else {
                        $idents[$key] = $this->ReadPropertyBoolean($profile['PropertyName']);
                    }
                }
            }
        }

        $this->RegisterVariables($DenonAVRVar, $idents, $AVRType, $manufacturername);

        // NEO Skripte anlegen
        if ($this->ReadPropertyBoolean('NEOToggle')) {
            $this->CreateNEOScripts(static::$NEO_Parameter);
        }
    }

    //Data Transfer
    private function SendCommand(string $payload)
    {
        $this->SendDebug('Send Command HTTP:', $payload, 0);
        $this->SendDataToParent(json_encode(['DataID' => '{DB1DDFAD-0DE9-47CF-B8E8-FB7E7425BF90}', 'Buffer' => $payload])); //Denon Splitter HTTP
    }

    /**
     * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
     * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:.
     */
    public function RequestAction($Ident, $Value)
    {

        //Input übergeben
        $InputMapping = DAVRSH_GetInputVarMapping($this->GetParent());
        IPS_LogMessage(get_class().'::'.__FUNCTION__, 'InputMapping: '.json_encode($InputMapping));

        //Command aus Ident
        $APICommand = $this->GetAPICommandFromIdent($Ident);

        // Subcommand holen
        $AVRType = $this->GetAVRType($this->GetManufacturerName());
        $APISubCommand = (new DENONIPSProfiles($AVRType, $InputMapping))->GetSubCommandOfValue($Ident, $Value);
        IPS_LogMessage(get_class().'::'.__FUNCTION__, 'Ident: '.$Ident.', Value: '.$Value.', SubCommand: '.$APISubCommand);

        // Daten senden        Rückgabe ist egal, Variable wird automatisch durch getstatus() im IO-Modul nachgeführt
        try {
            $this->SendCommand($APICommand.$APISubCommand);
        } catch (Exception $ex) {
            trigger_error($ex->getMessage(), $ex->getCode());
            echo $ex->getMessage();

            return false;
        }

        return true;
    }

    //Denon Commands
    //Power
    public function Power(bool $Value)
    { // false (Standby) oder true (On)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::PW, $Value);
        $this->SendCommand(DENON_API_Commands::PW.$SubCommand);
    }

    //Mainzone Power
    public function MainZonePower(bool $Value)
    { // MainZone true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::ZM, $Value);
        $this->SendCommand(DENON_API_Commands::ZM.$SubCommand);
    }

    //Zone 2 Power
    public function Zone2Power(bool $Value)
    { // Zone2 Power  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2POWER, $Value);
        $this->SendCommand(DENON_API_Commands::Z2.$SubCommand);
    }

    //Zone 3 Power
    public function Zone3Power(bool $Value)
    { // Zone3 Power  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3POWER, $Value);
        $this->SendCommand(DENON_API_Commands::Z3.$SubCommand);
    }

    //Master Volume Up/Down
    public function MasterVolume(string $Subcommand)
    { // "UP" or "DOWN"
        $payload = DENON_API_Commands::MV.$Subcommand;
        $this->SendCommand($payload);
    }

    //Main Mute
    public function MainMute(bool $Value)
    { // false (Off) oder true (On)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::MU, $Value);
        $this->SendCommand(DENON_API_Commands::MU.$SubCommand);
    }

    //Zone2 Mute
    public function Zone2Mute(bool $Value)
    { // Zone2 Mute  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z2MU, $Value);
        $this->SendCommand(DENON_API_Commands::Z2MU.$SubCommand);
    }

    //Zone3 Mute
    public function Zone3Mute(bool $Value)
    { // Zone3 Mute  true (On) or false (Off)
        $SubCommand = (new DENONIPSProfiles())->GetSubCommandOfValue(DENON_API_Commands::Z3MU, $Value);
        $this->SendCommand(DENON_API_Commands::Z3MU.$SubCommand);
    }

    //Send HTTP Command
    public function SendHTTPCommand(string $Command)
    { // Beliebiges Command
        $this->SendCommand($Command);
    }

	/***********************************************************
	 * Configuration Form
	 ***********************************************************/

	/**
	 * build configuration form
	 * @return string
	 */
	public function GetConfigurationForm()
	{
		// return current form
		return json_encode([
			'elements' => $this->FormHead(),
			'actions' => $this->FormActions(),
			'status' => $this->FormStatus()
		]);
	}

	/**
	 * return form configurations on configuration step
	 * @return array
	 */
	private function FormHead()
	{
		$manufacturername = $this->GetManufacturerName();
		$AVRType = $this->GetAVRType($manufacturername);
		$zone = $this->ReadPropertyInteger('Zone');

		if ($this->debug) {
			// $this->LogMessage('Manufacturername: ' . $manufacturername . ', AVRType: ' . $AVRType . ', Zone: ' . $zone, KL_WARNING);
			IPS_LogMessage(__FUNCTION__, 'Manufacturername: ' . $manufacturername . ', AVRType: ' . $AVRType . ', Zone: ' . $zone);
		}

		$form = [
			[
				'type' => 'Label',
				'caption' => 'AV Receiver Control http'
			],
			[
				'type' => 'Label',
				'caption' => 'http control is working only with AVR types from 2011, only some commands are available.'
			],
			[
				'type' => 'Label',
				'caption' => 'Please select a manufacturer and push the "Apply Changes" button'
			],
			[
				'type' => 'Select',
				'name' => 'manufacturer',
				'caption' => 'manufacturer',
				'options' => [
					[
						'label' => 'Please Select',
						'value' => 0
					],
					[
						'label' => 'Denon',
						'value' => 1
					],
					[
						'label' => 'Marantz',
						'value' => 2
					]
				]

			]
		];

		if($manufacturername == 'none')
		{
			$this->SendDebug("Form", "no manufacturer selected", 0);
		}

		// selection model
		elseif ($AVRType === false) {
			$form = array_merge_recursive(
				$form, $this->FormSelectionAVR($manufacturername)
			);
		}
		elseif ($zone == 6) {
			$form = array_merge_recursive(
				$form, $this->FormSelectionAVR($manufacturername)
			);
			$form = array_merge_recursive(
				$form, $this->FormSelectionZone()
			);
		}
		else{
			if ($zone == 0) {
				$form = array_merge_recursive(
					$form, $this->FormSelectionAVR($manufacturername)
				);
				$form = array_merge_recursive(
					$form, $this->FormSelectionZone()
				);
				$form = array_merge_recursive(
					$form, $this->FormMainzone($AVRType)
				);
				$form = array_merge_recursive(
					$form, $this->FormSelectionNEO()
				);
			}
			else{
				$form = array_merge_recursive(
					$form, $this->FormSelectionAVR($manufacturername)
				);
				$form = array_merge_recursive(
					$form, $this->FormSelectionZone()
				);
				$form = array_merge_recursive(
					$form, $this->FormZone($zone, $AVRType)
				);
				$form = array_merge_recursive(
					$form, $this->FormSelectionNEO()
				);
			}
		}
		if ($this->debug) {
			file_put_contents(IPS_GetLogDir() . 'form_http_gen.json', $form);
		}
		return $form;
	}

    private function FormMainzone($AVRType)
    {
        $AVRCaps = AVRs::getCapabilities($AVRType);
        if ($this->debug) {
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'AVR Caps ('.$AVRType.'): '.json_encode($AVRCaps));
        }

        $profiles = (new DENONIPSProfiles($AVRType))->GetAllProfilesSortedByPos();

		$form = [
			[
				'type' => 'Label',
				'caption' => 'main zone:'
			],
			[
				'type' => 'Label',
				'caption' => 'Main Zone Settings:'
			]
		];

        foreach ([
            DENONIPSProfiles::ptMainZoneName,
            DENONIPSProfiles::ptModel,
            DENONIPSProfiles::ptPower,
            DENONIPSProfiles::ptMainZonePower,
            DENONIPSProfiles::ptMainMute,
            DENONIPSProfiles::ptInputSource,
            //DENONIPSProfiles::ptSurroundMode, //z.Zt. nicht unterstützt, da der SR7010 z.B. mit 'DOLBY SURROUND' antwortet
            DENONIPSProfiles::ptMasterVolume,
            DENONIPSProfiles::ptSleep,
                ] as $key) {
            $profile = $profiles[$key];
            $item = $this->getTypeItem('CheckBox', $profile['Ident'], $profile['PropertyName'], $profile['Name']);
            if ($item){
                $form[] = $item;
            }
        }

		$form = array_merge_recursive(
			$form, $this->FormMoreInputs()
		);
        return $form;
    }

    private function FormZone($Zone, $AVRType)
    {
        $AVRCaps = AVRs::getCapabilities($AVRType);
        if ($this->debug) {
            IPS_LogMessage(get_class().'::'.__FUNCTION__, 'AVR Caps ('.$AVRType.'): '.json_encode($AVRCaps));
        }

        $Zone = $Zone + 1;
        $profiles = (new DENONIPSProfiles($AVRType))->GetAllProfilesSortedByPos();

		$form = [
			[
				'type' => 'Label',
				'caption' => 'Zone '.$Zone.':'
			],
			[
				'type' => 'Label',
				'caption' => 'Zone Settings:'
			]
		];

        if ($Zone == 2) {
            $ZoneCommands = [
                DENONIPSProfiles::ptModel,
                DENONIPSProfiles::ptPower,
                DENONIPSProfiles::ptZone2Name,
                DENONIPSProfiles::ptZone2Power,
                DENONIPSProfiles::ptZone2Mute,
                DENONIPSProfiles::ptZone2HPF,
                DENONIPSProfiles::ptZone2InputSource,
                DENONIPSProfiles::ptZone2ChannelSetting,
                DENONIPSProfiles::ptZone2QuickSelect,
                DENONIPSProfiles::ptZone2Volume,
                DENONIPSProfiles::ptZone2ChannelVolumeFL,
                DENONIPSProfiles::ptZone2ChannelVolumeFR,
                DENONIPSProfiles::ptZone2Sleep,
            ];
        } else {
            $ZoneCommands = [
                DENONIPSProfiles::ptModel,
                DENONIPSProfiles::ptPower,
                DENONIPSProfiles::ptZone3Name,
                DENONIPSProfiles::ptZone3Power,
                DENONIPSProfiles::ptZone3Mute,
                DENONIPSProfiles::ptZone3HPF,
                DENONIPSProfiles::ptZone3InputSource,
                DENONIPSProfiles::ptZone3ChannelSetting,
                DENONIPSProfiles::ptZone3QuickSelect,
                DENONIPSProfiles::ptZone3Volume,
                DENONIPSProfiles::ptZone3ChannelVolumeFL,
                DENONIPSProfiles::ptZone3ChannelVolumeFR,
                DENONIPSProfiles::ptZone3Sleep,
            ];
        }

        foreach ($ZoneCommands as $key) {
            $profile = $profiles[$key];
			$form = array_merge_recursive(
				$form, $this->getTypeItem('CheckBox', $profile['Ident'], $profile['PropertyName'], $profile['Name'])
			);
        }
		$form = array_merge_recursive(
			$form, $this->FormMoreInputs()
		);
        return $form;
    }

	/**
	 * return form actions by token
	 * @return array
	 */
	private function FormActions()
	{
		$manufacturername = $this->GetManufacturerName();
		$form = [
		];
		if ($manufacturername == 'none') {
			$form = array_merge_recursive(
				$form,
				[]
			);
		} else {

			$form = array_merge_recursive(
				$form,
				[
					[
						'type' => 'Button',
						'caption' => 'Power On',
						'onClick' => 'DAVRH_Power($id, true);'
					],
					[
						'type' => 'Button',
						'caption' => 'Power Off',
						'onClick' => 'DAVRH_Power($id, false);'
					]
				]
			);
		}
		return $form;
	}
}
