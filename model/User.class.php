<?php 
class User {
	
	private static $users = ['admin' => '123'];
	
	public static function checkCredentials($login, $pw) {
		return isset(self::$users[$login]) && self::$users[$login] == $pw;
	}
}

