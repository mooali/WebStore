<div class="form_container">
<h2>Edit Profile</h2>
<form method="post" action="index.php">
	<p><label>User Name</label><input name="user[username]" value="<?php echo $user->getUsername()?>"/></p>
	<p><label>E-Mail</label><input name="user[email]" value="<?php echo $user->getEmail()?>"/></p>
	<p><label>Password</label><input name="user[pwd]" value="<?php echo $user->getPwd()?>" type="password"/></p>
	<p><label>Re-Password</label><input name="user[re-pwd]" value="<?php echo $user->getPwd()?>" type="password"/></p>
	<p><input type="hidden" name="user[type]" value=" <?php echo $user->getType()?>" type="text">
	</select></p>
	<p><input type="submit" value="Save"></p>
	<input type="hidden" name="user[id]" value="<?php echo $user->getId()?>" />
	<input type="hidden" name="action" value="update_user_self" />
	<span class="register_error"> <?php echo isset($message) ? $message : ''; ?> </span>
</form>
</div>
