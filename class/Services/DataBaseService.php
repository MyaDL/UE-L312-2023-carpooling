<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): ?int
    {
    
        $isOk = null;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        if($isOk){
            $userId = (int)$this->connection->lastInsertId();
        }
   
        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'user_id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE user_id = :user_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'user_id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE user_id = :user_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

     /**
     * Create an car.
     */
    public function createCar(string $brand, string $model, string $color, string $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'INSERT INTO cars (brand, model, color, nbrSlots) VALUES (:brand, :model, :color, :nbrSlots)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Update an car.
     */
    public function updateCar(string $id, string $brand, string $model, string $color, string $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'car_id' => $id,
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, color = :color, nbrSlots = :nbrSlots WHERE car_id = :car_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $data = [
            'car_id' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE car_id = :car_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create carpool post
     */
    public function createCarpoolPost(string $price, string $startAddress, string $arrivalAddress, DateTime $startDateTime, string $message): ?int
    {
        $isOk = null;

        $data = [
            'price' => $price,
            'start_address' => $startAddress,
            'arrival_address' => $arrivalAddress,
            'start_date_time' => $startDateTime->format(DateTime::RFC3339),
            'message' => $message,
        ];
        $sql = 'INSERT INTO posts (price, start_address, arrival_address, start_date_time, message) VALUES (:price, :start_address, :arrival_address, :start_date_time, :message)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        if($isOk){
            $postId = (int)$this->connection->lastInsertId();
        }
   
        return $postId;
    }

    /**
     * Return all carpool posts.
     */
    public function getCarpoolPost(): array
    {
        $posts = [];

        $sql = 'SELECT * FROM posts';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $posts = $results;
        }

        return $posts;
    }

    /**
     * Update a carpool post.
     */
    public function updateCarpoolPost(string $id, string $price, string $startAddress, string $arrivalAddress, DateTime $startDateTime, string $message): bool
    {
        $isOk = false;

        $data = [
            'post_id' => $id,
            'price' => $price,
            'start_address' => $startAddress,
            'arrival_address' => $arrivalAddress,
            'start_date_time' => $startDateTime->format(DateTime::RFC3339),
            'message' => $message,
        ];
        $sql = 'UPDATE posts SET price =:price, start_address = :start_address, arrival_address = :arrival_address, start_date_time = :start_date_time, message = :message WHERE post_id = :post_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a carpool post
     */
    public function deleteCarpoolPost(string $id): bool
    {
        $isOk = false;

        $data = [
            'post_id' => $id,
        ];
        $sql = 'DELETE FROM posts WHERE post_id = :post_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create booking
     */
    public function createBooking(string $paymentMethod): int
    {
        $bookingId = null;

        $data = [
            'payment_method' => $paymentMethod
        ];
        $sql = 'INSERT INTO bookings (payment_method) VALUES (:payment_method)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        if($isOk){
            $bookingId = (int)$this->connection->lastInsertId();
        }

        return $bookingId;
    }

    /**
     * Return all bookings.
     */
    public function getBookings(): array
    {
        $bookings = [];

        $sql = 'SELECT * FROM bookings';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $bookings = $results;
        }

        return $bookings;
    }

    /**
     * Update a booking.
     */
    public function updateBooking(int $id, string $paymentMethod): bool
    {
        $isOk = null;

        $data = [
            'booking_id' => $id,
            'payment_method' => $paymentMethod
        ];

        $sql = 'UPDATE bookings SET payment_method = :payment_method WHERE booking_id = :booking_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a booking
     */
    public function deleteBooking(int $id): bool
    {
        $isOk = false;

        $data = [
            'booking_id' => $id,
        ];
        $sql = 'DELETE FROM bookings WHERE booking_id = :booking_id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create relation between an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.car_id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }

    /**
     * Create relation between an user and his post.
     */
    public function setUserPost(string $userId, string $postId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'postId' => $postId,
        ];
        $sql = 'INSERT INTO users_posts (user_id, post_id) VALUES (:userId, :postId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    public function setBookingPost(string $bookingId, string $postId): bool
    {
        $isOk = false;

        $data = [
            'bookingId' => $bookingId,
            'postId' => $postId,
        ];
        $sql = 'INSERT INTO posts_bookings (booking_id, post_id) VALUES (:bookingId, :postId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }
    public function setBookingUser(string $bookingId, string $userId): bool
    {
        $isOk = false;

        $data = [
            'bookingId' => $bookingId,
            'userId' => $userId,
        ];
        $sql = 'INSERT INTO users_bookings (booking_id, user_id) VALUES (:bookingId, :userId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get posts of given user id.
     */
    public function getUserPosts(string $userId): array
    {
        $userPosts = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT p.*
            FROM posts as p
            LEFT JOIN users_posts as up ON up.post_id = p.post_id
            WHERE up.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userPosts = $results;
        }

        return $userPosts;
    }

    /**
     * Create relation between an user and his booking.
     */
    public function setUserBooking(string $userId, string $bookingId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'bookingId' => $bookingId,
        ];
        $sql = 'INSERT INTO users_posts (user_id, bookingId) VALUES (:userId, :bookingId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get bookings of given user id.
     */
    public function getUserBooking(string $userId): array
    {
        $userBookings = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT b.*
            FROM bookings as b
            LEFT JOIN users_bookings as ub ON ub.booking_id = b.booking_id
            WHERE ub.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userBookings = $results;
        }

        return $userBookings;
    }

    /**
     * Create relation between a post and his car.
     */
    public function setPostCar(string $postId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'postId' => $postId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO posts_cars (post_id, car_id) VALUES (:postId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create relation between a post and his booking.
     */
    public function setPostBooking(string $postId, string $bookingId): bool
    {
        $isOk = false;

        $data = [
            'postId' => $postId,
            'bookingId' => $bookingId,
        ];
       
        $sql = 'INSERT INTO posts_bookings (post_id, booking_id) VALUES (:postId, :bookingId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getPostCars(string $postId): array
    {
        $postCars = [];
        $data = [
            'postId' => $postId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN posts_cars as pc ON pc.car_id = c.car_id
            WHERE pc.post_id = :postId';
      
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
      
        if (!empty($results)) {
            $postCars = $results;
        }

        return $postCars;
      
    }

     /**
     * Get bookings of given user id.
     */
    public function getPostBookings(string $postId): array
    {
        $postBooking = [];

        $data = [
            'postId' => $postId,
        ];
        $sql = '
            SELECT b.*
            FROM bookings as b
            LEFT JOIN posts_bookings as pb ON pb.booking_id = b.booking_id
            WHERE pb.post_id = :postId';

        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $postBooking = $results;
        }

        return $postBooking;

    }
}
