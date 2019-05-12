<?php
require_once('header.php');
if(!isset($_SESSION['user'])){
	header('location:login.php');
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/zujji.css">

    <title>ZUJJI</title>
</head>

<body style="background-color:#fdfdfd;">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">ZUJJI</a>
            </div>
            <ul class="nav navbar-nav pull-right">
                <li ><a href="home.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Categories
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                            $query=$conn->query("SELECT * FROM categories WHERE `status`='1'");
                            $rowCount=$query->num_rows;
                                if($rowCount>0)
                                {
                                while ($row=$query->fetch_assoc()) {
                                echo '<li><a href="category_select.php?category_id='.$row['id'].'&&page_id=1"> '.$row['category_name'].'</a></li>';
                                }
                            } 
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $_SESSION['user']['fname'];?>
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
    <br>
    <br>
    <div class="container a1">
