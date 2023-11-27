<?php

namespace App\Controllers;

use App\Services\BookingService;

class BookingsController
{
    /**
     * Return the html for the create action.
     */
    public function createBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['door'])) {
                
            // Create the Booking :
            $BookingService = new BookingService();
            $isOk = $BookingService->setBooking(
                null,
                $_POST['driver_id'],
                $_POST['tel'],
                $_POST['price'],
                $_POST['payment_method']
            );
            if ($isOk) {
                $html = 'La réservation a été créé avec succès.';
            } else {
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
        $bookingsService = new BookingService();
        $bookings = $bookingsService->getBookings();

        // Get html :
        foreach ($bookings as $booking) {
            $html .=
                '#' . $booking->getId() . ' ' .
                $booking->getDriverId() . ' ' .
                $booking->getTel() . ' ' .
                $booking->getPrice() . ' ' .
                $booking->getgetPaymentMethodDoor() . '<br />';
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
        if (isset($_POST['id']) &&
            isset($_POST['driver_id']) &&
            isset($_POST['tel']) &&
            isset($_POST['price']) &&
            isset($_POST['payment_method'])) {
            // Update the booking :
            $bookingsService = new BookingService();
            $isOk = $bookingsService->setBooking(
                $_POST['id'],
                $_POST['driver_id'],
                $_POST['tel'],
                $_POST['price'],
                $_POST['payment_method']
            );
            if ($isOk) {
                $html = 'La réservation a été mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la réservation.';
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
        if (isset($_POST['id'])) {
            // Delete the booking :
            $bookingsService = new BookingService();
            $isOk = $bookingsService->deleteBooking($_POST['id']);
            if ($isOk) {
                $html = 'La réservation a été supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }
}