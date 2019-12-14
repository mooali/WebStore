<?php
class Request {

	private $parameters;

	public function __construct() {
		$this->parameters = array_merge($_GET, $_POST);
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
