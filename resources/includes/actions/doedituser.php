<?php

//look at $_SESSION['key'] and check if Admin
// Or we could look at rowid and see if that key is $_SESSION['key']
$this_user = $crud->GetThisUserByRowId($rowid);
if($debug) { var_dump($this_user); }
if($_SESSION['key'] == $this_user['0']['key']){
    if(isset($_POST)){
        foreach($_POST AS $key => $value){
            $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
    }
    $data = array(':ircName'=>$_POST['ircName'],
        ':spokenName'=>$_POST['spokenName'],
        ':rowid'=>$rowid);
    if(!empty($_POST['pin'])){
        $hash = $crypto->SecureThis($_POST['pin']);
        $data[':hash'] = $hash;

    }
    $errors = $crud->UpdateUserSelf($data);
    if($errors['status'] == 'success'){
        $msg = "Update Successful";
    } else {
        $error_msg = "Failed to Update";
        echo $error_msg . "<br />";
        if($debug) { var_dump($errors); }
    }
}
header('Location: /user.php?msg='.$msg);
/*

*/
?>

