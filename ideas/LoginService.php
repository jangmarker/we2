<?php

class LoginService extends \framework\Service {

    function currentUser() {
        if (array_key_exists('user', $_SESSION)) {
            return $this->getApp()->getService('user')->getUserAsArray($this->currentUserId());
        } else {
            return null;
        }
    }

    function currentUserId() {
        if (array_key_exists('user', $_SESSION)) {
            return $_SESSION['user']['id'];
        } else {
            return null;
        }
    }

    function get($data) {
        $result = array();
        if (array_key_exists('target', $_GET)) {
            $result['target'] = urldecode($_GET['target']);
        } else {
            $result['target'] = "";
        }

        if (!is_null($this->currentUserId())) {
            $result['msg'] = "You are logged in as " . $this->currentUserId();
        } else {
            $result['msg'] = "Please enter your credentials to log in";
        }

        return $result;
    }

    function create($data) {
        $result = array();
        $username = $data['username'];
        $password = $data['password'];
        $target = array_key_exists('target', $data)?$data['target']:'';

        if ($this->getApp()->getService('user')->exists($username, $password)) {
            $_SESSION['user'] = array('id' => $username);
            header('Location: ' . $target, 301);
        } else {
            $result['error'] = "Could not find user '" . $username . "' with the specified password.";
            $result['target'] = $target;
        }
        return $result;
    }

    function remove() {
        session_destroy();
        $_SESSION = null;
    }

}