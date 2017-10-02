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
  case 'deleteSubCat':
    deleteSubCat();
    break;
  default:
    echo "ERROR";
}

function selectSubCat() {
  $key = $_POST['key'];
  $_SESSION["subCat"] = $key;
  echo json_encode(Article::getListOfSubCat($key)) ;
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

function deleteSubCat() {
  $key = $_POST['subCatKey'];
  Subcategory::delete($key);
  echo "Success";
}

 ?>
