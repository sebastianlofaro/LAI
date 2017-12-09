
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Landscape Art inc.</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="styles/css/waves.min.css">
  <link rel="stylesheet" href="styles/css/style.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/waves.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script type="text/javascript" src="js/adminScript.js"></script>
  <script src="js/animations.js"></script>
</head>
<body class="dark">
  <div class="wrapper">
    <section id="header" class="spread">
      <a href="."><img src="media/img/LAI-logo.png" alt=""></a>
      <img id="slogan" src="media/img/slogan.png" alt="">
    </section>
    <nav class="nav">
      <ul class="spread nav-items">
        <li class=""><a href="#">HOME</a></li>
        <li class=""><a href="?action=portfolio">PORTFOLIO</a></li>
        <li class="selected"><a href="?action=clients">CLIENTS</a></li>
        <li class=""><a href="#">ABOUT&nbsp;US</a></li>
      </ul>
      <div class="category" style="display: none">1</div>
    </nav>

<div id="clients">

    <?php include "templates/admin/include/clientsSecondaryMenu.php" ?>

  <div class="content">
    <div class="shadowTop"></div>
    <div class="wrapper clients-wrapper">
      <h1><?php echo $results['menuData'][$titleIndex]->name ?></h1>
      <a onclick="return confirm('Are you sure you would like to delete This subcategory?')" href="?action=deleteSubCat&amp;category=1&amp;subcategory=<?php echo $results['menuData'][$titleIndex]->id; ?>"><button type="button" id="deleteClientSubCatBtn" name="deleteClientSubCatBtn">Delete</button></a>
      <p>The listing below represents a partial listing of our <?php echo strtolower($results['menuData'][$titleIndex]->name) ?> clientele.</p>
      <div id="newClientInputWrapper">
        <input type="text" id="newClientInput" name="client" value="" placeholder="New Client">
        <button type="button" name="newClient" class="newClientBtn" id="<?php echo $results['menuData'][$titleIndex]->id; ?>"> + </button>
      </div>
      <ul class="mobile-list">
        <?php
        $html = '';
        for ($i=0; $i < count($results['clients']); $i++) {
          $html = $html . "<li class='client clientAdmin' id='" . $results['clients'][$i]->id . "''>" . $results['clients'][$i]->name . "</li>";
        }
        echo $html;
         ?>
      </ul>
      <table id="clientsTable">
        <?php
        // Makes a table 3 columns wide
        $html = "<tr>";
        for ($i=0; $i < count($results['clients']); $i++) {
          $html = $html . "<td class='client clientAdmin' id='" . $results['clients'][$i]->id . "''>" . $results['clients'][$i]->name . "</td>";
          if (($i + 1) % 3 == 0) {
            $html = $html . "</tr><tr>";
          }
        }
        $html = $html . "</tr>";
        echo $html;
         ?>
      </table>
    </div>
  </div>
</div>
<?php include "templates/include/footer.php" ?>
