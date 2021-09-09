<?php

namespace App\Model;

use App\Entity\Comment;

class CommentManager
{
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Comment $comment) {
        $sql = 'INSERT INTO comments (created_date, fk_author, fk_post, verified, content) VALUES (NOW(), :fk_author, :fk_post, :verified, :content)';
        $query = $this->pdo->prepare($sql);
        $query->bindValue('fk_author', $comment->getFkAuthor(), \PDO::PARAM_INT);
        $query->bindValue('fk_post', $comment->getFkPost(), \PDO::PARAM_INT);
        $query->bindValue('verified', $comment->getVerified(), \PDO::PARAM_INT);
        $query->bindValue('content', $comment->getContent());
        $create = $query->execute();
        $query->closeCursor();
        if ($create) {
            return 1;
        }
        return -1;
    }

    public function fetch_all_from_post($post) {
        $sql = 'SELECT id, DATE_FORMAT(created_date, "%d.%m.%Y-%H:%i:%s") createdDate, fk_author fkAuthor, verified, content';
        $sql.= ' FROM comments WHERE fk_post = :post ORDER BY created_date';
        $query = $this->pdo->prepare($sql);
        $query->bindValue('post', $post, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Comment');
        $query->closeCursor();
        return $result;
    }

    public function validate($verified, $id) {
        $result = $this->check_if_exists($id);
        if ($result) {
            $sql = 'UPDATE comments SET verified = :verified WHERE id = :id';
            $query = $this->pdo->prepare($sql);
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
        $result = $this->check_if_exists($id);
        if ($result) {
            $sql = 'DELETE FROM comments WHERE id = :id';
            $query = $this->pdo->prepare($sql);
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

    private function check_if_exists($id) {
        $sql = 'SELECT fk_post FROM comments WHERE id = :id;';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

}
