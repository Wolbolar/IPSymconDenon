<?php

require_once __DIR__.'/../DenonClass.php';  // diverse Klassen

/** @noinspection AutoloadingIssuesInspection */

class DenonSplitterTelnet extends IPSModule
{
    private const STATUS_INST_IP_IS_EMPTY = 202;
    private const STATUS_INST_CONNECTION_LOST = 203;
    private const STATUS_INST_IP_IS_INVALID = 204; //IP Adresse ist ungültig

    private $debug = false;

public function __construct($InstanceID)
{
    parent::__construct($InstanceID);

    if (file_exists(IPS_GetLogDir().'denondebug.txt')){
        $this->debug = true;
    }
}

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        //These lines are parsed on Symcon Startup or Instance creation
        //You cannot use variables here. Just static values.

        // ClientSocket benötigt
        $this->RequireParent('{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}'); //Clientsocket

        $this->RegisterPropertyString('Host', '192.168.x.x');
        $this->RegisterPropertyInteger('Port', 23);

        //we will set the instance status when the parent status changes
        $this->RegisterMessage($this->GetParent(), IM_CHANGESTATUS);
    }

    public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
    {
        if ($this->debug) {
            IPS_LogMessage(__CLASS__.'::'.__FUNCTION__, 'SenderID: '.$SenderID.', Message: '.$Message.', Data:'.json_encode($Data));
        }

        /** @noinspection DegradedSwitchInspection */
        switch ($Message) {
            case IM_CHANGESTATUS:
                $this->ApplyChanges();
                break;
            default:
                trigger_error('Unexpected Message: '.$Message);
         }
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();
        $PropertyChanged = false;
        $this->RegisterVariableString('InputMapping', 'Input Mapping', '', 1);
        IPS_SetHidden($this->GetIDForIdent('InputMapping'), true);

        $this->RegisterVariableString('AVRType', 'AVRType', '', 2);
        IPS_SetHidden($this->GetIDForIdent('AVRType'), true);

        //IP Prüfen
        $ip = $this->ReadPropertyString('Host');
        if (filter_var($ip, FILTER_VALIDATE_IP)) {

            // Zwangskonfiguration des ClientSocket
            $ParentID = $this->GetParent();
            if ($ParentID) {
                if (IPS_GetProperty($ParentID, 'Host') !== $this->ReadPropertyString('Host')) {
                    IPS_SetProperty($ParentID, 'Host', $this->ReadPropertyString('Host'));
                    $PropertyChanged = true;
                }
                if (IPS_GetProperty($ParentID, 'Port') !== $this->ReadPropertyInteger('Port')) {
                    IPS_SetProperty($ParentID, 'Port', $this->ReadPropertyInteger('Port'));
                    $PropertyChanged = true;
                }

                $ParentOpen = $this->HasActiveParent($this->GetParent());

                // Keine Verbindung erzwingen wenn IP leer ist, sonst folgt später Exception.

                if (!$ParentOpen) {
                    $this->SetStatus(IS_INACTIVE);
                }

                if ($this->ReadPropertyString('Host') === '') {
                    $this->SetStatus(self::STATUS_INST_IP_IS_EMPTY);
                }

                if ($PropertyChanged) {
                    IPS_ApplyChanges($ParentID);
                }

                // Wenn I/O verbunden ist

                if ($this->HasActiveParent($ParentID)) {
                    //Instanz aktiv
                    $this->SetStatus(IS_ACTIVE);
                }
            }
        } else {
            $this->SetStatus(self::STATUS_INST_IP_IS_INVALID); //IP Adresse ist ungültig
        }
    }

    /**
     * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
     * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:.
     */

    /**
     * @param string $MappingInputs Input MappingInputs als JSON
     *
     * @return bool
     */
    public function SaveInputVarmapping(string $MappingInputs):bool
    {
        if ($MappingInputs === 'null') {
            trigger_error('MappingInputs is NULL');

            return false;
        }

        $idInputMapping = $this->GetIDForIdent('InputMapping');
        if ($idInputMapping) {
            $InputsMapping = GetValue($idInputMapping);
            if (($InputsMapping !== '') && ($InputsMapping !== 'null')) { //Auslesen wenn Variable nicht leer
                $Writeprotected = json_decode($InputsMapping)->Writeprotected;
                if (!$Writeprotected) { // Auf Schreibschutz prüfen
                    $this->SetValue('InputMapping', $MappingInputs);
                    $this->SetValue('AVRType', json_decode($MappingInputs)->AVRType);
                }
            } else { // Schreiben wenn Variable noch nicht gesetzt
                $this->SetValue('InputMapping', $MappingInputs);
                $this->SetValue('AVRType', json_decode($MappingInputs)->AVRType);
            }

            return true;
        }

        trigger_error('InputMapping Variable not found!');

        return false;
    }

    // Input MappingInputs als JSON
    public function SaveOwnInputVarmapping(string $MappingInputs):void
    {
        if ($this->GetIDForIdent('InputMapping')) {
            $MappingInputsArr = json_decode($MappingInputs);
            $AVRType = $MappingInputsArr->AVRType;
            $this->SetValue('InputMapping', $MappingInputs);
            $this->SetValue('AVRType', $AVRType);
        }
    }


    public function GetInputVarMapping()
    {
        $InputsMapping = $this->GetValue('InputMapping');
        if ($this->debug) {
            IPS_LogMessage(__CLASS__.'::'.__FUNCTION__, 'InputsMapping: '.$InputsMapping);
        }

        $InputsMapping = json_decode($InputsMapping);

        if ($InputsMapping === null) {
            trigger_error(__FUNCTION__.': InputMapping cannot be decoded');

            return false;
        }

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

    //################# DUMMYS / WOARKAROUNDS - protected

    protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);

        return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;
    }

    private function HasActiveParent($ParentID):bool
    {
        if (($ParentID > 0) && IPS_GetInstance($ParentID)['InstanceStatus'] === IS_ACTIVE) {
            return true;
        }

        $this->SetStatus(self::STATUS_INST_CONNECTION_LOST);

        return false;
    }

    public function GetStatusHTTP()
    {
        $data = '';
        $InputsMapping = json_decode($this->GetValue('InputMapping'));

        if (!isset($InputsMapping->AVRType)) {
            IPS_LogMessage(__FUNCTION__, 'AVRType not set!');

            return false;
        }
        $AVRType = $InputsMapping->AVRType;

        if (AVRs::getCapabilities($AVRType)['httpMainZone'] !== DENON_HTTP_Interface::NoHTTPInterface) { //Nur Ausführen wenn AVR HTTP unterstützt
            // Empfangene Daten vom Denon AVR Receiver

            //Semaphore setzen
            if ($this->lock('HTTPGetState')) {
                // Daten senden
                try {
                    //Daten abholen
                    $DenonStatusHTTP = new DENON_StatusHTML();
                    $ipdenon = $this->ReadPropertyString('Host');
                    $AVRType = $this->GetValue('AVRType');
                    $InputMapping = $this->GetInputVarMapping();
                    if ($InputMapping === false) {
                        //InputMapping konnte nicht geleden werden
                        return false;
                    }
                    $data = $DenonStatusHTTP->getStates($ipdenon, $InputMapping, $AVRType);
                    $this->SendDebug('HTTP States:', json_encode($data), 0);

                    // Weiterleitung zu allen Gerät-/Device-Instanzen
                    $this->SendDataToChildren(json_encode(['DataID' => '{7DC37CD4-44A1-4BA6-AC77-58369F5025BD}', 'Buffer' => $data])); //Denon Telnet Splitter Interface GUI
                } catch (Exception $exc) {
                    // Senden fehlgeschlagen
                    $this->unlock('HTTPGetState');

                    trigger_error('HTTPGetState failed');
                }
                $this->unlock('HTTPGetState');
            } else {
                trigger_error('Can not set lock \'HTTPGetState\'');
            }

            return $data;
        }

        return false;
    }

    protected function SetStatus($Status)
    {
        $this->senddebug(__FUNCTION__, 'Status: '.$Status, 0);

        if ($Status !== IPS_GetInstance($this->InstanceID)['InstanceStatus']) {
            parent::SetStatus($Status);
        }
    }

    // Display NSE, NSA, NSH noch ergänzen

    //Tuner ergänzen

    //################# Datapoints

    // Data an Child weitergeben
    public function ReceiveData($JSONString):bool
    {

        // Empfangene Daten vom I/O
        $payload = json_decode($JSONString);
        $dataio = json_decode($this->GetBuffer(__FUNCTION__)).$payload->Buffer;
        $this->SetBuffer(__FUNCTION__, '');
        $this->SendDebug('Data from I/O:', json_encode($dataio), 0);

        // the received data must be terminated with \r
        if (substr($dataio, strlen($dataio) - 1) !== "\r") {
            if ($this->debug) {
                IPS_LogMessage(__CLASS__.'::'.__FUNCTION__, 'received data are buffered, because they are not terminated: '.json_encode($dataio));
            }
            $this->SetBuffer(__FUNCTION__, json_encode($dataio));

            return false;
        }

        //Daten aufteilen und Abschlusszeichen wegschmeißen
        $data = explode("\r", $dataio);
        array_pop($data);

        $this->SendDebug('Received Data:', json_encode($data), 0);
        if ($this->debug) {
            IPS_LogMessage(__CLASS__.'::'.__FUNCTION__, 'received data: '.json_encode($data));
        }

        $APIData = new DenonAVRCP_API_Data($this->GetValue('AVRType'), $data);

        $InputMapping = $this->GetInputVarMapping();
        $SetCommand = $APIData->GetCommandResponse($InputMapping);
        $this->SendDebug('Buffer IN:', json_encode($SetCommand), 0);

        // Weiterleitung zu allen Telnet Gerät-/Device-Instanzen wenn SetCommand gefüllt ist

        if (($SetCommand['SurroundDisplay'] !== '') ||(count($SetCommand['Data']) > 0) || (count($SetCommand['Display']) > 0)){
            $this->SendDataToChildren(json_encode(['DataID' => '{7DC37CD4-44A1-4BA6-AC77-58369F5025BD}', 'Buffer' => $SetCommand])); //Denon Telnet Splitter Interface GUI
        }

        return true;
    }

    //################# DATAPOINT RECEIVE FROM CHILD

    public function ForwardData($JSONString)
    {

        // Empfangene Daten von der Device Instanz
        $data = json_decode($JSONString);
        $this->SendDebug('Command Out:', print_r($data->Buffer, true), 0);

        if ($this->debug) {
            IPS_LogMessage(__CLASS__.'::'.__FUNCTION__, 'send data: '.$data->Buffer);
        }
        // Hier würde man den Buffer im Normalfall verarbeiten
        // z.B. CRC prüfen, in Einzelteile zerlegen

        try {
            // Weiterleiten zur I/O Instanz
            $resultat = $this->SendDataToParent(json_encode(['DataID' => '{79827379-F36E-4ADA-8A95-5F8D1DC92FA9}', 'Buffer' => $data->Buffer])); //TX GUID

        } catch (Exception $ex) {
            echo $ex->getMessage();
            echo ' in '.$ex->getFile().' line: '.$ex->getLine().'.';

            return false;
        }

        // Weiterverarbeiten und durchreichen
        return $resultat;
    }

    //################# SEMAPHOREN Helper  - private

    private function lock($ident): bool
    {
        return IPS_SemaphoreEnter('DENONAVRT_' . $this->InstanceID . $ident, 2000);
    }

    private function unlock($ident): bool
    {
        return IPS_SemaphoreLeave('DENONAVRT_'. $this->InstanceID . $ident);
    }
}
