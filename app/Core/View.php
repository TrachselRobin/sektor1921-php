<?php

namespace App\Core;

use App\View\HTML\Elements\Body;
use App\View\HTML\Presets\Head;
use App\View\HTML\Presets\Header;
use App\View\HTML\Presets\Main;
use App\View\HTML\Presets\Footer;

abstract class View {
    public readonly array $requestBody;
    public readonly Head $head;
    public readonly Body $body;
    public readonly Header $header;
    public readonly Main $main;
    public readonly Footer $footer;

    public function __construct(array $params) {
        $this->requestBody = $params;

        $this->head   = new Head();
        $this->body   = new Body();
        $this->header = new Header();
        $this->main   = new Main();
        $this->footer = new Footer();
    }

    final public function __toString(): string {
        return $this->render();
    }

    private function render(): string {
        $this->body->append([$this->header, $this->main, $this->footer]);
        return $this->head . $this->body;
    }
}
