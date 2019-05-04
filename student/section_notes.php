<?php 
function events($student_id){
      global $db;
      $query="SELECT * FROM notifications where user_id='$student_id' ORDER BY note_num desc LIMIT 5";
      $results=$db->get_results($query);
      if ($db->num_rows>0) { ?>
        <?php foreach ($results as $result): ?>
          <div class="alert alert-secondary" role="alert">
          <?php echo $result->note; ?>
          </div>
        <?php endforeach; ?>
        <div class="card-footer"><a href="notes" class="btn btn-submit btn-block">VIEW ALL</a></div>
    <?php  }else { ?>
          <div class="headingTertiary">No Activities</div>
        <?php  }

    }
 ?>
             <div class="col-sm-12 col-md-12 col-lg-12  col-xl-4">
                <h1 class="headingTertiary">Activities</h1>
               
                  <div class="card">
            <div class="card-header">Recent events</div><!--card header-->
            <div class="card-body" id="cbody">
                <?php events($_SESSION['user_id']) ?>
            </div><!--card body-->
            
            </div><!--card-->
            </div>