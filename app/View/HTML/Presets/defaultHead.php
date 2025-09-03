<?php

namespace App\View\HTML\Presets;

use App\View\HTML\Elements\Head;
use App\View\HTML\HtmlPreset;

class defaultHead extends HtmlPreset {
    public function __construct($params = []) {
        $head = new Head();
        $head->addStylesheet("./css/general.css");

        self::append($head);
    }
}
