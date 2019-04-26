<?php
require_once("../inc/utilities.php");
require_once "../inc/header_links.php";
$page="my-homework";
require_once "../components/top_nav.php";

?>
<?php 
////////////////////////////////////////////////////////////////////////
//////////////////////////////PHP//////////////////////////////////////
$error=null;
$success=null;
require_once("stud_functions.php");
edit_post();
if (isset($_REQUEST['id'])) {
	$homework_id=convert_uudecode($_REQUEST['id']);
	require_once('../dbconfig/dbconnect.php');
$query="SELECT * FROM projects WHERE project_id='$homework_id'";
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
    <?php require_once "../components/stud_leftnav.php" ?>
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
                                <form enctype="multipart/form-data" method="POST" action="homework_edit"
                                    class="customSelect">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="papertype">Type of Paper</label>
                                            <div class="select">
                                                <select name="papertype" id="papertype" required>

                                                    <option value="<?php echo $results->type_of_paper ?>">
                                                        <?php echo $results->type_of_paper ?>
                                                    </option>

                                                    <option value="Admission Essay">Admission Essay</option>
                                                    <option value="Annotated Bibliography">Annotated Bibliography
                                                    </option>
                                                    <option value="Article Critique/Review">Article Critique/Review
                                                    </option>
                                                    <option value="Book Review">Book Review</option>
                                                    <option value="Coursework">Coursework</option>
                                                    <option value="Dissertation">Dissertation</option>
                                                    <option value="Editing">Editing</option>
                                                    <option value="Essay">Essay</option>
                                                    <option value="Lab Report">Lab Report</option>
                                                    <option value="Math Problem">Math Problem</option>
                                                    <option value="Movie Review">Movie Review</option>
                                                    <option value="Multiple Choice (MCQs)">Multiple Choice (MCQs)
                                                    </option>
                                                    <option value="Online Test (No Time Framed)">Online Test (No Time
                                                        Framed)</option>
                                                    <option value="Online Test (Time framed)">Online Test (Time framed)
                                                    </option>
                                                    <option value="Other (not listed)">Other (not listed)</option>
                                                    <option value="Personal Statement">Personal Statement</option>
                                                    <option value="PowerPoint (PPT)">PowerPoint (PPT)</option>
                                                    <option value="Programming">Programming</option>
                                                    <option value="Questionnaire">Questionnaire</option>
                                                    <option value="Research Paper">Research Paper</option>
                                                    <option value="Research Proposal">Research Proposal</option>
                                                    <option value="Statistics Project">Statistics Project</option>
                                                    <option value="Summary">Summary</option>
                                                    <option value="Term Paper">Term Paper</option>
                                                    <option value="Thesis">Thesis</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="hidden" name="project_id" value="<?php echo $homework_id ?>">
                                            <label for="validationDefault02">Subject Area</label>
                                            <div class="select">
                                                <select name="subject" id="subject" required>

                                                    <option value="<?php echo $results->subject ?>">
                                                        <?php echo $results->subject ?></option>
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
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationDefault01">Title</label>
                                            <textarea name="title" class="form-control" id="" cols="30" rows="10"
                                                required><?php echo $results->title ?></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationDefault01">Academic level</label>
                                            <div class="select">
                                                <select name="academic_level" id="academic_level" required>

                                                    <option value="<?php echo $results->academic_level ?>">
                                                        <?php echo $results->academic_level; ?></option>

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

                                                    <option value="<?php echo $results->style ?>">
                                                        <?php echo $results->style ?>
                                                    </option>

                                                    <option value="APA">APA</option>
                                                    <option value="Chicago">Chicago</option>
                                                    <option value="Harvard">Harvard</option>
                                                    <option value="IEEE">IEEE</option>
                                                    <option value="MLA">MLA</option>
                                                    <option value="Oscola">Oscola</option>
                                                    <option value="Other (not listed)">Other (not listed)</option>
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
                                            <label for="pages">Number of Pages</label><br>
                                            <input type="number" name="pages" max="1000" id="pages" min="1"
                                                class="form-control" value="<?php echo $results->pages ?>" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="sources">Number of Sources</label>
                                            <input type="number" name="sources" id="sources" max="1000" min="1"
                                                class="form-control" value="<?php echo $results->sources ?>" />
                                            <input type="hidden" name="reg">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="instructions">Instructions</label>
                                            <textarea name="instructions" id="instructions" class="form-control"
                                                cols="30" rows="10" placeholder="instructions" required>
                                                     <?php echo $results->instructions ?>
                                                    </textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6 mb-3">
                                            <label for="budget">Budget</label>
                                            <div class="select">
                                                <select name="budget" class="" id="budget" required="">

                                                    <option value="<?php echo $results->budget ?>">
                                                        <?php echo $results->budget ?>
                                                    </option>

                                                    <option value=""> Select one </option>
                                                    <option value="$45">$45 (up to 3 pages) </option>
                                                    <option value="$150">$150 (up to 10 pages)</option>
                                                    <option value="$280">$280(up to 20 pages)</option>
                                                    <option value="$480 ">$480 (up to 35 pages)</option>
                                                    <option value="$750">$600 (more than 45 pages)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>

                                    </div>
                                    <input type="submit" class="submit" name="edit" value="Submit Your Order" />
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