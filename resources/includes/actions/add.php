<?php

if(isset($_POST)){
    foreach($_POST AS $key => $value){
        $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
}
require_once('admin-menu.php');
?>
    <h2>New User</h2>
    <form id="add_form" name="add_form" method="POST" action="admin.php?action=doadd">
        <div class="form-group">
            <label for="key">Key: </label>
            <input type="text" name="key" id="key" value="<?php if(isset($_POST['key'])) { echo $_POST['key']; } ?>"><br />
        </div>
        <div class="form-group">
            <label for="key">PIN: </label>
            <input type="password" name="pin" id="pin" value="<?php if(isset($_POST['pin'])) { echo $_POST['pin']; } ?>"><br />
        </div>
        <div class="form-group">
            <label for="key">IRC Name: </label>
            <input type="text" name="ircName" id="ircName" value="<?php if(isset($_POST['ircName'])) { echo $_POST['ircName']; } ?>"><br />
        </div>
        <div class="form-group">
            <label for="key">Spoken Name: </label>
            <input type="text" name="spokenName" id="spokenName" value="<?php if(isset($_POST['spokenName'])) { echo $_POST['spokenName']; } ?>"><br />
        </div>
        <div class="form-group">
            <label for="key">Is Admin: </label>
            <input type="text" name="isAdmin" id="isAdmin" value="<?php if(isset($_POST['isAdmin'])) { echo $_POST['isAdmin']; } ?>"><br />
        </div>
        <div class="form-group">
            <label for="key">Is Active: </label>
            <input type="text" name="isActive" id="isActive" value="<?php if(isset($_POST['isActive'])) { echo $_POST['isActive']; } ?>"><br />
        </div>
        <div class="form-group">
            <input class="button" type="submit" name="submit" id="submit" value="submit">
        </div>
    </form>
