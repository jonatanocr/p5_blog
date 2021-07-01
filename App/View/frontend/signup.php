<?php
$page_title = 'Create new account';
ob_start();

if (isset($_GET['pswnomatch']) && $_GET['pswnomatch'] == 1) {?>
    <div class="alert alert-danger" role="alert">
        Les mots de passe ne sont pas identique!
    </div>
    <?php
} elseif (isset($_GET['accountexist']) && $_GET['accountexist'] == 1) {?>
    <div class="alert alert-danger" role="alert">
        Un compte existe déjà avec ces identifiants!
    </div>
    <?php
} ?>

<form action="index.php" method="post">
    <input name="action" type="hidden" value="submitSignup">
    <div class="form-group">
        <label for="username_input">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username_input" name="username_input">
    </div>
    <div class="form-group">
        <label for="password_input">Votre mot de passe</label>
        <input type="password" class="form-control" id="password_input" name="password_input">
    </div>
    <div class="form-group">
        <label for="password2_input">Répétez votre mot de passe</label>
        <input type="password" class="form-control" id="password2_input" name="password2_input">
    </div>
    <div class="form-group">
        <label for="email_input">Email</label>
        <input type="email" class="form-control" id="email_input" name="email_input" placeholder="Votre email">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<a href="index.php">Annuler</a>

<?php
$page_body = ob_get_clean();
require('template.php');
?>