<?php

class Router
{
    /**
     * @var Route[] $routes
     */
    private $routes = array();

    /**
     * @var string $baseUri;
     */
    private $baseUri = '';

    public function __construct($baseUri = '')
    {
        $this->baseUri = $baseUri;
    }


    /* 
    |======================================
    |   User-defined Route Functions 
    |======================================
    |
    |   Allows user to define routes.
    |   Used to generate routes from routes.php 
    |
    */

    /**
     * Adds User Defined Route to Routes Array
     * 
     * @param Route $route
     * 
     * @return void
     */
    public function addRoute($route)
    {
        if ($this->baseUri !== ''){
            $uri = $this->baseUri . $route->uri();
            $route->setUri($uri);
        }
        //OLD
        //$this->routes[strtolower($method)][$uri] = $controller;
        $this->routes[] = $route;
    }


    /* 
    |======================================
    |   Pre-Defined Route Functions 
    |======================================
    */


    /**
     * Adds GET Route to Routes Array
     * 
     * @param string $uri
     * @param Controller $controller
     * 
     * @return void
     */
    public function get($uri, $controller){
        if ($this->baseUri !== ''){
            $uri = $this->baseUri . $uri;
        }
        $route = new Route('get', $uri, $controller);
        $this->routes[] = $route;
    }


    /**
     * Adds POST Route to Routes Array
     * 
     * @param string $uri
     * @param Controller $controller
     * 
     * @return void
     */
    public function post($uri, $controller){
        if ($this->baseUri !== ''){
            $uri = $this->baseUri . $uri;
        }
        $route = new Route('post', $uri, $controller);
        $this->routes[] = $route;
    }


    /**
     * Adds PUT Route to Routes Array
     * 
     * @param string $uri
     * @param Controller $controller
     * 
     * @return void
     */
    public function put(string $uri, Controller $controller){
        if ($this->baseUri !== ''){
            $uri = $this->baseUri . $uri;
        }
        $route = new Route('put', $uri, $controller);
        $this->routes[] = $route;
    }


    /**
     * Adds DELETE Route to Routes Array
     * 
     * @param string $uri
     * @param Controller $controller
     * 
     * @return void
     */
    public function delete(string $uri, Controller $controller){
        if ($this->baseUri !== ''){
            $uri = $this->baseUri . $uri;
        }
        $route = new Route('delete', $uri, $controller);
        $this->routes[] = $route;
    }


    /**
     *  Returns controller if there is a method & uri match, or null if no match is found
     * 
     * @param Request $request
     * 
     * @return Controller|null $controller
     */
    public function match(Request $request)
    {
        $controller = null;
        $method = strtolower($request->method());
        $uri = $request->uri();

        foreach($this->routes as $route){
            if ($route->method() == $method && $route->uri() == $uri){
                $controller = $route->controller();
                break;
            }
        }

        if ($controller !== null){
            return $controller;
        }
        return null;
    }


    /**
     *  Dispatch Request.
     *  If method/uri match is found, controller handles request. Else return access denied response.
     * 
     * @param Request $request
     * 
     * @return mixed $response
     */
    public function dispatch(Request $request)
    {
        $controller = $this->match($request);

        if ($controller !== null) {
            $controller->handle($request);
        } else {
            return response('Access Denied - Route Not Found', 404, 'Access Denied');
        }
    }


    /**
     * Return array of Routes
     * 
     * @return Route[] $routes
     */
    public function routes(){
        return $this->routes;
    }
}
