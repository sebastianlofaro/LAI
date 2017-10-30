$("document").ready(function() {
  var clientNameHolder = '';


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
    console.log("$key: " + $(this).attr('id'));
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
      console.log(html);
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

$(".newSubCatBtn").on("click", function(e) {
  var $subCatName = $(".newSubCat").val();
  var $category = 1; //FIXME Check this... Should it be static?
  var $indexOfSubCat = $("#adminClientSubcategories").children().length - 1;
  console.log('btn clicked.');
  console.log($subCatName);

  function insertSubCatInDOM(name, id) {
    var html = '<li class="subcategory"><a id="' + id + '" href="?action=clientsSubCat&amp;id=' + id + '&amp;category=1&amp;index=' + $indexOfSubCat + '"><p> ' + name + ' </p></a></li>';
    $('#adminClientSubcategories').append(html);
  }

  if ($subCatName) {

    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: {'action': 'newSubCatForCategory', 'name': $subCatName, 'category': $category },
      success: function(data, status) {
        // Update the DOM
        var dataObject = $.parseJSON(data);
        console.log(dataObject);
        var indexOfLastSubCat = dataObject['results'].length - 1;
        var name = dataObject['results'][indexOfLastSubCat]['name'];
        var id = dataObject['results'][indexOfLastSubCat]['id'];

        insertSubCatInDOM(name, id);
      }
    });
  }
});

$("#newSubCatBtn").on("click", function(e) {
  var $subCatName = $(".newSubCat").val();
  var $category = 0; //FIXME Check this... Should it be static?
  var $indexOfSubCat = $("#adminClientSubcategories").children().length - 1;
  console.log('btn clicked.');
  console.log($subCatName);

  function insertSubCatInDOM(name, id) {
    var html = '<li class="subcategory"><a id="' + id + '" href="?action=clientsSubCat&amp;id=' + id + '&amp;category=1&amp;index=' + $indexOfSubCat + '"><p> ' + name + ' </p></a></li>';
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
        console.log(dataObject);
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
    //formData.append('subcategory', subCatID);
    console.log();
    xhr.onload = function() {
      var data = JSON.parse(this.responseText);
      console.log(data);
      var html = "";
      $.each(data, function(index, value) {
        photoURL.push(value.file);
        html = html + "<li><div class='uploaded-image' style = 'background-image: url(" + value.file + ")'></div></li>"
      });
      photoURL = photoURL.toString();
      console.log("photoURL String: " + photoURL);
      $('#uploaded-images').html(html);
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
  $title = $('#title').val();
  $personnel = $('#personnel').val();
  $services = $('#services').val();
  $contractAmount = $('#contractAmount').val();
  $completionDate = $('#completionDate').val();
  $content = $('#content').val();
  $subcategory = $(this).attr('id');
  console.log("title: " + $title + "   personnel: " + $personnel + "   services: " + $services + "   contractAmount: " + $contractAmount + "   completionDate: " + $completionDate + "   content: " + $content + "   photoURL: " + photoURL);

  $.ajax({
    url: 'ajax.php',
    type: 'post',
    data: {'action': 'newArticle', 'subcategory': $subcategory,  'title': $title , 'personnel': $personnel , 'services': $services , 'contractAmount': $contractAmount , 'completionDate': $completionDate , 'content': $content , 'photoURL': photoURL },
    success: function(data, status) {
      // window.history.back();
      console.log(data);
    }
  });
});


// Delete image
$('#uploaded-images').on("click", '.uploaded-image', function(e) {
  console.log($(this));
  // Tell AJAX to unlink photo of photoID in directoryID
  $photoID = $(this).attr('id');
  $directoryID = $("input[name~='articleId']").val();
  console.log('photoID: ' + $photoID + ' directoryID: ' + $directoryID);

  //Make AJAX request
  $.ajax({
    url: 'ajax.php',
    type: 'post',
    data: { 'action': 'deleteImage', 'photoID': $photoID, 'directoryID': $directoryID },
    success: function(data, status) {
      // window.history.back();
      // var dataObject = $.parseJSON(data);
      // console.log(dataObject);
      console.log(data)
    }
  });

});





});
