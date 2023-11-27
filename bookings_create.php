<?php

use App\Controllers\BookingsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new BookingsController();
echo $controller->createBooking();
?>

<p>Création d'une réservation</p>
<form method="post" action="bookings_create.php" name ="bookingCreateForm">
    <label for="driver_id">Id du conducteur</label>
    <input type="text" name="driver_id">
    <br />
    <label for="tel">Numéro Téléphone :</label>
    <input type="text" name="tel">
    <br />
    <label for="price">Pix :</label>
    <input type="text" name="price">
    <br />
    <label for="payment_method">Moyen de paiement :</label>
    <input type="text" name="payment_method">
    <br />
    <input type="submit" value="Créer une réservation">
</form>