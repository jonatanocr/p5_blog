<?php
ob_start();
?>
<h1 class="mt-4 mb-4"><?php echo $post_data['post']->getTitle(); ?></h1>
<div class="container">
    <p class="post_line_header"><?php echo '[' . $post_data['post']->getUpdatedDate() . '] ' . $post_data['post_author']->getUsername(); ?></p>
    <p class="post_line_header"><?php echo $post_data['post']->getReadingTime() . 'min · ' . $post_data['post']->getHeader(); ?></p>
    <p class="post_line_content mt-4"><?php echo $post_data['post']->getContent(); ?></p>
</div>
<div class="container comments_div">
    <h3 class="mt-3 mb-3">&#10098;Comments&#10099;</h3>

    <?php foreach ($post_data['comments'] as $comment) {
      echo '<p class="comments_line"><span class="comment_infos">[' . $comment->getCreatedDate() . '] ' . $comment->UserCreate->getUsername() . ':</span> ' . $comment->getContent() . '</p>';
    }
    ?>
</div>
<?php
$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
?>