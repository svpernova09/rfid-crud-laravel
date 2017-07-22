<?php

if(isset($_POST)){
    foreach($_POST AS $key => $value){
        $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
}
$date = new DateTime();
$hash = $crypto->SecureThis($_POST['pin']);
$addedBy = $_SESSION['key'];
$dateCreated = $date->getTimestamp();
$clean_key = $crud->CleanKey($_POST['key']);
$data = array(':key'=>$clean_key,
    ':hash'=>$hash,
    ':ircName'=>$_POST['ircName'],
    ':spokenName'=>$_POST['spokenName'],
    ':addedBy' =>$addedBy,
    ':dateCreated' =>$dateCreated,
    ':isAdmin'=>$_POST['isAdmin'],
    ':isActive'=>$_POST['isActive']);
if($debug) { var_dump($data); }
$errors = $crud->Create($data);
if($errors['status'] == 'success'){
    ?>
    Add User Successful<BR>
    <a href="admin.php">Back to Admin</a>
    <?php
    if($debug) { var_dump($errors); }
} else {
    $error_msg = "Failed to Add";
    echo $error_msg . "<br />";
    if($debug) { var_dump($errors); }
}