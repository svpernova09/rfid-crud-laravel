<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 2:51 PM
 *
 * $database_path MUST be writable by the user that accessing the database
 *
 */

$debug = 1;
$database_path = '/'; // MUST end with a /
$database_name = 'database.sqlite';
require_once(dirname(__FILE__) . '/../lib/autoloader.php');