<h2>Search DAGRs</h2>
<p>Use the form below to query the DAGR Saver database on different DAGR values. All query values are optional.</p>
<p>After searching, you can also delete DAGRs. Click twice to confirm the deletion and search again to view the updated table.</p>
<p>If a parent DAGR is deleted, all DAGR and File children will also be deleted.</p>
<form method="get" action="<?php echo htmlspecialchars('php/responses/search.php');?>" id="dagr-search-form">
	<div class='form-row'>DAGR Name: <input type="text" name="name"></div><br>
	<div class='form-row'>Creator Name: <input type="text" name="creator"></div></br>
  <div class='form-row'>Contains Category: <select name="cat">
		<option value="none">None</option>
	<?php
		include '../connect.php';
	
		$db = db_connect();
		$stmt = $db->prepare('SELECT `Category` FROM `Categories` GROUP BY `Category` ORDER BY `Category` ASC');
		
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($col1);
		while($stmt->fetch()) {			// Category dropdown
			echo '<option value="' . $col1 . '">' . $col1 .'</option>';	
		}

	?>
	</select></div><br>
	<input type="hidden" name="object" value="dagr">
	<div class='form-row'><input type="submit" name="submit" value="Submit" class='submit-button' id='dagr-search-button'/></div>
</form>

<script src="/js/search.js"></script>

<div id='results'></div>
