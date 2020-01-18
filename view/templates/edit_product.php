<div class="edit_product">
<h2><?php echo $this->controller->t('Edit Product'); ?></h2>
<form method="post" action="index.php">
	<p><label>Name</label><input name="product[name]" value="<?php echo $product->getName()?>"/></p>
	<p><label>CPU</label><input name="product[cpu]" value="<?php echo $product->getCpu()?>"/></p>
	<p><label><?php echo $this->controller->t('Graphic Card'); ?></label><input name="product[graphic]" value="<?php echo $product->getGraphic()?>"/></p>
	<p><label>HDD|SSD</label><input name="product[hddssd]" value="<?php echo $product->getHddSsd()?>"/></p>
	<p><label><?php echo $this->controller->t('Working Memory'); ?></label><input name="product[ram]" value="<?php echo $product->getRam()?>"/></p>
	<p><label><?php echo $this->controller->t('Connections'); ?></label><input name="product[connections]" value="<?php echo $product->getConnections()?>"/></p>
	<p><label><?php echo $this->controller->t('Image'); ?></label><input name="product[image]" value="<?php echo $product->getImage()?>"/></p>
	<p><label><?php echo $this->controller->t('Product Type'); ?></label><input name="product[type]" value="<?php echo $product->getType()?>"/></p>
	<p><label><?php echo $this->controller->t('Price'); ?></label><input name="product[price]" value="<?php echo $product->getPrice()?>" type="double"/></p>
	<input type="hidden" name="product[id]" value="<?php echo $product->getId()?>" />
	<input type="hidden" name="action" value="update_product" />
	<p><input type="submit" class="form_container_submit" value="<?php echo $this->controller->t('Save'); ?>"></p>
</form>
</div>
