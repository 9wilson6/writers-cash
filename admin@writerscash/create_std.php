<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../dbconfig/dbconnect.php");
$mainpage="dashboard";
$page="dashboard";
require_once("./inc/leftnav.php");
$error=null;
$success=null;
if (isset($_POST['submit'])) {
$email=$_POST['email'];
$username=$_POST['username'];
	$query="SELECT count(email) FROM users WHERE email='$email'";
	$email_check=$db->get_var($query);
	if ($email_check==0) {
$new_pass=$_POST['new_pass'];
$con_pass=$_POST['con_pass'];
if ($new_pass==$con_pass) {
if (strlen($new_pass)>6) {
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
$password_=password_hash($new_pass, PASSWORD_DEFAULT);
	$date=date("Y-m-d H:i:sa");
	$user_type=1;
	$about_me="";
	$verif_key=str_shuffle(substr(password_hash($date, PASSWORD_DEFAULT), 30,90));
	$query="INSERT INTO users(username, email, password, type, created_on,verif_key, status, about_me) VALUES('$username','$email','$password_', '$user_type','$date','$verif_key', 1, '$about_me')";
	$results=$db->query($query);

if ($db->query($query)) {
$success="Account registered successfully";
}
}else{
$error="Email provided is invalid";
}
}else{
$error="make you password longer than six characters";
}
}else{
$error="passwords didn't match";
}
}else{
	$error="email already exists";	
	}
	}

?>
<div class="page-container">
	<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">

<h1 class="headingTertiary text-center text-uppercase">Register student</h1>
<div class="row">
<div class="col-md-2"></div>
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<div class="card">
<div class="card-header text-uppercase">Register new student here</div><!--card header-->
<div class="card-body">


<div class="table-responsive">
<table class="table text-center">
<thead>
<tr>
<?php if (isset($error) & !empty($error)): ?>
<td colspan="2" class="text-danger"><?php echo $error; ?></td>
<?php elseif(isset($success) & !empty($success)): ?>
<td colspan="2" class="text-success"> <?php echo $success; ?></td>
<?php endif ?>

</tr>
</thead>
<tbody>
<form action="" method="POST">
<tr>
<th><label>Username</label></td>
<td><input type="text" name="username" class="form-control forms2__input" required></td>
</tr>
<tr>
<th><label>Email</label></td>
<td><input type="email" name="email" class="form-control forms2__input" required></td>
</tr>
<tr>
<th><label>password</label></td>
<td><input type="password" name="new_pass" class="form-control forms2__input" min="6" required></td>
</tr>
<tr>
<th><label>confirm password</label></td>
<td><input type="password" name="con_pass" class="form-control forms2__input" min="6" required></td>

</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" class="btn btn-block btn-primary" name="submit" style="background:#1289A7; color: white" value="Submit"></td>
</tr>
</form>
</tbody>
</table>



</div>
</div><!--card body-->
</div><!--card-->
</div> <!--col 1-->

<div class="col-md-2"></div>

</div>
</div>
</div>
</div>
<?php require_once("../inc/footer_links.php") ?>


