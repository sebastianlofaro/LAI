

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
  default:
    //portfolio();
    home();
}


function clients() {
  $data = Client::getListOfClients(1);
  $results = array();
  $results['clients'] = $data['results'];
  require( TEMPLATE_PATH . "/clients.php");
}

function aboutUs() {
  require( TEMPLATE_PATH . "/about.php" );
}

function home() {
  require( TEMPLATE_PATH . "/home.php" );
}

function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    portfolio();
    return;
  }

  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['pageTitle'] = $results['article']->title . "Title";
  $pageID = "viewArticle";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}

function portfolio() {
  $results = array();
  $secondaryMenuData = Subcategory::getList();
  $data = Article::getListOfSubCat( $secondaryMenuData['results'][0]->id );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Landscape Art inc.";
  $results['subcategories'] = $secondaryMenuData['results'];
  require( TEMPLATE_PATH . "/portfolio.php" );
}

?>
