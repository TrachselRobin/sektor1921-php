<?php

namespace App\View\HTML\Presets\Default;

use App\View\HTML\Elements\Footer;
use App\View\HTML\HtmlPreset;

class defaultFooter extends HtmlPreset {
    public function __construct($params = []) {
        $footer = new Footer();
        $footer->innerText('Hi from footer');

        self::append($footer);
    }
}