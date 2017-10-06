$(document).ready(function() {

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
        html = html + "<td>" + data[i]['name'] + "</td>";
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

  $("#portfolioSecondaryMenu").on("click", "a", function(e) {
    e.preventDefault();
    var $key = $(this).attr('id');

    function buildPageFromJSON(data) {
      $(".articles").html("");
      $selectedSubCatName = $('#' + $key).html();
      $('.jumbotron h1').html($selectedSubCatName);
      $.each(data["results"], function(index, value) {
        var imagePath = value["imagePath"];
        var title = value["title"];
        var id = value["id"];

        var html = '<li><a href="?action=viewArticle&amp;articleId=' + id + '"><div class="thumbnail" style="background-image: url(\' ' + imagePath + ' \')"></div>' + title + '</a></li>'
        $(".articles").append(html);
      });
    }


  });


  //-------------------------------------------------------

  $("#adminSubcategories").on("click", "a", function(e) {
    e.preventDefault();
    //Store key in local variable
    var $key = $(this).attr('id');
    console.log("KEY: " + $(this).attr('id'));
    console.log($(this).children().html());
    $(".articles").html("<li><a href='admin.php?action=newArticle&amp;subcategory=" + $key + "'><img class='darkBorder thumbnail' src='media/img/addimage.png'><p>New Article</p></a></li>");
    $(".pageTitle").html($(this).children().html());


    //**************************************************************************************
    // Make the AJAX request for page content and supply the key of the subcategory selected
    //vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv


    function buildPageFromJSON(data) {
      console.log(data);

      // Add Delete Subcategoy button
      if ($("#deleteSubCatBtn").html()) {
        // Update button
        console.log($key);
        $("#deleteSubCatBtn").attr('name', $key);
      }
      else {
        // Create button
        var html = '<button id="deleteSubCatBtn" type="button" name="' + $key + '">Delete</button>';
        $('#listArticles').append(html);
      }


      $.each(data["results"], function(index, value) {
        console.log(value);
        var imagePath = value["imagePath"];
        var title = value["title"];
        var id = value["id"];

        var html = '<li><a href="admin.php?action=editArticle&amp;articleId=' + id + '"><div class="thumbnail" style="background-image: url(\' ' + imagePath + ' \')"></div>' + title + '</a></li>'
        $(".articles").append(html);
      });
    }

    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {'action': 'selectSub', 'key': $key},
      success: function (data, status) {
        var dataObject = $.parseJSON(data); //added ;
        buildPageFromJSON(dataObject);
      },
      error: function(xhr, desc, err) {
        console.log("ERROR: " . xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    });

});


//###################### Pressed deleteSubCatBtn ######################

$('#listArticles').on("click", "#deleteSubCatBtn", function() {
  console.log("deleteSubCatBtn clicked. SubCatKey" + $("#deleteSubCatBtn").attr('name'));
  // Use AJAX to tell database to delete subcategory
  var $key = $("#deleteSubCatBtn").attr("name");
  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: {'action': 'deleteSubCat', 'subCatKey': $key},
    success: function(e) {
      console.log("It has been a great success! " + e);
      location.reload();
    }
  });
});

//###################### Pressed Save ######################

$("#save").on("click", function() {

});

//###################### Pressed newSubCatBtn ######################

  $("#newSubCatBtn").on("click", function(e) {
    var subCatName = $("#newSubCat").val();

    function insertSubCat(name, id) {
      var html = '<li class="subcategory"><a id="' + id + '" href="#"><p> ' + name + ' </p></a></li>';
      $('#subcategories').append(html);
    }


    if (subCatName) {
      // Store subcategory in database
      $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {'action': 'newSubCat', 'name': subCatName},
        success: function (data, status) {
          // Update the DOM
          var dataObject = $.parseJSON(data);
          var indexOfLastSubCat = dataObject['results'].length - 1
          var name = dataObject['results'][indexOfLastSubCat]['name']
          var id = dataObject['results'][indexOfLastSubCat]['id']

          insertSubCat(name, id);
        },
        error: function(xhr, desc, err) {
          console.log("ERROR: " . xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      });
    }
    else {
      // Empty text value. Display ERROR!
      $("#newSubCatWrapper").effect( "shake", {times:2, distance:2}, 500 );
      console.log("ERROR AS FUCK!");
    }


  });



});
