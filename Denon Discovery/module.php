<?
declare(strict_types=1);

require_once __DIR__ . '/../DenonClass.php';  // diverse Klassen

class DenonDiscovery extends IPSModule
{

	public function Create()
	{
		//Never delete this line!
		parent::Create();
		$this->RegisterAttributeString("devices", "[]");

		//we will wait until the kernel is ready
		$this->RegisterMessage(0, IPS_KERNELMESSAGE);
		$this->RegisterMessage(0, IPS_KERNELSTARTED);
		$this->RegisterTimer('Discovery', 0, 'DenonDiscovery_Dicover($_IPS[\'TARGET\']);');
	}

	/**
	 * Interne Funktion des SDK.
	 */
	public function ApplyChanges()
	{
		//Never delete this line!
		parent::ApplyChanges();

		if (IPS_GetKernelRunlevel() !== KR_READY) {
			return;
		}

		$this->WriteAttributeString("devices", json_encode($this->DiscoverDevices()));
		$this->SetTimerInterval('Discovery', 300000);

		// Status Error Kategorie zum Import auswählen
		$this->SetStatus(102);
	}

	public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
	{

		switch ($Message) {
			case IM_CHANGESTATUS:
				if ($Data[0] === IS_ACTIVE) {
					$this->ApplyChanges();
				}
				break;

			case IPS_KERNELMESSAGE:
				if ($Data[0] === KR_READY) {
					$this->ApplyChanges();
				}
				break;
			case IPS_KERNELSTARTED:
				$this->WriteAttributeString("devices", json_encode($this->DiscoverDevices()));
				break;

			default:
				break;
		}
	}


	/**
	 * Liefert alle Geräte.
	 *
	 * @return array configlist all devices
	 */
	private function Get_ListConfiguration()
	{
		$config_list = [];
		$DeviceIDList = IPS_GetInstanceListByModuleID('{9AE3087F-DC25-4ADB-AB46-AD7455E71032}'); // Denon Splitter Telnet
		$devices = $this->DiscoverDevices();
		$this->SendDebug('Denon discovered devices', json_encode($devices), 0);
		if (!empty($devices)) {
			foreach ($devices as $device) {
				$instanceID = 0;
				$name = $device["name"];
				$uuid = $device["uuid"];
				$host = $device["host"];
				$model = $device["model"];
				$device_id = 0;
				foreach ($DeviceIDList as $DeviceID) {
					if ($host == IPS_GetProperty($DeviceID, 'Host')) {
						$device_name = IPS_GetName($DeviceID);
						$this->SendDebug('Denon Discovery', 'device found: ' . utf8_decode($device_name) . ' (' . $DeviceID . ')', 0);
						$instanceID = $DeviceID;
					}
				}

				$config_list[] = [
					"instanceID" => $instanceID,
					"id" => $device_id,
					"name" => $name,
					"uuid" => $uuid,
					"host" => $host,
					"model" => $model,
					"create" => [
						[
							'moduleID' => '{DC733830-533B-43CD-98F5-23FC2E61287F}',
							'configuration' => [
								'manufacturer' => 1,
								'AVRTypeDenon' => $this->SetAVRType($model),
								'Zone' => 0
							]
						],
						[
							'moduleID' => '{9AE3087F-DC25-4ADB-AB46-AD7455E71032}',
							'configuration' => [
								'Host' => $host,
								'Port' => 23
							]
						],
						[
							'moduleID' => '{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}',
							'configuration' => [
								'Host' => $host,
								'Port' => 23,
								'Open' => true
							]
						]
					]
				];

			}
		}
		return $config_list;
	}

	private function SetAVRType($model)
	{
		$model = str_replace("-", "_", $model);
		$model = str_replace(" ", "_", $model);
		$manufacturer = "Denon";
		$avr_type = 50;
		foreach (AVRs::getAllAVRs() as $AVRName => $Caps) {
			if ($Caps['Manufacturer'] == $manufacturer && $AVRName == $model) {
				$avr_type = $Caps['internalID'];
			}
		}
		return $avr_type;
	}

	private function DiscoverDevices(): array
	{
		$devices = $this->mSearch();
		$this->SendDebug("Discover Response:", json_encode($devices), 0);
		$denon_info = $this->GetDenonInfo($devices);
		foreach ($denon_info as $device) {
			$this->SendDebug("name:", $device["name"], 0);
			$this->SendDebug("uuid:", $device["uuid"], 0);
			$this->SendDebug("host:", $device["host"], 0);
			$this->SendDebug("model:", $device["model"], 0);
		}
		return $denon_info;
	}

	protected function mSearch($st = 'upnp:rootdevice', $mx = 2, $man = 'ssdp:discover', $from = null, $port = null, $sockTimout = 3)
	{
		$user_agent = "MacOSX/10.8.2 UPnP/1.1 PHP-UPnP/0.0.1a";
		// BUILD MESSAGE
		$msg = 'M-SEARCH * HTTP/1.1' . "\r\n";
		$msg .= 'HOST: 239.255.255.250:1900' . "\r\n";
		$msg .= 'MAN: "' . $man . '"' . "\r\n";
		$msg .= 'MX: ' . $mx . "\r\n";
		$msg .= 'ST:' . $st . "\r\n";
		$msg .= 'USER-AGENT: ' . $user_agent . "\r\n";
		$msg .= '' . "\r\n";
		// MULTICAST MESSAGE
		$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		if (!$socket) {
			return [];
		}
		socket_set_option($socket, SOL_SOCKET, SO_BROADCAST, true);
		socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, true);
		// SET TIMEOUT FOR RECIEVE
		socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => $sockTimout, "usec" => 100000));
		//socket_bind($socket, '0.0.0.0', 0);
		if (@socket_sendto($socket, $msg, strlen($msg), 0, '239.255.255.250', 1900) === false) {
			return [];
		}
		// RECIEVE RESPONSE
		$response = array();
		do {
			$buf = null;
			$bytes = @socket_recvfrom($socket, $buf, 2048, 0, $from, $port);
			if ($bytes === false) {
				break;
			}
			if (!is_null($buf)) {
				$response[] = $this->parseMSearchResponse($buf);
			}
		} while (!is_null($buf));
		// CLOSE SOCKET
		socket_close($socket);
		$denon_response = [];
		foreach ($response as $device) {
			if (isset($device["server"])) {
				$denon_server = strpos($device["server"], "Denon");
				if ($denon_server != false) {
					$uuid = str_ireplace('uuid:', '', $device["usn"]);
					$cutoff = strpos($uuid, "::");
					$uuid = substr($uuid, 0, $cutoff);
					$denon_response[] = ["uuid" => $uuid, "location" => $device["location"], "server" => $device["server"]];
				}
			}
		}
		return $denon_response;
	}

	protected function parseMSearchResponse($response)
	{
		$responseArr = explode("\r\n", $response);
		$parsedResponse = array();
		foreach ($responseArr as $key => $row) {
			if (stripos($row, 'http') === 0)
				$parsedResponse['http'] = $row;
			if (stripos($row, 'cach') === 0)
				$parsedResponse['cache-control'] = str_ireplace('cache-control: ', '', $row);
			if (stripos($row, 'date') === 0)
				$parsedResponse['date'] = str_ireplace('date: ', '', $row);
			if (stripos($row, 'ext') === 0)
				$parsedResponse['ext'] = str_ireplace('ext: ', '', $row);
			if (stripos($row, 'loca') === 0)
				$parsedResponse['location'] = str_ireplace('location: ', '', $row);
			if (stripos($row, 'serv') === 0)
				$parsedResponse['server'] = str_ireplace('server: ', '', $row);
			if (stripos($row, 'st:') === 0)
				$parsedResponse['st'] = str_ireplace('st: ', '', $row);
			if (stripos($row, 'usn:') === 0)
				$parsedResponse['usn'] = str_ireplace('usn: ', '', $row);
			if (stripos($row, 'cont') === 0)
				$parsedResponse['content-length'] = str_ireplace('content-length: ', '', $row);
			if (stripos($row, 'nt:') === 0)
				$parsedResponse['nt'] = str_ireplace('nt: ', '', $row);
			if (stripos($row, 'nl-deviceid') === 0)
				$parsedResponse['nl-deviceid'] = str_ireplace('nl-deviceid: ', '', $row);
			if (stripos($row, 'nl-devicename:') === 0)
				$parsedResponse['nl-devicename'] = str_ireplace('nl-devicename: ', '', $row);
		}
		return $parsedResponse;
	}

	protected function GetDenonInfo($result)
	{
		$denon_info = [];
		foreach ($result as $device) {
			$uuid = $device["uuid"];
			$location = $device["location"];
			$description = $this->GetXML($location);
			$xml = simplexml_load_string($description);
			$name = strval($xml->device->friendlyName);
			$model = strval($xml->device->modelName);
			$location = str_ireplace('http://', '', $location);
			$location = explode(":", $location);
			$ip = $location[0];
			$denon_info[] = ["name" => $name, "uuid" => $uuid, "host" => $ip, "model" => $model];
		}
		return $denon_info;
	}

	private function GetXML($url)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		$this->SendDebug("Get XML Status:", $status_code, 0);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	public function GetDevices()
	{
		$devices = $this->ReadPropertyString("devices");
		return $devices;
	}

	public function Discover()
	{
		$this->LogMessage($this->Translate('Background Discovery of Denon AVR'), KL_NOTIFY);
		$this->WriteAttributeString("devices", json_encode($this->DiscoverDevices()));
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
		$Form = json_encode([
			'elements' => $this->FormHead(),
			'actions' => $this->FormActions(),
			'status' => $this->FormStatus()
		]);
		$this->SendDebug('FORM', $Form, 0);
		$this->SendDebug('FORM', json_last_error_msg(), 0);
		return $Form;
	}

	/**
	 * return form configurations on configuration step
	 * @return array
	 */
	protected function FormHead()
	{
		$form = [
		];
		return $form;
	}

	/**
	 * return form actions by token
	 * @return array
	 */
	protected function FormActions()
	{
		$form = [
			[
				'name' => 'DenonDiscovery',
				'type' => 'Configurator',
				'rowCount' => 20,
				'add' => false,
				'delete' => true,
				'sort' => [
					'column' => 'name',
					'direction' => 'ascending'
				],
				'columns' => [
					[
						'label' => 'ID',
						'name' => 'id',
						'width' => '200px',
						'visible' => false
					],
					[
						'label' => 'name',
						'name' => 'name',
						'width' => 'auto'
					],
					[
						'label' => 'model',
						'name' => 'model',
						'width' => '250px'
					],
					[
						'label' => 'UUID',
						'name' => 'uuid',
						'width' => '400px'
					],
					[
						'label' => 'host',
						'name' => 'host',
						'width' => '250px'
					]
				],
				'values' => $this->Get_ListConfiguration()
			]
		];
		return $form;
	}

	/**
	 * return from status
	 * @return array
	 */
	protected function FormStatus()
	{
		$form = [
			[
				'code' => 101,
				'icon' => 'inactive',
				'caption' => 'Creating instance.'
			],
			[
				'code' => 102,
				'icon' => 'active',
				'caption' => 'Denon Discovery created.'
			],
			[
				'code' => 104,
				'icon' => 'inactive',
				'caption' => 'interface closed.'
			],
			[
				'code' => 201,
				'icon' => 'inactive',
				'caption' => 'Please follow the instructions.'
			]
		];

		return $form;
	}
}
