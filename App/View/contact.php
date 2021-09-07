<?php
$page_title = '';
ob_start();
?>

<form class="register_form mt-5" action="index.php?action=contact-process" method="post">
    <div class="form-group">
        <label for="name_input">Your name</label>
        <input type="text" class="form-control" id="name_input" name="name_input" size="10" required="required"
            <?php if (isset($_SESSION['form']['name'])) {
                echo ' value="' . htmlspecialchars($_SESSION['form']['name']) . '"';
            } ?>
        >
    </div>
    <div class="form-group mt-2">
        <label for="email_input">Your Email</label>
        <input type="email" class="form-control" id="email_input" name="email_input" required="required"
            <?php if (isset($_SESSION['form']['email'])) {
                echo ' value="' . htmlspecialchars($_SESSION['form']['email']) . '"';
            } ?>
        >
    </div>
    <div class="form-group">
        <label for="message_input">Your message</label>
        <textarea name="message_input" class="form-control" id="message_input" rows="3" required="required"
            ><?php if (isset($_SESSION['form']['message'])) {
                echo htmlspecialchars($_SESSION['form']['message']);
            }?></textarea>
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

<?php
$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
?>

