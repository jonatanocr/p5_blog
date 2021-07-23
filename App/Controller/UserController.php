<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\UserManager;

class UserController
{
    public function __construct($db) {
        $this->db = $db;
        // todo mettre manager direct dans le constructor comme pour les posts
    }

    public function register() {
        require(ROOT . '/App/View/frontend/user/register.php');
    }

    public function confirm_register() {
        if ($_POST["password_input"] === $_POST["password2_input"]) {
            $hashed_password = password_hash($_POST["password_input"], PASSWORD_DEFAULT);
            $new_user = new User();
            $new_user->setUsername($_POST["username_input"]);
            $new_user->setPassword($hashed_password);
            $new_user->setEmail($_POST["email_input"]);
            $user_manager = new UserManager($this->db);
            $add_user = $user_manager->create($new_user);
            if ($add_user === 1) {
                $_SESSION['success_msg'] = 'Your account is created';
                header('Location: index.php');
            } elseif ($add_user === 0) {
                // todo redirect sur le form avec les datas
                $_SESSION['warning_msg'] = 'An account already exists with this email or this username address';
                header('Location: index.php');
            } elseif ($add_user === -1) {
                $_SESSION['error_msg'] = 'Sorry, an error has occurred<br>Please try again';
                header('Location: index.php');
            }
        } else {
            // todo redirect sur le form et fill data hormis password
            $_SESSION['error_msg'] = 'Password and confirm password does not match';
            header('Location: index.php');
        }
    }

    public function login() {
        require(ROOT . '/App/View/frontend/user/login.php');
    }

    public function confirm_login() {
        // todo mettre ca dans manager !
        $fetch_user = new User();
        $fetch_user->setUsername($_POST["username_input"]);
        $user_manager = new UserManager($this->db);
        $fetch_user = $user_manager->fetch($fetch_user);
        if ($fetch_user) {
            if (password_verify($_POST["password_input"], $fetch_user->getPassword())) {
                session_start();
                $_SESSION['id'] = $fetch_user->getId();
                $_SESSION['username'] = $fetch_user->getUsername();
                $_SESSION['user_verified'] = $fetch_user->getUserVerified();
                $_SESSION['user_type'] = $fetch_user->getUserType();
                $remember_me = 0;
                if ($remember_me == 1) {
                    // todo upgrade remember me logic and security
                    setcookie('username', $result['username'], time() + 365 * 24 * 3600, null, null, false, true);
                    setcookie('password', $result['password'], time() + 365 * 24 * 3600, null, null, false, true);
                }
                // todo utiliser plutot les fonctions que les header ???
                header('Location: index.php');
            } else {
                header('Location: index.php');
            }
        } else {
            // todo error use session general error msg
            header('Location: index.php?action=login&wrg_cred=1');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
    }


}