<?php


namespace App\Model;

class PostManager
{
    public function fetch_all($db) {
        $sql = 'SELECT id, DATE_FORMAT(post_updated_date, "%d.%m.%Y") updatedDate, title, header FROM posts';
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Post');
        return $result;

    }

    public function fetch($db, $id) {
        $sql = 'SELECT id, DATE_FORMAT(post_updated_date, "%d.%m.%Y") updatedDate, fk_user_create fkUserCreate, title, header, content FROM posts WHERE id = ' . $id;
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchObject('App\Entity\Post');
        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }

    public function delete($db, $id) {
        $sql = 'DELETE FROM posts WHERE id = ' . $id;
        $query = $db->prepare($sql);
        $result = $query->execute();
        if ($result) {
            return 1;
        } else {
            return -1;
        }
    }

}