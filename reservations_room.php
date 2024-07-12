<?php
session_start();
require 'config.php';

// Récupérer tous les utilisateurs dans la base des données
$sql = $pdo->query("SELECT * from users");
$users = $sql->fetchAll();

// Récupérer tous les livres dans la base des données
$sql = $pdo-> query("SELECT * FROM rooms");
$rooms = $sql->fetchAll();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users_id = $_POST['users_id'];
    $rooms_id = $_POST['rooms_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    $sql = $pdo->prepare("INSERT INTO `reservations`(users_id, rooms_id, start_date, end_date) VALUES (:users_id,:rooms_id,:start_date,:end_date)");
    $sql->execute(['users_id' => $users_id, 'rooms_id' => $rooms_id, 'start_date' => $start_date, 'end_date' => $end_date]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Réserver cette chambre</title>
    
</head>
<body>
    <h1 class="text-center fw-bold text-decoration-underline mb-3">Réserver cette chambre</h1>
    <div class="container">
    <a href="search.php" class="btn btn-success mb-3">Réserver une autre chambre</a>
    <form action="" method="POST">
        <div class="form-group">
            <label for="users_id">Votre nom d'utilisateur</label>
            <select class="form-control" id="users_id" name="users_id" required>
                <?php foreach ($users as $user) : ?>
                    <option value="<?= $user['id'] ?>"><?= $user['username']?></option>
                <?php endforeach; ?>
                </select>
                </div>
            <div class="form-group">
                <label for="rooms_id">Chambres disponibles</label>
                <select class="form-control" id="rooms_id" name="rooms_id" required>
                    <?php foreach ($rooms as $room) : ?>
                <option value="<?= $room['rooms_id'] ?>"><?= $room['title'] ?></option>
                <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Date de début</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Date de fin</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit" data-bs-toggle="modal" data-bs-target="#modal">Réserver</button>

                    <!-- Modal -->
                     <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modal">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
</div>
</div>
</body>
</html>