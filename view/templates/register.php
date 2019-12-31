<section class="form register--form">
  <div class="form_container">
    <h2>Register</h2>
    <form class="registerForm" action="index.php?action=signupUser" method="post">
    <p>
    <p><label for="username">User Name</label>
    <input type="text" class="form_container_input" placeholder="User Name" maxlength="250" name="user[username]" ></p>
    <p><label for="email">E-Mail</label>
    <input type="text" class="form_container_input" placeholder="E-Mail" maxlength="250" name="user[email]" >
    <p><label for="pwd">Password</label>
    <input type="password" class="form_container_input" placeholder="Password" maxlength="250" name="user[pwd]" ></p>
    <p><label for="pwd">Re-Password</label>
    <input type="password" class="form_container_input" placeholder="Password" maxlength="250" name="user[re-pwd]" ></p>
    <span class="form_container_buttons">
      <button type="reset" class="form_container_rest">Reset</button>
      <button type="submit" name="submit" class="form_container_submit">Submit</button>
    </span>
    <input type="hidden" name="user[type]" value="user"/>
   </form>
   <span class="register_error"> <?php echo isset($message) ? $message : ''; ?> </span>
  </div>
</section>
