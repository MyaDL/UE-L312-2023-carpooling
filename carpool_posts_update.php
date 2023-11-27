<?php

use App\Controllers\CarpoolPostsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpoolPostsController();
echo $controller->updateCarpoolPost();
?>

<p>Mise à jour d'une annonce</p>
<form method="post" action="carpool_posts_update.php" name ="userUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="creator_id">Id du créateur :</label>
    <input type="text" name="creator_id">
    <br />
    <label for="start_address">Adresse de départ :</label>
    <input type="text" name="start_address">
    <br />
    <label for="arrival_address">Adresse d'arrivée :</label>
    <input type="text" name="arrival_address">
    <br />
    <label for="start_date_time">Jour et heure de départ Y-m-d H:m:s :</label>
    <input type="text" name="start_date_time">
    <br />
    <label for="message">Message :</label>
    <input type="text" name="message">
    <br />
    <input type="submit" value="Modifier l'annonce">
</form>