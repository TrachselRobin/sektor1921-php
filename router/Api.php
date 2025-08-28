<?php

namespace Router;

use App\Core\Router;

class Api {
    protected Router $router;

    public function __construct() {
        $this->router = new Router();
    }

    public function router(): Router {
        return $this->router;
    }

    public function run(string $uri): void {
        $this->router->dispatch($uri);
    }
}