<?php
	require_once('lib/functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Webshop</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav><span>Navigation</span>
		<?php render_navigation($language, $pageId); ?>
		<div id="languages"><?php render_languages($language, $pageId); ?></div>
	</nav>
	<main>
		<span>Main Area</span>
		<?php
			$fn = "pages/$pageId.php";
			if (is_file($fn)) {
				include($fn);
			} else {
				echo "Not yet implemented... Coming soon... sorry!";
			}

			//render_content($pageId);

		?>
	</main>
</body>
</html>
