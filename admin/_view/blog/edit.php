<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/BlogController.php');

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$controller = new BlogController();
$controller->header();
$controller->submenu("new blog");
$controller->edit($id);
?>
<script>
function add_post() {
	title = $("#title").val();
	if(title == "") {
		$("#title").focus()
		return;
	}
	
	var $form = $("form#main_form");
	$("#contents").val(_htmlcontent._htmlarea.document.body.innerHTML);

	if($("#contents").val() == "") 
		return;

	var dataToSend = $form.serialize();
    // the callback function that tells us what the server-side process had to say
    var callback = function(dataReceived){
		location.href = "./index.php";
    };

    // type of data to receive (in our case we're expecting an HTML snippet)
    var typeOfDataToReceive = 'html';
    // now send the form and wait to hear back
    $.post( './post.php', dataToSend, callback, typeOfDataToReceive );
}

function back() {
	location.href="./index.php";
}
</script>
<?php $controller->footer();?>