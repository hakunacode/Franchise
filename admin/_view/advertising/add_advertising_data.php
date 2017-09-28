<?php
require_once (dirname(__FILE__)."/../../_model/AdvertisingModel.php");

$category_id = isset($_POST["category_id"]) ? $_POST["category_id"] : 0;
$id = isset($_POST["ads_id"]) ? $_POST["ads_id"] : 0;
$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$flag = isset($_POST["flag"]) ? $_POST["flag"] : 2;
$status = isset($_POST["status"]) ? $_POST["status"] : 2;
$country = isset($_POST["country"]) ? $_POST["country"] : 0;
$location = isset($_POST["location"]) ? $_POST["location"] : 0;
$filename = isset($_POST["filename"]) ? $_POST["filename"] : "";
$categories = isset($_POST["categories"]) ? $_POST["categories"] : 0;
$investment = isset($_POST["investment"]) ? $_POST["investment"] : 0;
$full_ad = isset($_POST["contents"]) ? $_POST["contents"] : "";
$advertisor_id = isset($_POST["advertisor_id"]) ? $_POST["advertisor_id"] : 0;
$newly = isset($_POST["newly"]) ? $_POST["newly"] : 0;
$featured = isset($_POST["featured"]) ? $_POST["featured"] : 0;
$email = isset($_POST["email"]) ? $_POST["email"] : "";

$model = new AdvertisingModel();

if($id == 0)
	echo $model->add_advertising($title, $desc, $filename,  $categories, $advertisor_id,  $country, $location, $investment, $flag, $status, $full_ad, $newly, $featured, $email);
else
	echo $model->update_advertising($id, $title, $desc, $filename,  $categories, $country, $location, $investment, $flag, $status, $full_ad, $advertisor_id, $newly, $featured, $email);