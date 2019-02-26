<?php

require_once __DIR__.'/../DenonClass.php';  // diverse Klassen

class DenonAVRIOHTTP extends IPSModule
{
    const STATUS_INST_IP_IS_INVALID = 204; //IP Adresse ist ungültig

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        //These lines are parsed on Symcon Startup or Instance creation
        //You cannot use variables here. Just static values.

        $this->RegisterPropertyBoolean('Open', false);
        $this->RegisterPropertyString('Host', '192.168.x.x');
        $this->RegisterPropertyInteger('UpdateInterval', 10);
        $this->RegisterTimer('Update', 0, 'DAVRIO_GetStatus(' . $this->InstanceID . ');');
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        $this->RegisterVariableString('InputMapping', 'Input Mapping', '', 1);
        IPS_SetHidden($this->GetIDForIdent('InputMapping'), true);

        $this->RegisterVariableString('AVRType', 'AVRType', '', 2);
        IPS_SetHidden($this->GetIDForIdent('AVRType'), true);

        //IP Prüfen
        if (filter_var($this->ReadPropertyString('Host'), FILTER_VALIDATE_IP)) {
            if ($this->ReadPropertyBoolean('Open')) {
                $this->SetStatus(IS_ACTIVE);
            } else {
                $this->SetStatus(IS_INACTIVE);
            }
        } else {
            $this->SetStatus(self::STATUS_INST_IP_IS_INVALID); //IP Adresse ist ungültig
        }
		$this->SetUpdateTimerInterval();
    }

	protected function SetUpdateTimerInterval()
	{
		$Interval = $this->ReadPropertyInteger('UpdateInterval') * 1000;
		$this->SetTimerInterval("Update", $Interval);
	}


    public function GetInputArrayStatus()
    {
        $InputsMapping = GetValue($this->GetIDForIdent('InputMapping'));
        $InputsMapping = json_decode($InputsMapping);
        //Varmapping generieren
        $AVRType = $InputsMapping->AVRType;
        $Writeprotected = $InputsMapping->Writeprotected;
        $Inputs = $InputsMapping->Inputs;
        $Varmapping = [];
        foreach ($Inputs as $Key => $Input) {
            $Command = $Input->Source;
            $Varmapping[$Command] = $Key;
        }
        $InputArray = ['AVRType' => $AVRType, 'Writeprotected' => $Writeprotected, 'Inputs' => $Inputs];

        return $InputArray;
    }

    //################# Datapoints

    //################# DATAPOINT RECEIVE FROM CHILD

    public function ForwardData($JSONString)
    {

        // Empfangene Daten von der Splitter Instanz
        $data = json_decode($JSONString);

        // Hier würde man den Buffer im Normalfall verarbeiten
        // z.B. CRC prüfen, in Einzelteile zerlegen
        try {
            // Absenden an Denon AVR
            $command = $data->Buffer;
            IPS_LogMessage('Denon AVR I/O', 'HTTP Command Out '.json_encode($command));
            $this->SendDebug('Command Out', json_encode($command), 0);
            $this->SendCommand($command);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            echo ' in '.$ex->getFile().' line: '.$ex->getLine().'.';
        }
    }

    public function GetStatus()
    {
        // Empfangene Daten vom Denon AVR Receiver

        //Semaphore setzen
        if ($this->lock('HTTPGetState')) {
            // Daten senden
            try {
                //Daten abholen
                $DenonStatus = new DENON_StatusHTML();
                $ipdenon = $this->ReadPropertyString('Host');
                $InputMapping = $this->GetInputVarMapping();
                $AVRType = $this->GetAVRType();

                $data = $DenonStatus->getStates($ipdenon, $InputMapping, $AVRType);

                $this->SendDebug('Status', json_encode($data), 0);
                $this->SendJSON($data);
            } catch (Exception $exc) {
                // Senden fehlgeschlagen
                $this->unlock('HTTPGetState');

                throw new Exception($exc);
            }
            $this->unlock('HTTPGetState');

            return $data;
        } else {
            echo "Can not send to parent \n";
            $this->unlock('HTTPGetState');
            //throw new Exception("Can not send to parent",E_USER_NOTICE);
        }

        return false;
    }

    private function SendJSON($data)
    {
        // Weiterleitung zu allen Geräte-/Device-Instanzen
        $this->SendDataToChildren(json_encode(['DataID' => '{E73CE1D0-6670-4607-ACA1-30469558D2F7}', 'Buffer' => $data])); //Denon I/O HTTP RX GUI
    }

    private function SendCommand(string $command)
    {
        $ip = $this->ReadPropertyString('Host');
        //Ins URL Format bringen
        //$command = urlencode ($command);

        //Semaphore setzen
        if ($this->lock('HTTPCommandSend')) {

            //Command für URL Codieren
            $httpcommand = 'http://'.$ip.'/goform/formiPhoneAppDirect.xml?'.rawurlencode($command);
            $this->SendDebug('HTTP Command Send', $httpcommand, 0);

            // Daten senden
            try {
                file_get_contents($httpcommand);
            } catch (Exception $exc) {
                // Senden fehlgeschlagen
                $this->unlock('HTTPCommandSend');

                throw new Exception($exc);
            }
            $this->unlock('HTTPCommandSend');
        } else {
            echo "Can not send to parent \n";
            $this->SendDebug('Denon HTTP I/O:', 'Can not send to AVR', 0);
            IPS_LogMessage('Denon AVR I/O', 'Can not send to parent');
            $this->unlock('HTTPCommandSend');
            //throw new Exception("Can not send to parent",E_USER_NOTICE);
        }

        IPS_Sleep(1000); //von 400 auf 1000 erhöht, da manche AVR (z.B. 3312) nicht schnell genug sind

        if ($this->lock('HTTPCommandSend')) {
            // 'Response' abholen
            try {
                $this->GetStatus();
            } catch (Exception $exc) {
                $this->unlock('HTTPCommandSend');

                throw new Exception($exc);
            }
            $this->unlock('HTTPCommandSend');
        } else {
            echo "Can not get response \n";
            $this->SendDebug('Denon HTTP I/O:', 'Can not get response', 0);
            IPS_LogMessage('Denon AVR I/O', 'Can not get response');
            $this->unlock('HTTPCommandSend');
            //throw new Exception("Can not send to parent",E_USER_NOTICE);
        }
    }

    // Input
    public function SaveInputVarmapping(string $MappingInputs)
    {
        if ($this->GetIDForIdent('InputMapping')) {
            $InputsMapping = GetValue($this->GetIDForIdent('InputMapping'));
            if (($InputsMapping !== '') && ($InputsMapping !== 'null')) {
                $InputsMapping = json_decode($InputsMapping);
                $Writeprotected = $InputsMapping->Writeprotected;
                if (!$Writeprotected) {
                    $MappingInputsArr = json_decode($MappingInputs);
                    $AVRType = $MappingInputsArr->AVRType;
                    SetValue($this->GetIDForIdent('InputMapping'), $MappingInputs);
                    SetValue($this->GetIDForIdent('AVRType'), $AVRType);
                }
            } else {
                $MappingInputsArr = json_decode($MappingInputs);
                $AVRType = $MappingInputsArr->AVRType;
                SetValue($this->GetIDForIdent('InputMapping'), $MappingInputs);
                SetValue($this->GetIDForIdent('AVRType'), $AVRType);
            }
        }
    }

    // Input MappingInputs als JSON
    public function SaveOwnInputVarmapping(string $MappingInputs)
    {
        if ($this->GetIDForIdent('InputMapping')) {
            $MappingInputsArr = json_decode($MappingInputs);
            $AVRType = $MappingInputsArr->AVRType;
            SetValue($this->GetIDForIdent('InputMapping'), $MappingInputs);
            SetValue($this->GetIDForIdent('AVRType'), $AVRType);
        }
    }

    public function GetInputVarMapping()
    {
        $InputsMapping = GetValue($this->GetIDForIdent('InputMapping'));
        $InputsMapping = json_decode($InputsMapping);
        //Varmapping generieren
        $Inputs = $InputsMapping->Inputs;
        $Varmapping = [];
        foreach ($Inputs as $Key => $Input) {
            $Command = $Input->Source;
            if (array_key_exists($Command, DENON_API_Commands::$SIMapping)) {
                $Command = DENON_API_Commands::$SIMapping[$Command];
            }
            $Varmapping[$Command] = $Key;
        }

        return $Varmapping;
    }

    private function GetAVRType()
    {
        $GetAVRType = GetValue($this->GetIDForIdent('AVRType'));

        return $GetAVRType;
    }

    //################# SEMAPHOREN Helper  - private

    private function lock($ident)
    {
        for ($i = 0; $i < 10; $i++) {
            if (IPS_SemaphoreEnter(get_class().'_'.(string) $this->InstanceID.(string) $ident, 1000)) {
                return true;
            } else {
                IPS_Sleep(mt_rand(1, 5));
            }
        }

        return false;
    }

    private function unlock($ident)
    {
        IPS_SemaphoreLeave(get_class().'_'.(string) $this->InstanceID.(string) $ident);
    }
}
