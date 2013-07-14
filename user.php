<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 7/14/13
 * Time: 4:50 PM
 * 
 */
session_start();
include(dirname(__FILE__) . '/config/config.php');
$crud = new Crud();
$this_user = $crud->GetThisUser($_SESSION['key']);
if($debug){ var_dump($this_user); }