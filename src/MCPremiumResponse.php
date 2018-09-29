<?php

namespace MCPremium;

/**
 * Response class used by MCPremium class
 * Class MCPremiumResponse
 * @package MCPremium
 */
class MCPremiumResponse {
	
	/** @var bool $premium Returns true if the account is premium, otherwise false. */
	public $premium = false;
	
	/** @var string Error message. */
	public $error = null;
	
	/** @var string $username Entered username. */
	public $username = null;
	
	/** @var string Correct username if the account is migrated. */
	public $correct_username = null;
	
	/** @var string Universally unique identifier of the account. */
	public $uuid = null;
	
	/** @var int $created_at Creation timestamp account */
	public $created_at=null;
	
	/** @var array $raw Json response from API */
	public $raw = null;
	
	/**
	 * Returns all class properties as an array.
	 * @return array
	 */
	public function toArray() {
		$properties = get_object_vars($this);
		unset($properties['raw']);
		return $properties;
	}
	
}
