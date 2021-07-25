<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\UserManager;

class UserController
{
    protected $db;
    protected $manager;

    public function __construct($db) {
        $this->db = $db;
        $this->manager = new UserManager($this->db);
    }

    public function register() {
        require(ROOT . '/App/View/frontend/user/register.php');
    }

    public function confirm_register() {
        if (empty($_POST["username_input"]) OR empty($_POST["password_input"]) OR empty($_POST["password2_input"]) OR empty($_POST["email_input"])) {
            $this->redirect('user-register', 'error', 'All fields must be filled');
        } elseif ($_POST["password_input"] !== $_POST["password2_input"]) {
            $this->redirect('user-register', 'error', 'Passwords mismatch');
        } elseif (strlen($_POST["password_input"]) < 8) {
            $this->redirect('user-register', 'error', 'The password must have at least 8 characters');
        } elseif (!filter_var($_POST['email_input'], FILTER_VALIDATE_EMAIL)) {
            $this->redirect('user-register', 'error', 'The email address is not valid');
        } else {
            $hashed_password = password_hash($_POST["password_input"], PASSWORD_DEFAULT);
            $new_user = new User();
            $new_user->setUsername($_POST["username_input"]);
            $new_user->setPassword($hashed_password);
            $new_user->setEmail($_POST["email_input"]);
            $verify_exists = $this->manager->check_user_exists($new_user);
            if ($verify_exists == 0) {
                $add_user = $this->manager->create($new_user);
                if ($add_user === 1) {
                    $this->redirect(null, 'success', 'Your account is created');
                } else {
                    $this->redirect('user-register', 'error', 'An error has occured<br>Please try again');
                }
            } elseif ($verify_exists > 0) {
                $this->redirect('user-register', 'warning', 'An account already exists with this email or this username address');
            } else {
                $this->redirect('user-register', 'error', 'An error has occured<br>Please try again');
            }
        }
    }

    public function login() {
        require(ROOT . '/App/View/frontend/user/login.php');
    }

    public function confirm_login() {
        if (empty($_POST['username_input']) OR empty($_POST['password_input'])) {
            $this->redirect('user-login', 'error', 'All fields must be filled');
        } else {
            $user = new User();
            $user->setUsername($_POST['username_input']);
            $verify_exists = $this->manager->check_user_exists($user);
            if ($verify_exists != 1) {
                $this->redirect('user-login', 'warning', 'Username or password is incorrect');
            } else {
                $user = $this->manager->fetch($user);
                if (password_verify($_POST['password_input'], $user->getPassword())) {
                    session_start();
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['user_verified'] = $user->getUserVerified();
                    $_SESSION['user_type'] = $user->getUserType();
                    $_SESSION['email'] = $user->getEmail();
                    $remember_me = 0;
                    if ($remember_me == 1) {
                        // todo upgrade remember me logic and security
                        setcookie('username', $result['username'], time() + 365 * 24 * 3600, null, null, false, true);
                        setcookie('password', $result['password'], time() + 365 * 24 * 3600, null, null, false, true);
                    }
                    $this->redirect();
                } else {
                    $this->redirect('user-login', 'warning', 'Username or password is incorrect');
                }
            }
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect();
    }

    public function edit() {
        // todo verif si user connected pour laisser access
        require(ROOT . '/App/View/frontend/user/edit.php');
    }

    public function confirm_edit() {
        if (empty($_POST["username_input"]) OR empty($_POST["email_input"])) {
            $this->redirect('user-edit', 'error', 'Username and Email must be filled');
        } else {
            $verify_exists = 0;
            if ($_POST['username_input'] != $_SESSION['username'] || $_POST['email_input'] != $_SESSION['email']) {
                $check_user = new User();
                if ($_POST['username_input'] != $_SESSION['username']) {
                    $check_user->setUsername($_POST['username_input']);
                }
                if ($_POST['email_input'] != $_SESSION['email']) {
                    $check_user->setEmail($_POST['email_input']);
                }
                $verify_exists = $this->manager->check_user_exists($check_user);
            }
            if ($verify_exists == 0) {
                $user = new User();
                $user->setId($_SESSION['id']);
                $user = $this->manager->fetch($user);
                $user->setUsername($_POST['username_input']);
                $user->setEmail($_POST['email_input']);
                $update_psw = 0;
                if (!empty($_POST['password_input'])) {
                    if ($_POST["password_input"] !== $_POST["password2_input"]) {
                        $this->redirect('user-edit', 'error', 'Passwords mismatch');
                    } elseif (strlen($_POST["password_input"]) < 8) {
                        $this->redirect('user-edit', 'error', 'The password must have at least 8 characters');
                    } else {
                        $user->setPassword(password_hash($_POST['password_input'], PASSWORD_DEFAULT));
                        $update_psw = 1;
                    }
                }
                $update = $this->manager->update($user, $update_psw);
                if ($update === 1) {
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['email'] = $user->getEmail();
                    $this->redirect('', 'success', 'Account updated');
                } else {
                    $this->redirect('user-edit', 'error', 'An error has<br>occurred please try again');
                }
            } elseif ($verify_exists > 0) {
                $this->redirect('user-edit', 'warning', 'An account already exists with this email or this username address');
            } else {
                $this->redirect('user-edit', 'error', 'An error has occured<br>Please try again');
            }
        }
    }

    public function delete($id) {
        if ($_SESSION['id'] === $id) {
            $delete = $this->manager->delete($id);
            if ($delete === 1) {
                $this->logout();
            } else {
                $this->redirect('user-edit', 'error', 'An error has<br>occurred please try again');
            }
        } else {
            $this->redirect('user-edit', 'error', 'An error has occured');
        }
    }

    // todo mettre cette fonction dans une classe mere
    public function redirect($action = '', $msg_type = '', $msg = '') {
        if (empty($action)) {
            $url = 'Location: index.php';
        } else {
            $url = 'Location: index.php?action=' . $action;
        }
        if (!empty($msg_type) AND !empty($msg)) {
            $_SESSION[$msg_type . '_msg'] = $msg;
            if (!empty($_POST['username_input'])) {
                $_SESSION['form']['username'] = $_POST['username_input'];
            }
            if (!empty($_POST["email_input"])) {
                $_SESSION['form']['email'] = $_POST["email_input"];
            }
        }
        header($url);
        die();
    }

}