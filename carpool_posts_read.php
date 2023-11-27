<?php

use App\Controllers\CarpoolPostsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarpoolPostsController();
echo $controller->getCarpoolPosts();

