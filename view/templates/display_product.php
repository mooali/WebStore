
<h2><?php $product->getName_de()?></h2>

	<div class="products_display_wrapper">
	<?php
  		$id = $product->getId();
			$img = "assets/images/".$product->getImage();
			$price = $product->getPrice();
			$chf = $product->getChf();
			$name = $product->getName_de();
      $desc = $product->getDesc_de();
				 //echo "<p class=\"products_imge\"><img src='$img' alt=\"$alt\"></p>";
				 //echo "<div class=\"product_list\"><div class=\"product_img\"><img src='$img' alt=\"$alt\"></div>$product</div><div class=\"product_price\">".$price." ".$chf."</div>";
				 echo "<br>
				 		<img class=\"displaay_img\" src=$img width=20% alt=$name>
				 		<span class=\"product_display_name\">$name</span>
				 		<span class=\"product_display_price\">".$price."-"."</span>";

            ?>
            <form class="formCart" method="post">
                <input name="item[id]" value="<?=$product->getId();?>" type="hidden" />
                <input name="item[num]" value="1" type="hidden" />
                <input type="submit" value="Add" />
              </form>
          </div>

          </div>
        <div class="product_display_desc">
            <?php
          echo "<span class=\"product_display_desc\">$desc</span>";
			?>
		</div>
