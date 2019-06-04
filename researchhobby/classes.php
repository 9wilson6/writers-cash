<?php
require_once("../inc/utilities.php");
require_once "../inc/header_links.php";
$page="classes";
require_once "./top_nav.php";
require_once"../dbconfig/dbconnect.php";
?>
  <?php 
////////////////////////////////////////////////////////////////////////
//////////////////////////////PHP//////////////////////////////////////
$error=null;
$success=null;
require_once("stud_functions.php");
create_class();
////////////////////////////////////////////////////////////////////////
//////////////////////////////PHP//////////////////////////////////////
?>
  <div class="page-container">
  	<?php require_once "./stud_leftnav.php" ?>
  <div class="display">

    <div class="display__content">

      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
          <h1 class="headingTertiary ">New class</h1>
          <div class="card text-center">
            <div class="card-header">
             Please Add Class Details Below
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                <div class="bg-danger mx-5 px-3 text-center text-light">
                  <strong><?php echo $error; ?></strong> </div>
                <?php elseif(!empty($success)): ?>
                <div class="bg-success mx-5 px-3 text-center text-light">
                  <strong><?php echo $success; ?></strong> </div>
                <?php endif ?>
              <form action="" method="POST" class="customSelect">
                <div class="form-row">
                 <div class="col-md-6 mb-3">
                      <label for="validationDefault02">Subject Area</label>
                      <div class="select">
                        <select name="subject" id="subject" required>
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
                        placeholder="instructions" required>
                    </textarea>
                    </div>
                  </div>
                   <div class="form-row">
                 <div class="col-md-8 mb-3"><input type="submit"  class="submit" name="submit_class" style="min-width: 300px" value="Create class" /></div>
                  <div class="col-md-4 mb-3"> 
                    <a href="my-classes" class="submit" name="submit_class" style="color: #fff; font-weight: bolder; padding-top: 5px; font-size: 16px" />My classes</a> </div>
               </div>
                  
              </form>
            </div>
          </div>
        </div>
        <?php require_once("section_notes.php") ?>

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
 
  <?php require_once("../support.php") ?>