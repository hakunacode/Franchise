<?php
require_once (dirname(__FILE__)."/../../_model/AdvertisingModel.php");

$category_id = isset($_POST["id"]) ? $_POST["id"] : 0;

$model = new AdvertisingModel();
echo $model->update_advertising($id);