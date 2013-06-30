<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:07 PM
 * 
 */
// initial checks
if(is_file('config/config.php')){
    include('config/config.php');
} else {
    ?>
    config/config.php is missing. Please view the README.md for installation notes.<BR>
    <?php
}
if(is_file($database_path . $database_name)){
    // do nothing if database exists
} else {
    ?>
    Database not found. Please view the README.md for installation notes.<BR>
<?php
}

?>