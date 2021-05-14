<?php
require('controller/frontend_controller.php');
require('controller/backend_controller.php');
session_start();
try {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } elseif (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = null;
    }

    if ($action === 'signup') {
        signup_page();
    } elseif ($action === 'submit_signup') {
        if (!empty($_POST['username_input']) && !empty($_POST['password_input']) && !empty($_POST['password2_input']) && !empty($_POST['email_input'])) {
            submit_signup($_POST['username_input'], $_POST['password_input'], $_POST['password2_input'], $_POST['email_input']);
        } else {
            signup_page();
        }
    } elseif ($action === 'login') {
        // todo add error (fields required)
        login_page();
    } elseif ($action === 'submit_login') {
        if (!empty($_POST['username_input']) && !empty($_POST['password_input'])) {
            submit_login($_POST['username_input'], $_POST['password_input']);
        } else {
            login_page();
        }
    } elseif ($action === 'logout') {
        logout();
    } else {
        main_page();
    }

}
catch (Exception $e) {
    // todo create view for error display
    echo 'Error: ' . $error_msg = $e->getMessage();
}