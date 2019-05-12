<?php
	require_once('../header.php');
	unset($_SESSION['admin_user']);
	header('location:login.php');
?>