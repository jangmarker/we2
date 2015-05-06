<?php
namespace framework;


class Response {
    private $templateName;
    private $data;
    private $headers = array();
    private $acceptedMimeType = "text/html";

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

    public function setAcceptedMimeType($mimeType) {
        $this->addHeader("Content-Type", $mimeType);
        $this->acceptedMimeType = $mimeType;
    }

    public function getAccepted() {
        return $this->acceptedMimeType;
    }

    /**
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

}