<?php
session_start();

if (!isset($_SESSION["islogin"])) {
	echo "<center><p><div id='error'>required login</div>";
	echo "<a href='../../client/_view/home/'>Home</a>";	
	echo "</p></center>";
	exit;
}

header('Location: ./home/index.php');