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
