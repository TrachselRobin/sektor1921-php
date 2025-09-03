<?php

namespace App\View\HTML;

abstract class HtmlPreset extends HtmlElement {
    public array $content = [];

    abstract public function __construct();
}