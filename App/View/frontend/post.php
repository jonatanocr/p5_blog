<?php
$page_title = $post->getTitle();
ob_start();
?>
<div class="container">
<p><?php echo $post->getContent() ?></p>
</div>
<div class="container">
    <?php foreach ($comments as $comment) {
      echo '<p>[' . $comment->getCreatedDate() . '] ' . $comment->getContent() . '</p>';
    }
    ?>
</div>
<?php
$page_body = ob_get_clean();
require('template.php');
?>