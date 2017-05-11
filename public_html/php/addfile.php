<h2>Add a File</h2>
<p>This page adds a new File within a DAGR. This containing DAGR can be created alone or within another existing DAGR.</p>
<p>If you would like to upload multiple local files, you can either:</p>
<p>a) Type a file name and all files will be named Name (1), Name (2), etc.</p>
<p>b) Leave the file name field empty and all files will be named after the upload file name.</p>
        
<form method="post" action="<?php echo htmlspecialchars('php/responses/add.php');?>" enctype="multipart/form-data" id="file-add-form">
	<div class='form-row'>File Name: <input type="text" name="name" id="file-name"></div><br>
  <div class='form-row'>Creator Name: * <input type="text" name="creator" id="file-creator"></div><br>
  <div class='form-row'>Local or Online File: * <select name="localoronline" id="file-lo">
    <option value="null"></option>
    <option value="local">Local</option>
    <option value="online">Online</option>
  </select></div></br>
  <div class='form-row' id="file-lo-form">Select a value above.</div><br>
  <div class='form-row'>DAGR Parent: * <select name="parent" id="file-parent">
    <option value="null"></option>
    <?php
      include '../connect.php';

      $db = db_connect();
	    $stmt = $db->prepare("SELECT * FROM `DAGR` ORDER BY `Name`");
      $stmt->execute();
	    $stmt->bind_result($col1, $col2, $col3, $col4, $col5);
      while($stmt->fetch()) {
        echo '<option value="', $col1, '">', $col2, ' - id: ', $col1, '</option>';
      }
    ?>
  </select></div><br>
  <input type="hidden" name="object" value="file">
	<div class='form-row'><input type="submit" name="submit" value="Submit" class='submit-button' id='file-add-button'/></div>
</form>

<script src="/js/add.js"></script>

<div id='results'></div>
