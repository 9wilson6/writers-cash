<?php
require_once "../inc/header_links.php";
$page="delivered" ;
require_once "../components/top_nav.php";
require_once("../dbconfig/dbconnect.php");
require_once("../inc/utilities.php");
$query="SELECT * FROM delivered LEFT JOIN projects ON delivered.project_id=projects.project_id WHERE delivered.tutor_id=".$_SESSION['user_id'];
$results=$db->get_results($query)

?>

<div class="page-container">
    <?php require_once "../components/tutor_leftnav.php" ?>
    <div class="display">
        <div class="display__content">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                    <h1 class="headingTertiary">Orders Pending Clients Approval</h1>
                    <div class="card">
                        <div class="card-header">Delivered Orders</div>
                        <div class="card-body">
                            <?php if ($db->num_rows<1) {?>
                            <div class="headingSecondary">Nothing to show Yet</div>
                            <?php }else{ ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order id</th>
                                        <th class="wide">Topic</th>
                                        <th class="smalll">Price($)</th>
                                        <th class="medium">Deadline</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($results as $result): ?>
                                    <tr>

                                        <td class="smalll"><a
                                                href="delivered-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)); ?>"><?php echo $result->project_id; ?><i
                                                    class="fas fa-external-link-alt icon-r ml-4"></i></a></td>
                                        <td><?php echo $result->title; ?></td>
                                        <td><?php echo $result->charges; ?></td>
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
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php require_once("./section_rate.php"); ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once"../inc/footer_links.php";
?>