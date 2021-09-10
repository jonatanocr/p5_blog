<?php

namespace App\Controller;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Model as Model;
use Core\Controller\Controller;

class PostController extends Controller
{
    protected $pdo;
    protected $manager;
    protected $session;

    public function __construct($pdo, $session) {
        $this->pdo = $pdo;
        $this->session = $session;
        $this->manager = new Model\PostManager($pdo);
    }

    public function create() {
        if ($this->session->getSession('user_type') !== NULL && $this->session->getSession('user_type') === 'admin') {
            $user_manager = new Model\UserManager($this->pdo);
            $authors = $user_manager->authorList();
            $session = $this->session;
            require ROOT . '/App/View/blog/create.php';
        } else {
            $this->forbidden();
        }
    }

    public function confirmCreate() {
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
        $posts = $this->manager->fetchAll();
        require ROOT . '/App/View/blog/index.php';
    }

    private function getPostData($postId) {
        $post_data = array();
        $post_data['post'] = $this->manager->fetch($postId);
        $user_manager = new Model\UserManager($this->pdo);
        $author = new User();
        $author->setId($post_data['post']->getFkAuthor());
        $post_data['post_author'] = $user_manager->fetch($author);
        $comment_manager = new Model\CommentManager($this->pdo);
        $post_data['comments'] = $comment_manager->fetchAllFromPost($postId);
        foreach ($post_data['comments'] as $comment) {
            $comment_author = new User();
            $comment_author->setId($comment->getFkAuthor());
            $comment_author = $user_manager->fetch($comment_author);
            $comment->setAuthor($comment_author);
        }
        return $post_data;
    }

    public function display($postId) {
        $session = $this->session;
        $post_data = $this->getPostData($postId);
        require ROOT . '/App/View/blog/post.php';
    }

    public function edit($postId) {
        if ($this->session->getSession('user_type') !== NULL && $this->session->getSession('user_type') === 'admin') {
            $post_data = $this->getPostData($postId);
            $user_manager = new Model\UserManager($this->pdo);
            $authors = $user_manager->authorList();
            $session = $this->session;
            require ROOT . '/App/View/blog/edit.php';
        } else {
            $this->forbidden();
        }
    }

    public function confirmEdit($postId) {
        if ($this->session->getSession('user_type') && $this->session->getSession('user_type') === 'admin') {
            if (empty(filter_input(INPUT_POST, 'title_input')) || empty(filter_input(INPUT_POST, 'header_input')) || empty(filter_input(INPUT_POST, 'content_input')) || empty(filter_input(INPUT_POST, 'author_input'))) {
                $this->redirect('post-edit-'.$postId, 'error', 'All fields must be filled');
            } else {
                $post = new Post();
                $post->setId($postId);
                $post->setTitle(filter_input(INPUT_POST, 'title_input'));
                $post->setHeader(filter_input(INPUT_POST, 'header_input'));
                $post->setContent(filter_input(INPUT_POST, 'content_input'));
                $post->setFkAuthor(filter_input(INPUT_POST, 'author_input'));
                $result = $this->manager->update($post);
                if ($result === 1) {
                    $session = $this->session;
                    $this->redirect('post-display-'.$postId, 'success', 'Post updated');
                } else {
                    $this->session->setSession('error_msg', 'Fail to update post');
                    $this->edit($postId);
                }
            }
        } else {
            $this->forbidden();
        }
    }

    public function delete($postId) {
        if ($this->session->getSession('user_type') && $this->session->getSession('user_type') === 'admin') {
            if ((int)$postId > 0) {
                $delete = $this->manager->delete($postId);
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
