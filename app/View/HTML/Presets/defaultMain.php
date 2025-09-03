<?php

namespace App\View\HTML\Presets;

use App\View\HTML\Elements\Main;
use App\View\HTML\HtmlPreset;

class defaultMain extends HtmlPreset {
    public function __construct() {
        $this->baseElement = new Main();
    }
}