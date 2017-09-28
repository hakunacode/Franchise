<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/BlogController.php');

$controller = new BlogController();

$controller->header();
$controller->home();
$controller->footer();
?>
<script>
function view(id, title) {
	$.post(
		'./view.php',
		{
			id: id,
			title: title
		},
		
		function(data) {
			$('#main_body').html(data);
		}
	);
}
function newblog(id) {
	location.href = "./edit.php?id="+id;
}
</script>