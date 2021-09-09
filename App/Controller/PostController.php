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
    protected $session;

    public function __construct($db, $session) {
        $this->db = $db;
        $this->session = $session;
        $this->manager = new Model\PostManager($db);
    }

    public function create() {
        if ($this->session->getSession('user_type') !== NULL && $this->session->getSession('user_type') === 'admin') {
            $user_manager = new Model\UserManager($this->db);
            $authors = $user_manager->author_list();
            $session = $this->session;
            $url = ROOT . '/App/View/blog/create.php';
            require $url;
        } else {
            $this->forbidden();
        }
    }

    public function confirm_create() {
        if ($this->session->getSession('user_type') !== NULL && $this->session->getSession('user_type') === 'admin') {
            if (empty(filter_input(INPUT_POST, 'title_input')) || empty(filter_input(INPUT_POST, 'header_input')) || empty(filter_input(INPUT_POST, 'content_input')) || empty(filter_input(INPUT_POST, 'author_input'))) {
                $this->redirect('post-create', 'error', 'All fields must be filled');
            } else {
                $post = new Post();
                $post->setTitle(filter_input(INPUT_POST, 'title_input'));
                $post->setHeader(filter_input(INPUT_POST, 'header_input'));
                $post->setContent(filter_input(INPUT_POST, 'content_input'));
                $post->setFkAuthor(filter_input(INPUT_POST, 'author_input'));
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
        $session = $this->session;
        $posts = $this->manager->fetch_all();
        $url = ROOT . '/App/View/blog/index.php';
        require $url;
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
        $url = ROOT . '/App/View/blog/post.php';
        require $url;
    }

    public function edit($id) {
        if ($this->session->getSession('user_type') !== NULL && $this->session->getSession('user_type') === 'admin') {
            $post_data = $this->get_post_data($id);
            $user_manager = new Model\UserManager($this->db);
            $authors = $user_manager->author_list();
            $url = ROOT . '/App/View/blog/edit.php';
            require $url;
        } else {
            $this->forbidden();
        }
    }

    public function confirm_edit($id) {
        if ($this->session->getSession('user_type') && $this->session->getSession('user_type') === 'admin') {
            if (empty(filter_input(INPUT_POST, 'title_input')) || empty(filter_input(INPUT_POST, 'header_input')) || empty(filter_input(INPUT_POST, 'content_input')) || empty(filter_input(INPUT_POST, 'author_input'))) {
                $this->redirect('post-edit-'.$id, 'error', 'All fields must be filled');
            } else {
                $post = new Post();
                $post->setId($id);
                $post->setTitle(filter_input(INPUT_POST, 'title_input'));
                $post->setHeader(filter_input(INPUT_POST, 'header_input'));
                $post->setContent(filter_input(INPUT_POST, 'content_input'));
                $post->setFkAuthor(filter_input(INPUT_POST, 'author_input'));
                $result = $this->manager->update($post);
                if ($result === 1) {
                    $this->session->setSession('success_msg', 'Post updated');
                    header('Location: index.php?action=post-display-' . $id);
                } else {
                    $this->session->setSession('error_msg', 'Fail to update post');
                    $this->edit($id);
                }
            }
        } else {
            $this->forbidden();
        }
    }

    public function delete($id) {
        if ($this->session->getSession('user_type') && $this->session->getSession('user_type') === 'admin') {
            if ((int)$id > 0) {
                $delete = $this->manager->delete($id);
                if ($delete === 1) {
                    $this->session->setSession('success_msg', 'Post successfully deleted');
                    $this->index();
                } else {
                    $this->session->setSession('error_msg', 'An error has<br>occurred please try again');
                    $this->index();
                }
            } else {
                $this->session->setSession('error_msg', 'An error has<br>occurred please try again');
                $this->index();
            }
        } else {
            $this->forbidden();
        }
    }

}
