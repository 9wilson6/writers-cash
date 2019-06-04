<div class="login bg-success">
    <div class="login__content">
        <div class="box">
     <div class="heading"> <h2>Reset Password</h2></div>
      <form action="#" method="POST">

          <?php if (!empty($error)) {?>

         <div class="text-danger text-uppercase  text-center"><strong><?php echo $error; ?></strong></div>
      <?php }?>
      <?php if (!empty($success)) {?>
    <div class="text-success text-uppercase text-center"><strong><?php echo $success; ?></strong></div>
      <?php }?>
        <div>
          <input type="email" name="email" id="email" required />
          <label for="email">Email</label>
           <input type="hidden" name="user_type" value="2">
        </div>
        <input type="submit" value="RESET NOW" name="reset">
        <a href="login" class="have_account">login</a>
      </form>
    </div></div>
</div>