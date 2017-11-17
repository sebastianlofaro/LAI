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
  $pageTitle = "";
  $category = $_GET['category'];
  $subcategory = $_GET['subcategory'];
  Subcategory::deleteSubCat($category, $subcategory);
  function recursiveRemoveDirectory($dir) {
    if (!file_exists($dir)) {
      return true;
    }
    if (!is_dir($dir)) {
      return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
      if ($item == '.' || $item == '..') {
        continue;
      }
      if (!recursiveRemoveDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
        return false;
      }
    }
    return rmdir($dir);
}
  $directoryToDelete = dirname(__FILE__) . "/media/img/portfolio/" . $subcategory;
  recursiveRemoveDirectory($directoryToDelete);
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
  $pageTitle = "";
  $subCatID = $_GET['id'];
  $category = $_GET['category'];
  $titleIndex = $_GET['index'];
  $section = 2;
  $data = Client::getListOfClients($subCatID);
  $subMenuData = Subcategory::getListForCategory($category);
  $results = array();
  $results['clients'] = $data['results'];
  $results['menuData'] = $subMenuData['results'];
  require( TEMPLATE_PATH . "/admin/editClients.php");
}

function clients() {
  $pageTitle = "";
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
  $pageTitle = "";

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
  $pageTitle = "";
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}


function newArticle() {
  $results = array();
  $results['pageTitle'] = "New Article";
  $subcategory = $_GET["subcategory"];
  $_POST['subcategory'] = $subcategory;
  $imagePath = 'media/img/addPhoto.png';
  $subMenuData = Subcategory::getListForCategory(0);
  $results['menuData'] = $subMenuData['results'];
  $subCatIndex = $_GET['index'];
  $results['formAction'] = "newArticle";

  if ( isset( $_POST['saveChanges'] ) ) {
    // User has posted the article edit form: save the new article

    $_POST["imagePath"] = $target_file;

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
  $pageTitle = "";
  $subcategory = $_GET['subcategory'];
  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";
  $articleID = (int)$_GET['articleId'];
  $subMenuData = Subcategory::getListForCategory(0);
  $results['menuData'] = $subMenuData['results'];
  $subCatIndex = $_GET['index'];

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
    $results['article'] = Article::getById( $articleID );
    // Get image URLs
    $imageURLs = explode(",", $results['article']->imagePath);
    $imageURLs = str_replace("\"", "", $imageURLs);
    require( TEMPLATE_PATH . "/admin/editArticleGUI.php" );
  }

}


function deleteArticle() {
  $pageTitle = "";
  $subcategory = $_GET['subcategory'];
  $articleID = (int)$_GET['articleId'];
  $directoryToDelete = dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . "/" . $articleID;

  if ( !$article = Article::getById($articleID) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }
  // Delete article from database
  $article->delete();
  // Delete article photo directory from file system
  function recursiveRemoveDirectory($directory) {
    foreach(glob("{$directory}/*") as $file) {
      if(is_dir($file)) {
        recursiveRemoveDirectory($file);
      } else {
        unlink($file);
      }
    }
    rmdir($directory);
  }

  recursiveRemoveDirectory($directoryToDelete);

  header( "Location: admin.php?status=articleDeleted" );
}

function portfolioSubCat() {
  $pageTitle = "";
  $subCatID = $_GET['id'];
  $subCatIndex = $_GET['index'];
  $results = array();
  $subMenuData = Subcategory::getListForCategory(0);
  $data = Article::getListOfSubCat($subCatID);

  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['subcategories'] = $subMenuData['results'];
  $results['menuData'] = $subMenuData['results'];

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

function listArticles() {
  $pageTitle = "";
  $results = array();
  $subCatIndex = 0;
  $subMenuData = Subcategory::getListForCategory(0);
  $subCatID = $subMenuData['results'][$subCatIndex]->id;

  $data = Article::getListOfSubCat((int)Subcategory::topSubCat()['id']);

  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['menuData'] = $subMenuData['results'];

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

?>
