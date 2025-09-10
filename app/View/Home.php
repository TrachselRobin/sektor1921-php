<?php

namespace App\View;

use App\Core\View;
use App\View\HTML\Elements\Body;
use App\View\HTML\Presets\Home\WelcomeSection;

class Home extends View {
    public function createBody(): Body {
        $body = new Body();

        $welcomeSection = new WelcomeSection();

        $body->append($welcomeSection);

        return $body;
    }
}
