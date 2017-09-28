<?php
require_once (dirname(__FILE__)."/../../_model/AccountModel.php");

$act = isset($_POST["act"]) ? $_POST["act"] : 'save';
$id = isset($_POST["selid"]) ? $_POST["selid"] : 0;
$account = isset($_POST["edit_account"]) ? $_POST["edit_account"] : "";
$email = isset($_POST["edit_email"]) ? $_POST["edit_email"] : "";
$password = isset($_POST["edit_password"]) ? $_POST["edit_password"] : "";
$fullname = isset($_POST["edit_fullname"]) ? $_POST["edit_fullname"] : "";
$permission = isset($_POST["edit_permission"]) ? $_POST["edit_permission"] : 4;

$return["result"] = "false";
$model = new AccountModel();

if($act == "delete")
	$return["result"] = $model->delete_account($id);
else
	$return["result"] = $model->save_account($id, $account, $email, $password, $fullname, $permission);

echo $return["result"];