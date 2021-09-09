<?php


namespace App\Controller;

use App\App;
use App\Entity\Comment;
use App\Model\CommentManager;
use Core\Controller\Controller;

class CommentController extends Controller
{

    protected $pdo;
    protected $manager;
    protected $session;

    public function __construct($pdo, $session) {
        $this->pdo = $pdo;
        $this->session = $session;
        $this->manager = new CommentManager($this->pdo);
    }

    public function add_comment($postId) {
        $session = $this->session;
        if ($this->session->getSession('id') === NULL) {
            $this->forbidden();
        }
        if (!empty(filter_input(INPUT_POST, 'content_input'))) {
            $verified = $this->session->getSession('user_type') == 'admin' ? 1 : 0;
            $comment = new Comment();
            $comment->setFkAuthor($this->session->getSession('id'));
            $comment->setFkPost($postId);
            $comment->setContent(filter_input(INPUT_POST, 'content_input'));
            $comment->setVerified($verified);
            $create = $this->manager->create($comment);
            if ($create === 1) {
                $msg = $verified==1?'Comment added':'Comment added<br>Waiting for Approval';
                $this->redirect('post-display-'.$postId, 'success', $msg);
            } else {
                $this->redirect('post-display-'.$postId, 'error', 'An error has<br>occurred please try again');
            }
        } else {
            $this->redirect('post-display-'.$postId, 'error', 'Comment field is empty');
        }
    }

    public function delete($commentId) {
        $session = $this->session;
        if ($this->session->getSession('user_type') !== NULL && $this->session->getSession('user_type') === 'admin') {
            if ((int)$commentId > 0) {
                $delete = $this->manager->delete($commentId);
                if ($delete === -1) {
                    $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
                } else {
                    $result = explode('-', $delete);
                    if ($result[1] == 1) {
                        $this->redirect('post-edit-'.$result[0], 'success', 'Comment successfully deleted');
                    } else {
                        $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
                    }
                }
            } else {
                $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
            }
        } else {
            $this->forbidden();
        }
    }

    public function validate($commentId) {
        $this->change_status(1, $commentId);
    }

    public function invalidate($commentId) {
        $this->change_status(0, $commentId);
    }

    private function change_status($status, $commentId) {
        $session = $this->session;
        if ($this->session->getSession('user_type') !== NULL && $this->session->getSession('user_type') === 'admin') {
            if ((int)$commentId > 0) {
                $validate = $this->manager->validate($status, $commentId);
                if ($validate === -1) {
                    $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
                } else {
                    $result = explode('-', $validate);
                    if ($result[1] == 1) {
                        $msg = '';
                        if ($status == 0) {
                            $msg = 'Comment successfully invalidated';
                        } elseif ($status == 1) {
                            $msg = 'Comment successfully validated';
                        }
                        $this->redirect('post-edit-'.$result[0], 'success', $msg);
                    } else {
                        $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
                    }
                }
            } else {
                $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
            }
        } else {
            $this->forbidden();
        }
    }

}
