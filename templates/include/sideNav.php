
<nav id="portfolioSecondaryMenu" class="secondaryMenu side-nav">
  <ul>
    <?php
    $index = 0;
    foreach ($results['menuData'] as $subcategory) { ?>
      <li>
        <a id="<?php echo $subcategory->id?>" href="?action=portfolioSubCat&amp;id=<?php echo $subcategory->id ?>&amp;category=<?php echo $subcategory->mainCategory ?>&amp;index=<?php echo $index ?>"><?php echo htmlspecialchars($subcategory->name) ?></a>
      </li>
<?php
++$index;
 } ?>
  </ul>
</nav>
