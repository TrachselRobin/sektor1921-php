<?php

namespace App\View\HTML\Presets\Home;

use App\View\HTML\Elements\Section;
use App\View\HTML\HtmlPreset;

class WelcomeSection extends HtmlPreset {
    public function __construct($params = []) {
        $section = new Section();

        $section->addAttribute('id', 'homeWelcomeSection');
        $section->innerText('Hi, I am in a Section');

        self::append($section);
    }
}