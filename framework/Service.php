<?php
namespace framework;

use PDO;

class Service {
    private $pdo;
    /**
     * @var \framework\App
     */
    private $app;

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
        return array('msg'=>"hallo");
    }

    function update($data) {
    }

    function delete($data) {
    }

    /**
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param App $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }
}