$('#dagr-search-button').on('click', function(e) {
  e.preventDefault();
    $.ajax({
        url : '/php/responses/search.php',
        type: "GET",
        data: $('#dagr-search-form').serialize(),
        success: function (result) {
            console.log(result);
            $("#results").html(result);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
  $("#results").html('<p>Results are loading...</p>');
});

