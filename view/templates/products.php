<h2>Products</h2>
	<h5><?php echo isset($message) ? $message : ''; ?></h5>
	<?php
  if (empty($products)) {
    echo "emtpy";
  } else {


  	foreach($products as $product) {
  		$id = $product->getId();
			 if ($this->controller->isLoggedIn()) {
				 echo "<span class=\"product\">$product</span> <a href=\"index.php?action=edit_product&id=$id\">Edit</a> | <a href=\"index.php?action=delete_product&id=$id\">Delete</a><br/>";
			 }
			 else {
				 echo "<span class=\"product\">$product</span><br/>";
			 }

  	}
  }
	?>
