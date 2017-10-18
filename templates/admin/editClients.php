<?php include "templates/admin/include/header.php" ?>
<div id="clients">

    <?php include "templates/admin/include/clientsSecondaryMenu.php" ?>

  <div class="content">
    <div class="wrapper">
      <h1><?php echo $results['menuData'][$titleIndex]->name ?></h1>
      <a href="?action=deleteSubCat&amp;category=1&amp;subcategory=<?php echo $results['menuData'][$titleIndex]->id; ?>"><button type="button" name="deleteClientSubCatBtn">Delete</button></a>
      <p>The listing below represents a partial listing of our <?php echo strtolower($results['menuData'][$titleIndex]->name) ?> clientele.</p>
      <ul>
        <li>
          <input type="text" id="newClientInput" name="client" value="" placeholder="newClient">
          <button type="button" name="newClient" class="newClientBtn" id="<?php echo $results['menuData'][$titleIndex]->id; ?>"> + </button>
        </li>




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
