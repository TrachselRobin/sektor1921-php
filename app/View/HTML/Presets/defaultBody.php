<?php

namespace App\View\HTML\Presets;

use App\View\HTML\HtmlPreset;

class defaultBody extends HtmlPreset {
    public function __construct($params = []) {
        $header = new defaultHeader();
        $main = new DefaultMain();
        $footer = new DefaultFooter();

        self::append($header, $main, $footer);
    }
}