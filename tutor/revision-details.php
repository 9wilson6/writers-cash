    <?php
    require_once "../inc/header_links.php";
    require_once"../inc/utilities.php";
    #//////////////////////////////////////////////////////////////////////////////////// -->
    require_once("tutor_functions.php");
    require_once("../dbconfig/dbconnect.php");

    if (isset($_POST['submit'])) {
    $result_type=$_POST['result_type'];
    $project_id=$_POST['project_id'];
    $student_id=$_POST['student_id'];
    $tutor_id=$_SESSION['user_id'];
    resultsUpload($student_id, $project_id, $result_type);

    if ($result_type=="final") {
    $query="INSERT INTO delivered(project_id, student_id, tutor_id)VALUES('$project_id', '$student_id', '$tutor_id')";
    if ($db->query($query)) {
    $query="DELETE FROM revisions WHERE project_id='$project_id'";
    if ($db->query($query)) {
    $query="UPDATE projects SET status=2 WHERE project_id='$project_id'";
    if ($db->query($query)) {
    $query="UPDATE chats SET status=1 WHERE project_id='$project_id'";
    $db->query($query);
    //,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
    //
    //
    //
    //,,,,,,,,,,,,,,,,,,,,,,,,,, //
    $note="Tutor ID: ". $tutor_id." has submited final revision results for project ID: ".$project_id." at ".$date_global;
    $note2="You have submited final revision results for project ID: ".$project_id." at ".$date_global;
    $querys="INSERT INTO notifications(user_type, note) VALUES(2,'$note')";
    $db->query($querys);
    $querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2', '$tutor_id')";
    $db->query($querys);
    // ........,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,
    //
    //
    // ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,//
    ?>
    <script>
    alert("Assignment Results Uploaded Successfully");
    window.location.assign("delivered");
    </script>
    <?php
    }
    }
    }

    }else{

    //,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
    //
    //
    //
    //,,,,,,,,,,,,,,,,,,,,,,,,,, //
    $note="Tutor ID: ". $tutor_id." has submited draft revision results for project ID: ".$project_id." at ".$date_global;
    $note2="You have submited draft revision results for project ID: ".$project_id." at ".$date_global;
    $querys="INSERT INTO notifications(user_type, note) VALUES(2,'$note')";
    $db->query($querys);
    $querys="INSERT INTO notifications(user_type, note, user_id) VALUES(3,'$note2','$tutor_id')";
    $db->query($querys);
    // ........,,,,,,,,,,,,,,,,,,,,,,,,,,notification,,,,,,,,,,,,,,,,,
    //
    //
    // ,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,//
    ?>

    <script>
    window.location.assign("#files");
    </script>

    <?php }
    }

    # //////////////////////////////////////////////////////////////////////////////////// -->
    $tutor_id=$_SESSION['user_id'];
    if (isset($_REQUEST['pid'])) {
    $project_id=convert_uudecode($_REQUEST['pid']);

    }else{
    header("location:dashboard");
    }

    $page="revision" ;
    require_once "../components/top_nav.php";
    ?>
    <div class="page-container">
    <?php require_once "../components/tutor_leftnav.php";
    require_once("../dbconfig/dbconnect.php");
    ?>
    <div class="display">
    <div class="display__content">

    <div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
    <h1 class="headingTertiary">Project # <?php echo $project_id. " Details"; ?></h1>
    <div class="card">
    <div class="card-header">Details</div>
    <?php  $query=("SELECT * FROM revisions left join projects on revisions.project_id=projects.project_id WHERE revisions.project_id='$project_id'");
    $results=$db->get_row($query);
    if ($db->num_rows<1) {?>

    <div class="card-body">
    <div class="headingTertiary">
    This project Is no longer Available
    </div>
    </div>
    </div>
    </div>
    <?php  }else{ ?>
    <table class="table table-sm table-responsive{-sm|-md|-lg|-xl}">
    <thead class="table-light">
    <tr>
    <th class="text-center">Style</th>
    <th class="text-center">Deadline</th>
    <th class="text-center">Price($)</th>
    <th class="text-center">Status</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <th scope="row" class="text-center mt-5">

    <?php echo $results->style; ?>
    </th>
    <td class="text-center mt-5">
    <?php $time=getDateTimeDiff($date_global, $results->revision_deadline );
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
    <?php echo $results->charges; ?>

    </td>
    <td class="text-center">
    Assigned

    </td>
    </tr>

    </tbody>
    </table>
    </div>

    <div class="card mb-5">
    <div class="card-header">Order Info</div>
    <div class="card-body d_table_1__c ">
    <ul class="d_table_1 d_table_1__b mb-5 mt-3">

    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <table class="table table-sm table-responsive{-sm|-md|-lg|-xl}">

    <tbody>
    <tr>
    <th class="">Status</th>
    <td class="">
    On Revision
    </td>
    <th>Subject</th>
    <td><?php echo $results->subject; ?>
    </td>
    </tr>
    <tr>

    <th class="">Pages</th>
    <td class=""><?php echo $results->pages; ?></td>
    <th class="">Acadamic level</th>
    <td class=""><?php echo $results->academic_level; ?></td>
    </tr>





    <tr>
    <th class="">Sources</th>
    <td class="">
    <?php  $sources=$results->sources;
    if ($sources==0) {
    echo "At least 1";
    }else{
    echo "{$sources}";
    }
    ?>
    </td>
    <th class="">Type of paper</th>
    <td class=""><?php echo $results->type_of_paper; ?>
    </tr>

    <tr>
    <th>Topic</th>
    <td colspan="3"><?php echo $results->title; ?>
    </td>
    </tr>
    <tr>
    <th>Instructions</th>
    <td colspan="3"><?php echo $results->instructions; ?>
    </td>
    </tr>
    <tr class="bg-dark text-warning">
    <td>Revision Instructions</td>
    <td colspan="3">
    <div class="pl-5 bg-dark text-warning">
    <?php echo $results->revision_instructions; ?></div>
    </td>
    </tr>
    </tbody>

    </table>
    </ul>
    <div class="instrcution text-left">
    <div class="row">
    <div class="col-sm-12 col-md-6 col lg-6">
    <div class="card">
    <div class="card-header">Files</div>
    <div class="card-body files" id="files">
    <h3>Project Files</h3>
    <p class="assign">
    <?php filesDownload($results->student_id,$results->project_id) ?>
    </p>
    <hr>
    <h3>Results Files</h3>
    <hr>
    <p class="results">
    <?php resultsDownload($results->student_id,$results->project_id) ?>
    </p>


    </div>
    </div>

    </div>
    <div class="col-sm-12 col-md-6 col lg-6">
    <div class="card">
    <div class="card-header">Messages</div>
    <div class="card-body messages">
    <script>
    let project_id = "<?php echo $results->project_id; ?>";
    // let user_type = "<?php #echo $_SESSION['user_type'] ?>";
    </script>
    <div class="messages__view " id="messageBox">


    </div>

    <form action="../chat" method="POST" id="chat_form">
    <p class="messages__form">
    <textarea name="message" placeholder="type a message here......."
    required></textarea>

    </p>
    <input type="hidden" name="project_id"
    value="<?php echo $results->project_id ?>">
    <input type="hidden" name="user_type"
    value="<?php echo $_SESSION['user_type'] ?>">
    <input type="hidden" name="student_id"
    value="<?php echo $results->student_id ?>">
    <input type="hidden" name="tutor_id"
    value="<?php echo $results->tutor_id ?>">
    <p class="send">
    <input type="submit" value="Send" name="submit" class="send_btn">
    </p>
    </form>

    </div>
    </div>
    </div>
    </div>


    <div class="card">
    <div class="card-header">Upload files</div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="POST"
    class="files_edit customSelect py-2">
    <div class="my_container">
    <div class="row">
    <div class="col-3 col-sm-3 col-md-3 pb-5">

    <div class="select">
    <select name="result_type" class="custom-select" id="select"
    required>
    <option value="final">final</option>
    <option value="draft">draft</option>

    </select>
    </div>
    </div>
    <div class="col-6 col-sm-6 col-md-6 pb-5">
    <label for="cert_" class="input-label">
    <i class="fa fa-upload"></i>
    <span id="cert">0 Selected</span>
    </label><input type="file" name="file[]" class="id_card" id="cert_"
    multiple />
    <input type="hidden" name="project_id"
    value="<?php echo $project_id ?>">
    <input type="hidden" name="student_id"
    value="<?php echo $results->student_id ?>">
    </div>
    <div class="col-3 col-sm-3 col-md-3 pb-5"><button type="submit"
    name="submit" class="btn btn-submit btn-block move-up">Upload
    Results</button>

    </div>
    </div>
    </div>
    </form>
    </div>
    </div>


    </div>
    </div>
    <div class="card-footer">

    </div>
    </div>
    </div>
    <?php } ?>
    <?php require_once("./section_rate.php"); ?>

    </div>
    </div>
    </div>
    </div>

    <?php
    require_once"../inc/footer_links.php";
    ?>
    <?php require_once("../support.php") ?>
    <script src="../js/chat.js"></script>
    <script src="../js/files.js"></script>
