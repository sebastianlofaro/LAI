<?php include "templates/include/header.php" ?>

<div id="clients">

  <nav class="secondaryMenu">
    <ul>
      <?php
      $index = 0;
      foreach ($results['menuData'] as $subcategory) { ?>
        <li class="subcategory">
          <a href="?action=clientsSubCat&amp;id=<?php echo $subcategory->id ?>&amp;category=<?php echo $subcategory->mainCategory ?>&amp;index=<?php echo $index ?>">
            <p><?php echo htmlspecialchars($subcategory->name); ?></p>
          </a>
        </li>
    <?php
    ++$index;
    } ?>
    </ul>
  </nav>

  <div class="content">
    <div class="wrapper">
      <h1><?php echo $results['menuData'][$titleIndex]->name ?></h1>
      <p>The listing below represents a partial listing of our <?php echo strtolower($results['menuData'][$titleIndex]->name) ?> clientele.</p>

      <table id="clientsTable">
        <?php
        // Makes a table 3 columns wide
        $html = "<tr>";
        for ($i=0; $i < count($results['clients']); $i++) {
          $html = $html . "<td class='client' id='" . $results['clients'][$i]->id . "''>" . $results['clients'][$i]->name . "</td>";
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
