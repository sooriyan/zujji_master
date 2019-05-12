<?php
require_once('header.php');
  
if(isset($_POST['submit']) && $_POST['submit']=='login'){

    $email=$_POST['email'];
    $password=$_POST['password'];
    $query=mysqli_query($conn,"SELECT * FROM `user_table` WHERE `email`='$email' AND `validation`='1'");  
    $numrows=mysqli_num_rows($query);
    if($numrows!=0){
        $row = mysqli_fetch_assoc($query);
    
        if(password_verify($password,$row['pwd'])){
            $uname=$row['fname'];
            $credits=$row['credits'];
            $_SESSION['user']=$row;
            header("location:home.php");	
        }
        
        else{
            $_SESSION['pwderr']="*Incorrect password";
            header('location:login.php');
        }
    }
    else{
        $_SESSION['pwderr']="Email Id Doesn't exist";
        header('location:login.php'); 
    }

}



if(isset($_POST['submit']) && $_POST['submit']=='signup'){
    // print_r($_POST);
    // exit;
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['pwd'];
    $facebook_id=$_POST['facebook_id'];
    $phone_number=$_POST['phone_number'];
    $country_name=$_POST['country_name'];
    $hash=password_hash($password,PASSWORD_DEFAULT); 
    $existquery="SELECT * FROM `user_table` WHERE `email`='$email'";
    $query="INSERT INTO `user_table`( `fname`, `lname`, `email`,`pwd`,`facebook_id`,`phone_number`,`country_name`, `credits`,`validation`,`status`) VALUES ('$fname','$lname','$email','$hash','$facebook_id','$phone_number','$country_name','5','0','1')";
    $exist_response=mysqli_query($conn,$existquery);

    if(mysqli_num_rows($exist_response)>0) {

        $row = mysqli_fetch_assoc($exist_response);
        
        if($email==$row['email'])
        {
            $_SESSION['emailerr']="*Email already exists";
            header('location:signup.php');
            exit;
        }

    }
    else
    {
        if (mysqli_query($conn, $query)) {
            $to=$email;
            $subject="Activate Your Account";
            $body="Dear ".$_POST['fname'].",<br> Please Click the below link to activate your account <br>
            http://localhost/Zujji/dbactions.php?mail_id=".$_POST['email'];
            send_mail($to,$subject,$body);
    	    $referrer=$_POST['ref_email'];
    	    $creditquery="UPDATE `user_table` SET `credits`=`credits`+1 WHERE `email`='$referrer'";
    	    $res=mysqli_query($conn,$creditquery);
            header("location:login.php");
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

if(isset($_GET['mail_id'])){
   
    $mail_id = $_GET['mail_id'];
    $activate_user = "UPDATE `user_table` SET `validation`='1' WHERE `email`='$mail_id'";
    $res=mysqli_query($conn,$activate_user);
    header('location:login.php');
}

    

if(isset($_POST['submit']) && $_POST['submit']=='update_user'){
    $id=$_POST['id'];
    $fname = $_POST['fname'];
    $email=$_POST['email'];

    $query="UPDATE user_table SET `fname`='$fname',`email` = '$email' WHERE `id` = '$id' ";
    // print_r($query);
    // exit;
    if(mysqli_query($conn,$query)){
        $_SESSION['successmsg']='<div class="alert alert-success text-center" role="alert">
  Updated Successfully
</div>';
    }
    else{
        $_SESSION['errormsg']='<div class="alert alert-danger text-center" role="alert">
  Update Failed
</div>';
    }

    header('location:myaccount.php');

}

if(isset($_POST['submit']) && $_POST['submit']=='forgotpwd'){
    $toid=$_POST['email'];
    $sql="SELECT * FROM `user_table` WHERE `email`='$toid'";

    $query=mysqli_query($conn,$sql);

    
    if(mysqli_num_rows($query)>0){
        $user_info=mysqli_fetch_assoc($query);
        $uid=$user_info['id'];
        $subject="Your New ZUJJI Password";
        $randpwd=generateRandomString();
        $hashrand=password_hash($randpwd,PASSWORD_DEFAULT);
        $body="Dear ".$user_info['fname'].",<br> Your New Password is ".$randpwd.".<br> You can reset your password in your Account Settings";
        send_mail($toid,$subject,$body);
        $password_query = "UPDATE user_table SET `pwd`='$hashrand' WHERE `id`='$uid'";
        if(mysqli_query($conn,$password_query)){
            $_SESSION['successmsg']='<div class="alert alert-success text-center" role="alert">
      Updated Successfully
    </div>';
    header('location:forgot_password.php');
        }
        else{
            $_SESSION['errormsg']='<div class="alert alert-danger text-center" role="alert">
      Unable to identify Email Address
    </div>';
    header('location:forgot_password.php');
        }
    }
    else{
        $_SESSION['errormsg']='<div class="alert alert-danger text-center" role="alert">
      Unable to identify Email Address
    </div>';
    header('location:forgot_password.php');
    }



}

 
if(isset($_POST['submit']) && $_POST['submit']=='reset_password'){

    $current_password=$_POST['password'];
    $new_password=$_POST['new_password'];
    $id=$_POST['id'];
    $select_query="SELECT * FROM user_table WHERE `id`='$id'";

    $user_cred = mysqli_query($conn,$select_query);

    $row= mysqli_fetch_assoc($user_cred);
    if(password_verify($current_password,$row['pwd'])){

        $new_hash = password_hash($new_password,PASSWORD_DEFAULT);        
        $update_query = "UPDATE user_table SET `pwd` = '$new_hash' WHERE `id`='$id'";
        $exec_update = mysqli_query($conn,$update_query);
        $_SESSION['successmsg'] = '<div class="alert alert-success text-center" role="alert">
      Password Updated Successfully
    </div>';
        header('location:reset_pwd.php');

    }
    else{
        $_SESSION['errormsg'] = '<div class="alert alert-danger text-center" role="alert">
      Unable to identify Email Address
    </div>';
    header('location:reset_pwd.php');
    }

}

if(isset($_POST['submit']) && $_POST['submit']=='refer_friend'){
    $mail1=$_POST['mail1'];
    $mail2=$_POST['mail2'];

    $mail3=$_POST['mail3'];

    $mail4=$_POST['mail4'];

    $mail5=$_POST['mail5'];
    $user_mail=$_SESSION['user']['id'];
    if(!empty($mail1)){
        $update_query="INSERT INTO `reference`(`ref_id`,`email`,`status`) VALUES ('$user_mail','$mail1','1')";
        
        $exec_query=mysqli_query($conn,$update_query);
    }
    if(!empty($mail2)){
        $update_query="INSERT INTO `reference`(`ref_id`,`email`,`status`) VALUES ('$user_mail','$mail2','1')";
 $exec_query=mysqli_query($conn,$update_query);
    }
    if(!empty($mail3)){
        $update_query="INSERT INTO `reference`(`ref_id`,`email`,`status`) VALUES ('$user_mail','$mail3','1')";
  $exec_query=mysqli_query($conn,$update_query);
    }

    if(!empty($mail4)){
        $update_query="INSERT INTO `reference`(`ref_id`,`email`,`status`) VALUES ('$user_mail','$mail4','1')";
  $exec_query=mysqli_query($conn,$update_query);
    }
    if(!empty($mail5)){
        $update_query="INSERT INTO `reference`(`ref_id`,`email`,`status`) VALUES ('$user_mail','$mail5','1')";
 $exec_query=mysqli_query($conn,$update_query);
    }
header('location:home.php');
}

if(isset($_POST['submit']) && $_POST['submit']=='Submit Request'){
    print_r($_POST);
    print_r($_FILES);
    $width_request = $_POST['width_request'];
    $height_request = $_POST['height_request'];
    $message = $_POST['message'];
    $zujji_id = $_POST['zujji_id'];
    $user_id = $_SESSION['user']['id'];
    $right_face_extension = pathinfo($_FILES['right_face']['name'], PATHINFO_EXTENSION);
    $left_face_extension = pathinfo($_FILES['left_face']['name'], PATHINFO_EXTENSION);
    $front_face_extension = pathinfo($_FILES['front_face']['name'], PATHINFO_EXTENSION);
    $rlower_case_extension = strtolower($right_face_extension);
    $llower_case_extension = strtolower($left_face_extension);
    $flower_case_extension = strtolower($front_face_extension);
    
    $maxsize    = 2097152;
    
    if($rlower_case_extension == "jpeg" || $rlower_case_extension == "jpg" || $rlower_case_extension == "png"){
        if($llower_case_extension == "jpeg" || $llower_case_extension == "jpg" || $llower_case_extension == "png"){
            if($flower_case_extension == "jpeg" || $flower_case_extension == "jpg" || $flower_case_extension == "png"){
                if($_FILES['right_face']['size'] <= $maxsize)
                {
                    if($_FILES['left_face']['size'] <= $maxsize)
                    {
                        if($_FILES['front_face']['size'] <= $maxsize)
                        {
                            $folder_name = "user_photo/".$user_id.$zujji_id; 
                            mkdir($folder_name);
                            $right_face_targetPath = $folder_name.'/right_face.'.$right_face_extension;
                            $left_face_targetPath = $folder_name.'/left_face.'.$left_face_extension;
                            $front_face_targetPath = $folder_name.'/front_face.'.$front_face_extension;
                            if(move_uploaded_file($_FILES['right_face']['tmp_name'], $right_face_targetPath) && move_uploaded_file($_FILES['left_face']['tmp_name'], $left_face_targetPath) && move_uploaded_file($_FILES['front_face']['tmp_name'], $front_face_targetPath)){
                                $right_face_url=BASEURL.'/'.$right_face_targetPath;
                                $left_face_url=BASEURL.'/'.$left_face_targetPath;
                                $front_face_url=BASEURL.'/'.$front_face_targetPath;
                                $insert_query = "INSERT INTO `request_master`(`user_id`, `zujji_id`, `requested_height`, `requested_width`, `message`, `status`, `front_image`, `left_image`, `right_image`) VALUES ('$user_id','$zujji_id','$height_request','$width_request','$message','1','$front_face_url','$left_face_url','$right_face_url')";
                                $query_exec = mysqli_query($conn,$insert_query);
                                $_SESSION['successmsg']="<div class='alert alert-success'>Your request is under processing.</div>";
                                header('location:home.php');
                            }
                        }
                        else
                        {
                            $_SESSION['errormsg']="<div class='alert alert-danger'>Please choose image with size under 2MB</div>";
                            header('location:video_page.php?video_id='.$zujji_id);
                        }
                    }
                    else
                    {
                        $_SESSION['errormsg']="<div class='alert alert-danger'>Please choose image with size under 2MB</div>";
                        header('location:video_page.php?video_id='.$zujji_id);
                    }
                }
                else
                {
                    $_SESSION['errormsg']="<div class='alert alert-danger'>Please choose image with size under 2MB</div>";
                    header('location:video_page.php?video_id='.$zujji_id);
                }
            }
            else{
                $_SESSION['errormsg']="<div class='alert alert-danger'>Please choose image for upload</div>";
                header('location:video_page.php?video_id='.$zujji_id);
            }
        }
        else{
            $_SESSION['errormsg']="<div class='alert alert-danger'>Please choose image for upload</div>";
            header('location:video_page.php?video_id='.$zujji_id);
        }
    }
    else{
        $_SESSION['errormsg']="<div class='alert alert-danger'>Please choose image for upload</div>";
        header('location:video_page.php?video_id='.$zujji_id);
    }

}

if(isset($_POST['ad_click']) && $_POST['ad_click']=="ad_click"){
    $user_id = $_SESSION['user']['id'];
    $update_query = "UPDATE `user_table` SET `credits`=`credits`+5,`ads_clicked`=`ads_clicked`+1 WHERE `id`='$user_id'";
    if(mysqli_query($conn,$update_query)){
        echo "Updated Ad status";
    }
    else{
        echo "Unable Update Ad status";
    }
}


?>