<?php

namespace App\Controllers;

use App\Services\CarpoolPostsService;

class CarpoolPostsController
{
    /**
     * Return the html for the creation action
     */
    public function createCarpoolPost(): string
    {
        $html = '';

        //If the form have been submitted
        if (isset($_POST['creatorId']) &&
            isset($_POST['startAddress']) &&
            isset($_POST['arrivalAddress']) &&
            isset($_POST['startDateTime']) &&
            isset($_POST['message'])) {
            //Create the post
            $carpoolPostsService = new CarpoolPostsService();
            $isOk = $carpoolPostsService->setCarpoolPost(
                null,
                $_POST['creatorId'],
                $_POST['startAddress'],
                $_POST['arrivalAddress'],
                $_POST['startDateTime'],
                $_POST['message']
            );
            if ($isOk) {
                $html = 'Annonce créée avec succès';
            } else {
                $html = 'Erreur lors de la création de l\'annonce';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action
     */
    public function getCarpoolPosts(): string
    {
        $html = '';

        //Get all carpool posts
        $carpoolPostsService = new CarpoolPostsService();
        $carpoolPosts = $carpoolPostsService->getCarpoolPosts();

        //Get html
        foreach ($carpoolPosts as $carpoolPost) {
            $html .=
                '#' . $carpoolPost->getId() . ' ' .
                $carpoolPost->getCreatorId() . ' ' .
                $carpoolPost->getStartAddress() . ' ' .
                $carpoolPost->getArrivalAddress() . ' ' .
                $carpoolPost->getStartDateTime()->format('Y-m-d H:i:s') . ' ' .
                $carpoolPost->getMessage() . '<br/>';
        }

        return $html;
    }

    /**
     * Update the carpool post
     */
    public function updateCarpoolPost(): string
    {
        $html = '';

        //If the form have been submitted
        if (isset($_POST['id']) &&
            isset($_POST['creatorId']) &&
            isset($_POST['startAddress']) &&
            isset($_POST['arrivalAddress']) &&
            isset($_POST['startDateTime']) &&
            isset($_POST['message'])) {
            //Update the carpool post
            $carpoolPostsService = new CarpoolPostsService();
            $isOk = $carpoolPostsService->setCarpoolPost(
                $_POST['id'],
                $_POST['creatorId'],
                $_POST['startAddress'],
                $_POST['arrivalAddress'],
                $_POST['startDateTime'],
                $_POST['message']
            );
            if ($isOk) {
                $html = 'Annonce mise à jour avec succès';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce';
            }
        }

        return $html;
    }

    /**
     * Delete a post
     */
    public function deleteCarpoolPost(): string
    {
        $html = '';

        //If the form have been submitted
        if (isset($_POST['id'])) {
            //Delete the post
            $carpoolPostsService = new CarpoolPostsService();
            $isOk = $carpoolPostsService->deleteCarpoolPost($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimée avec succès';
            } else {
                $html = 'Erreur lors de la suppression de l\'annonce';
            }
        }

        return $html;
    }
}