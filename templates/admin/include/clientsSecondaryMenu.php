<nav class="side-nav">
  <ul id="adminClientSubcategories">
    <li class="newSubCatWrapper">
      <input class="newSubCat" type="text" name="" value="" placeholder="new subcategory" style="display: block">
      <button class="newSubCatBtn" type="button" name="button">+</button>
    </li>
    <?php
    $index = 0;
     foreach ($results['menuData'] as $subcategory) { ?>
      <li class="subcategory">
        <a id="<?php echo $subcategory->id ?>" href="?action=clientsSubCat&amp;id=<?php echo $subcategory->id ?>&amp;category=<?php echo $subcategory->mainCategory ?>&amp;index=<?php echo $index ?>">
          <p><?php echo htmlspecialchars($subcategory->name); ?></p>
        </a>
      </li>
  <?php
  ++$index;
  } ?>
  </ul>
</nav>
