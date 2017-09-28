<?php
session_start();
require_once (dirname(__FILE__).'/../../_controller/BlogController.php');

$id = isset($_POST['id']) ? $_POST['id'] : 0;
$title = isset($_POST['title']) ? $_POST['title'] : 0;

$controller = new BlogController();

$controller->submenu($title);
$controller->view($id);
?>
<script>
$("#post").click(function() {
    name = $("#name").val();
    email = $("#email").val();
    comment = $("#comment").val();
    if(name == "") {
            $("#name").focus();
            return;
    }
    if(email == "") {
            $("#email").focus();
            return;
    }
    if(comment == "") {
            $("#comment").focus();
            return;
    }
    if(!checkEmail(email)) {
        alert("incorrect email address");
        $("#email").focus();
    }

    $.post(
        "./addcomment.php",
        {
                blog_id: '<?php echo $id?>',
                name: name,
                email: email,
                comment: comment
        },
        
        function(data) {
            if (data.result == "success") {
                view("<?php echo $id?>", "<?php echo $title?>");
            }
        },
        "json"
    );
});

$("#cancel").click(function() {
        location.href="./index.php";
});
	
</script>