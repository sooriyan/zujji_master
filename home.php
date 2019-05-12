<?php
require_once('user_navbar.php');
$user_id=$_SESSION['user']['id'];
$user_query = "SELECT * FROM `user_table` WHERE `id` = '$user_id'";
$user_query_exec = mysqli_query($conn,$user_query);
$user_data = mysqli_fetch_assoc($user_query_exec);
?>
    <div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>
    <div class=" col-sm-8 col-lg-10 col-md-10 col-xs-12">
        <div class="row">
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
            <h4 class="pull-left"><b>Welcome <?php echo ucwords($_SESSION['user']['fname']);?></b>
                <div style="margin-top:10px;" class="text-left">Credits <span class="badge"><?php echo $user_data['credits']?></span></div>
            </h4>

            <div class="col-lg-1 pull-right"><a href="refer_friend.php" class="btn btn-info refer">Refer A Friend</a></div>
        </div>
        <br>
        <div class="row">
            <h4><b>Latest Videos</b></h4>
            <?php
                $op="";
                $fourvideos_query = "SELECT A.`id`,A.`zujji_type`,A.`zujji_category`,A.`video_link`,A.`status`,A.`banner_photo`,B.`category_name`,B.`id` AS `new_category_id` FROM `zujji_master` AS A LEFT JOIN `categories`AS B ON A.`zujji_category`=B.`id` WHERE A.`status`=1 ORDER BY A.`id` DESC LIMIT 4"; 
                $fourvideous_result = mysqli_query($conn,$fourvideos_query);
                while($card_data=mysqli_fetch_array($fourvideous_result)){
                    $op.='<div class="col-md-3 col-lg-3">
                    <div class="card"><a href="video_page.php?video_id='.$card_data['id'].'"><img src="'.$card_data['banner_photo'].'" alt="Avatar" style="width:100%;height:130px"><div class="card_container"><h4 class="text-center"><b>'.$card_data['zujji_type'].'</b></h4><p class="text-center">'.$card_data['category_name'].'</p></a> 
                    </div>
                </div>
            </div>';
                }
                echo $op;
            ?>
        </div>
        <br>
        <?php
            $user_id = $_SESSION['user']['id'];
            $req_query = "SELECT A.`id`,A.`zujji_id`,A.`user_id`,A.`status`,A.`requested_height`,A.`requested_width`,B.`zujji_type`,B.`id` AS `zujji_table_id`, C.`ads_clicked`,D.`category_name` FROM `request_master` AS A LEFT JOIN `zujji_master`AS B ON A.`zujji_id`=B.`id` LEFT JOIN `user_table`AS C ON A.`user_id`=C.`id` LEFT JOIN `categories`AS D ON D.`id`=B.`zujji_category` WHERE A.`user_id`='$user_id' ORDER BY A.`id` DESC";
            $query_exec = mysqli_query($conn,$req_query);
            if(mysqli_num_rows($query_exec)!=0){
        ?>
        <div class="row">
            <h4><b>Your Requests</b></h4>
        </div>
        <table class="table" >
		<thead>
            <th>Video Name</th> 
            <th>Category</th>
            <th>Requested Height</th> 
            <th>Requested Width</th>
			<th>Status</th>
		</thead>
		<tbody>
        <?php
            while($row = mysqli_fetch_array($query_exec)){
                
        ?>
            <?php if($row['status']==2)
                {
            ?>
            
            <tr id="<?php echo $row['id']?>">
            
                <td><?php echo $row['zujji_type']?></td>
                <td><?php echo $row['category_name']?></td>
                <td><?php echo $row['requested_height']?></td>
                <td><?php echo $row['requested_width']?></td>
                <td><a href="video_result.php?request_id=<?php echo $row['id']?>"><div class='alert alert-success text-center'>Completed</div> </a></td>
           
            </tr>
            
            <?php 
            }else{
            ?>
            <tr id="<?php echo $row['id']?>">
                <td><?php echo $row['zujji_type']?></td>
                <td><?php echo $row['category_name']?></td>
                <td><?php echo $row['requested_height']?></td>
                <td><?php echo $row['requested_width']?></td>
                <td><div class='alert alert-warning text-center'>Processing</div></td>
            </tr>
            <?php
            }
            ?>
        <?php
            }
        }
        ?>
             
    </div>
        
    <div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>
    </div>
</body>

</html>