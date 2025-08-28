<?php

namespace App\Core;

class Router {
    private array $routes = [];
    private array $before = [];
    // private Response $response;

    public function __construct() {
        $this->get('/', []);
    }

    public function get(string $path, $callback): void {
        $this->addRoute('GET', $path, $callback);
    }

    public function post(string $path, $callback): void {
        $this->addRoute('POST', $path, $callback);
    }

    public function put(string $path, $callback): void {
        $this->addRoute('PUT', $path, $callback);
    }

    public function delete(string $path, $callback): void {
        $this->addRoute('DELETE', $path, $callback);
    }

    private function addRoute(string $method, string $path, $callback): void {
        $this->routes[$method][$path] = $callback;
    }

    public function before(string $prefix, callable $fn): void {
        $this->before[] = [$prefix, $fn];
    }

    public function dispatch($handler, array $params = []): void
    {
        if (is_callable($handler)) {
            $result = $handler(...$params);
            if ($result !== null) {
                echo (is_scalar($result) || (is_object($result) && method_exists($result, '__toString')))
                    ? (string)$result
                    : '';
            }
            return;
        }

        if (is_string($handler)) {
            if (strpos($handler, '@') !== false) {
                [$class, $method] = explode('@', $handler, 2);

                if (class_exists($class)) {
                    $obj = new $class();

                    if (method_exists($obj, $method)) {
                        $result = $obj->{$method}(...$params);

                        if (is_scalar($result)) {
                            echo (string) $result;
                        } elseif (is_object($result) && method_exists($result, '__toString')) {
                            echo (string) $result;
                        }
                    }
                }
                return;
            }

            // Form nur "Klasse"
            $class = $handler;
            if (class_exists($class)) {
                // Instanz erzeugen (Konstruktor läuft)
                $obj = new $class();

                // Falls __toString() existiert -> direkt ausgeben
                if (method_exists($obj, '__toString')) {
                    echo (string)$obj;
                    return;
                }
            }
            return;
        }
    }
}