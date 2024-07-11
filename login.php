<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $pdo->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
    $sql->execute(['username'=> $username, 'password' => $password]);
    $user = $sql->fetch();
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: search.php");
    } else {
        $error = "L'identifiant ou le mot de passe sont incorrects : :'(";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Se connecter</title>
</head>
<body>
    <div class="container">
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
            <?php } ?>
            <h1 class="mt-5">Connexion</h1>
            <form method="POST" action="">
                <div class="form-group">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</body>
</html>