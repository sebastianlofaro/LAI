<?php include "templates/include/header.php" ?>
<div id="clients">
  <div class="secondaryMenu">
    <ul>
      <li>Developers</li>
      <li>Commercial</li>
      <li>Institutions</li>
      <li>Municipalities</li>
      <li>General Contractors</li>
      <li>Landscape Architects</li>
    </ul>
  </div>

  <div class="content">
    <h1>Developers</h1>
    <p>The listing below represents a partial listing of our Developers clientele.</p>
    <ul>
      <li>
        <input type="text" id="newClientInput" name="client" value="" placeholder="newClient">
        <button type="button" name="newClient" class="newClientBtn" id="<?php echo $results['clients'][0]->id; ?>"> + </button>
      </li>




    </ul>
    <table id="clientsTable">
      <tr>
        <td>Tuscan Lakes</td>
        <td>South Shore Harbour</td>
        <td>Edgewater</td>
      </tr>
      <tr>
        <td>The Woodlands</td>
        <td>Aliana</td>
        <td>Sienna Plantation</td>
      </tr>
      <tr>
        <td>Telfair</td>
        <td>Riverstone</td>
        <td>Whispering Lakes Ranch</td>
      </tr>
      <tr>
        <td>Marbella</td>
        <td>Summerwood</td>
        <td>Eagle Springs</td>
      </tr>
      <tr>
        <td>Village of Tuscan Lakes</td>
        <td>Summerlyn</td>
        <td>Centex</td>
      </tr>
      <tr>
        <td>Pulte Homes</td>
        <td>Johnson Development</td>
        <td>KB Homes</td>
      </tr>
      <tr>
        <td>Newland Communities</td>
        <td>Taylor Morrison</td>
        <td>Beazer Homes</td>
      </tr>
    </table>
  </div>
</div>
<?php include "templates/include/footer.php" ?>
