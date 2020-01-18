<?php

	require_once("autoloader.php");
  // Inizialize model
  if (!DB::create('localhost', 'root', '', 'webshop')) {
    die("Unable to connect to database [".DB::getInstance()->connect_error."]");
  }
  
  session_start();

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = new Cart();
	}
	$cart = $_SESSION['cart'];

  if (isset($_POST['item'])) {
    $item = $_POST['item'];
    $cart->updateItem($item['id'], $item['num']);
  }

/*
  if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    $id = $_POST['order_id'];
    $cart->setItem($id, $amount);
  }
*/

echo $cart->render();
