<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title></title>
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
    <h1>Settings</h1>
    <?php
    if (isset($_GET['pswnomatch']) && $_GET['pswnomatch'] == 1) {?>
        <div class="alert alert-danger" role="alert">
            Les mots de passe ne sont pas identique!
        </div>
        <?php
    } elseif (isset($_GET['accountexist']) && $_GET['accountexist'] == 1) {?>
        <div class="alert alert-danger" role="alert">
            Un compte existe déjà avec ces identifiants!
        </div>
        <?php
    }
    ?>
    <form action="index.php" method="post">
        <input name="action" type="hidden" value="submit_settings">
        <div class="form-group">
            <label for="username_input">Username</label>
            <input type="text" class="form-control" id="username_input" name="username_input"
                   value="<?php echo isset($_SESSION['username'])?$_SESSION['username']:''; ?>">
        </div>
        <div class="form-group">
            <label for="password_input">New password</label>
            <input type="password" class="form-control" id="password_input" name="password_input">
        </div>
        <div class="form-group">
            <label for="password2_input">Repeat new password</label>
            <input type="password" class="form-control" id="password2_input" name="password2_input">
        </div>
        <div class="form-group">
            <label for="email_input">Email</label>
            <input type="email" class="form-control" id="email_input" name="email_input" placeholder="Votre email">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    <a href="index.php?action=delete_account" style="color:red;">Supprimer mon compte</a>
</div>

<footer class="text-center text-lg-start bg-light text-muted">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright: Jonatan Buzek
        <?php
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
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


