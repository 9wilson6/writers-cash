<div class="login">
    <div class="login__content">
        <div class="box">
            <a href="index" class="home">home</a>
     <div class="heading"> <h2>Register</h2></div>
      <form action="#" method="POST">

        	<?php if (!empty($error)) {?>

         <div class="text-danger text-uppercase  text-center"><strong><?php echo $error; ?></strong></div>
      <?php }?>
      <?php if (!empty($success)) {?>
    <div class="text-success text-uppercase text-center"><strong><?php echo $success; ?></strong></div>
      <?php }?>
        <div>
          <input type="text" name="username" id="username" required />
          <label for="username">Username</label>
        </div>
        <div>
          <input type="email" name="email" id="email" required />
          <label for="email">Email</label>
        </div>

         <div>
          <input type="password" name="password" id="password" required />
          <label for="password" id="name">password</label>
        </div>
         <div>
          <input type="password" name="C_password" id="C_password"  required />
          <label for="C_password">Retype password</label>
           <input type="hidden" name="user" value="student">
                 <input type="hidden" name="user_type" value="1">
        </div>
        <!-- <div>
          <textarea name="" required id="message"></textarea>
          <label for="message">Message</label>
        </div> -->
        <input type="submit" value="REGISTER NOW" name="submit" />
        <a href="student_login" class="have_account">already registered?</a>
      </form>
    </div></div>
</div>