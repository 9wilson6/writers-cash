<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
$mainpage="student";
$sub_page="student_message";
$feedback=null;
$feedback_=null;
$users=$db->get_results("SELECT * FROM users WHERE type=1");
if (isset($_POST['send'])) {
$subject=$_POST['subject'];
$message_=$_POST['message'];
$query="SELECT email, username FROM users WHERE type=1 and  status=1";
$results=$db->get_results($query); 
// print_r($results);
// die;
if ($db->num_rows>0) {
foreach ($results as $result) {
$message .="Hello ". $result->username.", <br>".$message_;
sendMail($message, $result->email, $subject);
$message="";
}
$feedback="Messages sent successfully";
}

}
if (isset($_POST['mail'])) {
$subject=$_POST['subject'];
$message=$_POST['message'];
$email=$_POST['email'];
sendMail($message, $email, $subject);
$feedback_="Messages sent successfully";
}
?>
<div class="page-container">
<?php require_once "inc/leftnav.php" ?>
<div class="display">
<div class="display__content">
<h1 class="headingTertiary  text-uppercase">
MESSAGE ALL students
</h1>
<div class="row">
<div class="col-sm-12 col-md-6">
<div class="card">
<div class="card-header">MESSAGE ALL STUDENTS HERE</div>
<div class="card-body">
<form action="" method="POST">
<?php if ($feedback != null ): ?>
<div class="text-success"> <?php echo $feedback; ?></div>
<?php endif ?>
<div class="form-group">
<label for="exampleFormControlInput1">Subject</label>
<input type="text" class="form-control forms2__input" name="subject" id="exampleFormControlInput1"
placeholder="Enter email subject here" required />
</div>
<div class="form-group">
<label for="exampleFormControlTextarea1">MESSAGE</label>
<textarea class="form-control forms2__textarea" name="message"
placeholder="Enter you message here...." rows="10" required></textarea>
</div>
<center><button type="submit" name="send" class="btn-submit btn-block">Send</button></center>
</form>
</div>
</div>
</div>
<div class="col-sm-12 col-md-6">
<div class="card">
<div class="card-header">MESSAGE SINGLE Student</div>
<div class="card-body">
<form action="" method="POST" class="customSelect">
<?php if ( $feedback_ != null ): ?>
<div class="text-success"> <?php echo  $feedback_; ?></div>
<?php endif ?>
<div class="form-group">
<label for="exampleFormControlInput1">Select User to email</label>
<div class="select">
<select name="email" class="" required>
<?php foreach ($users as $user): ?>
<option value="<?php echo $user->email ?>"><?php echo $user->username ?></option>
<?php endforeach ?>
</select>
</div>
</div>
<div class="form-group">
<label for="exampleFormControlInput1">Subject</label>
<input type="text" class="form-control forms2__input" name="subject" id="exampleFormControlInput1"
placeholder="Enter email subject here" required />
</div>
<div class="form-group">
<label for="exampleFormControlTextarea1">MESSAGE</label>
<textarea class="form-control forms2__textarea" name="message"
placeholder="Enter you message here...." rows="7" required></textarea>
</div>
<center><button type="submit" name="mail" class="btn-submit btn-block">Send</button></center>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once("../inc/footer_links.php") ?>