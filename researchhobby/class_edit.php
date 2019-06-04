<?php
require_once("../inc/utilities.php");
require_once "../inc/header_links.php";
$page="classes";
require_once ".top_nav.php";
require_once('../dbconfig/dbconnect.php');
?>
<?php 
////////////////////////////////////////////////////////////////////////
//////////////////////////////PHP//////////////////////////////////////
$error=null;
$success=null;

require_once("stud_functions.php");
class_edit();
if (isset($_REQUEST['id'])) {
$homework_id=convert_uudecode($_REQUEST['id']);

$query="SELECT * FROM classes WHERE project_id='$homework_id'";
if ($db->get_row($query)) {
$results=$db->get_row($query);
}else{
header("LOCATION:my-homework");
}
}




////////////////////////////////////////////////////////////////////////
//////////////////////////////PHP//////////////////////////////////////
?>
<div class="page-container">
<?php require_once "./stud_leftnav.php" ?>
<div class="display">

<div class="display__content">

<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
<h1 class="headingTertiary">Edit Assignment</h1>
<div class="card text-center">
<div class="card-header">
Please Edit Assignment Details Below
</div>
<div class="card-body">
<div class="forms2">
<?php if (!empty($_REQUEST['error'])): ?>
<div class="bg-danger mx-5 px-3 text-center text-light">
<strong><?php echo $_REQUEST['error']; ?></strong> </div>
<?php elseif(!empty($_REQUEST['success'])): ?>
<div class="bg-success mx-5 px-3 text-center text-light">
<strong><?php echo $_REQUEST['success']; ?></strong> </div>
<?php endif ?>
              <form action="" method="POST" class="customSelect">
                <div class="form-row">
                 <div class="col-md-6 mb-3">
                      <label for="validationDefault02">Subject Area</label>
                      <div class="select">
                        <select name="subject" id="subject" required>
                        	<option value="<?php echo $results->subject ?>"><?php echo $results->subject ?></option>
                          <option value="Accounting">Accounting</option>
                          <option value="Agricultural Studies">Agricultural Studies</option>
                          <option value="Anthropology">Anthropology</option>
                          <option value="Architecture">Architecture</option>
                          <option value="Art">Art</option>
                          <option value="Biology">Biology</option>
                          <option value="Business">Business</option>
                          <option value="Chemistry">Chemistry</option>
                          <option value="Computer Science">Computer Science</option>
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
                          <option value="Medicine and Health">Medicine and Health</option>
                          <option value="Military Science">Military Science</option>
                          <option value="Nursing">Nursing</option>
                          <option value="Pharmacy">Pharmacy</option>
                          <option value="Philosophy">Philosophy</option>
                          <option value="Psychology">Psychology</option>
                          <option value="Religion and Theology">Religion and Theology</option>
                          <option value="Sociology">Sociology</option>
                          <option value="Sport">Sport</option>
                          <option value="Web Design">Web Design</option>
                        </select>
                      </div>
                    </div>
                     <div class="col-md-6 mb-3">
                      <label for="budget">Budget</label>
                      <div class="select">
                        <select name="budget" class="" id="budget" required="">
                        	<option value="<?php echo $results->budget ?>"><?php echo $results->budget ?></option>
                          <option value=""> Select one </option>
                          <option value="$280">$280(up to 5 weeks)</option>
                          <option value="$480 ">$480 (up to 8 weeks)</option>
                          <option value="$750">$600 (more than 8 weeks)</option>
                        </select>
                      </div>
                    </div>
                  </div>
                 <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label for="instructions">Class details</label>
                      <textarea name="instructions" id="instructions" class="form-control" cols="30" rows="10"
                        placeholder="instructions" required> <?php echo $results->instructions; ?>
                    </textarea>
                    </div>
                  </div>
                   <div class="form-row">
                 <div class="col-md-12 mb-3">
                 	<input type="hidden" name="project_id" value="<?php echo $homework_id ?>">
                 	<input type="submit"  class="submit" name="edit_class" style="min-width: 400px" value="Edit class" />
                 </div>
                  
               </div>
                  
              </form>
</div>
</div>

</div>
</div>
<?php require_once("section_notes.php") ?>
</div>
</div>
</div>
</div>

<?php require_once "../inc/footer_links.php";?>
<!-- <script  src="../plugins/jquery.nice-number.min.js"></script> -->
<script src="../plugins/ckeditor.js"></script>
<script>
CKEDITOR.replace("instructions");
</script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script> -->
<script>
$(document).ready(function () {
$("#cert_").on("change", function (e) {
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