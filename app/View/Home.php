<?php
namespace App\View;

use App\Core\View;

class Home extends View {
    protected function render(): string     {
        $title = htmlspecialchars($this->body['title'] ?? 'Home');
        var_dump($this->body);
        return "<h1>$title</h1>";
    }
}
