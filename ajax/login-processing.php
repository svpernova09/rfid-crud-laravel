<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:31 PM
 * 
 */
// Sanitize the datas
include(dirname(__FILE__) . '/../config/config.php');
$key = filter_var($_POST['pin'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
require_once(dirname(__FILE__) . '/../lib/autoloader.php');
$crypto = new Crypto();

$user_hash = $crypto->SecureThis($key);
try{
    //open the database
    $db = new PDO('sqlite:' . $database_path . $database_name);
    $params = array(':key' => $key);
    $query = "SELECT * FROM users WHERE key = :key";
    $rows = $db->prepare($query);
    $rows->execute($params);
    $data = $rows->fetchall();
    // close the database connection
    $errors = $db->errorInfo();
    $db = NULL;
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    $stored_hash = $data['hash'];
} catch(PDOException $e) {
    print 'Exception : '.$e->getMessage();
}


echo 'Stored Hash: ' . $stored_hash . '<BR />';

// feed crypt the supplied key and the hash
$supplied_hash = crypt($key, $stored_hash);
echo 'Supplied Hash: ' . $supplied_hash . '<BR />';
?>
PIN: <?php echo $pin; ?><br />
Passwrd: <?php echo $password; ?><br />
User Hash: <?php echo $user_hash; ?><br />
<script src="../lib/jquery-1.10.1.min.js"></script>
