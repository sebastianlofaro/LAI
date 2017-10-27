<?php

require( "config.php" );
session_start();
$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";


if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}

switch ( $action ) {
  case 'selectSub':
    selectSubCat();
    break;
  case 'newSubCat':
    addSubCat();
    break;
  case 'newSubCatForCategory':
    newSubCatForCategory();
    break;
  case 'deleteSubCat':
    deleteSubCat();
    break;
  case 'newClient':
    newClient();
    break;
  case 'deleteClient':
    deleteClient();
    break;
  case 'uploadPhotos':
    echo "Upload Succesful";
    break;
  case 'newArticle':
    newArticle();
    break;
  default:
    echo "ERROR";
}


function newArticle() {
  $title = $_POST['title'];
  $personnel = $_POST['personnel'];
  $services = $_POST['services'];
  $contractAmount = $_POST['contractAmount'];
  $completionDate = $_POST['completionDate'];
  $content = $_POST['content'];
  $photoURL = $_POST['photoURL'];
  $subcategory = $_POST['subcategory'];
  //$photoURLList = explode(',',$photoURL);
  $package = [ "title" => $title, "personnel" => $personnel, "services" => $services, "contractAmount" => $contractAmount, "completionDate" => $completionDate, "content" => $content, "imagePath" => $photoURL, "subcategory" => $subcategory];

  // Add the article to the database
  $article = new Article;

  //$article->storeImage($imagePath);
  $article->storeFormValues( $package );
  $article->insert();
  echo json_encode($package);
}

function newClient() {
  $key = $_POST['key'];
  $clientName = $_POST['name'];
  $package = array();
  $package['subcategory'] = $key;
  $package['name'] = $clientName;
  $Client = new Client;
  $Client->storeFormValues($package);
  $Client->insert();
  echo json_encode(Client::getListOfClients($key));
}

function selectSubCat() {
  $key = $_POST['key'];
  $_SESSION["subCat"] = $key;
  echo json_encode(Article::getListOfSubCat($key));
}

function newSubCatForCategory() {
  $name = $_POST['name'];
  $category = $_POST['category'];
  $package = array();
  $package['name'] = $name;
  $package['main_category'] = $category;
  $Subcategory = new Subcategory;
  $Subcategory->storeFormValues($package);
  $Subcategory->insert();
  // Creat photo directory for this subcategory
  $subcategoryList = Subcategory::getListForCategory($category);
  $subCatID = $subcategoryList['results'][(sizeof($subcategoryList['results']) - 1)]->id;
  mkdir(dirname(__FILE__) . "/media/img/portfolio/" . $subCatID);
  echo json_encode($subcategoryList);
}

function addSubCat() {
  $name = $_POST['name'];
  $package = array();
  $package["name"] = $name;
  $subcategory = new Subcategory;
  $subcategory->storeFormValues($package);
  $subcategory->insert();
  echo json_encode($subcategory->getList());
}

function deleteClient() {
  $key = $_POST['key'];
  $subcategory = $_POST['subcategory'];
  Client::delete($key);
  echo json_encode(Client::getListOfClients($subcategory));
}

function deleteSubCat() {
  $key = $_POST['subCatKey'];
  Subcategory::delete($key);
  echo "Success";
}

 ?>
