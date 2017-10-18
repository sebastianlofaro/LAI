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
  default:
    echo "ERROR";
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
  echo json_encode(Subcategory::getListForCategory($category));
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
