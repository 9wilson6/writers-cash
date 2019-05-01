<?php 
require_once "../inc/header_links.php";
require_once"../inc/utilities.php";
require_once("./inc/topnav.php");
#//////////////////////////////////////////////////////////////////////////////////// -->
require_once("../dbconfig/dbconnect.php");
if (isset($_REQUEST['pid'])) {
$project_id=convert_uudecode($_REQUEST['pid']);
}
$page="" ;
$mainpage="orders";
?>
<div class="page-container">
    <?php require_once "inc/leftnav.php" ?>
    <div class="display">
        <div class="display__content">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-11">
                    <h1 class="headingTertiary">Project # <?php echo $project_id. " Details"; ?></h1>
                    <div class="card">
                        <div class="card-header">Order info</div>
                        <?php  $query=("SELECT * FROM projects WHERE project_id='$project_id' and status=0");
$results=$db->get_row($query);
if ($db->num_rows<1) {?>
                        <div class="card-body">
                            <div class="headingTertiary">
                                This project Is no longer Available
                            </div>
                        </div>
                    </div>
                    <?php  }else{ ?>
                    <table class="table table-sm table-responsive{-sm|-md|-lg|-xl}">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Order Id</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Budget</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center mt-5">
                                    <?php echo $results->project_id ; ?>
                                </th>
                                <td class="text-center mt-5">
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
                                    <?php endif ?>
                                </td>
                                <td class="text-center mt-5">
                                    <?php echo $results->budget; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card bg-light mb-5">
                    <div class="card-header">Order Details</div>
                    <div class="card-body d_table_1__c ">
                        <div class="instrcution text-left">
                            <table class="table table-sm table-responsive{-sm|-md|-lg|-xl} text-centerxt">
                                <tr>
                                    <th> Paper Format </th>
                                    <td> <?php  echo $results->style; ?> </td>
                                    <th> Status </th>
                                    <td>
                                        <?php $Status=$results->status;
if ($Status==0) {
echo "Available";
}else{
"Not Available";
}
?>
                                </tr>
                                <tr>
                                    <th> type of paper </th>
                                    <td> <?php echo $results->type_of_paper; ?> </td>
                                    <th> Sources </th>
                                    <td> <?php  $sources=$results->sources;
if ($sources==0) {
echo "At least 1";
}else{
echo "{$sources}";
}
?> </td>
                                </tr>
                                <tr>
                                    <th> Subject</th>
                                    <td> <?php   echo $results->subject; ?></td>
                                    <th> Pages</th>
                                    <td> <?php   echo $results->pages; ?></td>
                                </tr>
                                <tr>
                                    <th> Topic</th>
                                    <td colspan="3"> <?php  echo $results->title; ?> </td>
                                </tr>
                                <tr>
                                    <th> Instructions</th>
                                    <td colspan="3"> <?php  echo $results->instructions; ?> </td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col lg-5">
                                    <div class="card">
                                        <div class="card-header"><strong>Files:</strong></div>
                                        <div class="card-body files">
                                            <p><?php filesDownload($results->student_id,$results->project_id) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7 col lg-7">
                                    <div class="card">
                                        <div class="card-header"><strong>Messages:</strong></div>
                                        <div class="card-body messages">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
<?php
require_once"../inc/footer_links.php";
?>