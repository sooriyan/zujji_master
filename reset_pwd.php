<?php
	require_once('header.php');
	if(!isset($_SESSION['user'])){
    	header('location:login.php');
    }
?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/zujji.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="myscript.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.retypepwd').on('keyup', function() {
                    if ($('.new_pwd').val() == $('.retypepwd').val()) {
                        $('.new_pwd').css('color', 'green');
                        $('.retypepwd').css('color', 'green');
                        $('.reset').prop('disabled', false);
                        $('.err').text('*Password match').css('color', 'green');
                    } else {
                        $('.new_pwd').css('color', 'red');
                        $('.retypepwd').css('color', 'green');
                        $('.reset').prop('disabled', 'disabled');
                        $('.err').text('*Password doesnt match').css('color', 'red');
                    }
                });
            });
        </script>
        <title>Reset Password</title>
    </head>

    <body style="background-color:#fdfdfd;">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">ZUJJI</a>
                </div>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="login.php">Home</a></li>
                    <li class="dropdown active">
                        <a class="dropdown-toggle " data-toggle="dropdown" href="#">
                            <?php echo $_SESSION['user']['fname'];?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="active"><a href="myaccount.php">My Account</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <br>
        <br>
        <div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>
        <div class=" col-sm-8 col-lg-10 col-md-10 col-xs-12">
            <!-- <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <a class="navbar-brand">RESET PASSWORD</a>
                    </div>
                </nav> -->
            <?php
    			if(isset($_SESSION['successmsg'])){
    				echo $_SESSION['successmsg'];
    				unset($_SESSION['successmsg']);
    			}
    			elseif (isset($_SESSION['errormsg'])) {
    				echo $_SESSION['errormsg'];
    				unset($_SESSION['errormsg']);
    			}
    		?>
                <div class="container-fluid">
                    <form style="margin-top:50px;" action="dbactions.php" method="post">
                        <span class="text_center"><h3 style="margin-top:0px; padding:10px 0px;">Reset Password</h3></span> Old Password:
                        <br>
                        <input type="password" name="password" class="form-control old_pwd">
                        <br> New Password:
                        <br>
                        <input type="password" name="new_password" class="form-control new_pwd">
                        <br> Retype Password:
                        <br>
                        <input type="password" name="retype_password" class="form-control retypepwd">
                        <br>
                        <div class="err"></div>
                        <button type="submit" name="submit" class="btn btn-warning pull-right reset_pwd" value="reset_password">Reset Password</button>
                        <input type="hidden" name="id" class="idval" value="<?php echo $_SESSION['user']['id'];?>">
                        <br><br>
                    </form>
                </div>
        </div>
        <div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>

    </body>

    </html>