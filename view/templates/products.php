<div class="products">

	<h3><?php echo $this->controller->t('Products'); ?></h3>
	<div class="kategorie">
		<a class="form_container_submit" href="index.php?action=smartphones"><?php echo $this->controller->t('Show only Smartphones'); ?></a><a class="form_container_submit" href="index.php?action=notebooks"><?php echo $this->controller->t('Show only Notebooks'); ?></a>
	</div>
	<?php if(empty($products)): ?>
		<p>empty</p>
	<?php else: ?>
	<?php echo "<div class='products_flex'>"; ?>
	<?php	foreach($products as $product): ?>
	<?php
  		$id = $product->getId();
			$img = "assets/images/".$product->getImage();
			$price = $product->getPrice();
			$name = $product->getName();
			$type =$product->getType();

		 	echo "<div class=\"products_wrapper\">";
				 //echo "<p class=\"products_imge\"><img src='$img' alt=\"$alt\"></p>";
				 //echo "<div class=\"product_list\"><div class=\"product_img\"><img src='$img' alt=\"$alt\"></div>$product</div><div class=\"product_price\">".$price." ".$chf."</div>";

		 		echo"<a href=\"index.php?action=display_product&id=$id\"><img class=\"img\" src=$img alt=$name></a>";
		 		echo "<span class=\"product_name\">$name</span>";
				echo "<span class=\"product_price\">".$price."-"."</span>";
		?>

			<form class="formCart" method="post">
				<input name="item[id]" value="<?=$product->getId();?>" type="hidden" />
				<input name="item[num]" value="1" type="hidden" />
				<input type="submit" value="<?php echo $this->controller->t('Add to cart') ?>" />
			</form>
		<?php
			echo "</div>";
		?>

	<?php endforeach;?>

	<?php
		echo "</div>";
	?>

<?php endif;  ?>
</div>
