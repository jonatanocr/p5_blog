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
                $input_name = explode('_', $key)[0];
                if (!empty(filter_input(INPUT_POST, $key))) {
                    $this->session->setSession($key, filter_input(INPUT_POST, $key));
                } else {//var_dump($input_name);var_dump($key);var_dump($value);var_dump('<br>');
                    $this->session->setSession($key, NULL);
                }
            }
        }
    }

    protected function forbidden(){
        header('Location: index.php');
        exit();
    }

}
