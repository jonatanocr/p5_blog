<?php

session_start();

define('ROOT', dirname(__DIR__));
require ROOT.'/App/App.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $action = explode('-', $action);
} else {
    $action = 'homepage';
}

$app = new \App\App($action);
$app->run();

/* todo
- footer pas fix
- comment rename fkAuthor
- fermer pdo/query a la fin a chaque fois
- in constructor add id param and if exist direct load object
- stop pdo fetchObject usage -> hydrate function
- restrict admin pages and user edit
- respondive design
- delete user -> delete also comm and post
- enlever le user verified -> comment sont validés donc pas besoin
- dashboard page for admin (user and comment waiting for validation)
 */
