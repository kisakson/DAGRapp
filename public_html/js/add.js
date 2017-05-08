$('#dagr-add-button').on('click', function(e) {
  // TODO do a check to see if any input values are missing
  e.preventDefault();
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
          data: $('#file-add-form').serialize(),
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
    $("#file-lo-form").html('Paste File URL: * <input type="text" name="url" id="file-url"><br>');
  } else if ($('#file-lo').val() == "local") {
    $("#file-lo-form").html('Upload File: * <input type="text" name="url" id="file-url">TODO.....<br>');
  } else {
    $("#file-lo-form").html("Select a value above.<br>");
  }
});

$('#dagr-cat-button').on('click', function(e) {
  e.preventDefault();
    $.ajax({
        url : '/php/responses/add.php',
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
