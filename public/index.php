<?php

session_start();

define('ROOT', dirname(__DIR__));
require ROOT . '/Core/Security/Session.php';
use Core\Security\Session;
$session = new Session();

require ROOT.'/App/App.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $action = explode('-', $action);
} else {
    $action = 'homepage';
}

$app = new \App\App($action, $session);
$app->run();
