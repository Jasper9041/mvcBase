<?php
class Test extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function Index(){
        $this->model->Index();
        $this->view->render('test/test');
    }

}
