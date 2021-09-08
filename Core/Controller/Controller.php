<?php

namespace Core\Controller;

class Controller
{

    protected function redirect($action = '', $msg_type = '', $msg = '') {
        if (empty($action)) {
            $url = 'Location: index.php';
        } else {
            $url = 'Location: index.php?action=' . $action;
        }
        if (!empty($msg_type) AND !empty($msg)) {
            $_SESSION[$msg_type . '_msg'] = $msg;
            if (!empty(filter_input(INPUT_POST, 'username_input'))) {
                $_SESSION['form']['username'] = filter_input(INPUT_POST, 'username_input');
            }
            if (!empty(filter_input(INPUT_POST, 'email_input'))) {
                $_SESSION['form']['email'] = filter_input(INPUT_POST, 'email_input');
            }
            if (!empty(filter_input(INPUT_POST, 'title_input'))) {
                $_SESSION['form']['title'] = filter_input(INPUT_POST, 'title_input');
            }
            if (!empty(filter_input(INPUT_POST, 'header_input'))) {
                $_SESSION['form']['header'] = filter_input(INPUT_POST, 'header_input');
            }
            if (!empty(filter_input(INPUT_POST, 'content_input'))) {
                $_SESSION['form']['content'] = filter_input(INPUT_POST, 'content_input');
            }
            if (!empty(filter_input(INPUT_POST, 'name_input'))) {
                $_SESSION['form']['name'] = filter_input(INPUT_POST, 'name_input');
            }
            if (!empty(filter_input(INPUT_POST, 'message_input'))) {
                $_SESSION['form']['message'] = filter_input(INPUT_POST, 'message_input');
            }
        }
        header($url);
        die();
    }

    protected function forbidden(){
        $url = 'Location: index.php';
        header($url);
        die();
    }

}
