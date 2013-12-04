<?php

class Database extends PDO {

    function __construct($DB_TYPE, $HOST, $DATABSE, $USERNAME, $PASSWORD) {
        parent::__construct("$DB_TYPE:host=$HOST;dbname=$DATABSE", "$USERNAME", "$PASSWORD");
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        parent::setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function insert($table, $data) {
        $fields = implode('`, `', array_keys($data));
        $placeholders = ':' . implode(", :", array_keys($data));
        $sql = $this->prepare("INSERT INTO $table (`$fields`) VALUES ($placeholders)");

        foreach ($data as $key => $value) {
            $sql->bindValue(":$key", $value);
        }

        $sql->execute();
    }

    public function update($table, $data, $where) {

        $vals = "";
        foreach ($data as $key => $value) {
            $vals .= "$key=:$key, ";
        }
        $vals = rtrim($vals, ", ");
       echo "UPDATE $table $vals WHERE $where";
        $sql = $this->prepare("UPDATE $table SET $vals WHERE $where");

        foreach ($data as $key => $value) {
            $sql->bindValue(":$key", $value);
        }

        $sql->execute();
    }

    public function delete($table, $where, $limit = 1) {
        $sql = $this->prepare("DELETE FROM $table WHERE $where LIMIT $limit");
        $sql->execute();
    }
    
     public function select($query, $data = array(), $mode = PDO::FETCH_ASSOC){
        $sql = $this->prepare($query);
        foreach ($data as $key => $value) {
            $sql->bindValue("$key", $value);
        }
        
        $sql->execute();
        return $sql->fetchAll($mode);
    }

}
