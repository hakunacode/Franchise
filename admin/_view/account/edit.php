<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/AccountController.php');

$id = $_POST["id"];

$controller = new AccountController();

$controller->edit($id);
?>
<script>
$("#update").click(function() {
	account = $("#edit_account").val();
	email = $("#edit_email").val();
	password = $("#edit_password").val();
	fullname = $("#edit_fullname").val();
	var permission = 0;
	
	if(account == "") {
		$("#edit_account").focus();
		return;
	}
	if(email == "") {
		$("#edit_email").focus();
		return;
	}
	if(password == "") {
		$("#edit_password").focus();
		return;
	}
	if(fullname == "") {
		$("#edit_fullname").focus();
		return;
	}

	$("#edit_permission option:selected").each(function(i){
		permission = $(this).val();
	}); 
	
	$.post(
		'./action.php',
		{
			selid: <?php echo $id?>,
			edit_account: account,
			edit_email: email,
			edit_password: password,
			edit_fullname: fullname,
			edit_permission: permission,
			act: 'save'
		},
		function(data) {
			if(data)
				location.href = "./index.php";
			else
				alert("error");
		}
	);
});

$("#delete").click(function() {
	if(!confirm("Are you sure you delete user?")) {
		return;
	}
	
	$.post(
		'./action.php',
		{
			selid: <?php echo $id?>,
			act: 'delete'
		},
		function(data) {
			if(data)
				location.href = "./index.php";
			else
				alert("error");
		}
	);
});
</script>