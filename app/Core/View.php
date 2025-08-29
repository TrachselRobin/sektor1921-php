<?php

namespace App\Core;

abstract class View {
    public readonly array $body;

    /**
     * @param $body
     */
    final public function __construct($body) {
        $this->body = $body;
    }

    /**
     * @return string
     */
    abstract public function __toString();
}