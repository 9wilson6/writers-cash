<div class="col-sm-12 col-md-12 col-lg-12  col-xl-4">
  <?php require_once("./sammary_functions.php") ?>
    <h1 class="headingTertiary">My Account</h1>
    <div class="card">
        <div class="card-header">My stats</div>
        <div class="card-body">
            <table class="table  table-bordered table-hover ">
                <tbody>
                    <tr>
                        <td>Account Balance</td>
                        <td><?php echo "$".balance($_SESSION['user_id']); ?></td>

                    </tr>
                    <tr>
                        <td>Account Status</td>
                        <td><?php if (thirty_rating($_SESSION['user_id'])<3) { ?>
                            <span class="alert alert-danger">PROBATION</span>
                      <?php }elseif(thirty_rating($_SESSION['user_id'])>3 and thirty_rating($_SESSION['user_id'])<6){ ?>
                            <span class="alert alert-warning">REGULAR</span>
                      <?php  }else{ ?>
                            <span class="alert alert-success">EXPERT</span>
                      <?php } ?></td>

                    </tr>
                    <tr>
                        <td>Account Rating (30)</td>
                        <td><?php echo thirty_rating($_SESSION['user_id']); ?></td>

                    </tr>
                    <tr>
                        <td>Account Rating</td>
                        <td><?php echo account_rating($_SESSION['user_id']); ?></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
     <div class="card mt-5">
            <div class="card-header text-uppercase">Recent events</div><!--card header-->
            <div class="card-body" id="cbody">
                <?php events($_SESSION['user_id']) ?>
            </div><!--card body-->
            <div class="card-footer"><a href="notes" class="btn btn-info btn-block">VIEW ALL</a></div>
            </div><!--card-->
</div>
