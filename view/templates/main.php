<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $title ?></title>
  </head>
  <body>
    <header>
      <div class="header_languages">
        <nav>
          <ul>
            <li>EN</li>
            <li>FR</li>
            <li>DE</li>
          </ul>
        </nav>
      </div>
      <div class="header_menu">
        <nav>
          <ul>
            <li> <a href="index.php?action=home">Home</a> </li>
            <li> <a href="index.php?action=products">Products</a></li>
            <li> <a href="index.php?action=agb" target="_blank">AGB</a> </li>
            <?php if (!$this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=login\">Login</a></li>"; ?>
            <?php if ($this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=logout\">Logout</a></li>"; ?>
          </ul>
        </nav>
      </div>
    </header>
    <main>
      <?php include $innerTpl; ?>
    </main>

    <footer>
        <p>
          &copy; 2019
          <a href="https://github.com/mooali" target="_blank">Mohammed Ali</a>
          </p>
        </footer>
  </body>
</html>
