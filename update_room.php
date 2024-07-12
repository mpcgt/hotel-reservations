<?php
session_start();
require 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

// Vérifier si c'est le bon identifiant de cette chambre
if (isset($_GET['id'])) {
    $rooms_id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM rooms WHERE id = :id");
    $sql->execute(['id'=> $rooms_id]);
    $room = $sql->fetch();

    if(!$room) {
        echo "Désolé, nous n'avons pas trouvé cette chambre... :'(";
        exit;
    }
}

if($_SERVER["REQUEST_METHOD"] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $room['image']; // Remet l'ancienne image

    // Vérification d'un image envoyé
    if(!empty($_FILES['image']['name'])) {
        echo(basename($_FILES['image']['name']));
        $image = 'uploads/'. basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['name'],$image);
    }

    $sql = $pdo->prepare("UPDATE room` SET title = :title, description = :description, price = :price, image = :image WHERE id = :id");

    $sql->execute(['title' => $title, 'description' => $description, 'price' => $price, 'image' => $image, 'id' => $rooms_id]);

    header("Location : manage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Modifier une chambre</title>
</head>
<body>
<div class="container">
        <h1 class="text-center fw-bold text-decoration-underline mb-3">Gestion des chambres</h1>
        <a href="manage.php" class="btn btn-success mb-5">Retour à l'accueil</a>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Nom de cette chambre</label>
            <input class="form-control" type="text" name="title" id="title" value="<?= $room ['title'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description de cette chambre</label>
            <input class="form-control" type="text" name="description" id="description" value="<?= $room ['description'] ?>" required>
        </div>        
        <div class="form-group">
            <label for="price">Prix de cette chambre</label>
            <input class="form-control" type="number" name="price" id="price" value="<?= $room ['price'] ?>" required>
        </div>        
        <div class="form-group">
            <label for="title">Image de cette chambre</label>
            <input class="form-control" type="file" name="image" id="image" value="<?= $room ['image'] ?>" required>
        </div>
        <button class="btn btn-success mt-3" type="submit">Enregistrer</button>
</div>
</form>
</div>
</body>
</html>