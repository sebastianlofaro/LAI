<?php require("includes/header.php") ?>
  <div class="viewProduct container">

    <h1><?php echo $data->name ?></h1>
    <img src="<?php echo (IMAGE_PATH . $data->imagePath) ?>" alt="">
    <p><?php echo $data->description ?></p>
    <p><?php echo $data->price ?></p>
    <input id="quantity" type="number" name="quantity" min="1" max="500">
    <button id="<?php echo $data->id ?>" class="addToCartButton" type="button" name="addToCart">Add To Cart</button>




  </div>
<?php include("includes/footer.php") ?>
