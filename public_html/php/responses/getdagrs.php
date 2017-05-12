<?php
  include '../../connect.php';
	$db = db_connect();
	$stmt = $db->prepare("SELECT * FROM `DAGR` ORDER BY `Name`");
  $stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5);
  echo '<form method="post" action=' . htmlspecialchars("http://www.bagelcron.com/php/responses/parsehtml.php") . ' id="file-add-form">
	      <div class="form-row">File Name: <input type="text" name="name" id="file-name"></div><br>
        <div class="form-row">Creator Name: * <input type="text" name="creator" id="file-creator"></div><br>';
  echo '<div class="form-row">DAGR Parent: * <select name="parent" id="file-parent">'
      . '<option value="null"></option>';
  while($stmt->fetch()) {
    echo '<option value="', $col1, '">', $col2, ' - id: ', $col1, '</option>';
  }
  echo '</select></div><br>';
  echo '<div class="form-row"><input type="submit" name="submit" value="Submit" class="submit-button" id="file-add-button"/></div>
      </form>';
  echo '<div id="results"></div>';
  $stmt->close();
?>
