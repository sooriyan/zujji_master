<?php
require_once('admin_navbar.php');
?>

<div class="container">
    <div class="row">
    <div class=" col-sm-2 col-lg-3 col-md-3 col-xs-12"></div>


<div class=" col-sm-8 col-lg-6 col-md-6 col-xs-12">
   

        <form style="margin-top:50px;" method="post" class="form-group" enctype="multipart/form-data" action="adminactions.php">
            <span class="text_center"><h3 style="margin-top:0px; padding:10px 0px;">Add New Video</h3></span>
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
            <div class="row">
                <div class="col-md-3 col-lg-3">Name of Video</div>
                <div class="col-md-9 col-lg-9">
                <input type="text" name="video_name" class="form-control" placeholder="Video name" required/><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-lg-3">Category</div>
                <div class="col-md-9 col-lg-9">
                    <select class="form-control" name="category" required>
                    <option>--Select Category--</option>
                        <?php
                            $query=$conn->query("SELECT * FROM categories WHERE `status`='1'");
                            $rowCount=$query->num_rows;
                                if($rowCount>0)
                                {
                                while ($row=$query->fetch_assoc()) {
                                echo '<option value="'.$row['id'].'""> '.$row['category_name'].'</option>';
                                }
                            }
                        ?> 
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3 col-lg-3">Embed URL</div>
                <div class="col-md-9 col-lg-9">
                    <input type="text" name="embed_url" class="form-control" placeholder="Embed URL" required>
                </div>
            </div>
            <br>
            
            <div class="row">
                <div class="col-md-3 col-lg-3">Credits</div>
                <div class="col-md-9 col-lg-9">
                    <input type="number" name="credit" class="form-control" placeholder="Credits Required" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3 col-lg-3">Upload Photo</div>
                <div class="col-md-9 col-lg-9">
                    <input type="file" name="video_pic" required>
                </div>
            </div>
            <br>
            <button type="submit" id="reg" name="submit" class="btn btn-primary" style="width:100%" value="add_video">Add</button><br><br>
        </form>
        <!-- </div> -->
</div>
</div>
<div class=" col-sm-2 col-lg-3 col-md-3 col-xs-12"></div>
        
    </div>
</div>
</body>
</html>