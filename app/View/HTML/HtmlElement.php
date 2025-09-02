<?php

namespace App\View\HTML;

abstract class HtmlElement {
    public array $content = [];

    abstract public function __toString(): string;

    public function getContent(): string {
        return implode('', $this->content);
    }

    public function append($content): void {
        if (count($this->content) === 1 && is_string($this->content[0])) {
            $this->content = [];
        }

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