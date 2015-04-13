<?php

namespace framework;

class App {
    private $services = array();
    private $handlers = array();

    private function registerHandler($path, $method, $handler) {
        $this->$handler[$path][$method] = $handler;
    }

    public function registerService($name, $service) {
        $this->services[$name] = $service;
    }

    public function getService($name) {
        return $this->services[$name];
    }

    public function start() {
        $request = new Request($_SERVER);

        if (array_key_exists())

        $handler = $this->defaultHandlerForMethod($request->method);
        $handler();
    }

    private function defaultHandlerForMethod($method) {
        switch ($method) {
            case 'GET': return $this->defaultGetHandler;
        }
    }

    private function defaultGetHandler($app, $templateCtx, $service, $id) {
        return $service->get($id);
    }

}