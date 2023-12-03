<?php

use App\Controllers\UsersController;
use App\Services\BookingsService;
use App\Services\CarpoolPostsService;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->createUser();

$carsService = new CarsService();
$cars = $carsService->getCars();

$postsService = new CarpoolPostsService();
$posts = $postsService->getCarpoolPosts();
?>

<p>Création d'un utilisateur</p>
<form method="post" action="users_create.php" name ="userCreateForm">
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname">
    <br />
    <label for="email">Email :</label>
    <input type="text" name="email">
    <br />
    <label for="birthday">Date d'anniversaire au format YYYY-MM-DD :</label>
    <input type="text" name="birthday">
    <br />
    <label for="cars">Voiture(s) :</label>
    <?php foreach ($cars as $car): ?>
        <?php $carName = $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor(); ?>
        <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="posts">Annonces(s) :</label><br>
    <?php foreach ($posts as $post): ?>
        <?php 
            $startDateTime = $post->getStartDateTime();
            $startDateTimeAsString = $startDateTime->format('Y-m-d H:i:s');
            $postName = $post->getStartAddress() . ' ' . $post->getArrivalAddress() . ' ' . $startDateTimeAsString . ' ' . $post->getPrice(); ?>
        <input type="checkbox" name="posts[]" value="<?php echo $post->getId(); ?>"><?php echo $postName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer un utilisateur">
</form>