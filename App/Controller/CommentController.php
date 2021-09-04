<?php


namespace App\Controller;

use App\App;
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

    // todo merge validate and invalidate function
    public function validate($id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
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
        } else {
            $this->forbidden();
        }
    }

    public function invalidate($id) {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
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
        } else {
            $this->forbidden();
        }
    }

}
