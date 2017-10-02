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

            <div class="title">
              <input type="text" name="title" id="title" placeholder="Title" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->title )?>" />
            </div>

            <div class="main-image">
              <img id="coverPhoto" src="<?php echo $results['article']->imagePath ?>" alt=''>
            </div>

            <section class="details">
              <div class="col col1">
                <h2>Personnel</h2>
                <textarea name="personnel" ><?php echo $results['article']->personnel ?></textarea>
              </div>
              <div class="col col2">
                <h2>Services</h2>
                <textarea name="services" ><?php echo $results['article']->services ?></textarea>
              </div>
              <div class="col col3">
                <h2>Contract Amount</h2>
                <input type="text" name="contractAmount" value="<?php echo $results['article']->contractAmount ?>">
                <h2>Completion Date</h2>
                <input type="text" name="completionDate" value="<?php echo $results['article']->completionDate ?>">
              </div>
            </section>

            <section id="description">
              <h2>Project Narrative</h2>
              <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" ><?php echo htmlspecialchars( $results['article']->content )?></textarea>
            </section>

            <div class="imageUpload">
              <label for="fileToUpload">Image: </label>
              <input type="file" name="imagePath" id="imagePath">
            </div>

            <div class="buttons">
              <input type="submit" id="save" class="<?php $_GET['subcategory']; ?>" name="saveChanges" value="Save Changes" />
              <input type="submit" id="cancle" formnovalidate name="cancel" value="Cancel" />
            </div>
          </form>
          <?php if ( $results['article']->id ) { ?>
                <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
          <?php } ?>
        </div>
      </section>

<?php include "templates/include/footer.php" ?>
