<h2>Edit Product</h2>
<form method="post" action="index.php">
	<p><label>Product Name</label><input name="product[name_de]" value="<?php echo $product->getName_de()?>"/></p>
	<p><label>Product Desc</label><input name="product[desc_de]" value="<?php echo $product->getDesc_de()?>"/></p>
	<p><label>Product Type</label><input name="product[type]" value="<?php echo $product->getType()?>"/></p>
	<p><label>Product Price</label><input name="product[price]" value="<?php echo $product->getPrice()?>" type="double"/></p>
	<p><input type="submit" value="Save"></p>
	<input type="hidden" name="product[id]" value="<?php echo $product->getId()?>" />
	<input type="hidden" name="action" value="update_product" />
</form>
