<?php
require_once (dirname(__FILE__)."/../../_model/HomeModel.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 1;
$flag = isset($_POST["flag"]) ? $_POST["flag"] : 1;

$model = new HomeModel();

$return['result'] = "";
$return['result'] = $model->permit_advertising($id, $flag);
echo json_encode($return);
?>