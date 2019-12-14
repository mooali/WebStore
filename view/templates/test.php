<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
		<section class="form login--form">
		    <div class="form_container">
		      <h3>Login</h3>
		        <form id="loginForm" method="post">
		          <input type="text" class="form_container_input" placeholder="Username" maxlength="250" name="name" required>
		          <input type="password" class="form_container_input" placeholder="Password" maxlength="250" name="password" required>
		          <div class="form_container_error" hidden>Login incorrect</div>
		          <span class="form_container_buttons">
		            <button type="reset" class="form_container_rest">Reset</button>
		            <button type="submit"class="form_container_submit">Submit</button>
		          </span>
		          <p class="form_container_hint"> You don't have an account? </p>
		        </form>
		      </div>
		</section>
		<?php include("footer.php"); ?>

  </body>
</html>
