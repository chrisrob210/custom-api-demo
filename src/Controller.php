<?php

class Controller {
    protected $className;
    protected $classFunction;


    /**
     * Instantiates Controller
     * 
     * @param string $className name of Class
     * @param string $classFunction name of Static Function to be called
     */
    public function __construct($className, $classFunction)
    {
        $this->className = $className;
        $this->classFunction = $classFunction;
    }


    /**
     * Calls Static Function defined during instantiation
     * 
     * @param Request $request
     * 
     * @return mixed $response
     */
    public function handle(Request $request){
        return call_user_func($this->toArray(), $request);
    }


    /**
     * Returns Controller as an array
     * 
     * @return array $controller array(`string $className`, `string $classFunction`)
     */
    public function toArray() {
        return array($this->className, $this->classFunction);
    }
}