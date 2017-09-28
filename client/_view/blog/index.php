<?php
require_once (dirname(__FILE__).'/../../_controller/BlogController.php');

$controller = new BlogController();

$controller->header();
$controller->home();
$controller->footer();
?>
<script>
function view(id) {
	$.post(
		'./view.php',
		{
			id: id
		},
		
		function(data) {
			$('#main_body').html(data);
		}
	);
}
</script>