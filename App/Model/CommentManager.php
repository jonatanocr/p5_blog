<?php

namespace App\Model;

class CommentManager
{
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // todo degager le $db des param et use construct
    public function fetch_all_from_post($post) {
        $sql = 'SELECT id, DATE_FORMAT(created_date, "%d.%m.%Y-%H:%i:%s") createdDate, fk_author fkAuthor, content';
        $sql.= ' FROM comments WHERE verified = 1 AND fk_post = ' . $post . ' ORDER BY created_date DESC';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Comment');
        return $result;

    }
}