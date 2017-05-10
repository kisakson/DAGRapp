<table border="0">
  <tbody>
    <tr>
      <td>
        <h2>Add a DAGR Category</h2>
        <p>This page adds a new DAGR category.</p>
        <p>To save a file in the database, select the option above to add a new file.</p>
        <!-- A user may create a DAGR with the components of the web page, or add these components to an open -->
        <!-- Form to add to a category -->
        <h3>Current categories: </h3>
	<style> td { padding: 5px; } </style>				
	
	<!-- Forms must be outside of <table>s or inside <td>s to keep HTML from breaking. -->
	<form method="post" action="<?php echo htmlspecialchars('php/responses/cat.php');?>" id="dagr-cat-form">
	<input type="hidden" name="object" value="cat"/>	
	
	<table border="5">
        <?php
	        include '../connect.php';
	
		$db = db_connect();
		$stmt = $db->prepare('SELECT `Category` FROM `Categories` GROUP BY `Category` ORDER BY `Category` ASC');
		$stmtx = $db->prepare('SELECT `GUID`, `Name` FROM `DAGR`;');
		
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($col1);
	
		
		print '<tr><td style="text-align:center">Category</td><td style="text-align:center">DAGR</td><td>Submit</td></tr>';
	 	print '<tr><td style="text-align:center"><select name="cat" id="cat-lo">';
	 	
		//fetch records
		while($stmt->fetch()) {			// Category dropdown
			echo '<option value="' . $col1 . '">' . $col1 .'</option>';	
		
		}
		
		echo '<option value="new">New... </option>';
		print '</select><div id="new_cat_div"></div></td>';
		
		$stmtx->execute();
		$stmtx->bind_result($col_11, $col_22);
		 	
		print '<td style="text-align:center"><select name="dl_cat"><option value="none">None</option>';
		   
		//fetch records 
      		while($stmtx->fetch()) {		// GUID dropdown
        		echo '<option value="' . $col_11 . '">' . $col_11 .' -> '. $col_22. '</option>';
      		}
      		    
		print '</select></td>';
		 	
		print '<td><input type="submit" name="submit" value="Submit" class="submit-button" id="dagr-cat-button"/></td>';
		print '</tr>';   
	?>
	

	<script src="/js/add.js"></script>
	</table></form><br>
	
	<!-- close statement -->
	
    	<?php 	$stmt->close();
    		$stmtx->close();
    		echo '<div id="results"></div>';
    	?>

      </td>
    </tr>
  </tbody>
</table>
