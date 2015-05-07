<?php

class IdeaService extends \framework\Service {

    function get($id) {
        $result = null;

        $username = $this->getApp()->getService('login')->currentUserId();

        $db = $this->db();
        $stm = $db->prepare(
            "SELECT `idea_id`, `shorttitle`, `description`, `fullname` user_name, `faculty_name`,
                    IFNULL(upVote, 0) as upVote,
                    IFNULL(downVote, 0) as downVote,
                    IFNULL(userHasVoted, FALSE) as userHasVoted
             FROM ideas i
             JOIN users USING (username)
             JOIN faculties USING (faculty_id)
             LEFT JOIN (SELECT COUNT(vote) as upVote, idea_id
                   FROM votes
                   WHERE idea_id = :id AND vote = 1
                   GROUP BY vote
                  ) uV USING (idea_id)
             LEFT JOIN (SELECT COUNT(vote) as downVote, idea_id
                   FROM votes
                   WHERE idea_id = :id AND vote = -1
                   GROUP BY vote
                  ) dV USING (idea_id)
             LEFT JOIN (SELECT TRUE as userHasVoted, idea_id
                   FROM votes
                   WHERE idea_id = :id AND username = :username
                   GROUP BY vote
                  ) uHasV USING (idea_id)
             WHERE idea_id = :id");
        $stm->bindValue(':id', $id);
        $stm->bindValue(':username', $username);
        $stm->execute();

        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            if ($stm->rowCount() == 0) {
                $result = array('error' => 404);
            } else {
                $result = array('error' => $stm->errorInfo());
            }
        }

        $stm = $db->prepare("
            SELECT comment, fullname AS username, date
            FROM comments
            JOIN users USING (username)
            WHERE idea_id = :id
            ORDER BY date DESC
        ");
        $stm->bindValue(":id", $id);
        $stm->execute();
        $result['comments'] = $stm->fetchAll(PDO::FETCH_ASSOC);

        $stm = $db->prepare("
            SELECT tagname
            FROM tags
            WHERE idea_id = :id
        ");
        $stm->bindValue(":id", $id);
        $stm->execute();
        $result['tags'] = $stm->fetchAll(PDO::FETCH_ASSOC);

        $stm = $db->prepare("
            SELECT aspectname
            FROM aspects
            JOIN comments USING (commentid)
            WHERE idea_id = :id
        ");
        $stm->bindValue(":id", $id);
        $stm->execute();
        $result['aspects'] = $stm->fetchAll(PDO::FETCH_ASSOC);

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