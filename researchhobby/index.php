<?php require_once "../inc/header_links.php";
require_once '../layout/nav.php';
require_once '../layout/header.php';
if (isset($_POST['Continue'])) {
    $_SESSION['academic_level'] = $_POST['academic_level'];
    $_SESSION['papertype'] = $_POST['papertype'];
    $_SESSION['datetyme'] = $_POST['datetyme'];
    $_SESSION['pages'] = $_POST['pages'];
   ?>
<script>
	window.location.assign("order-now");
</script>
<?php }
require_once '../layout/mainsection.php';
require_once '../layout/footer.php';
require_once "../inc/footer_links.php";
?>


