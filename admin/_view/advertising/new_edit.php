<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/AdvertisingController.php');

$category_id = isset($_GET["category_id"]) ? $_GET["category_id"] : 0;
$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$controller = new AdvertisingController();

$controller->header();
?>
<script>
function modify(advertisor_id) {
	$.post(
		'./select_advertisor.php',
		{
			advertisor_id: advertisor_id
		},
		function(data) {
			show_dialog('Select advertisor', data);
		}
	);
}

function add_ads() {
	var $title = $("#title").val();
	var $desc = $("#desc").val();
	var $flag = 0;
	var $status = 0;
	var $country = 0;
	var $locations = 0;
	var $advertisor_id = $("#advertisor_id").val();
	
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
	
	if($advertisor_id == "" || $advertisor_id == 0) {
		alert("please select Advertisor.");
		modify(0);
		return;
	}
	
	$("#banner").upload('./add_advertising_banner.php', function(data) {
        if(data == 'failure') {
        	alert('File upload is invalid');
        	return;
        } else {
        	if (data != "")
        		$("#filename").val(data);
			var $form = $("form#main_form");
			$("#contents").val(_htmlcontent._htmlarea.document.body.innerHTML);
			
			var dataToSend = $form.serialize();
		    // the callback function that tells us what the server-side process had to say
		    var callback = function(dataReceived){
				location.href = "./index.php?category_id=<?php echo $category_id?>";
		    };

		    // type of data to receive (in our case we're expecting an HTML snippet)
		    var typeOfDataToReceive = 'html';
		    // now send the form and wait to hear back
		    $.post( './add_advertising_data.php', dataToSend, callback, typeOfDataToReceive );
        }
    });
}

function back() {
	location.href='./index.php?category_id=<?php echo $category_id?>';
}
</script>
<?php
$controller->submenu($category_id);
$controller->new_edit($category_id, $id);
$controller->footer();
$controller->dialog_container();
?>