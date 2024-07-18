<?php
session_start();
require 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sql = $pdo->query("SELECT r.id, u.username, ro.title AS rooms, r.start_date, r.end_date, c.name AS city 
                    FROM reservations AS r 
                    JOIN users AS u ON r.users_id = u.id 
                    JOIN rooms AS ro ON r.rooms_id = ro.rooms_id
                    JOIN city as c ON c.city_id = u.city_id
                    ");

$reservations = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Réservations en cours</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Réservations en cours</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Utilisateur
                    </th>
                    <th>
                        Chambre
                    </th>
                    <th>
                        Date de début
                    </th>
                    <th>
                        Date de fin
                    </th>
                    <th>
                        Ville
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation) { ?>
                <tr>
                    <td>
                    <?= $reservation['username'] ?>
                    </td>
                    <td>
                    <?= $reservation['rooms'] ?>
                    </td>
                    <td>
                    <?= $reservation['start_date'] ?>
                    </td>
                    <td>
                    <?= $reservation['end_date'] ?>
                    </td>
                    <td>
                    <?= $reservation['city'] ?>
                    </td>
                </tr>
                <? } ?>
            </tbody>
        </table>
    </div>
</body>
</html>