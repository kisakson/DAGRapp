function dagrdelete(input) {
  var hashinput = "#" + input;
  if ($(hashinput).text() == "Delete") {
    $(hashinput).css("color", "#800000");
    $(hashinput).text("Confirm");
  } else if ($(hashinput).text() == "Confirm") {
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
              $(hashinput).css("color", "#E4FDE1");
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
    $(hashinput).html("<p>Deleting...</p>");
  }
}

function filedelete(input) {
  var hashinput = "#" + input;
  if ($(hashinput).text() == "Delete") {
    $(hashinput).css("color", "#800000");
    $(hashinput).text("Confirm");
  } else if ($(hashinput).text() == "Confirm deletion") {
    $.ajax({
        url : '/php/responses/delete.php',
        type: "POST",
        data: {
          object: 'file',
          guid: input
        },
        success: function (result) {
            $(hashinput).text(result);
            if (result == "Success") {
              $(hashinput).css("color", "#E4FDE1");
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
    $(hashinput).html("<p>Deleting...</p>");
  }
}
