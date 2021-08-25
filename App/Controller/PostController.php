<?php

namespace App\Controller;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Model as Model;

class PostController
{
    protected $db;
    protected $manager;

    public function __construct($db) {
        $this->manager = new Model\PostManager($db);
        $this->db = $db;
    }

    public function create() {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            $user_manager = new Model\UserManager($this->db);
            $authors = $user_manager->author_list();
            require(ROOT . '/App/View/frontend/blog/create.php');
        } else {
            $this->redirect('', 'warning', 'You don\'t have right to access this page');
        }
    }

    public function confirm_create() {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            if (empty($_POST['title_input']) || empty($_POST['header_input']) || empty($_POST['content_input']) || empty($_POST['author_input'])) {
                $this->redirect('post-create', 'error', 'All fields must be filled');
            } else {
                $post = new Post();
                $post->setTitle($_POST['title_input']);
                $post->setHeader($_POST['header_input']);
                $post->setContent($_POST['content_input']);
                $post->setFkAuthor($_POST['author_input']);
                $result = $this->manager->create($post);
                if ($result === 1) {
                    $this->redirect('post-index', 'success', 'Post created');
                } else {
                    $this->redirect('post-create', 'error', 'Fail to create post');
                }
            }
        } else {
            $this->redirect('', 'warning', 'You don\'t have right to access this page');
        }
    }

    public function index() {
        $posts = $this->manager->fetch_all();
        require(ROOT . '/App/View/frontend/blog/index.php');
    }

    private function get_post_data($id) {
        $post_data = array();
        $post_data['post'] = $this->manager->fetch($id);
        $user_manager = new Model\UserManager($this->db);
        $author = new User();
        $author->setId($post_data['post']->getFkAuthor());
        $post_data['post_author'] = $user_manager->fetch($author);
        $comment_manager = new Model\CommentManager($this->db);
        $post_data['comments'] = $comment_manager->fetch_all_from_post($id);
        foreach ($post_data['comments'] as $comment) {
            $comment_author = new User();
            $comment_author->setId($comment->getFkAuthor());
            $comment_author = $user_manager->fetch($comment_author);
            $comment->setAuthor($comment_author);
        }
        return $post_data;
    }

    public function display($id) {
        $post_data = $this->get_post_data($id);
        require(ROOT . '/App/View/frontend/blog/post.php');
    }

    public function edit($id) {
        //todo mettre verification/access dans router ?
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            $post_data = $this->get_post_data($id);
            $user_manager = new Model\UserManager($this->db);
            $authors = $user_manager->author_list();
            require(ROOT . '/App/View/frontend/blog/edit.php');
        } else {
            $this->redirect('', 'warning', 'You don\'t have right to access this page');
        }
    }

    public function confirm_edit($id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            if (empty($_POST['title_input']) || empty($_POST['header_input']) || empty($_POST['content_input']) || empty($_POST['author_input'])) {
                $this->redirect('post-edit-'.$id, 'error', 'All fields must be filled');
            } else {
                $post = new Post();
                $post->setId($id);
                $post->setTitle($_POST['title_input']);
                $post->setHeader($_POST['header_input']);
                $post->setContent($_POST['content_input']);
                $post->setFkAuthor($_POST['author_input']);
                $result = $this->manager->update($post);
                if ($result === 1) {
                    $_SESSION['success_msg'] = 'Post updated';
                    header('Location: index.php?action=post-display-' . $id);
                } else {
                    $_SESSION['error_msg'] = 'Fail to update post';
                    $this->edit($id);
                }
            }
        } else {
            $this->redirect('', 'warning', 'You don\'t have right to access this page');
        }
    }

    public function delete($id) {
        if ((int)$id > 0) {
            $delete = $this->manager->delete($id);
            if ($delete === 1) {
                $_SESSION['success_msg'] = 'Post successfully deleted';
                $this->index();
            } else {
                $_SESSION['error_msg'] = 'An error has<br>occurred please try again';
                $this->index();
            }
        } else {
            $_SESSION['error_msg'] = 'An error has<br>occurred please try again';
            $this->index();
        }
    }

    //todo move this function in comment controller
    public function add_comment($id) {
        if (!isset($_SESSION['id']) || $_SESSION['id'] < 1) {
            $this->redirect('post-display-'.$id, 'error', 'You must be logged in to post a comment');
        }
        if (!empty($_POST['content_input'])) {
            $comment = new Comment();
            $comment->setFkAuthor($_SESSION['id']);
            $comment->setFkPost($id);
            $comment->setContent($_POST['content_input']);
            $comment_manager = new Model\CommentManager($this->db);
            $create = $comment_manager->create($comment);
            if ($create === 1) {
                $this->redirect('post-display-'.$id, 'success', 'Comment added<br>Waiting for Approval');
            } else {
                $this->redirect('post-display-'.$id, 'error', 'An error has<br>occurred please try again');
            }
        } else {
            $this->redirect('post-display-'.$id, 'error', 'Comment field is empty');
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
            if (!empty($_POST['title_input'])) {
                $_SESSION['form']['title'] = $_POST['title_input'];
            }
            if (!empty($_POST["header_input"])) {
                $_SESSION['form']['header'] = $_POST["header_input"];
            }
            if (!empty($_POST["content_input"])) {
                $_SESSION['form']['content'] = $_POST["content_input"];
            }
        }
        header($url);
        die();
    }

}