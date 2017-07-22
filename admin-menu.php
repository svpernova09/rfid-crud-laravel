<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 7/19/13
 * Time: 9:50 PM
 * 
 */
?>
<div class="admin_menu col-lg-4">
    <h1>Welcome to admin <?php if(isset($_SESSION['ircName'])) { echo $_SESSION['ircName']; } ?></h1>
    <a href="admin.php">Admin Home</a> |
    <a href="admin.php?action=add">Add User</a> |
    <a href="admin.php?action=viewlogs">View logs</a> |
</div>