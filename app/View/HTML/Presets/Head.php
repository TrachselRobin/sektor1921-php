<?php

namespace App\View\HTML\Presets;

use App\View\HTML\HtmlPreset;

class Head extends HtmlPreset {
    public function __construct() {
        self::innerText('Default Head text');
    }
}