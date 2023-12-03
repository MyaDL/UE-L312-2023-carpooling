<?php

namespace App\Services;

use App\Entities\Booking;

class BookingsService
{
    /**
     * Create or update a booking
     */
    public function setBooking(?string $id, string $paymentMethod): string
    {
        $bookingId = null;

        $dataBaseService = new DataBaseService();

        if (empty($id)) {
            $bookingId = $dataBaseService->createBooking($paymentMethod);
        } else {
            $bookingId = $dataBaseService->updateBooking($id, $paymentMethod);
        }

        return $bookingId;

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
    public function setBookingPost(string $bookingId, string $postId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setBookingPost($bookingId, $postId);

        return $isOk;
    }

    public function setBookingUser(string $bookingId, string $userId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setBookingUser($bookingId, $userId);

        return $isOk;
    }

}