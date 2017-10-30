<?php include "templates/admin/include/header.php" ?>
<section id="listArticles" class="main-content">
  <div class="jumbotron">
    <div class="jumbotronImage"></div>
    <div class="jumbotronMessage">
      <div class="">
        <h1 class="pageTitle"><?php echo $results['subcategories'][(int)$subCatIndex]->name; ?></h1>
        <a href="?action=deleteSubCat&amp;category=0&amp;subcategory=<?php echo $results['subcategories'][(int)$subCatIndex]->id; ?>"><button type="button" name="deletePortfolioSubCat" class="deleteSubCatBtn">DELETE</button></a>
      </div>

    </div>
  </div>
  <?php include "include/sidenav.php" ?>
  <div  class="content-wrapper">


    <div class="content">

  <?php if ( isset( $results['errorMessage'] ) ) { ?>
          <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
  <?php } ?>


  <?php if ( isset( $results['statusMessage'] ) ) { ?>
          <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
  <?php } ?>


  <ul class="articles">
    <li>
      <a href="admin.php?action=newArticle&amp;subcategory=<?php echo $subCatID ?>">
        <img class="darkBorder thumbnail" src="media/img/addimage.png" alt=''>
        <p>New Article</p>
      </a>
    </li>
    <?php foreach ( $results['articles'] as $article ) { ?>
      <li>
        <a href="admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>&amp;subcategory=<?php echo $subCatID ?>" >
          <!-- <img class="thumbnail" src="<?php echo $article->imagePath ?>" alt=''> -->

          <div class="thumbnail">
            <div class="imagesPackage" style="display: none"><?php echo $article->imagePath ?></div>
          </div>
          <p><?php echo htmlspecialchars($article->title); ?></p>
        </a>
      </li>
    <?php } ?>
  </ul>
        <!-- <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p> -->

      </div>
    </div>
</section>
<?php include "templates/admin/include/footer.php" ?>
