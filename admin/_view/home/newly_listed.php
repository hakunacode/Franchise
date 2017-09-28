<?php
require_once (dirname(__FILE__).'/../../_controller/HomeController.php');

$controller = new HomeController();

$controller->newly_listed();
?>

<script>
function apply() {
	alert("apply");
}	
</script>