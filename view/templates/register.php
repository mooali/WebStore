<?php

$username = "";
$email = "";
if(isset($_POST['user'])) {
  $user = $_POST['user'];
  $username = $user["username"];
  $email = $user["email"];

}

?>

<section class="form register--form">
  <div class="form_container">
    <h2><?php echo $this->controller->t('Register'); ?></h2>
    <div id="error">
      <?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
    </div>
    <form class="registerForm" action="index.php?action=signupUser" method="post">
    <p>
    <p><label for="username"><?php echo $this->controller->t('User Name'); ?></label>
    <input type="text" value="<?=$username?>" id="test" class="form_container_input" placeholder="User Name" maxlength="250" name="user[username]" ></p>
    <p><label for="email">E-Mail</label>
    <input type="text" value="<?=$email?>" class="form_container_input" placeholder="E-Mail" maxlength="250" name="user[email]" >
    <p><label for="pwd">Password</label>
    <input type="password" class="form_container_input" placeholder="Password" maxlength="250" name="user[pwd]" ></p>
    <p><label for="pwd">Re-Password</label>
    <input type="password" class="form_container_input" placeholder="Password" maxlength="250" name="user[re-pwd]" ></p>
    <span class="form_container_buttons">
      <button type="reset" id="reset" class="form_container_rest">Reset</button>
      <button type="submit" name="submit" class="form_container_submit"><?php echo $this->controller->t('Submit');?></button>
    </span>
    <input type="hidden" name="user[type]" value="user"/>
   </form>
  </div>
</section>
