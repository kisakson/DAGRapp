<h2>Add a DAGR</h2>
<p>This page adds a new DAGR, a standalone folder. This DAGR can be created alone or within another existing DAGR.</p>
<p>To save a file in the database, select the option above to add a new file.</p>
        
<form method="post" action="<?php echo htmlspecialchars('php/responses/add.php');?>" id="dagr-add-form">
	<div class='form-row'>DAGR Name: <input type="text" name="name"></div><br>
  <div class='form-row'>Creator Name: <input type="text" name="creator"></div><br>
  <div class='form-row'>DAGR Parent: <select name="parent">
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
  </select></div><br>
  <div class='form-row'>Category: <select name="category">
    <option value="none">None</option>
    <?php
      $stmt = $db->prepare("SELECT DISTINCT `Category` FROM `Categories` ORDER BY `Category`");
      $stmt->execute();
	    $stmt->bind_result($cat);
      while($stmt->fetch()) {
        echo '<option value="', $cat, '">', $cat, '</option>';
      }
      
      $stmt->close();
    ?>
    
  </select></div><br>
  <input type="hidden" name="object" value="dagr">
	<div class='form-row'><input type="submit" name="submit" value="Submit" class='submit-button' id='dagr-add-button'/></div>
</form>

<script src="/js/add.js"></script>

<div id='results'></div>
