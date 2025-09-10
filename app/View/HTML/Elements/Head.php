<?php

namespace App\View\HTML\Elements;

use App\View\HTML\HtmlElement;
use App\View\HTML\Presets\General\Stylesheet;

class Head extends HtmlElement {
    public function addStylesheet($path): void {
        $stylesheet = new Stylesheet(['path' => $path]);

        self::append($stylesheet);
    }

    public function addTitle($title): void {
        $titleElement = new Title();

        $titleElement->innerText($title);

        self::append($titleElement);
    }

    public function addViewport($content): void {
        $meta = new Meta();

        $meta->addAttribute('name', 'viewport');
        $meta->addAttribute('content', $content);

        self::append($meta);
    }

    public function addCharset($charset): void {
        $meta = new Meta();

        $meta->addAttribute('charset', $charset);

        self::append($meta);
    }
}