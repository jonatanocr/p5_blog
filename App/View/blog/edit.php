<?php
ob_start();
?>
<form action="index.php?action=post-confirm_edit-<?php print_r($post_data['post']->getId()); ?>" method="post">
    <div class="container">
        <p class="post_line_header mt-4 mb-4">
            <input class="post_input" type="text" id="post_input_title" name="title_input" value="<?php print_r($post_data['post']->getTitle()); ?>" required="required">
        </p>
    </div>
    <div class="container">
        <p class="post_line_header">
            <select class="form-select" name="author_input" id="" required="required">
                <?php foreach ($authors as $authorId => $username) {
                    if ($authorId == $post_data['post']->getFkAuthor()) { ?>
                        <option value="<?php print_r($authorId); ?>" selected="selected"><?php print_r($username); ?></option>
                    <?php } else { ?>
                        <option value="<?php print_r($authorId); ?>"><?php print_r($username); ?></option>
                    <?php }
                    } ?>
            </select>
        </p>
        <p class="post_line_header mt-4">
            <input class="post_input" type="text" id="post_input_header" name="header_input" value="<?php print_r($post_data['post']->getHeader()); ?>" required="required">
        </p>
        <p class="post_line_content mt-4">
            <textarea class="post_input" name="content_input"
                      rows="20" required="required"><?php print_r($post_data['post']->getContent()); ?></textarea>
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
<div class="container comments_div">
    <h3 class="mt-3 mb-3">&#10098;Comments&#10099;</h3>
        <?php foreach ($post_data['comments'] as $comment) { ?>
            <p class="comments_line">
                <a href="index.php?action=comment-<?php print_r(($comment->getVerified() === 1?'invalidate':'validate') . '-' . $comment->getId()); ?>" class="post_link_a post_link_edit">
                    <?php print_r(($comment->getVerified() === 1?'&#9745;':'&#9744;')); ?>
                </a>
                <a href="#" onclick="alertMsg(<?php print_r($comment->getId()); ?>, 'comment')" class="post_link_a post_link_delete" style="margin-right: 0.5em;">&#10007;</a>
                <span class="comment_infos"><?php print_r('[' . $comment->getCreatedDate() . ']' . htmlspecialchars($comment->getAuthor()->getUsername())); ?>:</span>
                <?php print_r(htmlspecialchars($comment->getContent())); ?>
            </p>
    <?php } ?>
</div>

<?php
$page_body = ob_get_clean();
$url =  ROOT . '/App/View/template.php';
require $url;
?>
