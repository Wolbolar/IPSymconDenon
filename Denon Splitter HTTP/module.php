<?php

require_once __DIR__.'/../DenonClass.php';  // diverse Klassen

class DenonSplitterHTTP extends IPSModule
{
    const STATUS_INST_IS_ACTIVE = 102; //Instanz aktiv
    const STATUS_INST_IS_INACTIVE = 104;
    const STATUS_INST_IP_IS_EMPTY = 202;
    const STATUS_INST_CONNECTION_LOST = 203;
    const STATUS_INST_IP_IS_INVALID = 204; //IP Adresse ist ungültig

    protected $debug = false;

    public function __construct($InstanceID) {
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
        $this->RequireParent('{6CC8F890-06DF-4A0E-9C7F-484D04101C8D}'); //Denon HTTP Socket

        $this->RegisterPropertyString('Host', '192.168.x.x');
        $this->RegisterPropertyBoolean('Open', false);
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();
        $change = false;

        //IP Prüfen
        $ip = $this->ReadPropertyString('Host');
        if (filter_var($ip, FILTER_VALIDATE_IP)) {

            // Zwangskonfiguration des ClientSocket
            $ParentID = $this->GetParent();
            if ($ParentID) {
                if (IPS_GetProperty($ParentID, 'Host') != $this->ReadPropertyString('Host')) {
                    IPS_SetProperty($ParentID, 'Host', $this->ReadPropertyString('Host'));
                    $change = true;
                }

                $ParentOpen = $this->HasActiveParent($this->GetParent());

                // Keine Verbindung erzwingen wenn IP leer ist, sonst folgt später Exception.

                if (!$ParentOpen) {
                    $this->SetStatus(self::STATUS_INST_IS_INACTIVE);
                }

                if ($this->ReadPropertyString('Host') == '') {
                    $this->SetStatus(self::STATUS_INST_IP_IS_EMPTY);
                    $ParentOpen = false;
                }

                //IO Denon HTTP Open
                if (IPS_GetProperty($ParentID, 'Open') != $ParentOpen) {
                    IPS_SetProperty($ParentID, 'Open', $ParentOpen);
                    $change = true;
                }
                if ($change) {
                    @IPS_ApplyChanges($ParentID);
                }

                // Wenn I/O verbunden ist

                if (($this->ReadPropertyBoolean('Open')) && $this->HasActiveParent($ParentID)) {
                    //Instanz aktiv
                    $this->SetStatus(self::STATUS_INST_IS_ACTIVE);
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

    // Input
    public function SaveInputVarmapping(string $MappingInputs)
    {
        DAVRIO_SaveInputVarmapping($this->GetParent(), $MappingInputs);
    }

    public function GetInputVarMapping()
    {
        $InputsMapping = DAVRIO_GetInputVarMapping($this->GetParent());

        return $InputsMapping;
    }

    //################# DUMMYS / WOARKAROUNDS - protected

    protected function GetParent()
    {
        $instance = IPS_GetInstance($this->InstanceID);

        return ($instance['ConnectionID'] > 0) ? $instance['ConnectionID'] : false;
    }

    private function HasActiveParent($ParentID)
    {
        if ($ParentID > 0) {
            if (IPS_GetInstance($ParentID)['InstanceStatus'] == self::STATUS_INST_IS_ACTIVE) {
                return true;
            }
        }

        $this->SetStatus(self::STATUS_INST_CONNECTION_LOST);

        return false;
    }

    protected function RequireParent($ModuleID)
    {
        $instance = IPS_GetInstance($this->InstanceID);
        if ($instance['ConnectionID'] == 0) {
            $parentID = IPS_CreateInstance($ModuleID);
            $instance = IPS_GetInstance($parentID);
            IPS_SetName($parentID, $instance['ModuleInfo']['ModuleName']);
            IPS_ConnectInstance($this->InstanceID, $parentID);
        }
    }

    // Data an Child weitergeben
    public function ReceiveData($JSONString)
    {

        // Empfangene Daten vom Denon HTTP I/O
        $data = json_decode($JSONString);
        $dataio = json_encode($data->Buffer);
        $this->SendDebug('Buffer IN', $dataio, 0);

        //IPS_LogMessage("ReceiveData Denon HTTP Splitter", utf8_decode($data->Buffer)); //utf8_decode geht nur bei string

        // Hier werden die Daten verarbeitet

        // Weiterleitung zu allen Gerät-/Device-Instanzen

        $this->SendDataToChildren(json_encode(['DataID' => '{D9209251-0036-48C2-AF96-9F5EDE761A52}', 'Buffer' => $data->Buffer])); //Denon HTTP Splitter Interface GUI
    }

    //################# DATAPOINT RECEIVE FROM CHILD

    public function ForwardData($JSONString)
    {

        // Empfangene Daten von der Device Instanz
        $data = json_decode($JSONString);
        $datasend = $data->Buffer;
        $this->SendDebug('Command Out', print_r($datasend, true), 0);

        // Weiterleiten zur I/O Instanz
        $resultat = $this->SendDataToParent(json_encode(['DataID' => '{B403182C-3506-466C-B8D5-842D9237BF02}', 'Buffer' => $data->Buffer])); // Denon I/O HTTP TX GUI

        // Weiterverarbeiten und durchreichen
        return $resultat;
    }
}
