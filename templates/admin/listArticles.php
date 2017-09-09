<?php include "templates/include/header.php" ?>
<section class="main-content">
  <?php include "include/sideNav.php" ?>
  <div id="listArticles" class="content-wrapper">

    <h1>Neighborhoods</h1>
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


        </table>

        <p><?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>

      </div>
    </div>
</section>
<?php include "templates/include/footer.php" ?>
