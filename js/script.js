$(document).ready(function() {

  // ###################### Remove "" from imagePaths ######################

  if($('#imagePaths').text()) {
    $('#imagePaths').text($('#imagePaths').text().replace(/\"/g, ''));
  }

  // ######################  ######################

  $('.hamburger-menu').on("click", function() {
    $('.nav-items').slideToggle("slow", function() {

    });
  });

  if ($('#projectImage')) {
    var slideIndex = 0;
    // get the src value of the img
    var $slides = $(".images").text().split(",");
    // Show slides
    showSlides();
    function showSlides() {
      slideIndex++;
      if (slideIndex >= $slides.length) {slideIndex = 0}
      $('.imageContainer').css("background-image", "url(" + $slides[slideIndex] + ")");
      setTimeout(showSlides, 4000);
    }
  }


  // ###################### Display Thumbnails ######################

  $('.thumbnail').each(function(e) {
    // Get the image paths (as string)
    var $imagePathsString = $(this).children().text();
    var images = $imagePathsString.split(',');
    var coverImage = images[0];
    $(this).css("background-image", "url(" + coverImage + ")")
  });

  //--------------------- Rotate Images ---------------------
  var timeout = "";
  $('.thumbnail').hover(function(){
    console.log('hover in');
    // Start  rotating images
    var $this = $(this);
    var $imagePathsString = $(this).children().text();
    var images = $imagePathsString.split(',');
    var imageIndex = 0;
    rotateImages();
    function rotateImages(e) {
      imageIndex++;
      if (imageIndex >= images.length) {imageIndex = 0}
      $this.css("background-image", "url(" + images[imageIndex] + ")");
      timeout = setTimeout(rotateImages, 1000);
    }
  }, function() {
    console.log('hover out');
    // Stop rotating images
    clearTimeout(timeout);
  });


$('.teamList li').on("click", function() {
  if ($(this).find('.popOut').css('display') == 'none') {
    $(this).find('.popOut').show();
  }
  else {
    $(this).find('.popOut').hide();
  }

  console.log("Error");
});

$('.popOut').on("click", function() {
  console.log("clicked on pop out");
});

});
