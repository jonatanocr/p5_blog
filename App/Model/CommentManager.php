<?php

namespace App\Model;

use App\Entity\Comment;

class CommentManager
{
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(Comment $comment) {
        $sql = 'INSERT INTO comments (created_date, fk_author, fk_post, verified, content) VALUES (NOW(), :fk_author, :fk_post, :verified, :content)';
        $query = $this->db->prepare($sql);
        $query->bindValue('fk_author', $comment->getFkAuthor(), \PDO::PARAM_INT);
        $query->bindValue('fk_post', $comment->getFkPost(), \PDO::PARAM_INT);
        $query->bindValue('verified', $comment->getVerified(), \PDO::PARAM_INT);
        $query->bindValue('content', $comment->getContent());
        $create = $query->execute();
        $query->closeCursor();
        // todo mettre meme logique partout
        if ($create) {
            return 1;
        }
        return -1;
    }

    public function fetch_all_from_post($post) {
        $sql = 'SELECT id, DATE_FORMAT(created_date, "%d.%m.%Y-%H:%i:%s") createdDate, fk_author fkAuthor, verified, content';
        $sql.= ' FROM comments WHERE fk_post = :post ORDER BY created_date';
        $query = $this->db->prepare($sql);
        $query->bindValue('post', $post, \PDO::PARAM_INT);
        $query->execute();
        // todo stop use fetch class
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Comment');
        $query->closeCursor();
        return $result;
    }

    public function validate($verified, $id) {
        // todo mettre ca dans une function et use pour validate && delete
        $sql = 'SELECT fk_post FROM comments WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        if ($result) {
            $sql = 'UPDATE comments SET verified = :verified WHERE id = :id';
            $query = $this->db->prepare($sql);
            $query->bindValue('verified', $verified, \PDO::PARAM_INT);
            $query->bindValue('id', $id, \PDO::PARAM_INT);
            $update = $query->execute();
            $query->closeCursor();
            if ($update) {
                return $result['fk_post'].'-'.'1';
            } else {
                return $result['fk_post'].'-'.'0';
            }
        } else {
            return -1;
        }
    }

    public function delete($id) {
        $sql = 'SELECT fk_post FROM comments WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        if ($result) {
            $sql = 'DELETE FROM comments WHERE id = :id';
            $query = $this->db->prepare($sql);
            $query->bindValue('id', $id, \PDO::PARAM_INT);
            $result_delete = $query->execute();
            $query->closeCursor();
            if ($result_delete) {
                return $result['fk_post'].'-'.'1';
            } else {
                return $result['fk_post'].'-'.'0';
            }
        } else {
            return -1;
        }
    }
}
