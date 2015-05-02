<?php

class IdeaService extends \framework\Service {

    function get($id) {
        $result = null;

        $db = $this->db();
        $stm = $db->prepare(
            "SELECT `idea_id`, `shorttitle`, `description`, `fullname` user_name, `faculty_name`
             FROM ideas
             JOIN users USING (username)
             JOIN faculties USING (faculty_id)
             WHERE idea_id = :id");
        $stm->bindValue(':id', $id);
        $stm->execute();

        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            if ($stm->rowCount() == 0) {
                $result = array('error' => 404);
            } else {
                $result = array('error' => $stm->errorInfo());
            }
        }

        return $result;
    }

    function create($data) {
        $username = $this->getApp()->getService('login')->currentUserId();
        $db = $this->db();
        $db->beginTransaction();

        $stm = $db->prepare("INSERT INTO ideas(shorttitle, description, username) VALUES(:shortitle, :description, :username)");
        $stm->bindValue(':shortitle', $data['shortitle'], PDO::PARAM_STR);
        $stm->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stm->bindValue(':username', $username, PDO::PARAM_STR);
        $successful = $stm->execute();
        $id = $db->lastInsertId();

        $db->commit();

        if ($successful)  {
            Header('Location: index.php?resourceName=idea&id=' . $id);
            die();
        } else {
            return array('error' => $stm->errorInfo());
        }
    }

}