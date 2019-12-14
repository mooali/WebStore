<section class="form register--form">
  <title>Register</title>
  <div class="form_container">
    <h3>Register</h3>
    <form action="regiinsert.php"class="registerForm" method="post">
    <p>
    <label for="FirstName">First Name</label>
    <input type="text" class="form_container_input" placeholder="First Name" maxlength="250" name="firstName" required></p>
    <p><label for="LastName">Last Name</label>
    <input type="text" class="form_container_input" placeholder="Last Name" maxlength="250" name="lastName" required></p>
    <p><label for="UserName">User Name</label>
    <input type="text" class="form_container_input" placeholder="User Name" maxlength="250" name="userName" required></p>
    <p><label for="E-Mail">E-Mail</label>
    <input type="text" class="form_container_input" placeholder="E-Mail" maxlength="250" name="email" required>
    <p><label for="Password">Password</label>
    <input type="password" class="form_container_input" placeholder="Password" maxlength="250" name="password" required></p>
    <span class="form_container_buttons">
      <button type="reset" class="form_container_rest">Reset</button>
      <button type="submit" name="submit" class="form_container_submit">Submit</button>
    </span>
   </form>
  </div>
</section>
