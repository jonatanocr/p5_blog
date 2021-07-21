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
        require(ROOT . '/App/View/frontend/blog/index.php');
    }

    public function display($id) {
        $post = $this->manager->fetch($this->db, $id);
        $user_manager = new Model\UserManager($this->db);
        $post_author = $user_manager->fetch($post->getFkUserCreate());
        $comment_manager = new Model\CommentManager();
        $comments = $comment_manager->fetch_all_from_post($this->db, $id);
        foreach ($comments as $comment) {
            $comment_author = $user_manager->fetch($comment->getFkUserCreate());
            $comment->setUserCreate($comment_author);
        }
        require(ROOT . '/App/View/frontend/blog/post.php');
    }
}