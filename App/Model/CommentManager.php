<?php

namespace App\Model;

class CommentManager
{
    public function fetch_all_from_post($db, $post) {
        $sql = 'SELECT id, DATE_FORMAT(created_date, "%d.%m.%Y-%H:%i:%s") createdDate, fk_user_create fkUserCreate, content';
        $sql.= ' FROM comments WHERE verified = 1 AND fk_post = ' . $post . ' ORDER BY created_date DESC';
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Comment');
        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }
}
/*
$requete = $this->dao->query($sql);
$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
$listeNews = $requete->fetchAll();
*/