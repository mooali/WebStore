<?php
class Controller {

	private $data = array();
	private $title = '';
	public $lang = '';
	public $trans = array();

	// A C T I O N S
	public function home(Request $request) {
		$this->title = "Home";
	}

	public function contact(Request $request) {
		//
		$this->title = "Contact";
	}

	public function login(Request $request)
	{
			$login = $request->getParameter('name', '');
			$pwd= $request->getParameter('password', '');
			$validName = User::checkName($login);
			$validpwd= User::checkPassword($pwd);
			if(empty($login) && empty($pwd)){
				$this->data["message"] = "";
			}else{
				$user = User::checkCredentials($login, $pwd);
				if ($user == null) {
					$this->data["message"] = "User name or password is not correct!";
					return;
			}
			$this->startSession();
			$_SESSION['user'] = $login;
			$_SESSION['type'] = $user->getType();
			$_SESSION['id'] = $user->getId();
			$this->data["message"] = "Hi " . ucfirst($login) . " you just logged in!";
			return 'home';
		}

}



	public function logout(Request $request) {
		$this->startSession();
		session_destroy();
		unset($_SESSION['user']);
		$_SESSION = array();
		$this->data["message"] = "Und Tschüsss!";
		return 'home';
	}




	public function display_product(Request $request) {

		$id = $request->getParameter('id', 0);
		$product = Product::getProductById($id);
		if (!$product) {
			return $this->page404();
		}
		$this->data["product"] = $product;
		$this->title = $product->getName();
	}


	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}

// Mo
	public function products(){
		$this->title = "Products";
		$this->data["products"] = Product::getAllProducts();

	}
	public function list_products_admin(){
		if($this->isAdmin()){
		$this->title = "Products";
		$this->data["products"] = Product::getAllProducts();
	}else{
		return 'login';
	}
	}

		public function list_orders(){
			if($this->isAdmin()){
		$this->title = "Orders";
		$this->data["orders"] = Order::getAllProducts();
	}else{
		return 'login';
	}
}

	public function notebooks(){
		$this->title = "Notebooks";
		$this->data["notebooks"] = Product::getNotebook();
	}

	public function smartphones(){
		$this->title = "Smartphones";
		$this->data["smartphones"] = Product::getSmartphones();
	}


	public function delete_product(Request $request){

			$id = $request->getParameter('id',0);
			$product = Product::delete($id);
			if (!$product) {
				return $this->page404();
			}
			$this->data["message"] = "Product deleted successfully!";

			return $this->externalRedirect('index.php?action=list_products_admin');

			//return $this->internalRedirect('products', $request);
	}


	public function edit_product(Request $request) {

		$id = $request->getParameter('id', 0);
		$product = Product::getProductById($id);
		if (!$product) {
			return $this->page404();
		}
		$this->data["product"] = $product;
	}



	//Edit products
	public function update_product(Request $request) {
		$values = $request->getParameter('product', array());
		$product = Product::getProductById($values['id']);
		if (!$product) {
			return $this->page404();
		}
		$product->update($values);
		$product->save();
		$this->data["message"] = "products updated successfully!";

		//$this->externalRedirect('index.php?action=list_students');

		return $this->internalRedirect('list_products_admin', $request);
	}



	public function signupUser(Request $request){
		$values = $request->getParameter('user', array());
		$username = $values['username'];
		$email = $values['email'];
		$password = $values['pwd'];
		$rePassowrd = $values['re-pwd'];
		$validName = User::checkName($username);
		$validEmail= User::checkEmail($email);
		$validpwd= User::checkPassword($password);
		$nameExist= User::nameExist($username);
		$emailExist= User::emailExist($email);

		if(empty($username) || empty($email) || empty($password) || empty($rePassowrd)){
			//header("Location: ../register.php?error=emptyFields&username=".$values['username']."&email=".$values['email']);
			$this->data["message"] = "All fields must be filled!";
			return 'register';
			exit();
		} else if(!$validName){
			$this->data["message"] = "wrong name";
			return 'register';
			exit();
		}
		else if($nameExist){
			$this->data["message"] ="Username is already exist!";
			return 'register';
			exit();
		}
		else if($emailExist){
			$this->data["message"] ="E-Mail is already exist!";
			return 'register';
			exit();
		}
		 else if(!$validEmail){
			$this->data["message"] ="invalid email";
			return 'register';
			exit();
		} else if(!$validpwd){
			$this->data["message"] ="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
			return 'register';
			exit();
		}
			else if($password != $rePassowrd){
			$this->data["message"] ="passwords dosent match";
			return 'register';
			exit();
		} else{
				$user = User::insert($values);
				if (!$user) {
						return $this->page404();
				 }

		$this->data['message'] = "User created successfully!";
		return 'home';
	}
}






	public function register(Request $request) {
		$this->title = "signup";
	}

	public function addProduct(Request $request) {
		$this->title = "Product";
	}


	public function delete_user(Request $request)
	{
			$id = $request->getParameter('id', 0);
			$user = User::getUserById($id);
			if (!$user) {
					return $this->page404();
			}
			$user = User::delete($id);
			//external redirect
			header('Location: index.php?action=list_users');
			exit();
	}


	public function delete_order(Request $request)
	{
			if($this->isAdmin()){
			$id = $request->getParameter('id', 0);
			$order = Order::getOrderById($id);
			if (!$order) {
					return $this->page404();
			}
			$order = Order::delete($id);
			//external redirect
			header('Location: index.php?action=list_orders');
			exit();
		}else{
			return 'login';
		}
	}



/*	public function user_Profile(Request $request)
{
		if (!$this->isLoggedIn()) {
				$this->data['message'] = "To update a User, please login first!";
				return 'login';
		}
		$this->title = "Profile";
		$this->data["message"] = "Hello World!";
}
*/



public function isAdmin()
{
		$this->startSession();
		if(!isset($_SESSION['type'])){
				return false;
		} else{
				return $_SESSION['type']=='admin';
		}
}






	public function list_users(Request $request)
	{
			if($this->isAdmin()){
			$sort = $request->getParameter('sort', 'id');
			$this->data["users"] = User::getUser($sort);
	}else{
		return 'login';
	}
}




	public function edit_user(Request $request)
	{
			if($this->isAdmin()){
			$id = $request->getParameter('id', 0);
			$user = User::getUserById($id);
			if (!$user) {
					return $this->page404();
			}
			$this->data['user'] = $user;
		}else{
		return 'login';
}
	}


	public function edit_user_self(Request $request)
	{
		if($this->isLoggedIn()){
		$this->startSession();
		$id = $_SESSION['id'];
		$user = User::getUserById($id);
		if (!$user) {
				return $this->page404();
		}
		$this->data['user'] = $user;
	}
		else {
			return 'login';
		}
	}


	public function update_user_self(Request $request)
{
		/* if (!$this->isAdmin()) {
				 $this->data['message'] = "To update a User, please login first!";
				 return 'login';
		 }*/
		$values = $request->getParameter('user', array());
		$user = User::getUserById($values['id']);
		$username = $values['username'];
		$email = $values['email'];
		$newEmail = $values['email'];
		$password = $values['pwd'];
		$rePassowrd = $values['re-pwd'];
		$validEmail= User::checkEmail($email);
		$validName = User::checkName($username);
		$validpwd= User::checkPassword($password);
		$emailExist= User::emailExist($email);
		$nameExist= User::nameExist($username);
		$oldEmail = $user->getEmail();
		$oldName = $user->getUsername();

		if(empty($username) || empty($email) || empty($password) || empty($rePassowrd)){
			//header("Location: ../register.php?error=emptyFields&username=".$values['username']."&email=".$values['email']);
			$this->data["message"] = "All fields must be filled!";
			return $this->internalRedirect('edit_user_self', $request);
			exit();
		}
	else if(!$validName){
		$this->data["message"] = "wrong name";
		return $this->internalRedirect('edit_user_self', $request);
		exit();
	}
		 else if(!$validEmail){
			$this->data["message"] ="invalid email";
			return $this->internalRedirect('edit_user_self', $request);
			exit();
		} /*else if(!$validpwd){
			$this->data["message"] ="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
			return 'register';
			exit();
		}*/
			else if($password != $rePassowrd){
			$this->data["message"] ="passwords dosent match";
			return $this->internalRedirect('edit_user_self', $request);
			exit();
		}
		else if (!$user) {
				return $this->page404();
		} else{

		$user->update($values);
		$user->save();
		$this->data['message'] = "User updated successfully!";
		//return 'list_students';
		// external redirect
		//header('Location: index.php?action=list_students');
		//exit();
		//internal page redirect
		return $this->internalRedirect('edit_user_self', $request);
}
}






	public function update_user(Request $request)
{
		/* if (!$this->isAdmin()) {
				 $this->data['message'] = "To update a User, please login first!";
				 return 'login';
		 }*/
		$values = $request->getParameter('user', array());
		$user = User::getUserById($values['id']);
		if (!$user) {
				return $this->page404();
		}
		$user->update($values);
		$user->save();
		$this->data['message'] = "User updated successfully!";
		//return 'list_students';
		// external redirect
		//header('Location: index.php?action=list_students');
		//exit();
		//internal page redirect
		return $this->internalRedirect('list_users', $request);
}

public function admin(){
	if (!$this->isAdmin()) {
			 $this->data['message'] = "please login first!";
			 return 'login';
	 }
	$this->title = "Admin";

}

public function insert_product(){
	if($this->isAdmin()){
	$this->title = "Product";
	}else{
		return 'login';
	}
}


	public function agb(){
		$this->title = "AGB";

	}
/////////////////////////////////////////////
//CART


public function shoppingCart(){
	$this->startSession();

	return "shopping_cart";
}

public function order(){
	if($this->isLoggedIn()){
		$this->startSession();
		return "order";
	}else{
	return "Login";
	}
}

public function place_order(Request $request){
	$values = $request->getParameter('order', array());
	$firsntname = $values['firstname'];
	$lasatname = $values['lastname'];
	$email = $values['email'];
	$street = $values['street'];
	$plz = $values['plz'];
	$city = $values['city'];
	$phonenumber = $values['phonenumber'];
	$products = $values['products'];
	$price = $values['total'];
	$order = Order::insert_order($values);
	if (!$order) {
			return $this->page404();
	 }
	 	 return $this->externalRedirect('index.php?action=orderConform');
}


public function orderConform(){
	return 'order_conformation';
}


public function add_product(Request $request){
	$values = $request->getParameter('product', array());
	$name = $values['name'];
	$cpu = $values['cpu'];
	$graphic = $values['graphic'];
  $hddssd = $values['hddssd'];
  $ram = $values['ram'];
  $connections = $values['connections'];
  $type = $values['type'];
  $image =$values['image'];
  $price = $values['price'];
	$product = Product::insert_product($values);
	if (!$product) {
			return $this->page404();
	 }
	 return 'admin';

}

public function sendMail(Request $request){
	$id= $request->getParameter("send",array());
	$val = $id['id'];
	$order = Order::sendEmail($val);
	if(!$order){
	return $this->page404();
}
return 'home';
}


public function insert_order(Request $request){
	$values = $request->getParameter('product', array());
	$firsntname = $values['address_id'];
	$lasatname = $values['lastname'];
	$email = $values['email'];
	$street = $values['street'];
	$plz = $values['plz'];
	$city = $values['city'];
	$phonenumber = $values['phonenumber'];
	$order = Order::insert_address($values);
	if (!$order) {
			return $this->page404();
	 }
	 $id = $_SESSION['id'];
	 $send = Cart::sendEmail($id);
	 return 'home';

}



public function delete_item(Request $request)
{
		$values = $request->getParameter('delete', array());
		$id = $values['order_id'];
		$amount = $values['amount'];
		$product = Product::getProductById($id);
		if (!$product) {
				return $this->page404();
		}
		$this->startSession();
		$cart = $_SESSION['cart'];
		$cart->removeItem($id, $amount);
		//external redirect
		return "shopping_cart";
}








	// H E L P E R S

	public function &getData() {
		return $this->data;
	}

	public function isLoggedIn() {
		$this->startSession();
		return isset($_SESSION['user']);
	}

	public function getTitle() {
		return $this->title;
	}




	// P R I V A T E  H E L P E R S

	private function page404() {
		header("HTTP/1.1 404 Not Found");
		return 'page404';
	}

	private function internalRedirect($action, $request) {
		$tpl = $this->$action($request);
		return $tpl ? $tpl : $action;
	}

	private function externalRedirect($url) {
		header("HTTP/1.1 302 Temp redirect");
		header('Location: ' . $url);
		exit();
	}

	private $sessionState = false;
	private function startSession() {
		if (!$this->sessionState) {
			$this->sessionState = session_start();
		}
	}
	public function de(Request $request){
	        $this->lang = "de";
	        setcookie("lang","de",time()+60602430);
	        $this->internalRedirect('home', $request);
	    }

	    public function en(Request $request){
	        $this->lang = "en";
	        setcookie("lang","en",time()+60602430);
	        $this->internalRedirect('home', $request);
	    }


	    public function t($key) {
	    $this->gen_lang();
	    if ($this->lang == 'de' && isset($this->trans[$key])) {
	      return $this->trans[$key];
	    } else {
	      return "$key";
	    }
	  }

	    public function gen_lang(){
	//    $langNow = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : $this->lang;
	        $fn = $_SERVER["DOCUMENT_ROOT"].'/shop2/assets/messages/lang_de.txt';
	        $file = file($fn);
	        foreach($file as $line) {
	            list($key, $val) = explode('=', $line);
	            $this->trans[$key] = $val;
	        }
	    }

}

/////////////lanuage
