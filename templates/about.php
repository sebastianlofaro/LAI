<?php include "templates/include/header.php" ?>

<div class="aboutUs">
  <nav class="secondaryMenu">
    <ul>
      <li><a class="hover-lightblue <?php if ($selectedSubCat != "team" && $selectedSubCat != "affiliations") {echo "selected-secondary";} ?>" href="?action=aboutUs&amp;subMenu=companyProfile">Our Team</a></li>
      <li><a class="hover-lightblue <?php if ($selectedSubCat === "team") {echo "selected-secondary";} ?>" href="?action=aboutUs&amp;subMenu=team">Company Profile</a></li>
      <li><a class="hover-lightblue <?php if ($selectedSubCat === "affiliations") {echo "selected-secondary";} ?>" href="?action=aboutUs&amp;subMenu=affiliations">Affiliations, Licenses, Qualifications</a></li>
    </ul>
  </nav>
  <div class="wrapper">
    <div class="shadowTop"></div>

    <?php
    switch ($selectedSubCat) {
      case 'team':
        include "templates/companyProfile.php";
        break;
      case 'affiliations':
        include "templates/affiliations.php";
        break;
      default:
        include "templates/ourTeam.php";
        break;
    }
     ?>
  </div>


</div>

<?php include "templates/include/footer.php" ?>
