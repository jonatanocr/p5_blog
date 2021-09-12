<?php
$page_title = '';
ob_start();
?>

<form class="register_form mt-5" action="index.php?action=contact-process" method="post">
    <div class="form-group">
        <label for="name_input">Your name</label>
        <input type="text" class="form-control" id="name_input" name="name_input" size="10" required="required"
            <?= (isset($session) && $session->getSession('form') !== NULL)?' value="' . htmlspecialchars($session->getSession('name_input')) . '"':''; ?>
        >
    </div>
    <div class="form-group mt-2">
        <label for="email_input">Your Email</label>
        <input type="email" class="form-control" id="email_input" name="email_input" required="required"
            <?= (isset($session) && $session->getSession('form') !== NULL)?' value="' . htmlspecialchars($session->getSession('email_input')) . '"':''; ?>
        >
    </div>
    <div class="form-group">
        <label for="message_input">Your message</label>
        <textarea name="message_input" class="form-control" id="message_input" rows="3" required="required"><?= (isset($session) && $session->getSession('form') !== NULL)?htmlspecialchars($session->getSession('message_input')):''; ?></textarea>
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

<div class="container mt-4" id="contact_social_links_bloc">
        <div class="icon_img">
            <a target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/in/jonatanbuzek/" title="linkedin">
                <img src="media/icon/in.png">
            </a>
        </div>
        <div class="icon_img">
            <a target="_blank" rel="noopener noreferrer" href="https://github.com/jonatanocr" title="gitHub">
                <img src="media/icon/GitHub-Mark-32px.png">
            </a>
        </div>
        <div class="icon_img">
            <a target="_blank" rel="noopener noreferrer" href="mailto:buzek.jonatan@gmail.com" title="buzek.jonatan@gmail.com">
                <img src="media/icon/email.png">
            </a>
        </div>
</div>

<?php
$page_body = ob_get_clean();
require ROOT . '/App/View/template.php';
?>
