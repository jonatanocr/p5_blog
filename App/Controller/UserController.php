<?php

namespace App\Controller;

class UserController
{
    public function __construct($db) {
        $this->db = $db;
    }

    public function register() {
        require(ROOT . '/App/View/frontend/user/register.php');
    }

    public function login() {
        require(ROOT . '/App/View/frontend/user/login.php');
    }


}