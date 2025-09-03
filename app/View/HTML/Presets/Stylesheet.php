<?php

namespace App\View\HTML\Presets;

use App\View\HTML\Elements\Link;
use App\View\HTML\HtmlPreset;

class Stylesheet extends HtmlPreset {
    public function __construct() {
        $this->baseElement = new Link();
        $this->baseElement->addAttribute('rel', 'stylesheet');
        $this->baseElement->addAttribute('type', 'text/css');
    }

    public function setPath($path) {
        $this->baseElement->addAttribute('href', $path);
    }
}