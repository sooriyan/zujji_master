<?php
	require_once('header.php');
	unset($_SESSION['user']);
	header('location:login.php');
?>