<?php
$page_title = '';
ob_start();
if (isset($_GET['add']) && $_GET['add'] == 1) {
?>
    <div class="alert alert-success" role="alert">
        Votre compte a bien été créé
    </div>
<?php
}
?>
<div class="row mt-5 mb-5">
    <div class="col" style="text-align: center">
        <img src="media/me_sh_small.png" id="homepage_picture">
    </div>
    <div class="col">
        <p>Hi, I’m Jonatan, a web developer.</p>
        <p>I enjoy learning new skills in IT, building, and understanding things.</p>
        <p>Ex senior construction technician for 10 years, before graduating as professional diver,
        I currently rather dive deep in web projects using mainly PHP, Javascript, SQL, HTML, and CSS.
        I am also an open source enthusiast, and of course, a Linux user.</p>
        <p>Apart from coding, I enjoy hiking, workout, and martial arts.
            I have always been driven towards challenging my limits and improving my knowledge through hard work.</p>
        <p>Feel free to check-up my Projects and Resume section, which also includes my contact information.</p>
    </div>
</div>

<?php
$page_body = ob_get_clean();
require('template.php');
?>