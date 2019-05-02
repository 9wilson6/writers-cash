<?php
ob_start();
require_once "../inc/header_links.php";
require_once "../dbconfig/dbconnect.php";
$user_id=$_SESSION['user_id'];
$query="SELECT files FROM users WHERE user_id='$user_id'";
$error=null;
$success=null;
$resultx=$db->get_var($query);
if (isset($_POST['submit'])) {
  $name =basename($_FILES['id_card']['name']);
  $tmp_name=$_FILES['id_card']['tmp_name'];
  $name2 =basename($_FILES['academic_document']['name']);
  $tmp_name2=$_FILES['academic_document']['tmp_name'];
  $tutor_id=$user_id;
  if (!file_exists('../DOCS/'.$tutor_id)) {
    mkdir("../DOCS/{$tutor_id}", 0777, true);
    $dir="../DOCS/{$tutor_id}";
    $dir_="../DOCS/{$tutor_id}/";
  }else{
    $dir="../DOCS/{$tutor_id}";
    $dir_="../DOCS/{$tutor_id}/";
  }
  if ( move_uploaded_file($tmp_name, $dir."/".$name)) {
    if ( move_uploaded_file($tmp_name2, $dir."/".$name2)) {
      $success= "Files were successfully uploaded.\n";
      $db->query("UPDATE users set files = 1 where user_id ='$user_id'");
    }
    else {
      $error= "Unable to upload degree file kindly try again later\n";
    }
  }
  else {
    $error = "Unable to upload your id file kindly try again later\n";
  }

}

?>

<div class="not_active">
  <div class="not_active__content">
    <h2 class="headingSeconadry">
      Welcome
      <?php echo $_SESSION['username'] ?> :)
    </h2>
    <div style="text-align: center">
      <?php if (!$success==null): ?>
        <?php echo $success; 
        header( "refresh:5;url=not_active" );
        ob_flush();
        ?>

        <?php elseif(!$error==null): ?>
          <?php echo $error; ?>
        <?php endif ?>


        <?php if ($resultx==1): ?>

        </div>

        <p class="lead">
         We are processing your request.... :)
        </p>


        <?php elseif($resultx==0): ?>
         <p class="lead">
          kindly upload the following documents in order to continue with the
          registration process.
        </p>
        <div class="note">
          <Strong>Note:</Strong>
          <span class="lead"
          >Every detail in the photos supplied below should be clearly
          visible.</span
          >
        </div>
        <div class="form-div">
          <form action="" method="post" enctype="multipart/form-data">
            <label for="myid" class="input-label">
              <i class="fa fa-upload"></i>
              <span id="id">Photo of you holding you national id card</span>
            </label>
            <input type="file" name="id_card" id="myid" class="id_card" />
            <br />
            <label for="cert_" class="input-label">
              <i class="fa fa-upload"></i>
              <span id="cert"
              >Highest verifiable academic acheivement documents</span
              >
            </label>
            <input type="file" name="academic_document" class="id_card" id="cert_" />

            <input type="submit" name="submit" value="UPLOAD" class="btn" />
          </form>
        </div>

      <?php endif ?>

    </div>
  </div>

  <?php require_once("../inc/footer_links.php") ?>
  <script>
    $(document).ready(function() {
      $("#myid").on("change", function(e) {
        var files = $(this)[0].files;
      //   if (files.length >= 2) {
      //     $("#id_card").text(files.length + " Files ready to upload");
      //   } else {
      //     let filename = e.target.value.split("\\").pop();
      //     $("#id_card").text(filename);
      //   }

      if (files.length == 1) {
        let filename = e.target.value.split("\\").pop();
        $("#id").text(filename);
      }
    });

      $("#cert_").on("change", function(e) {
        var files = $(this)[0].files;
        if (files.length == 1) {
          let filename = e.target.value.split("\\").pop();
          $("#cert").text(filename);
        }
      });
    });
  </script>
