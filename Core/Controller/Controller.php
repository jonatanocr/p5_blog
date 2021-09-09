<?php

namespace Core\Controller;

class Controller
{
    protected $session;

    public function __construct($pdo, $session) {
        $this->session = $session;
    }

    protected function redirect($action = '', $msg_type = '', $msg = '') {
        if (empty($action)) {
            $url = 'Location: index.php';
        } else {
            $url = 'Location: index.php?action=' . $action;
        }
        if (!empty($msg_type) AND !empty($msg)) {
            $this->session->setSession($msg_type . '_msg', $msg);
            if (!empty(filter_input(INPUT_POST, 'username_input'))) {
                $this->session->setSession('form',['username' => filter_input(INPUT_POST, 'username_input')]);
                //$_SESSION['form']['username'] = filter_input(INPUT_POST, 'username_input');
            } else {
                $this->session->setSession('form', ['username' => NULL]);
            }
            if (!empty(filter_input(INPUT_POST, 'email_input'))) {
                $this->session->setSession('form', ['email' => filter_input(INPUT_POST, 'email_input')]);
            } else {
                $this->session->setSession('form', ['email' => NULL]);
            }
            if (!empty(filter_input(INPUT_POST, 'title_input'))) {
                $this->session->setSession('form', ['title' => filter_input(INPUT_POST, 'title_input')]);
            } else {
                $this->session->setSession('form', ['title' => NULL]);
            }
            if (!empty(filter_input(INPUT_POST, 'header_input'))) {
                $this->session->setSession('form', ['header' => filter_input(INPUT_POST, 'header_input')]);
            } else {
                $this->session->setSession('form', ['header' => NULL]);
            }
            if (!empty(filter_input(INPUT_POST, 'content_input'))) {
                $this->session->setSession('form', ['content' => filter_input(INPUT_POST, 'content_input')]);
            } else {
                $this->session->setSession('form', ['content' => NULL]);
            }
            if (!empty(filter_input(INPUT_POST, 'name_input'))) {
                $this->session->setSession('form', ['name' => filter_input(INPUT_POST, 'name_input')]);
            } else {
                $this->session->setSession('form', ['name' => NULL]);
            }
            if (!empty(filter_input(INPUT_POST, 'message_input'))) {
                $this->session->setSession('form', ['message' => filter_input(INPUT_POST, 'message_input')]);
            } else {
                $this->session->setSession('form', ['message' => NULL]);
            }
        }
        header($url);
    }

    protected function forbidden(){
        $url = 'Location: index.php';
        header($url);
    }

}
