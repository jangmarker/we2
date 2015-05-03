<?php

class UserService extends \framework\Service {

    function exists($username, $password) {
        $stm = $this->db()->prepare(
            "SELECT COUNT(username) as count
             FROM users
             WHERE password = :password
              AND username = :username");
        $stm->bindValue(':password', $password);
        $stm->bindValue(':username', $username);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC)['count'] > 0;
    }

    function getUserAsArray($username) {
        $stm = $this->db()->prepare(
            "SELECT username as id, fullname as name, faculty_name as faculty
             FROM users JOIN faculties USING (faculty_id)
             WHERE username = :username");
        $stm->bindValue(':username', $username);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
    }


}