<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:29 PM
 * 
 */

class Crud extends Config {

    public function Crud(){
        $this->ext_conn = self::getDBConnection();
    }
    public function Create(){

    }
    public function Update(){

    }
    public function Delete(){

    }
    public function GetAll(){
        $params = array();
        $query = "SELECT * FROM users WHERE 1";
        $rows = $this->ext_conn->prepare($query);
        $rows->execute($params);
        $data = $rows->fetchall();
        // close the database connection
        $errors = $this->ext_conn->errorInfo();
        $db = NULL;
        return $data;
    }
}
?>