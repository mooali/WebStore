<div class="admin_orders">
	<h3><?php echo $this->controller->t('Orders'); ?></h3>
  <?php
  echo "<table class=\"table_admin\">
           <tr class=\"admin_table_head\">
               <th>ID</th>
               <th>User_ID</th>
               <th>Name</th>
               <th>E-Mail</th>
               <th>Address</th>
               <th>".$this->controller->t('Products')."</th>
							 <th>".$this->controller->t('Settings')."</th>
           </tr>";
           ?>
	<h5><?php echo isset($message) ? $message : ''; ?></h5>
	<?php
	foreach($orders as $order) {
    $id = $order->getId();
    $user_id = $order->getUserid();
    $firstname = $order->getFirstname();
    $lastname = $order->getLastname();
    $email = $order->getEmail();
    $street = $order->getstreet();
    $plz = $order->getPlz();
    $city = $order->getCity();
    $phonenumber = $order->getPhonenumber();
    $products = $order->getProducts();
    $price= $order->getPrice();

echo "
             <tr>
                 <th>$id</th>
                 <th>$user_id</th>
                 <th>$firstname,$lastname</th>
                 <th>$email</th>
                 <th>$street,$plz,$city</th>
                 <th>$products</th>
                 <th><a href=\"index.php?action=delete_order&id=$id\">".$this->controller->t('Delete')."</a></th>
            </tr>";

  }
	?>
  </table>
</div>
