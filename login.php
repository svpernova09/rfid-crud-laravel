<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:27 PM
 * 
 */
//show login form

?>
<div class="login-wrapper">
    <h1>Log in</h1>
    <form name="login_form" id="login_form" action="admin.php" method="POST">
        <input type="text" name="pin" id="pin" placeholder="PIN">
        <input type="password" name="password" id="password" placeholder="password">
        <input type="submit" name="submit" id="submit" value="submit">
    </form>
</div>