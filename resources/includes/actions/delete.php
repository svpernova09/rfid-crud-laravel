<?php

$row_id = filter_var($_GET['rowid'], FILTER_SANITIZE_STRING);
$errors = $crud->Remove($row_id);
if($errors['status'] == 'success'){
    ?>
    Remove Successful<BR>
    <a href="admin.php">Back to Admin</a>
    <?php
} else {
    $error_msg = "Failed to Remove";
    echo $error_msg . "<br />";
    if($debug) { var_dump($errors); }
}

?>

