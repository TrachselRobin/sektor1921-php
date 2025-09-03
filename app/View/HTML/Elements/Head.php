<?php

namespace App\View\HTML\Elements;

use App\View\HTML\HtmlElement;
use App\View\HTML\Presets\Stylesheet;

class Head extends HtmlElement {
    public function addStylesheet($path): void {
        $stylesheet = new Stylesheet();
        $stylesheet->setPath($path);

        self::append($stylesheet);
    }
}