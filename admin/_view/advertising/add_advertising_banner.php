<?php
if ($_FILES['banner']['tmp_name'] == "") {
	echo "";
	exit;
}
$filename = basename($_FILES['banner']['name']);
$extension = substr($filename, strrpos($filename, ".") + 1, strlen($filename));
$filename = "adsimages".date("YmdHis");
$data = "";
if (move_uploaded_file($_FILES['banner']['tmp_name'], dirname(__FILE__).'/../../../upload/advertising/banner/'.$filename.".".$extension)) {
	$data = $filename.".".$extension;
} else {
    $data = "failure";
}

echo $data;