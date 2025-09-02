<?php

namespace App\View\HTML;

abstract class HtmlElement {
    public array $content = [];

    abstract public function __toString(): string;

    public function getContent(): string {
        return implode('', $this->content);
    }

    public function append($content): void {
        if (is_array($content)) {
            foreach ($content as $item) {
                $this->content[] = $item;
            }
        } else {
            $this->content[] = $content;
        }
    }

    public function innerText($value): void {
        $this->content = [$value];
    }
}