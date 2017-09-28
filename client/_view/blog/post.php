<?php
session_start();
require_once (dirname(__FILE__).'/../../_model/BlogModel.php');
require_once (dirname(__FILE__).'/../../_module/TimeFactory.php');

$title = isset($_POST['title']) ? $_POST['title'] : 0;
$content = isset($_POST['content']) ? $_POST['content'] : 0;

$controller = new BlogModel();
$datetime = new TimeFactory();

$return['result'] = 'failure';
if ($controller->post($title, $content, $_SESSION["userid"], date("Y-m-d H:i:s")))
	$return['result'] = 'success';

echo json_encode($return);
?>