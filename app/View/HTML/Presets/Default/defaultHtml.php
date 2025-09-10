<?php

namespace App\View\HTML\Presets\Default;

use App\View\HTML\Elements\Html;
use App\View\HTML\HtmlPreset;

class defaultHtml extends HtmlPreset {
    public function __construct($params = []) {
        $html = new Html();
        $html->addAttribute('lang', 'de');

        self::append($html);
    }
}