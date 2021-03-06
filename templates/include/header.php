<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Landscape Art installs landscaping, irrigation and light construction for all types of commercial, institutional and governmental projects.">
  <title>Landscape Art inc. - League City, TX</title>
  <link rel="icon" href="media/img/favicon.ico" type="image/x-icon"/>
  <link rel="shortcut icon" href="media/img/favicon.ico" type="image/x-icon"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="styles/css/style.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/cycle.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="js/animations.js"></script>
</head>
<body class="dark">

  <div class="wrapper">
    <section id="header" class="spread">
      <a href="."><img src="media/img/LAI-logo.png" alt=""></a>
      <img id="slogan" src="media/img/slogan.png" alt="">
    </section>
    <nav class="nav">
      <div class="hamburger-wrapper">
        <h1 class="mobile-page-title"><?php echo  strtoupper($pageTitle)?></h1>
        <div class="hamburger-menu">
          <div class=""></div>
          <div class=""></div>
          <div class=""></div>
        </div>
      </div>
      <ul class="nav-items">
        <li class="<?php if(isset($selectedCategory)) if($selectedCategory == 0) echo "selected"; ?>"><a href="?action=home">HOME</a></li>
        <li class="<?php if(isset($selectedCategory)) if($selectedCategory == 1) echo "selected"; ?>"><a href="?action=portfolio">PORTFOLIO</a></li>
        <li class="<?php if(isset($selectedCategory)) if($selectedCategory == 2) echo "selected"; ?>"><a href="?action=clients">CLIENTS</a></li>
        <li class="<?php if(isset($selectedCategory)) if($selectedCategory == 3) echo "selected"; ?>"><a href="?action=aboutUs">ABOUT&nbsp;US</a></li>
      </ul>
    </nav>
