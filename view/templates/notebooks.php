<h2>notebooks</h2>
	<h5><?php echo isset($message) ? $message : ''; ?></h5>
	<?php
  if (empty($notebooks)) {
    echo "emtpy";
  } else {

  	foreach($notebooks as $notebook) {
				 echo "<span class=\"product\">$notebook</span><br/>";
			 }

  	}
	?>
