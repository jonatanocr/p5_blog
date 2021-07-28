<?php

namespace App\Model;

use App\Entity\User;

class UserManager {

    protected $db;

    public function __construct($db) {
            $this->db = $db;
    }

    public function check_user_exists(User $user) {
        $sql = 'SELECT COUNT(id) count FROM users WHERE id = :id OR username = :username OR email = :email;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $query->bindValue('username', $user->getUsername());
        $query->bindValue('email', $user->getEmail());
        $query->execute();
        $result = $query->fetch();
        if ($result) {
            return $result['count'];
        } else {
            return -1;
        }
    }

    public function create(User $user) {
        $sql = 'INSERT INTO users (username, password, email, user_verified) VALUES (:username, :password, :email, 0);';
        $query = $this->db->prepare($sql);
        $query->bindValue( 'username', $user->getUsername());
        $query->bindValue( 'password', $user->getPassword());
        $query->bindValue( 'email', $user->getEmail());
        $query->execute();
        $last_insert = $this->db->lastInsertId();
        if ($last_insert) {
            return 1;
        }
        return -1;
    }

    public function fetch(User $user) {
        $sql = 'SELECT id, username, password, email, user_verified, user_type FROM users WHERE id = :id OR username = :username';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $query->bindValue(':username', $user->getUsername());
        $query->execute();
        //todo stop use fetchObject and use hydrate function
        $result = $query->fetchObject('App\Entity\User');
        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }

    public function update(User $user, $update_password = 0) {
        $sql = 'UPDATE users SET';
        $sql.= ' username = :username,';
        if ($update_password === 1) {
            $sql.= ' password = :password,';
        }
        $sql.= ' email = :email';
        $sql.= ' WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue( 'username', $user->getUsername());
        if ($update_password === 1) {
            $query->bindValue( 'password', $user->getPassword());
        }
        $query->bindValue( 'email', $user->getEmail());
        $query->bindValue( 'id', $user->getId(), \PDO::PARAM_INT);
        $update = $query->execute();
        if ($update) {
            return 1;
        } else {
            return -1;
        }
    }

    public function delete($id) {
        //todo delete user comm/posts
        $delete_query = 'DELETE FROM users WHERE id = ' . $id;
        $query = $this->db->prepare($delete_query);
        $result = $query->execute();
        if ($result) {
            return 1;
        } else {
            return -1;
        }
    }

    public function author_list() {
        $sql = 'SELECT id, username FROM users WHERE user_type = "admin" ORDER BY username';
        $query = $this->db->prepare($sql);
        $query->execute();
        $authors_list = $query->fetchAll();
        $authors = array();
        foreach ($authors_list as $author) {
            $authors[$author['id']] = $author['username'];
        }
        return $authors;
    }
}
