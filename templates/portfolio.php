<?php include "templates/include/header.php" ?>
<section class="portfolio main-content">
  <div class="jumbotron">
    <div class="jumbotronImage"></div>
    <div class="jumbotronMessage">
      <div class="">
        <h1>Our Work</h1>
        <div class="greenUnderline"></div>
      </div>

    </div>
  </div>
  <!-- <div class="descriptiveText">
    <p>Cookie tootsie roll pastry. Gummi bears chocolate cake tart sesame snaps jelly beans marzipan brownie danish jelly-o. Bear claw soufflé oat cake wafer lemon drops pudding ice cream. Cake chocolate bar oat cake ice cream I love gummi bears. Sugar plum liquorice brownie tiramisu chupa chups muffin carrot cake I love. Sweet macaroon oat cake.</p>
  </div> -->
  <?php include "include/sideNav.php" ?>
  <div class="content-wrapper">
    <h1>Neighborhoods</h1>
    <div class="content">
      <ul class="articles">
        <?php foreach ( $results['articles'] as $article ) { ?>
                <li>
                  <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>">
                    <h3> <?php echo htmlspecialchars($article->title); ?> </h3>
                    <div class="thumbnail" style="background-image: url('<?php echo $article->imagePath ?>')"></div>
                  </a>
                </li>
        <?php } ?>

      </ul>
    </div>
  </div>
</section>
<?php include "templates/include/footer.php" ?>
