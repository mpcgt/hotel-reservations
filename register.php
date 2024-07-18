<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city_id = $_POST['city_id'];

    $hashed_password = password_hash($password,PASSWORD_DEFAULT);

    $sql = $pdo->prepare("INSERT INTO users (username,password,email,city_id) VALUES (:username, :password, :email, :city_id)");
    
    $sql->execute(['username' => $username, 'password' => $hashed_password, 'email' => $email, 'city_id' => $city_id]);
}


// Récupérer tous les utilisateurs dans la base des données
$sql = $pdo->query("SELECT * from city");
$cities = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>S'inscrire</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">S'inscrire</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <select class="form-control" id="city_id" name="city_id" required>
                <?php foreach ($cities as $city) : ?>
                    <option value="<?= $city['city_id'] ?>"><?= $city['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-success">S'inscrire</button>
        </form>
    </div>
</body>

</html>