<?php

namespace App\View\HTML\Elements;

use App\View\HTML\HtmlElement;

class Meta extends HtmlElement {
    public function render(): string {
        $attributes = $this->getAttributesAsString();

        return '<' . self::getClassName() . $attributes . '>';
    }
}