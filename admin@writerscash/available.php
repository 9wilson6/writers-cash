<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$mainpage="orders";
$page="";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
$query="SELECT * FROM projects where status=0";
$results=$db->get_results($query);

 ?>
<div class="page-container">
    <?php require_once "inc/leftnav.php" ?>
    <div class="display">
        <div class="display__content">

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-11">
                    <h1 class="headingTertiary text-uppercase">Available Orders </h1>

                    <div class="card">
                        <div class="card-header text-uppercase">Available orders</div>
                        <div class="card-body">
                            <?php if ($db->num_rows<1): ?>
                            <h1 class="classHeadingSecondary">There is Nothing To show Yet</h1>
                            <?php elseif($db->num_rows>0): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th class="wide">Title</th>
                                        <th data-toggle="tooltip" title="Price $" data-placement="right">Price</th>
                                        <th data-toggle="tooltip" title="pages" data-placement="right">Pg</th>
                                        <th class="smalll">Subject</th>
                                        <th class="medium">Deadline</th>
                                    </tr>
                                </thead>

                                <tbody id="display">
                                    <?php foreach ($results as $result): ?>
                                    <tr>
                                        <td class="smalll"><a
                                                href="available-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)); ?>"><?php echo $result->project_id; ?><i
                                                    class="fas fa-external-link-alt icon-r ml-4"></i></a></td>
                                        <td class="wide">
                                            <?php echo (strlen($result->title) >35 )? substr($result->title, 0, 35).'...':$result->title; ?>
                                        </td>
                                        <td><?php echo $result->budget; ?></td>
                                        <td><?php echo $result->pages; ?></td>
                                        <td class="smalll"><?php echo $result->subject; ?></td>
                                        <td><?php $time=getDateTimeDiff($date_global, $result->deadline );
                                     $period= explode(" ", $time); ?>
                                            <?php if ($period[1]=="days"): ?>
                                            <span class="text-dark"><?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="day"): ?>
                                            <span class="text-success"><?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="hours" || $period[1]=="hour"): ?>
                                            <span class="text-warning"><?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="mins" || $period[1]=="min"): ?>
                                            <span class="text-danger"><?php echo "{$time}"; ?></span>
                                            <?php elseif($period[1]=="secs" || $period[1]=="sec"): ?>
                                            <span class="text-danger"><?php echo "{$time}"; ?></span>
                                            <?php endif ?>
                                        </td>


                                    </tr>
                                    <?php endforeach ?>

                                </tbody>

                            </table>
                            <?php endif ?>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("../inc/footer_links.php") ?>