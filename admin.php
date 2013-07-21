<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:26 PM
 * 
 */
// Admin Functions
session_start();
include(dirname(__FILE__) . '/config/config.php');
if(isset($_POST['pin'])){
    $key = filter_var($_POST['pin'], FILTER_SANITIZE_STRING);
}
if(isset($_POST['password'])){
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['action'])){
    $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['key'])){
    $key = filter_var($_GET['key'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['rowid'])){
    $rowid = filter_var($_GET['rowid'], FILTER_SANITIZE_STRING);
}
if(!isset($action)) {
    $action = 'default';
}
if($debug) { var_dump($_SESSION); }
if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'])){
    ?>
    Welcome to admin <?php if(isset($_SESSION['ircName'])) { echo $_SESSION['ircName']; } ?><br>
    <?php
    $crud = new Crud();
    $crypto = new Crypto();
    switch($action){
        case "add":
            if(isset($_POST)){
                foreach($_POST AS $key => $value){
                    $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
                }
            }
            require_once('admin-menu.php');
            ?>
            <h2>New User</h2>
            <form id="add_form" name="add_form" method="POST" action="admin.php?action=doadd">
                <label for="key">Key: </label>
                <input type="text" name="key" id="key" value="<?php if(isset($_POST['key'])) { echo $_POST['key']; } ?>"><br />
                <label for="key">PIN: </label>
                <input type="password" name="pin" id="pin" value="<?php if(isset($_POST['pin'])) { echo $_POST['pin']; } ?>"><br />
                <label for="key">IRC Name: </label>
                <input type="text" name="ircName" id="ircName" value="<?php if(isset($_POST['ircName'])) { echo $_POST['ircName']; } ?>"><br />
                <label for="key">Spoken Name: </label>
                <input type="text" name="spokenName" id="spokenName" value="<?php if(isset($_POST['spokenName'])) { echo $_POST['spokenName']; } ?>"><br />
                <label for="key">Is Admin: </label>
                <input type="text" name="isAdmin" id="isAdmin" value="<?php if(isset($_POST['isAdmin'])) { echo $_POST['isAdmin']; } ?>"><br />
                <label for="key">Is Active: </label>
                <input type="text" name="isActive" id="isActive" value="<?php if(isset($_POST['isActive'])) { echo $_POST['isActive']; } ?>"><br />
                <input type="submit" name="submit" id="submit" value="submit">
            </form>
            <?php
            break;
        case "doadd":
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
            break;
        case "edit":
            $this_user = $crud->GetThisUser($key);
            ?>
            <pre><!-- <?php if($debug) { var_dump($this_user); } ?> --></pre>
            <?php
            if(count($this_user) == "1"){
                //show edit form
                require_once('admin-menu.php');
                ?>
                <h2>Editing <?php echo $this_user['0']['ircName']; ?></h2>
                <form id="edit_form" name="edit_form" method="POST" action="admin.php?action=doedit&rowid=<?php echo $this_user['0']['rowid']; ?>">
                    <label for="key">Key: </label>
                    <?php echo $this_user['0']['key']; ?><br />
                    <label for="key">PIN: *leave blank to keep current PIN</label>
                    <input type="password" name="pin" id="pin" value=""><br />
                    <label for="key">IRC Name: </label>
                    <input type="text" name="ircName" id="ircName" value="<?php echo $this_user['0']['ircName']; ?>"><br />
                    <label for="key">Spoken Name: </label>
                    <input type="text" name="spokenName" id="spokenName" value="<?php echo $this_user['0']['spokenName']; ?>"><br />
                    <label for="key">Added By: </label>
                    <input type="text" name="addedBy" id="addedBy" value="<?php echo $this_user['0']['addedBy']; ?>"><br />
                    <label for="key">Date Created: </label>
                    <input type="text" name="dateCreated" id="dateCreated" value="<?php echo $this_user['0']['dateCreated']; ?>"><br />
                    <label for="key">Is Admin: </label>
                    <input type="text" name="isAdmin" id="isAdmin" value="<?php echo $this_user['0']['isAdmin']; ?>"><br />
                    <label for="key">Last Login: </label>
                    <input type="text" name="lastLogin" id="lastLogin" value="<?php echo $this_user['0']['lastLogin']; ?>"><br />
                    <label for="key">Is Active: </label>
                    <input type="text" name="isActive" id="isActive" value="<?php echo $this_user['0']['isActive']; ?>"><br />

                    <input type="submit" name="submit" id="submit" value="submit">

                </form>
                <?php
            }
            break;
        case "doedit":
            require_once('admin-menu.php');
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
            break;
        case "delete":
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
            break;
        default:
            require_once('admin-menu.php');
            $all_users = $crud->GetAll();
            ?>
                <pre><!-- <?php if($debug) { var_dump($all_users); } ?> --></pre>
                <table>
                    <thead>
                    <tr>
                        <td>RFID Tag</td>
                        <td>IRC Name</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($all_users AS $user){
                        ?>
                        <tr>
                            <td><?php echo $user['key']; ?></td>
                            <td><?php echo $user['ircName']; ?></td>
                            <td><?php echo $user['isAdmin']; ?></td>
                            <td><?php echo $user['isActive']; ?></td>
                            <td><a href="admin.php?action=edit&key=<?php echo $user['key']; ?>">Edit</a></td>
                            <td><a href="admin.php?action=delete&rowid=<?php echo $user['rowid']; ?>">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            <?php
            break;
    }

} else {
    //login failed
    $msg = urldecode("Please Log In");
    //header('Location: /login.php?msg=' . $msg);
}
?>
