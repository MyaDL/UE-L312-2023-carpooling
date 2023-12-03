<?php

use App\Controllers\CarpoolPostsController;
use App\Services\CarsService;
use App\Services\BookingsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpoolPostsController();
echo $controller->createCarpoolPost();


$carsService = new CarsService();
$cars = $carsService->getCars();

$bookingsService = new BookingsService();
$bookings = $bookingsService->getBookings();

?>

<p>Création d'une annonce</p>
<form method="post" action="carpool_posts_create.php" name="carpoolPostCreateForm">
    <label for="creator_id">Identifiant du créateur :</label>
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
    <label for="cars">Voiture(s) :</label>
    <?php foreach ($cars as $car): ?>
        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(); ?>
        <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
    <label for="cars">Réservation(s) :</label>
    <?php foreach ($bookings as $booking): ?>
        <?php $bookingId = $booking->getId() . ' ' . $paymentMethod = $booking->getPaymentMethod(); ?>
        <input type="checkbox" name="bookings[]" value="<?php echo $booking->getId(); ?>"><?php echo $bookingId . ' ' . $paymentMethod; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une annonce">
</form>
