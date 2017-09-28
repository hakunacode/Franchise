<?php
require_once (dirname(__FILE__)."/../../_model/AdvertisingModel.php");

$category_id = isset($_POST["category_id"]) ? $_POST["category_id"] : 0;
$id = isset($_POST["ads_id"]) ? $_POST["ads_id"] : 0;
$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$flag = isset($_POST["flag"]) ? $_POST["flag"] : 0;
$status = isset($_POST["status"]) ? $_POST["status"] : 0;

$model = new AdvertisingModel();
echo $model->update_advertising($id, $title, $desc, $flag, $status);