<?php

namespace App\Core;

use App\View\HTML\Elements\Body;
use App\View\HTML\Elements\Head;
use App\View\HTML\Elements\Html;

class View {
    public array $requestBody;
    public Html $html;
    public Head $head;
    public Body $body;

    public function __construct(array $params) {
        $this->requestBody = $params;

        $this->html = $this->createHtml();
        $this->head = $this->createHead();
        $this->body = $this->createBody();
    }

    final public function __toString(): string {
        return $this->render();
    }

    private function render(): string {
        $this->html->append($this->head, $this->body);
        return '<!DOCTYPE html>' . $this->html;
    }

    public function createHtml(): Html {
        $html = new Html();

        $html->addAttribute('lang', 'de');

        return $html;
    }

    public function createHead(): Head {
        $head = new Head();

        $head->addViewport('width=device-width, initial-scale=1.0');
        $head->addCharset('utf-8');
        $head->addStylesheet('./css/general.css');
        $head->addTitle('Sektor 1921 | Startseite');

        return $head;
    }

    public function createBody(): Body {
        $body = new Body();

        $body->innerText('Body');

        return $body;
    }
}
