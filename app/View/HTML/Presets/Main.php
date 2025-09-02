<?php

namespace App\View\HTML\Presets;

use App\View\HTML\HtmlPreset;

class Main extends HtmlPreset {
    public function __construct() {
        self::innerText('Default Main text');
    }

    public function __toString(): string {
        return '<main>' . self::getContent() .'</main>';
    }
}