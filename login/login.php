<html>
<title>The franchise - login</title>
<head>
	<meta name="description" content="This is a templete site">
	<meta name="author" content="anonymous">
	<link href="../include/css/style.css" rel="stylesheet">
	<script src="../include/lib/jquery-1.7.1.min.js" language="javascript"></script>
	<script src="../include/lib/jquery.shadow.js" language="javascript"></script>
<script>
$("document").ready(function() {
	$("#username").focus();
	$("#forgot-container").css("display", "none");

	if ($.browser.msie) {
		$('#main-container').boxShadow( 3, 3, 3, "#808080");
		$('#login-container').css("border", "1px solid #e0e0e0");
		$('#login-container').css("width", "400px");
	}

	$("#forgot").click(function() {
		$("#login-container").html($("#forgot-container").html());
		$("#email").focus();
	});
	
	$("#username").keypress(function(ev) {
		if(ev.keyCode == 13) {
			$("#sign").click();
		}
	});

	$("#password").keypress(function(ev) {
		if(ev.keyCode == 13) {
			$("#sign").click();
		}
	});
	
	$("#sign").click(function() {
		
		$username = $("#username").val();
		$password = $("#password").val();

		if($username == "") {
			$("#username").focus();
			return;
		}
		if($password == "") {
			$("#password").focus();
			return;
		}

		$.post(
			"./check.php",
			{
				username: $username,
				password: $password
			},
			
			function(data) {
				if (data == "1")
					location.href="../admin/_view/home/index.php";
				else if (data == "2")
					location.href="../client/_view/home/index.php";
				else if (data == "3")
					location.href="../advertisor/_view/home/index.php";
				else if (data == "4")
					location.href="../client/_view/home/index.php";
				else
					$("#message").html(data);
			}
		);
	});
});

function back() {
	location.href = "./login.php";
}	

function forgotaction() {
	var $email = $("#email").val();
	if($email == "") {
		$("#email").focus();
		return;
	}
	$.post(
		'./forgot.php',
		{
			email: $email
		},
		function(data) {
			$("#message").html(data);
		}
	);
}
</script>
</head>
<body>
<center>
<div id="main-container" style='padding-top:50px; padding-bottom:50px'>
	<p align="center">
		<img src='../include/img/logo.gif' style='width:400px'>
	<br><br>
	<div id="login-container">
		<div id="logo" style="text-align:left; width:100%">Account Login</div><br>
		<div id="message"></div>
		<table style="width:100%; font-size:13px">
			<tr>
				<td></td>
				<td><div id="message" style="text-align:left; width:100%"></div></td>
			</tr>
			<tr>
				<td>User Name</td>
				<td><input type="text" name="username" id="username" value="" style="width:250px"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password" id="password" value="" style="width:250px"></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="#" id="forgot">Forgot password</a></td>
			</tr>
			<tr style="height:50px">
				<td></td>
				<td><input type="button" class="button" value="Sign in" id="sign"></td>
			</tr>
		</table>
	</div>
	</p>
</div>
<div id='forgot-container'>
	<table style="width:100%; font-size:13px">
		<tr>
			<td></td>
			<td><div id="message" style="text-align:left; width:100%"></div></td>
		</tr>
		<tr>
			<td>Email Address</td>
			<td><input type="text" name="email" id="email" value="" style="width:250px"></td>
		</tr>
		<tr style="height:50px">
			<td></td>
			<td><input type="button" class="button" value="Submit" id="forgotaction" onclick="forgotaction()">
				<input type="button" class="button" value="Cancel" id="back" onclick="back()"></td>
		</tr>
	</table>
</div>
</center>

</body>
</html>