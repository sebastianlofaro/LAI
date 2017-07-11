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
      <ul>
        <?php foreach ( $results['articles'] as $article ) { ?>
                <li>
                  <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>">
                    <img src="media/img/tuscan_lakes.jpg" alt="">
                    <?php echo htmlspecialchars($article->title); ?>
                  </a>
                </li>
        <?php } ?>
        <!-- <li><a href="#"><img src="media/img/eagle_springs.jpg" alt="">Eagle Springs Section 35</a></li>
        <li><a href="#"><img src="media/img/tuscan_lakes.jpg" alt="">Tuscan Lakes Main Entry</a></li>
        <li><a href="#"><img src="media/img/east_shore.jpg" alt="">East Shore Park</a></li>
        <li><a href="#"><img src="media/img/meredith_gardens.jpg" alt="">Mandell Park Renovation</a></li> -->
      </ul>
    </div>
  </div>
</section>
<?php include "templates/include/footer.php" ?>
