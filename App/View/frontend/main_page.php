<?php
$page_title = 'Welcome page';
ob_start();
if (isset($_GET['add']) && $_GET['add'] == 1) {
?>
    <div class="alert alert-success" role="alert">
        Votre compte a bien été créé
    </div>
<?php
}

$page_body = ob_get_clean();
require('template.php');
?>





