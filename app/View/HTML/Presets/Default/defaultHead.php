<?php

namespace App\View\HTML\Presets\Default;

use App\View\HTML\Elements\Head;
use App\View\HTML\Elements\Title;
use App\View\HTML\HtmlPreset;
use App\View\HTML\Presets\General\Metadata;

class defaultHead extends HtmlPreset {
    public function __construct($params = []) {
        $head = new Head();
        $head->addStylesheet("./css/general.css");

        $meta = new Metadata;

        $title = new Title();
        $title->innerText('Sektor1921 | Standardseite');

        self::append($meta, $head, $title);
    }
}
