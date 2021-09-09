<?php

session_start();

define('ROOT', dirname(__DIR__));
require ROOT . '/Core/Security/Session.php';
use Core\Security\Session;
$session = new Session();

require ROOT.'/App/App.php';

if (filter_input(INPUT_GET, 'action')) {
    $action = explode('-', filter_input(INPUT_GET, 'action'));
} else {
    $action = 'homepage';
}

$app = new \App\App($action, $session);
$app->run();
