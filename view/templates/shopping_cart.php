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

?>

<h4>My Shopping Cart</h4>
  <div id="cart-holder">
    <?php $cart->render(); ?>
  </div>
  <h4>Add Item</h4>
  <form class="formCart" method="post">
    <label>Product Id</label> <input name="item[id]" /><br />
    <label>Number</label> <input name="item[num]" type="number"/><br />
    <input type="submit" value="Add" />

  </form>
