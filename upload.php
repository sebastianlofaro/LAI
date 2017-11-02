<?php
header('Content-Type: application/json');
require( "config.php" );


$uploaded = array();
$subcategory = $_REQUEST['subcategory'];
$directoryID = $_REQUEST['directoryID'];
$photoIndex = $_REQUEST['photoIndex'];

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
    mkdir(dirname(__FILE__) . "/media/img/portfolio/" . $subcategory . '/' . $fileName);
  }
  
  foreach ($_FILES['files']['name'] as $position => $name) {
    $photoName = $position + $photoIndex;
    if (move_uploaded_file($_FILES['files']['tmp_name'][$position], 'media/img/portfolio/' . $subcategory . '/' . $fileName . '/' . $photoName)) {
      $uploaded[] = array(
        'name' => $name,
        'file' => 'media/img/portfolio/' . $subcategory . '/' . $fileName . '/' . $photoName
      );
    }
  }
}
// if ($existingImages !== '') {
//   // add existing images to new upload
//   $uploaded = array_merge($existingImages, $uploaded);
// }
echo json_encode($uploaded);

 ?>
