<?php
require('../App/Model/UserManager.php');
require('../App/Entity/User.php');

class BackendController {
// todo delete this page
    public function submitSettings($settings) {
        if (isset($settings['password1'])) {
            if ($settings['password1'] === $settings['password2']) {
                $hashed_psw = password_hash($settings['password1'], PASSWORD_DEFAULT);
                $settings['hashed_psw'] = $hashed_psw;
            } else {
                header('Location: index.php?action=settings&pswnomatch=1');
            }
        }
        $update = updateUser($settings);
        if ($update > 0) {
            header('Location: index.php?update=1');
        } else {
            header('Location: index.php?action=settings&accountexist=1');
        }

    }

    public function delete_account($id) {
        delete_user($id);
        session_destroy();
        header('Location: index.php');
    }
}
