<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{
    /**
     * Return the html for the create action.
     */
    public function createCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (
            isset($_POST['brand']) && $_POST['brand'] != "" &&
            isset($_POST['model']) && $_POST['model'] != "" &&
            isset($_POST['color']) && $_POST['color'] != "" &&
            isset($_POST['nbrSlots']) && $_POST['nbrSlots'] != ""
        ) {

            // Create the car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                null,
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['nbrSlots']
            );
            if ($isOk) {
                $html = 'La voiture a été créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all cars :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
            $html .=
                '#' . $car->getId() . ' ' .
                $car->getBrand() . ' ' .
                $car->getModel() . ' ' .
                $car->getColor() . ' ' .
                $car->getNbrSlots() . '<br />';
        }

        return $html;
    }

    /**
     * Update the car.
     */
    public function updateCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (
            isset($_POST['car_id']) && $_POST['car_id'] != "" &&
            isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots'])
        ) {
            // Update the car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                $_POST['car_id'],
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['nbrSlots']
            );
            if ($isOk) {
                $html = 'La voiture a été mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['car_id']) && $_POST['car_id'] != "") {
            // Delete the car :
            $carsService = new CarsService();
            $isOk = $carsService->deleteCar($_POST['car_id']);
            if ($isOk) {
                $html = 'La voiture a été supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture.';
            }
        }

        return $html;
    }
}
