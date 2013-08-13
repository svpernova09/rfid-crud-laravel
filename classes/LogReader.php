<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 8/13/13
 * Time: 12:36 PM
 * 
 */

class LogReader extends Config {

    public function LogReader(){
        $this->ext_conn = self::getDBConnection();
    }

    /**
     * Get the entire log file
     */
    public function GetLogs(){

    }
    /**
     * Get access granted logs
     */
    public function GetAccessGranted(){

    }
    /**
     * Get access denied logs
     */
    public function GetAccessDenied(){

    }
}