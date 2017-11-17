<?php include "templates/include/header.php" ?>
<section class="portfolio main-content">
  <div class="jumbotron">
    <div class="jumbotronImage"></div>
    <div class="jumbotronMessage">
      <div class="">
        <h1><?php echo $results['menuData'][(int)$titleIndex]->name; ?></h1>
        <div class="greenUnderline"></div>
      </div>
    </div>
  </div>
  <?php include "include/sideNav.php" ?>
  <!-- <div class="shadowTop"></div> -->
  <div class="content-wrapper">
    <div class="content">
      <ul class="articles">
        <?php foreach ( $results['articles'] as $article ) { ?>
                <li>
                  <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>&amp;index=<?php echo $titleIndex?>" >
                    <div class="thumbnail">
                      <div class="imagesPackage" style="display: none"><?php echo $article->imagePath ?></div>
                    </div>
                    <p><?php echo htmlspecialchars($article->title); ?></p>
                  </a>
                </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</section>
<?php include "templates/include/footer.php" ?>
