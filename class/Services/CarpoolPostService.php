<?php

namespace App\Services;

use App\Entities\CarpoolPost;
use DateTime;

class CarpoolPostService
{
    /**
     * Create or update a carpool post
     */
    public function setCarpoolPost(?string $id, string $creatorId, string $startAddress, string $arrivalAddress, string $startDateTime, string $message): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $startDateTime = new DateTime($startDateTime);
        if (empty($id)) {
            $isOk = $dataBaseService->createCarpoolPost($creatorId, $startAddress, $arrivalAddress, $startDateTime, $message);
        } else {
            $isOk = $dataBaseService->updateCarpoolPost($id, $creatorId, $startAddress, $arrivalAddress, $startDateTime, $message);
        }

        return $isOk;
    }

    /**
     * Return all carpool posts
     */
    public function getCarpoolPosts(): array
    {
        $posts = [];

        $dataBaseService = new DataBaseService();
        $carpoolPostsDTO = $dataBaseService->getCarpoolPost();
        if (!empty($carpoolPostsDTO)) {
            foreach ($carpoolPostsDTO as $carpoolPostDTO) {
                $carpoolPost = new CarpoolPost();
                $carpoolPost->setId($carpoolPostDTO['id']);
                $carpoolPost->setCreatorId($carpoolPostDTO['creatorId']);
                $carpoolPost->setStartAddress($carpoolPostDTO['startAddress']);
                $carpoolPost->setArrivalAddress($carpoolPostDTO['arrivalAddress']);
                $carpoolPost->setMessage($carpoolPostDTO['message']);
                $date = new DateTime($carpoolPostDTO['startDateTime']);
                if ($date !== false) {
                    $carpoolPost->setStartDateTime($date);
                }
                $posts[] = $carpoolPost;
            }
        }

        return $posts;
    }

    /**
     * Delete a carpool post
     */
    public function deleteCarpoolPost(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCarpoolPost($id);

        return $isOk;
    }

}