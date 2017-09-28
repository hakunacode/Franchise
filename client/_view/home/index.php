<?php
require_once (dirname(__FILE__).'/../../_controller/HomeController.php');

echo "&#39;";

$controller = new HomeController();

$controller->header();
$controller->home();
$controller->footer();
?>
<script type="text/javascript">
function category_link(id) {
	location.href="../advertising/index.php?category_id="+id;
}

function more(id, category_id) {
	location.href="../advertising/recent.php?category_id="+category_id+"&ads_id="+id;
}
</script>