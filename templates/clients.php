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
    <div class="wrapper">
      <h1>Developers</h1>
      <p>The listing below represents a partial listing of our Developers clientele.</p>
      <ul>
        <?php foreach ($results['clients'] as $client) { ?>
          <li>
            <?php echo $client->name; ?>
          </li>
      <?php  } ?>
      </ul>
      <table>
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
</div>



<?php include "templates/include/footer.php" ?>
