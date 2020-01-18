<?php

/**
 *
 */
 //this class is similar to the Student.class.php from ->  BTI7054 Topic 11 - MVC
  //iv'e done alot of changes on it. but it was the starter
class Product {

  private $id;
  private $name;
  private $cpu;
  private $graphic_card;
  private $hdd_ssd;
  private $ram;
  private $connections;
  private $type;
  private $image;
  private $price;



  public function getId(){
    return $this->id;
  }

  public function getName() {
  return $this->name;
}

public function getGraphic(){
  return $this->graphic_card;
}

public function getHddSsd(){
  return $this->hdd_ssd;
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

public function getCpu() {
  return $this->cpu;
}

public function getRam() {
  return $this->ram;
}
public function getConnections() {
  return $this->connections;
}


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


    static public function getNotebook(){
      $products = array();
      $res = DB::doQuery("SELECT * FROM products WHERE type='notebooks'");
      if($res){
        while ($product = $res->fetch_object(get_class())) {
          	$products[] = $product;
        }
      }
      return $products;
    }


    static public function getSmartphones(){
      $products = array();
      $res = DB::doQuery("SELECT * FROM products WHERE type='smartphone'");
      if($res){
        while ($product = $res->fetch_object(get_class())) {
            $products[] = $product;
        }
      }
      return $products;
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

static public function insert_product($values)
{
  $name = $values['name'];
  $cpu = $values['cpu'];
  $graphiccard = $values['graphic'];
  $hddssd = $values['hddssd'];
  $ram = $values['ram'];
  $connections = $values['connections'];
  $type = $values['type'];
  $image =$values['image'];
  $price = $values['price'];
    if ($stmt = DB::getInstance()->prepare("INSERT INTO products (name, cpu, graphic_card, hdd_ssd, ram, connections, type, image, price) VALUE (?,?,?,?,?,?,?,?,?)")) {
        if ($stmt->bind_param('ssssssssd',$name, $cpu, $graphiccard, $hddssd, $ram, $connections, $type, $image, $price)) {
            if ($stmt->execute()) {
                return true;
            }
        }
    }
    return false;
}


public function update($values) {
  $db = DB::getInstance();
  $this->name = $db->escape_string($values['name']);
  $this->cpu = $db->escape_string($values['cpu']);
  $this->graphic_card = $db->escape_string($values['graphic']);
  $this->hdd_ssd = $db->escape_string($values['hddssd']);
  $this->ram = $db->escape_string($values['ram']);
  $this->connections = $db->escape_string($values['connections']);
  $this->type = $db->escape_string($values['type']);
  $this->image = $db->escape_string($values['image']);
  $this->price = (double)$values['price'];
}


public function save(){
  $sql = sprintf("UPDATE products SET
    name='%s', cpu='%s', graphic_card='%s', hdd_ssd='%s', ram='%s', connections= '%s', type='%s', image='%s', price='%d'
     WHERE id= %d;",
     $this->name, $this->cpu, $this->graphic_card, $this->hdd_ssd, $this->ram,$this->connections, $this->type, $this->image, $this->price, $this->id);
  $res = DB::doQuery($sql);
  return $res != null;
}


  public function __toString(){
  return sprintf("%d %s,%s,%s,%s,%s %s, %s, %s, %d", $this->id,$this->name, $this->cpu, $this->graphic_card, $this->hdd_ssd, $this->ram,
       $this->connections, $this->type, $this->image, $this->price);
}

}
