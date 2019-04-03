<div class="login">
  <div class="login__content">
    <div class="box">
      <a href="index" class="home">home</a>
      <div class="heading"><h2>Reset password</h2></div>
      <form action="#" method="POST">
        <?php if (!empty($error)) {?>

        <div class="text-danger text-uppercase  text-center">
          <strong><?php echo $error; ?></strong>
        </div>
        <?php }?>
        <?php if (!empty($success)) {?>
        <div class="text-success text-uppercase text-center">
          <strong><?php echo $success; ?></strong>
        </div>
        <?php }?>
        <div>
          <input type="email" name="email" id="email"
          required>
          <label for="email">Email</label>
          <input type="hidden" name="user_type" value="1" />
        </div>


        <!-- <div>
          <textarea name="" required id="message"></textarea>
          <label for="message">Message</label>
        </div> -->
        <input type="submit" value="RESET NOW" name="submit" />
        <a href="student_login" class="have_account">back to login</a>
      </form>
    </div>
  </div>
</div>
