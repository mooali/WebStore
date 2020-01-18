<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $title ?></title>
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
            /*$(document).fadeOut(500, function(){
                  $(this).empty().append(response).fadeIn(500);
              });*/
              var content = $($.parseHTML(response));
              console.log(content);
              $("#total_price1").text(content.find("#total_price").val());
              $("#total_price2").text(content.find("#total_price").val());


            },
            error: function() {
              console.log("Uppppsssss....");
            }
          });
        });
        $(".updateCart").bind('keyup mouseup',function(){
          $(this).closest("form").submit();
        });
        $("[type='number']").keypress(function (evt) {
          evt.preventDefault();
        });
        $("#reset").click(function () {
          console.log("test");
          $(".form_container_input").val('');
        });
        $(document).ready(function () {
           setTimeout(function() {
               $('#error').slideUp("slow");
           }, 5000);});

           $(document).each(function () {
              setTimeout(function() {
                  $('#welcome-msg').slideUp("slow");
              }, 5000);});
      });

    </script>
  </head>
  <body>
    <div id="page-container">
      <div id="content-wrap">
    <header>
      <div class="header_languages">
        <nav>
                  <ul>
                    <li><a href="index.php?lang=en">EN</a></li>
                    <li><a href="index.php?lang=de">DE</a></li>
                  </ul>
                </nav>
      </div>
      <div class="header_menu">
        <nav>
          <ul>
            <li> <a href="index.php?action=home">Home</a> </li>
            <li> <a href="index.php?action=products"><?php echo $this->controller->t('Products'); ?></a></li>
            <?php if($this->controller->isAdmin()) echo "<li> <a href=\"index.php?action=admin\">Admin</a></li>"; ?>
            <?php if (!$this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=login\">".$this->controller->t('Login')."</a></li>"; ?>
            <?php if ($this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=logout\">".$this->controller->t('Logout')."</a></li>"; ?>
            <li> <a href="index.php?action=agb" target="_blank">AGB</a> </li>
            <li> <a href="index.php?action=shoppingCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a><?php
            if (!isset($_SESSION['cart'])) {$_SESSION['cart'] = new Cart();}
            $cart = $_SESSION['cart'];
            echo "<span id=\"total_price2\">".$cart->getTotal()."</span>";
            ?></li>
            <?php
            if($this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=edit_user_self\"><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i></a></li>";
             ?>
          </ul>
        </nav>
      </div>
    </header>
      <main>
        <?php include $innerTpl; ?>
      </main>
    </div>
    <footer id="footer">
        <p>
          &copy; 2019
          <a href="https://github.com/mooali" target="_blank">Mohammed Ali</a>
          <a href="https://github.com/macivo" target="_blank">& Mac Müller</a>
          </p>
        </footer>
      </div>
  </body>
</html>
