<?php
$page_title = 'Settings';
ob_start();
?>

<form action="index.php" method="post">
    <input name="action" type="hidden" value="submitSettings">
    <div class="form-group">
        <label for="username_input">Username</label>
        <input type="text" class="form-control" id="username_input" name="username_input"
               value="<?php echo isset($_SESSION['username'])?$_SESSION['username']:''; ?>">
    </div>
    <div class="form-group">
        <label for="password_input">New password</label>
        <input type="password" class="form-control" id="password_input" name="password_input">
    </div>
    <div class="form-group">
        <label for="password2_input">Repeat new password</label>
        <input type="password" class="form-control" id="password2_input" name="password2_input">
    </div>
    <div class="form-group">
        <label for="email_input">Email</label>
        <input type="email" class="form-control" id="email_input" name="email_input" placeholder="Votre email">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<a href="index.php?action=delete_account" style="color:red;">Supprimer mon compte</a>

    <?php
    $page_body = ob_get_clean();
    require('template.php');
    ?>