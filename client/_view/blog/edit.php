<?php
require_once (dirname(__FILE__).'/../../_controller/BlogController.php');

$id = isset($_POST['id']) ? $_POST['id'] : 0;
$title = isset($_POST['category_id']) ? $_POST['category_id'] : 0;

$controller = new BlogController();

$controller->submenu("new blog");
$controller->edit($category_id,$id);
?>
<script>
$("#submit").click(function() {
	title = $("#title").val();
	content = $("#content").val();
	
	if(title == "") {
		$("#title").focus()
		return;
	}
	if(content == "") {
		$("#content").focus()
		return;
	}
	
	$.post(
		'./post.php',
		{
			title: title,
			content: content
		},
		function(data) {
			if(data.result == 'success')
				location.href = './index.php';
			else
				$("#message").html(data.result);
		},
		"json"
	);
});

$("#cancel").click(function() {
	location.href="./index.php";
});
</script>