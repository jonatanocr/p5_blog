<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Jonatan Buzek Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="css/style_768px.css" />
    <link rel="icon" type="image/png" href="media/icon/favicon.ico"/>

</head>
<body>
    <div class="container-sm" id="page_bloc">
        <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
            <div class="container" id="navbar_container">
                <a href="index.php" class="navbar-brand d-flex w-50 me-auto">Jonatan Buzek</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
                    <span id="navbar_span"></span>
                    <ul class="navbar-nav w-100 justify-content-end">
                        <li class="nav-item" id="navitem_home">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=post-index">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=contact-form">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a target="_blank" rel="noopener noreferrer" class="nav-link" href="media/CV_Jonatan_Buzek.pdf">Resume</a>
                        </li>
                        <?php if (isset($session) && $session->getSession('username') !== NULL) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=user-edit">Settings</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php if (isset($session) && !empty($session->getSession('success_msg'))) {?>
                <div class="alert alert-success" role="alert">
                    <?= $session->getSession('success_msg'); ?>
                </div>
                <?php $session->delete('success_msg');
            }
            if (isset($session) && !empty($session->getSession('warning_msg'))) {?>
                <div class="alert alert-warning" role="alert">
                    <?= $session->getSession('warning_msg'); ?>
                </div>
                <?php $session->delete('warning_msg');
            }
            if (isset($session) && !empty($session->getSession('error_msg'))) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $session->getSession('error_msg'); ?>
                </div>
                <?php $session->delete('error_msg');
            }?>
            <?= $page_body; ?>
        </div>
        <div id="separator" style="font-size: 3em;">&nbsp;</div>
    </div>
    <footer class="text-center text-lg-start">
        <div class="text-center" id="footer_bloc">
            <div id="social_links_bloc">
                <div class="icon_img">
                    <a target="_blank" rel="noopener noreferrer" href="https://www.linkedin.com/in/jonatanbuzek/" title="linkedin">
                        <img src="media/icon/in.png">
                    </a>
                </div>
                <div class="icon_img">
                    <a target="_blank" rel="noopener noreferrer" href="https://github.com/jonatanocr" title="gitHub">
                        <img src="media/icon/GitHub-Mark-32px.png">
                    </a>
                </div>
                <div class="icon_img">
                    <a target="_blank" rel="noopener noreferrer" href="mailto:buzek.jonatan@gmail.com" title="buzek.jonatan@gmail.com">
                        <img src="media/icon/email.png">
                    </a>
                </div>
            </div>
            <div id="footer_txt">
            © 2021 Copyright: Jonatan Buzek
            <?php if (isset($session) && $session->getSession('username') !== NULL) { ?>
                <br>You're logged in as <span style="color: black">
                    <?= htmlspecialchars(ucfirst($session->getSession('username'))); ?>
                </span>
                <a href="index.php?action=user-logout" id="logout_link"> · Logout</a>

            <?php } else { ?>
                    <br>
                <a class="login_link" href="index.php?action=user-login">Login</a>
                <a class="login_link" href="index.php?action=user-register">Register</a>
            <?php }
            if (isset($session)) {
                $session->delete('form');
            }
            ?>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
