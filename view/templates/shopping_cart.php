<?php
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = new Cart();
}
$cart = $_SESSION['cart'];

if (isset($_POST['item'])) {
  $item = $_POST['item'];
  echo $item['id'] . ";". $item['num'];
  $cart->updateItem($item['id'], $item['num']);
}


if (isset($_POST['amount'])) {
  $amount = $_POST['amount'];
  $id = $_POST['order_id'];
  if($amount == "" || $amount == 0) {
    $cart->removeItem($id, $cart->getAmount($id));
    die();
  }
  $cart->setItem($id, $amount);
}

?>

<div class="products">
<h3><?php echo $this->controller->t('My Shopping Cart'); ?></h3>
</div>
  <div id="cart-holder">
    <?php $cart->render($this->controller); ?>
  </div>

  <input id="total_price" type="hidden" value="<?=$cart->getTotal()?>"/>
