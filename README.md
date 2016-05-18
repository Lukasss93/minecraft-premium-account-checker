# PHP Minecraft Premium Account Checker

This library can be used to check if an Minecraft account is premium.

**Warning: making too many request in a short period of time, the webserver IP will be banned (about 15min) from Mojang API.**

#### Using
```php
<?php
	require 'MCPremium.php';	
	
	$status = new MCPremium();
	print_r( $status->Check( 'username', 'password' )->Response() );	
?>
```

#### Input
The `Check()` method has 2 parameters:

\# | Parameter | Type | Description
---|-----------|------|------------
1 | username | string | Minecraft account username (or email if Mojang account)
2 | password | string| Minecraft account password

#### Output
The `Response()` method return an array with the following keys:

Key|Type|Description
---|----|------------
premium|bool|Returns `true` if the account is premium else `false`
error|string|Returns any error message
username|string|Returns the entered username
correct_username|string|Returns the in-game username
uuid|string|Returns the account UUID

**I assume no liability for any theft of Minecraft Accounts.**