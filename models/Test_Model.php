<?php

class Test_Model extends Model{

    function __construct() {
        parent::__construct();
    }
    
    public function Index(){
        echo 'this is the test model!<br/>';
        $this->db->insert("users",array(
            "name" => "test"
        ));
        echo 'this is the test model!<br/>';
    }

}

