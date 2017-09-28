<?php
require_once (dirname(__FILE__)."/../module/Db.php");

$email = isset($_POST['email']) ? $_POST['email'] : 0;

$db = new Db();

$info = $db->get_user_info($email);

if ( count($info) > 0 ) {
	$password = $info[0][3];
	
	mail($email, "From admin", "From: admin\r\nYour password is $password.");
	echo "Please check your email box for your password";
} else {
	echo "incorrect email";
}