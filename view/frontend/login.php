<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1>Se connecter</h1>
        <?php
        if (isset($_GET['wrong_credential']) && $_GET['wrong_credential'] == 1) {?>
            <div class="alert alert-danger" role="alert">
                Les identifiants ne sont pas corrects!
            </div>
            <?php
        }
        ?>
        <form action="index.php" method="post">
            <input name="action" type="hidden" value="submit_login">
            <div class="form-group">

                <label for="username_input">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username_input" name="username_input"
                    <?php if (isset($_COOKIE["username"])) {
                    echo 'value="' . $_COOKIE["username"] . '"';
                    } ?>
                >
            </div>
            <div class="form-group">
                <label for="password_input">Votre mot de passe</label>
                <input type="password" class="form-control" id="password_input" name="password_input">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember_me_input" name="remember_me_input" value="1">
                <label class="form-check-label" for="remember_me_input">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        <a href="index.php">Annuler</a>
        <p>Pas encore de compte ? <a href="index.php?action=signup">Créer un compte</a></p>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>

