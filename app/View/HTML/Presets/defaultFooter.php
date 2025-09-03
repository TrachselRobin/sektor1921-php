<?php

namespace App\View\HTML\Presets;

use App\View\HTML\Elements\Footer;
use App\View\HTML\HtmlPreset;

class defaultFooter extends HtmlPreset {
    public function __construct() {
        $this->baseElement = new Footer();
    }
}