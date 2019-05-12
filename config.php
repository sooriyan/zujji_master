<?php
require_once("PHPMailer/class.PHPMailer.php");
define('BASEPATH',"C:\xampp\htdocs\zujji-master");
define('BASEURL',"http://localhost/zujji-master");

$conn=mysqli_connect('localhost','root','','zujji');
session_start();

function send_mail($email,$subject,$body){
$mail = new PHPMailer();
$mail->From = "abc@abc.com";
$mail->FromName = "abc";
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
$mail->Host = 'smtp.office365.com';
$mail->Port = 587; 
$mail->Username = 'abc@abc.com';  
$mail->Password = '***********';
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPKeepAlive = true;
$mail->IsHTML(true);
$mail->AddAddress($email);   
$mail->Subject = $subject;
$mail->Body =$body;
$mail->Send();
}



$records_per_page = 5;
$videos_per_page = 20;
?>