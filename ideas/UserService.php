<?php

class UserService extends \framework\Service {

    function exists($username, $password) {
        return true;
    }

    function getUserAsArray($username) {
        return array(
            "id" => $username,
            "name" => "Jan Marker",
            "faculty" => "Applied Informatics"
        );
    }


}