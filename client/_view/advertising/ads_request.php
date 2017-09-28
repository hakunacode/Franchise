<?php
require_once (dirname(__FILE__).'/../../_model/AdvertisingModel.php');

$id = isset($_POST['id']) ? $_POST['id'] : 0;
$name = isset($_POST['name']) ? $_POST['name'] : 0;
$email = isset($_POST['email']) ? $_POST['email'] : 0;
$zip = isset($_POST['zip']) ? $_POST['zip'] : 0;
$phone = isset($_POST['phone']) ? $_POST['phone'] : 0;
$country = isset($_POST['country']) ? $_POST['country'] : 0;
$location = isset($_POST['location']) ? $_POST['location'] : 0;
$street = isset($_POST['street']) ? $_POST['street'] : 0;
$city = isset($_POST['city']) ? $_POST['city'] : 0;
$state = isset($_POST['state']) ? $_POST['state'] : 0;
$investment = isset($_POST['investment']) ? $_POST['investment'] : 0;
$phone = isset($_POST['phone']) ? $_POST['phone'] : 0;

$return = array();

if ($id == null || strlen($id)<1) {
	$return['flag'] = "id";
	
}else if ($name == null || strlen($name)<1) {
	$return['flag'] = "name";
}else if ($email == null || strlen($email)<1) {
	$return['flag'] = "email";
}else if ($zip == null || strlen($zip)<1) {
	$return['flag'] = "zipcode";
}else if ($phone == null || strlen($phone)<1) {
	$return['flag'] = "phone number";
}else if ($country == null || strlen($country)<1) {
	$return['flag'] = "country";
}else if ($location == null || strlen($location)<1) {
	$return['flag'] = "location";
}else if ($investment == null || strlen($investment)< 1) {
	$return['flag'] = "investment range";
}else if ($street == null || strlen($street)<1) {
	$return['flag'] = "street";
}else if ($city == null || strlen($city)<1) {
	$return['flag'] = "city";
}else if ($state == null || strlen($state)< 1) {
	$return['flag'] = "state";
}else {
	$model = new AdvertisingModel();
	$request_id = $model->addRequest($id, $name, $email, $zip, $phone, $country, $location, $street, $city, $state, $investment);
	
	$emailto = $model->get_ad_email_address($id);
	
	$ad_name = $model->get_ad_title($id);
	$headers = "From: leads@franchiseeverything.com";
	
	$info = $model->getRequestDetails($request_id);
	$mail_content = "";
	for($i = 0; $i < count($info); $i ++) {
		$mail_content .= $info[$i][0]." - ".$info[$i][1]."\r\n";
	}
	
	if(!mail($emailto, "Franchise Everything Lead - $ad_name", $mail_content, $headers))
		$return['flag'] = "send mail";
	else
		$return['flag'] = "success";
}


echo json_encode($return);