<?php
ob_start();
?>

<form class="register_form mt-5" action="index.php?action=user-confirmLogin" method="post">
    <div class="form-group">
        <label for="username_input">Username</label>
        <input type="text" class="form-control" id="username_input" name="username_input" required="required">
    </div>
    <div class="form-group mt-2">
        <label for="password_input">Password</label>
        <input type="password" class="form-control" id="password_input" name="password_input" required="required">
    </div>
    <div class="form_submit_div mt-4">
        <div class="form_submit_sub_div">
            <button type="submit" class="submit_form_btn btn btn-primary">Submit</button>
        </div>
        <div class="form_submit_sub_div">
            <a class="cancel_link" href="index.php">Cancel</a>
        </div>
    </div>
</form>
<p id="register_page_link_p"><a id="register_page_link" href="index.php?action=user-register">Register</a> if you don't have an account yet.</p>

<?php
$page_body = ob_get_clean();
require ROOT . '/App/View/template.php';
?>
