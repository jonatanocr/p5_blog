<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jonatan Buzek Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
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
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">CV</a>
                        </li>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=user-edit">Settings</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php if (!empty($_SESSION['success_msg'])) {?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success_msg'] ?>
                </div>
                <?php unset($_SESSION['success_msg']);
            }
            if (!empty($_SESSION['warning_msg'])) {?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $_SESSION['warning_msg'] ?>
                </div>
                <?php unset($_SESSION['warning_msg']);
            }
            if (!empty($_SESSION['error_msg'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error_msg'] ?>
                </div>
                <?php unset($_SESSION['error_msg']);
            }
            echo $page_body;
            ?>
        </div>
    </div>
    <footer class="text-center text-lg-start">
        <div class="text-center" id="footer_bloc">
            <div id="footer_txt">
            © 2021 Copyright: Jonatan Buzek
            <?php if (isset($_SESSION['username'])) { ?>
                <br>You're logged in as <span style="color: black">
                    <?php echo ucfirst($_SESSION['username']) ?>
                </span>
                <br><a href="index.php?action=user-logout" id="logout_link">Logout</a>

            <?php } else { ?>
                <a class="login_link" href="index.php?action=user-login">Login</a>
                <a class="login_link" href="index.php?action=user-register">Register</a>
            <?php }
            unset($_SESSION['form']);
            ?>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
