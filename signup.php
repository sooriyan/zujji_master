<?php
require_once('header.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/zujji.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#rpwd').on('keyup', function() {
                if ($('#pwd').val() == $('#rpwd').val()) {
                    $('#pwd').css('color', 'green');
                    $('#rpwd').css('color', 'green');
                    $('#reg').prop('disabled', false);
                    $('#err1').text('*Password match').css('color', 'green');
                } else {
                    $('#pwd').css('color', 'red');
                    $('#rpwd').css('color', 'green');
                    $('#reg').prop('disabled', 'disabled');
                    $('#err1').text('*Password doesnt match').css('color', 'red');
                }
            });
        });
    </script>
    <title>Sign-Up</title>
</head>

<body style="background-color:#fdfdfd;">
    <div class="container ">
        <div class="row">
            <div class=" col-sm-2 col-lg-4 col-md-3 col-xs-12"></div>
            <div class=" col-sm-8 col-lg-4 col-md-6 col-xs-12">
                <div style="margin-top: 50px;">
                    <!-- <img src="photos/pe.png"> -->
                    <!-- <h2><b>Sign Up</b></h2> -->
                    <!-- <p >Fill in the form below to get instant access</p> -->
                    <form action="dbactions.php" method="post">
                        <span class="text_center"><h3 style="margin-top:0px; padding:10px 0px;">Sign Up</h3></span>
                        <div id="err" style="color: red;">
                            <?php 
            if(isset($_SESSION['emailerr']))
            {
                echo $_SESSION['emailerr'];
                unset($_SESSION['emailerr']);
            }
            ?>
                        </div>
                        <div>
                            <div class="form-group fname"><input type="text" name="fname" id="fname" class="form-control" placeholder="FirstName" pattern="[A-Za-z]{3,}" required/></div>
                            <div class="form-group lname"><input type="text" name="lname" id="lname" class="form-control" placeholder="LastName" pattern="[A-Za-z]{3,}" required/></div>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>

                        <div>
                            <div class="form-group pwd" style="margin-bottom:0px;"><input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password" minlength="8" required/></div>
                            <div class="form-group rpwd" style="margin-bottom:0px;"><input type="password" name="rpwd" class="form-control" id="rpwd" placeholder="Retype Password" /></div>
                            <div id="err1"></div>
                        </div>
                        <input type="text" name="country_name" class="form-control" placeholder="Country Name" />
                        <input type="text" name="facebook_id" class="form-control" placeholder="Facebook Id" required/><br>
                        <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" required/><br>
                        <input type="email" name="ref_email" class="form-control" placeholder="Referred by" /><br>
                        <button type="submit" id="reg" name="submit" class="btn btn-primary" style="width:100%" value="signup">Sign Up</button>
                        <br>
                        <br>
                        <a href="login.php">Already have an Account?</a>
                    </form>

                </div>
            </div>

            <div class=" col-sm-2 col-lg-4 col-md-3 col-xs-12"></div>
        </div>
    </div>
</body>

</html>