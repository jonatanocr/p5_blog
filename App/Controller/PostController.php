<?php

namespace App\Controller;
use App\Model as Model;

class PostController
{
    public function __construct($db) {
        $this->manager = new Model\PostManager();
        $this->db = $db;
    }

    public function index() {
        $posts = $this->manager->fetch_all($this->db);
        require(ROOT.'/App/View/frontend/main_page.php');
    }

    public function display($id) {
        $post = $this->manager->fetch_one($this->db, $id);
        require(ROOT.'/App/View/frontend/post.php');
    }
}