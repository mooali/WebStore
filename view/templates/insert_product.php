<div class="edit_product">
<h2><?php echo $this->controller->t('Insert Product'); ?></h2>
<form method="post" action="index.php?action=add_product">
  <p><label>Name</label><input type="text" name="product[name]"/></p>
  <p><label>CPU</label><input type="text" name="product[cpu]"/></p>
	<p><label><?php echo $this->controller->t('Graphic Card'); ?></label><input type="text" name="product[graphic]"/></p>
  <p><label>HDD | SSD</label><input type="text" name="product[hddssd]"/></p>
	<p><label><?php echo $this->controller->t('Working Memory'); ?></label><input type="text" name="product[ram]"/></p>
	<p><label><?php echo $this->controller->t('Connections'); ?></label> <input type="text" name="product[connections]"></p>
  <p><label><?php echo $this->controller->t('Product Type'); ?></label><input type="text" name="product[type]"/></p>
  <p><label><?php echo $this->controller->t('Image'); ?></label><input type="text" name="product[image]" /></p>
  <p><label><?php echo $this->controller->t('Price'); ?></label><input type="text" name="product[price]" /></p>
  <p><input type="submit" class="form_container_submit" value="<?php echo $this->controller->t('Insert Product'); ?>"></p>
</form>
</div>
