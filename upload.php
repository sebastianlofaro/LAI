<?php
header('Content-Type: application/json');
require( "config.php" );


$uploaded = array();
$subcategory = $_REQUEST['subcategory'];
$directoryID = $_REQUEST['directoryID'];
$lastImageID = $_REQUEST['lastImageID'];
$newLastImageID;


  // add one to lastImageID to get next image id.
  $lastImageID = $lastImageID + 1;


if (!empty($_FILES['files']['tmp_name'][0])) {
  // Test if directory already exists for this article
  if ($directoryID) {
    $fileName = $directoryID;
  }
  else {
    $fileName = 'temp';
  }
  // make sure file does not exist
  if (!file_exists(dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . '/' . $fileName)) {
    // File does not exist, create file.
    // mkdir(dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . '/' . $fileName); //FIXME: delete this line possibly
    $oldmask = umask(0);
    mkdir(dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . '/' . $fileName, 0777);
    umask($oldmask);
  }

  foreach ($_FILES['files']['name'] as $position => $name) {
    $photoName = $position + $lastImageID;
    $newLastImageID = $photoName;
    if (move_uploaded_file($_FILES['files']['tmp_name'][$position], 'media/img/portfolio/' . $subcategory . '/' . $fileName . '/' . $photoName)) {
      $uploaded[] = array(
        'name' => $name,
        'file' => 'media/img/portfolio/' . $subcategory . '/' . $fileName . '/' . $photoName
      );
    }
  }

  echo json_encode( array(
    'uploaded' => $uploaded,
    'lastImageID' => $newLastImageID
  ));
}


 ?>
