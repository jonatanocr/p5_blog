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
            if (!empty($_POST['username_input'])) {
                $_SESSION['form']['username'] = $_POST['username_input'];
            }
            if (!empty($_POST["email_input"])) {
                $_SESSION['form']['email'] = $_POST["email_input"];
            }
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

    protected function forbidden(){
        $url = 'Location: index.php';
        header($url);
        die();
    }

}