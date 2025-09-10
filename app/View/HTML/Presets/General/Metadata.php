<?php

namespace App\View\HTML\Presets\General;

use App\View\HTML\Elements\Meta;
use App\View\HTML\HtmlPreset;

class Metadata extends HtmlPreset {
    public function __construct($params = []) {
        $charset = new Meta();
        $charset->addAttribute('charset', 'utf-8');

        $viewport = new Meta();
        $viewport->addAttribute('viewport', 'width=device-width, initial-scale=1');

        self::append($charset, $viewport);
    }
}