<?php
   require_once('user_navbar.php');
   $video_id=$_GET['video_id']; 
    $video_query =mysqli_query($conn,"SELECT * FROM `zujji_master` WHERE `id` = '$video_id'");
    $video_data = mysqli_fetch_assoc($video_query);
    $user_id = $_SESSION['user']['id'];
    $user_query = "SELECT * FROM `user_table` WHERE `id` = '$user_id'";
    $user_query_exec = mysqli_query($conn,$user_query);
    $user_data = mysqli_fetch_assoc($user_query_exec);
    $credits = $user_data['credits'];
?>
<div class="modal fade" id="raisereq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-product-title">Raise Request</h4>
				</div>
				<div class="modal-body">
					<form action="dbactions.php" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">Width Required</div>
                            <div class="col-md-9 col-lg-9"><input type="text" name="width_request" placeholder="Enter Width" class="form-control" required></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">Height Required</div>
                            <div class="col-md-9 col-lg-9"><input type="text" name="height_request" placeholder="Enter Height" class="form-control" required></div> 
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">Any Customisations Required</div>
                            <div class="col-md-9 col-lg-9"><textarea class="form-control" rows="3" name="message"></textarea></div> 
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">Right Side image of face</div>
                            <div class="col-md-9 col-lg-9"><input type="file" name="right_face" required></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">Left Side image of face</div>
                            <div class="col-md-9 col-lg-9"><input type="file" name="left_face" required></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">Front image</div>
                            <div class="col-md-9 col-lg-9"><input type="file" name="front_face" required></div>
                        </div>
                        <input type="hidden" name="zujji_id" value="<?php echo $video_data['id'];?>">
                        <br>
                        <input type="submit" name="submit" class="btn" value="Submit Request">
                    </form>
					
				</div>
			</div>
		</div>
	</div>
<div class="col-md-3 col-lg-3">
    <div class="ad"><img src='http://localhost/zujji-master/user_photo/233/front_face.png' style="width:100%;"></div>
</div>
<div class="col-md-6 col-lg-6">
    <div class="text-center"><h2><b><?php echo $video_data['zujji_type']?><b></h2></div>
    <?php
        if(isset($_SESSION['successmsg'])){
            echo $_SESSION['successmsg'];
            unset($_SESSION['successmsg']);
        }
        elseif (isset($_SESSION['errormsg'])) {
            echo $_SESSION['errormsg'];
            unset($_SESSION['errormsg']);
        }
        if($credits<10){
            echo "<div class='alert alert-danger'>Please increase your credits in order to place your request</div>";
        }
    ?>
    <div class="row"><?php echo $video_data['video_link']?></div><br>
    <div class="row text-center"><button data-toggle="modal" class="btn btn-primary" data-target="#raisereq" <?php if($credits<10){echo "disabled";}?> >Raise Request</button></div>
</div>
<div class="col-md-3 col-lg-3"></div>
</div>
</body>
</html>