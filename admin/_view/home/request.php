<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/HomeController.php');
$request_id = $_GET["request_id"];
$ad_id = $_GET["ad_id"];

$controller = new HomeController();

$controller->header();
$controller->request_home($request_id, $ad_id);
$controller->footer();
?>

<script>
$("#update").click(function() {
	var $flag = 0;
	
	$("#flag option:selected").each(function(i) {
		$flag = $(this).val();
	});
	
	$.post(
		'./request_permit.php',
		{
			id: <?php echo $request_id?>,
			flag: $flag
		},
		function(data) {
			if(data.result == "failure")
				$("#message").html("");
			else
				location.href = './index.php';
		},
		"json"
	);
});
function jsOnBack() {
	location.href= "./index.php";
}	
	
</script>