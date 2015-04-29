<?php
namespace framework;

use PDO;

class Service {
    private $pdo;

    function __construct() {
        $this->pdo = new PDO('', "", "", array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ));
    }

    function db() {
        return $this->pdo;
    }

    function create($data) {
    }

    function get($data) {
        return array(0=>"hallo");
    }

    function update($data) {
    }

    function delete($data) {
    }
}