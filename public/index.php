<?php

session_start();

define('ROOT', dirname(__DIR__));

require ROOT.'/Core/Security/Session.php';
require ROOT.'/App/App.php';

$session = new Core\Security\Session();
if (filter_input(INPUT_GET, 'action')) {
    $action = explode('-', filter_input(INPUT_GET, 'action'));
} else {
    $action = 'homepage';
}

$app = new \App\App($action, $session);
$app->run();
