<?php

namespace App\Entities;

use DateTime;

class CarpoolPost
{
    private $id;
    private $creatorId;
    private $startAddress;
    private $arrivalAddress;
    private $startDateTime;
    private $message;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    public function setCreatorId(int $creatorId): void
    {
        $this->creatorId = $creatorId;
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
}