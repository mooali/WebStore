<div class="form_container">
<h2><?php echo $this->controller->t('Edit Profile'); ?></h2>
<div id="error">
	<?php echo isset($message) ? "<h5>".$this->controller->t($message)."</h5>" : ""; ?>
</div>
<form method="post" action="index.php">
	<p><label><?php echo $this->controller->t('User Name'); ?></label><input name="user[username]" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,50}$" value="<?php echo $user->getUsername()?>" required/></p>
	<p><label>E-Mail</label><input type="email" name="user[email]" value="<?php echo $user->getEmail()?>" required/></p>
	<p><label><?php echo $this->controller->t('Password'); ?></label><input name="user[pwd]" value="<?php echo $user->getPwd()?>" type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/></p>
	<p><label><?php echo $this->controller->t('Confirm password'); ?></label><input name="user[re-pwd]" value="<?php echo $user->getPwd()?>" type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/></p>
	<p><input type="hidden" name="user[type]" value=" <?php echo $user->getType()?>" type="text">
	</select></p>
	<p><input class="form_container_submit" type="submit" value="<?php echo $this->controller->t('Save'); ?>"></p>
	<input type="hidden" name="user[id]" value="<?php echo $user->getId()?>" />
	<input type="hidden" name="action" value="update_user_self" />
</form>
</div>
