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
        $this->checkEmptyFields(['username_input', 'password_input', 'password2_input', 'email_input'], 'user-register');
        $this->registrationCheckInputsPasswords();
        $this->registrationCheckInputEmail();
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
        }
        $this->errorUserVerification($verify_exists);
    }

    private function registrationCheckInputsPasswords() {
        if (filter_input(INPUT_POST, 'password_input') !== filter_input(INPUT_POST, 'password2_input')) {
            $this->redirect('user-register', 'error', 'Passwords mismatch');
        } elseif (strlen(filter_input(INPUT_POST, 'password_input')) < 8) {
            $this->redirect('user-register', 'error', 'The password must have at least 8 characters');
        }
    }

    private function registrationCheckInputEmail() {
        if (!filter_var(filter_input(INPUT_POST, 'email_input'), FILTER_VALIDATE_EMAIL)) {
            $this->redirect('user-register', 'error', 'The email address is not valid');
        }
    }

    private function errorUserVerification($verify_exists) {
        if ($verify_exists > 0) {
            $this->redirect('user-register', 'warning', 'An account already exists with this email or this username address');
        } elseif ($verify_exists < 0) {
            $this->redirect('user-register', 'error', 'An error has occured<br>Please try again');
        }
    }

    public function login() {
        $session = $this->session;
        require ROOT . '/App/View/user/login.php';
    }

    public function confirmLogin() {
        $this->checkEmptyFields(['username_input', 'password_input'], 'user-login');
        $user = new User();
        $user->setUsername(filter_input(INPUT_POST, 'username_input'));
        $user = $this->manager->fetch($user);
        if ($this->manager->checkUserExists($user) == 1 && password_verify(filter_input(INPUT_POST, 'password_input'), $user->getPassword())) {
            session_start();
            session_regenerate_id();
            $this->session->setSession('id', $user->getId());
            $this->session->setSession('username', $user->getUsername());
            $this->session->setSession('user_type', $user->getUserType());
            $this->session->setSession('email', $user->getEmail());
            $this->redirect();
        }
        $this->redirect('user-login', 'warning', 'Username or password is incorrect');
    }

    public function logout() {
        session_destroy();
        $this->redirect();
    }

    public function edit() {
        $this->checkIsLogged();
        $session = $this->session;
        require ROOT . '/App/View/user/edit.php';
    }

    public function confirmEdit() {
        $this->checkIsLogged();
        if (empty(filter_input(INPUT_POST, 'username_input')) || empty(filter_input(INPUT_POST, 'email_input'))) {
            $this->redirect('user-edit', 'error', 'Username and Email must be filled');
        }
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
                $this->registrationCheckInputsPasswords();
                $user->setPassword(password_hash(filter_input(INPUT_POST, 'password_input'), PASSWORD_DEFAULT));
                $update_psw = 1;
            }
            if ($this->manager->update($user, $update_psw) === 1) {
                $this->session->setSession('username', $user->getUsername());
                $this->session->setSession('email', $user->getEmail());
                $this->redirect('', 'success', 'Account updated');
            }
            $this->redirect('user-edit', 'error', 'An error has<br>occurred please try again');
        }
        $this->errorUserVerification($verify_exists);
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
