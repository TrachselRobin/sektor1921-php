<?php

namespace App\View\HTML\Elements;

use App\View\HTML\HtmlElement;

class Link extends HtmlElement {
    public function __toString(): string {
        $attributes = $this->getAttributesAsString();

        return '<' . self::getClassName() . $attributes . '>';
    }
}