
<h2><?php $product->getName()?></h2>

	<div class="products_display_wrapper">
	<?php
  		$id = $product->getId();
			$img = "assets/images/".$product->getImage();
			$price = $product->getPrice();
			$name = $product->getName();
      $cpu = $product->getCpu();
			$graphic=$product->getGraphic();
			$ram=$product->getRam();
			$connections=$product->getConnections();
			$gt = $this->controller->t('Graphic Card');
			$ramt=$this->controller->t('Working Memory');
			$connectionst=$this->controller->t('Connections');
			$imaget=$this->controller->t('Image');
			$productTypet=$this->controller->t('Product Type');
			$preist=$this->controller->t('Price');
				 //echo "<p class=\"products_imge\"><img src='$img' alt=\"$alt\"></p>";
				 //echo "<div class=\"product_list\"><div class=\"product_img\"><img src='$img' alt=\"$alt\"></div>$product</div><div class=\"product_price\">".$price." ".$chf."</div>";
				 echo "<br>
				 <table class=\"display_products\">
				 <tr class=\"display_head\">
				 		<th><span class=\"product_display_name\">$name</span></th>
						 <th>$preist</th>
				 </tr>
				 <tr>
						<th><img class=\"displaay_img\" src=$img width=20% alt=$name></th>
				 		<th><span class=\"product_price\">".$price."-"."</span></th>
				</tr>
						";

            ?>
							<?php echo "</table>"; ?>

						<div class="product_display_desc">
									<?php
								echo "
								<table class=\"display_desc\">
								<tr>
									  <th>CPU</th>
										<td>$cpu</td>
								</tr>
								<tr>
									<th>$gt</th>
									<td>$graphic</td>
			 				</tr>
							<tr>
									<th>$ramt</th>
									<td>$ram</td>
							</tr>
							<tr>
									<th>$connectionst</th>
									<td>$connections</td>
							</tr>
								</table>

								";
						?>
					</div>
					<div class="add_cart">
					<form class="formCart" method="post">
							<input name="item[id]" value="<?=$product->getId();?>" type="hidden" />
							<input name="item[num]" value="1" type="hidden" />
							<input type="submit" value="<?php echo $this->controller->t('Add to cart') ?>" />
						</form>
					</div>
</div>
