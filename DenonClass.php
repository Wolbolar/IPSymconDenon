<?

//  API Datentypen
class IPSVarType extends stdClass
{

    const vtNone = -1;
    const vtBoolean = 0;
    const vtInteger = 1;
    const vtFloat = 2;
    const vtString = 3;
    const vtDualInteger = 10;

}


class AVRCP_API_Data extends stdClass
{

    public $APICommand;
    public $Data;
    public $Mapping = null;
    public $APISubCommand = null;

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

    public function GetMapping()
    {
        $this->Mapping = ISCP_API_Data_Mapping::GetMapping($this->APICommand);
    }

    public function GetSubCommand()
    {
//        IPS_LogMessage('GetSubCommand', print_r(ISCP_API_Command_Mapping::GetMapping($this->APICommand), 1));
        $this->APISubCommand = (object) ISCP_API_Command_Mapping::GetMapping($this->APICommand);
    }

}

?>