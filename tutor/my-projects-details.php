<?php
    require_once "../inc/header_links.php";
    require_once"../inc/utilities.php";
    #//////////////////////////////////////////////////////////////////////////////////// -->

    require_once("../dbconfig/dbconnect.php");

    # //////////////////////////////////////////////////////////////////////////////////// -->
    $tutor_id=$_SESSION['user_id'];
    if (isset($_REQUEST['pid'])) {
    $project_id=convert_uudecode($_REQUEST['pid']);

    }else{
    header("location:dashboard");
    }

    $page="projects" ;
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
                        <?php  $query="SELECT * FROM closed LEFT JOIN projects ON closed.project_id=projects.project_id WHERE closed.project_id='$project_id' ORDER BY closed.project_id desc";
                            $results=$db->get_row($query);
                            if ($db->num_rows<1) { ?>

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
                                <th class="text-center">Level</th>
                                <th class="text-center">Date Closed</th>
                                <th class="text-center">Price($)</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center mt-5">
                                    <?php echo $results->academic_level ; ?>
                                </th>
                                <td class="text-center mt-5">
                                    <?php echo $results->date_closed ?>
                                </td>
                                <td class="text-center mt-5">
                                    <?php echo $results->charges; ?>

                                </td>
                                <td class="text-center">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="card bg-light mb-5">
                    <div class="card-header">Order Info</div>
                    <div class="card-body d_table_1__c ">
                        <ul class="d_table_1 d_table_1__b mb-5 mt-3">



                            <table class="table table-sm table-responsive{-sm|-md|-lg|-xl}">

                                <tr>
                                    <th class="">Status</th>
                                    <td class="">
                                        closed
                                    </td>
                                    <th class="">Paper Format</th>
                                    <td class=""><?php echo $results->style; ?></td>

                                </tr>

                                <tr>
                                    <th class="">Pages</th>
                                    <td class=""><?php echo $results->pages; ?></td>
                                    <th>Subject</th>
                                    <td><?php echo $results->subject; ?></td>
                                </tr>


                                <tr>
                                    <th class="">Type of paper</th>
                                    <td class=""><?php echo $results->type_of_paper; ?></td>
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
                                </tr>
                                <tr>
                                    <th class="">Topic</th>
                                    <td colspan="3"><?php echo $results->title ?></td>
                                </tr>
                                <tr>
                                    <th>Instructions</th>
                                    <td colspan="3"><?php echo $results->instructions ?></td>
                                </tr>



                            </table>
                        </ul>
                        <div class="instrcution text-left">

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col lg-6">
                                    <div class="card">
                                        <div class="card-header">Files</div>
                                        <div class="card-body files">
                                            <p><?php filesDownload($results->student_id,$results->project_id) ?></p>
                                            <p><?php resultsDownload($results->student_id,$results->project_id) ?></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 col-md-6 col lg-6">
                                    <div class="card">
                                        <div class="card-header">Messages</div>
                                        <div class="card-body messages">
                                            <div class="messages__view " id="messageBox">
                                                <script>
                                                    let project_id = "<?php echo $results->project_id; ?>";
                                                    let user_type = "<?php echo $_SESSION['user_type'] ?>";
                                                </script>

                                            </div>

                                            <form action="../chat" method="POST" id="chat_form">
                                                <p class="messages__form">
                                                    <textarea name="message" disabled
                                                        placeholder="Messaging no supported for closed orders......:)"
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
                                                    <input type="submit" value="Send" name="submit" disabled
                                                        class="send_btn">
                                                </p>
                                            </form>

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
            <?php require_once("./section_rate.php"); ?>

        </div>

    </div>
</div>
</div>
<?php
    require_once"../inc/footer_links.php";
    ?>
<script src="../js/chat.js"></script>
<script src="../js/files.js"></script>