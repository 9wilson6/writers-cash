    <?php
    require_once "../inc/header_links.php";
    $page="classes";
    require_once "../components/top_nav.php";
    require_once("../inc/utilities.php");

    require_once "../inc/header_links.php";
    require_once("../dbconfig/dbconnect.php");
    $user_id= $_SESSION['user_id'];

    $query="SELECT * FROM on_progress LEFT JOIN classes ON on_progress.project_id=classes.project_id WHERE on_progress.student_id='$user_id'";

    $results=$db->get_results($query);
    ?>
    <div class="page-container">
    <?php require_once "../components/stud_leftnav.php" ?>
    <div class="display">
    <div class="display__content">

    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
    <h1 class="headingTertiary">In Progress</h1>
    <div class="card">
    <div class="card-header">Order Info</div>
    <?php if ($db->num_rows<1) { ?>
    <div class="headingTertiary">There is nothing to show Yet</div>
    <?php }else{?>


    <div class="card-body">
    <table class="table table-bordered">
    <thead>
    <tr>
    <th>Class id</th>
    <th class="wide">Subject</th>
    <th class="smalll">Tutor Id</th>
    <th class="medium">Cost</th>
    <th  width="50%" >description</th>
    <th>Date closed</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <?php foreach ($results  as $result): ?>


    <td class="smalll"><?php echo $result->project_id; ?>
    </td>
    <td><?php echo $result->subject; ?></td>
    <td><?php echo $result->tutor_id; ?></td>
    <td><?php echo "$". $result->cost; ?></td>
    <td><?php echo $result->instructions; ?></td>
    <td>
       <div class="alert alert-warning" role="alert">
           Active
       </div>
    </td>
    </tr>
    <?php endforeach ?>
 
    </tbody>
    </table>
    </div>
            <?php }  ?>
    </div>
    <div class="card-footer"><a href="closed_classes" class="submit" name="submit_class" style="color: #fff; text-align: center; font-weight: bolder; padding-top: 5px; font-size: 16px" />Closed Classes</a></div>
    </div>

    <?php require_once("section_notes.php") ?>

    </div>
    </div>
    </div>
    
    <?php
    require_once"../inc/footer_links.php";

    ?>
    <?php require_once("../support.php") ?>