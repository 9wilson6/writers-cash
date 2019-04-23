<?php require_once "../inc/sessios.php";
session_student();
 ?>
<section class="dashboard_nav_left">
	<div class="dashboard_nav_left__content">
<ul class="">
  <!-- <a href=""><li class="list-group-item"><i class="fas fa-tachometer-alt icon-r"></i>Dashboard</li></a> -->
  <a href="../student/createpost"  <?php if ($page=="create") { ?>
  	class="active"
  <?php } ?>><li class="list-group-item">Post Homework</li></a>
  <a href="../student/my-homework" <?php if ($page=="my-homework") { ?>
   class="active"
 <?php } ?>><li class="list-group-item">Homework<span class="  " id="available">0</span></li></a>
   <a href="../student/in-progress" <?php if ($page=="progress") { ?>
   	class="active"
  <?php } ?>><li class="list-group-item">Active<span class=" " id="in_progress">0</span></li></a>
  <a href="../student/delivered" <?php if ($page=="delivered") { ?>
  	class="active"
 <?php } ?>><li class="list-group-item">Delivered<span class=" " id="delivered">0</span></li></a>
 <a href="editing" <?php if ($page=="revision") { ?>
    class="active"
  <?php } ?>><li class="list-group-item"></i>Revision <span class=" " id="on_revision">0</span></li></a>
   <a href="../student/completed" <?php if ($page=="completed") { ?>
   class="active"
  <?php } ?>><li class="list-group-item">Closed<span class=" " id="closed">0</span></li></a>
    <a href="../student/messages" <?php if ($page=="messages") { ?>
    	class="active"
   <?php } ?>><li class="list-group-item">Messages<span class="  " id="messages">0</span></li></a>

  <a href="../logout"> <li class="list-group-item">Logout</li></a>
</ul>
	</div>
</section>
<?php #require_once("../inc/footer_links.php") ?>
<!-- Left navigation bar -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>

  $(function(){

   setInterval(function() {

       let user_id= "<?php echo $_SESSION['user_id']; ?>";
      let user_type="<?php echo $_SESSION['user_type']; ?>";

        $("#messages").load("../inc/counters", {
            target: "messages",
            user_id: user_id,
            user_type: user_type

        });
        $("#available").load("../inc/counters",{
        target: "available",
        user_id: user_id,
        user_type: user_type
      });
         $("#delivered").load("../inc/counters", {
            target: "delivered",
            user_id: user_id,
            user_type: user_type

        });

         $("#in_progress").load("../inc/counters",
      {
             target: "in_progress",
            user_id: user_id,
            user_type: user_type
      });

         $("#on_revision").load("../inc/counters",
      {
             target: "on_revision",
            user_id: user_id,
            user_type: user_type
      });
          $("#closed").load("../inc/counters",
      {
             target: "closed",
            user_id: user_id,
            user_type: user_type
      });
    }, 300);



     });
</script>
