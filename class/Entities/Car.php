<?php

namespace App\Entities;

class Car
{
    private $id;
    private $brand;
    private $model;
    private $color;
    private $door;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor($color): void
    {
        $this->color = $color;
    }

    public function getDoor(): string
    {
        return $this->door;
    }

    public function setDoor(string $door): void
    {
        $this->door = $door;
    }
}
