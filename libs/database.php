<?php

class Database extends PDO {

    function __construct($DB_TYPE,$HOST,$DATABSE,$USERNAME,$PASSWORD) {
        parent::__construct("$DB_TYPE:host=$HOST;dbname=$DATABSE", "$USERNAME","$PASSWORD");
    }
    
    public function insert() {
        
    }
    
    public function update() {
        
    }
    public function delete() {
        
    }
    

}