
<?php require("includes/header.php") ?>
  <div class="container">
    <div class="coverImage"></div>
    <nav>
      <img class="logo" src="media/img/txsLogo.png" alt="">
      <ul>
        <li><a href=".?action=home">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </nav>
    <div class="wrapper">
      <button id="testSession" type="button" name="button">TEST SHIT</button>
      <ul class="products">
        <?php foreach ( $data as $product ) { ?>
          <li class="item">
            <a href=index.php?action=viewProduct&amp;productID=<?php echo $product->id?>>
              <div class="thumbnail" style="background-image: url('<?php echo (IMAGE_PATH . $product->imagePath) ?>')"></div>
              <p><?php echo htmlspecialchars($product->name); ?></p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
<?php include("includes/footer.php") ?>
