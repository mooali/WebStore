<h2>Edit Student</h2>
<form method="post" action="index.php">
	<p><label>Firstname</label><input name="student[firstname]" value="<?php echo $student->getFirstname()?>"/></p>
	<p><label>Lastname</label><input name="student[lastname]" value="<?php echo $student->getLastname()?>"/></p>
	<p><label>Semester</label><input name="student[semester]" value="<?php echo $student->getSemester()?>" type="number"/></p>
	<p><label>Project</label><select name="student[project_id]">
		<?php foreach ($projects as $project) {
			$selected = $project->getId() == $student->getProjectId() ? ' selected="selected"' : '';
			printf('<option value="%d"%s>%s</option>', $project->getId(), $selected, $project->getTitle());
		}?>
	</select></p>
	<p><input type="submit" value="Save"></p>
	<input type="hidden" name="student[id]" value="<?php echo $student->getId()?>" />
	<input type="hidden" name="action" value="update_student" />
</form>
