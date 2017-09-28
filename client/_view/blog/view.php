<?php
require_once (dirname(__FILE__).'/../../_controller/BlogController.php');

$id = isset($_POST['id']) ? $_POST['id'] : 0;

$controller = new BlogController();
$controller->view($id);
?>
<script>
function add_comment() {
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
                view("<?php echo $id?>");
            }
        },
        "json"
    );
}

function back() {
        location.href="./index.php";
}
	
</script>