<?php

$this_user = $crud->GetThisUser($key);
?>
<?php
if(count($this_user) == "1"){
    //show edit form
    require_once('resources/includes/header.php');
    require_once('admin-menu.php');
    ?>
    <h2>Editing <?php echo $this_user['0']['ircName']; ?></h2>
    <form id="edit_form" name="edit_form" method="POST" action="admin.php?action=doedit&rowid=<?php echo $this_user['0']['rowid']; ?>">
        <div class="form-group">
            <label for="key">Key: </label>
            <?php echo $this_user['0']['key']; ?>
        </div>
        <div class="form-group">
            <label for="key">PIN: *leave blank to keep current PIN</label>
            <input type="password" name="pin" id="pin" value="">
        </div>
        <div class="form-group">
            <label for="key">IRC Name: </label>
            <input type="text" name="ircName" id="ircName" value="<?php echo $this_user['0']['ircName']; ?>">
        </div>
        <div class="form-group">
            <label for="key">Spoken Name: </label>
            <input type="text" name="spokenName" id="spokenName" value="<?php echo $this_user['0']['spokenName']; ?>">
        </div>
        <div class="form-group">
            <label for="key">Added By: </label>
            <input type="text" name="addedBy" id="addedBy" value="<?php echo $this_user['0']['addedBy']; ?>">
        </div>
        <div class="form-group">
            <label for="key">Date Created: </label>
            <input type="text" name="dateCreated" id="dateCreated" value="<?php echo $this_user['0']['dateCreated']; ?>">
        </div>
        <div class="form-group">
            <label for="key">Is Admin: </label>
            <input type="text" name="isAdmin" id="isAdmin" value="<?php echo $this_user['0']['isAdmin']; ?>">
        </div>
        <div class="form-group">
            <label for="key">Last Login: </label>
            <input type="text" name="lastLogin" id="lastLogin" value="<?php echo $this_user['0']['lastLogin']; ?>">
        </div>
        <div class="form-group">
            <label for="key">Is Active: </label>
            <input type="text" name="isActive" id="isActive" value="<?php echo $this_user['0']['isActive']; ?>">
        </div>
        <div class="form-group">
            <input class="button" type="submit" name="submit" id="submit" value="submit">
        </div>
    </form>
    <?php
    require_once('resources/includes/footer.php');
}