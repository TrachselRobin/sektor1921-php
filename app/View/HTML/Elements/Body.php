<?php

namespace App\View\HTML\Elements;

use App\View\HTML\HtmlElement;

class Body extends HtmlElement {
    public function __toString(): string {
        return '<body>' . parent::getContent() . '</body>';
    }
}