<?php

namespace App\View;

use App\Core\View;
use App\View\HTML\Elements\Body;
use App\View\HTML\Elements\Head;
use App\View\HTML\Presets\Home\WelcomeSection;

class Home extends View {
    public function createHead(): Head {
        $head = new Head();

        $head->addViewport('width=device-width, initial-scale=1.0');
        $head->addCharset('utf-8');
        $head->addStylesheet('./css/general.css');
        $head->addStylesheet('./css/Home/welcomeSection.css');
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
