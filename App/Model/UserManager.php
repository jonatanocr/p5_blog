<?php

namespace App\Model;

use App\Entity\User;

class UserManager {

    protected $pdo;

    public function __construct($pdo) {
            $this->pdo = $pdo;
    }

    public function checkUserExists(User $user) {
        $sql = 'SELECT COUNT(id) count FROM users WHERE id = :id OR username = :username OR email = :email;';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $query->bindValue('username', $user->getUsername());
        $query->bindValue('email', $user->getEmail());
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        if ($result) {
            return $result['count'];
        } else {
            return -1;
        }
    }

    public function create(User $user) {
        $sql = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email);';
        $query = $this->pdo->prepare($sql);
        $query->bindValue( 'username', $user->getUsername());
        $query->bindValue( 'password', $user->getPassword());
        $query->bindValue( 'email', $user->getEmail());
        $query->execute();
        $last_insert = $this->pdo->lastInsertId();
        $query->closeCursor();
        if ($last_insert) {
            return 1;
        }
        return -1;
    }

    public function fetch(User $user) {
        $sql = 'SELECT id userId, username, password, email, user_type FROM users WHERE id = :id OR username = :username';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $query->bindValue(':username', $user->getUsername());
        $query->execute();
        $result = $query->fetchObject('App\Entity\User');
        $query->closeCursor();
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
        $query = $this->pdo->prepare($sql);
        $query->bindValue( 'username', $user->getUsername());
        if ($update_password === 1) {
            $query->bindValue( 'password', $user->getPassword());
        }
        $query->bindValue( 'email', $user->getEmail());
        $query->bindValue( 'id', $user->getId(), \PDO::PARAM_INT);
        $update = $query->execute();
        $query->closeCursor();
        if ($update) {
            return 1;
        } else {
            return -1;
        }
    }

    public function delete($userId) {
        $delete_query = 'DELETE FROM users WHERE id = :id';
        $query = $this->pdo->prepare($delete_query);
        $query->bindValue('id', $userId, \PDO::PARAM_INT);
        $result = $query->execute();
        $query->closeCursor();
        if ($result) {
            return 1;
        } else {
            return -1;
        }
    }

    public function authorList() {
        $sql = 'SELECT id, username FROM users WHERE user_type = "admin" ORDER BY username';
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $authors_list = $query->fetchAll();
        $query->closeCursor();
        $authors = array();
        foreach ($authors_list as $author) {
            $authors[$author['id']] = $author['username'];
        }
        return $authors;
    }
}
