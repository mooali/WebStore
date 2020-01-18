<?php
//this file is similar to the one in  BTI7054 Topic 11 - MVC
//some changes were made on it

	// Returns a certain GET parameter or $default if the parameter
	// does not exist.
	function get_param($name, $default) {
		if (isset($_GET[$name]))
			return urldecode($_GET[$name]);
		else
			return $default;
	}

	// Adds a GET parameter to the url. The url is passed by reference.
	function add_param(&$url, $name, $value) {
		$sep = strpos($url, '?') !== false ? '&' : '?';
		$url .= $sep . $name . "=" . urlencode($value);
		return $url;
	}

	// Renders the page content for a certain page ID.
	function render_content($pageId) {
		echo t('content') . " $pageId";
	}

	// Renders the navigation for the passed language and page ID.
	function render_navigation($language, $pageId) {
		$urlBase = $_SERVER['PHP_SELF'];
		add_param($urlBase, "lang", $language);
		$navs = array('home', 'products', 'login', 'agb');
		foreach($navs as $nav) {
			$url = $urlBase;
			add_param($url, "id", $nav);
			$class = $pageId == $nav ? 'active' : 'inactive';
			echo "<a class=\"$class\" href=\"$url\">".t($nav)."</a>";
		}
	}
	// Renders the language navigation.
	function render_languages($language, $pageId) {
		$languages = array('de', 'fr', 'en');
		$urlBase = $_SERVER['PHP_SELF'];
		add_param($urlBase, 'id', $pageId);
		foreach ($languages as $lang) {
			$url = $urlBase;
			$class = $language == $lang ? 'active' : 'inactive';
			echo "<a class=\"$class\" href=\"".add_param($url,'lang', $lang)."\">".strtoupper($lang)."</a>";
		}
	}

	// The translation function.
	function t($key) {
		global $messages;
		if (isset($messages[$key])) {
			return $messages[$key];
		} else {
			return "[$key]";
		}
	}

	// Set langauage and page ID as global variables.
	$language = get_param('lang', 'de');
	$pageId = get_param('id', 'home');

	$messages = array();
	$file = file("messages/messages_$language.txt");
	foreach($file as $line) {
		//$keyval = explode('=', $line);
		//$messages[$keyval[0]] = $keyval[1];

		list($key, $val) = explode('=', $line);
		$messages[$key] = $val;
	}
