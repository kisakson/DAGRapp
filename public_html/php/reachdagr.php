<h2>Reach Report</h2>
<p>This tool lists all DAGRs connected to the input DAGR, either through parents or through children, recursively.</p>

<form method="get" action="<?php echo htmlspecialchars('php/responses/reach.php');?>" id="dagr-reach-form">
  <div class='form-row'>DAGR: <select name="guid">
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
  </select></div>
  <div class='form-row'><input type="submit" name="submit" value="Reach" class='submit-button' id='dagr-reach-button'/></div><br>
</form>

<script src="/js/reach.js"></script>
<div id='results'></div>