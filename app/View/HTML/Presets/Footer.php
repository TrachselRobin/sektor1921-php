<?php

namespace App\View\HTML\Presets;

use App\View\HTML\HtmlPreset;

class Footer extends HtmlPreset {
    public function __construct() {
        self::innerText('Default Footer text');
    }
}