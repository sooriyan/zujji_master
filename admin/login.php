
<?php

require_once('../header.php');
// if(isset($_SESSION['user'])){
// 	header('location:home.php');
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="../js/jquery.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/zujji.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<title>Login</title>

</head>
<body style="background-color:#fdfdfd;">
    <div class="container">
        <div class="row">
            <div class=" col-sm-2 col-lg-4 col-md-3 col-xs-12"></div>
            <div class=" col-sm-8 col-lg-4 col-md-6 col-xs-12">
                <div style="margin-top: 100px;">
                    <form  action="adminactions.php" method="post">
                        <!-- <span><img src="photos/logo.png"></span> -->
                        <span class="text_center"><h3 style="margin-top:0px; padding:10px 0px;">Zujji Admin</h3></span>
                        <?php 
                            if(isset($_SESSION['failure'])){
                                echo $_SESSION['failure'];
                                unset($_SESSION['failure']);
                            }
                        ?>
                        <input type="text" name="adminemail" class="form-control" placeholder="Email" required>
                        <input type="password" name="adminpassword" class="form-control" placeholder="Password" required>
                        
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" style="width:100%" value="adminlogin">Login</button>
                    	<br>
                    	<br>
                    </form>
                </div>
            </div>
        </div>
        <div class=" col-sm-2 col-lg-4 col-md-3 col-xs-12"></div>
    </div>
</body>
</html>	