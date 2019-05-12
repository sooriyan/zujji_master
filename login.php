<?php

require_once('header.php');
if(isset($_SESSION['user'])){
	header('location:home.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/zujji.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>

</head>

<body style="background-color:#fdfdfd;">
    <div class="container">
        <div class="row">
            <div class=" col-sm-2 col-lg-4 col-md-3 col-xs-12"></div>
            <div class=" col-sm-8 col-lg-4 col-md-6 col-xs-12">
                <div style="margin-top: 100px;">
                    <form  action="dbactions.php" method="post">
                        <!-- <span><img src="photos/logo.png"></span> -->
                        <span class="text_center"><h3 style="margin-top:0px; padding:10px 0px;">Log In</h3></span>
                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div style="color: red;">
                            <?php 
                                if(isset($_SESSION['pwderr'])){
                                    echo $_SESSION['pwderr'];
                                    unset($_SESSION['pwderr']);
                                }
                            ?>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" style="width:100%" value="login">Login</button>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 " style="padding-top:10px;"><a href="forgot_password.php">Forgot Password</a></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 margin text-right" style="padding-top:10px;"><a href="signup.php">New User</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class=" col-sm-2 col-lg-4 col-md-3 col-xs-12"></div>
    </div>
</body>

</html>