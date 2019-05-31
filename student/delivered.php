        <?php 
        require_once "../inc/header_links.php";
        $page="delivered";
        require_once "../components/top_nav.php";
        require_once("../inc/utilities.php");

        require_once "../inc/header_links.php";
        require_once("../dbconfig/dbconnect.php");
        $query="SELECT * FROM delivered LEFT JOIN projects ON delivered.project_id=projects.project_id WHERE delivered.student_id=".$_SESSION['user_id'];
        $results=$db->get_results($query);
        ?>
        <div class="page-container">
        <?php require_once "../components/stud_leftnav.php" ?>
        <div class="display">
        <div class="display__content">

        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
        <h1 class="headingTertiary">RESULTS</h1>
        <div class="card"> 
        <div class="card-header">Assignments pending your approval</div>
        <div class="card-body">
        <?php if ($db->num_rows<1) { ?>

        <div class="headingTertiary">There is nothing to show yet</div>
        </div>

        <?php }else{?>
                <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
        <th>Order id</th>
        <th >Topic</th>
        <th >Tutor Id</th>
        <th >Deadline</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result): ?>
        <tr>
        <?php #$name=base64_encode("wilson")  ?>
        <?php #$name=convert_uuencode("wilson") ?>
        <td width="100px"><a href="delivered-details?pid=<?php echo urlencode(convert_uuencode($result->project_id)) ?>"><?php echo $result->project_id."<i class='fas fa-external-link-alt icon-r ml-4'></i>"; ?></a></td>
        <td><?php echo $result->title; ?></td>
        <td><?php echo $result->tutor_id; ?></td>
        <td>
        <?php $time=getDateTimeDiff($date_global, $result->deadline );
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

        <?php endforeach ?>
        </tbody>
        </table>
        </div>
        </div>
        <?php } ?>
        </div>

        </div>
        <?php require_once("section_notes.php") ?>
        </div>  
        </div>
        </div>
        </div>
        <?php
        require_once"../inc/footer_links.php";
        ?>
        <?php require_once("../support.php") ?>