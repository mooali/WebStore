<?php
$lang = isset($_COOKIE['lang'])? $_COOKIE['lang']: en;
$fn = $_SERVER["DOCUMENT_ROOT"].'/shop/assets/messages/agb_'.$lang.'.txt';
$file = file($fn);
echo '<div class="agb">';
foreach($file as $line) {
    echo $line.'<br>';
}
echo '</div>';
 ?>
