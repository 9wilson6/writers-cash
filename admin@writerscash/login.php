<?php 
require_once"../inc/header_links.php";
require_once("../dbconfig/dbconnect.php");
require_once"../inc/global_functions.php";
$error="";
 Login();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
</head>
<body>
<div class="login">
  <div class="login__content">
    <div class="box">
      <a href="index" class="home">home</a>
      <div class="heading"><h2>Admin Login</h2></div>
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
          <input type="email" name="email" id="email" required>
          <label for="email">Email</label>
           <input type="hidden" name="user_type" value="3">
        </div>

        <div>
          <input type="password" name="password" id="password" required>
          <input type="hidden" name="user" value="admin">
          <label for="password" id="name">password</label>
        </div>
        <input type="submit" value="LOGIN NOW" name="submit" />
      </form>
    </div>
  </div>
</div>

</body>
</html>


