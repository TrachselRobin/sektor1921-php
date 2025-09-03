<?php

namespace App\View\HTML;

class HtmlElement {
    private array $content = [];
    private array $attributes = [];

    /**
     * @return string
     */
    public function __toString(): string {
        $attributes = $this->getAttributesAsString();

        return '<' . $this->getClassName() . $attributes . '>' . $this->getContent() . '</' . $this->getClassName() . '>';
    }

    /**
     * @return string
     */
    public function getClassName(): string {
        $reflectionClass = new \ReflectionClass($this);
        return strtolower($reflectionClass->getShortName());
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return implode('', $this->content);
    }

    /**
     * @param ...$contents
     *
     * @return void
     */
    public function append(...$contents): void {
        if (count($this->content) === 1 && is_string($this->content[0])) {
            $this->content = [];
        }

        foreach ($contents as $content) {
            if (is_array($content)) {
                foreach ($content as $item) {
                    $this->content[] = $item;
                }
            } else {
                $this->content[] = $content;
            }
        }
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function innerText(string $value): void {
        $this->content = [$value];
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function addAttribute(string $name, string $value): void {
        if (!isset($this->attributes[$name])) {
            $this->attributes[$name] = [];
        }
        if (!in_array($value, $this->attributes[$name], true)) {
            $this->attributes[$name][] = $value;
        }
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function removeAttributeValue(string $name, string $value): void {
        if (isset($this->attributes[$name])) {
            $this->attributes[$name] = array_values(
                array_filter($this->attributes[$name], fn($v) => $v !== $value)
            );
        }
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function clearAttribute(string $name): void {
        $this->attributes[$name] = [];
    }

    /**
     * @return array
     */
    public function getAttributes(): array {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function getAttributesAsString(): string {
        $parts = [];
        foreach ($this->attributes as $name => $values) {
            if (!empty($values)) {
                $parts[] = $name . '="' . htmlspecialchars(implode(' ', $values)) . '"';
            }
        }
        return $parts ? ' ' . implode(' ', $parts) : '';
    }
}
