<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 8/13/13
 * Time: 12:36 PM
 * 
 */

class LogReader extends Config {
    private static function init() {

    }
    public function LogReader($config){
        $this->ext_conn = self::getDBConnection();
    }

    /**
     * Get the entire log file
     */
    public function GetLogs(){
        $lines = file($config['log_path'] . $config['log_name'], FILE_IGNORE_NEW_LINES);
        return $lines;
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