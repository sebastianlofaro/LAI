<?php include "templates/include/header.php" ?>

      <section id="viewArticle" class="main-content">
        <div class="pageTitleContainer">
          <div class="">
            <h1><?php echo htmlspecialchars($results['article']->title) ?></h1>
          </div>
        </div>
        <?php include "templates/include/sideNav.php" ?>
        <div class="content-wrapper">
          <div class="content-container">
            <div class="main-image">
              <div class="images" style="display: none"><?php echo $results['article']->imagePath ?></div>
              <div class="imageContainer"></div>
            </div>
            <section class="details">
              <div class="col col1">
                <h2>Owners</h2>
                <p><?php echo nl2br(htmlspecialchars($results['article']->owners)) ?></p>
              </div>
              <div class="col col2">
                <h2>Contractors</h2>
                <p><?php echo nl2br(htmlspecialchars($results['article']->contractors)) ?></p>
              </div>
              <div class="col col3">
                <h2>Consultants</h2>
                <p><?php echo nl2br(htmlspecialchars($results['article']->consultants)) ?></p>
              </div>
            </section>
            <div class="pageBreak"></div>
            <section id="description">
              <h2>Project Narrative</h2>
              <p><?php echo nl2br(htmlspecialchars($results['article']->content)); ?></p>
            </section>
            <div class="pageBreak"></div>
          </div>
        </div>
      </section>

<?php include "templates/include/footer.php" ?>
