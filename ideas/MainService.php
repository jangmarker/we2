<?php

class MainService extends \framework\Service {

    function get($data) {
        $result = array();

        $db = $this->db();
        $stm = $db->prepare(
            "SELECT tagname, COUNT(tagname) as ideaCount
             FROM ideas
             JOIN tags USING(idea_id)
             GROUP BY tagname
             ORDER BY ideaCount DESC
         ");
        $stm->execute();

        $result['tagCount'] = $stm->fetchAll(PDO::FETCH_ASSOC);

        $stm = $db->prepare(
            "SELECT FLOOR(COUNT(*)/10)*10 as ideaCount
             FROM ideas
         ");
        $stm->execute();

        $result['ideaCount'] = $stm->fetch(PDO::FETCH_ASSOC)['ideaCount'];

        return $result;
    }

}