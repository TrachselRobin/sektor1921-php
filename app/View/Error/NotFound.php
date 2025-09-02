<?php

namespace App\View\Error;

use App\Core\View;
use App\View\HTML\Elements\Div;

class NotFound extends View {
    public function __construct(array $body = []) {
        parent::__construct($body);

        $div = new Div;
        $div->innerText('test');

        $this->main->append($div);
    }
}