<?php


namespace App\Model;

use App\Entity\Post;

class PostManager
{
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(Post $post) {
        $sql = 'INSERT INTO posts (created_date, updated_date, fk_author, title, header, content)';
        $sql.= ' VALUES (NOW(), NOW(), :fk_author, :title, :header, :content);';
        $query = $this->db->prepare($sql);
        $query->bindValue( 'fk_author', $post->getFkAuthor(), \PDO::PARAM_INT);
        $query->bindValue( 'title', $post->getTitle());
        $query->bindValue( 'header', $post->getHeader());
        $query->bindValue( 'content', $post->getContent());
        $query->execute();
        $last_insert = $this->db->lastInsertId();
        if ($last_insert) {
            return 1;
        } else {
            return -1;
        }
    }

    public function fetch_all() {
        $sql = 'SELECT id, DATE_FORMAT(updated_date, "%d.%m.%Y") updatedDate, title, header FROM posts';
        $query = $this->db->prepare($sql);
        $query->execute();
        // todo use hydrate function
        $result = $query->fetchAll(\PDO::FETCH_CLASS, 'App\Entity\Post');
        return $result;
    }

    public function fetch($id) {
        $sql = 'SELECT id, DATE_FORMAT(updated_date, "%d.%m.%Y") updatedDate, fk_author fkAuthor, title, header, content FROM posts WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchObject('App\Entity\Post');
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
        $query = $this->db->prepare($sql);
        $query->bindValue('fk_author', $post->getFkAuthor(), \PDO::PARAM_INT);
        $query->bindValue('title', $post->getTitle());
        $query->bindValue('header', $post->getHeader());
        $query->bindValue('content', $post->getContent());
        $query->bindValue('id', $post->getId(), \PDO::PARAM_INT);
        if ($query->execute()) {
            return 1;
        } else {
            return -1;
        }
    }

    public function delete($id) {
        $sql = 'DELETE FROM posts WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $result = $query->execute();
        if ($result) {
            return 1;
        } else {
            return -1;
        }
    }

}