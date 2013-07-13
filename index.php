<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:07 PM
 * 
 */
session_start();
// initial checks
if(is_file('config/config.php')){
    include('config/config.php');
    if($debug){ echo "<!-- config.php loaded -->"; }
} else {
    ?>
    config/config.php is missing. Please view the README.md for installation notes.<BR>
    <?php
}
if(is_file($database_path . $database_name)){
    // do nothing if database exists
    if($debug){ echo "<!-- database found -->"; }
} else {
    ?>
    Database not found. Please view the README.md for installation notes.<BR>
    <?php
}
if($_SESSION['logged_in']){
    if($debug){ echo "<!-- Found Logged in Session -->"; }
    header('Location: admin.php');
}
// initial checks done
header('Location: login.php');

?>