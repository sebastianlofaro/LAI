<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Landscape Art inc.</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="styles/css/waves.min.css">
  <link rel="stylesheet" href="styles/css/style.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/waves.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script type="text/javascript" src="js/adminScript.js"></script>
  <script src="js/animations.js"></script>
</head>
<body class="dark">

  <div class="wrapper">
    <section id="header" class="spread">
      <a href="."><img src="media/img/LAI-logo.png" alt=""></a>
      <img id="slogan" src="media/img/slogan.png" alt="">
    </section>
    <nav class="nav">
      <ul class="spread nav-items">
        <li class=""><a href="#">HOME</a></li>
        <li class="selected"><a href="?action=portfolio">PORTFOLIO</a></li>
        <li class=""><a href="?action=clients">CLIENTS</a></li>
        <li class=""><a href="#">ABOUT&nbsp;US</a></li>
        <li class=""><a href="#">CONTACT&nbsp;US</a></li>
        <div class="category" style="display: none">0</div>
      </ul>
    </nav>
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
