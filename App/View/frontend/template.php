<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jonatan Buzek Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
        <div class="container" id="navbar_container">
            <a href="#" class="navbar-brand d-flex w-50 me-auto">Jonatan Buzek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
                <span id="navbar_span"></span>
                <ul class="navbar-nav w-100 justify-content-center">
                    <li class="nav-item active" id="navitem_home">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CV</a>
                    </li>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=settings">Settings</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center"><?php echo $page_title; ?></h1>
        <?php
        echo $page_body;
        ?>
    </div>

    <footer class="text-center text-lg-start bg-light text-muted">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright: Jonatan Buzek
            <?php
            if (isset($_SESSION['username'])) {
                echo '<br>Vous êtes connecté en tant que <span style="color: black">' . ucfirst($_SESSION['username']) . '</span>';
                echo '<br><a href="index.php?action=logout" id="logout_link">Logout</a>';
            } else {
                echo '<a href="index.php?action=login" id="login_link">Login</a>';
            }
            ?>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>


