$(document).ready(function () {
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
});

function searchDagr() {
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
};
