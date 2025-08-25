<?php
require __DIR__ . '/../vendor/autoload.php';

use Config\Env;

Env::load(__DIR__ . '/../config', false);

$dbHost = Env::get('DB_HOST', 'localhost');
$debug  = Env::get('APP_DEBUG', false, 'bool');

Env::required(['DB_HOST']);

Env::set('RUNTIME_FLAG', true);

// Env::set('APP_NAMDFFE', 'Sektor1921', true);

echo 'ok';
