<?php

namespace App\Core;

use App\View\Error\NotFound;
use ReflectionClass;
use ReflectionException;

class App {
    private string $classname;
    private array $params;

    private string $NOT_FOUND = '404 - Seite nicht gefunden!';

    /**
     * @param string $classname Vollqualifizierter Klassenname (z.B. App\View\Home)
     * @param array  $params    Parameter für den Konstruktor
     */
    public function __construct(string $classname, array $params = []) {
        $this->classname = 'App\\View' . str_replace('/', '\\', $classname);
        $this->params    = $params;

        $notFound = new NotFound($params);

        $this->NOT_FOUND = (string) $notFound;
    }

    /**
     * @throws ReflectionException
     */
    public function run(): void {
        if ($this->classname === 'App\\View\\') {
            $this->classname .= 'Home';
        }

        if (!class_exists($this->classname)) {
            echo $this->NOT_FOUND;
            return;
        }

        $refClass = new ReflectionClass($this->classname);
        $obj = $refClass->newInstanceArgs([$this->params]);

        if (method_exists($obj, '__toString')) {
            echo $obj;
            return;
        }

        echo $this->NOT_FOUND;
    }
}
