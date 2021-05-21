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
            submit_login($_POST['username_input'], $_POST['password_input'], $_POST["remember_me_input"]);
        } else {
            login_page();
        }
    } elseif ($action === 'settings') {
        settings_page();
    } elseif ($action === 'submit_settings') {
        if (isset($_POST['username_input'])) {
            $new_settings['username'] = $_POST['username_input'];
            $new_settings['id'] = $_SESSION['id'];
            if (isset($_POST['password_input'])) {
                $new_settings['password1'] = $_POST['password_input'];
            }
            if (isset($_POST['password2_input'])) {
                $new_settings['password2'] = $_POST['password2_input'];
            }
            if (isset($_POST['email_input'])) {
                $new_settings['email'] = $_POST['email_input'];
            }
            submit_settings($new_settings);
        } else {
            // todo add error ?
            settings_page();
        }
    } elseif ($action === 'logout') {
        logout();
    } elseif ($action === 'delete_account') {
        delete_account($_SESSION['id']);
    } else {
        main_page();
    }

}
catch (Exception $e) {
    // todo create view for error display
    echo 'Error: ' . $error_msg = $e->getMessage();
}