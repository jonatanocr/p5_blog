<?php
$page_title = 'Create new account';
ob_start();
?>

<form class="register_form mt-5" action="index.php?action=user-confirm_register" method="post">
    <div class="form-group">
        <label for="username_input">Username</label>
        <input type="text" class="form-control" id="username_input" name="username_input" size="10" required="required"
            <?php if (isset($session) && $session->getSession('form') !== NULL) {
                print ' value="' . htmlspecialchars($session->getSession('form')['username']) . '"';
            } ?>
        >
    </div>
    <div class="form-group mt-2">
        <label for="password_input">Password</label>
        <input type="password" class="form-control" id="password_input" name="password_input" minlength="8" required="required" onfocusout="passwordsMatchCheck();">
    </div>
    <div class="form-group mt-2">
        <label for="password2_input">Repeat password</label>
        <input type="password" class="form-control" id="password2_input" name="password2_input" minlength="8" required="required" onfocusout="passwordsMatchCheck();">
    </div>
    <div class="form-group mt-2">
        <label for="email_input">Email</label>
        <input type="email" class="form-control" id="email_input" name="email_input" required="required"
            <?php if (isset($session) && $session->getSession('form') !== NULL) {
                print ' value="' . htmlspecialchars($session->getSession('form')['email']) . '"';
            } ?>
        >
    </div>
    <div class="form_submit_div mt-4">
        <div class="form_submit_sub_div">
            <button type="submit" id="btn_submit" class="submit_form_btn btn btn-primary">Submit</button>
        </div>
        <div class="form_submit_sub_div">
            <a class="cancel_link" href="index.php">Cancel</a>
        </div>
    </div>
</form>
<div class="alert alert-danger" role="alert" id="alert_password" style="display: none;">
    Password did not match <br> (˘︹˘)
</div>
<?php
$page_body = ob_get_clean();
$url = ROOT . '/App/View/template.php';
require $url;
?>
