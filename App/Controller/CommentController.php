<?php


namespace App\Controller;

use App\App;
use App\Model\CommentManager;

class CommentController
{

    protected $db;
    protected $manager;

    public function __construct($db) {
        $this->db = $db;
        $this->manager = new CommentManager($this->db);
    }

    public function delete($id) {
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
    }

    public function validate($id) {
        if ((int)$id > 0) {
            $validate = $this->manager->validate(1, $id);
            if ($validate === -1) {
                $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
            } else {
                $result = explode('-', $validate);
                if ($result[1] == 1) {
                    $this->redirect('post-edit-'.$result[0], 'success', 'Comment successfully validated');
                } else {
                    $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
                }
            }
        } else {
            $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
        }
    }

    public function invalidate($id) {
        if ((int)$id > 0) {
            $validate = $this->manager->validate(0, $id);
            if ($validate === -1) {
                $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
            } else {
                $result = explode('-', $validate);
                if ($result[1] == 1) {
                    $this->redirect('post-edit-'.$result[0], 'success', 'Comment successfully invalidated');
                } else {
                    $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
                }
            }
        } else {
            $this->redirect('post-index', 'error', 'An error has<br>occurred please try again');
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
        }
        header($url);
        die();
    }

}