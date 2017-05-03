$('#dagr-search-button').on('click', function(e) {
  e.preventDefault();
    $.ajax({
        url : '/php/responses/search.php',
        type: "GET",
        data: $('#dagr-search-form').serialize(),
        success: function (result) {
            $("#results").html(result);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
  $("#results").html('<p>Results are loading...</p>');
});

function dagrmodify(input) {
  var rownum = (input.split("-"))[1];
  var rowid = "#row-" + rownum;
  console.log("we here");
  console.log(rowid);
  //$(rowid).wrap('<form method="php/responses/modify.php" id="dagr-modify-form"></form>');
  //$(rowid).children().wrap('<input type="text" name="something"></input>');
}

function dagrdelete(input) {
  var hashinput = "#" + input;
  if ($(hashinput).text() == "Delete") {
    $(hashinput).css("color", "red");
    $(hashinput).text("Confirm deletion");
  } else if ($(hashinput).text() == "Confirm deletion") {
    $.ajax({
        url : '/php/responses/delete.php',
        type: "POST",
        data: {
          object: 'dagr',
          guid: input
        },
        success: function (result) {
            $(hashinput).text(result);
            if (result == "Success") {
              $(hashinput).css("color", "green");
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
    $(hashinput).html("Deleting...");
  }
}