
<h4>My Shopping Cart</h4>
  <div id="cart-holder">
    <?php
    $cart = $_SESSION['cart'];

    $cart->order_render(); ?>
  </div>

  <?php $id = $_SESSION['id']; ?>

<div class="form_container_order">
<h2><?php echo $this->controller->t('Billing Address'); ?></h2>
<div id="error">
  <?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
</div>
<form method="post" action="index.php?action=place_order">
  <p><label><?php echo $this->controller->t('Firstname'); ?></label><input name="order[firstname]" pattern="[a-zA-Z ]*" title="Only letters are allowed!" required/></p>
  <p><label><?php echo $this->controller->t('Lastname'); ?></label><input name="order[lastname]" pattern="[a-zA-Z ]*" title="Only letters are allowed!" required/></p>
	<p><label>Email</label><input type="email" name="order[email]" required/></p>
  <p><label><?php echo $this->controller->t('Street'); ?></label><input name="order[street]" pattern="[a-zA-Z0-9_ -]*" title="Only letters and numbers are allowed!" required/></p>
	<p><label><?php echo $this->controller->t('Postal code'); ?></label><input name="order[plz]" pattern="[0-9]{4}" type="text" maxlength=4 required/></p>
	<p><label><?php echo $this->controller->t('City'); ?></label> <input name="order[city]" type="text" required></p>
  <p><label><?php echo $this->controller->t('Phonenumber'); ?></label><input type="tel" name="order[phonenumber]" pattern="(?:0|\(?\+41\)?\s?|0041\s?\[0-9])" length=14 pattern=""/></p>
  <input type="hidden" name="order[total]" value="<?php echo $cart->getTotal() ?>"/>
	<input type="hidden" name="order[user_id]" value="<?php echo $id?>" />
  <input type="hidden" name="order[products]" value="<?php $cart->getProductsInfo()?>" />
  <input type="hidden" name="unset" value="<?php unset($_SESSION['cart']);?>" />
  <input type="submit" class="form_container_submit" value="<?php echo $this->controller->t('Order'); ?>">
</form>
</div>
