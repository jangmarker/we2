<?php

class SearchService extends \framework\Service {

    function get($searchTerm) {
        $result = array();

        $db = $this->db();
        $stm = $db->prepare(
            "SELECT CONCAT(`idea_id`, ': ', `shorttitle`) as title, `idea_id`, `shorttitle`, `description`, `fullname` user_name, `faculty_name`
             FROM ideas
             JOIN users USING (username)
             JOIN faculties USING (faculty_id)
             WHERE shorttitle LIKE :searchterm
              OR description LIKE :searchterm");
        $stm->bindValue(':searchterm', '%'.$searchTerm.'%', PDO::PARAM_STR);
        $stm->execute();


        $result['results'] = $stm->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            $result = array('error' => $stm->errorInfo());
        }

        return $result;
    }

}