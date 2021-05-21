<?php

function create_user($username, $password, $email) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $check_if_exist_query = 'SELECT id FROM users where (username=:username || email=:email)';
    $verify = $db->prepare($check_if_exist_query);
    $verify->bindParam(':username',$username,PDO::PARAM_STR);
    $verify->bindParam(':email',$email,PDO::PARAM_STR);
    $verify->execute();
    $results = $verify->fetchAll(PDO::FETCH_OBJ);

    if ($verify->rowCount() == 0) {
        $insert_query = 'INSERT INTO users (username, password, email)';
        $insert_query.= ' VALUES (:username, :password, :email);';
        $prepared_query = $db->prepare( $insert_query );
        $prepared_query->bindParam( 'username', $username );
        $prepared_query->bindParam( 'password', $password );
        $prepared_query->bindParam( 'email', $email );
        $prepared_query->execute();
        $last_insert = $db->lastInsertId();
        if ($last_insert) {
            return 1;
        } else {
            return -1;
        }
    } else {
        return 0;
    }
}

function update_user($settings) {
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

function delete_user($id) {
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
