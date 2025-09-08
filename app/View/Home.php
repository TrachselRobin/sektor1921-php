<?php

namespace App\View;

use App\Core\View;
use App\View\HTML\Elements\Body;

class Home extends View {
    public function createBody(): Body {
        $body = new Body();

        $body->innerText('Home');

        return $body;
    }
}
