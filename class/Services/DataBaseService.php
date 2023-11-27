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
    const MYSQL_PASSWORD = 'password';

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
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
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
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
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
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

     /**
     * Create an car.
     */
    public function createCar(string $brand, string $model, string $color, string $door): bool
    {
        $isOk = false;

        $data = [
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'door' => $door,
        ];
        $sql = 'INSERT INTO cars (brand, model, color, door) VALUES (:brand, :model, :color, :door)';
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
    public function updateCar(string $id, string $brand, string $model, string $color, string $door): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'door' => $door,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, color = :color, door = :door WHERE id = :id;';
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
            'id' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create carpool post
     */
    public function createCarpoolPost(string $creatorId, string $startAddress, string $arrivalAddress, DateTime $startDateTime, string $message): bool
    {
        $isOk = false;

        $data = [
            'creator_id' => $creatorId,
            'start_address' => $startAddress,
            'arrival_address' => $arrivalAddress,
            'start_date_time' => $startDateTime->format(DateTime::RFC3339),
            'message' => $message,
        ];
        $sql = 'INSERT INTO posts (creator_id, start_address, arrival_address, start_date_time, message) VALUES (:creator_id, :start_address, :arrival_address, :start_date_time, :message)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
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
    public function updateCarpoolPost(string $id, string $creatorId, string $startAddress, string $arrivalAddress, DateTime $startDateTime, string $message): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'creator_id' => $creatorId,
            'start_address' => $startAddress,
            'arrival_address' => $arrivalAddress,
            'start_date_time' => $startDateTime->format(DateTime::RFC3339),
            'message' => $message,
        ];
        $sql = 'UPDATE posts SET creator_id =:creator_id, start_address = :start_address, arrival_address = :arrival_address, start_date_time = :start_date_time, message = :message WHERE id = :id;';
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
            'id' => $id,
        ];
        $sql = 'DELETE FROM posts WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create booking
     */
    public function createBooking(string $driverId, string $tel, string $price, string $paymentMethod): bool
    {
        $isOk = false;

        $data = [
            'driver_id' => $driverId,
            'tel' => $tel,
            'price' => $price,
            'payment_method' => $paymentMethod,
        ];
        $sql = 'INSERT INTO bookings (driver_id, tel, price, payment_method) VALUES (:driver_id, :tel, :price, :payment_method)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
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
    public function updateBooking(int $id, int $driverId, string $tel, string $price, string $paymentMethod): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'driver_id' => $driverId,
            'tel' => $tel,
            'price' => $price,
            'payment_method' => $paymentMethod,
        ];
        $sql = 'UPDATE bookings SET driver_id = :driver_id, tel = :tel, price = :price, payment_method = :payment_method WHERE id = :id;';
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
            'id' => $id,
        ];
        $sql = 'DELETE FROM bookings WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }
}
