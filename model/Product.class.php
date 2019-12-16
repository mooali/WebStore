<?php

/**
 *
 */
class Product {

  private $id;
  private $name_de;
  private $desc_de;
  private $type;
  private $image;
  private $price;
  private $chf = "CHF";


  function __construct()
  {
    // code...
  }

  static public function getAllProducts() {

  		$products = array();
  		$res = DB::doQuery("SELECT * FROM products");
  		if ($res) {
  			while ($product = $res->fetch_object(get_class())) {
  				$products[] = $product;
  			}
  		}
  		return $products;
  	}


    public function getId(){
      return $this->id;
    }

    public function getName_de() {
		return $this->name_de;
	}

  public function getPrice() {
    return $this->price;
  }

  public function getImage() {
    return $this->image;
  }


  public function getType() {
		return $this->type;
	}

  public function getDesc_de() {
    return $this->desc_de;
  }



  static public function getProductById($id) {
  $id = (int) $id;
  $res = DB::doQuery("SELECT * FROM products WHERE id = $id");
  if ($res) {
    if ($product = $res->fetch_object(get_class())) {
      return $product;
    }
  }
  return null;
}


static public function delete($id){
  $id = (int) $id;
  $res = DB::doQuery("DELETE FROM products WHERE id = $id");
  return $res != null;

}

public function update($values) {
  $db = DB::getInstance();
  $this->name_de = $db->escape_string($values['name_de']);
  $this->desc_de = $db->escape_string($values['desc_de']);
  $this->type = $db->escape_string($values['type']);
  $this->price = (double)$values['price'];
}


public function save(){
  $sql = sprintf("UPDATE products SET name_de='%s', desc_de='%s', type='%s', price=%d WHERE id= %d;",$this->name_de, $this->desc_de, $this->type, $this->price, $this->id);
  $res = DB::doQuery($sql);
  return $res != null;
}


  public function __toString(){
  return sprintf("%d) %s, %s, %s, %d %s", $this->id, $this->getName_de(), $this->desc_de, $this->type, $this->price, $this->chf);
}

}
