

<?php

require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
  case 'portfolio':
    portfolio();
    break;
  case 'viewArticle':
    viewArticle();
    break;
  case 'aboutUs':
    aboutUs();
    break;
  case 'clients':
    clients();
    break;
  case 'contactUs':
    contactUs();
    break;
  case 'clientsSubCat':
    clientSubCatForID();
    break;
  case 'portfolioSubCat':
    portfolioSubCatForID();
    break;
  default:
    //portfolio();
    home();
}




function clientSubCatForID() {
  $pageTitle = "Clients";
  $selectedCategory = 2;
  $subCatID = $_GET['id'];
  $category = $_GET['category'];
  $titleIndex = $_GET['index'];
  $data = Client::getListOfClients($subCatID);
  $subMenuData = Subcategory::getListForCategory($category);
  $results = array();
  $results['clients'] = $data['results'];
  $results['menuData'] = $subMenuData['results'];
  require( TEMPLATE_PATH . "/clients.php");
}

function clients() {
  $pageTitle = "Clients";
  $selectedCategory = 2;
  $topSubCat = Subcategory::topSubCatForCategory(1);
  $data = Client::getListOfClients($topSubCat['id']);
  $subMenuData = Subcategory::getListForCategory(1);
  $titleIndex = 0;
  $results = array();
  $results['clients'] = $data['results'];
  $results['menuData'] = $subMenuData['results'];
  require( TEMPLATE_PATH . "/clients.php");
}

function aboutUs() {
  $pageTitle = "About Us";
  $selectedCategory = 3;
  $selectedSubCat = isset($_GET['subMenu'])?$_GET['subMenu']:'';
  require( TEMPLATE_PATH . "/about.php" );
}

function contactUs() {
  $pageTitle = "Contact Us";
  $selectedCategory = 4;
  require( TEMPLATE_PATH . "/contactUs.php" );
}

function home() {
  $pageTitle = "";
  $selectedCategory = 0;
  require( TEMPLATE_PATH . "/home.php" );
}

function viewArticle() {
  $pageTitle = "Portfolio";
  $selectedCategory = 1;
  $titleIndex = $_GET['index'];
  $subMenuData = Subcategory::getListForCategory(0);
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    portfolio();
    return;
  }

  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['pageTitle'] = $results['article']->title . "Title";
  $results['menuData'] = $subMenuData["results"];
  $pageID = "viewArticle";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}

function portfolioSubCatForID() {
  $pageTitle = "Portfolio";
  $selectedCategory = 1;
  $subCatID = $_GET['id'];
  $category = $_GET['category'];
  $titleIndex = $_GET['index'];
  $data = Article::getListOfSubCat($subCatID);
  $subMenuData = Subcategory::getListForCategory($category);
  $results = array();
  $results['articles'] = $data['results'];
  $results['menuData'] = $subMenuData['results'];
  require( TEMPLATE_PATH . "/portfolio.php");
}

function portfolio() {
  $selectedCategory = 1;
  $pageTitle = "Portfolio";
  $titleIndex = 0;
  $results = array();
  $secondaryMenuData = Subcategory::getListForCategory(0);
  $data = Article::getListOfSubCat( $secondaryMenuData['results'][0]->id );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Landscape Art inc.";
  $results['menuData'] = $secondaryMenuData['results'];
  require( TEMPLATE_PATH . "/portfolio.php" );
}

?>
