<?php
class Request {

	private $parameters;
/*
	public function __construct() {
		$this->parameters = array_merge($_GET, $_POST);
	}
*/
public function __construct() {
        if (isset($_GET['lang'])){
            $this->parameters = array_merge($_GET, $_POST);
        } else if($_COOKIE['lang']) {
                    $langSet = ['lang' => $_COOKIE['lang']];
                    $this->parameters = array_merge($_GET, $_POST, $langSet);
        } else {
            $this->parameters = array_merge($_GET, $_POST);
        }

    }

	public function isParameter($param) {
		return isset($this->parameters[$param]);
	}

	public function getParameter($param, $default='') {
		if (!$this->isParameter($param)) {
			return $default;
		} else {
			return $this->parameters[$param];
		}
	}
}
