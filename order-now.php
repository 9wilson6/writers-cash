<?php $link = 1?>
<?php
$chat=0;
require_once "inc/header_links.php";
require_once "inc/utilities.php";
require_once "inc/global_functions.php";
require_once("dbconfig/dbconnect.php");
$error="";
$sucess="";
$error_1="";
$success_1="";
if (isset($_REQUEST['login'])) {
	Login();
}else if(isset($_REQUEST['reg'])){
	Register();
}
?>
<div class="order-now">
<?php #require_once 'layout/nav.php';?>
<div class="order-now__content">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-8 col-lg-8">
<form method="post" action="order-now" enctype="multipart/form-data" class="customSelect">
<div class="new-client">
<div class="card">
<div class="card-header">Personal Details</div>
<div class="card-body">
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="username">Username</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="username"
><i class="lnr lnr-user"></i
></span>
</div>
 <input type="text" name="username" id="username" <?php if (isset($_SESSION['username'])): ?>
   value="<?php echo $_SESSION['username'] ?>"
 <?php endif ?> required placeholder="Username" />
</div>
</div>
<div class="col-md-6 mb-3">
<label for="email">Email</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="email"
><i class="lnr lnr-envelope"></i
></span>
</div>
 <input type="email" name="email" <?php if (isset($_SESSION['email'])): ?>
   value="<?php echo $_SESSION['email'] ?>"
 <?php endif ?> id="email" required placeholder="Email" />
</div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="password">Password</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="password"
><i class="lnr lnr-lock"></i
></span>
</div>
<input type="password" name="password" id="password" required placeholder="Password" />
</div>
</div>
<div class="col-md-6 mb-3">
<label for="C_password">Retype Password</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="C_password"
><i class="lnr lnr-lock"></i></span>
</div>
<input type="password" name="C_password" id="C_password"  required placeholder="Confirm Password" />
 <input type="hidden" name="user" value="student">
<input type="hidden" name="user_type" value="1">
</div>
</div>
</div>
</div>
</div>
</div>

<div class="order-details">
<div class="mb-5">
	<?php if (!empty($error_1)): ?>
<div class="bg-danger mx-5 px-3 text-center text-light">
    <strong><?php echo $error_1; ?></strong> </div>
<?php elseif(!empty($success_1)): ?>
<div class="bg-success mx-5 px-3 text-center text-light">
    <strong><?php echo $success_1; ?></strong> </div>
<?php endif ?>

</div>
<div class="card">
	<!-- ///////////////Order Details//////// -->
<div class="card-header">Order Details</div>

<div class="card-body">
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="papertype">Type of Paper</label>
<div class="select">
<select name="papertype"  id="papertype" required>
  <?php if (isset($_SESSION['papertype'])): ?>
    <option value="<?php echo($_SESSION['papertype']) ?>"> <?php echo($_SESSION['papertype']) ?></option>
  <?php endif ?>
<option value="Admission Essay"
>Admission Essay</option
>
<option value="Annotated Bibliography"
>Annotated Bibliography</option
>
<option value="Article Critique/Review"
>Article Critique/Review</option
>
<option value="Book Review">Book Review</option>
<option value="Coursework">Coursework</option>
<option value="Dissertation">Dissertation</option>
<option value="Editing">Editing</option>
<option value="Essay">Essay</option>
<option value="Lab Report">Lab Report</option>
<option value="Math Problem">Math Problem</option>
<option value="Movie Review">Movie Review</option>
<option value="Multiple Choice (MCQs)"
>Multiple Choice (MCQs)</option
>
<option value="Online Test (No Time Framed)"
>Online Test (No Time Framed)</option
>
<option value="Online Test (Time framed)"
>Online Test (Time framed)
</option>
<option value="Other (not listed)"
>Other (not listed)</option
>
<option value="Personal Statement"
>Personal Statement</option
>
<option value="PowerPoint (PPT)"
>PowerPoint (PPT)</option
>
<option value="Programming">Programming</option>
<option value="Questionnaire">Questionnaire</option>
<option value="Research Paper">Research Paper</option>
<option value="Research Proposal"
>Research Proposal</option
>
<option value="Statistics Project"
>Statistics Project</option
>
<option value="Summary">Summary</option>
<option value="Term Paper">Term Paper</option>
<option value="Thesis">Thesis</option>
</select>
</div>
</div>
<div class="col-md-6 mb-3">
<label for="validationDefault02">Subject Area</label>
<div class="select">
 <select name="subject"  id="subject"
 required>
 <?php if (isset($_SESSION['subject'])): ?>
   <option value="<?php echo $_SESSION['subject'] ?>"><?php echo $_SESSION['subject'] ?></option>
 <?php endif ?>
    <option value="Accounting">Accounting</option>
<option value="Agricultural Studies"
>Agricultural Studies</option
>
<option value="Anthropology">Anthropology</option>
<option value="Architecture">Architecture</option>
<option value="Art">Art</option>
<option value="Biology">Biology</option>
<option value="Business">Business</option>
<option value="Chemistry">Chemistry</option>
<option value="Computer Science"
>Computer Science</option
>
<option value="Economics">Economics</option>
<option value="Engineering">Engineering</option>
<option value="English">English</option>
<option value="Finance">Finance</option>
<option value="Geography">Geography</option>
<option value="History">History</option>
<option value="Law">Law</option>
<option value="Legal Studies">Legal Studies</option>
<option value="Logistics">Logistics</option>
<option value="Mathematics">Mathematics</option>
<option value="Medicine and Health"
>Medicine and Health</option
>
<option value="Military Science"
>Military Science</option
>
<option value="Nursing">Nursing</option>
<option value="Pharmacy">Pharmacy</option>
<option value="Philosophy">Philosophy</option>
<option value="Psychology">Psychology</option>
<option value="Religion and Theology"
>Religion and Theology</option
>
<option value="Sociology">Sociology</option>
<option value="Sport">Sport</option>
<option value="Web Design">Web Design</option>
</select>
</div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="validationDefault01">Title</label>
<textarea
name="title"
class="form-control"
id=""
cols="30"
rows="10"
required
><?php if (isset($_SESSION['title'])): ?>
  <?php echo $_SESSION['title']; ?>
<?php endif ?></textarea>
</div>

<div class="col-md-6 mb-3">
<label for="validationDefault01">Academic level</label>
<div class="select">
<select
name="academic_level"
id="academic_level"
required
>
<?php if (isset($_SESSION['academic_level'])): ?>
  <option value="<?php echo $_SESSION['academic_level'] ?>"><?php echo $_SESSION['academic_level']; ?></option>
<?php endif ?>
<option value="College">High School</option>
<option value="College">College</option>
<option value="Undergraduate">Undergraduate</option>
<option value="Masters">Masters</option>
<option value="Postgraduate">Postgraduate</option>
<option value="Ph.D">Ph.D</option>
</select>
</div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="validationDefault01">Style</label>
<div class="select">
<select name="style" id="style" required="">
  <?php if (isset($_SESSION['style'])): ?>
    <option value="<?php echo $_SESSION['style'] ?>"><?php echo $_SESSION['style'] ?></option>
  <?php endif ?>
<option value="APA">APA</option>
<option value="Chicago">Chicago</option>
<option value="Harvard">Harvard</option>
<option value="IEEE">IEEE</option>
<option value="MLA">MLA</option>
<option value="Oscola">Oscola</option>
<option value="Other (not listed)"
>Other (not listed)</option
>
<option value="Oxford">Oxford</option>
<option value="Turabian">Turabian</option>
<option value="Vancouver">Vancouver</option>
</select>
</div>
</div>
<div class="col-md-6 mb-3">
<label for="validationDefault02">Urgency</label>
<div class="select">
<select name="datetyme">
  <?php if (isset($_SESSION['datetyme'])): ?>
    <option value="<?php echo $_SESSION['datetyme'] ?>"><?php echo $_SESSION['datetyme'] ?></option>
  <?php endif ?>
<option value="14days">14 days</option>
<option value="7days">7 days</option>
<option value="10days">10 days</option>
<option value="5days">5 days</option>
<option value="3days">3 days</option>
<option value="2days">2 days</option>
<option value="1day">1 day</option>
<option value="12hours">12 hours</option>
<option value="6hours">6 hours</option>
<option value="3hours">3 hours</option>
</select>
</div>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="validationDefault01">Number of Pages</label>
<input type="number" name="pages" max="1000" id="" min="1" class="form-control"
<?php if (isset($_SESSION['pages'])): ?>
  value="<?php echo $_SESSION['pages'] ?>"
<?php endif ?>
/>
</div>
<div class="col-md-6 mb-3">
<label for="sources">Number of Sources</label>
<input
type="number"
name="sources"
id="sources"
max="1000"
min="1"
class="form-control"
<?php if (isset($_SESSION['sources'])): ?>
  value="<?php echo$_SESSION['sources'] ?>"
<?php endif ?>
/>
<input type="hidden" name="reg">
</div>
</div>
<div class="form-row">
<div class="col-md-12 mb-3">
<label for="instructions">Instructions</label>
<textarea
name="instructions"
id="instructions"
class="form-control"
cols="30"
rows="10"
placeholder="instructions"
required
>
  <?php if (isset($_SESSION['instructions'])): ?>
    <?php echo $_SESSION['instructions']; ?>
  <?php endif ?>
</textarea>
</div>
</div>
<div class="form-row">
<div class="col-md-6 mb-3">
<label for="budget">Budget</label>
<div class="select">
<select name="budget" class="" id="budget" required="">
  <?php if (isset($_SESSION['budget'])): ?>
    <option value="<?php echo $_SESSION['budget'] ?>"><?php echo $_SESSION['budget'] ?></option>
  <?php endif ?>
<option value=""> Select one </option>
<option value="$45">$45 (up to 3 pages) </option>
<option value="$150">$150 (up to 10 pages)</option>
<option value="$280">$280(up to 20 pages)</option>
<option value="$480 ">$480 (up to 35 pages)</option>
<option value="$750"
>$600 (more than 45 pages)
</option>
</select>
</div>
</div>
<div class="col-md-6 mb-3">
<label for="">Files</label> <br />
<label for="cert_" class="input-label">
<i class="fa fa-upload"></i>
<span id="cert">0 Selected</span>
</label>
<input
type="file"
name="file[]"
class="id_card"
id="cert_"
multiple
/>
</div>
</div>
</div>
<input type="submit" class="submit" name="submit" value="Submit Your Order" />
</div>
</div>
</form>
</div>

<div class="col-sm-12 col-md-4 col-lg-4">
<div class="customer-login">
<div class="card">
<div class="card-header">Customer Login</div>
<div class="card-body">
<form method="POST" action="order-now">
	 <?php if (!empty($error)) {?>

        <div class="text-danger text-uppercase  text-center">
          <strong><?php echo $error; ?></strong>
        </div>
        <?php }?>
        <?php if (!empty($success)) {?>
        <div class="text-success text-uppercase text-center">
          <strong><?php echo $success; ?></strong>
        </div>
        <?php }?>
<div class="form-group">
<label for="validationDefault04">Email</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="inputGroupPrepend2"
><i class="lnr lnr-envelope"></i
></span>
</div>
<input
type="email"
class="form-control"
name="email";
id="validationDefaultUsername"
placeholder="Email"
aria-describedby="inputGroupPrepend2"
required
/>
</div>
</div>
<div class="form-group">
<label for="validationDefault04">Password</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text" id="inputGroupPrepend2"
><i class="lnr lnr-lock"></i
></span>
</div>
 <input type="hidden" name="user" value="student" />
 <input type="hidden" name="user_type" value="1" />
 <input type="hidden" name="login" value="1" />
<input
type="Password"
class="form-control"
name="password"
id="validationDefaultUsername"
placeholder="Password"
aria-describedby="inputGroupPrepend2"
required
/>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-6">
<input type="submit" name="submit" class="submit" value="Login" />
</div>
<div class="col-sm-12 col-md-6">
<a href="student_pass_reset">forgot password?</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once "inc/footer_links.php";?>
<script>
CKEDITOR.replace("instructions");
</script>
<script>
$(document).ready(function() {
$("#cert_").on("change", function(e) {
var files = $(this)[0].files;
if (files.length >= 2) {
$("#cert").text(files.length + " Files ready to upload");
} else {
let filename = e.target.value.split("\\").pop();
$("#cert").text(filename);
}
});
});
</script>