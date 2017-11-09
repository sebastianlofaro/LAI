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
  case 'deleteImage':
    deleteImage();
    break;
  case 'saveArticle':
    saveArticle();
    break;
  default:
    echo "ERROR";
}


function deleteImage() {
  $photoID = $_POST['photoID'];
  $directoryID = $_POST['directoryID'];
  $subcategory = $_POST['subcategory'];
  $tempImagePaths = $_POST['tempImagePaths'];

  if ($directoryID == '') {
    $directoryID = 'temp';
  }

  // Create path ending
  $pathEnding = $subcategory . "/" . $directoryID . "/" . $photoID;
  // Delete the file from the file system
  unlink(dirname(__FILE__) . "/media/img/portfolio/" . $pathEnding);

  $imagePathsArray = explode(",", $tempImagePaths);
  $indexToRemove;
  foreach ($imagePathsArray as $key => $path) {
    if (strpos($path, $pathEnding) !== false) {
      // remove this index from the array
      $indexToRemove = $key;
    }
  }
  // Delete image from aray
  unset($imagePathsArray[$indexToRemove]);
  $newImagePath = implode(',', $imagePathsArray);
  echo json_encode($newImagePath);
}

function saveArticle() {
  $title = $_POST['title'];
  $personnel = $_POST['personnel'];
  $services = $_POST['services'];
  $contractAmount = $_POST['contractAmount'];
  $completionDate = $_POST['completionDate'];
  $content = $_POST['content'];
  $photoURL = $_POST['photoURL'];
  $subcategory = $_POST['subcategory'];
  $lastImageID = $_POST['lastImageID'];
  $id = $_POST['id'];


  // Test if article already exists
  if ($id != 'null') {
    // Existing Article: update database
    $package = [ "title" => $title, "personnel" => $personnel, "services" => $services, "contractAmount" => $contractAmount, "completionDate" => $completionDate, "content" => $content, "imagePath" => $photoURL, "lastImageID" => $lastImageID, "subcategory" => $subcategory, "id" => $id];
    $article = new Article;
    $article->storeFormValues( $package );
    $article->update();
    $articleID = $article->id;
    echo json_decode($subcategory);
  }
  else {
    // New Article: add to database and images directroy name to id
    $package = [ "title" => $title, "personnel" => $personnel, "services" => $services, "contractAmount" => $contractAmount, "completionDate" => $completionDate, "content" => $content, "imagePath" => $photoURL, "subcategory" => $subcategory, "lastImageID" => $lastImageID];

    // Add the article to the database
    $article = new Article;
    $article->storeFormValues( $package );
    $article->insert();
    $articleID = $article->id;
    // Change the file name from "temp" to the id of the article
    if ( is_dir(dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . "/temp") ) {
      rename(dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . "/temp", dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . "/" . $articleID);
      // Update the paths of all the images with new directory name.
      Article::detempifyImagePathsForID($articleID);
    }
    echo json_encode($subcategory);
  }
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
