<?php

class Route {

    /**
     * @var string $method
     */
    protected $method;

    /**
     * @var string $uri;
     */
    protected $uri;

    /**
     * @var Controller $controller
     */
    protected $controller;

    public function __construct(string $method, string $uri, Controller $controller)
    {
        $this->method = strtolower($method);
        $this->uri = $uri;
        $this->controller = $controller;
    }

    public function toArray(){
        return array($this->method, $this->uri, $this->controller);
    }

    public function method() {
        return $this->method;
    }

    public function uri() {
        return $this->uri;
    }

    public function controller(){
        return $this->controller;
    }

    public function setMethod($method){
        $this->method = $method;
    }

    public function setUri($uri){
        $this->uri = $uri;
    }

    public function setController(Controller $controller){
        $this->controller = $controller;
    }
}