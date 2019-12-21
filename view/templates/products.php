<h2>Products</h2>
	<h5><?php echo isset($message) ? $message : ''; ?></h5>

	<?php if(empty($products)): ?>
		<p>empty</p>
	<?php else: ?>

	<?php
	foreach($products as $product):
	?>
	<?php
  		$id = $product->getId();
			 if ($this->controller->isAdmin()) {
				 echo "<span class=\"product\">$product</span> <a href=\"index.php?action=edit_product&id=$id\">Edit</a> | <a href=\"index.php?action=delete_product&id=$id\">Delete</a><br/>";
			 }
			 else {
				 echo "<span class=\"product\">$product</span><br/>";
			 }
			?>
	<form class="formCart" method="post">
	 <input name="item[id]" value="<?=$product->getId();?>" type="hidden" />
	 <input name="item[num]" value="1" type="hidden" />
		<input type="submit" value="Add" />
	</form>

<?php endforeach; ?>

	<?php endif;  ?>
