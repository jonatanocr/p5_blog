<?php


namespace App\Model;


class PostManager
{
    public function fetch_all($db) {
        $sql = 'SELECT id, DATE_FORMAT(post_updated_date, "%d.%m.%Y") updatedDate, title FROM posts';
        $query = $db->prepare($sql);
        $query->execute();
        //$result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Post');

        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }

    public function fetch_one($db, $id) {
        $sql = 'SELECT id, DATE_FORMAT(post_updated_date, "%d.%m.%Y") date, fk_user_create, title, header, content FROM posts WHERE id = ' . $id;
        $query = $db->prepare($sql);
        $query->execute();
        //$result = $query->fetch(\PDO::FETCH_ASSOC);
        $result = $query->fetchObject('App\Entity\Post');

        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }

}