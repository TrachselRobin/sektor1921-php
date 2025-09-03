<?php

namespace App\View\HTML\Presets;

use App\View\HTML\Elements\Header;
use App\View\HTML\HtmlPreset;

class defaultHeader extends HtmlPreset {
    public function __construct() {
        $this->baseElement = new Header();
    }
}