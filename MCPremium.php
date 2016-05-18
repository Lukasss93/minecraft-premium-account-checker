<?php

class MCPremium
{
	const game = "Minecraft";
	const version = 12;
	const api = "https://authserver.mojang.com/authenticate";

	private $premium = false;
	private $error = null;
	private $username = null;
	private $correct_username = null;
	private $uuid = null;
	private $raw=null;

	public function __construct()
	{
	}

	private function Clear()
	{
		$this->premium = false;
		$this->error = null;
		$this->username = null;
		$this->correct_username = null;
		$this->uuid = null;
		$this->raw=null;
	}

	public function Check($username, $password)
	{
		$this->Clear();
		$this->username = $username;

		$data = sprintf('{"agent": {"name": "' . self::game . '","version": ' . self::version . '},"username": "%s","password": "%s"}', $username, $password);
		$ch = curl_init(self::api);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		if (!($result = curl_exec($ch)))
		{
			$this->error = 'CURL ERROR: ' . curl_error($ch);
			return $this;
		}
		curl_close($ch);

		//deserializing json
		$json = json_decode($result, true);
		$this->raw=$json;

		//errors
		if (isset($json['errorMessage']))
		{
			$this->error = $json['errorMessage'];
			return $this;
		}

		//registered user but not premium
		if (array_key_exists("selectedProfile", $json) == false && $this->error == null)
		{
			$this->error = "Your account is not premium.";
			return $this;
		}
		else
		{
			//correct username
			$this->correct_username = isset($json['selectedProfile']['name'])?$json['selectedProfile']['name']:null;

			//user uuid
			$this->uuid = isset($json['selectedProfile']['id'])?$json['selectedProfile']['id']:null;

			//check premium
			if($this->uuid == null and $this->correct_username == null)
			{
				$this->error = "Your account is not premium.";
				$this->premium=false;
			}
			else
			{
				$this->premium=true;
			}
		}

		return $this;
	}

	public function Response()
	{
		return array(
			'premium' => $this->premium,
			'error' => $this->error,
			'username' => $this->username,
			'correct_username' => $this->correct_username,
			'uuid' => $this->uuid
		);
	}

	public function Raw()
	{
		return $this->raw;
	}
}

?>