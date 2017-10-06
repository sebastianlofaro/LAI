<?php include "templates/include/header.php" ?>
<section id="listArticles" class="main-content">
  <div class="jumbotron">
    <div class="jumbotronImage"></div>
    <div class="jumbotronMessage">
      <div class="">
        <h1>Our Work</h1>
        <div class="greenUnderline"></div>
      </div>

    </div>
  </div>
  <?php include "include/sidenav.php" ?>
  <div  class="content-wrapper">

    <h1 class="pageTitle">Neighborhoods</h1>
    <div class="content">



        <div id="adminHeader">
          <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
        </div>

        <h1>All Articles</h1>

  <?php if ( isset( $results['errorMessage'] ) ) { ?>
          <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
  <?php } ?>


  <?php if ( isset( $results['statusMessage'] ) ) { ?>
          <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
  <?php } ?>


  <ul class="articles">
    <li>
      <a href="admin.php?action=newArticle">
        <img class="darkBorder thumbnail" src="media/img/addimage.png" alt=''>
        <p>New Article</p>
      </a>
    </li>
    <?php foreach ( $results['articles'] as $article ) { ?>
      <li>
        <a href=admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>>
          <!-- <img class="thumbnail" src="<?php echo $article->imagePath ?>" alt=''> -->
          <div class="thumbnail" style="background-image: url('<?php echo $article->imagePath ?>')"></div>
          <p><?php echo htmlspecialchars($article->title); ?></p>
        </a>
      </li>
    <?php } ?>
  </ul>
        <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>

      </div>
      <div class="secondaryCTA">
        <button type="button" name="button">CONTACT US TO GET STARTED</button>
      </div>
    </div>
</section>
<?php include "templates/include/footer.php" ?>
