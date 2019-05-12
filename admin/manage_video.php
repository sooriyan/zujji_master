<?php
require_once('admin_navbar.php');
?>

<div class="container">
    <h2>Manage Videos</h2>
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
    <div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">Search</span>
			<input type="text" name="search" id="search" class="form-control" placeholder="Enter Name To Search">
		</div>
	</div>
    <div class="modal fade" id="DeleteVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-product-title">Delete Video</h4>
                </div>
                <div class="modal-body">
		            <form id="form-dinminder">
				
                        <div class="form-group">
                            Are you sure, want to delete this Video?
                        </div>
                        <input type="hidden" id="videoId" name="videoId">
                        
			        </form>
		        </div>
                <div class="modal-footer">
                    <button id="btn-update-product " type="submit" id="update" class="btn btn-danger delete_video_btn">Delete Video</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="UpdateVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-product-title">Update Video</h4>
                </div>
                <div class="modal-body">
		            <form id="form-dinminder">
				
                        <div class="row">
                            <div class="col-md-4 col-lg-3">Video Name</div>
                            <div class="col-md-8 col-lg-9"><input type="text" class="form-control selected_video_name" placeholder="Video Name" name="video_name"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-lg-3">Video Category</div>
                            <div class="col-md-8 col-lg-9">
                                <select name="category" class="form-control selected_video_category">
                                    <option>-- Select Category --</option>  
                                    <?php
                                        $query=$conn->query("SELECT * FROM `categories` WHERE `status`='1'");
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
                            <div class="col-md-4 col-lg-3">Video Embed URL</div>
                            <div class="col-md-8 col-lg-9">
                                <textarea rows="5" class="selected_embed_url form-control" name="embed_url">
                                    
                                </textarea>
                            </div>
                        </div>
                        <br>
                        <div class="video_preview">
                        
                        </div>
                        <input type="hidden" id="videoId" class="selected_videoId" name="videoId" >
                        
			        </form>
		        </div>
                <div class="modal-footer">
                    <button id="btn-update-product " type="submit" id="update" class="btn btn-warning update_existing_video">Update Video</button>
                </div>
            </div>
        </div>
    </div>
	<div id="videostable">
	</div>
</div>
</div>
</body>
</html>