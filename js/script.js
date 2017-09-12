$(document).ready(function() {

  var $coverPhoto = $('#coverPhoto');
  if ($coverPhoto.attr('src') != "") {
  }
  else {
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




  //###################### AJAX ######################

  $("#subcategories").on("click", "a", function(e) {
    e.preventDefault();
    //Store key in local variable
    var $key = $(this).attr('id');
    console.log("KEY: " + $(this).attr('id'));
    console.log($(this).children().html());
    $(".articles").html("<li><a href='admin.php?action=newArticle'><img class='darkBorder thumbnail' src='media/img/addimage.png'><p>New Article</p></a></li>");
    $(".pageTitle").html($(this).children().html());



    // Make the AJAX request for page content and supply the key of the subcategory selected

    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {'action': 'selectSub', 'key': $key},
      success: function(data, status) {
        var dataObject = $.parseJSON(data)
        console.log(dataObject);
        console.log(status);
        //console.log('Key: ' + $key);
      },
      error: function(xhr, desc, err) {
        console.log("ERROR: " . xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    });

});
});
