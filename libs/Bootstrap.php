<?php

class Bootsrap {

    private $_url = null;
    
    function __construct() {
        require_once 'libs/Controller.php';
        require_once 'libs/Model.php';
        require_once 'libs/View.php';
        
        $this->_url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->_url = rtrim($this->_url, '/');
        $this->_url = explode('/', $this->_url);
        
        if(empty($this->_url[0])){
            require 'controllers/index.php';
            $this->_controller = new Index();
            $this->_controller->index();
        }else{
            $file = 'controllers/'. $this->_url[0] . '.php';
            if(file_exists($file)){
                require $file;
            }else{
                $this->error();
            }
            $this->_controller = new $this->_url[0];
            if(empty($this->_url[1])){
                $this->_controller->index();
            }else{
                if(method_exists($this->_controller,$this->_url[1])){
                    if(empty($this->_url[2])){
                        $this->_controller->{$this->_url[1]}();
                    }else{
                       $this->_controller->{$this->_url[1]}($this->_url[2]); 
                    }
                }else{
                    $this->error();
                }
            }
        }
        
    }
    
    private function error(){
        require 'controllers/error.php';
        $this->_controller = new Error();
        return false;
    }
    

}
