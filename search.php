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

    // Récupérer tous les chambres
    $sql = $pdo->query("SELECT * FROM rooms");
    $rooms = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Réserver une chambre</title>
</head>
<body>
    <h1 class="text-center fw-bold text-decoration-underline mb-5">Réserver une chambre</h1>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card">
      <?php foreach ($rooms as $room) : ?>
        <img src="<?= $room['image'] ?>" class="card-img-top" alt="Chambre n°1">
      <div class="card-body">
        <h5 class="card-title"><?= $room['title'] ?></h5>
        <p class="card-text"><?= $room['description'] ?></p>
        <button type="button" class="btn btn-outline-success">Réserver</button><span class="fs-5 ms-3"><?= $room['price'] ?></span>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
</div>
</body>
</html>