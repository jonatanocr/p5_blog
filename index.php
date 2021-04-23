<?php
require('controller/frontend.php');

try {
    if (isset($_POST['action'])) {

    } else {
        main_page();
    }
}
catch (Exception $e) {
    // todo create view for error display
    echo 'Error: ' . $error_msg = $e->getMessage();
}