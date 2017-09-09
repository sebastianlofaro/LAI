<?php include "templates/include/header.php" ?>
<section class="main-content">
  <?php include "include/sideNav.php" ?>
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
