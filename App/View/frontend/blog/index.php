<?php
$page_title = '';
ob_start();

foreach ($posts as $post) {
    echo '<div class="container mt-4 blog_post_div">';
    echo '<p class="blog_line_title">[' . $post->getUpdatedDate() . ']<a class="blog_post_title" href="index.php?action=post-display&id=' . $post->getId() . '">'  . $post->getTitle() . '</a></p>';
    echo '<p class="blog_line_description">' . $post->getReadingTime() . 'min · ' . $post->getHeader() . '</p>';
    echo '</div>';
}

$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
