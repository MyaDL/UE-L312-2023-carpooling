<?php

namespace App\Services;

use App\Entities\Booking;

class BookingsService
{
    /**
     * Create or update a booking
     */
    public function setBooking(?string $id, string $driverId, string $tel, string $price, string $paymentMethod): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createBooking($driverId, $tel, $price, $paymentMethod);
        } else {
            $isOk = $dataBaseService->updateBooking($id, $driverId, $tel, $price, $paymentMethod);
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
                $booking->setId($bookingDTO['id']);
                $booking->setDriverId($bookingDTO['driverId']);
                $booking->setTel($bookingDTO['tel']);
                $booking->setPrice($bookingDTO['price']);
                $booking->setPaymentMethod($bookingDTO['paymentMethod']);
            }
            $bookings[] = $bookingDTO;
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