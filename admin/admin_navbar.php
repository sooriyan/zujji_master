<?php
require_once('../header.php');
if(!isset($_SESSION['admin_user'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/font_awesome/css/font-awesome.min.css">
  	<script src="../js/bootstrap.min.js"></script>
    <script src="./script/adminscript.js"></script>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<title>Login</title>

</head>
<body style="background-color:#fdfdfd;">
	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">ZUJJI</a>
            </div>
            <ul class="nav navbar-nav pull-right">
                <li><a href="home.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Category
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="add_category.php">Add Category</a></li>
                        <li><a href="manage_category.php">Manage Categories</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Video
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="add_video.php">Add Videos</a></li>
                        <li><a href="manage_video.php">Manage Videos</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $_SESSION['admin_user']['adm_name'];?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="myaccount.php">My Account</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
    <br>
    <br><br>