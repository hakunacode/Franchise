<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/AdvertisingController.php');

$id = isset($_POST["advertisor_id"]) ? $_POST["advertisor_id"] : 0;

$controller = new AdvertisingController();
$controller->select_advertisor($id);
?>
<script>
function select_advertisor() {
	var $id = 0;
	var $i = 0;
	var $account = "";
	$("input:radio").each(function() {
		if($(this).attr('checked')) {
			$id = $(this).val();
			$account = $("#account" + $i).text();
		}
		$i ++;
	});
	
	if($id > 0) {
		$("#advertisor_link").html("<a href=\"javascript:modify(" + $id + ")\">" + $account + "</a>" + 
				"<input type='hidden' id='advertisor_id' name='advertisor_id' value='"+ $id +"'>");
		
		//$("#basic-modal-body").close();
	}
}
</script>