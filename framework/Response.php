<?php
namespace framework;


class Response {
    private $templateName;
    private $data;
    private $headers = array();

    public function setTemplateName($templateName) {
        $this->templateName = $templateName;
    }

    public function getTemplateName() {
        return $this->templateName;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function addHeader($headerName, $value) {
        if ($headerName == 'Status') {
            $this->headers[] = "HTTP/1.0 $value";
        } else {
            $this->headers[] = "$headerName: $value";
        }
    }

    /**
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

}