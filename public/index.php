<?php

require './../src/Api.php';
require './../src/DotEnv.php';
require './../src/Request.php';
require './../src/Response.php';
require './../src/Route.php';
require './../src/Router.php';
require './../src/Auth.php';
require './../src/Controller.php';


$request = new Request();
$router = new Router();
$auth = new Auth();
$sapi_type = php_sapi_name();
$dot = new DotEnv();
$dot->load();

/*
|==========================================
|   Auth
|==========================================
|
|   Check if the client has access rights.
|
*/

if ($auth->isAuthorized($request)) {


    /*
    |==========================================
    | ROUTES
    |==========================================
    */

    //  Example of Routes
    $router->addRoute(new Route('GET', '/', new Controller('Api', 'index')));
    $router->get('/update', new Controller('Api', 'updateRoutes'));


    /*
    |==========================================
    |   Generate Available Routes
    |==========================================
    */

    $routes = Api::generateRoutes();
    Api::generateControllers();
    foreach ($routes as $route) {
        $router->addRoute($route);
    }


    /*
    |==========================================
    | Dispatch Router
    |==========================================
    */
    $router->dispatch($request);
} else {
    return response('Access Denied', 403, 'Access Denied');
}
