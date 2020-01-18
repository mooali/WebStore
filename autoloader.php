<?php

//this file was taken from ->  BTI7054 Topic 11 - MVC
 //i haven't changed that much on it

function __autoload($class_name){

	// Directories to look in
	$dirs = [
		'lib/',
		'controller/',
		'model/',
		'view/'
	];

	// Try to load class
	foreach($dirs as $dir) {
		$file = __DIR__."/$dir$class_name.class.php";
		if(file_exists($file)) {
			require_once($file);
			break;
		}
	}
}
