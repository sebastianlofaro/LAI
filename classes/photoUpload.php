<?php

if ($_POST["getPhoto"]) {
  $target_dir = "media/img/";
  $target_file = $target_dir . basename($_FILES["imagePath"]["name"]);
  echo $target_file;
}

 ?>
