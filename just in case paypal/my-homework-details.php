<meta http-equiv="refresh" content="300">
<?php
$project_id=convert_uudecode($_GET['id']);
require_once("../dbconfig/dbconnect.php");
require_once("../inc/utilities.php");
require_once "../inc/header_links.php";
require_once "../components/top_nav.php";
require_once ("../paypal_integration/paypal_config.php");

if (isset($_POST['submit'])) {
	require_once('stud_functions.php');
	filesUpload($_SESSION['user_id'], $_POST['project_id']);
}
$query="SELECT * FROM projects where project_id='$project_id'";
$results=$db->get_row($query);
// print_r($results);

 ?>

<div class="display">
    <div class="display__content">
        <?php $page="my-homework"; ?>
        <?php require_once "../components/stud_leftnav.php" ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                <h1 class="headingTertiary text-light">Homework #
                    <?php echo $project_id ; ?>
                </h1>
                <div class="card">
                    <div class="card-header text-uppercase">details</div>
                    <div class="card-body">
                        <?php

					if ($db->num_rows<1) {
            echo "Order is no longer available";
          } else{?>
                        <div class="table-responsive">
                            <table class="table  table-striped table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Subject</th>
                                        <td>
                                            <?php echo $results->subject ?>
                                        </td>
                                        <th scope="row">Academic Level</th>
                                        <td>
                                            <?php echo $results->academic_level; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Style</th>
                                        <td>
                                            <?php echo $results->style; ?>
                                        </td>
                                        <th scope="row">Type Of Paper</th>
                                        <td>
                                            <?php echo $results->type_of_paper ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pages</th>
                                        <td>
                                            <?php echo $results->subject ?>
                                        </td>
                                        <th scope="row">Slides</th>
                                        <td>
                                            <?php echo $results->slides; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Problems</th>
                                        <td>
                                            <?php echo $results->problems; ?>
                                        </td>
                                        <th scope="row">Sources</th>
                                        <td>
                                            <?php echo $results->sources ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Budget</th>
                                        <td>
                                            <?php echo $results->budget; ?>
                                        </td>
                                        <th scope="row">Deadline</th>
                                        <td>
                                            <?php $time=getDateTimeDiff($date_global, $results->deadline );
                                             $period= explode(" ", $time); ?>
                                            <?php if ($period[1]=="days"): ?>
                                            <span class="text-dark">
                                                <?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="day"): ?>
                                            <span class="text-success">
                                                <?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="hours" || $period[1]=="hour"): ?>
                                            <span class="text-warning">
                                                <?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="mins" || $period[1]=="min"): ?>
                                            <span class="text-danger">
                                                <?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="secs" || $period[1]=="sec"): ?>
                                            <span class="text-danger">
                                                <?php echo "{$time}"; ?></span>
                                            <?php else: ?>
                                            <span class="text-danger">
                                                <?php echo "{$time}"; ?></span>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td colspan="3">
                                            <?php echo $results->title; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Instructions</th>
                                        <td colspan="3" class="pl-5">

                                            <?php echo $results->instructions; ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <?php }

					 ?>
                        <div class="card">
                            <div class="card-header">
                                <h1 class="headingSecondary mb-3">Manage files</h1>
                            </div>
                            <div class="showFiles" id="files">

                                <?php manageFiles($_SESSION['user_id'], $project_id) ?>

                            </div>
                                <p>
                                <form action="" enctype="multipart/form-data" method="POST" class="files_edit">
                                    <div class="my_container">
                                        <div class="row">
                                            <div class="col-3 col-sm-3 col-md-3"><label for="files"
                                                    class="forms2__label">Add More Files
                                                    &rarr;</label></div>
                                            <div class="col-6 col-sm-6 col-md-6"><input type="file"
                                                    class="files_edit__input" name="file[]"
                                                    class="form-control-file forms2__files" id="files" required
                                                    multiple />
                                                <input type="hidden" name="project_id"
                                                    value="<?php echo $project_id ?>">
                                            </div>
                                            <div class="col-3 col-sm-3 col-md-3"><button type="submit" name="submit"
                                                    class="btn btn-submit btn-block">Upload
                                                    Files</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </p>

                        </div>



                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 col-sm-12"><button
                                    class="btn btn-lg btn-block btn-danger text-uppercase"
                                    onclick="deleletconfig()">delete
                                    project</button></div>
                            <div class="col-md-6 col-sm-12"><a href="homework_edit?id=<?php echo urlencode(convert_uuencode($project_id)) ?>"
                                    class="btn btn-lg btn-block btn-info text-uppercase">edit
                                    project</a></div>
                            <script>
                            function deleletconfig() {
                                let del = confirm(
                                    "Are you sure you want to delete project # <?php echo $project_id ?> ?");
                                if (del) {
                                    $.post("delete_project", {
                                            id: "<?php echo $project_id ?>",
                                            user: "<?php echo $_SESSION['user_id'] ?>"
                                        })
                                        .done(function(data) {
                                            alert(data);
                                            window.location.href = "my-homework";
                                        });
                                };
                            }
                            </script>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h1 class="headingSecondary mb-3">Bids</h1>
                        </div>
                        <div class="card-body">

            <div class="table-responsive " id="bids">
                            <?php
                  $query="SELECT * FROM bids WHERE project_id=$project_id";
                  $results=$db->get_results($query);

                  if ($db->num_rows<1) {?>
                            <h1 class="headingSecondary">Nothing To Show Yet</h1>
                            <?php }else{ ?>

                                <table class="table">
                                    <thead>
                                        <th>Tutor Id</th>
                                        <th>Rated</th>
                                        <th>Orders Complited</th>
                                        <th>Bid Amount($)</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody >

                                        <?php foreach ($results as $result) {?>
                                        <tr>
                                            <td>
                                                <?php echo $result->tutor_id ?>
                                            </td>
                                            <?php $query="SELECT * FROM users WHERE user_id='$result->tutor_id'";
										$results=$db->get_row($query);

										 ?>
                                            <td>
                                                <?php echo $results->rating ?>
                                                <?php if ($results->rating==0): ?>
                                                <img class="img-fluid rating" src="../assets/not_rated.PNG" alt="">
                                                <?php elseif($results->rating>0 && $results->rating<=4): ?>
                                                <img class="img-fluid rating" src="../assets/poor.PNG" alt="">
                                                <?php elseif($results->rating>4 && $results->rating<=7): ?>
                                                <img class="img-fluid rating" src="../assets/average.PNG" alt="">
                                                <?php elseif($results->rating>7 && $results->rating<=10): ?>
                                                <img class="img-fluid rating" src="../assets/excelent.PNG" alt="">
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <?php echo $results->orders_complited ?>
                                            </td>
                                            <td>
                                                <?php echo $result->bid_total_amount?>
                                            </td>
                                      <td>
                                          <!-- <form action="assing" method="POST"> -->
		<form action="<?php echo $paypal_url; ?>" method="post">
				<!-- Get paypal email address from core_config.php -->
				<input type="hidden" name="business" value="<?php echo $paypal_seller; ?>">

				<!-- Specify product details -->
				<input type="hidden" name="item_name" value="<?php echo "Project number " . $project_id; ?>">

				<input type="hidden" name="item_number" value="<?php echo $project_id; ?>">
				<input type="hidden" name="amount" value="<?php echo $result->bid_total_amount; ?>">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="handling" value="0">

				<!-- IPN Url -->
				 <!-- <input type='hidden' name='notify_url' value='../paypal_integration/paypal_ipn.php'> -->
				<!-- Return URLs -->
				<input type='hidden' name='cancel_return' value='<?php echo $payment_return_cancel; ?>'>
				<input type='hidden' name='return' value='<?php echo $payment_return_success; ?>'>

				<!-- Submit Button -->
				<input type="hidden" name="cmd" value="_xclick">
			<!-- <input type="hidden" name="project_id" value="<?php #echo $project_id; ?>"> -->
<!-- <input type="hidden" name="user_id" value="<?php #echo $_SESSION['user_id']; ?>"> -->
<!-- <?php #echo $_SESSION['user_id']; die; ?> -->
<!-- <input type="hidden" name="tutor_id" value="<?php #echo $result->tutor_id; ?>"> -->
<!-- <input type="hidden" name="cost" value="<?php #echo $result->bid_total_amount; ?>"> -->
<!-- <input type="hidden" name="charged" value="<?php #echo $result->bid_amount ?>"> -->
                                              <button type="submit" name="assing" class="btn btn-success">Award</button>
                                          </form>
                                      </td>
                                        </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>

                                <?php }

				       ?>
                       </div>
                                <p class="text-center"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                <h1 class="headingTertiary text-light">Notes</h1>
                <div class="card">
                    <div class="card-header text-secondary text-uppercase">
                        Note that
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-borderless text-left">
                            <tbody>
                                <ul>
                                    <tr>

                                        <td>
                                            <li>This service exists to protect your private and personal information,
                                                you shouldn’t therefore communicate with tutors outside the site.</li>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <li>Sharing third party communication methods (including emails, phone
                                                numbers, and Skype address) is against our user guidelines and we shall
                                                therefore NOT be held
                                                liable
                                                failure to observe this. See our T.O.S</li>
                                        </td>
                                    </tr>
                                </ul>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

require_once"../inc/footer_links.php";
 ?>
 <script>
     $(function(){
      setInterval(function(){

            let project_id="<?php echo $project_id; ?>";
            $("#bids").load("bids", {
            project_id: project_id
        });
      }, 30000);
     });
 </script>
