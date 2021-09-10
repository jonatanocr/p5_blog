<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\UserManager;
use Core\Controller\Controller;

class UserController extends Controller
{
    protected $pdo;
    protected $manager;
    protected $session;

    public function __construct($pdo, $session) {
        $this->pdo = $pdo;
        $this->session = $session;
        $this->manager = new UserManager($this->pdo);
    }

    public function register() {
        $session = $this->session;
        require ROOT . '/App/View/user/register.php';
    }

    public function confirmRegister() {
        if (empty(filter_input(INPUT_POST, 'username_input')) || empty(filter_input(INPUT_POST, 'password_input')) || empty(filter_input(INPUT_POST, 'password2_input')) || empty(filter_input(INPUT_POST, 'email_input'))) {
            $this->redirect('user-register', 'error', 'All fields must be filled');
        } elseif (filter_input(INPUT_POST, 'password_input') !== filter_input(INPUT_POST, 'password2_input')) {
            $this->redirect('user-register', 'error', 'Passwords mismatch');
        } elseif (strlen(filter_input(INPUT_POST, 'password_input')) < 8) {
            $this->redirect('user-register', 'error', 'The password must have at least 8 characters');
        } elseif (!filter_var(filter_input(INPUT_POST, 'email_input'), FILTER_VALIDATE_EMAIL)) {
            $this->redirect('user-register', 'error', 'The email address is not valid');
        } else {
            $new_user = new User();
            $new_user->setUsername(filter_input(INPUT_POST, 'username_input'));
            $new_user->setPassword(password_hash(filter_input(INPUT_POST, 'password_input'), PASSWORD_DEFAULT));
            $new_user->setEmail(filter_input(INPUT_POST, 'email_input'));
            $verify_exists = $this->manager->checkUserExists($new_user);
            if ($verify_exists == 0) {
                if ($this->manager->create($new_user) === 1) {
                    $this->redirect(null, 'success', 'Your account is created');
                }
                $this->redirect('user-register', 'error', 'An error has occured<br>Please try again');
            } elseif ($verify_exists > 0) {
                $this->redirect('user-register', 'warning', 'An account already exists with this email or this username address');
            } else {
                $this->redirect('user-register', 'error', 'An error has occured<br>Please try again');
            }
        }
    }

    public function login() {
        $session = $this->session;
        require ROOT . '/App/View/user/login.php';
    }

    public function confirmLogin() {
        if (empty(filter_input(INPUT_POST, 'username_input')) || empty(filter_input(INPUT_POST, 'password_input'))) {
            $this->redirect('user-login', 'error', 'All fields must be filled');
        } else {
            $user = new User();
            $user->setUsername(filter_input(INPUT_POST, 'username_input'));
            $verify_exists = $this->manager->checkUserExists($user);
            if ($verify_exists != 1) {
                $this->redirect('user-login', 'warning', 'Username or password is incorrect');
            } else {
                $user = $this->manager->fetch($user);
                if (password_verify(filter_input(INPUT_POST, 'password_input'), $user->getPassword())) {
                    session_start();
                    session_regenerate_id();
                    $this->session->setSession('id', $user->getId());
                    $this->session->setSession('username', $user->getUsername());
                    $this->session->setSession('user_type', $user->getUserType());
                    $this->session->setSession('email', $user->getEmail());
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
        if ($this->session->getSession('id') === NULL) {
            $this->forbidden();
        }
        $session = $this->session;
        require ROOT . '/App/View/user/edit.php';
    }

    public function confirmEdit() {
        if ($this->session->getSession('id') === NULL) {
            $this->forbidden();
        }
        if (empty(filter_input(INPUT_POST, 'username_input')) || empty(filter_input(INPUT_POST, 'email_input'))) {
            $this->redirect('user-edit', 'error', 'Username and Email must be filled');
        } else {
            $verify_exists = 0;
            if (filter_input(INPUT_POST, 'username_input') != $this->session->getSession('username') || filter_input(INPUT_POST, 'email_input') != $this->session->getSession('email')) {
                $check_user = new User();
                if (filter_input(INPUT_POST, 'username_input') != $this->session->getSession('username')) {
                    $check_user->setUsername(filter_input(INPUT_POST, 'username_input'));
                }
                if (filter_input(INPUT_POST, 'email_input') != $this->session->getSession('email')) {
                    $check_user->setEmail(filter_input(INPUT_POST, 'email_input'));
                }
                $verify_exists = $this->manager->checkUserExists($check_user);
            }
            if ($verify_exists == 0) {
                $user = new User();
                $user->setId($this->session->getSession('id'));
                $user = $this->manager->fetch($user);
                $user->setUsername(filter_input(INPUT_POST, 'username_input'));
                $user->setEmail(filter_input(INPUT_POST, 'email_input'));
                $update_psw = 0;
                if (!empty(filter_input(INPUT_POST, 'password_input'))) {
                    if (filter_input(INPUT_POST, 'password_input') !== filter_input(INPUT_POST, 'password2_input')) {
                        $this->redirect('user-edit', 'error', 'Passwords mismatch');
                    } elseif (strlen(filter_input(INPUT_POST, 'password_input')) < 8) {
                        $this->redirect('user-edit', 'error', 'The password must have at least 8 characters');
                    } else {
                        $user->setPassword(password_hash(filter_input(INPUT_POST, 'password_input'), PASSWORD_DEFAULT));
                        $update_psw = 1;
                    }
                }
                $update = $this->manager->update($user, $update_psw);
                if ($update === 1) {
                    $this->session->setSession('username', $user->getUsername());
                    $this->session->setSession('email', $user->getEmail());
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

    public function delete($userId) {
        if ($this->session->getSession('id') === NULL || $this->session->getSession('id') !== $userId) {
            $this->forbidden();
        }
        $delete = $this->manager->delete($userId);
        if ($delete === 1) {
            $this->logout();
        }
        $this->redirect('user-edit', 'error', 'An error has<br>occurred please try again');
    }

}
