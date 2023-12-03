<?php

use App\Controllers\BookingsController;
use App\Services\CarpoolPostsService;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new BookingsController();
echo $controller->createBooking();


$CarpoolPostsService = new CarpoolPostsService();
$posts = $CarpoolPostsService->getCarpoolPosts();

$userService = new usersService();
$users = $userService->getUsers();
?>

<p>Création d'une réservation</p>
<form method="post" action="bookings_create.php" name ="bookingCreateForm">
    <label for="users">Utilisateur(s) :</label><br>
    <?php foreach ($users as $user): ?>
        <?php 
            $userName = $user->getFirstName() . ' ' . $user->getLastName(); ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?><br>
    <label for="posts">Annonces(s) :</label><br>
    <?php foreach ($posts as $post): ?>
        <?php 
            $startDateTime = $post->getStartDateTime();
            $startDateTimeAsString = $startDateTime->format('Y-m-d H:i:s');
            $postName = $post->getStartAddress() . ' ' . $post->getArrivalAddress() . ' ' . $startDateTimeAsString . ' ' . $post->getPrice(); ?>
        <input type="checkbox" name="posts[]" value="<?php echo $post->getId(); ?>"><?php echo $postName; ?>
        <br />
    <?php endforeach; ?><br>
    <label for="payment_method">Moyen de paiement :</label>
    <input type="text" name="payment_method">
    <br />
    <input type="submit" value="Créer une réservation">
</form>