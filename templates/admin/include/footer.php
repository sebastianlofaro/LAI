
<footer>
  <div class="caret"></div>
  <div class="col-group">
    <div class="col col1">
      <p>Landscape Art, Inc.</p>
      <p>2303 Dickinson Avenue</p>
      <p>League City, TX 77573</p>
      <br>
    </div>
    <div class="col col2">
      <p><a href="tel:281-309-0500">P:(281)309-0500</a></p>
      <p><a href="tel:281-309-0202">F:(281)309-0202</a></p>
    </div>
  </div>
  <div class="col col3">
    <img src="media/img/icon-email.png" alt="">
    <p>Join Our Email List</p>
  </div>


  <div id="coppyRight" class="col col4">
    <div class="col">
      <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a class="logout" href="admin.php?action=logout"?>Log out</a></p>
    </div>
    <p>&copy; <?php echo date("Y"); ?> Landscape Art Inc.</p>
  </div>
</footer>
</div>
</html>
