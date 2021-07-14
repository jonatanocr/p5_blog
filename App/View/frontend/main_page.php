<?php
$page_title = 'Welcome page';
ob_start();
if (isset($_GET['add']) && $_GET['add'] == 1) {
?>
    <div class="alert alert-success" role="alert">
        Votre compte a bien été créé
    </div>
    <div class="container" style="background-color: red">
<?php
}
foreach ($posts as $post) {
    echo '<div class="container">';
    echo '<p>[' . $post['date'] . '] <a href="index.php?action=post-display&id=' . $post['id'] . '" style="text-decoration: none">'  . $post['title'] . '</a></p>';
    echo '</div>';
}

?>
    </div>
<?php
$page_body = ob_get_clean();
require('template.php');
?>





