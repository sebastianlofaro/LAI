<nav class="side-nav">
  <ul id="adminSubcategories">
    <li id="newSubCatWrapper">
      <input id="newSubCat" type="text" name="" value="" placeholder="new subcategory" style="display: block">
      <button id="newSubCatBtn" type="button" name="button">+</button>
    </li>
    <?php foreach ( $results['subcategories'] as $subcategory ) { ?>
      <li class="subcategory">
        <a id="<?php echo $subcategory->id?>" href="#">
          <p><?php echo htmlspecialchars($subcategory->name); ?></p>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>
