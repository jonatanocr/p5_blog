<?php
$page_title = $post['title'];
ob_start();
?>
<div class="container">
<p><?php echo $post['content'] ?></p>
</div>



<?php
$page_body = ob_get_clean();
require('template.php');
?>