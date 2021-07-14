<?php
define('ROOT', dirname(__DIR__));
require ROOT.'/App/App.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'post-index';
}
$action = explode('-', $action);

$app = new \App\App($action);
$app->run();





//require('../App/Controller/frontend_controller.php');
//require('../App/Controller/BackendController.php');



    /*
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } elseif (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = null;
    }
*/
    /*
    if ($action === 'signup') {
        signup_page();
    } elseif ($action === 'submitSignup') {
        if (!empty($_POST['username_input']) && !empty($_POST['password_input']) && !empty($_POST['password2_input']) && !empty($_POST['email_input'])) {
            $back = new BackendController;
            $back->submitSignup($_POST['username_input'], $_POST['password_input'], $_POST['password2_input'], $_POST['email_input']);
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
    } elseif ($action === 'submitSettings') {
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
            $backendController = new BackendController;
            $backendController->submitSettings($new_settings);
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
    */

