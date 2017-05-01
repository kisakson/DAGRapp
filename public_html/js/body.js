function searchDagr() {
  //var str = $( "form" ).serialize();
  //$( "#results" ).text( str );
  $('#dagr-search-form').ajaxForm({url: 'searchdagr.php', type: 'post'})
}
//$( "input[type='checkbox'], input[type='radio']" ).on( "click", showValues );
//$( "select" ).on( "change", showValues );

//function searchDagr() {
$('#dagr-search-button').on('click', function(e) {
  e.preventDefault();
  var str = 'Search query: ' + $('form').serialize();
  $('#results' ).text( str );
    /*$.ajax({
        url : '/php/searchdagr.php',
        type: "GET",
        data: $(this).serialize(),
        success: function (data) {
            $("#results").html(data);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });*/
});
//};

/*function searchDagr() {
    $('#dagr-search-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "GET",
            data: $(this).serialize(),
            success: function (data) {
                $("#results").html(data);
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });
}; */
