<?php
require_once('../header.php');
if(isset($_POST['submit']) && $_POST['submit']=='adminlogin'){
	$email=$_POST['adminemail'];
    $password=$_POST['adminpassword'];
	$admin_email_query=mysqli_query($conn,"SELECT * FROM `admin` WHERE `adm_email`='$email' AND `status`='1'");  
	$numrows=mysqli_num_rows($admin_email_query);
    if($numrows!=0){
        $row = mysqli_fetch_assoc($admin_email_query);
        if(password_verify($password,$row['adm_password'])){
            $_SESSION['admin_user']=$row;
            header('location:home.php');
        }
        else{
            $_SESSION['failure']="<div class='alert alert-danger'>Incorrect password</div>";
            header('location:login.php');
        }
    }
    else{
        $_SESSION['failure']="<div class='alert alert-danger'>Email Id Doesn't exist</div>";
        header('location:login.php'); 
    }
}
if(isset($_POST['submit']) && $_POST['submit'] == "add_category" ){
    $admin_id = $_SESSION['admin_user']['id'];
    $category_name = $_POST['category_name'];
    $select_exist = mysqli_query($conn,"SELECT 1 FROM `categories` WHERE `category_name`='$category_name' AND `status`='1'");
    $numrows=mysqli_num_rows($select_exist);
    if($numrows==0){
        $insert_category = mysqli_query($conn,"INSERT INTO `categories`(`category_name`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES ('$category_name','1',CURRENT_TIMESTAMP,'$admin_id',CURRENT_TIMESTAMP,'$admin_id')");
        if($insert_category != 0){
            $_SESSION['successmsg']="<div class='alert alert-success'>Inserted Category successfully</div>";
            header('location:add_category.php');
        }
        else{
            $_SESSION['errormsg']="<div class='alert alert-danger'>Failed to insert Category</div>";
            header('location:add_category.php');
        }
    }
    else{
        $_SESSION['errormsg']="<div class='alert alert-danger'>Category Already exists</div>";
        header('location:add_category.php');
    }
}
if(isset($_POST['submit']) && $_POST['submit'] == "add_video"){
    $admin_id = $_SESSION['admin_user']['id'];
    $video_name =$_POST['video_name'];
    $category = $_POST['category'];
    $embed_url = $_POST['embed_url'];
    $image_file = $_FILES['video_pic'];
    $credit = $_POST['credit'];
    $image_name = str_replace(' ','',$video_name);
    $extension = pathinfo($_FILES['video_pic']['name'], PATHINFO_EXTENSION);
    $lower_case_extension = strtolower($extension);
    $maxsize    = 2097152;
   
    if($lower_case_extension == "jpeg" || $lower_case_extension == "jpg" || $lower_case_extension == "png")
    {   if($_FILES['uploaded_file']['size'] <= $maxsize)
        {
            $targetPath = '../video_picture/'.$video_name.".".$extension;
            if(move_uploaded_file($_FILES['video_pic']['tmp_name'], $targetPath)){
                $image_link = BASEURL."/video_picture/".$video_name.".".$extension;
                $select_existing = mysqli_query($conn,"SELECT 1 FROM `zujji_master` WHERE `zujji_type`='$video_name' AND `zujji_category` = '$category' AND `status`='1'");
                $numrows = mysqli_num_rows($select_existing);
                if($numrows==0)
                {
                    $insert_video = mysqli_query($conn,"INSERT INTO `zujji_master`(`zujji_type`, `zujji_category`, `video_link`,`banner_photo`,`credit`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES ('$video_name','$category','$embed_url','$image_link','$credit',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'$admin_id','$admin_id','1')");
                    if($insert_video != 0)
                    {
                        $_SESSION['successmsg']="<div class='alert alert-success'>Inserted Video successfully</div>";
                        header('location:add_video.php');
                    }
                    else
                    {
                        $_SESSION['errormsg']="<div class='alert alert-danger'>Failed to insert Video</div>";
                        header('location:add_video.php');
                    }
                }
                else{
                    $_SESSION['errormsg']="<div class='alert alert-danger'>Video Already Exists</div>";
                    header('location:add_video.php');
                }
            }
            else{
                $_SESSION['errormsg']="<div class='alert alert-danger'>Failed to Upload File</div>";
                header('location:add_video.php');

            }
        }
        else{
            $_SESSION['errormsg']="<div class='alert alert-danger'>File size is Greater than 2MB</div>";
            header('location:add_video.php');

        }
    }
    else{
        $_SESSION['errormsg']="<div class='alert alert-danger'>Please Upload Image</div>";
        header('location:add_video.php');
        
    }
}
if(isset($_POST['load_table']) && $_POST['load_table']=="load_table"){
    $op='';
	$page='';
	if(isset($_POST['page']))
	{
		$page=$_POST['page'];
	}
	else{
		$page=1;
	}
	$start_from=($page-1)*$records_per_page;
	$showall="SELECT * FROM `categories` WHERE status='1' ORDER BY id ASC LIMIT $start_from,$records_per_page";
   
	$table = mysqli_query($conn,$showall);
	$op.='<div class="container" id="table">
	<h2>Categories Table</h2>
	<table class="table">
		<thead>
			<th>Category Name</th>
			<th>Action</th>
		</thead>
		<tbody>';
	while($row=mysqli_fetch_array($table)){
    $id=$row['id'];
    $name=$row['category_name'];
        $op.='<tr  id="'.$id.'">
            <td data-target="name">'.$name.'</td>
            <td><div><a href="#" data-role="update_category" class="fa fa-pencil fa-2x pull-left" id="'.$id.'"></a>
            <a href="#" data-role="delete_category" class="fa fa-trash fa-2x" id="'.$id.'"></a></div></td>
        <?php
    }?>';
}
$op.='</tr>
		</tbody>		
	</table>
	<br/>
	<div align="center" >';
$page_query='SELECT * FROM `categories` WHERE status="1" ORDER BY id ASC';
$page_result=mysqli_query($conn,$page_query);
$total_records=mysqli_num_rows($page_result);
$total_pages=ceil($total_records/$records_per_page);
for($i=1;$i<=$total_pages;$i++)
{
	$op.='<span class="categories_pagination_link" style="cursor:pointer;padding:6px 6px 6px 6px;border:1px solid #ccc;margin-right:5px;" id="'.$i.'">'.$i.'</span>';
}
$op.='</div>';
echo $op;
}
if(isset($_POST['load_video_table']) && $_POST['load_video_table']=="load_video_table"){
    $op='';
	$page='';
	if(isset($_POST['page']))
	{
		$page=$_POST['page'];
	}
	else{
		$page=1;
	}
	$start_from=($page-1)*$records_per_page;
	$showall="SELECT * FROM `zujji_master` WHERE status='1' ORDER BY id ASC LIMIT $start_from,$records_per_page";
	$table = mysqli_query($conn,$showall);
	$op.='<div class="container" id="table">
	<h2>Videos Table</h2>
	<table class="table">
		<thead>
            <th>Video Name</th>
            <th>Video Category</th>
			<th>Action</th>
		</thead>
		<tbody>';
	while($row=mysqli_fetch_array($table)){
		
		$id=$row['id'];
        $name=$row['zujji_type'];
        $category_id = $row['zujji_category'];
        $select_query ="SELECT `category_name` FROM categories WHERE `id`='$category_id' ";
        $query_result = mysqli_query($conn,$select_query);
        if(mysqli_num_rows($query_result)!=0){
            $row = mysqli_fetch_assoc($query_result);
            $category_name= $row['category_name'];
        }
        $op.='<tr  id="'.$id.'">
            <td data-target="name">'.$name.'</td>
            <td data-target="category_name">'.$category_name.'</td>
            <td><div><a href="#" data-role="update_video" class="fa fa-pencil fa-2x pull-left" id="'.$id.'"></a>
            <a href="#" data-role="delete_video" class="fa fa-trash fa-2x" id="'.$id.'"></a></div></td>
        ';
			
}
$op.='</tr>
		</tbody>		
	</table>
	<br/>
	<div align="center" >';
$page_query='SELECT * FROM `zujji_master` WHERE status="1" ORDER BY id ASC';
$page_result=mysqli_query($conn,$page_query);
$total_records=mysqli_num_rows($page_result);
$total_pages=ceil($total_records/$records_per_page);
for($i=1;$i<=$total_pages;$i++)
{
	$op.='<span class="videos_pagination_link" style="cursor:pointer;padding:6px 6px 6px 6px;border:1px solid #ccc;margin-right:5px;" id="'.$i.'">'.$i.'</span>';
}
$op.='</div>';

echo $op;
}

if(isset($_POST['load_video_data']) && $_POST['load_video_data']=="load_video_data"){
    $id = $_POST['id'];
    $select_query = "SELECT * FROM `zujji_master` WHERE id = '$id'";
    $get_data = mysqli_query($conn,$select_query);
    $data = mysqli_fetch_assoc($get_data);
    echo json_encode($data);
}

if(isset($_POST['update_existing_video']) && $_POST['update_existing_video']=='update_existing_video'){
    $video_name = $_POST['video_name'];
    $video_category = $_POST['video_category'];
    $video_id = $_POST['video_id'];
    $embed_url = $_POST['embed_url'];
    $admin_id = $_SESSION['admin_user']['id'];
    $update_query = "UPDATE `zujji_master` SET `zujji_type`='$video_name',`zujji_category`='$video_category',`video_link`='$embed_url',`updated_at`=CURRENT_TIMESTAMP,`updated_by`='$admin_id' WHERE `id`='$video_id'";
    $update_execution = mysqli_query($conn,$update_query);
    if($update_execution=="true"){
        $_SESSION['successmsg']="<div class='alert alert-success'>Updated Video successfully</div>";
    }
    else{
        $_SESSION['errormsg']="<div class='alert alert-success'>Video Update Failed</div>";
    }
    echo json_encode($update_execution);
}

if(isset($_POST['delete_video_data'])&& $_POST['delete_video_data']=="delete_video_data"){
    $id = $_POST['id'];
    $delete_query = "UPDATE `zujji_master` SET `status`='0' WHERE `id`='$id'";
    $delete_execution = mysqli_query($conn,$delete_query);
    if($delete_execution=="true"){
        $_SESSION['successmsg']="<div class='alert alert-success'>Deleted Video successfully</div>";
    }
    else{
        $_SESSION['errormsg']="<div class='alert alert-danger'>Video Deletion Failed</div>";
    }
    echo json_encode($delete_query);
}

if(isset($_POST['load_category_data']) && $_POST['load_category_data']=="load_category_data"){
    $id = $_POST['id'];
    $select_query = "SELECT * FROM `categories` WHERE id = '$id'";
    $get_data = mysqli_query($conn,$select_query);
    $data = mysqli_fetch_assoc($get_data);
    echo json_encode($data);
}

if(isset($_POST['delete_category_data']) && $_POST['delete_category_data']=='delete_category_data'){
    $id = $_POST['id'];
    $delete_query = "UPDATE `categories` SET `status`='0' WHERE `id`='$id'";
    $delete_execution = mysqli_query($conn,$delete_query);
    if($delete_execution=="true"){
        $_SESSION['successmsg']="<div class='alert alert-success'>Deleted Category successfully</div>";
    }
    else{
        $_SESSION['errormsg']="<div class='alert alert-danger'>Category Deletion Failed</div>";
    }
    echo json_encode($delete_query);
}

if(isset($_POST['update_selected_category']) && $_POST['update_selected_category']=="update_selected_category"){
    $id = $_POST['id'];
    $category_name = $_POST['category_name'];
    $admin_id = $_SESSION['admin_user']['id'];
    $update_query = "UPDATE `categories` SET `category_name`='$category_name',`updated_at`=CURRENT_TIMESTAMP,`updated_by`='$admin_id' WHERE `id`='$id'";
    $update_execution = mysqli_query($conn,$update_query);
    if($update_execution=="true"){
        $_SESSION['successmsg']="<div class='alert alert-success'>Updated Category successfully</div>";
    }
    else{
        $_SESSION['errormsg']="<div class='alert alert-success'>Category Update Failed</div>";
    }
    echo json_encode($update_query);
}

if(isset($_POST['submit']) && $_POST['submit'] == "Submit Output"){
    $output_link = $_POST['output_link'];
    $zujji_id = $_POST['zujji_id'];
    $user_id = $_POST['user_id'];
    $request_id = $_POST['request_id'];
    $select_query = "SELECT * FROM `request_master` WHERE `id` ='$request_id'";
    $select_data = mysqli_query($conn,$select_query);
    $data = mysqli_fetch_assoc($select_data);
    $user_email = $_POST['user_email'];
    $update_query = "UPDATE `request_master` SET `output_link`= '$output_link',`status`='2' WHERE `id` = '$request_id'";
    if(mysqli_query($conn,$update_query)){
        $select_user = "SELECT * FROM `user_table` WHERE `id` = '$user_id'";
        $user_result = mysqli_query($conn,$select_user);
        $user_data = mysqli_fetch_assoc($user_result);
        $select_video = "SELECT * FROM `zujji_master` WHERE `id` = '$zujji_id'";
        $video_Result = mysqli_query($conn,$select_video);
        $video_Data = mysqli_fetch_assoc($video_Result);
        $credit = $video_Data['credit'];
        $update_credit_query = "UPDATE `user_table` SET `credits` = `credits`-`$credit`WHERE `id` = '$user_id'";
        $update_credits_exec = mysqli_query($conn,$update_credit_query);
        $front_image_extension = pathinfo($data['front_image'], PATHINFO_EXTENSION);
        $left_image_extension = pathinfo($data['left_image'], PATHINFO_EXTENSION);
        $right_image_extension = pathinfo($data['right_image'], PATHINFO_EXTENSION);
        unlink('../user_photo/'.$user_id.$zujji_id.'/right_face.'.$right_image_extension);
        unlink('../user_photo/'.$user_id.$zujji_id.'/left_face.'.$left_image_extension);
        unlink('../user_photo/'.$user_id.$zujji_id.'/front_face.'.$front_image_extension);
        rmdir('../user_photo/'.$user_id.$zujji_id);
        $body="Reg : Your Zujji Video Request ";
        $message = "Hi ".$user_data['fname'].",<br> Your request for ".$video_data['zujji_type']."has been completed, Please <a href='".BASEURL."'>Login</a> Inorder to view your Video";
        send_mail($user_email,$body,$message);
        $_SESSION['successmsg']="<div class='alert alert-success'>Processed requested</div>";
        header('location:home.php');
    }
    else
    {
        $_SESSION['errormsg']="<div class='alert alert-danger'>Unable to update request</div>";
        header('location:requests.php?request_id='.$request_id);
    }
    
}

?>