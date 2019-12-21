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
  $cart->setItem($id, $amount);
}


?>

<h4>My Shopping Cart</h4>
  <div id="cart-holder">
    <?php $cart->render(); ?>
  </div>
