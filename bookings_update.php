<?php

use App\Controllers\BookingsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new BookingsController();
echo $controller->updateBooking();
?>

<p>Mise à jour d'une réservation</p>
<form method="post" action="bookings_update.php" name ="bookingUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="driver_id">Id du conducteur :</label>
    <input type="text" name="driver_id">
    <br />
    <label for="tel">Numéro de téléphone :</label>
    <input type="text" name="tel">
    <br />
    <label for="price">Prix :</label>
    <input type="text" name="price">
    <br />
    <label for="payment_method">Moyen de paiement :</label>
    <input type="text" name="payment_method">
    <br />
    <input type="submit" value="Modifier la réservation">
</form>