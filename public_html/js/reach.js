$('#dagr-reach-button').on('click', function(e) {
  e.preventDefault();
    $.ajax({
        url : '/php/responses/reach.php',
        type: "GET",
        data: $('#dagr-reach-form').serialize(),
        success: function (result) {
            $("#results").html(result);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
  $("#results").html('<p>Results are loading...</p>');
});
