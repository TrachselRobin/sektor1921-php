<?php

namespace App\View;

use App\Core\View;
use App\View\HTML\Elements\Body;
use App\View\HTML\Elements\Head;
use App\View\HTML\Elements\Link;
use App\View\HTML\Presets\General\Stylesheet;
use App\View\HTML\Presets\Home\WelcomeSection;

class Home extends View {
    public function createHead(): Head {
        $head = new Head();

        $head->addViewport('width=device-width, initial-scale=1.0');
        $head->addCharset('utf-8');
        $head->addStylesheet('./css/general.css');
        $head->addStylesheet('./css/Home/welcomeSection.css');

        $googleFontStylesheetPreconnect = new Link();
        $googleFontStylesheetPreconnect->addAttribute('rel', 'preconnect');
        $googleFontStylesheetPreconnect->addAttribute('href', 'https://fonts.googleapis.com');

        $googleFontStylesheetCrossOrigin = new Link();
        $googleFontStylesheetCrossOrigin->addAttribute('rel', 'preconnect');
        $googleFontStylesheetCrossOrigin->addAttribute('href', 'https://fonts.gstatic.com');
        $googleFontStylesheetCrossOrigin->addAttribute('crossorigin');

        $googleFontStylesheet = new Link();
        $googleFontStylesheet->addAttribute('rel', 'stylesheet');
        $googleFontStylesheet->addAttribute('href', 'https://fonts.googleapis.com/css2?family=Audiowide&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

        $head->append($googleFontStylesheetPreconnect, $googleFontStylesheetCrossOrigin, $googleFontStylesheet);

        $head->addTitle('Sektor 1921 | Startseite');

        return $head;
    }

    public function createBody(): Body {
        $body = new Body();

        $welcomeSection = new WelcomeSection();

        $body->append($welcomeSection);

        return $body;
    }
}
