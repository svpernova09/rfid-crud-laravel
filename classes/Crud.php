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
    public function UpdateUser($data){
        $this->ext_conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $params = $data;
        $update = $this->ext_conn->prepare("UPDATE users SET key = :key,
                                                            hash = :hash,
                                                            ircName = :ircName,
                                                            spokenName = :spokenName,
                                                            addedBy = :addedBy,
                                                            dateCreated = :dateCreated,
                                                            isAdmin = :isAdmin,
                                                            lastLogin = :lastLogin,
                                                            isActive = :isActive
                                             WHERE rowid = :rowid");

        $update->execute($data);

        if ($update->errorCode() == '0000') {
            return array('status' => 'success', 'rowid' => $params[':rowid']);
        } else {
            return array('status' => 'failure', 'reason' => 'update_failed','error' => $update->errorInfo());
        }
    }
    public function Delete(){

    }
    public function GetThisUser($key){
        $params = array(':key' => $key);
        $query = "SELECT rowid,* FROM users WHERE key = :key";
        $rows = $this->ext_conn->prepare($query);
        $rows->execute($params);
        $data = $rows->fetchall();
        // close the database connection
        $errors = $this->ext_conn->errorInfo();
        $db = NULL;
        return $data;
    }
    public function GetAll(){
        $params = array();
        $query = "SELECT rowid,* FROM users WHERE 1";
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