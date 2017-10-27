<?php include "templates/include/header.php" ?>

      <section id="viewArticle" class="main-content">
        <nav class="side-nav">
          <div class="pageTitleContainer">
            <div class="">
              <h1><?php echo htmlspecialchars($results['article']->title) ?></h1>
            </div>
          </div>
          <ul>
            <li class="selected"><a href="#">Neighborhoods</a></li>
            <li><a href="#">Parks</a></li>
            <li><a href="#">Playgrounds</a></li>
            <li><a href="#">Splash Parks</a></li>
            <li><a href="#">Roof Gardens</a></li>
            <li><a href="#">Institutions/Commercial</a></li>
          </ul>
        </nav>

        <div class="content-wrapper">
          <div class="content-container">
            <div class="main-image">
              <img src="<?php echo $results['article']->imagePath ?>" alt=''>
            </div>
            <section class="details">
              <div class="col col1">
                <h2>Personnel</h2>
                <p><?php echo htmlspecialchars(nl2br($results['article']->personnel)) ?></p>
              </div>
              <div class="col col2">
                <h2>Services</h2>
                <p><?php echo htmlspecialchars(nl2br($results['article']->services)) ?></p>
              </div>
              <div class="col col3">
                <h2>Contract Amount</h2>
                <p><?php echo htmlspecialchars(nl2br($results['article']->contractAmount)) ?></p>
                <h2>Completion Date</h2>
                <ul>
                  <p><?php echo htmlspecialchars(nl2br($results['article']->completionDate)) ?></p>
                </ul>
              </div>
            </section>
            <div class="pageBreak"></div>
            <section id="description">
              <h2>Project Narrative</h2>
              <p><?php echo htmlspecialchars(nl2br($results['article']->content)); ?></p>
            </section>
            <div class="pageBreak"></div>
          </div>
        </div>
      </section>

<?php include "templates/include/footer.php" ?>
