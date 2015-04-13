<?php
namespace framework;


class JSONContentParser {
    private $json;

    public function __construct($json) {
        $this->json = $json;
    }

    public function parse() {
        $object = json_decode($this->json, true);
        $lastError = json_last_error();
        if ($lastError != JSON_ERROR_NONE) {
            throw new \Exception(json_last_error_msg());
        }
        return $object;
    }

}