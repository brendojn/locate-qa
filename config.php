<?php

require 'environment.php';

$config = array();

if (ENVIRONMENT == 'development') {
    define("BASE_URL", "http://127.0.0.1/goals/");
    $config['dbname'] = 'goals';
    $config['host'] = '127.0.0.1';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '123456';
} else {
    define("BASE_URL", "http://goals.plataforma13.com.br/");
    $config['dbname'] = 'goals';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'vfTH&WY6tj69CW';
}

global $db;

try {
    $db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
    echo "ERRO: " . $e->getMessage();
}