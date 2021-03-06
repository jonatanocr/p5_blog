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

    public function fetchAllFromPost($post) {
        $sql = 'SELECT id commentId, DATE_FORMAT(created_date, "%d.%m.%Y-%H:%i:%s") createdDate, fk_author fkAuthor, verified, content';
        $sql.= ' FROM comments WHERE fk_post = :post ORDER BY created_date';
        $query = $this->pdo->prepare($sql);
        $query->bindValue('post', $post, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Comment');
        $query->closeCursor();
        return $result;
    }

    public function validate($verified, $commentId) {
        $result = $this->checkIfExists($commentId);
        if ($result) {
            $sql = 'UPDATE comments SET verified = :verified WHERE id = :id';
            $query = $this->pdo->prepare($sql);
            $query->bindValue('verified', $verified, \PDO::PARAM_INT);
            $query->bindValue('id', $commentId, \PDO::PARAM_INT);
            $update = $query->execute();
            $query->closeCursor();
            if ($update) {
                return $result['fk_post'];
            }
            return -1;
        }
        return -1;
    }

    public function delete($commentId) {
        $result = $this->checkIfExists($commentId);
        if ($result) {
            $sql = 'DELETE FROM comments WHERE id = :id';
            $query = $this->pdo->prepare($sql);
            $query->bindValue('id', $commentId, \PDO::PARAM_INT);
            $result_delete = $query->execute();
            $query->closeCursor();
            if ($result_delete) {
                return $result['fk_post'];
            }
            return -1;
        } else {
            return -1;
        }
    }

    private function checkIfExists($commentId) {
        $sql = 'SELECT fk_post FROM comments WHERE id = :id;';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $commentId, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

}
