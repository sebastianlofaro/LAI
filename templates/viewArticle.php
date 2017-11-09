<?php include "templates/include/header.php" ?>

      <section id="viewArticle" class="main-content">
        <div class="pageTitleContainer">
          <div class="">
            <h1><?php echo htmlspecialchars($results['article']->title) ?></h1>
          </div>
        </div>
        <nav class="side-nav">

          <ul>
            <li class="hover-lightblue"><a href="#">Neighborhoods</a></li>
            <li class="hover-lightblue"><a href="#">Parks</a></li>
            <li class="hover-lightblue"><a href="#">Playgrounds</a></li>
            <li class="hover-lightblue"><a href="#">Splash Parks</a></li>
            <li class="hover-lightblue"><a href="#">Roof Gardens</a></li>
            <li class="hover-lightblue"><a href="#">Institutions/Commercial</a></li>
          </ul>
        </nav>

        <div class="content-wrapper">
          <div class="content-container">
            <div class="main-image">
              <div class="images" style="display: none"><?php echo $results['article']->imagePath ?></div>
              <div class="imageContainer"></div>
            </div>
            <section class="details">
              <div class="col col1">
                <h2>Personnel</h2>
                <p><?php echo nl2br(htmlspecialchars($results['article']->personnel)) ?></p>
              </div>
              <div class="col col2">
                <h2>Services</h2>
                <p><?php echo nl2br(htmlspecialchars($results['article']->services)) ?></p>
              </div>
              <div class="col col3">
                <h2>Contract Amount</h2>
                <p><?php echo nl2br(htmlspecialchars($results['article']->contractAmount)) ?></p>
                <h2>Completion Date</h2>
                <ul>
                  <p><?php echo nl2br(htmlspecialchars($results['article']->completionDate)) ?></p>
                </ul>
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
