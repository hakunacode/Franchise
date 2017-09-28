<?php
function htmlspecialchar($str) {
	if($str == "")
	return $str;

	$str = str_replace("'", "&#39;", $str);
	$str = str_replace("\"", "&#34;", $str);

	return $str;
}

function htmlentity($str) {
	if($str == "")
	return "";

	$str = str_replace("&#39;", "'", $str);
	$str = str_replace("&#34;", "\"", $str);

	return $str;
}