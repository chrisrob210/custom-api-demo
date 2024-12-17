<?php
require_once __DIR__ . '/controllers/test.php';
$dir = (pathinfo(__DIR__))['basename'];

return $routes = array(
    new Route(
        'GET',
        "/$dir/one",
        new Controller('Test', 'one')
    ),
    
    new Route(
        'GET',
        "/$dir/two",
        new Controller('Test', 'two')
    ),
    
    new Route(
        'GET',
        "/$dir/three",
        new Controller('Test', 'three')
    )
);
