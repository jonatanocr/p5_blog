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
