<h2>Add a DAGR Category</h2>
<p>This page allows you to add a new category to a DAGR.</p>
<p>DAGRs can have more than one category, additionally opening them up to the concept of having self-made sub-categories.</p>
<h3>Current categories: </h3>
<!-- Forms must be outside of <table>s or inside <td>s to keep HTML from breaking. -->
<form method="post" action="<?php echo htmlspecialchars('php/responses/cat.php');?>" id="dagr-cat-form">
	<input type="hidden" name="object" value="cat"/>	
	<table class="table table-bordered">
    <?php
	    include '../connect.php';
	
			$db = db_connect();
			$stmt = $db->prepare('SELECT `Category` FROM `Categories` GROUP BY `Category` ORDER BY `Category` ASC');
			$stmtx = $db->prepare('SELECT `GUID`, `Name` FROM `DAGR`;');
		
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($col1);
		
			print '<thead><tr><td style="width: 250px">Category</td><td>DAGR</td><td style="width: 100px">Submit</td></tr></thead>';
	 		print '<tr><td><div class="form-row"><select name="cat" id="cat-lo">';
			//fetch records
			while($stmt->fetch()) {			// Category dropdown
				echo '<option value="' . $col1 . '">' . $col1 .'</option>';	
			}
			echo '<option value="new">Create New Category</option>';
			print '</select></div><div id="new_cat_div"></div></td>';
			
			$stmtx->execute();
			$stmtx->bind_result($col_11, $col_22);
			
			print '<td style="text-align:center"><div class="form-row"><select name="dl_cat"><option value="none">None</option>';
			
			//fetch records 
    	while($stmtx->fetch()) {		// GUID dropdown
    	  echo '<option value="' . $col_11 . '">' . $col_11 .' -> '. $col_22. '</option>';
    	} 		    
			print '</select></div></td>';	 	
			print '<td><div class="form-row"><input type="submit" name="submit" value="Submit" class="submit-button" id="dagr-cat-button"/></div></td>';
			print '</tr>';   
		?>	
	
		<script src="/js/add.js"></script>
</table></form>
	
<!-- close statement -->
	
<?php 	
	$stmt->close();
  $stmtx->close();
  echo '<div id="results"></div>';
?>

