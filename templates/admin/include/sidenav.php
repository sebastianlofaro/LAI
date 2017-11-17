<nav class="side-nav">
  <ul id="adminSubcategories">
    <li id="newSubCatWrapper">
      <input id="newSubCat" class="newSubCat" type="text" name="" value="" placeholder="new subcategory" style="display: block">
      <button id="newSubCatBtn" type="button" name="0">+</button>
    </li>
    <?php $index = 0;
    // var_dump($results);
    ?>
    <?php foreach ( $results['menuData'] as $subcategory ) { ?>
      <li class="subcategory">
        <a class="hover-lightblue <?php if($index == $subCatIndex)  echo 'selected-secondary'; ?>" id="<?php echo $subcategory->id ?>" href="?action=portfolioSubCat&amp;id=<?php echo $subcategory->id ?>&amp;index=<?php echo $index ?>">
          <p><?php echo str_replace(" ", "&nbsp;", htmlspecialchars($subcategory->name)); ?></p>
        </a>
      </li>
    <?php
    $index += 1;
    } ?>

  </ul>
</nav>
