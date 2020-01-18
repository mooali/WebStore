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
      <?php echo isset($message) ? "<h5>".$this->controller->t($message)."</h5>" : ""; ?>
    </div>
    <form class="registerForm" action="index.php?action=signupUser" method="post">
    <p>
    <p><label for="username"><?php echo $this->controller->t('User Name'); ?></label>
    <input type="text" value="<?=$username?>" id="test" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,50}$" placeholder="User Name" maxlength="50" name="user[username]" ></p>
    <p><label for="email">E-Mail</label>
    <input type="email" value="<?=$email?>" placeholder="E-Mail" maxlength="250" name="user[email]" >
    <p><label for="pwd"><?php echo $this->controller->t('Password'); ?></label>
    <input type="password" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" maxlength="250" name="user[pwd]" ></p>
    <p><label for="pwd"><?php echo $this->controller->t('Confirm password'); ?></label>
    <input type="password" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" maxlength="250" name="user[re-pwd]" ></p>
    <span class="form_container_buttons">
      <button type="reset" id="reset" class="form_container_rest" >Reset</button>
      <button type="submit" class="form_container_submit" name="submit"><?php echo $this->controller->t('Submit');?></button>
    </span>
    <input type="hidden" name="user[type]" value="user"/>
   </form>
  </div>
</section>
