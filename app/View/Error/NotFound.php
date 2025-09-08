<?php

namespace App\View\Error;

use App\Core\View;
use App\View\HTML\Elements\Body;

class NotFound extends View {
    public function createBody(): Body {
        $body = new Body();

        $body->innerText('Not Found');

        return $body;
    }
}