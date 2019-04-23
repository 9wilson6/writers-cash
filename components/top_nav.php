<?php
require_once "../inc/sessios.php";
session_gen();
?>
<section class="dashboard_nav">
  <!-- <label for="check" class="left-toggler"
><i class="fas fa-bars icon-m"></i
></label>
<input type="checkbox" name="check" id="check" class="left-toggler" /> -->
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="../index">Lorem</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle nav-link--excemption" href="#" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome, 
            <?php $name = explode(" ", $_SESSION['username']);
          echo ucfirst($name[0]);
          if (isset($_SESSION['user_id'])) {
              $user_id = $_SESSION['user_id'];
          }
          ?>&nbsp;<i class="far fa-user-circle icon"></i></a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="my-profile?key=<?php echo urlencode(convert_uuencode($user_id)) ?>"><i
                class="lnr lnr-user icon-r"></i>Profile</a>
                <hr>
            <a class="dropdown-item " href="change-pass?key=<?php echo urlencode(convert_uuencode($user_id)) ?>"><i
                class="lnr lnr-cog icon-r"></i>Change Password</a>
                <hr>
            <a class="dropdown-item " href="../logout"><i class="lnr lnr-exit icon-r"></i>Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</section>