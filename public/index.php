<?php
require __DIR__ . '/../vendor/autoload.php';

use Config\Env;

Env::load(__DIR__ . '/../config', false);

$dbHost = Env::get('DB_HOST', 'localhost');
$debug  = Env::get('APP_DEBUG', false, 'bool');

Env::required(['DB_HOST']); // wirft Exception, wenn fehlt

// Update nur prozessweit:
Env::set('RUNTIME_FLAG', true);

// Update und in .env persistieren:
Env::set('APP_NAME', 'Sektor1921', true);

echo 'OK';
