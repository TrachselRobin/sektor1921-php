<?php

namespace App\View\HTML\Presets;

use App\View\HTML\Elements\Link;
use App\View\HTML\HtmlPreset;

class Stylesheet extends HtmlPreset {
    public function __construct($params = []) {
        $path = $params['path'] ?? '';
        $link = new Link();
        $link->addAttribute('rel', 'stylesheet');
        $link->addAttribute('type', 'text/css');
        $link->addAttribute('href', $path);

        self::append($link);
    }
}