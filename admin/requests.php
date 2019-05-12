<?php
require_once('admin_navbar.php');
$request_id = $_GET['request_id'];
$query = "SELECT A.`id`,A.`zujji_id`,A.`user_id`,A.`message`,A.`status`,A.`requested_height`,A.`requested_width`,A.`front_image`,A.`left_image`,A.`right_image`,B.`zujji_type`,B.`id` AS `zujji_table_id`, C.`credits`,D.`category_name` FROM `request_master` AS A LEFT JOIN `zujji_master`AS B ON A.`zujji_id`=B.`id` LEFT JOIN `user_table`AS C ON A.`user_id`=C.`id` LEFT JOIN `categories`AS D ON D.`id`=B.`zujji_category` WHERE A.`id`='$request_id'";
$query_exec = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($query_exec);
?>

<div class="container">
    <div class="row">
        <div class=" col-sm-1 col-lg-2 col-md-3 col-xs-12"></div>
        <div class=" col-sm-10 col-lg-8 col-md-6 col-xs-12">
            <div class="text-center"><b><?php echo ucwords($data['zujji_type']);?></b></div>
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
            <br>	
            <div class="row">
                <div class="col-lg-3 col-md-3"><b>Category :</b></div>
                <div class="col-lg-9 col-md-9"><?php echo ucwords($data['category_name']);?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3"><b>Requested Width :</b></div>
                <div class="col-lg-9 col-md-9"><?php echo ucwords($data['requested_width']);?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3"><b>Requested Height :</b></div>
                <div class="col-lg-9 col-md-9"><?php echo ucwords($data['requested_height']);?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3"><b>Message :</b></div>
                <div class="col-lg-9 col-md-9"><?php echo ucwords($data['message']);?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3"><b>Right Side Image :</b></div>
                <div class="col-lg-9 col-md-9"><a href="<?php echo $data['right_image']?>" download>Download Image</a></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3"><b>Left Side Image :</b></div>
                <div class="col-lg-9 col-md-9"><a href="<?php echo $data['left_image']?>" download>Download Image</a></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3"><b>Front Image :</b></div>
                <div class="col-lg-9 col-md-9"><a href="<?php echo $data['front_image']?>" download>Download Image</a></div>
            </div>
            <br>
            <form method="post" action="adminactions.php">
                <div class="row">
                    <div class="col-lg-3 col-md-3"><b>Output Link :</b></div>
                    <div class="col-lg-9 col-md-9"><textarea class="form-control" name="output_link"></textarea></div>
                </div>
                <br>
                <input type="hidden" name="zujji_id" value="<?php echo $data['zujji_id'];?>">
                <input type="hidden" name="user_id" value="<?php echo $data['user_id'];?>">
                <input type="hidden" name="request_id" value="<?php echo $request_id;?>">
                <input type="hidden" name="user_email" value="<?php echo $data['email'];?>">
                
                <div class="row text-center">
                    <input type="submit" name="submit" value="Submit Output" class="btn btn-primary"/>
                </div>

            </form>
        </div>
        <div class=" col-sm-1 col-lg-2 col-md-3 col-xs-12"></div>
        
    </div>
</div>
</body>
</html>