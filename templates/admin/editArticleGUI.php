<?php include "templates/admin/include/header.php" ?>
  <section id="viewArticle" class="">
    <form id='editForm' action="admin.php?action=<?php echo $results['formAction']?>&amp;subcategory=<?php echo $subcategory ?>" method="post" enctype="multipart/form-data">
      <div class="pageTitleContainer">
        <div class="">
          <div class="title">
            <input type="text" name="title" id="title" placeholder="Title" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->title )?>" />
          </div>
        </div>
      </div>
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
        <div class="content-container">
          <!-- <h1><?php echo htmlspecialchars($results['article']->title) ?></h1> -->


            <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>



            <div class="main-image">
              <!-- <img id="coverPhoto" src="<?php echo $imagePath ?>" alt=''> -->
              <div id="uploads"></div>
              <div id="lastImageID"></div>
              <div id="imagePaths" style=""><?php if ($results['pageTitle'] === "Edit Article") {echo $results['article']->imagePath;} ?></div>
              <div class="dropzone" id="dropzone">Drop files here to upload</div>
              <ul id="uploaded-images">
                <?php if (isset($imageURLs)) {
                  foreach ($imageURLs as $imageNumber => $imagePath) {
                    ?>
                    <li>
                      <div id="<?php echo $imageNumber ?>" class="uploaded-image" style="background-image: url('<?php echo $imagePath ?>')"></div>
                    </li>
                <?php  }
                }  ?>
              </ul>
              <div class="loading-circle">
                <div id="floatingBarsG">
                  <div class="blockG" id="rotateG_01"></div>
                  <div class="blockG" id="rotateG_02"></div>
                  <div class="blockG" id="rotateG_03"></div>
                  <div class="blockG" id="rotateG_04"></div>
                  <div class="blockG" id="rotateG_05"></div>
                  <div class="blockG" id="rotateG_06"></div>
                  <div class="blockG" id="rotateG_07"></div>
                  <div class="blockG" id="rotateG_08"></div>
                </div>
              </div>
            </div>

            <section class="details">
              <div class="col col1">
                <h2>PERSONNEL</h2>
                <textarea id="personnel" name="personnel" ><?php echo $results['article']->personnel ?></textarea>
              </div>
              <div class="col col2">
                <h2>SERVICES</h2>
                <textarea id="services" name="services" ><?php echo $results['article']->services ?></textarea>
              </div>
              <div class="col col3">
                <h2>CONTRACT AMOUNT</h2>
                <input id="contractAmount" type="text" name="contractAmount" value="<?php echo $results['article']->contractAmount ?>">
                <h2>Completion Date</h2>
                <input id="completionDate" type="text" name="completionDate" value="<?php echo $results['article']->completionDate ?>">
              </div>
            </section>
            <div class="pageBreak"></div>
            <section id="description">
              <h2>PROJECT NARRATIVE</h2>
              <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" ><?php echo htmlspecialchars( $results['article']->content )?></textarea>
            </section>
            <div class="pageBreak"></div>

            <div class="imageUpload">
              <!-- <label for="fileToUpload">Image: </label> -->
              <!-- <input type="file" name="imagePath" id="imagePath"> -->
              <input type="file" id="file-select" name="photos[]" multiple/>
            </div>

            <div class="buttons">
              <input type="submit" class="button save" id="<?php echo $_GET['subcategory']; ?>" name="saveChanges" value="SAVE" />
              <input type="submit" class="button" id="cancle" formnovalidate name="cancel" value="CANCLE" />
              <?php if ( $results['article']->id ) { ?>
                    <a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>&amp;subcategory=<?php echo $results['article']->subcategory ?>" onclick="return confirm('Delete This Article?')"><button class="button" id="delete" type="button" name="button">DELETE</button></a>
              <?php } ?>
            </div>


        </div>
      </div>
    </form>
  </section>
<?php include "templates/include/footer.php" ?>
