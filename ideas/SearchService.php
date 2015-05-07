<?php

class SearchService extends \framework\Service {

    function get($searchTerm) {
        $result = array();

        $db = $this->db();
        $stm = $db->prepare(
            "SELECT DISTINCT
              CONCAT(`idea_id`, ': ', `shorttitle`) as title,
              `idea_id`, `shorttitle`,
              `description`,
              `fullname` user_name,
              `faculty_name`
             FROM ideas
             JOIN users USING (username)
             JOIN faculties USING (faculty_id)
             LEFT JOIN comments USING (idea_id)
             LEFT JOIN aspects USING (commentid)
             LEFT JOIN tags USING (idea_id)
             WHERE shorttitle LIKE :searchterm
                OR description LIKE :searchterm
                OR aspectname LIKE :searchterm
                OR tagname LIKE :searchterm
        ");
        $stm->bindValue(':searchterm', '%'.$searchTerm.'%', PDO::PARAM_STR);
        $stm->execute();


        $result['results'] = $stm->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            $result = array('error' => $stm->errorInfo());
        }

        return $result;
    }

}