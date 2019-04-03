<?php require_once "../inc/header_links.php"?>

<div class="login">
  <div class="not_active">
    <div class="not_active__content">
      <h2 class="headingSeconadry">
        Welcome
        <?php echo $_SESSION['username'] ?>
        :)
      </h2>
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
        <form action="" method="post">
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
          <input type="file" name="id_card" class="id_card" id="cert_" />

          <input type="submit" value="UPLOAD" class="btn" />
        </form>
      </div>
    </div>
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
