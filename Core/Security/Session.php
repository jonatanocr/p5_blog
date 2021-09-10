<?php

namespace Core\Security;

class Session
{
    /**
     * @var array
     */
    private $session;

    public function __construct() {
        $this->session = (isset($_SESSION)) ? $_SESSION : null;
    }

    public function getSession($key) {
        return (isset($this->session[$key])?$this->session[$key]:null);
    }

    public function setSession($key, $value) {
        $this->session[$key] = $value;
        $_SESSION[$key] = $this->session[$key];
    }

    public function delete($var_name) {
        if ($var_name == 'form_input') {
            foreach ($_SESSION as $key => $value) {
                if (strpos($key, 'input') !== false) {
                    unset($_SESSION[$key]);
                }
            }
        } else {
            unset($_SESSION[$var_name]);
        }
    }
}
