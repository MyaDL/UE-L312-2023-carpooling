<?php

namespace App\Controllers;

use App\Services\UsersService;

class UsersController
{
    /**
     * Return the html for the create action.
     */
    public function createUser(): string
    {
        $html = '';
       
        // If the form have been submitted :
        if (
            isset($_POST['firstname']) && $_POST['firstname'] != "" &&
            isset($_POST['lastname']) && $_POST['lastname'] != "" &&
            isset($_POST['email']) && $_POST['email'] != "" &&
            isset($_POST['birthday']) && $_POST['birthday'] != ""
        ) {
            // Create the user :
            $usersService = new UsersService();
            $userId = $usersService->setUser(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );
            $isOk = true;
            if ($userId && $isOk) {

                // Create the user cars relations :

                if (!empty($_POST['cars'])) {
                    foreach ($_POST['cars'] as $carId) {
                        $isOk = $usersService->setUserCar($userId, $carId);
                    }
                }

                $html = 'Utilisateur créé avec succès.';

            } else {
                $html = 'Erreur lors de la création de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getUsers(): string
    {
        $html = '';

        // Get all users :
        $usersService = new UsersService();
        $users = $usersService->getUsers();

        // Get html :
        foreach ($users as $user) {
            $carsHtml = '';
            $postsHtml = '';
            $bookingHtml = '';
            if (!empty($user->getCars())) {
                foreach ($user->getCars() as $car) {
                    $carsHtml .= $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor() . ' ';
                }
            }
            if (!empty($user->getCarpoolPosts())) {
                foreach ($user->getCarpoolPosts() as $post) {
                    $startDateTime = $post->getStartDateTime();
                    $startDateTimeString = $startDateTime->format('Y-m-d H:i:s');
                    $postsHtml .= '<b>Post n°</b>' . $post->getId() . ' <b>Prix: </b>' . $post->getPrice() . '€ <b>adresse de départ: </b>' . $post->getStartAddress() . ' <b>Adresse d\'arrivé: </b>' . $post->getArrivalAddress() . ' <b>Heure d\'arrivé: </b>' . $startDateTimeString . ' <b>Message: </b>' . $post->getMessage() . ' ';
                }
            }

            if (!empty($user->getBookings())) {
                foreach ($user->getBookings() as $booking) {
                    $bookingHtml .= '<li>#' . $booking->getId() . ' ' . $booking->getPaymentMethod() . '</li><br>';
                }
            }

            $html .=
                '#' . $user->getId() . ' ' .
                $user->getFirstname() . ' ' .
                $user->getLastname() . ' ' .
                $user->getEmail() . ' ' .
                $user->getBirthday()->format('d-m-Y') . ' ' .
                $carsHtml . '<br />' .
                '<p><b>Post(s) de l\'utilisateur: </b></p>' .
                '<li>' . $postsHtml . '</li><br />' .
                '<p><b>Réservation(s) de l\'utilisateur: </b></p>' .
                ' ' . $bookingHtml . ' ';
        }

        return $html;
    }

    /**
     * Update the user.
     */
    public function updateUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (
            isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday'])
        ) {
            // Update the user :
            $usersService = new UsersService();
            $isOk = $usersService->setUser(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );
            if ($isOk) {
                $html = 'Utilisateur mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) && $_POST['id'] != "") {
            // Delete the user :
            $usersService = new UsersService();
            $isOk = $usersService->deleteUser($_POST['id']);
            if ($isOk) {
                $html = 'Utilisateur supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'utilisateur.';
            }
        }

        return $html;
    }
}
