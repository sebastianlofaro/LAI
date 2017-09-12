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
    sampleFunction();
    //echo $_POST['key'] + 2;
    break;
  default:
    echo "ERROR";
}

function sampleFunction() {
  $key = $_POST['key'];
  echo json_encode(Article::getListOfSubCat($key)) ;
}

 ?>
