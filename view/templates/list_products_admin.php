<div class="products">
		<?php
		echo "<table class=\"table_admin\">
						 <tr class=\"admin_table_head\">
								 <th>ID</th>
								 <th>image</th>
								 <th>Name</th>
								 <th>CPU</th>
								 <th>".$this->controller->t('Graphic Card')."</th>
								 <th>HDD|SSD</th>
								 <th>RAM</th>
								 <th>".$this->controller->t('Connections')."</th>
								 <th>".$this->controller->t('Type')."</th>
								 <th>".$this->controller->t('Price')."</th>
								 <th>".$this->controller->t('Settings')."</th>
						 </tr>";
             ?>

	<h3><?php echo $this->controller->t('Products'); ?></h3>
	<?php if(empty($products)){
    echo "Empty";
}
   else{
	foreach($products as $product){
  		$id = $product->getId();
			$img = "assets/images/".$product->getImage();
			$price = $product->getPrice();
			$name = $product->getName();
			$type =$product->getType();
			$cpu = $product->getCpu();
			$graphic= $product->getGraphic();
			$connections = $product->getConnections();
			$ram = $product->getRam();
			$hddssd = $product->getHddSsd();
				 echo "
									<tr>
											<th>$id</th>
											<th><img src ='$img' width=10%</th>
											<th>$name</th>
											<th>$cpu</th>
											<th>$graphic</th>
											<th>$hddssd</th>
											<th>$ram</th>
											<th>$connections</th>
											<th>$type</th>
											<th>$price</th>
											<th class=\"settings\"><button><a class=\"settings_edit\" href=\"index.php?action=edit_product&id=$id\">".$this->controller->t('Edit')."</a></button><br><button><a class=\"settings_delete\" href=\"index.php?action=delete_product&id=$id\">".$this->controller->t('Delete')."</a></button></th>
								 </tr>";
}
               }?>
	</table>
</div>
