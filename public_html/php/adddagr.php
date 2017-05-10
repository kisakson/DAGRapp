<h2>Add a DAGR</h2>
<p>This page adds a new DAGR, a standalone folder. This DAGR can be created alone or within another existing DAGR.</p>
<p>To save a file in the database, select the option above to add a new file.</p>
        
<form method="post" action="<?php echo htmlspecialchars('php/responses/add.php');?>" id="dagr-add-form">
	DAGR Name: <input type="text" name="name"><br>
  Creator Name: <input type="text" name="creator"><br>
  DAGR Parent: <select name="parent">
    <option value="none">None</option>
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
  <input type="hidden" name="object" value="dagr">
	<input type="submit" name="submit" value="Submit" id='dagr-add-button'/>
</form>

<script src="/js/add.js"></script>

<div id='results'></div>
