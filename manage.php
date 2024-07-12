<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

// Ajout d'une chambre dans la base des données
if($_SERVER["REQUEST_METHOD"] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    if(!empty($_FILES['image']['name'])) {
        echo(basename($_FILES['image']['name']));
        $image = 'images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'],$image);
    }

    $sql = $pdo->prepare("INSERT INTO rooms (title,description,price,image) VALUES (:title, :description, :price, :image)");
    $sql->execute(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image]);
}

    $sql = $pdo->query("SELECT * FROM rooms");
    $rooms = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestion des chambres</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center fw-bold text-decoration-underline mb-3">Gestion des chambres</h1>
        <a href="home.php" class="btn btn-success mb-5">Retour à l'accueil</a>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Numéro de la chambre</label>
                <input class="form-control" type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description de la chambre</label>
                <input class="form-control" type="text" name="description" id="desription" required>
            </div>
            <div class="form-group">
                <label for="description">Prix de la chambre</label>
                <input class="form-control" type="number" name="price" id="price" required>
            </div>           
            <div class="form-group">
                <label for="description">Image de la chambre</label>
                <input class="form-control" type="file" name="image" id="image">
        </form>
            <button class="btn btn-primary mt-3" type="submit">Ajouter</button>
        </div>

        <h2 class="mt-5 text-center fw-bold text-decoration-underline mb-5">Listes des chambres</h2>
        <table class="table container">
            <thead>
                <tr>
                    <th>
                        Numéro de la chambre
                    </th>
                    <th>
                        Description de la chambre
                    </th>
                    <th>
                        Prix de la chambre
                    </th>
                    <th>
                        Image de la chambre
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room) : ?>
                    <tr>
                        <td>
                            <?= $room['title'] ?>
                        </td>
                        <td>
                            <?= $room['description'] ?>
                        </td>
                        <td>
                            <?= $room['price'] ?>
                        </td>
                        <td>
                            <img src="<?= $room['image'] ?>" alt="Image de la chambre" width="150">
                        </td>
                        <td>
                            <a href="" class="btn btn-warning">Modifier</a>
                            <a href="delete_book.php?id=<?= $book['id'] ?>" class="btn btn-danger">Supprimer</a>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</body>
</html>