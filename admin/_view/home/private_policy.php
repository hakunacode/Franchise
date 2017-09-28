<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/HomeController.php');

$controller = new HomeController();

$controller->header();
$controller->private_client();
$controller->footer();
?>
<script>
function category_link(id) {
	location.href = '../advertising/index.php?category_id=' + id;
}
</script>