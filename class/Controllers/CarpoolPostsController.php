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
        if (isset($_POST['creator_id']) &&
            isset($_POST['start_address']) &&
            isset($_POST['arrival_address']) &&
            isset($_POST['start_date_time']) &&
            isset($_POST['message']) &&
            isset($_POST['cars'])) {
            //Create the post
            $carpoolPostsService = new CarpoolPostsService();
            $postId = $carpoolPostsService->setCarpoolPost(
                null,
                $_POST['creator_id'],
                $_POST['start_address'],
                $_POST['arrival_address'],
                $_POST['start_date_time'],
                $_POST['message']
            );

            // Create the post bookings relations :
            $isOk = true;
            if (!empty($_POST['bookings'])) {
                foreach ($_POST['bookings'] as $bookingId) {
                    $isOk = $carpoolPostsService->setPostBooking($postId, $bookingId);
                }
            }
            if ($isOk) {
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
            $bookingsHtml = '';
            if (!empty($carpoolPost->getBookings())) {
                foreach ($carpoolPost->getBookings() as $booking) {
                    $bookingHtml .= '<li>#' .  $booking->getId() . ' ' . $booking->getPaymentMethod() . '</li><br>';
                }
            }
            $html .=
                '#' . $carpoolPost->getId() . ' ' .
                $carpoolPost->getCreatorId() . ' ' .
                $carpoolPost->getStartAddress() . ' ' .
                $carpoolPost->getArrivalAddress() . ' ' .
                $carpoolPost->getStartDateTime()->format('Y-m-d H:i:s') . ' ' .
                $carpoolPost->getMessage() . ' ' .
                ' ' .$bookingHtml . '<br/> ';
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
        if (isset($_POST['id']) &&
            isset($_POST['creator_id']) &&
            isset($_POST['start_address']) &&
            isset($_POST['arrival_address']) &&
            isset($_POST['start_date_time']) &&
            isset($_POST['message'])) {
            //Update the carpool post
            $carpoolPostsService = new CarpoolPostsService();
            $isOk = $carpoolPostsService->setCarpoolPost(
                $_POST['id'],
                $_POST['creator_id'],
                $_POST['start_address'],
                $_POST['arrival_address'],
                $_POST['start_date_time'],
                $_POST['message']
            );
            if ($isOk) {
                $html = 'Annonce mise à jour avec succès';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce';
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