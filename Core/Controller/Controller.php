<?php

namespace Core\Controller;

class Controller
{
    protected $session;

    public function __construct($pdo, $session) {
        $this->session = $session;
    }

    protected function redirect($action = '', $msg_type = '', $msg = '') {
        $url = 'Location: index.php';
        if (!empty($action)) {
          $url.= '?action=' . $action;
        }
        if (!empty($msg_type) && !empty($msg)) {
            $this->session->setSession($msg_type . '_msg', $msg);
        }
        $this->saveFormInput();
        header($url);
        exit();
    }

    private function saveFormInput() {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'input') !== false) {
                $form_value = (!empty(filter_input(INPUT_POST, $key)))?filter_input(INPUT_POST, $key):NULL;
                $this->session->setSession($key, $form_value);
            }
        }
    }

    protected function checkEmptyFields ($fields , $redirect) {
        foreach ($fields as $field) {
            if (empty(filter_input(INPUT_POST, $field))) {
                $this->redirect($redirect, 'error', 'All fields must be filled');
            }
        }
    }

    protected function forbidden(){
        header('Location: index.php');
        exit();
    }

}
