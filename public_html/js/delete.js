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
    $(hashinput).html("<p>Deleting...</p>");
  }
}
