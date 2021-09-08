<?php

namespace App;

require ROOT . '/Core/Security/Session.php';
use Autoloader;
use Core\Security\Session;

class App
{
    protected $action;
    protected $db;
    protected $session;

    public function __construct($action) {
        $this->action = $action;
        $this->db = new \PDO('mysql:host=localhost;dbname=blog_jonatan;charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        $this->session = new Session();
    }

    public function run() {
        if ($this->action === 'homepage') {
            require(ROOT . '/App/View/homepage.php');
        } else {
            require ROOT . '/Core/Autoloader.php';
            $autoloader = new Autoloader();
            $autoloader->register();

            $controllerName = 'App\Controller\\'.ucfirst($this->action[0]).'Controller';
            $controllerAction = $this->action[1];
            $controller = new $controllerName($this->db);
            $id = !empty($this->action[2])?$this->action[2]:null;
            $controller->$controllerAction($id);
        }
    }
}
