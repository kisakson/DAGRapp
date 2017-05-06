$('#dagr-add-button').on('click', function(e) {
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
