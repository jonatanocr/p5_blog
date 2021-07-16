<?php
$page_title = 'Se connecter';
ob_start();

if (isset($_GET['wrong_credential']) && $_GET['wrong_credential'] == 1) {?>
    <div class="alert alert-danger" role="alert">
        Les identifiants ne sont pas corrects!
    </div>
            <?php
        }
        ?>
        <form class="register_form mt-5" action="index.php" method="post">
            <input name="action" type="hidden" value="submit_login">
            <div class="form-group">

                <label for="username_input">Username</label>
                <input type="text" class="form-control" id="username_input" name="username_input"
                    <?php if (isset($_COOKIE["username"])) {
                    echo 'value="' . $_COOKIE["username"] . '"';
                    } ?>
                >
            </div>
            <div class="form-group mt-2">
                <label for="password_input">Password</label>
                <input type="password" class="form-control" id="password_input" name="password_input">
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="remember_me_input" name="remember_me_input" value="1">
                <!-- todo remember me feature -->
                <label class="form-check-label" for="remember_me_input">Remember me</label>
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
        <p id="register_page_link_p"><a id="register_page_link" href="index.php?action=user-register">Register</a> if you don't have an account yet.</p>
<?php
$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
?>

