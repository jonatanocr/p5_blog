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

function submit_login($username_post, $password_post, $remember_me = 0) {
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
            if ($remember_me == 1) {
                // todo upgrade remember me logic and security
                setcookie('username', $result['username'], time() + 365 * 24 * 3600, null, null, false, true);
                setcookie('password', $result['password'], time() + 365 * 24 * 3600, null, null, false, true);
            }
            header('Location: index.php');
        } else {
            header('Location: index.php?action=login&wrg_cred=1');
        }
    } else {
        header('Location: index.php?action=login&wrg_cred=1');
    }
}

function submit_settings($settings) {
    if (isset($settings['password1'])) {
        if ($settings['password1'] === $settings['password2']) {
            $hashed_psw = password_hash($settings['password1'], PASSWORD_DEFAULT);
            $settings['hashed_psw'] = $hashed_psw;
        } else {
            header('Location: index.php?action=settings&pswnomatch=1');
        }
    }
    $update = update_user($settings);
    if ($update > 0) {
        header('Location: index.php?update=1');
    } else {
        header('Location: index.php?action=settings&accountexist=1');
    }

}

function logout() {
    session_destroy();
    header('Location: index.php');
}

function delete_account($id) {
    delete_user($id);
    session_destroy();
    header('Location: index.php');
}


