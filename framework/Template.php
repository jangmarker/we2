<?php

namespace framework;

abstract class Template {
    private $templateName;
    private $templatePostfix;
    private $templateDir;

    public function __construct($templateDir, $templateName, $templatePostfix) {
        $this->templateDir = $templateDir;
        $this->templateName = $templateName;
        $this->templatePostfix = $templatePostfix;
        $this->failIfTemplateDoesNotExist();
    }

    static public function create($mimeType, $templateDir, $templateName) {
        $mimeType = preg_replace("/;.*/", "", $mimeType);

        switch ($mimeType) {
            case 'text/html':
                return new HtmlTemplate($templateDir, $templateName);
            case 'text/json':
                return new JsonTemplate($templateDir, $templateName);
            default:
                throw new \InvalidArgumentException("Fatal: Could not find content parser for $mimeType");
        }
    }



    protected function templateFilePath() {
        return "$this->templateDir/$this->templateName$this->templatePostfix";
    }

    protected function failIfTemplateDoesNotExist() {
        if (!file_exists($this->templateFilePath())) {
            throw new \InvalidArgumentException("could not find " . $this->templateFilePath());
        }
    }

    public function process($data) {
        ob_start();
        require($this->templateFilePath());
        $output = ob_get_clean();
        return $output;
    }

}