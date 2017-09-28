<?php
require_once (dirname(__FILE__).'/../../_controller/AdvertisingController.php');

$ads_id = isset($_GET['ads_id']) ? $_GET['ads_id'] : 0;
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;

$controller = new AdvertisingController();
$controller->header();
$controller->home($category_id);
$controller->footer();
$controller->dialog_container();
?>

<script>
	$("document").ready(function() {
		$.post(
			'./request_form.php',
			{
				ads_id: <?php echo $ads_id?>,
				category_id: <?php echo $category_id?>
			},
			function(data) {
				$('#main_body').html(data);
			}
		);
	});
	$("#new").click(function() {
		$.post(
			'./edit.php',
			{
				id: 0,
				category_id: '<?php echo $category_id?>'
			},
			
			function (data) {
				$('#main_body').html(data);
			}
		);
	});
	
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
	
	function request(id, title, desc) {
		location.href = "request_form.php?ads_id="+ads_id+"&category_id=<?php echo $category_id?>";
		$.post(
			'./request_form.php',
			{
				ads_id: id,
				category_id: '<?php echo $category_id?>'
			},
			function(data) {
				$('#main_body').html(data);
			}
		);
	}
	
</script>