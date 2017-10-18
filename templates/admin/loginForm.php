<?php include "templates/include/header.php" ?>



  <div class="login-wrapper">
    <form action="admin.php?action=login" method="post">
      <input type="hidden" name="login" value="true" />

  <?php if ( isset( $results['errorMessage'] ) ) { ?>
      <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
  <?php } ?>
      <div class="content">
        <img src="media/img/LAI-logo.png" alt="">
        <ul>

          <li>
            <!-- <label for="username">Username</label> -->
            <input type="text" name="username" id="username" placeholder="USERNAME" required autofocus maxlength="20" />
          </li>

          <li>
            <!-- <label for="password">Password</label> -->
            <input type="password" name="password" id="password" placeholder="PASSWORD" required maxlength="20" />
          </li>

        </ul>

          <div class="buttons">
            <input class="login-button" type="submit" name="login" value="SUBMIT" />
          </div>
      </div>
    </form>
  </div>



<?php include "templates/include/footer.php" ?>
