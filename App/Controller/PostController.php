<?php

namespace App\Controller;
use App\Model as Model;

class PostController
{
    public function __construct() {
        $this->manager = new Model\PostManager();
    }

    public function index() {
        $posts = $this->manager->fetch_all();
        require(ROOT.'/App/View/frontend/main_page.php');
    }
}