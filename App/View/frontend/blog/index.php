<?php
$page_title = '';
ob_start();
?>
<div class="container mt-4">
    <p class="blog_line_add">
        <a href="index.php?action=post-create" id="create_link">Write a post</a>
    </p>
</div>
<?php
if (isset($posts)) {
    foreach ($posts as $post) {
        echo '<div class="container mt-4 blog_post_div">';
        echo '<p class="blog_line_title">';
        echo '[' . $post->getUpdatedDate() . ']<a class="blog_post_title" href="index.php?action=post-display-' . $post->getId() . '">'  . $post->getTitle() . '</a>';
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            echo '<span class="post_link"><a href="index.php?action=post-edit-' . $post->getId() . '" class="post_link_a post_link_edit">&#9998;</a>';
            echo '<a href="#" onclick="alertMsg('.$post->getId().', \'post\')" class="post_link_a post_link_delete">&#10007;</a></span>';
        }
        echo '</p>';
        echo '<p class="blog_line_description">' . $post->getReadingTime() . 'min · ' . $post->getHeader() . '</p>';
        echo '</div>';
    }
}

$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
