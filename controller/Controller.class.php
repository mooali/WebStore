<?php

class Controller {

	private $data = array();
	private $title = '';

	// A C T I O N S

	public function home(Request $request) {
		$this->data["message"] = "Hello World!";
		$this->title = "Home";
	}

	public function contact(Request $request) {
		//
		$this->title = "Contact";
	}

	public function login(Request $request) {
		$login = $request->getParameter('login', '');
		$pw = $request->getParameter('pw', '');
		if (!User::checkCredentials($login, $pw)) {
			$this->data["message"] = "Upps das passt nicht ganz....";
			return;
		}
		$this->startSession();
		$_SESSION['user'] = $login;
		$this->data["message"] = "Hi " . ucfirst($login) . " you just logged in!";
		return 'home';
	}

	public function logout(Request $request) {
		$this->startSession();
		session_destroy();
		$_SESSION = array();
		$this->data["message"] = "Und Tschüsss!";
		return 'home';
	}

	public function list_students(Request $request) {
		//$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
		$sort = $request->getParameter('sort', 'id');
		$this->data["students"] = Student::getStudents($sort);


	}

	public function edit_product(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data["message"] = "Please login to edit a student!";
			return 'login';
		}

		$id = $request->getParameter('id', 0);
		$student = Student::getStudentById($id);
		if (!$student) {
			return $this->page404();
		}
		$this->data["student"] = $student;
		$this->data["projects"] = Project::getProjects();

		$this->title = $student->getLastname();;
	}

	public function update_student(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data["message"] = "Please login to update a student!";
			return 'login';
		}

		$values = $request->getParameter('student', array());
		$student = Student::getStudentById($values['id']);
		if (!$student) {
			return $this->page404();
		}
		$student->update($values);
		$student->save();
		$this->data["message"] = "Student updated successfully!";

		return $this->externalRedirect('index.php?action=products');

		//return $this->internalRedirect('list_students', $request);

	}

	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}

// Mo
	public function products(){

		$this->data["products"] = Product::getAllProducts();

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

	public function update_product(Request $request) {
		if (!$this->isLoggedIn()) {
			$this->data["message"] = "Please login to update a student!";
			return 'login';
		}

		$values = $request->getParameter('product', array());
		$student = Product::getStudentById($values['id']);
		if (!$product) {
			return $this->page404();
		}
		$product->update($values);
		$product->save();
		$this->data["message"] = "products updated successfully!";

		//$this->externalRedirect('index.php?action=list_students');

		return $this->internalRedirect('list_students', $request);

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
