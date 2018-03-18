<?php

require __DIR__ . '/environment.php';

global $config;
$config = array();

if (ENVIRONMENT == 'development') 
{
    define("BASE", "http://localhost:8000/");
    $config['dbname'] = 'extr';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'root';
    $config['useTwigCache'] = false;
} 
else 
{
    define("BASE", "https://seudominio/");
    $config['dbname'] = 'dbname';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'user';
    $config['dbpass'] = 'password';
    $config['useTwigCache'] = true;
}
