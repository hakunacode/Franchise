<?php
require_once (dirname(__FILE__)."/../../_model/HomeModel.php");

$id = isset($_POST["ads_id"]) ? $_POST["ads_id"] : 0;
$flag = isset($_POST["flag"]) ? $_POST["flag"] : 0;
$status = isset($_POST["status"]) ? $_POST["status"] : 0;
$action = isset($_POST["act"]) ? $_POST["act"] : "";

$model = new HomeModel();

$return['result'] = "";
switch($action) {
	case "flag":
		$return['result'] = $model->updateAdvertisingFlag($id, $flag);
		break;
	case "status":
		$return['result'] = $model->updateAdvertisingStatus($id, $status);
		break;
}

echo json_encode($return);
?>