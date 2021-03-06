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
        <?php include "include/sidenav.php" ?>
      </nav>
      <div class="content-wrapper">
        <div class="content-container">
          <!-- <h1><?php echo htmlspecialchars($results['article']->title) ?></h1> -->


            <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>



            <div class="main-image">
              <!-- <img id="coverPhoto" src="<?php echo $imagePath ?>" alt=''> -->
              <div id="uploads"></div>
              <div id="lastImageID" style="display: none"><?php if(isset($results['article']->lastImageID)) {echo $results['article']->lastImageID;} ?></div>
              <div id="imagePaths" style="display: none"><?php if ($results['pageTitle'] === "Edit Article") {echo $results['article']->imagePath;} ?></div>
              <div class="dropzone-wrapper">
                <div class="dropzone" id="dropzone">Drop files here to upload</div>
              </div>
              <ul id="uploaded-images">
                <?php if (isset($imageURLs)) {
                  foreach ($imageURLs as $imageNumber => $imagePath) {
                    ?>
                    <li>
                      <div id="<?php $imageID; preg_match('([^/]+$)', $imagePath, $imageID); echo $imageID[0]; ?>" class="uploaded-image" style="background-image: url('<?php echo $imagePath ?>')"></div>
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
                <h2>Owners</h2>
                <textarea id="owners" name="owners" ><?php echo $results['article']->owners ?></textarea>
                <!-- <h2>PERSONNEL</h2>
                <textarea id="personnel" name="personnel" ><?php echo $results['article']->personnel ?></textarea> -->
              </div>
              <div class="col col2">
                <h2>Contractors</h2>
                <textarea id="contractors" name="contractors" ><?php echo $results['article']->contractors ?></textarea>
                <!-- <h2>SERVICES</h2>
                <textarea id="services" name="services" ><?php echo $results['article']->services ?></textarea> -->
              </div>
              <div class="col col3">
                <h2>Consultants</h2>
                <textarea id="consultants" name="consultants" ><?php echo $results['article']->consultants ?></textarea>
                <!-- <h2>CONTRACT AMOUNT</h2>
                <input id="contractAmount" type="text" name="contractAmount" value="<?php echo $results['article']->contractAmount ?>">
                <h2>Completion Date</h2>
                <input id="completionDate" type="text" name="completionDate" value="<?php echo $results['article']->completionDate ?>"> -->
              </div>
            </section>
            <div class="pageBreak"></div>
            <section id="description">
              <h2>Project Narrative</h2>
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
              <input type="submit" class="button" id="cancle" formnovalidate name="cancel" value="CANCEL" />
              <?php if ( $results['article']->id ) { ?>
                    <a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>&amp;subcategory=<?php echo $results['article']->subcategory ?>" onclick="return confirm('Are you sure you would like to delete This post?')"><button class="button" id="delete" type="button" name="button">DELETE</button></a>
              <?php } ?>
            </div>


        </div>
      </div>
    </form>
  </section>
<?php include "templates/include/footer.php" ?>
