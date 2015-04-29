<?php

namespace framework;


class HtmlTemplate {
    private $templateName;
    private $templatePostfix = ".inc.php";
    private $innerTemplate;
    private $templateDir;

    public function __construct($templateDir, $templateName, HtmlTemplate $innerTemplate = null) {
        $this->templateDir = $templateDir;
        $this->templateName = $templateName;
        $this->failIfTemplateDoesNotExist();
        $this->innerTemplate = $innerTemplate;
    }

    public function process($data) {
        $innerTemplate = $this->innerTemplate;
        ob_start();
        require($this->templateFilePath());
        $output = ob_get_clean();
        return $output;
    }

    private function templateFilePath() {
        return "$this->templateDir/$this->templateName$this->templatePostfix";
    }

    private function failIfTemplateDoesNotExist() {
        if (!file_exists($this->templateFilePath())) {
            throw new \InvalidArgumentException("could not find " . $this->templateFilePath());
        }
    }

}