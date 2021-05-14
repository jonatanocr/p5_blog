<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1>Create new account</h1>
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
            <input name="action" type="hidden" value="submit_signup">
            <div class="form-group">
                <label for="username_input">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username_input" name="username_input">
            </div>
            <div class="form-group">
                <label for="password_input">Votre mot de passe</label>
                <input type="password" class="form-control" id="password_input" name="password_input">
            </div>
            <div class="form-group">
                <label for="password2_input">Répétez votre mot de passe</label>
                <input type="password" class="form-control" id="password2_input" name="password2_input">
            </div>
            <div class="form-group">
                <label for="email_input">Email</label>
                <input type="email" class="form-control" id="email_input" name="email_input" placeholder="Votre email">
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        <a href="index.php">Annuler</a>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>

