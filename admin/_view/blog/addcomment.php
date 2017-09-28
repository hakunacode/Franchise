<?php
require_once (dirname(__FILE__).'/../../_model/BlogModel.php');

$id = isset($_POST["blog_id"]) ? $_POST["blog_id"] : 0;
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$comment = isset($_POST["comment"]) ? $_POST["comment"] : "";

$model = new BlogModel();

$status = $model->add_blog_comment($id, $name, $email, $comment);

$return['result'] = "failure";
if ($status)
	$return['result'] = "success";

echo json_encode($return);