<?php

namespace App;

use Autoloader;

class App
{
    protected $action;

    public function __construct($action) {
        $this->action = $action;
    }

    public function run() {
        session_start();
        require ROOT.'/core/Autoloader.php';
        $autoloader = new Autoloader();
        $autoloader->register();

        $controllerName = 'App\Controller\\'.ucfirst($this->action[0]).'Controller';
        $controllerAction = $this->action[1];
        $controller = new $controllerName;
        $controller->$controllerAction();
    }
}