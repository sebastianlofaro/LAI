<?php
header('Content-Type: application/json');

$uploaded = array();
//$subcategory = $_FILES['subcategory'];
if (!empty($_FILES['files']['tmp_name'][0])) {
  // var_dump('media/img/' . $subcategory);
  //mkdir(dirname(__FILE__) . "/media/img/" . "name");
  foreach ($_FILES['files']['name'] as $position => $name) {
    if (move_uploaded_file($_FILES['files']['tmp_name'][$position], 'media/img/portfolio/' .  $name)) {
      $uploaded[] = array(
        'name' => $name,
        'file' => 'media/img/' . $name
      );
    }
  //  var_dump($_FILES['files']['tmp_name'][$position]);
  }
}

echo json_encode($uploaded);

 ?>
