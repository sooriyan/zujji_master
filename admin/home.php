<?php
require_once('admin_navbar.php');
?>

<div class="container">
        <div class=" col-sm-1 col-lg-2 col-md-3 col-xs-12"></div>
        <div class=" col-sm-10 col-lg-8 col-md-6 col-xs-12">
            <b>Recent Requests</b>
            <?php
                $req_query = "SELECT A.`id`,A.`zujji_id`,A.`user_id`,A.`status`,A.`requested_height`,A.`requested_width`,B.`zujji_type`,B.`id` AS `zujji_table_id`, C.`ads_clicked`,C.`email`,D.`category_name` FROM `request_master` AS A LEFT JOIN `zujji_master`AS B ON A.`zujji_id`=B.`id` LEFT JOIN `user_table`AS C ON A.`user_id`=C.`id` LEFT JOIN `categories`AS D ON D.`id`=B.`zujji_category` WHERE A.`status`='1' ORDER BY C.`ads_clicked` DESC LIMIT 10";
                $query_exec = mysqli_query($conn,$req_query);
            ?>
            <br>
            <table class="table" >
                <thead>
                    <th>User Email</th>
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
                <tr id="<?php echo $row['id']?>">
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['zujji_type']?></td>
                    <td><?php echo $row['category_name']?></td>
                    <td><?php echo $row['requested_height']?></td>
                    <td><?php echo $row['requested_width']?></td>
                    <td><a href="requests.php?request_id=<?php echo $row['id']?>"><div class='alert alert-warning text-center'>Processing</div> </a></td>
                </tr>
                <?php
                }
                ?>
        </div>
        <div class=" col-sm-1 col-lg-2 col-md-3 col-xs-12"></div>
        
</div>
</body>
</html>