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
  // TODO do a check to see if any input values are missing
  e.preventDefault();
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
});
