<?php

namespace App\Services;

use App\Entities\Booking;

class BookingsService
{
    /**
     * Create or update a booking
     */
    public function setBooking(?string $id, string $paymentMethod): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createBooking($paymentMethod);
        } else {
            $isOk = $dataBaseService->updateBooking($id, $paymentMethod);
        }

        return $isOk;

    }

    /**
     * Return all bookings
     */
    public function getBookings(): array
    {
        $bookings = [];

        $dataBaseService = new DataBaseService();
        $bookingsDTO = $dataBaseService->getBookings();

        if (!empty($bookingsDTO)) {
            foreach ($bookingsDTO as $bookingDTO) {
                $booking = new Booking();
                $booking->setId($bookingDTO['booking_id']);
                $booking->setPaymentMethod($bookingDTO['payment_method']);
                $bookings[] = $booking;
            }
        }

        return $bookings;
    }

    /**
     * Delete booking
     */
    public function deleteBooking(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteBooking($id);

        return $isOk;
    }

}