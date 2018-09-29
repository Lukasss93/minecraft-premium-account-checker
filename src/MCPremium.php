<?php

namespace MCPremium;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

/**
 * PHP class to check if a Minecraft account is Premium
 * Class MCPremium
 * @package MCPremium
 */
class MCPremium {
	private static $game = "Minecraft";
	private static $version = 12;
	private static $api = "https://authserver.mojang.com/authenticate";
	
	private function __construct() {}
	
	/**
	 * Check if an account is premium
	 * @param $username
	 * @param $password
	 * @return \MCPremium\MCPremiumResponse
	 */
	public static function check($username, $password) {
		
		//build parameters
		$parameters = [
			'agent'    => [
				'name'    => self::$game,
				'version' => self::$version
			],
			'username' => (string)$username,
			'password' => (string)$password
		];
		
		//initialize client
		$client = new Client();
		$response = new Response();
		
		//initialize output
		$data = null;
		
		try {
			//send request
			$response = $client->post(self::$api, [
				'json' => $parameters
			]);
		}
		catch(ClientException $e) {
			if($e->hasResponse()) {
				$response = $e->getResponse();
			}
		}
		
		//get content
		$content = $response->getBody()->getContents();
		
		//decode json content
		$json = \GuzzleHttp\json_decode($content, true);
		
		//initialize mcpremium response class
		$output = new MCPremiumResponse();
		
		//set original content to raw property
		$output->raw = $json;
		
		//get values
		if(array_key_exists('errorMessage', $json)) {
			$output->error = $json['errorMessage'];
		}
		else if(!array_key_exists('selectedProfile', $json)) {
			$output->error = "Your account is not premium.";
		}
		else {
			$selectedProfile = $json['selectedProfile'];
			
			//username
			$output->username=$username;
			
			//correct_username
			$output->correct_username = array_key_exists('name', $selectedProfile) ? $selectedProfile['name'] : null;
			
			//uuid
			$output->uuid = array_key_exists('id', $selectedProfile) ? $selectedProfile['id'] : null;
			
			//created_at
			$output->created_at= array_key_exists('createdAt', $selectedProfile) ? $selectedProfile['createdAt'] : null;
			
			//check premium
			if($output->uuid == null && $output->correct_username == null) {
				$output->error = "Your account is not premium.";
				$output->premium = false;
			}
			else {
				$output->premium = true;
			}
		}
		
		return $output;
	}
}
