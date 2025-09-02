<?php

namespace App\View\HTML\Elements;

use App\View\HTML\HtmlElement;

class Div extends HtmlElement {
    public function __toString(): string {
        return '<div>' . self::getContent() . '</div>';
    }
}