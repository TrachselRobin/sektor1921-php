<?php

namespace App\View\HTML\Presets\Home;

use App\View\HTML\Elements\Section;
use App\View\HTML\Elements\Source;
use App\View\HTML\Elements\Video;
use App\View\HTML\HtmlPreset;

class WelcomeSection extends HtmlPreset {
    public function __construct($params = []) {
        $section = new Section();
        $video = new Video();
        $source = new Source();

        $source->addAttribute('src', './video/Hockey_BackgroundVideo.mp4');
        $source->addAttribute('type', 'video/mp4');

        $video->addAttribute('autoplay');
        $video->addAttribute('muted');
        $video->addAttribute('loop');

        $video->append($source);

        $section->addAttribute('id', 'homeWelcomeSection');
        $section->append($video);

        self::append($section);
    }
}