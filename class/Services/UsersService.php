<?php

namespace App\Services;

use App\Entities\Booking;
use App\Entities\Car;
use App\Entities\CarpoolPost;
use App\Entities\User;
use DateTime;

class UsersService
{
    /**
     * Create or update an user.
     */
    public function setUser(?string $id, string $firstname, string $lastname, string $email, string $birthday): string
    {
        $userId = null;

        $dataBaseService = new DataBaseService();
        $birthdayDateTime = new DateTime($birthday);

        if (empty($id)) {
            $userId = $dataBaseService->createUser($firstname, $lastname, $email, $birthdayDateTime);
        } else {
            $dataBaseService->updateUser($id, $firstname, $lastname, $email, $birthdayDateTime);
            $userId = (int) $id;
        }
      
        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $dataBaseService = new DataBaseService();
        $usersDTO = $dataBaseService->getUsers();
        if (!empty($usersDTO)) {
            foreach ($usersDTO as $userDTO) {
                // Get user :
                $user = new User();
                $user->setId($userDTO['user_id']);
                $user->setFirstname($userDTO['firstname']);
                $user->setLastname($userDTO['lastname']);
                $user->setEmail($userDTO['email']);
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setbirthday($date);
                }

                // Get cars of this user :
                $cars = $this->getUserCars($userDTO['user_id']);
                $user->setCars($cars);

                // Get posts of this user :
                $posts = $this->getUserPosts($userDTO['user_id']);
                $user->setCarpoolPosts($posts);

                // Get bookings of this user :
                $bookings = $this->getUserBookings($userDTO['user_id']);
                $user->setBookings($bookings);

                $users[] = $user;
            }
        }

        return $users;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteUser($id);

        return $isOk;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserCar($userId, $carId);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCarsDTO = $dataBaseService->getUserCars($userId);
        if (!empty($usersCarsDTO)) {
            foreach ($usersCarsDTO as $userCarDTO) {
                $car = new Car();
                $car->setId($userCarDTO['car_id']);
                $car->setBrand($userCarDTO['brand']);
                $car->setModel($userCarDTO['model']);
                $car->setColor($userCarDTO['color']);
                $car->setNbrSlots($userCarDTO['nbrSlots']);
                $userCars[] = $car;
            }
        }

        return $userCars;
    }

    /**
     * Create relation bewteen an user and his post.
     */
    public function setUserPost(string $userId, string $postId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserPost($userId, $postId);

        return $isOk;
    }

    /**
     * Get posts of given user id.
     */
    public function getUserPosts(string $userId): array
    {
        $userPosts = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and posts :
        $usersPostsDTO = $dataBaseService->getUserPosts($userId);
        if (!empty($usersPostsDTO)) {
            foreach ($usersPostsDTO as $userPostDTO) {
                $post = new CarpoolPost();
                $post->setId($userPostDTO['post_id']);
                $post->setPrice($userPostDTO['price']);
                $post->setStartAddress($userPostDTO['start_address']);
                $post->setArrivalAddress($userPostDTO['arrival_address']);
                $date = new DateTime($userPostDTO['start_date_time']);
                if ($date !== false) {
                    $post->setStartDateTime($date);
                }
                $post->setMessage($userPostDTO['message']);
                $userPosts[] = $post;
            }
        }

        return $userPosts;
    }

    /**
     * Get bookings of given user id.
     */
    public function getUserBookings(string $userId): array
    {
        $userBookings = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and bookings :
        $usersBookingsDTO = $dataBaseService->getUserBooking($userId);
        if (!empty($usersBookingsDTO)) {
            foreach ($usersBookingsDTO as $userBookingDTO) {
                $booking = new Booking();
                $booking->setId($userBookingDTO['booking_id']);
                $booking->setPaymentMethod($userBookingDTO['payment_method']);
                $userBookings[] = $booking;
            }
        }

        return $userBookings;
    }
}
