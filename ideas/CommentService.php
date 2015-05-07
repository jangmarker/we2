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

        $newCommentId = $db->lastInsertId();

        $this->extractAndInsertIdeaReferences($newCommentId, $data['comment']);
        $this->extractAndInsertAspects($newCommentId, $data['comment']);

        return array('success' => 'true');
    }

    private function extractAndInsertIdeaReferences($newCommentId, $comment) {
        $matches = array();
        if (preg_match_all("/idea ([0-9]+)/", $comment, $matches)) {
            $this->db()->beginTransaction();
            foreach ($matches[1] as $ideaId) {
                $stm = $this->db()->prepare("
                    INSERT INTO related_ideas (commentid, idea_id)
                    VALUES(:commentid, :idea_id)
                ");
                $stm->bindValue(":commentid", $newCommentId, PDO::PARAM_INT);
                $stm->bindValue(":idea_id", $ideaId, PDO::PARAM_INT);
                $stm->execute();
            }
            $this->db()->commit();
        }
    }

    private function extractAndInsertAspects($newCommentId, $comment) {
        $matches = array();
        if (preg_match_all("/#[a-zA-Z][a-zA-Z0-9]*/", $comment, $matches)) {
            $this->db()->beginTransaction();
            foreach ($matches[0] as $aspect) {
                $stm = $this->db()->prepare("
                    INSERT INTO aspects (commentid, aspectname)
                    VALUES(:commentid, :aspectname)
                ");
                $stm->bindValue(":commentid", $newCommentId, PDO::PARAM_INT);
                $stm->bindValue(":aspectname", $aspect, PDO::PARAM_STR);
                $stm->execute();
            }
            $this->db()->commit();
        }
    }

}