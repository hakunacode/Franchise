<?php
require_once (dirname(__FILE__)."/../../_model/AdvertisingModel.php");

$id = isset($_POST["id"]) ? $_POST["id"] : 0;

$model = new AdvertisingModel();
$model->delete_advertising($id);