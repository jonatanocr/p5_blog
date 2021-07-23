<?php

namespace App\Model;

use App\Entity\User;

class UserManager {

    protected $db;

    public function __construct($db) {
            $this->db = $db;
    }

    public function create(User $user) {
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $check_if_exist_query = 'SELECT id FROM users where (username=:username OR email=:email);';
        $verify = $this->db->prepare($check_if_exist_query);
        $verify->bindParam(':username', $username);
        $verify->bindParam(':email', $email);
        $verify->execute();
        $results = $verify->fetchAll(\PDO::FETCH_OBJ);
        if ($verify->rowCount() == 0) {
            $insert_query = 'INSERT INTO users (username, password, email, user_verified)';
            $insert_query.= ' VALUES (:username, :password, :email, 0);';
            $prepared_query = $this->db->prepare($insert_query);
            $prepared_query->bindParam( 'username', $username);
            $prepared_query->bindParam( 'password', $password);
            $prepared_query->bindParam( 'email', $email);
            $prepared_query->execute();
            $last_insert = $this->db->lastInsertId();
            if ($last_insert) {
                return 1;
            } else {
                return -1;
            }
        } else {
            return 0;
        }
    }

    public function fetch(User $user) {
        $id = $user->getId();
        $username = $user->getUsername();
        $sql = 'SELECT id, username, password, email, user_verified, user_type FROM users WHERE (';
        $sql.= $id>0?' id = :id':' ';
        $sql.= ($id>0 && !empty($username))?' OR':'';
        $sql.= !empty($username)?' username = :username':'';
        $sql.= ');';
        $query = $this->db->prepare($sql);
        if ($id > 0) {
            $query->bindParam(':id', $id);
        }
        if ($username) {
            $query->bindParam(':username', $username);
        }
        $query->execute();
        $result = $query->fetchObject('App\Entity\User');
        if ($result) {
            return $result;
        } else {
            return -1;
        }
    }

    public function updateUser($settings) {
        try {
            $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $update_query = 'UPDATE users SET';
        $update_query.= ' username = :username,';
        $update_query.= ' password = :password,';
        $update_query.= ' email = :email';
        $update_query.= ' WHERE id = :id';
        $query = $db->prepare($update_query);
        $query->bindParam( 'username', $settings['username'],PDO::PARAM_STR);
        $query->bindParam( 'password', $settings['hashed_psw'],PDO::PARAM_STR);
        $query->bindParam( 'email', $settings['email'],PDO::PARAM_STR);
        $query->bindParam( 'id', $settings['id'] );
        $query->execute();
        return 1;
    }

    public function delete_user($id) {
        try {
            $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
            //$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $delete_query = 'DELETE FROM users WHERE id = ' . $id;
        $query = $db->prepare($delete_query);
        $query->execute();
        return 1;
    }
}
