<h2>Add a File</h2>
<p>This page adds a new File within a DAGR. This containing DAGR can be created alone or within another existing DAGR.</p>
<p>To save a file in the database, select the option above to add a new file.</p>
        
<form method="post" action="<?php echo htmlspecialchars('php/responses/add.php');?>" id="file-add-form">
	File Name: <input type="text" name="name"><br>
  Creator Name: <input type="text" name="creator"><br>
  <select name="localoronline">
    <option value="null"></option>
    <option value="local">Local</option>
    <option value="online">Online</option>
  </select></br>
  <!-- if local clicked: add an upload thing here
        if online clicked: add a textbox here -->
  <!-- find the file size -->
  <!-- get the file type from the url value above -->
  DAGR Parent: <select name="parent">
    <option value="null"></option>
    <option value="new">New DAGR</option>
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
  </select><br>
  <input type="hidden" name="object" value="file">
	<input type="submit" name="submit" value="Submit" id='file-add-button'/>
</form>

<script src="/js/add.js"></script>

<div id='results'></div>
