<?php

namespace App\Services;

use App\Entities\CarpoolPost;
use App\Entities\Booking;
use DateTime;

class CarpoolPostsService
{
    /**
     * Create or update a carpool post
     */
    public function setCarpoolPost(?string $id, string $price, string $startAddress, string $arrivalAddress, string $startDateTime, string $message): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $startDateTime = new DateTime($startDateTime);
        if (empty($id)) {
            $isOk = $dataBaseService->createCarpoolPost($price, $startAddress, $arrivalAddress, $startDateTime, $message);
        } else {
            $isOk = $dataBaseService->updateCarpoolPost($id, $price, $startAddress, $arrivalAddress, $startDateTime, $message);
        }

        return $isOk;
    }

    /**
     * Return all carpool posts
     */
    public function getCarpoolPosts(): array
    {
        $posts = [];

        $dataBaseService = new DataBaseService();
        $carpoolPostsDTO = $dataBaseService->getCarpoolPost();
        if (!empty($carpoolPostsDTO)) {
            foreach ($carpoolPostsDTO as $carpoolPostDTO) {
                $carpoolPost = new CarpoolPost();
                $carpoolPost->setId($carpoolPostDTO['post_id']);
                $carpoolPost->setPrice($carpoolPostDTO['price']);
                $carpoolPost->setStartAddress($carpoolPostDTO['start_address']);
                $carpoolPost->setArrivalAddress($carpoolPostDTO['arrival_address']);
                $carpoolPost->setMessage($carpoolPostDTO['message']);
                $date = new DateTime($carpoolPostDTO['start_date_time']);
                if ($date !== false) {
                    $carpoolPost->setStartDateTime($date);
                }

                // Get cars of this post :
                $bookings = $this->getPostBookings($carpoolPostDTO['post_id']);
                $carpoolPost->setBookings($bookings);

                $posts[] = $carpoolPost;
            }
        }

        return $posts;
    }

    /**
     * Delete a carpool post
     */
    public function deleteCarpoolPost(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCarpoolPost($id);

        return $isOk;
    }

    /**
     * Get bookings of given post id.
     */
    public function getPostBookings(string $postId): array
    {
        $postBookings = [];

        $dataBaseService = new DataBaseService();

        // Get relation posts and cars :
        $postsBookingsDTO = $dataBaseService->getPostBookings($postId);
        if (!empty($postsBookingsDTO)) {
            foreach ($postsBookingsDTO as $postBookingDTO) {
                $booking = new Booking();
                $booking->setId($postBookingDTO['booking_id']);
                $booking->setPaymentMethod($postBookingDTO['payment_method']);
                $postBookings[] = $booking;
            }
        }

        return $postBookings;
    }



    /**
     * Create relation between a post and his booking.
     */
    public function setPostBooking(string $userId, string $bookingId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setPostBooking($userId, $bookingId);

        return $isOk;
    }

}