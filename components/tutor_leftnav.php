<?php require_once"../inc/sessios.php";
require_once("./check_active.php");
require_once "../inc/sessios.php";
session_tutor(); ?>
<!-- Left navigation bar -->
<section class="dashboard_nav_left">
	<div class="dashboard_nav_left__content">
    <ul class="">

      <a href="dashboard"  <?php if ($page=="dashboard") { ?>
        class="active"
        <?php } ?>><li class="list-group-item">Available <span class=" " id="available">0</span></li></a>

        <a href="in-progress"  <?php if ($page=="progress") { ?>
         class="active"
         <?php } ?>><li class="list-group-item">In Progress <span class=" " id="in_progress">0</span></li></a>


         <a href="delivered"  <?php if ($page=="delivered") { ?>
          class="active"
          <?php } ?>><li class="list-group-item">Delivered <span class="" id="delivered">0</span></li></a>

          <a href="revision" <?php if ($page=="revision") { ?>
           class="active"
           <?php } ?>><li class="list-group-item">On Revision <span class="" id="on_revision">0</span></li></a>


           <a href="my-projects"  <?php if ($page=="projects") { ?>
             class="active"
             <?php } ?>><li class="list-group-item">Closed <span class="" id="closed">0</span></li></a>




             <a href="messages"  <?php if ($page=="messages") { ?>
               class="active"
               <?php } ?>><li class="list-group-item">messages <span class="" id="messages">0</span></li></a>

  <!-- <a href="announcements"  <?php #if ($page=="announcements") { ?>
  	class="active"
    <?php# } ?>><li class="list-group-item"><i class="fas fa-bullhorn icon-r"></i>Announcements <span class="pill float-right">900</span></li></a> -->


    <a href="feedback"   <?php if ($page=="feedback") { ?>
     class="active"
     <?php } ?>><li class="list-group-item">Feedback </li></a>


     <a href="finance"   <?php if ($page=="finance") { ?>
       class="active"
       <?php } ?>><li class="list-group-item">Finacial overview</li></a>

     </ul>
   </div>
 </section>
 <!-- Left navigation bar -->
 <?php #require_once("../inc/footer_links.php") ?>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
 <script>
  $(function(){

   setInterval(function() {

     let user_id= "<?php echo $_SESSION['user_id']; ?>";
     let user_type="<?php echo $_SESSION['user_type']; ?>";
        // alert(user_type);
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
  /////////////////////////Reset messages when messages is checked///////

});
</script>
