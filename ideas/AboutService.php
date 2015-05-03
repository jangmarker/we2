<?php

class AboutService extends \framework\Service {

    function create($data) {
        $email_address = htmlspecialchars($data['contact-email']);
        return array('msg' => "Thanks for your message, we will send an answer to '$email_address' shortly.");
    }

    function get($data) {
        return array();
    }

}