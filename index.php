<?php
	// F R O N T   C O N T R O L L E R
	//this index is similar to the one in  BTI7054 Topic 11 - MVC
	//some changes were made on it
	require_once 'autoloader.php';

	$request = new Request();
	//$action = isset($_GET['action']) ? $_GET['action'] : 'home';
	$action = $request->getParameter('action', 'home');
	$lang = $request->getParameter('lang', 'en');


	// Inizialize model
	if (!DB::create('localhost', 'root', 'bratwurst', 'momac')) {
		die("Unable to connect to database [".DB::getInstance()->connect_error."]");
	}

	try {
		// Create controller
		$controller = new Controller();
		$tpl = $controller->$action($request);
		$tpl = $tpl ? $tpl : $action;
		//languages
		$controller->gen_lang();
		$langSet = $controller->$lang($request);
    $langSet = $langSet ? $langSet : $lang;

		// Create view
		$view = new View($controller);
		$view->render($tpl);
	} catch (Exception $e) {
		die("<h2>There was an ERROR!</h2><p>There was an error processing action '$action'!</p><code> -> ".$e->getMessage()."</code>");
	}
