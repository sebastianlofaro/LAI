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
  default:
    //portfolio();
    home();
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
  $results['pageTitle'] = $results['article']->title . " | Widget News";
  $pageID = "viewArticle";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}

function portfolio() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Landscape Art inc.";
  require( TEMPLATE_PATH . "/portfolio.php" );
}

?>
