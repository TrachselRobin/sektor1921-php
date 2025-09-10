<?php

namespace App\View\HTML\Presets\Default;

use App\View\HTML\Elements\Header;
use App\View\HTML\HtmlPreset;

class defaultHeader extends HtmlPreset {
    public function __construct($params = []) {
        $header = new Header();

        self::append($header);
    }
}