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

<form class="register_form mt-5" action="index.php" method="post">
    <input name="action" type="hidden" value="submitSignup">
    <div class="form-group">
        <label for="username_input">Username</label>
        <input type="text" class="form-control" id="username_input" name="username_input" size="10">
    </div>
    <div class="form-group mt-2">
        <label for="password_input">Password</label>
        <input type="password" class="form-control" id="password_input" name="password_input">
    </div>
    <div class="form-group mt-2">
        <label for="password2_input">Repeat password</label>
        <input type="password" class="form-control" id="password2_input" name="password2_input">
    </div>
    <div class="form-group mt-2">
        <label for="email_input">Email</label>
        <input type="email" class="form-control" id="email_input" name="email_input">
    </div>
    <div class="register_form_validation_div mt-4">
        <div class="register_form_validation_sub_div">
            <button type="submit" class="register_form_btn btn btn-primary">Submit</button>
        </div>
        <div class="register_form_validation_sub_div">
            <a class="cancel_link" href="index.php">Cancel</a>
        </div>
    </div>
</form>

<?php
$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
?>