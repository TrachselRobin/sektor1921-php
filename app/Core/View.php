<?php

namespace App\Core;

abstract class View
{
    public readonly array $body;

    final public function __construct(array $body) {
        $this->body = $body;
    }

    final public function __toString(): string {
        return $this->render();
    }

    abstract protected function render(): string;
}
