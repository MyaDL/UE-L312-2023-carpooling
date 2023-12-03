<?php

use App\Controllers\CarpoolPostsController;
use App\Services\CarsService;
use App\Services\BookingsService;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpoolPostsController();
echo $controller->updateCarpoolPost();


$carsService = new CarsService();
$cars = $carsService->getCars();

$bookingsService = new BookingsService();
$bookings = $bookingsService->getBookings();

$usersService = new UsersService();
$users = $usersService->getUsers();
?>

<p>Modification d'une annonce</p>
<form method="post" action="carpool_posts_update.php" name="carpoolUpdateCreateForm">
    <label for="users">Utilisateur :</label>
    <select name="users">
        <option value="">--Choisir un utilisateur--</option>
        <?php foreach ($users as $user): ?>
            <?php $userName = $user->getFirstName() . ' ' . $user->getLastName(); ?>
            <option value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <?php endforeach; ?>
    </select><br>
    <label for="post_id">Id de l'annonce :</label>
    <input type="text" name="post_id">
    <br /><br>
    <label for="price">Prix :</label>
    <input type="text" name="price">
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
        <?php endforeach; ?>
        <br>
    <br />
    <input type="submit" value="Modifier une annonce">
</form>
