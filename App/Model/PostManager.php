<?php


namespace App\Model;


class PostManager
{

    public function fetch_all() {
        try {
            $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        } catch (\Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $sql = 'SELECT DATE_FORMAT(post_updated_date, "%d.%m.%Y") date, title FROM posts';
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }

}