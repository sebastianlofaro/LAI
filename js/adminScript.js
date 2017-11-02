$("document").ready(function() {
  var clientNameHolder = '';
  //var imagePaths;


  // $("#clientsTable").find(".client").hover(
  //   function() {
  //     clientNameHolder = $(this).html();
  //     $(this).html("Delete");
  //   }, function() {
  //     $(this).html(clientNameHolder);
  //     clientNameHolder = "";
  //   }
  // );

  $("#clientsTable").on("mouseenter", ".client", function() {
    clientNameHolder = $(this).html();
    $(this).html("Delete");
  });

  $("#clientsTable").on("mouseleave", ".client", function() {
    $(this).html(clientNameHolder);
    clientNameHolder = "";
  });

//**************************** Click on client in client table. (Delete Client) ****************************
  var $key = "";
  $("#clientsTable").on("click", ".client", function(e) {
    // Delete client then reload table
    $key = $(this).attr('id');
    //console.log("$key: " + $(this).attr('id'));
    var $subcategory = $(".newClientBtn").attr('id'); // FIXME: this needs to be a variable not hard coded.

    function buildPageFromJSON(data) {
      var html = "<tr>";
      for (var i = 0; i < data.length; i++) {
        html = html + "<td class='client' id=\'" + data[i]['id'] + "\'>" + data[i]['name'] + "</td>";
        if ((i + 1) % 3 == 0) {
          html = html + "</tr><tr>";
        }
      }
      html = html + "</tr>";
      //console.log(html);
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


//###################### Pressed newSubCatForCategory button ######################


$("#newSubCatBtn").on("click", function(e) {
  var $subCatName = $(".newSubCat").val();
  var $category = 0; //FIXME Check this... Should it be static?
  var $indexOfSubCat = $("#adminSubcategories").children().length - 1;

  function insertSubCatInDOM(name, id) {
    var html = '<li class="subcategory"><a id="' + id + '" href="?action=portfolioSubCat&amp;id=' + id + '&amp;category=1&amp;index=' + $indexOfSubCat + '"><p> ' + name + ' </p></a></li>';
    $('#adminSubcategories').append(html);
  }

  if ($subCatName) {

    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {'action': 'newSubCatForCategory', 'name': $subCatName, 'category': $category },
      success: function(data, status) {
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
    formData.append('subcategory', subCatID);
    formData.append('directoryID', $("input[name~='articleId']").val());
    formData.append('photoIndex', $('#imagePaths').text() == "" ? 0 : $('#imagePaths').text().split(',').length);

    xhr.onload = function() {
      var imagePaths = '';
      var data = JSON.parse(this.responseText);
      var html = "";
      var existingImages = $('#imagePaths').html()
      $.each(data, function(index, value) {
        html = html + "<li><div class='uploaded-image' id='" + ( parseInt(value.name) + $('#imagePaths').text() == "" ? 0 : $('#imagePaths').text().split(',').length ) + "' style = 'background-image: url(" + value.file + ")'></div></li>"
        imagePaths = imagePaths + value.file + ",";
      });
      console.log('upload response HTML: ' + html)
      // Remove the extra "," on the end of imagePaths
      imagePaths = imagePaths.slice(0, -1);
        console.log('upload response imagePaths: ' + imagePaths)


      $('#uploaded-images').html($('#uploaded-images').html() + html);
      console.log('(upload photo callback) existingImages: ' + existingImages);
      if (existingImages) {
        $('#imagePaths').html(existingImages + "," + imagePaths.replace(existingImages, ''));
      }
      else {
        $('#imagePaths').html(imagePaths);
      }
    }

    xhr.open('post', 'upload.php');
    xhr.send(formData);
  }

  dropzone.ondrop = function(e) {
    e.preventDefault();
    this.className = 'dropzone';
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

// ###################### Save New Job ######################
$('.save').on('click', function(e) {
  e.preventDefault();
  // get values of form fields.
  var $title = $('#title').val();
  var $personnel = $('#personnel').val();
  var $services = $('#services').val();
  var $contractAmount = $('#contractAmount').val();
  var $completionDate = $('#completionDate').val();
  var $content = $('#content').val();
  var $subcategory = $(this).attr('id');
  var $articleID = $("input[name~='articleId']").val() == "" ? 'null' : $("input[name~='articleId']").val();
  var photosURL = $('#imagePaths').text();

  $.ajax({
    url: 'ajax.php',
    type: 'post',
    data: {'action': 'saveArticle', 'subcategory': $subcategory,  'title': $title , 'personnel': $personnel , 'services': $services , 'contractAmount': $contractAmount , 'completionDate': $completionDate , 'content': $content , 'photoURL': photosURL, 'id': $articleID },
    success: function(data, status) {
      // window.history.back();
      console.log(data);
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
      imagePathsArray = data.split(',');
      var html = '';
      $.each(imagePathsArray, function(index, value) {
        html = html + "<li><div class='uploaded-image' id='" + index + "' style = 'background-image: url(" + value + ")'></div></li>"
      });
      $('#uploaded-images').html(html);
    }
  });

});





});
