<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:27 PM
 * 
 */
session_start();
//show login form
if(isset($_GET['msg']) && $_GET['msg'] == 'Invalid Login'){
    $msg = filter_var($_GET['msg'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['msg']) && $_GET['msg'] == 'Please Log In'){
    $msg = filter_var($_GET['msg'], FILTER_SANITIZE_STRING);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MidsouthMakers RFID</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper col-lg-4">
        <h1>Log in</h1>
        <?php if(isset($msg)){ ?>
            <div class="error">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
        <form name="login_form" id="login_form" action="login-process.php" method="POST">
            <div class="form-group">
                <input class="form-control" type="text" name="pin" id="pin" placeholder="PIN">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" id="password" placeholder="password">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" value="Submit">
            </div>
        </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/lib/jquery-1.10.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
</body>
</html>