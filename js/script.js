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
      //$('#projectImage').attr('src', $slides[slideIndex]);
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
      //$('#projectImage').attr('src', $slides[slideIndex]);
      $this.css("background-image", "url(" + images[imageIndex] + ")");
      timeout = setTimeout(rotateImages, 1000);
    }
  }, function() {
    console.log('hover out');
    // Stop rotating images
    clearTimeout(timeout);
  });


  //###################### AJAX ######################



  $(".newClientBtn").on("click", function(e) {
    e.preventDefault();
    var $key = $(this).attr('id');
    var $clientName = $('#newClientInput').val();
    $('#newClientInput').val("")
    console.log("newClientButton clicked.");

    function buildPageFromJSON(data) {
      var html = "<tr>";
      for (var i = 0; i < data.length; i++) {
        html = html + "<td class='client' id>" + data[i]['name'] + "</td>";
        if ((i + 1) % 3 == 0) {
          html = html + "</tr><tr>";
        }
      }
      html = html + "</tr>";
      console.log(html);
      $('#clientsTable').html(html);
    }

    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {'action': 'newClient', 'key': $key, 'name': $clientName},
      success: function (data, status) {
        var dataObject = $.parseJSON(data);
        buildPageFromJSON(dataObject['results']);
        console.log(dataObject['results'].length);
      },
      error: function(xhr, desc, err) {
        console.log("ERROR: " . xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    });

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
