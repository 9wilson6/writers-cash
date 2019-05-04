<?php
require_once("../inc/header_links.php");
require_once("./inc/topnav.php");
require_once("../inc/utilities.php");
$mainpage="orders";
$page="";
require_once("../inc/global_functions.php");
require_once("../dbconfig/dbconnect.php");
$query="SELECT * FROM projects WHERE status=4";
$results=$db->get_results($query);
?>
<div class="page-container">
    <?php require_once "inc/leftnav.php" ?>
    <div class="display">
        <div class="display__content" >
            <div class="row" >
              <?php if (!isset($_REQUEST['user_id'])) {
              $user_id=0;
              }else{
                $user_id= $_REQUEST['user_id'];
              } ?>
            	
             <?php if (isset($_REQUEST['user_id'])) { ?>
             	             	<script>
             	             	 let user_id = <?php echo $_REQUEST['user_id']; ?>
             	             	 	
             	             	 </script>
            <?php }else{ ?>

            	<script>
             	             	 user_id =0;
             	             	 	
             	             	 </script>
          <?php  } ?>
               	
               	<div class="message_panel" >
               		
               			<div class="message_panel_left"><ul class="list-group">
             <div class="highlight">
                   <?php 
                    $query="SELECT DISTINCT user_id FROM support WHERE status=0 and sender!=3 ORDER BY rec_num asc";
                      $results=$db->get_results($query); ?>
                  <?php if ($db->num_rows>0): ?>
                    
                      <?php foreach ($results as $result) {
                        $query="SELECT count(message) FROM support where user_id=$result->user_id AND status=0 AND sender !=3" ;
                        $queryx="SELECT * FROM users WHERE user_id=$result->user_id";
                        $resultx=$db->get_row($queryx);
                        $result2=$db->get_var($query);

                       ?>
                      <form action="" method="GET" id="prevew_message">

                       <?php  $type=""; if ($resultx->type==1){ $type="Student ID";}elseif($resultx->type==2){ $type="Tutor ID";} ?>
                       <!-- <li class="list-group-item">User Id <?php #echo $result->sender."   ". "(".$result2.")"; ?></li>  -->
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $result->user_id ?>">
                        <?php if ($result->user_id==$user_id): ?>
                          <button type="submit" class="chat_btn active"><?php echo $resultx->username." ".$type." ". $result->user_id."   ". "(".$result2.")"; ?></button>
                        <?php else: ?>
                         <button type="submit" class="chat_btn"><?php echo $resultx->username." ".$type." ". $result->user_id."   ". "(".$result2.")"; ?></button>
                        <?php endif ?>

                      </form>
                      <?php }
                     ?>
                     
                  <?php else: ?>
                   <li class="list-group-item">No new messages</li>
                  <?php endif ?>  
                    </div>
                  <div class="older">
                    <a href="old_messages" class="list-group-item">OLDER</a>
                  </div>
               		</div>

                </ul>
               	
               		<div class="message_panel_right">
               			
               			<div class="showmessage"><?php require_once("right_panel.php") ?></div>
               		<div class="chat">
               				<form action="" method="post" id="sendMessage">
               				<textarea id="my_message" placeholder="type your message here....."></textarea>
               				<input type="submit" name="" class="send_btn" value="SEND">
               				</form>
               			</div>
               		</div>
               	</div>
              
              
            </div>
        </div>
    </div>
</div>
<?php require_once("../inc/footer_links.php") ?>

<script>
$('.showmessage').stop().animate({ scrollTop: $('.showmessage')[0].scrollHeight});
	if (user_id>0) {
	setInterval(function(){
			
$(".showmessage").load("right_panel",
	{user_id: user_id }
               	)}, 100);
}	
</script>

	<script> 	
               	$("#sendMessage").submit(function(e){

               		let my_message=$("#my_message").val();

               		e.preventDefault();

               	if (user_id>0) {

               		$.post("post_message", {
               			submit:"submit",
               			my_message: my_message,
               			 user_id: user_id
               		}, 	function(data, status){
              		$('.showmessage').stop().animate({ scrollTop: $('.showmessage')[0].scrollHeight});
				 $("#my_message").val("");
				 		}

				);
               }else{
               	alert("No recipient was found");
               }	});

  </script>

				 