<?php require_once "../inc/sessios.php";
session_admin();
?>
                <section class="admin_left_nav">
                 
                    <nav class="navbar navbar-expand-sm">
                       <div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <i class="fas fa-bars"></i>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link <?php if ($page=="dashboard") { ?> active <?php } ?>" href="index">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if ($mainpage=="student") { ?>
          active
          <?php } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Students
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php if ($sub_page=="student_activate") { ?>
          active
          <?php } ?> " href="stud_activate">Activate</a>
          <a class="dropdown-item <?php if ($sub_page=="student_suspend") { ?>
          active
          <?php } ?>" href="student_suspend">Suspend</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item <?php if ($sub_page=="student_message") { ?>
          active
          <?php } ?>" href="stud_message">Message</a>
        </div>
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if ($mainpage=="tutor") { ?>
          active
          <?php } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tutors
        </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item <?php if ($sub_page=="tutor_activate") { ?>
          active
          <?php } ?> " href="tut_activate">Activate</a>
          <a class="dropdown-item <?php if ($sub_page=="tutor_suspend") { ?>
          active
          <?php } ?>" href="tutor_suspend">Suspend</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item <?php if ($sub_page=="tutor_message") { ?>
          active
          <?php } ?>" href="tut_message">Message</a>
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if ($mainpage=="projects") { ?>
          active
          <?php } ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Projects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item <?php if ($sub_page=="clean_up") { ?>
          active
          <?php } ?>" href="manage_order">Clean-Up</a>
        </div>
      </li>
    </ul>
   
  </div>
  </div>
</nav>
</section>