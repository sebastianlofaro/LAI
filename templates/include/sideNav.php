
<nav id="portfolioSecondaryMenu" class="secondaryMenu side-nav">
  <ul>
    <?php foreach ($results['subcategories'] as $subcategory) { ?>
      <li>
        <a id="<?php echo $subcategory->id?>" href="#"><?php echo htmlspecialchars($subcategory->name) ?></a>
      </li>
<?php } ?>
  </ul>
</nav>
