<?php
require('model/user_model.php');

function submit_signup($username, $password, $password2, $email) {
    if ($password === $password2) {
        $hashed_psw = password_hash($password, PASSWORD_DEFAULT);
        $add = create_user($username, $hashed_psw, $email);
        if ($add > 0) {
            header('Location: index.php?add='.$add);
        } else {
            header('Location: index.php?action=signup&accountexist=1');
        }
    } else {
        header('Location: index.php?action=signup&pswnomatch=1');
    }
}

function submit_login($username_post, $password_post) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $sql = 'SELECT id, username, password FROM users WHERE username = :username';
    $query = $db->prepare($sql);
    $query->bindParam(':username',$username_post,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch();
    if ($result) {
        if (password_verify($password_post, $result["password"])) {
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            header('Location: index.php');
        } else {
            header('Location: index.php?action=login&wrg_cred=1');
        }
    } else {
        header('Location: index.php?action=login&wrg_cred=1');
    }
}

function logout() {
    session_destroy();
    header('Location: index.php');
}

