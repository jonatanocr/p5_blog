<?php
ob_start();
?>
<form action="index.php?action=post-confirmCreate" method="post">
    <div class="container">
        <p class="post_line_header mt-4 mb-4">
            <input class="post_input" type="text" id="post_input_title" name="title_input" placeholder="Title" required="required"
                <?= (isset($session) && $session->getSession('form') !== NULL)?' value="' . htmlspecialchars($session->getSession('form')["title"]) . '"':''; ?>
            >
        </p>
    </div>
    <div class="container">
        <p class="post_line_header">
            <select class="form-select" name="author_input" id="" required="required">
                <?php
                foreach ($authors as $authorId => $username) {
                    if ($authorId == $session->getSession('id')) { ?>
                        <option value="<?= htmlspecialchars($authorId); ?>" selected="selected"><?= htmlspecialchars($username); ?></option>
                    <?php } else { ?>
                        <option value="<?= htmlspecialchars($authorId); ?>"><?= htmlspecialchars($username); ?></option>
                    <?php }
                }
                ?>
            </select>
        </p>
        <p class="post_line_header mt-4">
            <input class="post_input" type="text" id="post_input_header" name="header_input" placeholder="Header" required="required"
                <?= (isset($session) && $session->getSession('form') !== NULL)?' value="' . htmlspecialchars($session->getSession('form')['header']) . '"':''; ?>
            >
        </p>
        <p class="post_line_content mt-4">
            <textarea class="post_input" name="content_input" rows="20" placeholder="Content" required="required">
                <?= (isset($session) && $session->getSession('form') !== NULL)?htmlspecialchars($session->getSession('form')['content']):''; ?>
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

