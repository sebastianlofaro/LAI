$(document).ready(function() {

  var $coverPhoto = $('#coverPhoto');
  if ($coverPhoto.attr('src') != "") {
    console.log($coverPhoto.attr('src'))
    console.log("Test");
  }
  else {
    console.log("empty string");
    $coverPhoto.attr('src', 'media/img/addPhoto.png')
  }

  // Link click of photo to click of button
  $coverPhoto.on("click", function() {
    $('#imagePath').trigger("click");
    // var success = function(event) {
    //   console.log(event);
    // }
    // $.ajax({
    //     type: "POST",
    //     url: "classes/photoUpload.php",
    //     data: {getPhoto:true},
    //     success: success
    // });
  });

  $('#imagePath').change(function() {
    console.log($('#imagePath').val());
    $coverPhoto.attr('src', 'media/img/photoSuccess.png');
  });


  // Replace empty image
  $('.thumbnail').each( function() {
    console.log()
  });





});
