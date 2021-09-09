<?php
$page_title = 'Settings';
?>

<form class="register_form mt-5" action="index.php?action=user-confirm_edit" method="post">
    <input name="action" type="hidden" value="submitSignup">
    <div class="form-group">
        <label for="username_input">Username</label>
        <input type="text" class="form-control" id="username_input" name="username_input" size="10" required="required"
                <?= (isset($session) && $session->getSession('username') !== NULL)?' value="' . htmlspecialchars($session->getSession('username')) . '"':''; ?>
        >
    </div>
    <div class="form-group mt-2">
        <label for="password_input">Password</label>
        <input type="password" class="form-control" id="password_input" name="password_input" minlength="8" onfocusout="passwordsMatchCheck();">
    </div>
    <div class="form-group mt-2">
        <label for="password2_input">Repeat password</label>
        <input type="password" class="form-control" id="password2_input" name="password2_input" minlength="8" onfocusout="passwordsMatchCheck();">
    </div>
    <div class="form-group mt-2">
        <label for="email_input">Email</label>
        <input type="email" class="form-control" id="email_input" name="email_input" required="required"
                <?= (isset($session) && $session->getSession('email') !== NULL)?' value="' . htmlspecialchars($session->getSession('email')) . '"':''; ?>
        >
    </div>
    <div class="form_submit_div mt-4">
        <div class="form_submit_sub_div">
            <button type="submit" class="submit_form_btn btn btn-primary" id="btn_submit">Submit</button>
        </div>
        <div class="form_submit_sub_div">
            <a class="cancel_link" href="index.php">Cancel</a>
        </div>
    </div>
</form>
<div class="alert alert-danger" role="alert" id="alert_password" style="display: none;">
    Password did not match <br> (˘︹˘)
</div>
<div class="container mt-5 mb-5 text-center">
    <a href="#" id="delete_user_link" onclick="alertMsg(<?= (isset($session) && $session->getSession('id') !== NULL)?htmlspecialchars($session->getSession('id')):''; ?>, 'user')">Delete my account</a>
</div>

<?php
$page_body = ob_get_clean();
$url = ROOT . '/App/View/template.php';
require $url;
?>
