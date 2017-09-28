<?php
require_once (dirname(__FILE__).'/../../_model/HomeModel.php');

$ids = isset($_POST["newly_ids"]) ? $_POST["newly_ids"] : "";

$model = new HomeModel();

echo $model->create_newly_listed($ids);