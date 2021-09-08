<?php


namespace App\Controller;

use App\App;
use App\Entity\Comment;
use App\Model\CommentManager;
use Core\Controller\Controller;

class CommentController extends Controller
{

    protected $db;
    protected $manager;

    public function __construct($db) {
        $this->db = $db;
        $this->manager = new CommentManager($this->db);
    }

    public function add_comment($id) {
        if (!isset($_SESSION['id'])) {
            $this->forbidden();
        }
        if (!empty($_POST['content_input'])) {
            $verified = $_SESSION['user_type']=='admin'?1:0;
            $comment = new Comment();
            $comment->setFkAuthor($_SESSION['id']);
            $comment->setFkPost($id);
            $comment->setContent($_POST['content_input']);
            $comment->setVerified($verified);
            //$comment_manager = new Model\CommentManager($this->db);
            $create = $this->manager->create($comment);
            if ($create === 1) {
                $msg = $verified==1?'Comment added':'Comment added<br>Waiting for Approval';
                $this->redirect('post-display-'.$id, 'success', $msg);
            } else {
                $this->redirect('post-display-'.$id, 'error', 'An error has<br>occurred please try again');
            }
        } else {
            $this->redirect('post-display-'.$id, 'error', 'Comment field is empty');
        }
    }

    public function delete($id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            if ((int)$id > 0) {
                $delete = $this->manager->delete($id);
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

    public function validate($id) {
        $this->change_status(1, $id);
    }

    public function invalidate($id) {
        $this->change_status(0, $id);
    }

    private function change_status($status, $id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            if ((int)$id > 0) {
                $validate = $this->manager->validate($status, $id);
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
