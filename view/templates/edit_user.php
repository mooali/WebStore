<h2>Edit Student</h2>
<form method="post" action="index.php">
	<p><label>User Name</label><input name="student[firstname]" value="<?php echo $user->getUsername()?>"/></p>
	<p><label>E-Mail</label><input name="student[lastname]" value="<?php echo $user->getEmail()?>"/></p>
	<p><label>Password</label><input name="student[semester]" value="<?php echo $user->getPwd()?>" type="password"/></p>
	<p><label>Type</label> <input name="user[type]" value=" <?php echo $user->getType()?>" type="text">
	</select></p>
	<p><input type="submit" value="Save"></p>
	<input type="hidden" name="user[id]" value="<?php echo $user->getId()?>" />
	<input type="hidden" name="action" value="update_user" />
</form>
