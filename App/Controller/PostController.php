<?php

namespace App\Controller;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Model as Model;
use Core\Controller\Controller;

class PostController extends Controller
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
            require(ROOT . '/App/View/blog/create.php');
        } else {
            $this->forbidden();
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
            $this->forbidden();
        }
    }

    public function index() {
        $posts = $this->manager->fetch_all();
        require(ROOT . '/App/View/blog/index.php');
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
        require(ROOT . '/App/View/blog/post.php');
    }

    public function edit($id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            $post_data = $this->get_post_data($id);
            $user_manager = new Model\UserManager($this->db);
            $authors = $user_manager->author_list();
            require(ROOT . '/App/View/blog/edit.php');
        } else {
            $this->forbidden();
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
            $this->forbidden();
        }
    }

    public function delete($id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
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
        } else {
            $this->forbidden();
        }
    }

}
