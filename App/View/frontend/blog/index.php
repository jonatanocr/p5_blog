<?php
$page_title = '';
ob_start();
?>
<script>
function myFunction(id) {
    if (confirm("Are you sure you want to delete this post?")) {
        var link = 'index.php?action=post-delete-';
        window.location.href = link.concat(id);
    }
}
</script>
<?php
if (isset($posts)) {
    foreach ($posts as $post) {
        echo '<div class="container mt-4 blog_post_div">';
        echo '<p class="blog_line_title">';
        echo '[' . $post->getUpdatedDate() . ']<a class="blog_post_title" href="index.php?action=post-display&id=' . $post->getId() . '">'  . $post->getTitle() . '</a>';
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
            echo '<span class="post_link"><a href="index.php?action=post-edit-' . $post->getId() . '" class="post_link_a post_link_edit">&#9998;</a>';
            //echo '<a href="index.php?action=post-delete-' . $post->getId() . '" class="post_link_a post_link_delete">&#10007;</a></span>';
            echo '<a href="#" onclick="myFunction('.$post->getId().')" class="post_link_a post_link_delete">&#10007;</a></span>';
        }
        echo '</p>';
        echo '<p class="blog_line_description">' . $post->getReadingTime() . 'min · ' . $post->getHeader() . '</p>';
        echo '</div>';
    }
}

$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
