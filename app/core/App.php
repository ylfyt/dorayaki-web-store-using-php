<?php 

class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->parseURL();
        $idx = 0;

        // Controller
        if (isset($url[$idx])){
            $cont = ucfirst($url[$idx]);
            if (file_exists('../app/controllers/' . $cont . '.php')){
                $this->controller = $cont;
                unset($url[$idx]);
                $idx++;
            }
        }
        
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[$idx])){
            if ( method_exists($this->controller, $url[$idx]) ){
                $this->method = $url[$idx];
                unset($url[$idx]);
                $idx++;
            }
        }

        // Params
        if (!empty($url)){
            $this->params = array_values($url);
        }

        // Run the controller
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL(){
        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL); 
            $url = explode('/', $url);
            return $url;
        }
    }

}

?>  


