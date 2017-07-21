<?php include "templates/include/header.php" ?>
<section class="main-content">
  <nav class="side-nav">
    <ul>
      <li class="selected"><a href="#">Neighborhoods</a></li>
      <li><a href="#">Parks</a></li>
      <li><a href="#">Playgrounds</a></li>
      <li><a href="#">Splash Parks</a></li>
      <li><a href="#">Roof Gardens</a></li>
      <li><a href="#">Institutions/Commercial</a></li>
    </ul>
  </nav>
  <div class="content-wrapper">
    <h1>Neighborhoods</h1>
    <div class="content">
      <ul class="articles">
        <?php foreach ( $results['articles'] as $article ) { ?>
                <li>
                  <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>">
                    <div class="thumbnail" style="background-image: url('<?php echo $article->imagePath ?>')"></div>
                    <!-- <img src="<?php echo $article->imagePath ?>" alt=''> -->
                    <?php echo htmlspecialchars($article->title); ?>
                  </a>
                </li>
        <?php } ?>

      </ul>
    </div>
  </div>
</section>
<?php include "templates/include/footer.php" ?>
