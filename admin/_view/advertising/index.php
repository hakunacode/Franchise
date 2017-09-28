<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/AdvertisingController.php');

$category_id = isset($_GET["category_id"]) ? $_GET["category_id"] : 0;

$controller = new AdvertisingController();

$controller->header();
$controller->home($category_id);
$controller->footer();
$controller->dialog_container();
?>

<script>
function edit(id) {
	location.href="./new_edit.php?category_id=<?php echo $category_id?>&id="+id;
}

function delete_ads(id) {
	if(!confirm("Are you sure you delete advertisment?")) 
		return;
	
	$.post(
		'./delete.php',
		{
			id: id
		},
		function(data) {
			location.href="./index.php?category_id=<?php echo $category_id?>";
		}
	);
}

function change_category(e) {
	id = 0;
	for(i = 0; i < e.options.length; i++) {
		if(e.options[i].selected) {
			id = e.options[i].value;
			break;
		}
	}
	
	location.href="?category_id="+id;
}

$("#add_ads").click(function add_ads() {
	location.href='new_edit.php?category_id=<?php echo $category_id?>';
});
</script>