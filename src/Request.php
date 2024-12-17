<?php

class Request {

    private $request;
    private $headers;
    private $content;

    /**
     * Captures HTTP Request on instantiation
     */
    public function __construct()
    {
        $this->request = array_merge($_SERVER, array('GET' => $_GET), array('POST' => $_POST));
        $this->headers = $this->setHeaders($this->request);
        if ($this->request['REQUEST_METHOD'] == 'POST' || $this->request['REQUEST_METHOD'] == 'PUT'){
            $this->content = json_decode(file_get_contents('php://input'));
        }
    }


    /**
     *  Returns Headers, Request, and Body Content
     * 
     * @return array $request
     */
    public function all() {
        if ($this->content){
            return array('HEADERS' => $this->headers, 'REQUEST' => $this->request, "CONTENT" => $this->content);
        } else {
            return array('HEADERS' => $this->headers, 'REQUEST' => $this->request);
        }
    }


    /**
     *  Returns Header If header name is provided or All Headers if omitted
     * 
     * @param string $header 
     * 
     * @return mixed|array|null $headers
     */
    public function headers($header = null){
        if ($header == null){ 
            return $this->headers;
        } 

        if ($this->headers[$header]){
            return $this->headers[$header];
        }
        
        return null;
    }


    /**
     *  Returns Request Method
     * 
     * @return string $method
     */
    public function method() {
        return $this->request['REQUEST_METHOD'];
    }


    /**
     *  Returns Request URI Path
     * 
     * @return string $path
     */
    public function uri() {
        return $this->request['REQUEST_URI'];
    }


    /**
     * Returns Request Body Content
     * 
     * @return mixed $content
     */
    public function content() {
        return $this->content;
    }


    /**
     *  Private function that sets Headers and removes Header data from Request
     * 
     * @return array $headers
     */
    private function setHeaders(){
        //var_dump($this->request);
        $headers = array();
        foreach($this->request as $key => $val){
            if (strpos($key, 'HTTP_') !== false){
                $headers[str_replace('HTTP_', '', $key)] =  $val;
                unset($this->request[$key]);
            }
        }
        return $headers;
    }
}