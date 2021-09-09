<?php
$page_title = '';
ob_start();
if (isset($session) && $session->getSession('user_type') && $session->getSession('user_type') === 'admin') {
?>
<div class="container mt-4">
    <p class="blog_line_add">
        <a href="index.php?action=post-create" id="create_link">Write a post</a>
    </p>
</div>
<?php
}
if (isset($posts)) {
    foreach ($posts as $post) { ?>
        <div class="row mt-4 blog_post_div">
            <p class="blog_line_title">
                <a class="blog_post_title" href="index.php?action=post-display-<?php print_r($post->getId() . '">' . $post->getTitle()); ?></a>
            <?php
                if (isset($session) && $session->getSession('user_type') && $session->getSession('user_type') === 'admin') { ?>
                <span class="post_link"><a href="index.php?action=post-edit-<?php print_r($post->getId()); ?>" class="post_link_a post_link_edit">&#9998;</a>
                <a href="#" onclick="alertMsg(<?php print_r($post->getId()); ?>, 'post')" class="post_link_a post_link_delete">&#10007;</a></span>
                <?php } ?>
            </p>
            <p class="blog_line_description"><?php print_r($post->getUpdatedDate() . ' · ' . $post->getReadingTime() . 'min <span class="small_screen_hide">· </span><span class="small_screen_show"><br></span>' . $post->getHeader()); ?></p>
        </div>
    <?php }
}

$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
