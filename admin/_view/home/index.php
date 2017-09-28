<?php
session_start();

require_once (dirname(__FILE__).'/../../_controller/HomeController.php');

$controller = new HomeController();

$controller->header();
$controller->home();
$controller->footer();

$controller->dialog_container();
?>
<script>
function flag(e, id) {
	flag = 1;
	for(i = 0; i < e.options.length; i ++) {
		if(e.options[i].selected) {
			flag = e.options[i].value;
			break;
		}
	}

	$.post(
		'./action.php',
		{
			ads_id: id,
			flag: flag,
			act: 'flag'
		},
		function(data) {
			if(data.result) {
				location.href="./";
			} else {
				alert("incorrect updating advertising status");
			}
		},
		"json"
	);
}

function status(e, id) {
	status = 1;
	for(i = 0; i < e.options.length; i ++) {
		if(e.options[i].selected) {
			status = e.options[i].value;
			break;
		}
	}

	$.post(
		'./action.php',
		{
			ads_id:id,
			status: status,
			act: 'status'
		},
		function(data) {
			if(data.result) {
				location.href="./";
			} else {
				alert("incorrect updating advertising status");
			}
		},
		"json"
	);
}

function category_link(id) {
	location.href="../advertising/index.php?category_id="+id;
}

function jsRequestLink(id, ad_id) {
	location.href="./request.php?request_id="+id+"&ad_id="+ad_id;
}


function add_newly() {
	var $id = 0;
	var $text = "";
	$("#ads_list option:selected").each(function(i) {
		var $this = $(this);
		$id = $this.val();
		$text = $this.text();
		$this.remove();
	});

	if($id > 0) {
		$('<option/>').attr('value',$id).text($text).appendTo('#newly_list');
	}
}

function remove_newly() {
	var $id = 0;
	var $text = "";
	$("#newly_list option:selected").each(function(i) {
		var $this = $(this);
		$id = $this.val();
		$text = $this.text();
		$this.remove();
	});

	if($id > 0) {
		$('<option/>').attr('value',$id).text($text).appendTo('#ads_list');
	}
}
</script>