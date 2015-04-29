<?php
namespace framework;


class Response {
    private $templateName;
    private $data;
    private $returnCode;

    public function getReturnCode()
    {
        return $this->returnCode;
    }

    public function setReturnCode($returnCode)
    {
        $this->returnCode = $returnCode;
    }

    function setTemplateName($templateName) {
        $this->templateName = $templateName;
    }

    function getTemplateName() {
        return $this->templateName;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getData() {
        return $this->data;
    }

}