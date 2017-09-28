<?php
require_once (dirname(__FILE__).'/../../_controller/AdvertisingController.php');

$id = isset($_POST["id"]) ? $_POST["id"] : 0;
$category_id = isset($_POST["category_id"]) ? $_POST["category_id"] : 0;

$controller = new AdvertisingController();

//$controller->edit($category_id, $id);
$controller->edit_advertise($category_id, $id);
?>
<script>

$("#update").click(function() {
	var $ads_id = $("#ads_id").val();
	var $title = $("#title").val();
	var $desc = $("#desc").val();
	var $flag = 0;
	var $status = 0;
	var $country = 0;
	var $locations = 0;
	
	$("#country").each(function(i) {
		$country = $(this).val();
	});
	
	$("#location").each(function(i) {
		$locations=$(this).val();
	});
	
		
	$("#flag option:selected").each(function(i){
		$flag = $(this).val();
	}); 
	
	$("#status option:selected").each(function(i){
		$status = $(this).val();
	}); 
	
	if($title == "") {
		$("#title").focus();
		return;
	}
	if($desc == "") {
		$("#desc").focus();
		return;
	}

	$("#banner").upload('./add_advertising_banner.php', function(data) {
        if(data == 'failure') {
        	alert('File upload is invalid');
        	return;
        } else {
        	if (data != "")
        		$("#filename").val(data);
        	
			$.post(
				'./add_advertising_data.php',
				{
					ads_id: $ads_id,
					title: $title,
					desc: $desc,
					flag: $flag,
					status: $status,
					location: $locations,
					country: $country,
					filename: $("#filename").val()
				},
				
				function (data) {
					location.href = '?category_id=<?php echo $category_id?>';
				}
			);

        }
    });
});
</script>