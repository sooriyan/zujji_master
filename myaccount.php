<?php
require_once('user_navbar.php');
$id=$_SESSION['user']['id'];
$select_query="SELECT * FROM user_table WHERE `id`='$id'";
$exec_query=mysqli_query($conn,$select_query);
$row=mysqli_fetch_assoc($exec_query);?>
        <div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>


        <div class=" col-sm-8 col-lg-10 col-md-10 col-xs-12">
            <!-- <div class="a1 " style="height: 450px;background-color: #E0E0D1;"> -->

                <!-- <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <a class="navbar-brand">About <?php echo $row['fname']?></a>
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

                    <form style="margin-top:50px;" method="post" class="form-group" action="dbactions.php">
                    <span class="text_center"><h3 style="margin-top:0px; padding:10px 0px;">About <?php echo $row['fname']?></h3></span>
                        Name:
                        <br>
                        <input type="text" name="fname" class="form-control fname" value="<?php echo  $row['fname']; ?>">
                        <br> Email:
                        <br>
                        <input type="email" name="email" class="form-control email" value="<?php echo  $row['email']; ?>">
                        <br> Credits:
                        <br>
                        <input type="text" name="credits" class="form-control " value="<?php echo $row['credits']?>" disabled>
                        <br>
                        <button type="submit" name="submit" class="btn btn-info pull-right" value="update_user">Update Details</button>
                        <a href="reset_pwd.php" class="btn btn-warning pull-left reset">Reset Password</a>
                        <input type="hidden" name="id" class="idval" value="<?php echo $_SESSION['user']['id'];?>">
                        <br><br>
                    </form>
            <!-- </div> -->
        </div>
        </div>
        <div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>
        </div>
    </body>

    </html>