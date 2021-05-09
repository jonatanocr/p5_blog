<?php
require('controller/frontend_controller.php');
require('controller/backend_controller.php');

try {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } elseif (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = null;
    }

    if ($action === 'sign_up') {
        sign_up_page();
    } elseif ($action === 'submit_sign_up') {
        if (isset($_POST['username_input']) && isset($_POST['password_input']) && isset($_POST['password2_input']) && isset($_POST['email_input'])) {
            submit_sign_up($_POST['username_input'], $_POST['password_input'], $_POST['password2_input'], $_POST['email_input']);
        } else {
            sign_up_page();
        }
    } else {
        main_page();
    }

}
catch (Exception $e) {
    // todo create view for error display
    echo 'Error: ' . $error_msg = $e->getMessage();
}