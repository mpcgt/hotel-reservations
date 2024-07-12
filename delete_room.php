<?php
session_start();
require 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Vérifier si l'idetifiant de la chambre est présent dans la requête
if(isset($_GET['id'])) {
    $rooms_id = $_GET['id'];

    // Préparer et éxecuter la requête de suppression
    $sql = $pdo->prepare('DELETE from rooms WHERE id = :id');
    $sql->execute (['id' => $rooms_id]);

    // Rediriger vers la page de gestion des chambres
    header("Location: manage.php");
    exit;
}
?>