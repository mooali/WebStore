

 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script>
   $(function(){
     $('.formCart').submit(function(e){
       e.preventDefault();
       //AJAX
       $.ajax({
         url: 'index.php?action=shoppingCart',
         type: 'POST',
         data: $(this).serialize(),
         success: function(response) {
           /*$('#cart-holder').fadeOut(500, function(){
               $(this).empty().append(response).fadeIn(500);
           });*/

           console.log(response);
         },
         error: function() {
           console.log("Uppppsssss....");
         }
       });
     });
     $(".updateCart").bind('keyup mouseup',function(){
       $(this).closest("form").submit();
     });
   });

 </script>

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
    <?php
    if($this->controller->isAdmin()) {
      echo "he is admin";
    } else {
      echo "you are a user or not logged in";
    }?>
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
            <?php if($this->controller->isAdmin()) echo "<li> <a href=\"index.php?action=list_users\">Users</a></li>"; ?>
            <?php if (!$this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=login\">Login</a></li>"; ?>
            <?php if ($this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=logout\">Logout</a></li>"; ?>
            <li> <a href="index.php?action=agb" target="_blank">AGB</a> </li>
            <li> <a href="index.php?action=shoppingCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> </li>
            <?php if($this->controller->isLoggedIn()) echo "<li><a href=\"index.php?edit_user.php\"><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i></a></li>"; ?>
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
