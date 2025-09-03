<?php

namespace App\View\HTML\Presets;

use App\View\HTML\HtmlPreset;

class Header extends HtmlPreset {
    public function __construct() {
        self::innerText('Default Header text');
    }
}