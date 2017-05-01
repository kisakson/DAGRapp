$('#dagr-search-button').on('click', function(e) {
  e.preventDefault();
  var str = 'Search query: ' + $('form').serialize();
  $('#results' ).text( str );
    $.ajax({
        url : '/php/searchdagr.php',
        type: "GET",
        data: $(this).serialize(),
        success: function (data) {
            console.log(data);
            $("#results").html(data);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
});

