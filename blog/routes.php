<?php
require_once __DIR__ . '/controllers/BlogController.php';
$dir = (pathinfo(__DIR__))['basename'];

return $routes = array(
    new Route(
        'GET',
        "/$dir/latest",
        new Controller('BlogController', 'latest')
    ),

    new Route(
        'GET',
        "/$dir/popular",
        new Controller('BlogController', 'popular')
    ),

    new Route(
        'GET',
        "/$dir/oldest",
        new Controller('BlogController', 'oldest')
    )
);
