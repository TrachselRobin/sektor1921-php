<?php

namespace App\View\HTML;

abstract class HtmlPreset extends HtmlElement {
    public HtmlElement $baseElement;

    public function __toString(): string {
        return $this->baseElement;
    }

    abstract public function __construct();
}