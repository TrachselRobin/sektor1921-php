<?php

namespace App\View;

use App\Core\View;

class Home extends View {
    public function __toString(): string {
        return json_encode($this->body);
    }
}