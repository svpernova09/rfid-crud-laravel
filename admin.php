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
require_once(dirname(__FILE__) . '/lib/autoloader.php');
if($debug) { var_dump($_SESSION); }
if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in'])){
    ?>
    Welcome to admin <?php if(isset($_SESSION['ircName'])) { echo $_SESSION['ircName']; } ?><br>
    <?php
    $crud = new Crud();

    switch($action){
        case "add":
            break;
        case "edit":
            $this_user = $crud->GetThisUser($key);
            ?>
            <pre><!-- <?php var_dump($this_user);?> --></pre>
            <?php
            if(count($this_user) == "1"){
                //show edit form
                ?>
                <h2>Editing <?php echo $this_user['0']['ircName']; ?></h2>
                <form id="edit_form" name="edit_form" method="POST" action="admin.php?action=doedit&rowid=<?php echo $this_user['0']['rowid']; ?>">
                    <label for="key">Key: </label>
                    <input type="text" name="key" id="key" value="<?php echo $this_user['0']['key']; ?>"><br />
                    <label for="key">Hash: </label>
                    <input type="text" name="hash" id="hash" value="<?php echo $this_user['0']['hash']; ?>"><br />
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

            ?>
            Run the edit
            <?php
            foreach($_POST AS $key => $value){
                $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
            }
            $data = array(':key'=>$_POST['key'],
                            ':hash'=>$_POST['hash'],
                            ':ircName'=>$_POST['ircName'],
                            ':spokenName'=>$_POST['spokenName'],
                            ':addedBy'=>$_POST['addedBy'],
                            ':dateCreated'=>$_POST['dateCreated'],
                            ':isAdmin'=>$_POST['isAdmin'],
                            ':lastLogin'=>$_POST['lastLogin'],
                            ':isActive'=>$_POST['isActive'],
                            ':rowid'=>$rowid);
            $errors = $crud->UpdateUser($data);
            if($errors['status'] == 'success'){
                ?>
                Update Successful<BR>
                <a href="admin.php">Back to Admin</a>
                <?php
            } else {
                $error_msg = "Failed to Update";
                echo $error_msg . "<br />";
                var_dump($errors);
            }
            break;
        default:
            $all_users = $crud->GetAll();
            ?>
                <pre><!-- <?php var_dump($all_users);?> --></pre>
                <table>
                    <thead>
                    <tr>
                        <td>RFID Tag</td>
                        <td>IRC Name</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>Edit</td>
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
