<?php include "templates/include/header.php" ?>

      <!-- <h1 style="width: 75%;"><?php echo htmlspecialchars( $results['article']->title )?></h1>
      <div style="width: 75%; font-style: italic;"><?php echo htmlspecialchars( $results['article']->summary )?></div>
      <div style="width: 75%;"><?php echo $results['article']->content?></div>
      <p class="pubDate">Published on <?php echo date('j F Y', $results['article']->publicationDate)?></p> -->

      <section class="main-content">
        <nav class="side-nav">
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
          <h1><?php echo htmlspecialchars($results['article']->title) ?></h1>
          <div class="main-image">
            <img src="<?php echo $results['article']->imagePath ?>" alt=''>
          </div>
          <section class="details">
            <div class="col col1">
              <h2>Personnel</h2>
              <ul>
                <li>Landscape Art, General</li>
                <li>Contractor</li>
                <br>
                <li>Tuscan Lakes Development</li>
                <li>Bob Douglas</li>
                <br>
                <li>TBG Partners, Architect</li>
                <li>John Wallace</li>
              </ul>
            </div>
            <div class="col col2">
              <h2>Services</h2>
              <ul>
                <li>Landscaping</li>
                <li>Irrigation</li>
                <li>Entry Wall</li>
              </ul>
            </div>
            <div class="col col3">
              <h2>Contract Amount</h2>
              <ul>
                <li>$256,490</li>
              </ul>
              <h2>Completion Date</h2>
              <ul>
                <li>May 2006</li>
              </ul>
            </div>
          </section>
          <section id="description">
            <h2>Project Narrative</h2>
            <p><?php echo nl2br($results['article']->content); ?></p>
          </section>
        </div>
      </section>

<?php include "templates/include/footer.php" ?>
