<?php

namespace App\View\HTML\Presets\Home;

use App\View\HTML\Elements\Div;
use App\View\HTML\Elements\H1;
use App\View\HTML\Elements\Section;
use App\View\HTML\Elements\Source;
use App\View\HTML\Elements\Video;
use App\View\HTML\HtmlPreset;

class WelcomeSection extends HtmlPreset {
    public function __construct($params = []) {
        $section = new Section();

        $source = new Source();
        $source->addAttribute('src', './video/Hockey_BackgroundVideo.mp4');
        $source->addAttribute('type', 'video/mp4');

        $video = new Video();
        $video->addAttribute('autoplay');
        $video->addAttribute('muted');
        $video->addAttribute('loop');

        $title = new H1();
        $title->innerText('Sektor 1921');

        $div = new Div();
        $div->append($title, $title, $title, $title, $title, $title, $title);

        $video->append($source);

        $section->addAttribute('id', 'homeWelcomeSection');
        $section->append($video, $div);

        self::append($section);
    }
}