<?php
require('model/user_model.php');

function submit_sign_up($username, $password, $password2, $email) {

    if ($password === $password2) {
        $hashed_psw = password_hash($password, PASSWORD_DEFAULT);
        $add = create_user($username, $hashed_psw, $email);
        if ($add > 0) {
            header('Location: index.php?add='.$add);
        } else {
            header('Location: index.php?action=sign_up&accountexist=1');
        }
    } else {
        header('Location: index.php?action=sign_up&pswnomatch=1');
    }
}


