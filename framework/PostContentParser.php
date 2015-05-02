<?php
namespace framework;


class PostContentParser {
    public function __construct($unused) {
    }

    public function parse() {
        return $_POST;
    }

}