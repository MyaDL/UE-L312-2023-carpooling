<?php

namespace App\Controllers;
use App\Services\BookingsService;
use App\Services\UsersService;

class BookingsController
{
    /**
     * Return the html for the create action.
     */
    public function createBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (
            isset($_POST['payment_method']) && $_POST['payment_method'] != "" &&
            isset($_POST['users']) && $_POST['users'] != ""
            ) {
                
            // Create the Booking :
            $BookingService = new BookingsService();
            $bookingId = $BookingService->setBooking(
                null,
                $_POST['payment_method']
            );
            
            $isOk = true;
            if ($bookingId && $isOk) {

                if (!empty($_POST['users'])) {
         
                    foreach ($_POST['users'] as $userId) {
                        $isOk = $BookingService->setBookingUser($bookingId, $userId);
                    }
                }

                if (!empty($_POST['posts'])) {
                    foreach ($_POST['posts'] as $postId) {
                        $isOk = $BookingService->setBookingPost($bookingId, $postId);
                    }
                }

                $html = 'La réservation a été créé avec succès.';
                
            }else{
                $html = 'Erreur lors de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getBooking(): string
    {
        $html = '';

        // Get all bookings :
        $bookingsService = new BookingsService();
        $bookings = $bookingsService->getBookings();
        
        // Get html :
        foreach ($bookings as $booking) {
            $html .=
                '#' . $booking->getId() . ' ' .
                $booking->getPaymentMethod() . '<br />';
        }

        return $html;
    }

    /**
     * Update the booking.
     */
    public function updateBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['booking_id']) && isset($_POST['payment_method'])) {
            // Update the booking :
            $BookingService = new BookingsService();
            $bookingId = $BookingService->setBooking(
                $_POST['booking_id'],
                $_POST['payment_method']
            );
            
            $isOk = true;
            if ($bookingId && $isOk) {

                if (!empty($_POST['users'])) {
         
                    foreach ($_POST['users'] as $userId) {
                        $isOk = $BookingService->setBookingUser($bookingId, $userId);
                    }
                }

                if (!empty($_POST['posts'])) {
                    foreach ($_POST['posts'] as $postId) {
                        $isOk = $BookingService->setBookingPost($bookingId, $postId);
                    }
                }

                $html = 'La réservation a été modifier avec succès.';
                
            }else{
                $html = 'Erreur lors de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Delete a booking.
     */
    public function deleteBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) && $_POST['id'] != "") {
            // Delete the booking :
            $bookingsService = new BookingsService();
            $isOk = $bookingsService->deleteBooking($_POST['id']);
            if ($isOk) {
                $html = 'La réservation a été supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la suppression de la réservation.';
            }
        }

        return $html;
    }
}
