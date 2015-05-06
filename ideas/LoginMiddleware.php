<?php

class LoginMiddleware extends \framework\Middleware  {

    function onUpdate(\framework\Request $request) {
        session_start();

    }

    function onGet(\framework\Request $request) {
        session_start();

        if (is_null($this->getApp()->getService("login")->currentUser())
            && $request->getResourceName() != 'main'
            && $request->getResourceName() != 'login'
            && $request->getResourceName() != 'about') {
            $target = urlencode("index.php?resourceName=" . $request->getResourceName());
            header("Location: index.php?resourceName=login&target=" .  $target, 301);
            die();
        }

    }

    function onDelete(\framework\Request $request) {
        session_start();

    }

    function onPost(\framework\Request $request) {
        session_start();

    }

    function handleResponse(\framework\Response $response) {
        $data = $response->getData();
        $data['user'] = $this->getApp()->getService('login')->currentUser();
        $response->setData($data);
        return $response;
    }

}