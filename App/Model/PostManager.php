<?php


namespace App\Model;

use App\Entity\Post;

class PostManager
{
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Post $post) {
        $sql = 'INSERT INTO posts (created_date, updated_date, fk_author, title, header, content)';
        $sql.= ' VALUES (NOW(), NOW(), :fk_author, :title, :header, :content);';
        $query = $this->pdo->prepare($sql);
        $query->bindValue( 'fk_author', $post->getFkAuthor(), \PDO::PARAM_INT);
        $query->bindValue( 'title', $post->getTitle());
        $query->bindValue( 'header', $post->getHeader());
        $query->bindValue( 'content', $post->getContent());
        $query->execute();
        $last_insert = $this->pdo->lastInsertId();
        $query->closeCursor();
        if ($last_insert) {
            return 1;
        } else {
            return -1;
        }
    }

    public function fetch_all() {
        $sql = 'SELECT id, DATE_FORMAT(updated_date, "%d.%m.%Y") updatedDate, title, header, content FROM posts';
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Post');
        $query->closeCursor();
        return $result;
    }

    public function fetch($postId) {
        $sql = 'SELECT id, DATE_FORMAT(updated_date, "%d.%m.%Y") updatedDate, fk_author fkAuthor, title, header, content FROM posts WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->bindValue('id', $postId, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchObject('App\Entity\Post');
        $query->closeCursor();
        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }

    public function update(Post $post) {
        $sql = 'UPDATE posts SET';
        $sql.= ' updated_date = NOW(),';
        $sql.= ' fk_author = :fk_author,';
        $sql.= ' title = :title,';
        $sql.= ' header = :header,';
        $sql.= ' content = :content';
        $sql.= ' WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->bindValue('fk_author', $post->getFkAuthor(), \PDO::PARAM_INT);
        $query->bindValue('title', $post->getTitle());
        $query->bindValue('header', $post->getHeader());
        $query->bindValue('content', $post->getContent());
        $query->bindValue('id', $post->getId(), \PDO::PARAM_INT);
        $result = $query->execute();
        $query->closeCursor();
        if ($result) {
            return 1;
        } else {
            return -1;
        }
    }

    public function delete($postId) {
        $sql = 'DELETE FROM posts WHERE id = :id';
        $query = $this->pdo->prepare($sql);
        $query->bindValue('id', $postId, \PDO::PARAM_INT);
        $result = $query->execute();
        $query->closeCursor();
        if ($result) {
            return 1;
        } else {
            return -1;
        }
    }

}
