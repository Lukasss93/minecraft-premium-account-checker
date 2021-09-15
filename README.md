# Minecraft Premium Account Checker

[![Latest Stable Version](https://poser.pugx.org/lukasss93/minecraft-premium-account-checker/v/stable)](https://packagist.org/packages/lukasss93/minecraft-premium-account-checker)
[![Total Downloads](https://poser.pugx.org/lukasss93/minecraft-premium-account-checker/downloads)](https://packagist.org/packages/lukasss93/minecraft-premium-account-checker)
[![License](https://poser.pugx.org/lukasss93/minecraft-premium-account-checker/license)](https://packagist.org/packages/lukasss93/minecraft-premium-account-checker)
![PHP](https://img.shields.io/badge/php-%3E%3D5.6-green.svg)

> This library can be used to check if an Minecraft account is premium.

### ⚠ This library doesn't work with a Microsoft Accounts ⚠

**⚠ Warning: making too many request in a short period of time, the webserver IP will be temporary banned (about 15min) from Mojang API.**

## Requirements
* PHP >= 5.6

## Installation
You can install this library with composer:

`composer require lukasss93/minecraft-premium-account-checker`

## Using
```php
<?php
    //using the class
    use MCPremium\MCPremium;

    //include composer autoload
    require_once('../vendor/autoload.php');

    //checking account
    $response=MCPremium::check('username','password');

    //get informations from object
    var_dump($response);

    //or from array
    var_dump($response->toArray());
?>
```

## Input
The `check()` method has 2 parameters:

| \#  | Parameter | Type   | Description                                             |
| --- | --------- | ------ | ------------------------------------------------------- |
| 1   | username  | string | Minecraft account username (or email if Mojang account) |
| 2   | password  | string | Minecraft account password                              |

## Output
The `check()` method returns an object with the following properties:

| Property         | Type    | Description                                                 |
| ---------------- | ------- | ----------------------------------------------------------- |
| premium          | bool    | Returns `true` if the account is premium, otherwise `false` |
| error            | string  | Returns an error message                                    |
| username         | string  | Returns the entered username                                |
| correct_username | string  | Returns the in-game username                                |
| uuid             | string  | Returns the account UUID                                    |
| created_at       | integer | Returns the creation timestamp account                      |
| raw              | array   | Returns the original response from the API                  |

_You can use the_ `toArray()` _method after_ `check()` _method to get the properties as an array._

**I assume no liability for any theft of Minecraft Accounts.**

## Changelog
All notable changes to this project will be documented [here](CHANGELOG.md).
