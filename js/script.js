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

  // ###################### Build Slideshow ######################
  if ($('#projectImage')) {
    $('.slideshow-controls').hide();
    var slideIndex = 0;
    // get the src value of the img
    var $slides = $(".images").text().split(",");
    var html = "<div class='slideshow'>";
    $.each($slides, function(index, value) {
      html = html + "<div class='slide' style='background-image: url(\"" + value + "\");'></div>"
    });
    html = html + "</div>";
    $('.imageContainer').html(html + $('.imageContainer').html());
    $('.slideshow').cycle({
      fx: 'fade',
      prev: '.back-arrow',
      next: '.forward-arrow',
      pause: 1,
      pauseOnPagerHover: true,
      slideResize: 0
    });
    $('.imageContainer').hover(function(){
      $('.slideshow-controls').show();
    }, function(){
      $('.slideshow-controls').hide();
    });
  }



  // ###################### Display Thumbnails ######################

  $('.thumbnail').each(function(e) {
    if (!$(this).hasClass('newArticle')) {
      // Get the image paths (as string)
      var $imagePathsString = $(this).children().text();
      var images = $imagePathsString.split(',');
      var coverImage = images[0];
      //$(this).css("background-image", "url(" + coverImage + ")")
      var html = "<div class='thumbnailSlideshow'>";
      $.each(images, function(index, value) {
        html = html + "<div class='slide' style='background-image: url(\"" + value + "\");'></div>"
      });
      html =  html + "</div>";
      $(this).html(html + $(this).html());
      console.log(html);
    }
  });

  //--------------------- Rotate Images ---------------------
  // var timeout = "";
  // $('.thumbnail').hover(function(){
  //   console.log('hover in');
  //   // Start  rotating images
  //   var $this = $(this);
  //   var $imagePathsString = $(this).children().text();
  //   var images = $imagePathsString.split(',');
  //   var imageIndex = 0;
  //   rotateImages();
  //   function rotateImages(e) {
  //     imageIndex++;
  //     if (imageIndex >= images.length) {imageIndex = 0}
  //     $this.css("background-image", "url(" + images[imageIndex] + ")");
  //     timeout = setTimeout(rotateImages, 2000);
  //   }
  // }, function() {
  //   console.log('hover out');
  //   // Stop rotating images
  //   clearTimeout(timeout);
  // });

  $('.thumbnailSlideshow').cycle({
    fx: 'fade',
    prev: '.back-arrow',
    next: '.forward-arrow',
    pause: 1,
    pauseOnPagerHover: true,
    slideResize: 0,
    timeout: 1000
  });
  $('.thumbnailSlideshow').cycle('pause');
  $('.thumbnailSlideshow').hover(function() {
    // Hover in
    $(this).cycle('resume');
  }, function() {
    // Hover out
    $(this).cycle('pause');
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
