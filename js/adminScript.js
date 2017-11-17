
$("document").ready(function() {
  var clientNameHolder = '';

  $("#clientsTable").on("mouseenter", ".client", function() {
    clientNameHolder = $(this).html();
    $(this).html("Delete");
  });

  $("#clientsTable").on("mouseleave", ".client", function() {
    $(this).html(clientNameHolder);
    clientNameHolder = "";
  });


  //###################### Add Client ######################

  $(".newClientBtn").on("click", function(e) {
    e.preventDefault();
    var $key = $(this).attr('id');
    var $clientName = $('#newClientInput').val();
    $('#newClientInput').val("")
    console.log("newClientButton clicked.");

    function buildPageFromJSON(data) {
      var html = "<tr>";
      for (var i = 0; i < data.length; i++) {
        html = html + "<td class='client clientAdmin' id>" + data[i]['name'] + "</td>";
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

//###################### Delete Client ######################
  var $key = "";
  $("#clientsTable").on("click", ".client", function(e) {
    // Delete client then reload table
    $key = $(this).attr('id');
    var $subcategory = $(".newClientBtn").attr('id');

    function buildPageFromJSON(data) {
      var html = "<tr>";
      for (var i = 0; i < data.length; i++) {
        html = html + "<td class='client clientAdmin' id=\'" + data[i]['id'] + "\'>" + data[i]['name'] + "</td>";
        if ((i + 1) % 3 == 0) {
          html = html + "</tr><tr>";
        }
      }
      html = html + "</tr>";
      $('#clientsTable').html(html);
    }

    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {'action': 'deleteClient', 'key': $key, 'subcategory': $subcategory},
      success: function (data, status) {
        var dataObject = $.parseJSON(data);
        buildPageFromJSON(dataObject['results']);
      },
      error: function(xhr, desc, err) {
        console.log("ERROR: " . xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    });
  });


//###################### Support return key in textfield ######################


$('input').on('keyup', function(e) {
  console.log('this: ' + $(this).attr('id'));
  console.log('Key code: ' + e.keyCode);
  if (e.keyCode === 13) {
    // User has pressed return in text field
    if ($(this).attr('id') === "newSubCat") {
      $('#newSubCatBtn').trigger('click');
    }
    else if ($(this).attr('id') === "newClientInput") {
      $('.newClientBtn').trigger('click');
    }
  }
});


//###################### Pressed newSubCatForCategory button ######################


$("#newSubCatBtn").on("click", function(e) {
  var $subCatName = $(".newSubCat").val();
  var $category = parseInt($(".category").text())
  var $indexOfSubCat = $("#adminSubcategories").children().length - 1;

  var action;
  $category == 0 ? action = "portfolioSubCat" : action = "clientsSubCat";

  function insertSubCatInDOM(name, id) {
    var html = '<li class="subcategory"><a id="' + id + '" href="?action=' + action + '&amp;id=' + id + '&amp;category=1&amp;index=' + $indexOfSubCat + '"><p> ' + name + ' </p></a></li>';
    $category == 0 ? $('#adminSubcategories').append(html) : $('#adminClientSubcategories').append(html)
  }

  if ($subCatName) {

    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {'action': 'newSubCatForCategory', 'name': $subCatName, 'category': $category },
      success: function(data, status) {
        console.log(data);
        // Update the DOM
        var dataObject = $.parseJSON(data);
        var indexOfLastSubCat = dataObject['results'].length - 1;
        var name = dataObject['results'][indexOfLastSubCat]['name'];
        var id = dataObject['results'][indexOfLastSubCat]['id'];

        insertSubCatInDOM(name, id);
      }
    });
  }
});


//###################### Handle Photo Upload ######################
var photoURL = [];
function activateDropzone() {
  var dropzone = document.getElementById('dropzone');

  var upload = function(files) {
    var formData = new FormData(),
        xhr = new XMLHttpRequest(),
        x;

    for (x = 0; x < files.length; x++) {
      formData.append('files[]',files[x], x);
    }
    var subCatID = $(".save").attr("id");
    formData.append( 'subcategory', subCatID );
    formData.append( 'directoryID', $("input[name~='articleId']").val() );
    formData.append( 'lastImageID', $('#lastImageID').text() == "" ? -1 : $('#lastImageID').text() );

    xhr.onload = function() {
      $('.loading-circle').hide();
      $('.dropzone-wrapper').show();
      var imagePaths = '';
      console.log(this.responseText);
      var data = JSON.parse(this.responseText);
      console.log(data);
      console.log(data.uploaded);

      var html = "";
      var existingImages = $('#imagePaths').html()
      console.log(data.uploaded)
      $.each(data.uploaded, function(index, value) {
        console.log('index: ' + index + "   value: " + value + '   lastImageID: ' + data.lastImageID);
        console.log($('#lastImageID').text())
        html = html + "<li><div class='uploaded-image' id='" + ( $('#lastImageID').text() === "" ? index : parseInt($('#lastImageID').text()) + index + 1) + "' style = 'background-image: url(" + value.file + ")'></div></li>"
        imagePaths = imagePaths + value.file + ",";
      });
      console.log('upload response HTML: ' + html)
      imagePaths = imagePaths.slice(0, -1);
        console.log('upload response imagePaths: ' + imagePaths)


      $('#uploaded-images').html($('#uploaded-images').html() + html);
      if (existingImages) {
        $('#imagePaths').html(existingImages + "," + imagePaths.replace(existingImages, ''));
      }
      else {
        $('#imagePaths').html(imagePaths);
      }
      // Set lastImagID in the DOM
      $('#lastImageID').html(data.lastImageID);
    }

    xhr.open('post', 'upload.php');
    xhr.send(formData);
  }

  dropzone.ondrop = function(e) {
    e.preventDefault();
    this.className = 'dropzone';
    $('.dropzone-wrapper').hide();
    $('.loading-circle').show();
    upload(e.dataTransfer.files);
  }
  dropzone.ondragover = function() {
    this.className = 'dropzone dragover';
    return false;
  }
  dropzone.ondragleave = function() {
    this.className = 'dropzone';
    return false;
  }
}
if (document.getElementById('dropzone')) {
  activateDropzone();
};


// ###################### Cancle New Job ######################

$('#cancle').on('click', function(e) {
  e.preventDefault();
  window.history.back();
});

// ###################### Save New Job ######################
$('.save').on('click', function(e) {
  e.preventDefault();
  // get values of form fields.
  var $title = $('#title').val();
  // var $personnel = $('#personnel').val();
  // var $services = $('#services').val();
  // var $contractAmount = $('#contractAmount').val();
  // var $completionDate = $('#completionDate').val();
  var $owners = $('#owners').val();
  var $contractors = $('#contractors').val();
  var $consultants = $('#consultants').val();
  var $content = $('#content').val();
  var $subcategory = $(this).attr('id');
  var $articleID = $("input[name~='articleId']").val() == "" ? 'null' : $("input[name~='articleId']").val();
  var photosURL = $('#imagePaths').text();
  var $lastImageID = $('#lastImageID').text();

  console.log('save clicked')

  $.ajax({
    url: 'ajax.php',
    type: 'post',
    data: {'action': 'saveArticle', 'subcategory': $subcategory,  'title': $title , 'owners': $owners , 'contractors': $contractors , 'consultants': $consultants , 'content': $content , 'photoURL': photosURL , 'lastImageID': $lastImageID , 'id': $articleID },
    success: function(data, status) {
      window.history.back();
      console.log(data);
      console.log(window.history);
    }
  });
});


// ###################### Delete image ######################
$('#uploaded-images').on("click", '.uploaded-image', function(e) {
  $(this).hide();
  // Tell AJAX to unlink photo of photoID in directoryID
  var $subcategory = $('.save').attr('id');
  var $photoID = $(this).attr('id');
  var $directoryID = $("input[name~='articleId']").val();
  var $imagePaths = $('#imagePaths').text();

  console.log('photoID: ' + $photoID);
  console.log('directoryID: ' + $directoryID);
  console.log('imagePaths: ' + $imagePaths);
  console.log('subcategory: ' + $subcategory);

  $.ajax({
    url: 'ajax.php',
    type: 'post',
    data: { 'action': 'deleteImage', 'photoID': $photoID, 'directoryID': $directoryID, 'subcategory': $subcategory, 'tempImagePaths': $imagePaths },
    success: function(data, status) {
      console.log(data);
      data = data.replace(/\\/g, '');
      data = data.replace(/\"/g, '');
      console.log(data);
      $('#imagePaths').html(data);
    }
  });

});



// ###################### Make sure database matches file system ######################

// $('#imagePaths').text().change(function(e) {
//   console.log('Image path change.');
// });

$('#imagePaths').bind("DOMSubtreeModified",function(){
  console.log('IMAGE PATH CHANGED!!!!!  ' + $('#imagePaths').text());
});





});
