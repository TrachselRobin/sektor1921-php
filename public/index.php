<?php

require __DIR__ . '/../vendor/autoload.php';

use Config\Env;
use App\Core\App;

Env::load(__DIR__ . '/../config');
Env::required(['DB_HOST']);

$raw    = $_GET['uri'] ?? $_SERVER['REQUEST_URI'] ?? '/';
$path   = parse_url($raw, PHP_URL_PATH) ?? '/';

$body = [
    'uri' => $path
];

$app = new App($path, $body);
$app->run();
