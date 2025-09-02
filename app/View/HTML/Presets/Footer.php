<?php

namespace App\View\HTML\Presets;

use App\View\HTML\HtmlPreset;

class Footer extends HtmlPreset {
    public function __construct() {
        self::innerText('Default Footer text');
    }

    public function __toString(): string {
        return '<footer>' . self::getContent() .'</footer>';
    }
}