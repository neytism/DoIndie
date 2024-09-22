<?php

// main handler of routing
// this decides on what controller and methods to call

class App
{
    
    protected $controller = 'home';
    
    protected $method = 'index';

    protected $params = [];
    
    public function __construct(){
        $url = $this->parseUrl();
       
        //check if controller exist
       if($url && file_exists('app/controllers/' . $url[0].'.php')){
            $this->controller = $url[0];
            unset($url[0]);
       }
       
    
       require_once ('app/controllers/'.$this->controller.'.php');

       $this->controller = new $this->controller;
       
       //if there is method, set. else, index.
       if(isset($url[1])){
        if(method_exists($this->controller, $url[1])){
            $this->method = $url[1];
            unset($url[1]);
        }
       
       }
       
       $this->params = $url ? array_values($url): [];
       
       //call controller method
       call_user_func_array([ $this->controller,  $this->method], $this->params);
    
    }

    public function parseUrl(){
        if(isset($_GET['url'])){
            //echo $_GET['url'];
            return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return null;
    }
}