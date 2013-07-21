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
if(isset($_GET['msg']) && $_GET['msg'] == 'Update Successful'){
    $msg = filter_var($_GET['msg'], FILTER_SANITIZE_STRING);
}
?>
<h1>Editing <?php echo $this_user['0']['ircName']; ?></h1>
<?php if(isset($msg)){ ?>
    <div class="error">
        <?php echo $msg; ?>
    </div>
<?php } ?>
<form id="edit_form" name="edit_form" method="POST" action="admin.php?action=doedituser&rowid=<?php echo $this_user['0']['rowid']; ?>">
    <label for="key">Key: </label>
    <?php echo $this_user['0']['key']; ?><br />
    <label for="key">PIN: *leave blank to keep current PIN</label>
    <input type="password" name="pin" id="pin" value=""><br />
    <label for="key">IRC Name: </label>
    <input type="text" name="ircName" id="ircName" value="<?php echo $this_user['0']['ircName']; ?>"><br />
    <label for="key">Spoken Name: </label>
    <input type="text" name="spokenName" id="spokenName" value="<?php echo $this_user['0']['spokenName']; ?>"><br />
    <label for="key">Added By: </label>
    <?php echo $this_user['0']['addedBy']; ?><br />
    <label for="key">Date Created: </label>
    <?php echo $this_user['0']['dateCreated']; ?><br />
    <label for="key">Last Login: </label>
    <?php echo $this_user['0']['lastLogin']; ?><br />
    <label for="key">Is Active: </label>
    <?php echo $this_user['0']['isActive']; ?><br />
    <input type="submit" name="submit" id="submit" value="submit">

</form>