<div class="login">
  <div class="login__content">
    <div class="box">
      <a href="index" class="home">home</a>
      <div class="heading"><h2>LOGIN</h2></div>
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
          <?php if (isset($_SESSION['email'])): ?>
            value="<?php echo $_SESSION['email'] ?>"
          <?php endif?>
          required>
          <label for="email">Email</label>
          <input type="hidden" name="user_type" value="2" />
        </div>

        <div>
          <input type="password" name="password" id="password"<?php if (isset($_SESSION['password'])): ?>
          value="<?php echo $_SESSION['password'] ?>"
          <?php
          session_destroy();
        endif?>
        required>
        <input type="hidden" name="user" value="tutor" />
        <label for="password" id="name">password</label>
      </div>

        <!-- <div>
          <textarea name="" required id="message"></textarea>
          <label for="message">Message</label>
        </div> -->
        <input type="submit" value="LOGIN NOW" name="submit" />
        <a href="tutor_register" class="have_account">have no account?</a> <br> <a href="tutor_pass_reset" class="have_account">forgot password?</a>
      </form>
    </div>
  </div>
</div>
