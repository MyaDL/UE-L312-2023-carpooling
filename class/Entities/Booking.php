<?php

namespace App\Entities;

class Booking
{
    private $id;
    private $driverId;
    private $tel;
    private $price;
    private $paymentMethod;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getDriverId(): string
    {
        return $this->driverId;
    }

    public function setDriverId(string $driverId): void
    {
        $this->driverId = $driverId;
    }

    public function getTel(): string
    {
        return $this->tel;
    }

    public function setTel(string $tel): void
    {
        $this->tel = $tel;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }
}
