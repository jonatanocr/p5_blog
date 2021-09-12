<?php
ob_start();
?>
<h1 class="mt-4 mb-4"><?= htmlspecialchars($post_data['post']->getTitle()); ?></h1>
<div class="row">
    <p class="post_line_header"><?= '[' . htmlspecialchars($post_data['post']->getUpdatedDate()) . '] ' . htmlspecialchars($post_data['post_author']->getUsername()); ?></p>
    <p class="post_line_header"><?= $post_data['post']->getReadingTime() . 'min · ' . htmlspecialchars($post_data['post']->getHeader()); ?></p>
    <p class="post_line_content mt-4"><?= $post_data['post']->getContent(); ?></p>
</div>
<div class="row comments_div">
    <h3 class="mt-3 mb-3">&#10098;Comments&#10099;</h3>
    <?php foreach ($post_data['comments'] as $comment) {
        if ($comment->getVerified() === 1) { ?>
            <p class="comments_line"><span class="comment_infos">
            <?= '[' . htmlspecialchars($comment->getCreatedDate()) . '] ' . htmlspecialchars($comment->getAuthor()->getUsername()) . ':</span> ' . htmlspecialchars($comment->getContent()); ?>
            </p>
        <?php }
    } ?>

    <form action="index.php?action=comment-addComment-<?= $post_data['post']->getId(); ?>" method="post">
        <input type="hidden" name="token" value="<?= $session->getSession('token') ?? '' ?>">
        <div class="container">
            <p class="post_line_content mt-4">
            <textarea class="post_input" name="content_input" rows="3" placeholder="<?= (isset($session) && $session->getSession('id') !== NULL)?'Write a comment ..."':'Sign in to comment" disabled'; ?>></textarea>
            </p>
            <div class="form_submit_div mt-4" id="post_form_submit_div">
                <div class="form_submit_sub_div">
                    <?php
                    if (isset($session) && $session->getSession('id') !== NULL) { ?>
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
require ROOT . '/App/View/template.php';
?>
