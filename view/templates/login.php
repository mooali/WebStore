<div class="login--form">
    <div class="form_container">
      <h2><?php echo $this->controller->t('Login'); ?></h2>
        <div id="error">
          <?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
        </div>
        <form id="loginForm" action="index.php?action=login" method="post">
          <p><label for="userName">User Name</label>
          <input type="text" class="form_container_input" placeholder="Username" maxlength="250" name="name" required title="Only letters, numbers and 'underscore' are allowed"></p>
          <p><label for="password">Password</label>
          <input type="password" class="form_container_input" placeholder="Password" maxlength="250" name="password" required></p>
          <div class="form_container_error" hidden>Login incorrect</div>
          <span class="form_container_buttons">
            <button type="reset" class="form_container_rest">Reset</button>
            <button type="submit" name="submit" class="form_container_submit">Submit</button>
          </span>
          <p class="form_container_rege"><?php echo $this->controller->t('You dont have an account'); ?>?<a href="index.php?action=register"><?php echo $this->controller->t('register now'); ?></a> </p>
        </form>
      </div>
</div>
