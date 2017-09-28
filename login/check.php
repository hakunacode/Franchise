<?php
require_once (dirname(__FILE__)."/../module/Db.php");

$username = isset($_POST['username']) ? $_POST['username'] : 0;
$password = isset($_POST['password']) ? $_POST['password'] : 0;

$db = new Db();

$status = $db->login($username, $password);

$return["permission"] = "";
$incorrect_username="incorrect username";

switch($status) {
	case 1:
		set_auth($db, $username, $password);
		break;
	case -1:
		$return["permission"] = "incorrect password";
		break;
	case -2:
		$return["permission"] = "incorrect username";
		break;
}

function set_auth($db, $username, $password) {
	global $return;
	
	session_start();
	
	$info = $db->get_profile($username, $password);
	
	if (PHP_VERSION < "5.3.0") {
		session_register("islogin");
		session_register("userid");
		session_register("account");
		session_register("email");
		session_register("password");
		session_register("permission");
		session_register("fullname");
	}
	
	$_SESSION["islogin"] = true;
	$_SESSION["userid"] = $info[0][0];
	$_SESSION["account"] = $info[0][1];	
	$_SESSION["email"] = $info[0][2];	
	$_SESSION["password"] = $info[0][3];
	$_SESSION["permission"] = $info[0][4];
	$_SESSION["fullname"] = $info[0][5];

	$return["permission"] = $info[0][4];
}
echo $return["permission"];
//echo json_encode($return);