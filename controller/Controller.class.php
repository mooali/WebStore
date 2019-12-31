<?php

class Controller {

	private $data = array();
	private $title = '';

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
			$user = User::checkCredentials($login, $pwd);
			if ($user == null) {
				$this->data["message"] = "User name or password are not correct!";
				return;
			}
			$this->startSession();
			$_SESSION['user'] = $login;
			$_SESSION['type'] = $user->getType();
			$this->data["message"] = "Hi " . ucfirst($login) . " you just logged in!";
			return 'home';
		}





	public function logout(Request $request) {
		$this->startSession();
		session_destroy();
		unset($_SESSION['user']);
		$_SESSION = array();
		$this->data["message"] = "Und Tschüsss!";
		return 'home';
	}



	public function edit_product(Request $request) {

		$id = $request->getParameter('id', 0);
		$product = Product::getProductById($id);
		if (!$product) {
			return $this->page404();
		}
		$this->data["product"] = $product;
		$this->title = $product->getName_de();
	}


	public function display_product(Request $request) {

		$id = $request->getParameter('id', 0);
		$product = Product::getProductById($id);
		if (!$product) {
			return $this->page404();
		}
		$this->data["product"] = $product;
		$this->title = $product->getName_de();
	}


	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}

// Mo
	public function products(){
		$this->title = "Products";
		$this->data["products"] = Product::getAllProducts();

	}

	public function notebooks(){
		$this->title = "Notebooks";
		$this->date["notebooks"] = Product::getNotebook();
	}


	public function delete_product(Request $request){

			$id = $request->getParameter('id',0);
			$product = Product::delete($id);
			if (!$product) {
				return $this->page404();
			}
			$this->data["message"] = "Product deleted successfully!";

			return $this->externalRedirect('index.php?action=products');

			//return $this->internalRedirect('products', $request);
	}



	//Edit products
	public function update_product(Request $request) {
		$this->title = "Edit Product";

		if (!$this->isLoggedIn()) {
			$this->data["message"] = "Please login to update a product!";
			return 'login';
		}
		$values = $request->getParameter('product', array());
		$product = Product::getProductById($values['id']);
		if (!$product) {
			return $this->page404();
		}
		$product->update($values);
		$product->save();
		$this->data["message"] = "products updated successfully!";

		//$this->externalRedirect('index.php?action=list_students');

		return $this->internalRedirect('products', $request);
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
		else if(!$nameExist){
			$this->data["message"] ="Username is already exist!";
			return 'register';
			exit();
		}
		else if($emailExist){
			$this->data["message"] = "Email is already exist!";
			return 'register';
			exit();
		}
		 else if(!$validEmail){
			$this->data["message"] ="invalid email";
			return 'register';
			exit();
		} /*else if(!$validpwd){
			$this->data["message"] ="Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
			return 'register';
			exit();
		}*/
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
			$sort = $request->getParameter('sort', 'id');
			$this->data["users"] = User::getUser($sort);
	}




	public function edit_user(Request $request)
	{
			$id = $request->getParameter('id', 0);
			$user = User::getUserById($id);
			if (!$user) {
					return $this->page404();
			}
			$this->data['user'] = $user;
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


	public function agb(){
		$this->title = "AGB";

	}
/////////////////////////////////////////////
//CART


public function shoppingCart(){
	$this->startSession();

	return "shopping_cart";
}

public function delete_item(Request $request)
{
		$id = $request->getParameter('id', 0);
		$product = Product::getProductById($id);
		if (!$user) {
				return $this->page404();
		}
		$product = item::removeItem($id);
		//external redirect
		header('Location: index.php?action=list_users');
		exit();
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
}
