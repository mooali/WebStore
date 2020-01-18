<div class="products">
  <h3><?php echo $this->controller->t('Products'); ?></h3>
<div class="products_flex_home">
  <div id="welcome-msg">
    <?php echo isset($message) ? "<h3>".$this->controller->t($message)."</h3>" : ""; ?>
  </div>
    <div class="products_wrapper_home">
        <a href="index.php?action=smartphones"><img src="assets/images/onePlus7.png" alt="handy" title="Smartphones"></a>
    </div>
    <div class="products_wrapper_home">
    <a href="index.php?action=notebooks"> <img src="assets/images/notebook.jpg" alt="notebook" title="Notebooks"></a>
  </div>
</div>
</div>
