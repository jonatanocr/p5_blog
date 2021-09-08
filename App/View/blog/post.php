<?php
ob_start();
?>
<h1 class="mt-4 mb-4"><?php print_r($post_data['post']->getTitle())); ?></h1>
<div class="row">
    <p class="post_line_header"><?php print_r('[' . $post_data['post']->getUpdatedDate() . '] ' . $post_data['post_author']->getUsername()); ?></p>
    <p class="post_line_header"><?php print_r($post_data['post']->getReadingTime() . 'min · ' . $post_data['post']->getHeader()); ?></p>
    <p class="post_line_content mt-4"><?php print_r($post_data['post']->getContent()); ?></p>
</div>
<div class="row comments_div">
    <h3 class="mt-3 mb-3">&#10098;Comments&#10099;</h3>
    <?php foreach ($post_data['comments'] as $comment) {
        if ($comment->getVerified() === 1) { ?>
            <p class="comments_line"><span class="comment_infos">
            <?php print_r('[' . $comment->getCreatedDate() . '] ' . htmlspecialchars($comment->getAuthor()->getUsername()) . ':</span> ' . htmlspecialchars($comment->getContent())); ?>
            </p>
        <?php }
    } ?>

    <form action="index.php?action=comment-add_comment-<?php print_r($post_data['post']->getId()); ?>" method="post">
        <div class="container">
            <p class="post_line_content mt-4">
            <textarea class="post_input" name="content_input" rows="3" placeholder="<?php print_r(isset($_SESSION['id'])?'Write a comment ..."':'Sign in to comment" disabled'); ?>></textarea>
            </p>
            <div class="form_submit_div mt-4" id="post_form_submit_div">
                <div class="form_submit_sub_div">
                    <?php
                    if (isset($_SESSION['id'])) { ?>
                        <button type="submit" class="submit_form_btn btn btn-primary">Submit</button>
                    <?php } else { ?>
                        <button type="submit" class="submit_form_btn btn btn-primary" disabled>Submit</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
?>
