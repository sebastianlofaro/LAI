<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";


if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}


switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
  case 'clients':
    clients();
    break;
  case 'clientsSubCat':
    clientSubCatForID();
    break;
  case 'deleteSubCat':
    deleteSubCat();
    break;
  case 'portfolioSubCat':
    portfolioSubCat();
    break;
  default:
    listArticles();
}


function deleteSubCat() {
  $category = $_GET['category'];
  $subcategory = $_GET['subcategory'];
  Subcategory::deleteSubCat($category, $subcategory);
  if ($category == 1) {
    // Reload clients page
    clients();
  }
  if ($category == 0) {
    // Reload portfolio page
    listArticles();
  }
}

function clientSubCatForID() {
  $subCatID = $_GET['id'];
  $category = $_GET['category'];
  $titleIndex = $_GET['index'];
  $data = Client::getListOfClients($subCatID);
  $subMenuData = Subcategory::getListForCategory($category);
  $results = array();
  $results['clients'] = $data['results'];
  $results['menuData'] = $subMenuData['results'];
  require( TEMPLATE_PATH . "/admin/editClients.php");
}

function clients() {
  $titleIndex = 0;
  $topSubCat = Subcategory::topSubCatForCategory(1);
  $data = Client::getListOfClients($topSubCat['id']);
  $subMenuData = Subcategory::getListForCategory(1);
  $results = array();
  $results['clients'] = $data['results'];
  $results['menuData'] = $subMenuData['results'];
  require( TEMPLATE_PATH . "/admin/editClients.php");
}

function login() {

  $results = array();
  $results['pageTitle'] = "Admin Login";

  if ( isset( $_POST['login'] ) ) {

    // User has posted the login form: attempt to log the user in

    if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {

      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" );

    } else {

      // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

  } else {

    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }

}


function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}


function newArticle() {
  $results = array();

  $results['pageTitle'] = "New Article";
  $results['formAction'] = "newArticle";

  if ( isset( $_POST['saveChanges'] ) ) {
    // User has posted the article edit form: save the new article

    // Store the image in the file system
    $target_dir = "media/img/";
    $target_file = $target_dir . basename($_FILES["imagePath"]["name"]);
    $uploadOk = 1;
    // validate image
    if(file_exists($target_file)) {
      // TODO notify user file exists
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["imagePath"]["size"] > 500000000) {
      // TODO notify user the file is too large
      $uploadOk = 0;
    }
    if ($uploadOk) {
      if (move_uploaded_file($_FILES["imagePath"]["tmp_name"], $target_file)) {
          // File has been uploaded
      } else {
          // TODO notify user there was an error uploading the image
      }
    }
    // add the image path to the rest of the form post information
    $_POST["imagePath"] = $target_file;
    $_POST["subcategory"] = (int) $_SESSION["subCat"];

    $article = new Article;

    //$article->storeImage($imagePath);
    $article->storeFormValues( $_POST );
    $article->insert();
    header( "Location: admin.php?status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {

    // User has not posted the article edit form yet: display the form
    $results['article'] = new Article;
    require( TEMPLATE_PATH . "/admin/editArticleGUI.php" );
  }

}


function editArticle() {

  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";

  // if (isset($_POST['addService'])) {
  //   echo "ADD SERVICE";
  //   // if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
  //   //   header( "Location: admin.php?error=articleNotFound" );
  //   //   return;
  //   // }
  //   //$article->addService( $_POST );
  //   //$article->update();
  // }

  if ( isset( $_POST['saveChanges'] ) ) {
    // User has posted the article edit form: save the article changes

    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }

    $article->storeFormValues( $_POST );
    $article->update();
    header( "Location: admin.php?status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {

    // User has not posted the article edit form yet: display the form
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    require( TEMPLATE_PATH . "/admin/editArticleGUI.php" );
  }

}


function deleteArticle() {

  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }
  $article->delete();
  header( "Location: admin.php?status=articleDeleted" );
}

function portfolioSubCat() {
  $subCatID = $_GET['id'];
  $subCatIndex = $_GET['index'];
  $results = array();
  $subMenuData = Subcategory::getListForCategory(0);
  $data = Article::getListOfSubCat($subCatID);

  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['subcategories'] = $subMenuData['results'];

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

function listArticles() {
  $results = array();
  $subCatIndex = 0;
  // $sideMenuData = Subcategory::getList();
  $subMenuData = Subcategory::getListForCategory(0);
  //$data = Article::getList();
  // FIXME:
  $data = Article::getListOfSubCat((int)Subcategory::topSubCat()['id']);


  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['subcategories'] = $subMenuData['results'];

  // if ( isset( $_GET['error'] ) ) {
  //   if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  // }
  //
  // if ( isset( $_GET['status'] ) ) {
  //   if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
  //   if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  // }

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

?>
