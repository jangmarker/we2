<?php

namespace framework;

class JsonTemplate extends Template {

    public function __construct($templateDir, $templateName) {
        parent::__construct($templateDir, $templateName, '.json.inc.php');
    }

}