<!-- <nav class="side-nav">
  <ul>
    <li class="selected"><a href="#">Neighborhoods</a></li>
    <li><a href="#">Parks</a></li>
    <li><a href="#">Playgrounds</a></li>
    <li><a href="#">Splash Parks</a></li>
    <li><a href="#">Roof Gardens</a></li>
    <li><a href="#">Institutions/Commercial</a></li>
  </ul>
</nav> -->

<nav class="side-nav">
  <ul id="subcategories">
    <?php foreach ( $results['subcategories'] as $subcategory ) { ?>
      <li class="subcategory">
        <a id="<?php echo $subcategory->id?>" href="#">
          <p><?php echo htmlspecialchars($subcategory->name); ?></p>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>
