<h2>Products</h2>
	<h5><?php echo isset($message) ? $message : ''; ?></h5>

	<?php if(empty($products)): ?>
		<p>empty</p>
	<?php else: ?>

	<?php
	foreach($products as $product):
	?>
	<div class="products_wrapper">
	<?php
  		$id = $product->getId();
			$img = "assets/images/".$product->getImage();
			$price = $product->getPrice();
			$chf = $product->getChf();
			$name = $product->getName_de();
			 if ($this->controller->isAdmin()) {
				 echo "<p class=\"products_imge\"><img src='$img' alt=\"$alt\" ></p><br>";
				 echo "<div class=\"product_list\">$product</div>
				 <a href=\"index.php?action=edit_product&id=$id\">Edit</a>
				  |
				 <a href=\"index.php?action=delete_product&id=$id\">Delete</a>
				 <br/>";
			 }
			 else {
				 //echo "<p class=\"products_imge\"><img src='$img' alt=\"$alt\"></p>";
				 //echo "<div class=\"product_list\"><div class=\"product_img\"><img src='$img' alt=\"$alt\"></div>$product</div><div class=\"product_price\">".$price." ".$chf."</div>";
				 echo "<br>
				 		<a href=\"index.php?action=display_product&id=$id\"</a><img class=\"img\" src=$img width=20% alt=$name>
				 		<span class=\"product_name\">$name</span>
						<span class=\"product_price\">".$price."-"."</span>";
			 		}
			?>

			<form class="formCart" method="post">
 					<input name="item[id]" value="<?=$product->getId();?>" type="hidden" />
 					<input name="item[num]" value="1" type="hidden" />
					<input type="submit" value="Add" />
				</form>
		</div>

<?php endforeach; ?>

	<?php endif;  ?>
