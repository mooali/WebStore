<?php

//this class was orignally take from the course BTI7054 - Web Programming -> Topic 10 - HTTP, XML, JSON, AJAX
//iv'e done alot of changes on it. but it was the starter
class Cart {

	// product id <-> num
	private $items = [];

	public function addItem($itemId, $num) {
		if (isset($this->items[$itemId])) {
			$this->items[$itemId] += $num;
		} else {
			$this->items[$itemId] = $num;
		}
	}

	public function removeItem($itemId, $num) {
		if (isset($this->items[$itemId])) {
			$this->items[$itemId] -= $num;
			if ($this->items[$itemId] <= 0) {
				unset($this->items[$itemId]);
			}
		}
	}

	public function updateItem($itemId, $num) {
		if (isset($this->items[$itemId])) {
			$this->items[$itemId] += $num;
			if ($this->items[$itemId] <= 0) {
				unset($this->items[$itemId]);
			}
		} else {
			$this->items[$itemId] = $num;
		}
	}

  public function setItem($itemId, $num) {
			$this->items[$itemId] = $num;
	}

	public function getItems() {
		return $this->items;
	}


	public function isEmpty() {
		return count($this->items) == 0;
	}

	public function getTotal() {
		$total = 0;
		foreach($this->items as $item => $num) {
			$p = Product::getProductById($item);
			$total += $num * $p->getPrice();
		}
		return $total;
	}

public function getAmount($id){
	$total = 0;
	foreach($this->items as $item => $num) {
		$p = Product::getProductById($item);
		$total = $num;
	}
	return $total;
}



	static public function getAllProducts() {

			$products = array();
			$res = DB::doQuery("SELECT * FROM orders");
			if ($res) {
				while ($product = $res->fetch_object(get_class())) {
					$products[] = $product;
				}
			}
			return $products;
		}


public function getProductsInfo(){
	$names = array();
	$number=0;
	foreach($this->items as $item => $num) {
		$product = Product::getProductById($item);
		$names = $product->getName();
		$number++;
		echo (" ".$number."- "."Product-ID = "."( $item ) "." , Amount = ( ".$num." )<br>");

		}
	}


	public function sendEmail($id){
		$to ="skylaine2008@yahoo.com";
		$subject = "Thank you we received your order";
		$message = Cart::getProductsInfo();
		$headers = array(
			'From' => 'momacshop@outlook.com',
			'Replay-To' => 'momacshop@outlook.com',
			'X-Mailer' => 'PHP/'. phpversion()
		);


	mail($to,$subject,$message,$headers);
}



	public function render(Controller $controller) {
		if ($this->isEmpty()) {
			echo "<div class=\"cart_empty\">
						<p>".$controller->t('Your Cart is Empty')."</p>
						</div>";
		} else {
			echo "<div class=\"cart\"><table>";
			echo "<tr class=\"cart_table_head\">
								<th>".$controller->t('Article Name')."</th>
								<th>".$controller->t('Price')."</th>
								<th>".$controller->t('Amount')."</th>
						</tr>";
			foreach($this->items as $item => $num) {
				$product = Product::getProductById($item);
        $img = "assets/images/".$product->getImage();
        echo "
				<tr><td class=\"cartTd\"><hr>"."<img src='$img' width= 10%>"." ".$product->getName()."<td class=\"product_price\">".$product->getPrice()."</td></td><td>
        <div class='cart_update'>
                <form class='formCart'>
                <input class='updateCart' type='number' name='amount' min='1'  value='$num'>
                <input type='hidden' name='order_id' value='".$product->getId()."'>
                </form>
                </div>
								<div>
								<form class=\"Delete_item\" action=\"index.php?action=delete_item\" method=\"post\">
								<input class=\"checkout_delete\" type='submit' name='delete' value='".$controller->t('Delete')."'>
								<input type='hidden' name='delete[amount]' value='$num'>
								<input type='hidden' name='delete[order_id]' value='".$product->getId()."'>
								</div>
								</form>
								</td></tr>";
			}
			echo "<tr><th class=\"cart_total\"><hr>TOTAL</th><th><span class=\"product_price\" id=\"total_price1\">".$this->getTotal()."</span></th></tr>";
			echo "</table>";
			echo "<form class=\"Delete_item\" action=\"index.php?action=order\" method=\"post\">";
			echo "<button class=\"form_container_checkOut\"><a href=\"index.php?action=order\">Checkout</a></button></div>";

		}
	}

	public function order_render(Controller $controller) {
			echo "<div class=\"cart\"><table>";
			echo "<tr class=\"cart_table_head\">
							<th>".$controller->t('Article Name')."</th>
							<th>".$controller->t('Amount')."</th>
						</tr>";
			foreach($this->items as $item => $num) {
				$product = Product::getProductById($item);
				$img = "assets/images/".$product->getImage();
				echo "<tr><td class=\"cartTd\">"."<img src='$img' width= 10%>"." ".$product->getName()."<td id='checkout_amount'>$num</td></td><td>
				</td></tr>";
			}
			echo "<tr><th class=\"cart_total\"><hr>TOTAL</th><th><span class=\"product_price\" id=\"total_price1\">".$this->getTotal()." CHF</span></th></tr>";
			echo "</table></div>";
	}





}
