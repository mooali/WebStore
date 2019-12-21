<?php
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

	public function render() {
		if ($this->isEmpty()) {
			echo "<div class=\"cart empty\">[Empty Cart]</div>";
		} else {
			echo "<div class=\"cart\"><table>";
			echo "<tr><th>Article-ID</th><th>Article Name</th><th>#</th></tr>";
			foreach($this->items as $item => $num) {
				$product = Product::getProductById($item);
        echo "<tr><td>".$product->getId().$product->getName_de()."</td><td>
        <div class='cart_update'>
                <form class='formCart'>
                <input class='updateCart' type='number' name='amount' min='1' value='$num'>
                <input type='hidden' name='order_id' value='".$product->getId()."'>
                </form>
                </div></td></tr>";
			}
			echo "<tr><th>TOTAL</th><th>".$this->getTotal()."</th></tr>";
			echo "</table></div>";
		}
	}

}
