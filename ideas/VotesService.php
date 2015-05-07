<?php

class VotesService extends \framework\Service {

    function get($ideaId) {
        $result = array();
        $username = $this->getApp()->getService('login')->currentUserId();

        $db = $this->db();
        $stm = $db->prepare(
            "SELECT COUNT(idea_id) AS count
             FROM votes
             WHERE idea_id = :ideaid AND username = :username");
        $stm->bindValue(':ideaid', $ideaId);
        $stm->bindValue(':username', $username);
        $stm->execute();

        $result['alreadyVoted'] = ($stm->fetch()[0] > 0)?'true':'false';

        $stm = $db->prepare(
            "SELECT COUNT(vote) voteCount, vote
             FROM votes
             WHERE idea_id = :ideaid
             GROUP BY (vote)
             ORDER BY vote ASC"
        );
        $stm->bindValue(':ideaid', $ideaId);
        $stm->execute();

        while (($voteInfo = $stm->fetch(PDO::FETCH_ASSOC)) != null) {
            if ($voteInfo['vote'] == "1") {
                $result['upVote'] = $voteInfo['voteCount'];
            } else if ($voteInfo['vote'] == "-1") {
                $result['downVote'] = $voteInfo['voteCount'];
            } else {
                throw new \Exception("Invalid value for vote " . $voteInfo['vote']);
            }
        }

        return $result;
    }

    function create($data) {
        $username = $this->getApp()->getService('login')->currentUserId();

        $db = $this->db();
        $stm = $db->prepare(
            "INSERT INTO
              votes(username, idea_id, vote)
             VALUES
              (:username, :ideaid, :vote)"
        );
        $stm->bindValue(':username', $username);
        $stm->bindValue(':ideaid', $data['ideaId']);
        $stm->bindValue(':vote', $data['vote']);
        $stm->execute();

        return array('success' => 'true');
    }

}