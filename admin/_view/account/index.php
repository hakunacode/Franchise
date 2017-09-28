<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/AccountController.php');

$controller = new AccountController();

$controller->header();
$controller->home();
$controller->footer();
$controller->dialog_container();
?>
