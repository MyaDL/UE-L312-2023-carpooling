<?php

namespace App\Services;

use App\Entities\Car;

class CarsService
{
    /**
     * Create or update an car.
     */
    public function setCar(?string $id, string $brand, string $model, string $color, string $door): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createCar($brand, $model, $color, $door);
        } else {
            $isOk = $dataBaseService->updateCar($id, $brand, $model, $color, $door);
        }

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $dataBaseService = new DataBaseService();
        $carsDTO = $dataBaseService->getCars();
        if (!empty($carsDTO)) {
            foreach ($carsDTO as $carDTO) {
                $car = new Car();
                $car->setId($carDTO['id']);
                $car->setBrand($carDTO['brand']);
                $car->setModel($carDTO['model']);
                $car->setColor($carDTO['color']);
                $car->setDoor($carDTO['door']);
                $cars[] = $car;
            }
        }

        return $cars;
    }

    /**
     * Delete an car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCar($id);

        return $isOk;
    }
}
