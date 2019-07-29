<?php

require_once __DIR__ . '/../DenonClass.php';  // diverse Klassen

class DenonSplitterHTTP extends IPSModule
{
    protected $debug = false;

    public function __construct($InstanceID)
    {
        parent::__construct($InstanceID);

        if (file_exists(IPS_GetLogDir() . 'denondebug.txt')) {
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

    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        $ParentOpen = $this->HasActiveParent();
        if (!$ParentOpen) {
            $this->SetStatus(IS_INACTIVE);
        }
        if ($this->HasActiveParent()) {
            //Instanz aktiv
            $this->SetStatus(IS_ACTIVE);
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

    // Data an Child weitergeben
    public function ReceiveData($JSONString)
    {

        // Empfangene Daten vom Denon HTTP I/O
        $data   = json_decode($JSONString, false);
        $dataio = json_encode($data->Buffer);
        $this->SendDebug('Buffer IN', $dataio, 0);

        //IPS_LogMessage("ReceiveData Denon HTTP Splitter", utf8_decode($data->Buffer)); //utf8_decode geht nur bei string

        // Hier werden die Daten verarbeitet

        // Weiterleitung zu allen Gerät-/Device-Instanzen

        $this->SendDataToChildren(
            json_encode(['DataID' => '{D9209251-0036-48C2-AF96-9F5EDE761A52}', 'Buffer' => $data->Buffer])
        ); //Denon HTTP Splitter Interface GUI
    }

    //################# DATAPOINT RECEIVE FROM CHILD

    public function ForwardData($JSONString)
    {

        // Empfangene Daten von der Device Instanz
        $data     = json_decode($JSONString, false);
        $datasend = $data->Buffer;
        $this->SendDebug('Command Out', print_r($datasend, true), 0);

        // Weiterleiten zur I/O Instanz
        $resultat = $this->SendDataToParent(
            json_encode(['DataID' => '{B403182C-3506-466C-B8D5-842D9237BF02}', 'Buffer' => $data->Buffer])
        ); // Denon I/O HTTP TX GUI

        // Weiterverarbeiten und durchreichen
        return $resultat;
    }
}
