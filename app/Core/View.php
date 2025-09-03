<?php

namespace App\Core;

use App\View\HTML\Elements\Body;
use App\View\HTML\Presets\defaultHead;
use App\View\HTML\Presets\defaultHeader;
use App\View\HTML\Presets\defaultMain;
use App\View\HTML\Presets\defaultFooter;

abstract class View {
    public readonly array $requestBody;
    public readonly defaultHead $head;
    public readonly Body $body;
    public readonly defaultHeader $header;
    public readonly defaultMain $main;
    public readonly defaultFooter $footer;

    public function __construct(array $params) {
        $this->requestBody = $params;

        $this->head   = new defaultHead();
        $this->body   = new Body();
        $this->header = new defaultHeader();
        $this->main   = new defaultMain();
        $this->footer = new defaultFooter();
    }

    final public function __toString(): string {
        return $this->render();
    }

    private function render(): string {
        $this->body->append([$this->header, $this->main, $this->footer]);
        return $this->head . $this->body;
    }
}
