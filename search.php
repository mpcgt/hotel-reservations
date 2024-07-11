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
    $sql = $pdo -> query("SELECT * FROM rooms");
    $rooms = $sql -> fetchAll();
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
    <h1>Réserver une chambre</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card">
      <img src="./images/1.jpeg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Chanbre n°1</h5>
        <p class="card-text">Une chanbre magnifique, très lumineux avec une belle vue. ☀️</p>
        <button type="button" class="btn btn-outline-success">Réserver</button>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="./images/2.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Chanbre n'°2</h5>
        <p class="card-text">Une chanbre magnifique, très lumineux avec une belle vue. ☀️</p>
        <button type="button" class="btn btn-outline-success">Réserver</button>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="./images/3.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Chambre n°3</h5>
        <p class="card-text">Une chanbre magnifique, très lumineux avec une belle vue sur toute la ville. ☀️</p>
        <button type="button" class="btn btn-outline-success">Réserver</button>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="./images/4.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Chambre n°4</h5>
        <p class="card-text">Une chanbre magnifique, une belle vue avec les poissons et des dauphins. 🦈</p>
        <button type="button" class="btn btn-outline-success">Réserver</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>