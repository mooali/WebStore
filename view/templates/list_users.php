<div class="users">
	<h3><?php echo $this->controller->t('Users'); ?></h3>
	<div id="welcome-msg">
		<?php echo isset($message) ? "<h5>".$this->controller->t($message)."</h5>" : ""; ?>
	</div>
	<?php echo "<table class=\"table_admin\">
					 <tr class=\"admin_table_head\">
							 <th>ID</th>
							 <th>".$this->controller->t('Firstname')."</th>
							 <th>E-Mail</th>
							 <th>".$this->controller->t('Type')."</th>
							 <th>".$this->controller->t('Settings')."</th>
					 </tr>" ?>
	<?php
	foreach($users as $user) {
		$id = $user->getId();
		$username = $user->getUsername();
		$email = $user->getEmail();
		$type = $user->getType();
		echo "
						 <tr>
								 <th>$id</th>
								 <th>$username</th>
								 <th>$email</th>
								 <th>$type</th>
								 <th><a href=\"index.php?action=edit_user&id=$id\">".$this->controller->t('Edit')."</a>|<a href=\"index.php?action=delete_user&id=$id\">".$this->controller->t('Delete')."</a></th>
						</tr>";
	}
	?>
	</table>
</div>
