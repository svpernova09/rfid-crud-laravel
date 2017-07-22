<?php

if(isset($_POST)){
    foreach($_POST AS $key => $value){
        $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
}
$data = array(':ircName'=>$_POST['ircName'],
    ':spokenName'=>$_POST['spokenName'],
    ':addedBy'=>$_POST['addedBy'],
    ':dateCreated'=>$_POST['dateCreated'],
    ':isAdmin'=>$_POST['isAdmin'],
    ':lastLogin'=>$_POST['lastLogin'],
    ':isActive'=>$_POST['isActive'],
    ':rowid'=>$rowid);
if(!empty($_POST['pin'])){
    $hash = $crypto->SecureThis($_POST['pin']);
    $data[':hash'] = $hash;

}
$errors = $crud->UpdateUser($data);
if($errors['status'] == 'success'){
    ?>
    Update Successful<BR>
    <a href="admin.php">Back to Admin</a>
    <?php
} else {
    $error_msg = "Failed to Update";
    echo $error_msg . "<br />";
    if($debug) { var_dump($errors); }
}

?>

