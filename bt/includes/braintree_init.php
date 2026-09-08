<?php
session_start();
require_once("lib/autoload.php");

if(file_exists(__DIR__ . "/.env")) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
    $dotenv->load();
}

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('h37htrb89y3cpgbf');
Braintree_Configuration::publicKey('j3kg2rtdydwmrmwm');
Braintree_Configuration::privateKey('45986f5ab121176d32b2c99840c6e118');
