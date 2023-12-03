<?php

namespace App\Entities;

use DateTime;

class CarpoolPost
{
    private $id;
    private $price;
    private $startAddress;
    private $arrivalAddress;
    private $startDateTime;
    private $message;
    private $bookings;


    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getStartAddress(): string
    {
        return $this->startAddress;
    }

    public function setStartAddress(string $startAddress): void
    {
        $this->startAddress = $startAddress;
    }

    public function getArrivalAddress(): string
    {
        return $this->arrivalAddress;
    }

    public function setArrivalAddress(string $arrivalAddress): void
    {
        $this->arrivalAddress = $arrivalAddress;
    }

    public function getStartDateTime(): DateTime
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(DateTime $startDateTime): void
    {
        $this->startDateTime = $startDateTime;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    public function getBookings(): ?array
    {
        return $this->bookings;
    }

    public function setBookings(string $bookings)
    {
        $this->bookings = $bookings;

        return $this;
    }
}