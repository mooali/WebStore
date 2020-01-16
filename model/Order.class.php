<?php

/**
 *
 */
class Order
{

  private $id;
  private $user_id;
  private $firstName;
  private $lastName;
  private $email;
  private $street;
  private $plz;
  private $city;
  private $phonenumber;
  private $products;
  private $price;
  private $ctreated_at;


  public function getId(){
    return $this->id;
  }
  public function getUserid(){
    return $this->user_id;
  }

  public function getFirstname(){
    return $this->firstname;
  }
  public function getLastname(){
    return $this->lastname;
  }
  public function getEmail(){
    return $this->email;
  }
  public function getstreet(){
    return $this->street;
  }
  public function getPlz(){
    return $this->plz;
  }
  public function getCity(){
    return $this->city;
  }
  public function getPhonenumber(){
    return $this->phonenumber;
  }
  public function getProducts(){
    return $this->products;
  }
  public function getPrice(){
    return $this->price;
  }
  public function getTime(){
    return $this->ctreated_at;
  }

/*
  static public function insert_order($values)
  {
    $address_id = $values['address_id'];
    $product_id = $values['product_id'];
    $amount = $values['amount'];
      if ($stmt = DB::getInstance()->prepare("INSERT INTO orders (user_id, product_id, amount) VALUE (?,?,?)")) {
          if ($stmt->bind_param('sssdss', $address_id, $product_id, $amount)) {
              if ($stmt->execute()) {
                  return true;
              }
          }
      }
      return false;
  }

*/

public function __toString()
{
    return sprintf("%d) (%d) %s %s", $this->id, $this->user_id, $this->firstname, $this->lastname);
}

  static public function insert_order($values)
  {
    $user_id = $values['user_id'];
    $firstName = $values['firstname'];
    $lastName = $values['lastname'];
    $email = $values['email'];
    $street = $values['street'];
    $plz = $values['plz'];
    $city = $values['city'];
    $phonenumber =$values['phonenumber'];
    $products = $values['products'];
    $price = $values['total'];
      if ($stmt = DB::getInstance()->prepare("INSERT INTO orders (user_id, firstname, lastname, email, street , plz, city, phonenumber, products, price) VALUE (?,?,?,?,?,?,?,?,?,?)")) {
          if ($stmt->bind_param('dssssdsdsd',$user_id, $firstName, $lastName, $email, $street, $plz, $city, $phonenumber, $products, $price)) {
              if ($stmt->execute()) {
                  return true;
              }
          }
      }
      return false;
  }


  public function sendEmail($id){
    $to ="";
    $subject = "Thank you we received your order";
    $message = Cart::getProductsInfo();
    $headers = array(
      'From' => 'momacshop@outlook.com',
      'Replay-To' => 'momacshop@outlook.com',
      'X-Mailer' => 'PHP/'. phpversion()
    );
    $res = DB::doQuery("SELECT email FROM orders where user_id =$id");
    if ($res) {
          if($email = $res->fetch_assoc()) {
                  $to = $email["email"];
      }
  }
  mail($to,$subject,$message,$headers);
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


  static public function getOrderById($id)
  {
      $id = (int)$id;
      $res = DB::doQuery("SELECT * FROM orders WHERE id = $id");
      if ($res) {
          if ($order = $res->fetch_object(get_class())) {
              return $order;
          }
      }
      return null;
  }


  static public function delete($id)
  {
      $id = (int)$id;
      $res = DB::doQuery("DELETE FROM orders WHERE id = $id");
      return $res != null;
  }





}
