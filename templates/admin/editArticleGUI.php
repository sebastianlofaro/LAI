<?php include "templates/include/header.php" ?>

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
          <!-- <h1><?php echo htmlspecialchars($results['article']->title) ?></h1> -->

          <form id='editForm' action="admin.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>
            <div class="main-image">
              <img src="media/img/tuscan_lakes.jpg" alt="">
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
              <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" ><?php echo htmlspecialchars( $results['article']->content )?></textarea>
            </section>


            <ul>
              <li>
                <label for="fileToUpload">Image: </label>
                <input type="file" name="imagePath" id="imagePath">
              </li>
              <li>
                <label for="title">Article Title</label>
                <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->title )?>" />
              </li>
              <li>
                <label for="summary">Article Summary</label>
                <textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" ><?php echo htmlspecialchars( $results['article']->summary )?></textarea>
              </li>
            </ul>

            <div class="buttons">
              <input type="submit" name="saveChanges" value="Save Changes" />
              <input type="submit" formnovalidate name="cancel" value="Cancel" />
            </div>
          </form>
          <?php if ( $results['article']->id ) { ?>
                <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
          <?php } ?>
        </div>
      </section>

<?php include "templates/include/footer.php" ?>
