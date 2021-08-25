<?php
ob_start();
?>
<form action="index.php?action=post-confirm_edit-<?php echo $post_data['post']->getId(); ?>" method="post">
    <div class="container">
        <p class="post_line_header mt-4 mb-4">
            <input class="post_input" type="text" id="post_input_title" name="title_input" value="<?php echo $post_data['post']->getTitle(); ?>" required="required">
        </p>
    </div>
    <div class="container">
        <p class="post_line_header">
            <select class="form-select" name="author_input" id="" required="required">
                <?php
                foreach ($authors as $id => $username) {
                    if ($id == $post_data['post']->getFkAuthor()) {
                        echo '<option value="' . $id . '" selected="selected">' . $username . '</option>';
                    } else {
                        echo '<option value="' . $id . '">' . $username . '</option>';
                    }
                }
                ?>
            </select>
        </p>
        <p class="post_line_header mt-4">
            <input class="post_input" type="text" id="post_input_header" name="header_input" value="<?php echo $post_data['post']->getHeader(); ?>" required="required">
        </p>
        <p class="post_line_content mt-4">
            <textarea class="post_input" name="content_input"
                      rows="20" required="required"><?php echo $post_data['post']->getContent(); ?></textarea>
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
        <?php foreach ($post_data['comments'] as $comment) {
            echo '<p class="comments_line">';
            if ($comment->getVerified() === 1) {
                echo '<a href="index.php?action=comment-invalidate-' . $comment->getId() . '" class="post_link_a post_link_edit">&#9745;</a>';
            } else {
                echo '<a href="index.php?action=comment-validate-' . $comment->getId() . '" class="post_link_a post_link_edit">&#9744;</a>';
            }
            echo '<a href="#" onclick="alertMsg('.$comment->getId().', \'comment\')" class="post_link_a post_link_delete" style="margin-right: 0.5em;">&#10007;</a>';
            echo '<span class="comment_infos">[' . $comment->getCreatedDate() . '] ' . $comment->getAuthor()->getUsername() . ':</span> ' . $comment->getContent();
            echo '</p>';
        }
        ?>
</div>

<?php
$page_body = ob_get_clean();
require(ROOT . '/App/View/template.php');
?>