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
}
