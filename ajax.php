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
  case 'uploadImages':
    uploadImages();
    break;
  case 'deleteImage':
    deleteImage();
    break;
  case 'newArticle':
    newArticle();
    break;
  default:
    echo "ERROR";
}


function uploadImages() {
  $subcategory = $_POST['subcategory'];
  $formData = $_POST['formData'];

  echo $formData;
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
  $articleID = $article->id;
  // Change the file name from "temp" to the id of the article
  rename(dirname(__FILE__) . "/media/img/portfolio/" . "temp", dirname(__FILE__) . "/media/img/portfolio/" . $articleID);
  // Update the paths of all the images with new directory name.
  Article::detempifyImagePathsForID($articleID);
  echo json_encode($articleID);
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

function deleteImage() {
  $photoID = $_POST['photoID'];
  $directoryID = $_POST['directoryID'];
  $pathEnding = $directoryID . "/" . $photoID;
  // Delete the file from the file system
  unlink(dirname(__FILE__) . "/media/img/portfolio/" . $pathEnding);
  // Remove the file path from database
  //  Get current imagePath from database
  $oldImagePath = Article::imagePathForID($directoryID);
  // Convert string 'oldImagePath' to array on ",".
  $imagePathsArray = explode(",", $oldImagePath[0]);
  $indexToRemove;
  foreach ($imagePathsArray as $key => $path) {
    if (strpos($path, $pathEnding) !== false) {
      // remove this index from the array
      $indexToRemove = $key;
    }
  }
  var_dump($imagePathsArray[$indexToRemove]);
  // Delete image from aray
  unset($imagePathsArray[$indexToRemove]);
  // Re-Index files in directory
  $newFileName = 0;
  $newImagePath = '';
  for ($i=0; $i <= sizeof($imagePathsArray); $i++) {
    //Change the names of all the files in position i except for $indexToRemove
    if ($i != $indexToRemove) {
      rename("media/img/portfolio/" . $directoryID . "/" . $i , "media/img/portfolio/" . $directoryID . "/" . $newFileName);
      if ($newImagePath === '') {
        $newImagePath = "media/img/portfolio/" . $directoryID . "/" . $newFileName;
      }
      else {
        $newImagePath = $newImagePath . ",media/img/portfolio/" . $directoryID . "/" . $newFileName;
      }
      $newFileName = $newFileName + 1;
    }
  }
  // // Turn updated array back into string.
  // $newImagePath = implode(",", $imagePathsArray);
  // Update database with newImagePath
  Article::updateImagePathForID($newImagePath, $directoryID);
  echo json_encode($newImagePath);
}

function deleteSubCat() {
  $key = $_POST['subCatKey'];
  Subcategory::delete($key);
  echo "Success";
}

 ?>
