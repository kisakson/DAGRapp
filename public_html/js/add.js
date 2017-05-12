$('#dagr-add-button').on('click', function(e) {
  e.preventDefault();
  if ($('#dagr-name').val() == "" || $('#dagr-creator').val() == "null") {
    $('#results').html('<p>Not all required fields are filled.</p>');
    $('#results').css("color", "red");
  } else {
      $.ajax({
          url : '/php/responses/add.php',
          type: "POST",
          data: $('#dagr-add-form').serialize(),
          success: function (result) {
              $("#results").html(result);
          },
          error: function (jXHR, textStatus, errorThrown) {
              alert(errorThrown);
         }
      });
  $("#results").html('<p>Adding...</p>');
  $("#results").css("color", "black");
  }
});

$('#file-add-button').on('click', function(e) {
  e.preventDefault();
  if ($('#file-creator').val() == "" || $('#file-lo').val() == "null" || $('#file-url').val() == "" || $('#file-parent').val() == "null") {
    $('#results').html('<p>Not all required fields are filled.</p>');
    $('#results').css("color", "red");
  } else {
      $.ajax({
          url : '/php/responses/add.php',
          type: "POST",
          data: new FormData($('#file-add-form')[0]),
          cache: false,
          contentType: false,
          processData: false,
          success: function (result) {
              $("#results").html(result);
          },
          error: function (jXHR, textStatus, errorThrown) {
              alert(errorThrown);
          }
      });
    $("#results").html('<p>Adding...</p>');
    $("#results").css("color", "black");
  }
});

$('#file-lo').on('change', function() {
  if ($('#file-lo').val() == "online") {
    $("#file-lo-form").html('<div class="form-row">Paste File URL: * <input type="text" name="url" id="file-url"></div><br>');
  } else if ($('#file-lo').val() == "local") {
    $("#file-lo-form").html('<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />Upload Files: * (Maximum File Size: 10,000,000 bytes)<input type="file" name="upload[]" id="file-url" multiple="" ><br>');
  } else {
    $("#file-lo-form").html("<div class='form-row'>Select a value above.</div><br>");
  }
});

$('#cat-lo').on('change', function() {
  if ($('#cat-lo').val() == "new") {
    $("#new_cat_div").html('Enter a name:  <input type="text" name="added_cat"><br>');
  } else {
    $("#new_cat_div").html("");
  }
});
  
$('#dagr-cat-button').on('click', function(e) {
  e.preventDefault();
    $.ajax({
        url : '/php/responses/cat.php',
        type: "POST",
        data: $('#dagr-cat-form').serialize(),
        success: function (result) {
            $("#results").html(result);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
  
  $("#results").html('<p>Adding...</p>');
});

