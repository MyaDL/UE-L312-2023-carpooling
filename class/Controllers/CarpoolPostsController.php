<?php

namespace App\Controllers;

use App\Services\CarpoolPostsService;

class CarpoolPostsController
{
    /**
     * Return the html for the creation action
     */
    public function createCarpoolPost(): string
    {
        $html = '';

        //If the form have been submitted
        if (
            isset($_POST['price']) &&
            isset($_POST['start_address']) &&
            isset($_POST['arrival_address']) &&
            isset($_POST['start_date_time']) &&
            isset($_POST['message']) &&
            isset($_POST['cars'])
        ) {
            //Create the post
            $carpoolPostsService = new CarpoolPostsService();
            $postId = $carpoolPostsService->setCarpoolPost(
                null,
                $_POST['price'],
                $_POST['start_address'],
                $_POST['arrival_address'],
                $_POST['start_date_time'],
                $_POST['message']
            );

            $isOk = true;
            if ($postId && $isOk) {
                // Create the post cars relations :
                if (!empty($_POST['cars'])) {
                    foreach ($_POST['cars'] as $carId) {
                        $isOk = $carpoolPostsService->setPostCar($postId, $carId);
                    }
                }
                // Create the post bookings relations :
                if (!empty($_POST['bookings'])) {
                    foreach ($_POST['bookings'] as $bookingId) {
                        $isOk = $carpoolPostsService->setPostBooking($postId, $bookingId);
                    }
                }

                $html = 'Annonce créée avec succès';
            } else {
                $html = 'Erreur lors de la création de l\'annonce';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action
     */
    public function getCarpoolPosts(): string
    {
        $html = '';

        //Get all carpool posts
        $carpoolPostsService = new CarpoolPostsService();
        $carpoolPosts = $carpoolPostsService->getCarpoolPosts();

        //Get html
        foreach ($carpoolPosts as $carpoolPost) {
            $carsHtml = '';
            if (!empty($carpoolPost->getCars())) {
                foreach ($carpoolPost->getCars() as $car) {
                    $carsHtml .= $car->getBrand() . ' ' . $car->getModel() . ' ' . $car->getColor() . ' ';
                }
            }
            $bookingsHtml = '';
            if (!empty($carpoolPost->getBookings())) {
                foreach ($carpoolPost->getBookings() as $booking) {
                    $bookingsHtml .= '<li>#' . $booking->getId() . ' ' . $booking->getPaymentMethod() . '</li><br>';
                }
            }
            $html .=
                '#' . $carpoolPost->getId() . ' ' .
                $carpoolPost->getPrice() . ' ' .
                $carpoolPost->getStartAddress() . ' ' .
                $carpoolPost->getArrivalAddress() . ' ' .
                $carpoolPost->getStartDateTime()->format('Y-m-d H:i:s') . ' ' .
                $carpoolPost->getMessage() . ' ' .
                $carsHtml . ' ' .
                $bookingsHtml . '<br/> ';
        }

        return $html;
    }

    /**
     * Update the carpool post
     */
    public function updateCarpoolPost(): string
    {
        $html = '';

        //If the form have been submitted
        if (
            isset($_POST['post_id']) && $_POST['post_id'] != "" &&
            isset($_POST['price']) &&
            isset($_POST['start_address']) &&
            isset($_POST['arrival_address']) &&
            isset($_POST['start_date_time']) &&
            isset($_POST['message']) &&
            isset($_POST['cars'])
        ) {
            //Create the post
            $carpoolPostsService = new CarpoolPostsService();
            $postId = $carpoolPostsService->setCarpoolPost(
                $_POST['post_id'],
                $_POST['price'],
                $_POST['start_address'],
                $_POST['arrival_address'],
                $_POST['start_date_time'],
                $_POST['message']
            );

            $isOk = true;
            if ($postId && $isOk) {
                // Create the post cars relations :
                if (!empty($_POST['cars'])) {
                    foreach ($_POST['cars'] as $carId) {
                        $isOk = $carpoolPostsService->setPostCar($postId, $carId);
                    }
                }

                $html = 'Annonce modifiée avec succès';
            } else {
                $html = 'Erreur lors de la création de l\'annonce';
            }
        }

        return $html;
    }

    /**
     * Delete a post
     */
    public function deleteCarpoolPost(): string
    {
        $html = '';

        //If the form have been submitted
        if (isset($_POST['id'])) {
            //Delete the post
            $carpoolPostsService = new CarpoolPostsService();
            $isOk = $carpoolPostsService->deleteCarpoolPost($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimée avec succès';
            } else {
                $html = 'Erreur lors de la suppression de l\'annonce';
            }
        }

        return $html;
    }
}