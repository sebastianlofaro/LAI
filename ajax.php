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
  // Re-Index files in directory
  // $newFileName = 0;
  // $newImagePath = '';
  // for ($i=0; $i <= sizeof($imagePathsArray); $i++) {
  //   //Change the names of all the files in position i except for $indexToRemove
  //   if ($i != $indexToRemove) {
  //     rename("media/img/portfolio/" . $subcategory . "/" . $directoryID . "/" . $i , "media/img/portfolio/" . $subcategory . "/" . $directoryID . "/" . $newFileName);
  //     if ($newImagePath === '') {
  //       $newImagePath = "media/img/portfolio/" . $subcategory . "/" . $directoryID . "/" . $newFileName;
  //     }
  //     else {
  //       $newImagePath = $newImagePath . ",media/img/portfolio/" . $subcategory . "/" . $directoryID . "/" . $newFileName;
  //     }
  //     $newFileName = $newFileName + 1;
  //   }
  // }
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
  $id = $_POST['id'];
  //$photoURLList = explode(',',$photoURL);

  // Test if article already exists
  if ($id != 'null') {
    // Existing Article: update database
    $package = [ "title" => $title, "personnel" => $personnel, "services" => $services, "contractAmount" => $contractAmount, "completionDate" => $completionDate, "content" => $content, "imagePath" => $photoURL, "subcategory" => $subcategory, "id" => $id];
    $article = new Article;
    //$article->storeImage($imagePath);
    $article->storeFormValues( $package );
    $article->update();
    $articleID = $article->id;
    echo json_decode($articleID);
  }
  else {
    // New Article: add to database and images directroy name to id
    $package = [ "title" => $title, "personnel" => $personnel, "services" => $services, "contractAmount" => $contractAmount, "completionDate" => $completionDate, "content" => $content, "imagePath" => $photoURL, "subcategory" => $subcategory];

    // Add the article to the database
    $article = new Article;
    //$article->storeImage($imagePath);
    $article->storeFormValues( $package );
    $article->insert();
    $articleID = $article->id;
    // Change the file name from "temp" to the id of the article
    rename(dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . "/temp", dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . "/" . $articleID);
    // Update the paths of all the images with new directory name.
    Article::detempifyImagePathsForID($articleID);
    echo json_encode($articleID);
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
