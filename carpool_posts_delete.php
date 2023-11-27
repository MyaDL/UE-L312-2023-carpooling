<?php

use App\Controllers\CarpoolPostsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpoolPostsController();
echo $controller->deleteCarpoolPost();
?>

<p>Suppression d'une annonce</p>
<form method="post" action="carpool_posts_delete.php" name ="carpoolPostDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonce">
</form>