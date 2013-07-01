<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 7/1/13
 * Time: 2:48 PM
 *
 */
abstract class Config {

    private static $ext_conn = null;

    private static function init() {
        include(dirname(__FILE__) . '/../config/config.php');
        try {
            self::$ext_conn = new PDO('sqlite:' . $database_path . $database_name);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getDBConnection() {
        if (!self::$ext_conn) self::init();
        return self::$ext_conn;
    }
}
?>