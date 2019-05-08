<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
$mainpage="projects";
$sub_page="clean_up";
$date_global_=strtotime($date_global);
$query="SELECT * FROM projects WHERE deadline < {$date_global_} AND status=0";
$results=$db->get_results($query);
if (isset($_POST['delete'])) {
$project_id=$_POST['project_id'];
$student_id=$_POST['student_id'];

deleteFiles($student_id,$project_id);

$query="DELETE FROM projects WHERE project_id='$project_id' and student_id='$student_id'";
if ( $db->query($query)) { ?>
<script>window.location.assign("manage_order")</script>
<?php }
}
?>
<div class="page-container">
  <?php require_once "inc/leftnav.php" ?>
  <div class="display">
    <div class="display__content">
      <h1 class="headingTertiary  text-uppercase">
        CLEAN UP TIMED OUT AND UNASSIGNED ORDERS
      </h1>
      <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-11">
          <div class="card">
            <div class="card-header">The following orders have run out of time and have not been assigned to any tutor
              so far</div>
            <div class="card-body">
              <?php if ($db->num_rows<1): ?>
              <div class="headingTertiary">There is Nothing To show Yet</div>
              <?php elseif($db->num_rows>0): ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Project id</th>
                    <th>Student Id</th>
                    <th class="wide">Title</th>


                    <th class="medium">Deadline</th>
                    <th class="smalll">Action</th>
                  </tr>
                </thead>

                <tbody id="display">
                  <?php foreach ($results as $result): ?>
                  <tr>
                    <td class="smalll"><a
                        href="available-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)); ?>"><?php echo $result->project_id; ?><i
                          class="fas fa-external-link-alt icon-r ml-4"></i></a></td>
                    <td><?php echo $result->student_id ?></td>
                    <td class="wide">
                      <?php echo (strlen($result->title) >35 )? substr($result->title, 0, 35).'...':$result->title; ?>
                    </td>


                    <td class="text-center mt-5 text-danger">
                      <?php $time=getDateTimeDiff($date_global, $result->deadline );
                  echo $time;
                  ?>
                    </td>

                    <td class="smalll">
                      <form action="" method="POST">
                        <input type="hidden" name="project_id" value="<?php echo $result->project_id ?>">
                        <input type="hidden" name="student_id" value="<?php echo $result->student_id ?>">
                        <input type="submit" value="DELETE!!!" name="delete"
                          style="background: #e74c3c; color:honeydew;" class="btn btn-submit btn-block move-up">
                      </form>
                    </td>

                  </tr>
                  <?php endforeach ?>

                </tbody>

              </table>
              <?php endif ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
<?php require_once("../inc/footer_links.php") ?>