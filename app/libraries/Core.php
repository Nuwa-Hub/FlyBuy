<?php

class Core{

    protected $currentController = 'PageController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        
        $url = $this->getUrl();
        print("url: ");
        var_dump($url);

        //look in controllers for first value
        //ucwords will capitalize first letter
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){

            //will set a new controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;
    
        //checks the second part of the url
        if(isset($url[1])){

            if(method_exists($this->currentController, $url[1])){
                
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        //get parameters
        $this->params = $url ? array_values($url) : [];

        //call callback func with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){

        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}

?>