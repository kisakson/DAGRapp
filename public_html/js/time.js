$('#dagr-time-button').on('click', function(e) {
  e.preventDefault();
    $.ajax({
        url : '/php/responses/time.php',
        type: "GET",
        data: $('#dagr-time-form').serialize(),
        success: function (result) {
            $("#results").html(result);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
  $("#results").html('<p>Results are loading...</p>');
});
