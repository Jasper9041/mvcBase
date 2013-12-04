<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->view->title = "Error";
        $this->view->message = 'An error occured!';
        $this->view->render('error');
    }
}
