<div class="form_container">
	<h2><?php echo $this->controller->t('Edit User'); ?></h2>
<form method="post" action="index.php">
	<p><label><?php echo $this->controller->t('User Name'); ?></label><input name="user[username]" value="<?php echo $user->getUsername()?>"/></p>
	<p><label>E-Mail</label><input name="user[email]" value="<?php echo $user->getEmail()?>"/></p>
	<p><label><?php echo $this->controller->t('Password'); ?></label><input name="user[pwd]" value="<?php echo $user->getPwd()?>" type="password"/></p>
	<p><label><?php echo $this->controller->t('Type'); ?></label> <input name="user[type]" value=" <?php echo $user->getType()?>" type="text">
	</select></p>
	<p><input type="submit" class="form_container_submit" value="<?php echo $this->controller->t('Save'); ?>"></p>
	<input type="hidden" name="user[id]" value="<?php echo $user->getId()?>" />
	<input type="hidden" name="action" value="update_user" />
</form>
</div>
