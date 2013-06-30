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
    <form name="login_form" id="login_form" action="#" method="POST">
        <input type="text" name="pin" id="pin" placeholder="PIN">
        <input type="password" name="password" id="password" placeholder="password">
        <input type="submit" name="submit" id="submit" value="submit">
    </form>
</div>
<script src="lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#login_form').submit(function(e){
            e.preventDefault();
            //Ajax request to save form
            var fields = $(this).serialize();
            $.ajax({
                url: 'ajax/login-processing.php',
                dataType: 'html',
                type: 'POST',
                data: fields,
                success: function(data){
                    window.location = "/admin.php";

                }
            });
        });
    })
</script>