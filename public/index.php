<?php

require __DIR__ . '/../vendor/autoload.php';

use Config\Env;
use Router\Api;
use Router\Routes;

Env::load(__DIR__ . '/../config', false);
Env::required(['DB_HOST']);

$app    = new Api();
$router = $app->router();

// Routen registrieren
Routes::loadRoutes($router);

// Pfad aus .htaccess holen (Fallback: REQUEST_URI)
$raw    = $_GET['uri'] ?? $_SERVER['REQUEST_URI'] ?? '/';
$path   = parse_url($raw, PHP_URL_PATH) ?? '/';

// App ausführen
$app->run($path);
