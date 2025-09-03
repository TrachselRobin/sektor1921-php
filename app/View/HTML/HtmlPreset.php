<?php

namespace App\View\HTML;

abstract class HtmlPreset extends HtmlElement {
    abstract public function __construct($params = []);

    public function __toString(): string {
        return self::getContent();
    }
}