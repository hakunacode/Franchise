<?php
require_once (dirname(__FILE__).'/../../_controller/AdvertisingController.php');

$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
$id = isset($_POST['ads_id']) ? $_POST['ads_id'] : 0;

$controller = new AdvertisingController();
$controller->submenu($id);
$controller->request_form($id);
?>
<script>
$("#request_cancel").click(function() {
	category_link('<?php echo $category_id?>');
});

$("#request_submit").click(function() {
	var $name = $("#request_name").val();

	var $email = $("#request_email").val();
	var $zip = $("#request_zipcode").val();
	var $phone = $("#request_phone").val();
	var $country = 0;
	var $street = $("#request_street").val();
	var $city = $("#request_city").val();
	var $state = $("#request_state").val();
	var $investment = 0;
	$("#request_country option:selected").each(function(i){
		$country = $(this).val();
	}); 
	
	var $location = 0;
	$("#request_location option:selected").each(function(i){
		$location = $(this).val();
	}); 
	
	$("#request_investment option:selected").each(function(i){
		$investment = $(this).val();
	}); 

	if($name == "") {
		$("#request_name").focus();
		return;
	}
	if($email == "") {
		$("#request_email").focus();
		return;
	}
	if($phone == "") {
		$("#request_phone").focus();
		return;
	}
	if($street == "") {
		$("#request_street").focus();
		return;
	}
	if($city == "") {
		$("#request_city").focus();
		return;
	}
	if($state == "") {
		$("#request_state").focus();
		return;
	}
	if($zip == "") {
		$("#request_zipcode").focus();
		return;
	}
	if($investment == 0) {
		$("#request_investment").focus();
		return;
	}
	
	$.post(
		'ads_request.php',
		{
			id: '<?php echo $id?>',
			name: $name,
			email: $email,
			zip: $zip,
			phone: $phone,
			country: $country,
			location: $location,
			street: $street,
			city: $city,
			state: $state,
			investment: $investment 
		},				
		function (data) {
			if (data.flag=='success') {	
				category_link('<?php echo $category_id?>');
			}	else {								
				$("#message").html("Invalid "+ data.flag);
			}
		}
		,"json"
	);
});
</script>