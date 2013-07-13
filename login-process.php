<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 7/13/13
 * Time: 2:47 PM
 * 
 */
session_unset();
session_start();
include(dirname(__FILE__) . '/config/config.php');
if(isset($_POST['pin'])){
    $key = filter_var($_POST['pin'], FILTER_SANITIZE_STRING);
}
if(isset($_POST['password'])){
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['key'])){
    $key = filter_var($_GET['key'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['rowid'])){
    $rowid = filter_var($_GET['rowid'], FILTER_SANITIZE_STRING);
}
require_once(dirname(__FILE__) . '/lib/autoloader.php');
$crypto = new Crypto();

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
    $stored_hash = $data['0']['hash'];
} catch(PDOException $e) {
    print 'Exception : '.$e->getMessage();
}
$stored = explode('$',$stored_hash);
$supplied_check = $crypto->CheckThis($password, $stored['2']);
$supplied = explode('$',$supplied_check);
$user_hash = $stored['3'];
$supplied_hash = $supplied['3'];

if((($supplied_hash == $user_hash) && $data['0']['isAdmin'])){
    //user authenticated
    setcookie("logged_in", 1, time()+3600);  /* expires in 1 hour */
    $_SESSION['logged_in'] = 1;
    $_SESSION['ircName'] = $data['0']['ircName'];
    header('Location: /admin.php');
} else {
    //login failed
    $msg = urldecode("Invalid Login");
    //header('Location: /login.php?msg=' . $msg);
}
?>