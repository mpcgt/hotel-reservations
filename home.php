<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestion de Réservations d'Hôtel</title>
</head>
<body>
<div class="px-4 pt-5 my-5 text-center border-bottom">
<img class="d-block mx-auto mb-4" src="https://github.com/mpcgt/hotel-reservations/blob/main/images/hotel.png?raw=true" alt="" width="110" height="100">
    <h1 class="display-4 fw-bold text-body-emphasis">Souhaitez-vous réserver un hôtel ?</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Utilisez les boutons ci-dessous pour naviguer dans ce site :! ;)</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
      <a href="login.php" type="button" class="btn btn-outline-primary">Connexion</a>
        <a href="search.php" type="button" class="btn btn-outline-secondary">Réserver une chambre</a>
        <a href="manage.php" type="button" class="btn btn-outline-success">Gestion des chambres</a>
        <a href="list.php" type="button" class="btn btn-outline-danger">Listes des réservations en cours</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>