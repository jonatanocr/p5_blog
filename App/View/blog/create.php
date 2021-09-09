<?php
ob_start();
?>
<form action="index.php?action=post-confirm_create" method="post">
    <div class="container">
        <p class="post_line_header mt-4 mb-4">
            <input class="post_input" type="text" id="post_input_title" name="title_input" placeholder="Title" required="required"
                <?php
                if (isset($session) && $session->getSession('form') !== NULL) {
                    print ' value="' . $session->getSession('form')["title"] . '"';
                } ?>
            >
        </p>
    </div>
    <div class="container">
        <p class="post_line_header">
            <select class="form-select" name="author_input" id="" required="required">
                <?php
                foreach ($authors as $authorId => $username) {
                    if ($authorId == $session->getSession('id')) { ?>
                        <option value="<?php print $authorId; ?>" selected="selected"><?php print $username; ?></option>
                    <?php } else { ?>
                        <option value="<?php print $authorId; ?>"><?php print $username; ?></option>
                    <?php }
                }
                ?>
            </select>
        </p>
        <p class="post_line_header mt-4">
            <input class="post_input" type="text" id="post_input_header" name="header_input" placeholder="Header" required="required"
                <?php if (isset($session) && $session->getSession('form') !== NULL) {
                    print ' value="' . $session->getSession('form')['header'] . '"';
                } ?>
            >
        </p>
        <p class="post_line_content mt-4">
            <textarea class="post_input" name="content_input" rows="20" placeholder="Content" required="required">
                <?php if (isset($session) && $session->getSession('form') !== NULL) {
                    print $session->getSession('form')['content'];
                } ?>
            </textarea>
        </p>
        <div class="form_submit_div mt-4" id="post_form_submit_div">
            <div class="form_submit_sub_div">
                <button type="submit" class="submit_form_btn btn btn-primary">Submit</button>
            </div>
            <div class="form_submit_sub_div">
                <a class="cancel_link" href="index.php?action=post-index">Cancel</a>
            </div>
        </div>
    </div>
</form>

<?php
$page_body = ob_get_clean();
$url =  ROOT . '/App/View/template.php';
require $url;
?>

