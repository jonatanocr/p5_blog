<?php

session_start();

define('ROOT', dirname(__DIR__));
$url = ROOT . '/Core/Security/Session.php';
require $url;
use Core\Security\Session;
$session = new Session();

$url = ROOT.'/App/App.php';
require $url;

if (filter_input(INPUT_GET, 'action')) {
    $action = explode('-', filter_input(INPUT_GET, 'action'));
} else {
    $action = 'homepage';
}

$app = new \App\App($action, $session);
$app->run();
