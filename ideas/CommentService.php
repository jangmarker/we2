<?php

class CommentService extends \framework\Service {

    function get($unused) {

        return array();
    }

    function create($data) {
        $username = $this->getApp()->getService('login')->currentUserId();

        $db = $this->db();
        $stm = $db->prepare(
            "INSERT INTO
              comments(username, comment, idea_id)
             VALUES
              (:username, :comment, :idea_id)"
        );
        $stm->bindValue(':username', $username);
        $stm->bindValue(':comment', $data['comment']);
        $stm->bindValue(':idea_id', $data['ideaId']);
        $stm->execute();

        return array('success' => 'true');
    }

}