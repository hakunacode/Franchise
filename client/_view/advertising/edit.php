<?php
require_once (dirname(__FILE__).'/../../_controller/AdvertisingController.php');

$id = isset($_POST['id']) ? $_POST['id'] : 0;
$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;

$controller = new AdvertisingController();

$controller->submenu($category_id);
$controller->new_ads($category_id, $id);
?>
<script>

jQuery(function($){
	$('.banner').fileUploader();
});

$("#title").focus();

$("#cancel").click(function() {
	$.post(
		'./categories_advertising.php',
		{
			category_id: '<?php echo $category_id?>'
		},
		function (data) {
			$('#main_body').html(data);
		}
	);
});
/*
$("#submit").click(function() {

	var title = $("#title").val();
	var comment = $("#comment").val();

	if (title == "") {
		$("#title").focus();
		return false;
	}	

	if (comment == "") {
		$("#comment").focus();
		return false;
	}	
	alert("dasdsadsa");
	document.forms[0].submit();
	
});
*/

function category_link(id) {
	$.post(
		'./categories_advertising.php',
		{
			category_id: id
		},
		function (data) {
			$('#main_body').html(data);
		}
	);
}

</script>