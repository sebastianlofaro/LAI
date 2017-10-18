<?php include "templates/include/header.php" ?>

<div class="aboutUs">
  <nav class="secondaryMenu">
    <ul>
      <li><a href="?action=aboutUs&amp;subMenu=companyProfile">Company Profile</a></li>
      <li><a href="?action=aboutUs&amp;subMenu=team">Our Team</a></li>
      <li><a href="?action=aboutUs&amp;subMenu=affiliations">Affiliations, Licenses, Qualifications</a></li>
    </ul>
  </nav>
  <div class="wrapper">
    <div class="shadowTop"></div>

    <?php
    switch ($selectedSubCat) {
      case 'team':
        include "templates/ourTeam.php";
        break;
      case 'affiliations':
        include "templates/affiliations.php";
        break;
      default:
        include "templates/companyProfile.php";
        break;
    }
     ?>
  </div>


</div>

<?php include "templates/include/footer.php" ?>
