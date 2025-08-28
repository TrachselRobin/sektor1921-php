<?php

namespace Router;

use App\Core\Router;
use App\View\Home;

class Routes {
    /**
     * @param Router $router
     * @return void
     */
    public static function loadRoutes(Router $router): void {
        $router->get('/', [Home::class, 'index']);
    }
}