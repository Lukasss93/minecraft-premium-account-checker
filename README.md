# Minecraft Premium Account Checker

> This library can be used to check if an Minecraft account is premium.

**Warning: making too many request in a short period of time, the webserver IP will be temporary banned (about 15min) from Mojang API.**

Requirements
------------
* PHP >= 5.6

Installation
---------

* #### Manual 
	Copy the `src` folder in your project, rename it and include all classes in your script.
* #### Composer
	`composer require lukasss93/minecraft-premium-account-checker`

#### Using
```php
<?php
	use MCPremium\MCPremium;
	$response=MCPremium::check('username','password');
?>
```

#### Input
The `check()` method has 2 parameters:

\# | Parameter | Type | Description
---|-----------|------|------------
1 | username | string | Minecraft account username (or email if Mojang account)
2 | password | string| Minecraft account password

#### Output
The `check()` method returns an object with the following properties:

Property|Type|Description
---|----|------------
premium|bool|Returns `true` if the account is premium, otherwise `false`
error|string|Returns an error message
username|string|Returns the entered username
correct_username|string|Returns the in-game username
uuid|string|Returns the account UUID
created_at|integer|Returns the creation timestamp account
raw|array|Returns the original response from the API

_You can use the_ `toArray()` _method after_ `check()` _method to get the properties as an array._

**I assume no liability for any theft of Minecraft Accounts.**
