<?php

namespace framework;


class HtmlTemplate extends Template {

    public function __construct($templateDir, $templateName) {
        parent::__construct($templateDir, $templateName, '.html.inc.php');
    }

}