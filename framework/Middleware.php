<?php
namespace framework;


abstract class Middleware {
    private $app;



    abstract function onGet(Request $request);
    abstract function onPost(Request $request);
    abstract function onDelete(Request $request);
    abstract function onUpdate(Request $request);
    abstract function handleResponse(Response $response);

    /**
     * @return \framework\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param \framework\App
     */
    public function setApp($app)
    {
        $this->app = $app;
    }
}