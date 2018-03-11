<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/config.php';

$core = new Extr\Core\Core;
