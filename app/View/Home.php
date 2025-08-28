<?php

namespace App\View;

class Home {
    private string $test;

    public function __construct() {
        $this->test = "Hi from the View";
    }

    public function __toString(): string {
        return $this->test;
    }
}