<?php
session_start();
require_once (dirname(__FILE__).'/../../_model/BlogModel.php');

$title = isset($_POST['title']) ? $_POST['title'] : 0;
$content = isset($_POST['contents']) ? $_POST['contents'] : "";

$controller = new BlogModel();

//$return['result'] = 'failure';
$controller->post($title, $content, $_SESSION["userid"], date("Y-m-d H:i:s"));
//$return['result'] = 'success';

//echo json_encode($return);
?>