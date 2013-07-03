<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:27 PM
 * 
 */
//show login form
if(isset($_GET['msg']) && $_GET['msg'] == 'Invalid Login '){
    $msg = filter_var($_GET['msg'], FILTER_SANITIZE_STRING);
}
?>
<html>
    <head>
        <title>rfid-php-crud - log in</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="login-wrapper">
            <h1>Log in</h1>
            <?php if(isset($msg)){ ?>
                <div class="error">
                    <?php echo $msg; ?>
                </div>
            <?php } ?>
            <form name="login_form" id="login_form" action="admin.php" method="POST">
                <input type="text" name="pin" id="pin" placeholder="PIN">
                <input type="password" name="password" id="password" placeholder="password">
                <input type="submit" name="submit" id="submit" value="submit">
            </form>
        </div>
    </body>
</html>