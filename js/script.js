$(document).ready(function() {


  $('.hamburger-menu').on("click", function() {
    $('.nav-items').slideToggle("slow", function() {
      
    });
  });



  $('a').on("click", function() {console.log("Button Clicked!")});

   var $coverPhoto = $('#coverPhoto');

  if ($coverPhoto.attr('src') == "") {
    $coverPhoto.attr('src', 'media/img/addPhoto.png');

    // Link click of photo to click of button
    $coverPhoto.on("click", function() {
      $('#imagePath').trigger("click");
    });


  }




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
